<?php

namespace App\Services\Stats;

use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Models\Book;

class StatsService
{
    public function getStats(): array
    {
//        return Cache::remember('statistics', now()->addMinutes(10), function () {
        return [
            'books_count' => Book::count(),
            'users_count' => User::count(),
        ];
//        });
    }
}
