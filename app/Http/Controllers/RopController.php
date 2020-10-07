<?php

namespace App\Http\Controllers;

use App\Category;
use App\Rop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class RopController extends Controller
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
        $uid = Auth::id();
        $rop = Rop::where('user_id', $uid)->get();
        $user = Auth::user();
        return view('rop.rekap', ['rops' => $rop, 'user' => $user]);
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
        return view('rop.form', ['categories' => $categories, 'user' => $user]);
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
            'category'   => 'required',
            'subcategory'   => 'required',
            'action'    => 'required',
            'planTanggal'   => 'required',
            'planBudget'    => 'required|numeric|min:1000',
            'planSource'    => 'required',
            'planTarget'    => 'required',
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
        $rop = new Rop();
        $rop->user_id = Auth::id();
        $rop->category_id = $request->category;
        $rop->subcategory_id = $request->subcategory;
        $rop->action = $request->action;
        $rop->planTanggal = $request->planTanggal;
        $rop->planBudget = $request->planBudget;
        $rop->planSource = $request->planSource;
        $rop->planTarget = $request->planTarget;
        $rop->realTanggal = $request->realTanggal;
        $rop->realBudget = $request->realBudget;
        $rop->realSource = $request->realSource;
        $rop->realTarget = $request->realTarget;
        $rop->description = $request->description;
        if ($file) {
            $rop->report = URL::to('/file') . '/' . $file->getClientOriginalName();
        } else {
            $rop->report = null;
        }
        $rop->save();

        return redirect()->route('rop')->with('alert-success', 'Berhasil Menambahkan Data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rop  $Rop
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('rop.detail', ['rop' => Rop::where('id', $id)->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rop  $Rop
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categories = Category::getParent()->orderBy('id', 'ASC')->get();
        $rop = Rop::where('id', $id)->first();
        $user = Auth::user();
        return view('rop.form', ['rop' => $rop, 'categories' => $categories, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rop  $Rop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'category'   => 'required',
            'action'    => 'required',
            'planTanggal'   => 'required',
            'planBudget'    => 'required|numeric|min:1000',
            'planSource'    => 'required',
            'planTarget'    => 'required',
            'realTanggal'   => 'required',
            'realBudget'    => 'required|numeric|min:1000',
            'realSource'    => 'required',
            'realTarget'    => 'required',
        ]);

        $rop = Rop::where('id', $id)->first();
        $rop->user_id = Auth::id();
        $rop->category_id = $request->category;
        $rop->action = $request->action;
        $rop->planTanggal = $request->planTanggal;
        $rop->planBudget = $request->planBudget;
        $rop->planSource = $request->planSource;
        $rop->planTarget = $request->planTarget;
        $rop->realTanggal = $request->realTanggal;
        $rop->realBudget = $request->realBudget;
        $rop->realSource = $request->realSource;
        $rop->realTarget = $request->realTarget;
        $rop->description = $request->description;
        $rop->save();

        return redirect()->route('rop')->with('alert-success', 'Data Berhasil Update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rop  $Rop
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = Rop::where('id', $id)->delete();
        return redirect()->route('rop')->with('success', 'Data berhasi dihapus!');
    }
}