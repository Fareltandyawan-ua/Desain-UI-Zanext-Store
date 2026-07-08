<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function about() { return view('pages.about'); }
    public function contact() { return view('pages.contact'); }
    public function faq() { return view('pages.faq'); }
}
