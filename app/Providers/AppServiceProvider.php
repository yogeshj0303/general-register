<?php

namespace App\Providers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Aws\S3\S3Client;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        Paginator::useBootstrap(); 
        
        View::composer('layouts.topbar', function ($view) {
            $presignedUrl = null;

            if (Auth::check()) {
                $profilePic = Auth::user()->profile_pic;

                if ($profilePic) {
                    $s3Client = new S3Client([
                        'version' => 'latest',
                        'region' => env('AWS_DEFAULT_REGION', 'ap-northeast-1'),
                        'credentials' => [
                               'key' => env('AWS_ACCESS_KEY_ID', 'AKIA4MTWMH3DD3HGDESL'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY', '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'),
                        ],
                    ]);

                    $cmd = $s3Client->getCommand('GetObject', [
                        'Bucket' => env('AWS_BUCKET', 'project-general-register'),
                        'Key' => $profilePic,
                    ]);

                    $request = $s3Client->createPresignedRequest($cmd, '+5 minutes');
                    $presignedUrl = (string) $request->getUri();
                }
            }

            $view->with('presignedUrl', $presignedUrl);
        });

    }
}
