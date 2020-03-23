<?php

namespace Pterodactyl\Http\Controllers\Server\Settings;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Repositories\Daemon\VersionRepository;
use Pterodactyl\Traits\Controllers\JavascriptInjection;
use Illuminate\Support\Facades\DB;

class VersionController extends Controller
{
    use JavascriptInjection;

    /**
     * @var \Prologue\Alerts\AlertsMessageBag
     */
    private $alert;

    protected $versionRepository;

    /**
     * VersionController constructor.
     * @param AlertsMessageBag $alert
     * @param VersionRepository $versionRepository
     */
    public function __construct(AlertsMessageBag $alert, VersionRepository $versionRepository)
    {
        $this->alert = $alert;
        $this->versionRepository = $versionRepository;
    }

    public function index(Request $request): View
    {
        $server = $request->attributes->get('server');
        $this->authorize('view-fastdownload', $server);
        $this->setRequest($request)->injectJavascript();

        $versions = $this->versionRepository->setServer($server)->get();

        if (json_decode($versions->getBody())->success != true) {
            $files = [];
        } else {
            $files = json_decode($versions->getBody())->versions;
        }

        return view('server.settings.version', [
            'versions' => $files,
            'nowVersion' => $server->version
        ]);
    }

    public function switch(Request $request): RedirectResponse
    {
        $server = $request->attributes->get('server');
        $this->setRequest($request)->injectJavascript();

        $version = trim(strip_tags($request->input('version')));

        $switch = $this->versionRepository->setServer($server)->switch([
            'version' => $version
        ]);

        if (json_decode($switch->getBody())->success != true) {
            $this->alert->danger('Falha na alteração de versão!')->flash();
        } else {
            DB::table('servers')->where('id', '=', $server->id)->update(['version' => $version]);

            $this->alert->success('Alteração realizada com sucesso! Por favor, reinicie o seu servidor.')->flash();
        }

        return redirect()->route('server.settings.version', $server->uuidShort);
    }
}
