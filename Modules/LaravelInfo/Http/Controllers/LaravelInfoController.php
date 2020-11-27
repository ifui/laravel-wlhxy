<?php

namespace Modules\LaravelInfo\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Linfo\Linfo;

class LaravelInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return config('laravelinfo.linfo');
        $linfo = new Linfo();
        $linfo->scan();
        return $linfo->getInfo();
    }

}
