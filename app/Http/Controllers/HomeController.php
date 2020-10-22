<?php

namespace App\Http\Controllers;

use App\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $realRekap = DB::table('reals')->selectRaw('plan_id,sum(realBudget) as realBudget')->where('deleted_at', null)->groupBy('plan_id');
        // dd($realRekap);
        $categories = DB::table('plans')
            ->join('categories', 'categories.id', '=', 'plans.category_id')
            ->leftJoinSub($realRekap, 'reals', function ($join) {
                $join->on('plans.id', 'reals.plan_id');
            })
            ->selectRaw('category,sum(planBudget) as anggaran, sum(realBudget) as serapan ')
            ->where([['plans.deleted_at', null]])
            ->groupBy('category_id')
            ->get();

        $actors = DB::table('plans')
            ->join('users', 'users.id', '=', 'plans.user_id')
            ->leftjoinSub($realRekap, 'reals', function ($join) {
                $join->on('plans.id', 'reals.plan_id');
            })
            ->select(DB::raw('name,sum(planBudget) as anggaran, sum(realBudget) as serapan '))
            ->where([['plans.deleted_at', null]])
            ->groupBy('plans.user_id')
            ->get();
        // dd($plans);
        return view('home', compact('categories', 'actors'));
    }
}