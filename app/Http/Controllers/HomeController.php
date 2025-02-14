<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\BlogPost; // Make sure to use the correct model
use App\Models\Tree;

class HomeController extends Controller
{
    public function index()
    {
        $trees = Tree::latest()->take(5)->get();  // Show the latest 2 trees or adjust this as needed
        return view('welcome', compact('trees'));
    }
    
}