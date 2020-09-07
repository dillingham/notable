<?php

namespace Dillingham\Markdown;

class Markdown
{
    public $files;

    public function addFile($file)
    {
        $this->files[] = $file;
    }

    public function getFiles()
    {
        return $this->files;
    }
}