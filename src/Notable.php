<?php

namespace Notable;

class Notable
{
    public $files;

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
}