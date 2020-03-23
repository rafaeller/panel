<?php

namespace Pterodactyl\Http\Middleware\Server;

use Closure;
use Illuminate\Http\Request;
use Pterodactyl\Contracts\Repository\DatabaseRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IsMinecraftServer
{
    /**
     * @var \Pterodactyl\Contracts\Repository\DatabaseRepositoryInterface
     */
    private $repository;

    /**
     * DatabaseAccess constructor.
     *
     * @param \Pterodactyl\Contracts\Repository\DatabaseRepositoryInterface $repository
     */
    public function __construct(DatabaseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(Request $request, Closure $next)
    {
        $server = $request->attributes->get('server');
        $egg_id = $server->egg_id;

        // Minecraft server egg ids
        $egg_ids = [2, 3, 4, 5];

        if (!in_array($egg_id, $egg_ids))
            throw new NotFoundHttpException;

        return $next($request);
    }
}
