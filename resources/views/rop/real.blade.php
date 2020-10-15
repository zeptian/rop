@extends('layouts.app')

@section('content')
<div style="padding: 30px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lapor Rencana Operasional</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(isset($real->id))
                    <form method="post" enctype="multipart/form-data" action="{{ route('real.update', ['id'=>$real->id]) }}">
                        @csrf
                        {{ method_field('PUT') }}
                    @else
                    <form method="post" enctype="multipart/form-data" action="{{ route('real.create')}}">
                        @csrf
                    @endif
                    <h4>Laporan Realisasi {{$user->name}}</h4>
                    
                    <table class="table">
                        <tr>
                            <td>Kategori</td><td>:</td><td>{{$plan->category->category}}</td>
                            <td>SubKategori</td><td>:</td><td>{{$plan->subcategory->category}}</td>
                        </tr>
                        <tr>
                            <td>Kegiatan</td><td>:</td><td>{{$plan->action}}</td>
                            <td>Waktu Pelaksanaan</td><td>:</td><td>{{$plan->planTanggal}}</td>
                        </tr>
                        <tr>
                            <td>Anggaran</td><td>:</td><td>{{$plan->planBudget}}</td>
                            <td>Sumber Dana</td><td>:</td><td>{{$plan->planSource}}</td>
                        </tr>
                        <tr>
                            <td>Sasaran</td><td>:</td><td>{{$plan->planTarget}}</td>
                            <td colspan="3"></td>
                        </tr>
                    </table>
                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                    <div class="form-group row">
                        <label for="realTanggal" class="col-md-4 col-form-label text-md-right">Realisasi Waktu Pelaksanaan</label>
                        <div class="col-md-6">
                            <input id="realTanggal" type="text" class="form-control @error('realTanggal') is-invalid @enderror" name="realTanggal" value="{{ $real->realTanggal ?? old('realTanggal') }}" required>
                            @error('realTanggal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="realBudget" class="col-md-4 col-form-label text-md-right">Realisasi Anggaran</label>
                        <div class="col-md-6">
                            <input id="realBudget" type="text" class="form-control inputmask @error('realBudget') is-invalid @enderror"  name="realBudget" value="{{ $real->realBudget ?? old('realBudget') }}" required >
                            @error('realBudget')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="realSource" class="col-md-4 col-form-label text-md-right">Realisasi Sumber Dana</label>
                        <div class="col-md-6">
                            <select name="realSource" id="realSource" class="form-control @error('realSource') is-invalid @enderror">
                                <option>{{ $real->realSource ?? old('realSource') }}</option>
                                <option>APBN</option>
                                <option>APBD I</option>
                                <option>APBD II</option>
                                <option>DID</option>
                                <option>DBHCHT</option>
                                <option>BTT</option>
                            </select>
                            @error('realSource')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="realTarget" class="col-md-4 col-form-label text-md-right">Realisasi Sasaran</label>
                        <div class="col-md-6">
                            <input id="realTarget" type="text" class="form-control @error('realTarget') is-invalid @enderror" name="realTarget" value="{{ $real->realTarget ?? old('realTarget') }}" required >
                            @error('realTarget')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div id="kontrak" style="display: none">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <h3 class="text-md-right">Kontrak</h3>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="penyedia" class="col-md-4 col-form-label text-md-right">Penyedia</label>
                        <div class="col-md-6">
                            <input id="penyedia" type="text" class="form-control @error('penyedia') is-invalid @enderror" name="penyedia" value="{{ $real->penyedia ?? old('penyedia') }}" >
                            @error('penyedia')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="noKontrak" class="col-md-4 col-form-label text-md-right">Nomor Kontrak</label>
                        <div class="col-md-6">
                            <input id="noKontrak" type="text" class="form-control @error('noKontrak') is-invalid @enderror" name="noKontrak" value="{{ $real->noKontrak ?? old('noKontrak') }}" >
                            @error('noKontrak')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tglKontrak" class="col-md-4 col-form-label text-md-right">Tanggal Kontrak</label>
                        <div class="col-md-6">
                            <input id="tglKontrak" type="text" class="form-control @error('tglKontrak') is-invalid @enderror" name="tglKontrak" value="{{ $real->tglKontrak ?? old('tglKontrak') }}" >
                            @error('tglKontrak')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="startKontrak" class="col-md-4 col-form-label text-md-right">Jangka Waktu Kontrak</label>
                        <div class="col-md-3">
                            <input id="startKontrak" type="text" class="form-control @error('startKontrak') is-invalid @enderror" name="startKontrak" value="{{ $real->startKontrak ?? old('startKontrak') }}" >
                            @error('startKontrak')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> Sampai
                        <div class="col-md-3">
                            <input id="endKontrak" type="text" class="form-control @error('endKontrak') is-invalid @enderror" name="endKontrak" value="{{ $real->endKontrak ?? old('endKontrak') }}" >
                            @error('endKontrak')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="noBAST" class="col-md-4 col-form-label text-md-right">No BAST</label>
                        <div class="col-md-6">
                            <input id="noBAST" type="text" class="form-control @error('noBAST') is-invalid @enderror" name="noBAST" value="{{ $real->noBAST ?? old('noBAST') }}" >
                            @error('noBAST')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tglBAST" class="col-md-4 col-form-label text-md-right">Tanggal BAST</label>
                        <div class="col-md-6">
                            <input id="tglBAST" type="text" class="form-control @error('tglBAST') is-invalid @enderror" name="tglBAST" value="{{ $real->tglBAST ?? old('tglBAST') }}" >
                            @error('tglBAST')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="metode" class="col-md-4 col-form-label text-md-right">Metode Pengadaan</label>
                        <div class="col-md-6">
                            <input id="metode" type="text" class="form-control @error('metode') is-invalid @enderror" name="metode" value="{{ $real->metode ?? old('metode') }}" >
                            @error('metode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    </div>
                    <div class="form-group row">
                        <label for="Keterangan" class="col-md-4 col-form-label text-md-right">Keterangan</label>
                        <div class="col-md-6">
                            <textarea id="description"  class="form-control @error('description') is-invalid @enderror" name="description">{{ $real->description ?? old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Lampiran" class="col-md-4 col-form-label text-md-right">Lampiran</label>
                        <div class="col-md-6">
                            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<script>

$(".inputmask").inputmask({
   alias: 'numeric', 
   groupSeparator: ',',
   digits: 2,
   digitsOptional: false
});
$("#realBudget").change(function(){
    var budget = $("#realBudget").val();
    console.log(budget);
    budget = budget.replaceAll(",","");
    console.log(budget);
    if(budget>=10000000){
        $("#kontrak").show();
        console.log('lebih');
    }else{
        $("#kontrak").hide();
        console.log('kurang');
    }
})
</script>
@endsection
