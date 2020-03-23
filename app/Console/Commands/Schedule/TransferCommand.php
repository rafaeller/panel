<?php
/**
 * Pterodactyl - Panel
 * Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com>.
 *
 * This software is licensed under the terms of the MIT license.
 * https://opensource.org/licenses/MIT
 */

namespace Pterodactyl\Console\Commands\Schedule;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Pterodactyl\Models\Server;
use Pterodactyl\Repositories\Daemon\ServerTransferRepository;
use Pterodactyl\Services\Servers\SuspensionService;

class TransferCommand extends Command
{
    /**
     * @var string
     */
    protected $description = 'Check server transfer: Compressing and installing completed';

    /**
     * @var string
     */
    protected $signature = 'p:schedule:servertransfer';

    protected $serverTransferRepository;
    protected $suspensionService;

    /**
     * TransferCommand constructor.
     * @param ServerTransferRepository $serverTransferRepository
     * @param SuspensionService $suspensionService
     */
    public function __construct(ServerTransferRepository $serverTransferRepository, SuspensionService $suspensionService)
    {
        parent::__construct();

        $this->serverTransferRepository = $serverTransferRepository;
        $this->suspensionService = $suspensionService;
    }

    /**
     * Handle command execution.
     */
    public function handle()
    {
        $servers = DB::table('server_transfers')->where('status', '=', '2')->get();

        foreach ($servers as $server) {
            $serverData = DB::table('servers')->where('id', '=', $server->new_server_id)->get();
            $oldServerData = DB::table('servers')->where('id', '=', $server->old_server_id)->get();
            if (count($serverData) > 0) {
                if ($serverData[0]->installed == 1) {
                    DB::table('server_transfers')->where('id', '=', $server->id)->update([
                        'status' => 3
                    ]);

                    $srv = json_decode(json_encode($serverData[0]), true);
                    $srv = new Server($srv);

                    $node = DB::table('nodes')->where('id', '=', $oldServerData[0]->node_id)->first();

                    $this->serverTransferRepository->setServer($srv)->download([
                        'url' => sprintf('%s://%s:%s/v1/server/servertransfer/download/%s/%s', $node->scheme, $node->fqdn, $node->daemonListen, $node->daemonSecret, $oldServerData[0]->uuid),
                        'transfer_id' => $server->id,
                        'uuid' => $oldServerData[0]->uuid
                    ]);
                }
            } else {
                DB::table('server_transfers')->where('id', '=', $server->id)->delete();
            }
        }
    }
}
