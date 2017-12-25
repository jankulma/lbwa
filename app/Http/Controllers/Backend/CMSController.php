<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CMSController extends BackendController
{
    public function index()
    {
        return view('backend.cms.index');
    }
}
