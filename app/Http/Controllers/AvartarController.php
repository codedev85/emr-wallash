<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\User;
use Illuminate\Support\Facades\Storage;
use Auth;

class AvartarController extends Controller
{


    public function upload($id){

        $userId = User::where('id',$id)->firstorfail();
      
        return view('Avatar.file')->with('userId',$userId);
    }

    public function uploadAvatar(Request $request, $avatar){


        if ($request->hasFile('avatar')) {

            $this->validate($request, [
                'avatar' => 'required|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=193,min_height=262',
            ]);


            $image =  $request->file('avatar');
            $ext = $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $resize = Image::make($image_resize)->fit(268, 249)->encode($ext);
            $hash = md5($resize->__toString());
            $path = "{$hash}.$ext";
            $url = 'avatar/'.$path;
            // dd($url);
            Storage::put($url, $resize->__toString());
            // dd($url);

            User::where('id',$avatar)->update([
                'avatar'         =>  $url,
            ]);

            alert()->success('Image Added Successfully', 'Successful')->autoclose(5000);
           // return back();
             return redirect('dashboard');
            
        }else{

            alert()->error('Image dimension is too large', 'Oops!!')->autoclose(3000);

            return back();

        }

}

}
