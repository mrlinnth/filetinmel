<?php

namespace Mrlinnth\Filetinmel\Http\Controllers\Api;

use Dawson\Youtube\Facades\Youtube;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Mrlinnth\Filetinmel\Filetinmel;

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
    public function postYoutube(Request $request)
    {
        $yt_id = 'FMt3E4-fn9o';

        if (config('filetinmel.env') != 'local') {

            $request->validate([
                'title' => 'required|max:255',
                'file' => 'required',
            ]);

            $video = $request->file('file');
            $title = $request->title;
            $category_id = ($request->has('category_id')) ? $request->category_id : config('filetinmel.yt_default_category');
            $type = ($request->has('type')) ? $request->type : config('filetinmel.yt_default_listing');

            $ytVideo = Youtube::upload($video, [
                'title' => $title,
                'category_id' => $category_id,
            ], $type);
            $yt_id = $ytVideo->getVideoId();
        }

        return response()->json($yt_id);
    }

    public function postFiles(Request $request, $f = null)
    {
        $folder = ($f == null) ? config('filetinmel.s3_folder') : $f;
        $path = $request->file('file')->store($folder);

        $result = Filetinmel::getFileMeta($path);

        return response()->json($result);
    }

    public function getFiles(Request $request)
    {
        foreach ($request->paths as $path) {
            if (Storage::exists($path)) {
                $result[] = Filetinmel::getFileMeta($path);
            }
        }

        return response()->json($result);
    }

    public function temp()
    {
        $result = [
            "portfolio_img/1521603389_0zEZR0uowU.jpeg",
            "portfolio_img/1521603393_9DthZiszIf.jpeg",
            "portfolio_img/1521603396_VR75luWt1k.jpeg",
            "portfolio_img/1521603396_yIs2ffL9i5.jpeg",
            "portfolio_img/1521603397_5Q9oCFKtyx.jpeg",
            "portfolio_img/1521603397_ir7SIYrYZm.jpeg",
            "portfolio_img/1521603398_szbtoTWPEJ.jpeg",
            "portfolio_img/1521603399_v6ufNARoBv.jpeg",
            "portfolio_img/1521603399_h7DEvo6WXk.jpeg",
            "portfolio_img/1521603400_5pqIlEUcq7.jpeg",
            "portfolio_img/1521603401_0nOoTUdFX5.jpeg",
        ];

        return response()->json($result);
    }

}
