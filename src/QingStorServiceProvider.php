<?php
/**
 * 
 */
namespace CdXmj\QingStorStorage;

use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class QingStorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Storage::extend('QingStor', function ($app, $config) {
            $client = QingStorClient::getInstance($config);

            $bucket = array_get($config, 'bucket');
            $zone = array_get($config, 'zone');

            $adapter = new QingStorStorage($client, $bucket, $zone);

            return new Filesystem($adapter);
        });
    }

    public function register()
    {

    }

}