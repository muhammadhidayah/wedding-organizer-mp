<?php

namespace Modules\Members\Http\Controllers;

use App\Users;
use App\Vendor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $vendor = Vendor::all();
        return view('members::listvendor', ['vendors' => $vendor]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('members::register');
    }

    public function auth(Request $request) {
        $validate = $request->validate([
            'username' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $validate['username'], 'password' => $validate['password'] ])) {
            return redirect("/");
        }

        return response("", 401);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone_number' => 'required|numeric|unique:users,mobile_phone',
            'password' => 'required|string|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect('members/register')
                    ->withErrors($validator)
                    ->withInput();
        }

        $user = new Users();
        $user->name = $request->input('fullname');
        $user->email = $request->input('email');
        $user->mobile_phone = $request->input('phone_number');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')

        ]);

        return redirect("members");
    }

    public function viewprofile() {
        $user = Auth::user();
        return view('members::profile', ['user' => $user]);
    }

    public function updateprofile(Request $request) {
        $user = Users::find(Auth::user()->id);
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => [ 'required', 'string', 'email','max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone_number' => [ 'required', 'numeric' , Rule::unique('users', 'mobile_phone')->ignore($user->id)],
        ]);

        if ($validator->fails()) {
            return view('members::profile', ['user' => $user])->withErrors($validator);
        }

        $pp = $request->file('profile_picture');
        if ($pp !== null) {
            $name = $pp->store('');
            $request->file('profile_picture')->move('images/profile', $name);
            $user->user_photo = $name;
        }

        if ($request->input('password')) {
            $validator = Validator::make($request->all(), [
                'password' => 'string|min:8|confirmed'
            ]);

            if ($validator->fails()) {
                return view('members::profile', ['user' => $user])->withErrors($validator);
            }

            $user->password = Hash::make($request->input('password'));
        }

        $user->name = $request->input('fullname');
        $user->email = $request->input('email');
        $user->mobile_phone = $request->input('phone_number');
        $user->save();

        return redirect("members/profile");

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

    public function logout() {
        Auth::logout();
        return redirect('members/home');
    }
}
