<?php

namespace Appnegar\Cms\Traits;

use Barryvdh\Elfinder\Connector;
use Barryvdh\Elfinder\Session\LaravelSession;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Foundation\Application;
use Storage;


trait AdminFileManager
{
    protected $package = 'elfinder';

    public function showFileManager(Application $app,$view,$input_id=null)
    {
        switch ($view){
            case 'index':
                return $this->showFileManagerIndex($app);
                break;
            case 'tinymce':
                return $this->showFileManagerTinyMCE($app);
                break;
            case 'tinymce4':
                return $this->showFileManagerTinyMCE4($app);
                break;
            case 'ckeditor4':
                return $this->showFileManagerCKeditor4($app);
                break;
            case 'popup':
                return $this->showFileManagerPopup($app,$input_id);
            case 'filepicker':
                return $this->showFileManagerFilePicker($app,$input_id);
                break;
            default:
                abort(404);
                break;

        }
    }

    public function showFileManagerIndex($app)
    {
        return view('appnegar::elfinder.elfinder')->with($this->getFileManagerViewVars($app));
    }

    public function showFileManagerTinyMCE(Application $app)
    {
        return view('appnegar::elfinder.tinymce')->with($this->getFileManagerViewVars($app));
    }

    public function showFileManagerTinyMCE4(Application $app)
    {
        return view('appnegar::elfinder.tinymce4')->with($this->getFileManagerViewVars($app));
    }

    public function showFileManagerCKeditor4(Application $app)
    {
        return view('appnegar::elfinder.ckeditor4')->with($this->getFileManagerViewVars($app));
    }

    public function showFileManagerPopup(Application $app,$input_id)
    {
        return view('appnegar::elfinder.standalonepopup')->with($this->getFileManagerViewVars($app))->with(compact('input_id'));
    }

    public function showFileManagerFilePicker(Application $app,$input_id)
    {
        $type = request()->input('type');
        $mimeTypes = implode(',', array_map(function ($t) {
            return "'" . $t . "'";
        }, explode(',', $type)));
        return view('elfinder.filepicker')->with($this->getFileManagerViewVars($app))->with(compact('input_id', 'type', 'mimeTypes'));
    }

    public function showFileManagerConnector(Application $app)
    {

        if (empty($roots)) {
            $dirs = (array)$app['config']->get('elfinder.dir', []);
            foreach ($dirs as $dir) {
                $resource_name = ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $this->resource)), '_');
//                $path="/".$resource_name."/uploads";
                $path="/".$resource_name;


                Storage::makeDirectory($path);
                $dir.=$path;
//                dd($dir);
                $roots[] = [
                    'driver' => 'LocalFileSystem', // driver for accessing file system (REQUIRED)
                    'path' => public_path($dir), // path to files (REQUIRED)
                    'URL' => url($dir), // URL to files (REQUIRED)
                    'accessControl' => $app->config->get('elfinder.access') // filter callback (OPTIONAL)
                ];
            }


//            $disks = (array)$app['config']->get('elfinder.disks', []);
            $disks=[];
            foreach ($disks as $key => $root) {
                if (is_string($root)) {
                    $key = $root;
                    $root = [];
                }
                $disk = app('filesystem')->disk($key);
                if ($disk instanceof FilesystemAdapter) {
                    $defaults = [
                        'driver' => 'Flysystem',
                        'filesystem' => $disk->getDriver(),
                        'alias' => $key,
                    ];
                    $roots[] = array_merge($defaults, $root);
                }
            }
        }

        if (app()->bound('session.store')) {
            $sessionStore = app('session.store');
            $session = new LaravelSession($sessionStore);
        } else {
            $session = null;
        }

        $rootOptions = $app->config->get('elfinder.root_options', array());
        foreach ($roots as $key => $root) {
            $roots[$key] = array_merge($rootOptions, $root);
        }

        $opts = $app->config->get('elfinder.options', array());
        $opts = array_merge($opts, ['roots' => $roots, 'session' => $session]);

        // run elFinder
        $connector = new Connector(new \elFinder($opts));
        $connector->run();
        return $connector->getResponse();
    }

    protected function getFileManagerViewVars($app)
    {
        $dir = 'assets/' . $this->package;
        $locale = str_replace("-", "_", $app->config->get('app.locale'));
        if (!file_exists($app['path.public'] . "/$dir/js/i18n/elfinder.$locale.js")) {
            $locale = false;
        }
        $csrf = true;
        $route=session('department').'.'.$this->resource.".showFileManagerConnector";
        return compact('dir', 'locale', 'csrf','route');
    }
}