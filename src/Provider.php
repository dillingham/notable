<?php

namespace Markdox;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

class Provider extends ServiceProvider
{
    public function boot()
    {
        Route::macro('everything', function($path) {
            foreach((new Finder)->files()->in($path) as $file) {
                // add file path to a singlton class for:
                    // making nav helper
                    // which urls to crawl

                $path = $file->getPathName();
                dd($path);
                // use Arr:dot or whatever
                if(Str::endsWith($path, 'index.md')) {
                    $path = str_replace('index.md', '', $path);
                }

                $path = str_replace('.md', '', $path);
                $path = str_replace(DIRECTORY_SEPARATOR, '/', $path);

                Route::markdown($path, str_replace('/', '.', $file));
            }
        });

        Route::macro('markdown', function($uri, $view) {
            Route::get($uri, function() use($view) {
                $content = \file_get_contents(__DIR__.DIRECTORY_SEPARATOR.str_replace('.', DIRECTORY_SEPARATOR, $view).'.md');
                $content = (new \Parsedown)->text($content);
                return view('article', [
                    'markdown' => $view,
                    'content' => $content
                ]);
            });
        });
    }

    public function register()
    {
        //
    }
}