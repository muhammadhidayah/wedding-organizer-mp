<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Banks;

class BanksController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $json = $request->query('data');
        if ($json != "") {
            $banks = Banks::all(["id","bank_name","bank_code"]);

            return ['data' => $banks];
        }        
        return view('admin::banks');
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
        $validateData = $request->validate([
            'bank_code' => 'required|unique:list_bank',
            'bank_name' => 'required'
        ]);

        $bank = new Banks();
        $bank->bank_code = $validateData['bank_code'];
        $bank->bank_name = $validateData['bank_name'];
        
        return $bank->save();
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
        $bank = Banks::findOrFail($id);
        return view('admin::editbank', ['bank' => $bank]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'bank_code' => 'required|unique:list_bank,bank_code,'.$id.',id',
            'bank_name' => 'required'
        ]);

        $bank = Banks::find($id);
        $bank->bank_code = $validateData['bank_code'];
        $bank->bank_name = $validateData['bank_name'];
        return $bank->save();
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
