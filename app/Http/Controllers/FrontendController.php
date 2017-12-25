<?php

namespace App\Http\Controllers;

use App\FirstPageImage;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $image = FirstPageImage::first();
        
        return view('frontend.home', compact('image'));
    }

    public function projects()
    {
        return view('frontend.projects');
    }

    public function workshop()
    {
        return view('frontend.workshop');
    }

    public function locale()
    {

        if (app()->isLocale('pl')) {
            session()->put('locale', 'en');
        } else {
            session()->put('locale', 'pl');
        }
        
        return back();
    }
}
