<?php

namespace BFACP\Http\Controllers\Admin\Adkats;

use BFACP\Adkats\Setting;
use BFACP\Battlefield\Server\Server;
use BFACP\Http\Controllers\Controller;

/**
 * Class SettingsController.
 */
class SettingsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');

        $this->middleware('permission:admin.adkats.settings.view', [
            'only' => [
                'index',
            ],
        ]);

        $this->middleware('permission:admin.adkats.settings.edit', [
            'except' => [
                'index',
            ],
        ]);
    }

    /**
     * @return $this
     */
    public function index()
    {
        $servers = Server::all();

        return view('admin.adkats.settings.index', compact('servers'))->with('page_title',
            'AdKats Settings Server List');
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function edit($id)
    {
        $settings = Setting::where('server_id', $id)->get();

        return view('admin.adkats.settings.edit', compact('settings'))->with('page_title',
            sprintf('AdKats Settings for #%s', $id));
    }
}
