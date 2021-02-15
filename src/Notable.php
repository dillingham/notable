<?php

namespace Notable;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

class Notable
{
    public $files;

    public $content;

    public function meta()
    {
        $this->content;
        // if starts with ---
        // $yaml = extract between first & second ---
        $meta = yaml_parse($yaml);
    }

    public function addFile($file)
    {
        $this->files[] = $file;
    }

    public function editLink($path)
    {
        return 'todo';
    }

    public function sections()
    {
        return [];
    }

    public function getFiles()
    {
        return $this->files;
    }

    public function links()
    {
        return collect($this->files)->flatMap(function($file) {
            return [$file['path'] => $file['display']];
        });
    }

    public function get($path)
    {
        $path = trim($path, '"');
        $path = trim($path, "'");
        $content = \file_get_contents(base_path(str_replace('.', DIRECTORY_SEPARATOR, $path) . '.md'));
        return (new \Parsedown)->text($content);
    }

    public function directive($expression)
    {
        $content = $this->get($expression);

        return "<?php echo '$content'; ?>";
    }

    public function route($prefix = 'docs', $path = null)
    {
        if(is_null($path)) {
            $path = base_path('docs');
        }

        if (!is_dir($path) && file_exists($path)) {
            // markdown file
        } else {
            // loop below
        }

        foreach ((new Finder)->files()->in($path) as $file) {
            // if modified time: check if file has been modified since cached
            // if not, return html to the article view
            // else render the markdown and cache again

            $isIndexPath = false;
            $relative = $file->getPathName();
            $relative = str_replace($path, '', $relative);

            $route = $relative;

            if (Str::endsWith($route, 'index.md')) {
                $isIndexPath = true;
                $route = str_replace('index.md', '', $route);
            }

            $relative = str_replace('index.md', '', $relative);
            $relative = str_replace('.md', '', $relative);
            $route = str_replace('.md', '', $route);
            $route = str_replace(DIRECTORY_SEPARATOR, '/', $route);
            $view = ltrim(str_replace('/', '.', $route), '.');
            $view = $isIndexPath ? $view . "index" : $view;

            app('notable')->addFile([
                'display' => (string) Str::of(\rtrim($route, '/'))->afterLast('/')->title(),
                'path' => $relative,
                'name' => $view,
            ]);

            Route::prefix($prefix)->group(function () use ($view, $path, $route) {
                Route::get($route, function () use ($view, $path, $route) {
                    $content = \file_get_contents($path . DIRECTORY_SEPARATOR . str_replace('.', DIRECTORY_SEPARATOR, $view) . '.md');
                    $content = (new \Parsedown)->text($content);
                    // cache

                    $meta_title = (string) Str::of(\rtrim($route, '/'))->afterLast('/')->title();

                    if (!$meta_title) {
                        $meta_title = 'Get Started';
                    }

                    return view(config('notable.article', 'docs.show'), [
                        'markdown_path' => "$route.md",
                        'sections' => [],
                        'links' => [],
                        'docs' => app('notable'),
                        'meta_title' => $meta_title,
                        'edit_link' => app('notable')->editLink($path),
                        'content' => $content,
                        'markdown' => $view,
                        'path' => $path,
                        'view' => $view,
                    ]);
                });
            });
        }
    }
}