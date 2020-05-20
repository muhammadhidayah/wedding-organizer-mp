<?php

namespace Modules\Members\Http\Controllers;

use App\Order;
use App\Vendor;
use App\VendorPackage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('members::index');
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
    public function store(Request $request)
    {
        $package = VendorPackage::find($request->input('package_id'));

        $order = new Order();
        $order->wedding_date = $request->input('wedding_date');
        $order->address = $request->input('address');
        $order->package_id = $request->input('package_id');
        $order->user_id = Auth::id();
        $order->total_price = $package->price_package;
        $date = date("Y-m-d");
        $vendor = Vendor::find($request->input('vendor_id'));
        $order->inv_number = "INV/".$date."/".$vendor->vendor_slug."/".time();

        return $order->save();
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
