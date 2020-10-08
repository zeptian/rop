<?php

namespace App\Http\Controllers;

use App\Category;
use App\Plan;
use App\Real;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class RealController extends Controller
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
    public function index()
    {
        //
        // $uid = Auth::id();
        // $real = Real::where('user_id', $uid)->get();
        // $user = Auth::user();
        // return view('real.rekap', ['reals' => $real, 'user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $user = Auth::user();
        $planId = $request->input('plan');
        $plan = Plan::where('id', $planId)->get();
        return view('rop.real', ['plan' => $plan, 'user' => $user]);
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
            'plan_id'       => 'required|numeric',
            'realTanggal'   => 'required',
            'realBudget'    => 'required|numeric|min:1000',
            'realSource'    => 'required',
            'realTarget'    => 'required',
            // 'description'    => 'required',
            // 'file'          => 'required',
        ]);

        $file = $request->file('file');
        if ($file) {
            $tujuan_upload = 'file';
            $file->move($tujuan_upload, $file->getClientOriginalName());
        }
        $real = new Real();
        $real->user_id = Auth::id();
        $real->plan_id = $request->plan_id;
        $real->realTanggal = $request->realTanggal;
        $real->realBudget = $request->realBudget;
        $real->realSource = $request->realSource;
        $real->realTarget = $request->realTarget;
        $real->description = $request->description;
        if ($file) {
            $real->report = URL::to('/file') . '/' . $file->getClientOriginalName();
        } else {
            $real->report = null;
        }
        $real->save();

        return redirect()->route('real')->with('alert-success', 'Berhasil Menambahkan Data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Real  $Real
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // return view('real.detail', ['real' => Real::where('id', $id)->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Real  $Real
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categories = Category::getParent()->orderBy('id', 'ASC')->get();
        $real = Real::where('id', $id)->first();
        $user = Auth::user();
        return view('rop.real', ['real' => $real, 'categories' => $categories, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Real  $Real
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'plan_id'       => 'required|numeric',
            'realTanggal'   => 'required',
            'realBudget'    => 'required|numeric|min:1000',
            'realSource'    => 'required',
            'realTarget'    => 'required',
        ]);

        $real = Real::where('id', $id)->first();
        $real->user_id = Auth::id();
        $real->plan_id = $request->plan_id;
        $real->realTanggal = $request->realTanggal;
        $real->realBudget = $request->realBudget;
        $real->realSource = $request->realSource;
        $real->realTarget = $request->realTarget;
        $real->description = $request->description;
        $real->save();

        return redirect()->route('real')->with('alert-success', 'Data Berhasil Update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Real  $Real
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = Real::where('id', $id)->delete();
        return redirect()->route('real')->with('success', 'Data berhasi dihapus!');
    }
}