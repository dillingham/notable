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

    public function links()
    {
        foreach($this->files as $file)
        {
            echo '<li class="list-none"><a href="'.$file['path'].'">'.$file['display'].'</a></li>';
        }
    }
}