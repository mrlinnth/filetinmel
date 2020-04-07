<?php

namespace Mrlinnth\Filetinmel;

use Illuminate\Support\Facades\Storage;

class Filetinmel
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public static function getFileMeta($path)
    {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $mime = (new \Mimey\MimeTypes)->getMimeType($ext);

        return [
            'name' => basename($path),
            'type' => $mime,
            'extension' => $ext,
            'size' => Storage::size($path),
            'url' => Storage::url($path),
            'src' => Storage::url($path),
        ];
    }
}
