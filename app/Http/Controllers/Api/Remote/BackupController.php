<?php

namespace Pterodactyl\Http\Controllers\Api\Remote;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Pterodactyl\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BackupController extends Controller
{
    private $cache;

    /**
     * BackupController constructor.
     * @param CacheRepository $cache
     */
    public function __construct(CacheRepository $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $server_uuid = $request->input('server_uuid');

        $server = DB::table('servers')->where('uuid', '=', $server_uuid)->get();
        if (count($server) < 1)
            return response()->json(['success' => false]);

        if ($server[0]->suspended != 1)
            return response()->json(['success' => false, 'error' => 'Server not suspended. ' . $server_uuid]);

        DB::table('servers')->where('uuid', '=', $server_uuid)->update(['suspended' => '0']);

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function verify(Request $request): JsonResponse
    {
        $download = $this->cache->pull('Server:Backup:Downloads:' . $request->input('token', ''));

        if (is_null($download)) {
            throw new NotFoundHttpException('No file was found using the token provided.');
        }

        return response()->json([
            'path' => array_get($download, 'path'),
            'server' => array_get($download, 'server'),
            'name' => array_get($download, 'name')
        ]);
    }

}
