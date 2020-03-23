<?php

namespace Pterodactyl\Repositories\Daemon;

use Psr\Http\Message\ResponseInterface;

class ServerTransferRepository extends BaseRepository
{
    /**
     * @param array $data
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function start(array $data): ResponseInterface
    {
        return $this->getHttpClient()->request('POST', 'server/servertransfer/start', [
            'json' => $data,
        ]);
    }

    /**
     * @param array $data
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function download(array $data): ResponseInterface
    {
        return $this->getHttpClient()->request('POST', 'server/servertransfer/load', [
            'json' => $data,
        ]);
    }
}
