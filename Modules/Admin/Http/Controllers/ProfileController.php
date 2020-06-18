<?php

namespace Modules\Admin\Http\Controllers;

use App\Users;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('admin::profile', $user);
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
        $user = Users::find($request->input('id'));
        $picture = $request->file('profile_picture');
        if($picture !== null) {
            $name = $picture->store('');
            $res = $request->file('profile_picture')->move('images/profile', $name);
            $user->user_photo = $name;
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->mobile_phone = $request->input('mobile_phone');
        if ($request->input('password') !== "") {
            $password = Hash::make($request->input('password'));
            $user->password = $password;
        }
        
        $user->save();        
        return view('admin::profile', $user);
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
