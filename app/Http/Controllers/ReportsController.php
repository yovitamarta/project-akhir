<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function getRevenueReport(Request $request)
    {
        // Ambil periode waktu dari request (default: 7 hari terakhir)
        $range = $request->get('range', '7');

        $startDate = match($range) {
            '30' => Carbon::now()->subDays(30),
            '90' => Carbon::now()->subDays(90),
            '365' => Carbon::now()->subDays(365),
            default => Carbon::now()->subDays(7),
        };

        // Ambil data pendapatan harian dari senin-sabtu
        $revenues = Order::selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->whereBetween('created_at', [$startDate, now()])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        // Format untuk Chart.js
        $labels = $revenues->pluck('date');
        $totals = $revenues->pluck('total');

        return response()->json([
            'labels' => $labels,
            'totals' => $totals
        ]);
    }
}
