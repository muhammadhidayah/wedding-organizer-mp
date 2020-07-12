<?php

namespace Modules\Members\Http\Controllers;

use App\Order;
use App\ProgressOrder;
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
        $promo = $package->promo->first();
        if ($promo) {
            $discount = $promo->discount_promo / 100 * $package->price_package;
            $order->total_price = $package->price_package - $discount;
            $order->promo_id = $promo->id;
        }
        
        $date = date("Y-m-d");
        $vendor = Vendor::find($request->input('vendor_id'));

        // calculate dp
        $dp = ($package->dropdown_paymenl_val / 100) * $package->price_package;
        $order->down_payment_val = $dp;

        $order->vendor_id = $vendor->id;
        $order->inv_number = "INV/".$date."/".$vendor->vendor_slug."/".time();

        return $order->save();
    }

    public function listOrder(Request $request) {
        $payment_status = $request->query('payment_status');
        if ($payment_status != "") {
            $orders = [];
            if (is_array($payment_status) && count($payment_status) > 1) {
                $orders = Order::whereIn('payment_status', $payment_status)
                            ->where('user_id', Auth::user()->id)
                            ->get();
            } else {
                $orders = Order::where('payment_status', $payment_status)
                            ->where('user_id', Auth::user()->id)
                            ->get();
            }
            
            $progress = $request->query('progress');
            $resp = [];
            foreach($orders as $key => $order) {
                $progressOrder = $order->progress()->where('progress_order', 'completed')->get();
                if ($progress == 'completed') {
                    if (count($progressOrder) <= 0) {
                        continue;
                    }                    
                    $order->progress = $progressOrder->first();
                } else if ($progress !== "completed" && $payment_status == "paid") {
                    if (count($progressOrder) > 0) {
                        unset($orders[$key]);
                        continue;
                    }
                }
                
                if (is_array($payment_status) && in_array('down_payment', $payment_status)) {
                    $order->progress = $order->progress()->orderBy('id','desc')->first();
                    if (!is_null($order->progress) && $order->payment_status == 'down_payment' && $order->progress->progress_order != 'waitting full payment') {
                        unset($orders[$key]);
                        continue;
                    }
                }
                $order->package;
                $order->total_price = number_format($order->total_price, 0, ",", ".");
                $order->package->vendor;
                $resp[] = $order;
            }

            return ['data' => $resp];
        }
        return view('members::list_order');
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

    public function completeOrder($id) {
        $user = Auth::user();
        $progress = new ProgressOrder();
        $progress->progress_order = "completed";
        $progress->order_id = $id;
        $progress->user_id = $user->id;

        return $progress->save();
    }

    public function listOrderVendor($id, Request $request) {
        $vendor = Vendor::find($id);
        $orders = $vendor->orders()->whereIn('payment_status', ['paid','down_payment'])->get();
        $resp = [];
        foreach($orders as $key => $order) {
            $progressOrder = $order->progress()->where('progress_order', 'completed')->get();
            if($request->query('progress') != "completed") {
                if (count($progressOrder) > 0) {
                    continue;
                }
            } else if ($request->query('progress') == "completed") {
                if (count($progressOrder) <= 0) {
                    continue;
                }
            }
            $order->package;
            $order->user;
            $resp[] = $order;
        }

        return ['data' => $resp];
    }

    public function orderDetail($id, $order_id, Request $request) {
        $order = Order::find($order_id);
        $order->total_price = number_format($order->total_price, 0, ",", ".");
        

        if ($request->query('json')) {
            $progres = $order->progress()->orderBy('id','desc')->first();
            return [
                'order' => $order, 
                'progress' => $progres
            ];
        }

        $package = $order->package;
        $user = $order->user;
        $vendor = Vendor::find($id);
        
        return view("members::order_detail", [
            'order' => $order, 
            'vendor' => $vendor,
            'user' => $user,
            'package' => $package
        ]);
    }

    public function completePaymentCustomer($order_id) {
        $user = Auth::user();
        $progress = new ProgressOrder();
        $progress->progress_order = "waitting full payment";
        $progress->order_id = $order_id;
        $progress->user_id = $user->id;
        return $progress->save();
    }
}
