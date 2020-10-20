<?php

namespace App\Http\Controllers;

use App\Category;
use App\Plan;
use App\Real;
use App\User;
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
    public function index(Request $request)
    {
        //
        $user = Auth::user();
        $role = $user->role;
        $uid = $user->id;
        $category = $request->input('category');
        $subcategory = $request->input('subcategory');
        $pelaksana = $request->input('pelaksana');
        $sumber = $request->input('sumber');

        // if ($role == 'admin') {
        //     $plan = Plan::all();
        // } else {
        //     $plan = Plan::where('user_id', $uid)->get();
        // }
        if ($category && $category != 'all') {
            $where[] = ['category_id', $category];
        }
        if ($subcategory && $subcategory != 'all') {
            $where[] = ['subcategory_id', $subcategory];
        }
        if ($pelaksana && $pelaksana != 'all') {
            $uid = $pelaksana;
        }
        if ($sumber && $sumber != 'all') {
            $where[] = ['planSource', $sumber];
        }
        $where[] = ['user_id', $uid];
        $plan = Plan::where($where)->get();
        $q = compact('category', 'subcategory', 'pelaksana', 'sumber');
        $categories = Category::getParent()->orderBy('id', 'ASC')->get();
        $users      = User::select('name')->get();
        return view('rop.rekap', ['plans' => $plan, 'user' => $user, 'categories' => $categories, 'users' => $users, 'q' => $q]);
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
        $plan = Plan::with('category')->where('id', $planId)->get()->first();
        if (!$plan) {
            return redirect()->route('plan')->with('alert-danger', 'pilih rencana!');
        }
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
            'realBudget'    => 'required',
            'realSource'    => 'required',
            'realTarget'    => 'required',
            // 'description'    => 'required',
            // 'file'          => 'required',
        ]);
        $realBudget = str_replace(',', '', $request->realBudget);
        if ((float)$realBudget >= 10000000) {
            $this->validate($request, [
                'penyedia'      => 'required',
                'noKontrak'     => 'required',
                'tglKontrak'    => 'required',
                'startKontrak'  => 'required',
                'endKontrak'    => 'required',
                'noBAST'        => 'required',
                'tglBAST'       => 'required',
                'metode'        => 'required',
            ]);
        }

        $file = $request->file('file');
        if ($file) {
            $tujuan_upload = 'file';
            $file->move($tujuan_upload, $file->getClientOriginalName());
        }
        $real = new Real();
        $real->user_id = Auth::id();
        $real->plan_id = $request->plan_id;
        $real->realTanggal = $request->realTanggal;
        $real->realBudget = (float)$realBudget;
        $real->realSource = $request->realSource;
        $real->realTarget = $request->realTarget;
        $real->description = $request->description;

        if ((float)$realBudget >= 10000000) {
            $real->penyedia = $request->penyedia;
            $real->noKontrak = $request->noKontrak;
            $real->tglKontrak = $request->tglKontrak;
            $real->startKontrak = $request->startKontrak;
            $real->endKontrak = $request->endKontrak;
            $real->noBAST = $request->noBAST;
            $real->tglBAST = $request->tglBAST;
            $real->metode = $request->metode;
        }

        if ($file) {
            $real->report = URL::to('/file') . '/' . $file->getClientOriginalName();
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
        $plan = Plan::with('category')->where('id', $real->plan_id)->get()->first();
        $user = Auth::user();
        return view('rop.real', ['plan' => $plan, 'real' => $real, 'categories' => $categories, 'user' => $user]);
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
            'realBudget'    => 'required',
            'realSource'    => 'required',
            'realTarget'    => 'required',
            // 'description'    => 'required',
            // 'file'          => 'required',
        ]);
        $realBudget = str_replace(',', '', $request->realBudget);
        if ((float)$realBudget >= 10000000) {
            $this->validate($request, [
                'penyedia'      => 'required',
                'noKontrak'     => 'required',
                'tglKontrak'    => 'required',
                'startKontrak'  => 'required',
                'endKontrak'    => 'required',
                'noBAST'        => 'required',
                'tglBAST'       => 'required',
                'metode'        => 'required',
            ]);
        }

        $file = $request->file('file');
        if ($file) {
            $tujuan_upload = 'file';
            $file->move($tujuan_upload, $file->getClientOriginalName());
        }
        $real = Real::where('id', $id)->first();
        $real->user_id = Auth::id();
        $real->plan_id = $request->plan_id;
        $real->realTanggal = $request->realTanggal;
        $real->realBudget = (float)$realBudget;
        $real->realSource = $request->realSource;
        $real->realTarget = $request->realTarget;
        $real->description = $request->description;

        if ((float)$realBudget >= 10000000) {
            $real->penyedia = $request->penyedia;
            $real->noKontrak = $request->noKontrak;
            $real->tglKontrak = $request->tglKontrak;
            $real->startKontrak = $request->startKontrak;
            $real->endKontrak = $request->endKontrak;
            $real->noBAST = $request->noBAST;
            $real->tglBAST = $request->tglBAST;
            $real->metode = $request->metode;
        }

        if ($file) {
            $real->report = URL::to('/file') . '/' . $file->getClientOriginalName();
        }
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