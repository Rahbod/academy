<?php

namespace App\Http\Controllers;


use Artisan;
use Session;

class DevController extends Controller
{
    public function artisan($command = null)
    {
        set_time_limit(1000);
        app()->setLocale('fa');
        switch ($command) {
            case 'discover':
                Artisan::call('package:discover');
                dd('discovered');
                break;
            case 'migrate':
                Artisan::call('migrate');
                dd('migrate');
                break;
            case 'migrate_fresh':
                Artisan::call('migrate:fresh');
                dd('migrate:fresh');
                break;
            case 'seed':
                $this->clear();
                Artisan::call('db:seed');
//                Artisan::call('optimize');
                dd('db:seed');
                break;
            case 'optimize':
//                $this->makeFiles();
               $this->optimize();
                dd('optimize');
                break;
            case 'clear':
                $this->clear();
                dd('cleared');
                break;
            case (null):
                $this->clear();
                Artisan::call('migrate:fresh');
                Artisan::call('db:seed');
                $this->makeFiles();
                Artisan::call('optimize');
                dd('artisan called');
                break;
            default:
                dd('command is not valid!');
                break;

        }
    }

    public function generator($file = null)
    {
        switch ($file) {
            case 'route':
               makeRouteFile();
                dd('route file generated');
                break;
            case 'setting':
                makeSettingFile();
                dd('setting file generated');
                break;
            case 'translation':
                dd('translation file generated');
                break;
            default:
                $this->makeFiles();
//                Artisan::call('optimize');
                dd('files generated');
                break;
        }
    }

    protected function makeFiles()
    {
       makeRouteFile();
        makeSettingFile();
    }

    public function getToken()
    {
        //    return response()->json(['token'=>'sssssss']);
        return response()->json(['token' => csrf_token()]);
    }

    protected function clear()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Session::flush();
    }

    protected function optimize()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('config:cache');
        Artisan::call('view:clear');

        Artisan::call('optimize');
//        Artisan::call('route:cache');
    }
}
