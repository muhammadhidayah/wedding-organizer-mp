<?php

namespace Modules\Members\Http\Controllers;

use App\Order;
use App\PaymentConfirmation;
use App\ProgressOrder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
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
    public function store($id, Request $request)
    {
        $validator = $request->validate([
            'proof_of_payment' => 'required|mimes:jpeg,bmp,png'
        ]);
        
        $user = Auth::user();
        $order = Order::where('id', $id)
                        ->where('user_id', $user->id)->get()->first();
        
        if ($order === null) {
            return response('', 400);
        }

        $paymentProofImg = $request->file('proof_of_payment');
        $order->payment_status = "confirmation";
        $order->save();
        $paymentProof = new PaymentConfirmation();
        $paymentProof->order_id = $id;
        $paymentProof->user_id = $user->id;
        $paymentProof->payment_proof_img = "temp.jpeg";
        $paymentProof->save();
        
        $imgName = "payment_proof_".$paymentProof->id."_".$order->id.".".$paymentProofImg->extension();
        $paymentProofImg->move("images/payment", $imgName);

        $paymentProof->payment_proof_img = $imgName;
        $paymentProof->save();

        $progressOrder = new ProgressOrder();
        $progressOrder->progress_order = "payment confirmation";
        $progressOrder->order_id = $order->id;
        $progressOrder->user_id = $user->id;

        return $progressOrder->save();        
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
