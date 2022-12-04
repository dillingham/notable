<?php

namespace Notable;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use SplFileInfo;
use Symfony\Component\Finder\Finder;

class Notable
{
    protected array $pages;

    protected array $sections;

    public function setup($prefix = 'docs', $path = null)
    {
        if(is_null($path)) {
            $path = base_path('docs');
        }

        if (!is_dir($path) && file_exists($path)) {
            return $this->makeRoute(
                $this->makePageObject($prefix, $path, $path)
            );
        }

        foreach ((new Finder)->files()->in($path) as $file) {
            $page = new Page($prefix, $path, $file);
            $this->makeRoute($page);
            $this->addPage($page);
            $this->addSectionLink($page);
        }
    }

    public function addPage(Page $page): array
    {
        $this->pages[] = $page;

        return $this->pages;
    }

    public function addSectionLink($page): array
    {
        $this->sections[$page->section()][$page->link()] = $page->display();

        return $this->sections;
    }

    public function sections(): array
    {
        return $this->sections;
    }

    public function links(): Collection
    {
        return collect($this->pages)->flatMap(function($page) {
            return [$page->link() => $page->display()];
        });
    }

    public function makePageObject($prefix, $path, $file): Page
    {
        $info = new SplFileInfo($file);

        $file = new \Symfony\Component\Finder\SplFileInfo(
            $info->getFilename(),
            $info->getPath(),
            $info->getPathname()
        );

        return new Page($prefix, $path, $file);
    }

    public function makeRoute(Page $page): bool
    {
        Route::get($page->route(), function () use ($page) {
            return View::make(config('notable.page.view', 'docs.show'), [
                'docs' => $this,
                'page' => $page,
            ]);
        });

        return true;
    }
}
