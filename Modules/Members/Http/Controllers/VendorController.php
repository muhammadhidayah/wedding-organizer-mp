<?php

namespace Modules\Members\Http\Controllers;

use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Members\Entities\AlbumWedding;
use Modules\Members\Entities\CollectionPhotoAlbum;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $vendor = Vendor::where('user_id', Auth::id())->first();
        return redirect("/manage-vendor", ['vendor' => $vendor]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $vendor = Vendor::where('user_id', Auth::id())->first();
        if (count($vendor) > 0) {
            return redirect("/manage-vendor", ['vendor' => $vendor]);
        }

        return view('members::vendor_create');        
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $vendor = Vendor::where('user_id', Auth::id())->first();
        if (count($vendor->get()) > 0) {
            $vendor = Vendor::where('user_id', Auth::id())->first();
            return redirect("/manage-vendor", ['vendor' => $vendor]);
        }

        $validate = $request->validate([
            'vendor_name' => 'required',
            'vendor_address' => 'required',
            'number_phone' => 'required',
            'vendor_about' => 'required'
        ]);

        $vendor = new Vendor();
        $vendor->vendor_name = $validate['vendor_name'];
        $vendor->vendor_address = $validate['vendor_address'];
        $vendor->vendor_phone = $validate['number_phone'];
        $vendor->vendor_about = $validate['vendor_about'];
        $vendor->user_id = Auth::id();
        
        // create slug for vendor
        $vendorname = strtolower($vendor->vendor_name);
        $slug = sprintf("%s-%s", $vendor->user_id, str_replace(" ", "-",$vendorname));
        $vendor->vendor_slug = $slug;
        return $vendor->save();
    }

    public function manage() {
        $vendor = Vendor::where("user_id", Auth::id())->first();
        return view("members::manage_vendor", ['vendor' => $vendor]);
    }

    public function storeAlbum(Request $request) {
        $validate = $request->validate([
            'title' => 'required'
        ]);

        $album = new AlbumWedding();
        $album->title_photo = $validate['title'];

        $banner = $request->file('banner_album');
        if ($banner !== null) {
            return "masuk sini";
            $banner_name = $banner->store('');
            $res = $banner->move('images/wedding/banner', $banner_name);
            $album->banner_album = $banner_name;
        }

        $vendor = Vendor::where('user_id', Auth::id())->first();
        $album->vendor_id = $vendor->id;
        $albumTitle = strtolower($validate['title']);
        $albumTitle = str_replace(" ", "-", $albumTitle);
        $albumTitle = $vendor->id . "-" . $albumTitle;
        $album->album_slug = $albumTitle;
        $album->save();

        return $album->id;
    }

    public function storePhotoAlbum(Request $request) {
        $photoCollection = new CollectionPhotoAlbum();
        $photoCollection->vendor_photo_id = $request->input('album_id');
        $photo = $request->file('file');
        $photoName = str_replace(" ", "-", $photo->getClientOriginalName());
        $photoCollection->photo = $photoName;
        $photoCollection->save();
        $photoCollection->photo = $photoCollection->id . "-" . $photoName;
        $photo->move('images/wedding/photos', $photoCollection->photo);
        return $photoCollection->save();
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

    public function listalbum(Request $request) {
        $albums = AlbumWedding::where('vendor_id', $request->query('vendor_id'))->get();
        foreach($albums as $photo) {
            $photos = $photo->photos;
        }

        return ['data' => $albums];
    }
}
