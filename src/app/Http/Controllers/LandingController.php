<?php

namespace App\Http\Controllers;

use App\Models\ServerPackage;
use App\Models\Template;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $templates = Template::where('is_active', true)->get();
        $packages = ServerPackage::where('is_active', true)->get();

        return view('landing', compact('templates', 'packages'));
    }
}