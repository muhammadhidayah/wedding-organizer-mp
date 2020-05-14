<?php

namespace Modules\Admin\Http\Controllers;

use App\Users;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class ListAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $json = $request->query('data');
        if ($json != "") {
            $listadmin = Users::where('usertype', 'admin')->get();
            return ['data' => $listadmin];
        }
        return view('admin::list_admin');
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
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8',
            'mobile_phone' => 'required|unique:users'
        ]);

        return Users::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'password' => Hash::make($validateData['password']),
            'usertype' => 'admin',
            'status_user' => 'registered',
            'mobile_phone' => $validateData['mobile_phone']
        ]);
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
        $user = Users::findOrFail($id);
        return view('admin::editadmin', ['user' => $user]);
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
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id.',id|email',
            'mobile_phone' => 'required|unique:users,mobile_phone,'.$id.',id'
        ]);

        $user = Users::find($id);
        $user->name = $validateData['name'];
        $user->email = $validateData['email'];
        if(isset($validateData['password'])) {
            $user->password = Hash::make($validateData['password']);
        }
        $user->mobile_phone = $validateData['mobile_phone'];

        return $user->save();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = Users::find($id);
        return $user->delete();
    }
}
