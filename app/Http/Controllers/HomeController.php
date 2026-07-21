<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FinishGoodsTransaction;
use App\Models\Rack;
use App\Models\User;
use App\Models\ProductType;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today = now()->toDateString();

        $totalRacks = Rack::count();
        $totalUsers = User::count();
        $totalProductTypes = ProductType::count();
        $transactionsToday = FinishGoodsTransaction::whereDate('created_at', $today)->count();
        $incomingToday = FinishGoodsTransaction::whereDate('created_at', $today)->where('action_type', 'in')->sum('qty_carton');
        $outgoingToday = FinishGoodsTransaction::whereDate('created_at', $today)->where('action_type', 'out')->sum('qty_carton');
        $recentTransactions = FinishGoodsTransaction::orderByDesc('created_at')->limit(6)->get();

        return view('home', compact(
            'totalRacks',
            'totalUsers',
            'totalProductTypes',
            'transactionsToday',
            'incomingToday',
            'outgoingToday',
            'recentTransactions'
        ));
    }
}
