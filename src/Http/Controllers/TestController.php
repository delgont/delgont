<?php

namespace Delgont\Cms\Http\Controllers;

use Delgont\Cms\Http\Controllers\Controller;
use Illuminate\Http\Request;


class TestController extends Controller
{
    public function index()
    {
        return view('delgont::index');
    }
}
