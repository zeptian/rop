<?php

namespace App\Http\Controllers;

use App\Category;
use App\Plan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class PlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user = Auth::user();
        $role = $user->role;
        $uid = $user->id;
        // if ($role == 'admin') {
        //     $plan = Plan::all();
        // } else {
        //     $plan = Plan::where('user_id', $uid)->get();
        // }
        $category = $request->input('category');
        $subcategory = $request->input('subcategory');
        $pelaksana = $request->input('pelaksana');
        $sumber = $request->input('sumber');
        $where = null;
        if ($category && $category != 'all') {
            $where[] = ['category_id', $category];
        }
        if ($subcategory && $subcategory != 'all') {
            $where[] = ['subcategory_id', $subcategory];
        }
        if ($pelaksana && $pelaksana != 'all') {
            $uid = $pelaksana;
            $where[] = ['user_id', $uid];
        }
        if ($sumber && $sumber != 'all') {
            $where[] = ['planSource', $sumber];
        }
        $plan = Plan::where($where)->get();
        $q = compact('category', 'subcategory', 'pelaksana', 'sumber');
        $categories = Category::getParent()->orderBy('id', 'ASC')->get();
        $users      = User::select('id', 'name')->get();

        return view('rop.rekapPlan', ['plans' => $plan, 'user' => $user, 'categories' => $categories, 'users' => $users, 'q' => $q]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = Auth::user();
        $categories = Category::getParent()->orderBy('id', 'ASC')->get();
        return view('rop.plan', ['categories' => $categories, 'user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'category'   => 'required|numeric',
            'subcategory'   => 'required|numeric',
            'action'    => 'required',
            'planTanggal'   => 'required',
            'planBudget'    => 'required',
            'planSource'    => 'required',
            'planTarget'    => 'required',
        ]);

        $plan = new Plan();
        $plan->user_id = Auth::id();
        $plan->category_id = $request->category;
        $plan->subcategory_id = $request->subcategory;
        $plan->action = $request->action;
        $plan->planTanggal = $request->planTanggal;
        $plan->planBudget = str_replace(',', '', $request->planBudget);
        $plan->planSource = $request->planSource;
        $plan->planTarget = $request->planTarget;

        $plan->save();

        return redirect()->route('plan')->with('alert-success', 'Berhasil Menambahkan Data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $Plan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('plan.detail', ['plan' => Plan::where('id', $id)->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plan  $Plan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categories = Category::getParent()->orderBy('id', 'ASC')->get();
        $plan = Plan::where('id', $id)->first();
        $user = Auth::user();
        return view('rop.plan', ['plan' => $plan, 'categories' => $categories, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan  $Plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'category'      => 'required|numeric',
            'subcategory'   => 'required|numeric',
            'action'        => 'required',
            'planTanggal'   => 'required',
            'planBudget'    => 'required',
            'planSource'    => 'required',
            'planTarget'    => 'required',
        ]);

        $plan = Plan::where('id', $id)->first();
        $plan->user_id = Auth::id();
        $plan->category_id = $request->category;
        $plan->action = $request->action;
        $plan->planTanggal = $request->planTanggal;
        $plan->planBudget = str_replace(',', '', $request->planBudget);
        $plan->planSource = $request->planSource;
        $plan->planTarget = $request->planTarget;
        $plan->save();

        return redirect()->route('plan')->with('alert-success', 'Data Berhasil Update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan  $Plan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = Plan::where('id', $id)->delete();
        return redirect()->route('plan')->with('success', 'Data berhasi dihapus!');
    }
}