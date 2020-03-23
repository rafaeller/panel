<?php

namespace Pterodactyl\Http\Controllers\Api\Remote;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Pterodactyl\Exceptions\DisplayException;
use Pterodactyl\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Pterodactyl\Models\Server;
use Pterodactyl\Services\Servers\ServerCreationService;
use Pterodactyl\Services\Servers\ServerDeletionService;
use Pterodactyl\Services\Servers\SuspensionService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ServerTransferController extends Controller
{
    protected $service;
    protected $suspensionService;
    protected $deletionService;

    /**
     * ServerTransferController constructor.
     * @param ServerCreationService $service
     * @param SuspensionService $suspensionService
     * @param ServerDeletionService $deletionService
     */
    public function __construct(ServerCreationService $service, SuspensionService $suspensionService, ServerDeletionService $deletionService)
    {
        $this->service = $service;
        $this->suspensionService = $suspensionService;
        $this->deletionService = $deletionService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function compressed(Request $request)
    {
        $server_id = (int) $request->input('server_id');

        $compress = DB::table('server_transfers')->where('old_server_id', '=', $server_id)->where('status', '=', '1')->where('status', '!=', '5')->get();
        if (count($compress) > 0) {
            DB::table('server_transfers')->where('id', '=', $compress[0]->id)->update([
                'status' => 2
            ]);

            return response()->json(['success' => 'true']);
        } else {
            throw new NotFoundHttpException('Server not found.');
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function download(Request $request)
    {
        $transfer_id = $request->input('transfer_id');

        DB::table('server_transfers')->where('id', '=', $transfer_id)->update([
            'status' => 4
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws DisplayException
     */
    public function completed(Request $request)
    {
        $transfer_id = $request->input('transfer_id');

        $transfer = DB::table('server_transfers')->where('id', '=', $transfer_id)->get();
        if (count($transfer) > 0) {
            DB::table('server_transfers')->where('id', '=', $transfer_id)->delete();
			
			DB::table('databases')->where('server_id', '=', $transfer[0]->old_server_id)->update([
				'server_id' => $transfer[0]->new_server_id
			]);
			DB::table('subusers')->where('server_id', '=', $transfer[0]->old_server_id)->update([
				'server_id' => $transfer[0]->new_server_id
			]);
			DB::table('schedules')->where('server_id', '=', $transfer[0]->old_server_id)->update([
				'server_id' => $transfer[0]->new_server_id
			]);

            $server = DB::table('servers')->where('id', '=', $transfer[0]->old_server_id)->get();

            $data = json_decode(json_encode($server[0]), true);
            $srv = new Server($data);
            $srv->id = $data['id'];

            $this->deletionService->withForce(true)->handle($srv);
			
			DB::table('servers')->where('id', '=', $transfer[0]->new_server_id)->update([
               'external_id' => $server[0]->external_id
            ]);

            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws DisplayException
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     * @throws \Pterodactyl\Exceptions\Repository\RecordNotFoundException
     */
    public function error(Request $request)
    {
        $transfer_id = $request->input('transfer_id');

        $transfer = DB::table('server_transfers')->where('id', '=', $transfer_id)->get();
        if (count($transfer) > 0) {
            DB::table('server_transfers')->where('id', '=', $transfer_id)->delete();

            $server = DB::table('servers')->where('id', '=', $transfer[0]->new_server_id)->get();
            $data = json_decode(json_encode($server[0]), true);
            $srv = new Server($data);
            $srv->id = $data['id'];
            $this->deletionService->withForce(true)->handle($srv);

            $server = DB::table('servers')->where('id', '=', $transfer[0]->old_server_id)->get();
            $data = json_decode(json_encode($server[0]), true);
            $srv = new Server($data);
            $srv->id = $data['id'];
            $this->suspensionService->toggle($srv, 'unsuspend');

            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }
}
