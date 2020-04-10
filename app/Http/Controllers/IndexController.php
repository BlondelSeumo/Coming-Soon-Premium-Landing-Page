<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Background;
use App\Subscription;
use App\Setting;
use Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class IndexController extends Controller
{
    public function index()
    {
        $fb = Setting::where('name', 'fb_page')->get()->first();
        $gplus = Setting::where('name', 'gplus_page')->get()->first();
        $tw = Setting::where('name', 'tw_page')->get()->first();
        $insta = Setting::where('name', 'insta_page')->get()->first();
        $newlaunchdate = Setting::where('name', 'launch_date')->get()->first();
        $homemessage = Setting::where('name', 'home_message')->get()->first();
        $brandmessage = Setting::where('name', 'brand_message')->get()->first();

        $image = Background::where('active', 1)->get();

        return view('index', ['image' => $image->first(), 'fb_page' => $fb, 'gplus_page'  => $gplus, 'tw_page' => $tw, 'insta_page' => $insta, 'launch_date' => $newlaunchdate, 'home_message' => $homemessage, 'brand_message' => $brandmessage]);
    }

    public function saveSubs()
    {
        if (request()->isMethod('post')) {
            $validator = Validator::make(request()->all(), [
            'email' => 'required|email|unique:subscriptions,email',
            'name' => 'required'
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json($errors);
            }

            $sub = new Subscription;
            $sub->name = request()->get('name');
            $sub->email = request()->get('email');
            $sub->save();

            return response()->json(['success' => true]);
        }
    }
}
