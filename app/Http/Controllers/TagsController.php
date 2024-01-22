<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
        return view('pages.tags.index');
    }
}
