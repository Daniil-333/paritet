<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminRulesController extends Controller
{
    public function index()
    {
        return view('admin.rules');
    }
}
