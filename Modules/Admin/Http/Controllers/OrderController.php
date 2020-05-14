<?php

namespace Modules\Admin\Http\Controllers;

use App\Order;
use App\ProgressOrder;
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
    public function index(Request $request)
    {
        $status = $request->query('status');
        if ($status == 'unpaid' || $status == 'paid') {
            return ['data' => $this->getListOrderUnpaid($status)];
        } else if ($status == 'confirmation') {
            return ['data' => $this->getListOrderToConfirm()];
        }
        return view('admin::order');
    }

    public function detail($id) {
        $order = Order::find($id);
        $order->total_price = number_format($order->total_price, 2, ',', '.');
        return view('admin::detail_order', ['order' => $order]);
    }

    public function getListOrderUnpaid($status) {
        $orders = Order::where('payment_status', $status)->get();
        foreach($orders as $order) {
            $user = $order->user;
            $user->password = "";
            $package = $order->package;
            $vendor = $package->vendor;

        }
        
        return $orders;
    }

    public function getListOrderToConfirm() {
        $orders = Order::where('payment_status', 'confirmation')->get();
        foreach($orders as $order) {
            $order->total_price = number_format($order->total_price, 2, ',', '.');
            $user = $order->user;
            $user->password = "";
            $package = $order->package;
            $vendor = $package->vendor;
            $confirmation = $order->confirmation()->orderBy('id', 'desc')->first();
            $order->payment_proof = $confirmation->payment_proof_img;
        }
        
        return $orders;
    }

    public function confirmation(Request $request, $id) {
        $order = Order::find($id);
        $confirmation = $request->input('confirmation');
        $orderProgress = new ProgressOrder();
        $orderProgress->order_id = $id;
        $orderProgress->user_id = Auth::user()->id;
        if ($confirmation == 'true') {
            $order->payment_status = "paid";
            $orderProgress->progress_order = "payment confirmation";
        } else {
            $order->payment_status = "unpaid";
            $orderProgress->progress_order = "payment reject";
        }
        $orderProgress->save();
        return $order->save();
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
        //
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
