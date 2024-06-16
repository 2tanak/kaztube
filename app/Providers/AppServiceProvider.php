<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (App::environment(['production', 'staging', 'testing-kube'])) {
            URL::forceScheme('https');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Request::macro('getFile', function (string $fileName): ?UploadedFile {
            /**
             * @var Request $this
             */
            $file = $this->file($fileName);

            if (is_array($file)) {
                return null;
            }

            return $file;
        });


        /**
         * @param string $fileName
         *
         * @return array<UploadedFile>
         */
        $getFiles = function (string $fileName): array {
            /**
             * @var Request $this
             */
            return Arr::wrap($this->file($fileName));
        };
        Request::macro('getFiles', $getFiles);
    }
}
