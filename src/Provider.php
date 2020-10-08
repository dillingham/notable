<?php

namespace Notable;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Notable\Notable;
use Symfony\Component\Finder\Finder;

class Provider extends ServiceProvider
{
    public function boot()
    {
        // $this->app->singleton('notable', function(){
        //     return new Notable;
        // });

        Route::macro('markdown', function($prefix, $path) {

            if(!is_dir($path) && file_exists($path)) {
                // markdown file
            } else {
                // loop below
            }

            foreach((new Finder)->files()->in($path) as $file) {
                // if modified time: check if file has been modified since cached
                // if not, return html to the article view
                // else render the markdown and cache again

                $isIndexPath = false;
                $relative = $file->getPathName();
                $relative = str_replace($path, '', $relative);

                $route = $relative;

                if(Str::endsWith($route, 'index.md')) {
                    $isIndexPath = true;
                    $route = str_replace('index.md', '', $route);
                }

                $relative = str_replace('index.md', '', $relative);
                $relative = str_replace('.md', '', $relative);
                $route = str_replace('.md', '', $route);
                $route = str_replace(DIRECTORY_SEPARATOR, '/', $route);
                $view = ltrim(str_replace('/', '.', $route), '.');
                $view = $isIndexPath ? $view."index" : $view;

                // app('notable')->addFile([
                //     'display' => (string) Str::of(\rtrim($route, '/'))->afterLast('/')->title(),
                //     'path' => $relative,
                //     'name' => $view,
                // ]);

                Route::get($route, function() use($view, $path, $route) {
                    $content = \file_get_contents($path.DIRECTORY_SEPARATOR.str_replace('.', DIRECTORY_SEPARATOR, $view).'.md');
                    $content = (new \Parsedown)->text($content);
                    // cache
                    return view(config('notable.article', 'docs.show'), [
                        'markdown_path' => "$route.md",
                        'content' => $content,
                        'markdown' => $view,
                        'path' => $path,
                        'view' => $view,
                    ]);
                });
            }
        });
    }

    public function register()
    {
        //
    }
}