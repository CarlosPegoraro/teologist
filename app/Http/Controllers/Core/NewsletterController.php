<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Services\SerpApiManager;

class NewsletterController extends Controller
{
    public function index()
    {
        $news = SerpApiManager::getNews();
        return view('newsletter.index', compact('news'));
    }
}
