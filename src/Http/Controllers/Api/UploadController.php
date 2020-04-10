<?php

namespace Mrlinnth\Filetinmel\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Mrlinnth\Filetinmel\Facades\Youtube;
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

        if (!config('youtube.testing')) {

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

        $result = [];
        foreach ($request->file('files') as $file) {
            $path = $file->store($folder);
            $result[] = Filetinmel::getFileMeta($path);
        }

        return response()->json($result);
    }

    public function getFiles(Request $request)
    {
        $result = [];
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
            "portfolio_img/1483491984oKMOaRt721.jpg",
            "portfolio_img/1483491984p05vs2s595.jpg",
            "portfolio_img/1483491984gAMo6RqIP8.jpg",
            "portfolio_img/1483491984HaUQMldyxQ.jpg",
            "portfolio_img/1483491984DUTJaSjI31.jpg",
            "portfolio_img/1483491984kMk7IFsr2B.jpg",
            "portfolio_img/1490076106_MLZ8HzeEZY.jpeg",
            "portfolio_img/1490076183_MhryQW9r7j.jpeg",
            "portfolio_img/1490076310_YHs7cXb4TO.jpeg",
            "portfolio_img/1490076360_5VYBq2aVWt.jpeg",
            "portfolio_img/1490078652_dj7EhiGCQ1.jpeg",
            "portfolio_img/1490078655_hd3BuFVayC.jpeg",
        ];

        return response()->json($result);
    }

}
