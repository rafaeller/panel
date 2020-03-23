<?php

namespace Pterodactyl\Repositories\Daemon;

use Psr\Http\Message\ResponseInterface;

class VersionRepository extends BaseRepository
{
    /**
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(): ResponseInterface
    {
        return $this->getHttpClient()->request('GET', 'server/version');
    }

    /**
     * @param array $data
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function switch(array $data): ResponseInterface
    {
        return $this->getHttpClient()->request('POST', 'server/version', [
            'json' => $data,
        ]);
    }
}
