<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use Google_Client;
use Google_Service_Drive;
use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;
use League\Flysystem\Filesystem;

class AppServiceProvider extends ServiceProvider
{
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        

        /**
         * Factory per client Google
         */
        $this->app->bind("Google_Client", function($app) {
            
            $client = new Google_Client();
            
            $config = config("filesystems.disks.google");
            
            putenv('GOOGLE_APPLICATION_CREDENTIALS='.base_path("credentials.json"));
            $client->useApplicationDefaultCredentials();
            $client->addScope(Google_Service_Drive::DRIVE);
            if(array_key_exists("user", $config)) {
                $client->setSubject($config["user"]);
            }

            return $client;
                
        });


        /**
         * Factory per service Google
         */
        $this->app->bind("Google_Service_Drive", function($app) {

            $service = new Google_Service_Drive($app->Google_Client);

            return $service;

        });


        /**
         * Estensione Storage per disco "Google"
         * basata su Google_Service_Drive
         */
        Storage::extend('google', function($app, $config) {
            
            $options = [];
                
            $adapter = new GoogleDriveAdapter($app->Google_Service_Drive, $config['folder_id'], $options);

            return new Filesystem($adapter);
        });


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
