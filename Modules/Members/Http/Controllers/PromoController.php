<?php

namespace Modules\Members\Http\Controllers;

use App\PivotPromoPackage;
use App\VendorPromo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('members::index');
    }

    public function list($vendor_id) {
        $promos = VendorPromo::where('vendor_id', $vendor_id)->get();
        foreach($promos as $promo) {
            $promo->packages;
        }

        return ['data' => $promos];
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
        $validator = $request->validate([
            'title' => 'required|string',
            'discount' => 'required|numeric|max:100|min:0',
            'duration_date' => 'required'
        ]);

        $duration = $request->input('duration_date');
        $duration = explode(" - ", $duration);
        $startDate = date("Y-m-d", strtotime($duration[0]));
        $endDate = date("Y-m-d", strtotime($duration[1]));

        $promo = new VendorPromo();
        $promo->title_promo = $request->input('title');
        $promo->discount_promo = $validator['discount'];
        $promo->start_date = $startDate;
        $promo->end_date = $endDate;
        $promo->vendor_id = $request->input('vendor_id');
        $promo->save();

        $promoMap = new PivotPromoPackage();
        $promoMap->promo_id = $promo->id;
        $promoMap->package_id = $request->input('package_list');
        
        return $promoMap->save();
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
        $promo = VendorPromo::find($id);
        return $promo->delete();
    }
}
