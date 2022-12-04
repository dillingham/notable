<?php

namespace Notable;

use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;

class Page
{
    public $file;

    protected $prefix;

    protected $root;

    protected $path;

    public function __construct($prefix, $path, SplFileInfo $file)
    {
        $this->prefix = $prefix;
        $this->root = $path;
        $this->file = $file;
        $this->path = $this->prefix . str_replace($this->root, '', $file->getPathName());
    }

    public function route(): string
    {
        $route = str_replace('index.md', '', $this->path);
        $route = str_replace('.md', '', $route);

        return str_replace(DIRECTORY_SEPARATOR, '/', $route);
    }

    public function link(): string
    {
        return url($this->route());
    }

    public function section(): string
    {
        $bits = explode('/', $this->path);

        $segment = $this->prefix !== $bits[0]
            ? $bits[0]
            : $bits[1];

        return Str::of($segment)
            ->replace('-', ' ')
            ->replace('_', ' ')
            ->title();
    }

    public function display(): string
    {
        return (string) Str::of(rtrim($this->path, '/'))->afterLast('/')->title();
    }

    public function view(): string
    {
        return ltrim(str_replace(DIRECTORY_SEPARATOR, '.', $this->path), '.');
    }

    public function content(): string
    {
        return Str::of($this->file->getContents())->markdown();
    }

    public function metaTitle(): string
    {
        return (string) Str::of(rtrim($this->path, '/'))->afterLast('/')->title();
    }

    public function editLink(): string
    {
        if(!config('notable.repository')) {
            return '';
        }

        return 'todo';
    }
}
