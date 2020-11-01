<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 26.07.2019
 * Time: 9:40
 */

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('cabinet.home');
    }
}
