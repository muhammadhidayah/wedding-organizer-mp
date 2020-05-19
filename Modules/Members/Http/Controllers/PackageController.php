<?php

namespace Modules\Members\Http\Controllers;

use App\VendorPackage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('members::index');
    }

    public function list(Request $request) {
        $package = VendorPackage::where('vendor_id', $request->input('vendor_id'))->get();
        return ['data' => $package];
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('members::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store($vendor_id, Request $request)
    {
        $validate = $request->validate([
            "package_title" => 'required',
            "detail_package" => 'required',
            "price_package" => 'required|numeric'
        ]);

        $package = new VendorPackage();
        $package->title_package = $validate['package_title'];
        $package->detail_package = $validate['detail_package'];
        $package->price_package = $validate['price_package'];
        $package->vendor_id = $vendor_id;

        return $package->save();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('members::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('members::edit');
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
