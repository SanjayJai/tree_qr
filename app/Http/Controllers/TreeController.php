<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use Illuminate\Http\Request;

class TreeController extends Controller
{

    public function show($slug)
    {
        $tree = Tree::where('slug', $slug)->firstOrFail();
        return view('tree.view', compact('tree'));
    }
    

}

