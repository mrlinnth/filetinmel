<?php

namespace Mrlinnth\Filetinmel\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class FiletinmelController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('filetinmel::index');
    }

    /**
     * For test purpose
     */
    public function test()
    {
        return view('filetinmel::test');
    }
}
