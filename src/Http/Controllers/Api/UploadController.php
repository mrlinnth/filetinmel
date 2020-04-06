<?php

namespace Mrlinnth\Filetinmel\Http\Controllers\Api;

use Dawson\Youtube\Facades\Youtube;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * Upload a video to youtube
     * @param Request $request
     * File $request->video is required
     * String $request->title is required
     * Integer $request->category_id is optional, default is 22
     * String $request->type is optional, default is 'unlisted'
     * @return Response
     */
    public function youtube(Request $request)
    {
        // $path = $request->file('video')->store('videos');
        $path = 'i5L9NGohoAE';

        if (config('filetinmel.env') != 'local') {

            $request->validate([
                'title' => 'required|max:255',
                'upload' => 'required',
            ]);

            $video = $request->file('file');
            $title = $request->title;
            $category_id = ($request->has('category_id')) ? $request->category_id : 22;
            $type = ($request->has('type')) ? $request->type : 'unlisted';

            $ytVideo = Youtube::upload($video, [
                'title' => $title,
                'category_id' => $category_id,
            ], $type);
            $path = $ytVideo->getVideoId();
        }

        return response()->json($path);
    }

    public function upload(Request $request, $f = null)
    {
        $folder = ($f == null) ? config('filetinmel.s3_folder') : $f;
        $path = $request->file('file')->store($folder);

        $result = $this->getFileMeta($path);

        return response()->json($result);
    }

    public function files()
    {
        $paths = [
            'dummy.png',
            'dummy.txt',
        ];
        $result = [];
        foreach ($paths as $path) {
            if (Storage::exists($path)) {
                $result[] = $this->getFileMeta($path);
            }
        }

        return response()->json($result);
    }

    public function getFileMeta($path)
    {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $mimes = new \Mimey\MimeTypes;
        $mime = $mimes->getMimeType($ext);

        return [
            'name' => $path,
            'type' => $mime,
            'extension' => $ext,
            'size' => Storage::size($path),
            'url' => Storage::url($path),
            'src' => Storage::url($path),
        ];
    }

}
