<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entity\Adverts\Category;
use App\Entity\Region;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return view('home');
        $regions = Region::roots()->orderBy('name')->getModels();

        $categories = Category::whereIsRoot()->defaultOrder()->getModels();

        return view('home', compact('regions', 'categories'));
    }
}
