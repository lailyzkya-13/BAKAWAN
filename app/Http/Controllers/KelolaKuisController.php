<?php

namespace App\Http\Controllers;

class KelolaKuisController extends Controller
{
    public function index()
    {
        return view('kuis-guru');
    }
}