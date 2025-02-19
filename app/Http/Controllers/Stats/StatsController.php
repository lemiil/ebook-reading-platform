<?php

namespace App\Http\Controllers\Stats;

use App\Http\Controllers\Controller;
use App\Services\Stats\StatsService;

class StatsController extends Controller
{
    protected $statsService;

    public function __construct(StatsService $statsService)
    {
        $this->statsService = $statsService;
    }

    public function index()
    {
        return view('stats.stats-index', [
            'stats' => $this->statsService->getStats(),
        ]);
    }
}
