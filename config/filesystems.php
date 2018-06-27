<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        
        'files_s_documento' => [
            'driver' => 'local',
            'root' => storage_path('app/public/files_s_documento'),
            'url' => env('APP_URL').'/storage/files_s_documento',
            'visibility' => 'public',
        ],
        
        'files_s_procedimiento' => [
            'driver' => 'local',
            'root' => storage_path('app/public/files_s_procedimiento'),
            'url' => env('APP_URL').'/storage/files_s_procedimiento',
            'visibility' => 'public',
        ],
        
        'files_s_registro' => [
            'driver' => 'local',
            'root' => storage_path('app/public/files_s_registro'),
            'url' => env('APP_URL').'/storage/files_s_registro',
            'visibility' => 'public',
        ],
        
        'files_a_procedimiento' => [
            'driver' => 'local',
            'root' => storage_path('app/public/files_a_procedimiento'),
            'url' => env('APP_URL').'/storage/files_a_procedimiento',
            'visibility' => 'public',
        ],
        
        'files_a_archivo' => [
            'driver' => 'local',
            'root' => storage_path('app/public/files_a_archivo'),
            'url' => env('APP_URL').'/storage/files_a_archivo',
            'visibility' => 'public',
        ],
        
        'files_a_rr_ambientale' => [
            'driver' => 'local',
            'root' => storage_path('app/public/files_a_rr_ambientale'),
            'url' => env('APP_URL').'/storage/files_a_rr_ambientale',
            'visibility' => 'public',
        ],
        
        'files_rev_documental_ln' => [
            'driver' => 'local',
            'root' => storage_path('app/public/files_rev_documental_ln'),
            'url' => env('APP_URL').'/storage/files_rev_documental_ln',
            'visibility' => 'public',
        ],
        
        'entities' => [
            'driver' => 'local',
            'root' => storage_path('app/public/entities'),
            'url' => env('APP_URL').'/storage/enttities',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],

    ],

];
