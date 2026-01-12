<?php

namespace App\Services;

use App\Http\Apis\SerpApiClient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class SerpApiManager
{
    public static function getNews(): array
    {
        $cachedNews = Cache::get('news');

        if ($cachedNews) {
            return $cachedNews;
        }

        $apiController = new SerpApiClient();

        $news = $apiController->searchByGoogle('atualidade');

        $now = Carbon::now();
        $tomorrow = Carbon::tomorrow();
        Cache::put('news', $news, $now->diffInSeconds($tomorrow));

        return $news;
    }

}
