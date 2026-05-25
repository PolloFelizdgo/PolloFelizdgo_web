<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class HealthController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'status' => 'up',
            'app' => (string) config('app.name', 'Laravel'),
            'env' => app()->environment(),
            'timestamp' => now()->toIso8601String(),
        ]);
    }
}
