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
                    <h4>Laporan {{$user->name}}</h4>
                    

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
                            <input id="realBudget" type="number" min="1000" class="form-control @error('realBudget') is-invalid @enderror" name="realBudget" value="{{ $real->realBudget ?? old('realBudget') }}" required >
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
                            <input id="realSource" type="text" class="form-control @error('realSource') is-invalid @enderror" name="realSource" value="{{ $real->realSource ?? old('realSource') }}" required >
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
$('form').on('focus', 'input[type=number]', function (e) {
  $(this).on('wheel.disableScroll', function (e) {
    e.preventDefault()
  })
})
$('form').on('blur', 'input[type=number]', function (e) {
  $(this).off('wheel.disableScroll')
})
$("#Kategori").change(function(){
    category = $(this).val();
    console.log(category);
    $.get("{{route('ajax.subcategory')}}",{category:category},
        function(data){
            if(data.status){
                sub = data.data;
                opt = '';
                for(i=0; i < sub.length; i++){
                    console.log(sub[i]);
                    opt += "<option value='"+sub[i].id+"'>"+sub[i].category+"</option>";
                }
                $("#SubKategori").html(opt);
            }
    })
})

</script>
@endsection
