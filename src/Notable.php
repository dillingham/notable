<!-- ---
title: 'My Great Document'
author: 'Yours Truly'
description: 'A short document with very little to say'
status: 'public'
created_at: '2017-11-18 12:01:00'
--- -->

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