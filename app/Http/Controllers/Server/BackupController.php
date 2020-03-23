<?php

namespace Pterodactyl\Http\Controllers\Server;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Prologue\Alerts\AlertsMessageBag;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Traits\Controllers\JavascriptInjection;
use Illuminate\Support\Facades\DB;
use Pterodactyl\Repositories\Daemon\BackupRepository;
use Illuminate\Support\Str;
use Illuminate\Cache\Repository;

class BackupController extends Controller
{
    use JavascriptInjection;

    /**
     * @var \Prologue\Alerts\AlertsMessageBag
     */
    private $alert;

    protected $cache;

    private $folders = [
        // Only servers which you don't want save all folder and file
        // Egg Id => '/folder to save in server's folder'
        // Default save: /
		// If you want to save not all server's folder, you can add folder to save with egg id
		// For example: 1 => '/data',
    ];

    protected $backupRepository;

    /**
     * BackupController constructor.
     *
     * @param AlertsMessageBag $alert
     * @param BackupRepository $backupRepository
     * @param Repository $cache
     */
    public function __construct(AlertsMessageBag $alert, BackupRepository $backupRepository, Repository $cache)
    {
        $this->alert = $alert;
        $this->backupRepository = $backupRepository;
        $this->cache = $cache;
    }

    /**
     * @param Request $request
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request): View
    {
        $server = $request->attributes->get('server');
        $this->authorize('view-backup', $server);
        $this->setRequest($request)->injectJavascript();

        $saves = DB::table('backups')->where('server_id', '=', $server->id)->get();

        return view('server.backup.backup', [
            'saves' => $saves
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(Request $request): JsonResponse
    {
        $server = $request->attributes->get('server');
        $this->setRequest($request)->injectJavascript();

        $name = trim(strip_tags($request->input('name')));

        if (strlen($name) > 20) {
            return response()->json(["success" => false, "error" => "Too long name (max 20)"]);
        }

        $nameCheck = DB::table('backups')->where('server_id', '=', $server->id)->where('name', '=', $name)->get();
        if (count($nameCheck) > 0)
            return response()->json(['success' => false, 'error' => 'Name is already exists!']);

        $fileName = str::random(10);

        isset($this->folders[$server->egg_id]) ? $folder = $this->folders[$server->egg_id] : $folder = '/';

        $response = $this->backupRepository->setServer($server)->create([
            'name' => $fileName,
            'folder' => $folder
        ]);

        if (json_decode($response->getBody())->success != true)
            return response()->json(['success' => false]);

        DB::table('servers')->where('id', '=', $server->id)->update(['suspended' => '1']);

        DB::table('backups')->insert(
            ['server_id' => $server->id, 'name' => $name, 'file' => $fileName, 'date' => date('Y-m-d H:i:s')]
        );

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * @param Request $request
     * @param $uuid
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function download(Request $request, $uuid, $id)
    {
        $server = $request->attributes->get('server');
        $this->setRequest($request)->injectJavascript();

        $id = (int) $id;

        $check = DB::table('backups')->where('id', '=', $id)->where('server_id', '=', $server->id)->get();
        if (count($check) < 1)
            return view('server.backup.download', ['errorCode' => '404', 'message' => 'Backup não encontrado!']);

        $token = str::random(30);
        $node = $server->getRelation('node');

        $this->cache->put('Server:Backup:Downloads:' . $token, ['server' => $server->uuid, 'path' => $check[0]->file, 'name' => $check[0]->name], 5);

        return redirect(sprintf('%s://%s:%s/v1/server/backup/download/%s', $node->scheme, $node->fqdn, $node->daemonListen, $token));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function restore(Request $request): JsonResponse
    {
        $server = $request->attributes->get('server');
        $this->setRequest($request)->injectJavascript();

        $id = (int) $request->input('id');

        $check = DB::table('backups')->where('id', '=', $id)->where('server_id', '=', $server->id)->get();
        if (count($check) < 1)
            return response()->json(['success' => false, 'error' => 'Backup não encontrado!']);

        isset($this->folders[$server->egg_id]) ? $folder = $this->folders[$server->egg_id] : $folder = '/';

        $response = $this->backupRepository->setServer($server)->restore([
            'name' => $check[0]->file,
            'folder' => $folder
        ]);

        if (json_decode($response->getBody())->success != true)
            return response()->json(['success' => false]);

        DB::table('servers')->where('id', '=', $server->id)->update(['suspended' => '1']);

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(Request $request): JsonResponse
    {
        $server = $request->attributes->get('server');
        $this->setRequest($request)->injectJavascript();

        $id = (int) $request->input('id');

        $check = DB::table('backups')->where('server_id', '=', $server->id)->where('id', '=', $id)->get();
        if (count($check) < 1)
            return response()->json(['success' => false, 'error' => 'Backup não encontrado!']);

        $response = $this->backupRepository->setServer($server)->delete([
            'name' => $check[0]->file
        ]);

        if (json_decode($response->getBody())->success != true)
            return response()->json(['success' => false]);

        DB::table('backups')->where('server_id', '=', $server->id)->where('id', '=', $id)->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
