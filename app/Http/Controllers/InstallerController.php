<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Artisan;

class InstallerController extends Controller
{
    public function index()
    {
        Artisan::call('key:generate');
        Artisan::call('migrate');
        Artisan::call('db:seed', [
            '--class' => 'SettingsTableSeeder',
        ]);

        return redirect()->to('/');
    }
}
