<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReporterController extends Controller
{
    //
    public function index()
    {
        return view('profile.reporter.index');
    }
}
