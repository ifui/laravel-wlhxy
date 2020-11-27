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
        $linfo = new Linfo(config('laravelinfo.linfo'));
        $linfo->scan();
        return $linfo->getInfo();
    }

}
