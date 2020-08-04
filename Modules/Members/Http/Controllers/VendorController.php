<?php

namespace Modules\Members\Http\Controllers;

use App\Vendor;
use App\VendorAccountBank;
use Intervention\Image\Facades\Image;
use App\VendorPackage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Admin\Entities\Banks;
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
        $usertype = Auth::user()->usertype;
        if ($usertype == 'customer') {
            return redirect("/");
        }
        $vendor = Vendor::where('user_id', Auth::id())->first();
        return redirect("/manage-vendor", ['vendor' => $vendor]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $usertype = Auth::user()->usertype;
        if ($usertype == 'customer') {
            return redirect("/");
        }

        $vendor = Vendor::where('user_id', Auth::id())->first();
        if ($vendor) {
            return redirect("/manage-vendor", ['vendor' => $vendor]);
        } else if ($vendor && $vendor->is_confirm == 0) {
            return view('members::vendor_create', ['is_confirm' => 'waitting']);
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
        if ($vendor) {
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
        $usertype = Auth::user()->usertype;
        if ($usertype == 'customer') {
            return redirect("/");
        }
        $vendor = Vendor::where("user_id", Auth::id())->first();
        if (!$vendor) {
            return redirect("/");
        }
        if ($vendor && $vendor->is_confirm == 0) {
            return view('members::vendor_create', ['is_confirm' => 'waitting']);
        }
        $package = VendorPackage::where('vendor_id', $vendor->id)->get();
        $bankAccount = $vendor->bank;
        $listBank = Banks::all();
        return view("members::manage_vendor", ['vendor' => $vendor, 'packages' => $package, 'bankAccount' => $bankAccount, 'listBank' => $listBank]);
    }

    public function storeAlbum(Request $request) {
        $validate = $request->validate([
            'title' => 'required'
        ]);

        $album = new AlbumWedding();
        $album->title_photo = $validate['title'];

        $banner = $request->file('banner_album');
        if ($banner !== null) {
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

    public function destroyAlbum($id) {
        $album = AlbumWedding::find($id);
        return $album->delete();
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
    public function edit($id, Request $request)
    {
        $validate = $request->validate([
            'vendor_name' => 'required',
            'vendor_about' => 'required',
            'vendor_phone' => 'required',
            'vendor_address' => 'required',
            'vendor_photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'vendor_banner' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $vendor = Vendor::find($id);
        $vendorPhoto = $request->file('vendor_photo');
        $vendorBanner = $request->file('vendor_banner');
        $vendorPhotoDestination = public_path("/images/vendor");
        if ($vendorPhoto !== null) {
            $photoName = "vendor_".$vendor->id."_photo.jpeg";
            $photoNameThumb = "thumbnail_".$photoName;            
            $imgVendor = Image::make($vendorPhoto->path());
            $imgVendor->resize(50, 40, function($constraint) {
                $constraint->aspectRatio();
            })->save($vendorPhotoDestination."/".$photoNameThumb, null, "jpg");
            $vendorPhoto->move($vendorPhotoDestination, $photoName);
        }

        if ($vendorBanner !== null) {
            $photoName = "vendor_".$vendor->id."_banner.png";
            $photoNameThumb = "thumbnail_".$photoName;           
            $imgVendor = Image::make($vendorBanner->path());
            $imgVendor->resize(253, 90, function($constraint) {
                $constraint->aspectRatio();
            })->save($vendorPhotoDestination."/".$photoNameThumb, null, "png");
            $vendorBanner->move($vendorPhotoDestination, $photoName);
        }

        $vendor->vendor_name = $request->input('vendor_name');
        // create slug for vendor
        $vendorname = strtolower($vendor->vendor_name);
        $slug = sprintf("%s-%s", $vendor->user_id, str_replace(" ", "-",$vendorname));
        $vendor->vendor_slug = $slug;
        $vendor->vendor_about = $request->input('vendor_about');
        $vendor->vendor_phone = $request->input('vendor_phone');
        $vendor->vendor_address = $request->input('vendor_address');

        return $vendor->save();
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

    public function showVendor($slug) {
        $usertype = Auth::user()->usertype;
        if ($usertype == 'vendor') {
            return redirect("members/manage-vendor");
        }
        $vendor = Vendor::where('vendor_slug', $slug)->first();
        return view("members::show_vendor", ['vendor' => $vendor]);
    }

    public function checkUserHave(Request $request) {
        $vendor = Vendor::where('user_id', $request->input('user_id'))->first();
        if ($vendor == null) {
            return false;
        }

        return true;
    }

    public function editBankAccount($vendor_id, Request $request) {
        $bankAccount = VendorAccountBank::where('vendor_id', $vendor_id)
                                        ->get()
                                        ->first();
        if ($bankAccount == null) {
            $bankAccount = new VendorAccountBank();
        }

        $bankAccount->bank_id = $request->input('bank_code');
        $bankAccount->bank_account_number = $request->input('account_number');
        $bankAccount->vendor_id = $vendor_id;
        $bankAccount->is_active = 1;

        return $bankAccount->save();
    }
}
