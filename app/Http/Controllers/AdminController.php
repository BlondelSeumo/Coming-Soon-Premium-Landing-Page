<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Background;
use App\Setting;
use Illuminate\Support\Facades\Storage;
use App\subscription;

class AdminController extends Controller
{
    public function index(Request $request)
    {

        $setnewlaunchdate = Setting::where('name', 'launch_date')->get()->first();
        $sethomemessage = Setting::where('name', 'home_message')->get()->first();
        $setbrandmessage = Setting::where('name', 'brand_message')->get()->first();
        $setfb= Setting::where('name', 'fb_page')->get()->first();
        $setgplus = Setting::where('name', 'gplus_page')->get()->first();
        $settw = Setting::where('name', 'tw_page')->get()->first();
        $setinsta = Setting::where('name', 'insta_page')->get()->first();

        $images = Background::all();

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'date' => 'required|date',
            ]);

            $this->upload();
            $this->socialPages();

            foreach ($images as $img) {
                $img->active = request()->get('background') == $img->id ? 1 : 0;
                $img->save();
            }
        
            $dt = Setting::where('name', 'launch_date')->update(['value' => request()->get('date')]);
            $homemessage = Setting::where('name', 'home_message')->update(['value' => request()->get('homemessage')]);
            $brandmessage = Setting::where('name', 'brand_message')->update(['value' => request()->get('brandmessage')]);

            $request->session()->flash('alert-success', 'Your page sucessfully updated!!');

            return back();
        }

        return view('admin', ['images' => $images, 'fb_page' => $setfb, 'gplus_page'  => $setgplus, 'tw_page' => $settw, 'insta_page' => $setinsta, 'launch_date' => $setnewlaunchdate, 'home_message' => $sethomemessage, 'brand_message' => $setbrandmessage]);
    }

    protected function upload()
    {

        $request = request();
        
        if ($request->hasFile('filetoupload')) {
            $file = $request->file('filetoupload');


            if ($file->isValid()) {
                $fileName = Storage::disk('backgrounds')->put('', $file);
                $bg = new Background;
                $bg->image = $fileName;
                $bg->active = 0;
                $bg->save();
            }
        }
    }

    public function deleteBackground($id)
    {

        $dbg = Background::find($id);
        $dbg->delete();

        return redirect()->back();
    }

    // List all subscribers from database
    public function listAllSubs()
    {

        $listsubs = Subscription::paginate(15);

        return view('adminlist', ['listsubs' => $listsubs]);
    }

    public function socialPages()
    {

        $fb = Setting::where('name', 'fb_page')->update(['value' => request()->get('facebook_page', '')]);
        $gplus = Setting::where('name', 'gplus_page')->update(['value' => request()->get('gplus_page', '')]);
        $tw = Setting::where('name', 'tw_page')->update(['value' => request()->get('twitter_page', '')]);
        $insta = Setting::where('name', 'insta_page')->update(['value' => request()->get('instagram_page', '')]);
    }

    public function download()
    {

        $listsubs = Subscription::all();
        $fileName = 'subscription-list.csv';
 
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Description: File Transfer');
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename={$fileName}");
        header("Expires: 0");
        header("Pragma: public");

        $fh = fopen('php://output', 'w');
        $results = [];

        foreach ($listsubs as $subscriber) {
            $results[] = [
                $subscriber->name,
                $subscriber->email
            ];
        }
        foreach ($results as $data) {
            fputcsv($fh, $data);
        }
        fclose($fh);
        exit;
    }
}
