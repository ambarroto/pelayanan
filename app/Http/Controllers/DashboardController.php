<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    /**
     * Create dashboard controller instance
     * 
     */
    public function __construct()
    {
        
    }

    public function index()
    {
        return view('pages.dashboard');
    }
}