<?php

namespace Modules\Admin\Http\Controllers;

use App\Config;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Banks;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $config = Config::find(1);
        $banks = Banks::all();
        return view('admin::config_index', ['config' => $config, 'listBank' => $banks]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {

        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $config = Config::find($request->input('id'));
        $picture = $request->file('logo_app');
        if ($picture !== null) {
            $name = $picture->store('');
            $res = $picture->move('images/apps', $name);
            $config->logo_app = $res;
        }

        $config->app_name = $request->input('app_name');
        $config->app_description = $request->input('app_description');
        $config->app_about = $request->input('app_about');
        $config->app_address = $request->input('app_address');
        $config->phone_number = $request->input('phone_number');
        $config->account_number = $request->input('account_number');
        $config->bank_id = $request->input('bank_code');
        $config->save();

        return redirect()->route("admin.config");
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('admin::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
