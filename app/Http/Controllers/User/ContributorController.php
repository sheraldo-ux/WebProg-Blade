<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContributorController extends Controller
{
    //
    public function index()
    {
        return view('profile.contributor.index');
    }
}
