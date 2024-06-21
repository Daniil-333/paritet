<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class AdminLeadController extends Controller
{
    public function index()
    {
        $leads = Lead::all();
        return view('admin.leads')->with([
            'leads' => $leads,
        ]);
    }
}
