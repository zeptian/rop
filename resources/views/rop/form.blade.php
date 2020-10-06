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

                    @if(isset($rop->id))
                    <form method="post" action="{{ route('rop.update', ['id'=>$rop->id]) }}">
                        @csrf
                        {{ method_field('PUT') }}
                    @else
                    <form method="post" action="{{ route('rop.create')}}">
                        @csrf
                    @endif

                    <div class="form-group row">
                        <label for="Kategori" class="col-md-4 col-form-label text-md-right">Kategori</label>
                        <div class="col-md-6">
                            <select name="category" id="Kategori" class="form-control @error('action') is-invalid @enderror" >
                                <option></option>
                                @foreach ($categories as $category)
                                    @if (old('action')==$category->id)
                                        $select = "selected";
                                    @elseif(isset($rop->category->category) && $rop->category->category==$category->id)
                                        $select = "selected" ;
                                    @endif
                                    <option value="{{$category->id}}" {{$select??''}}>{{$category->category}}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Kegiatan" class="col-md-4 col-form-label text-md-right">Kegiatan</label>
                        <div class="col-md-6">
                            <input id="action" type="text" class="form-control @error('action') is-invalid @enderror" name="action" value="{{ $rop->action ?? old('action') }}" required>
                            @error('action')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="planTanggal" class="col-md-4 col-form-label text-md-right">Rencana Waktu Pelaksanaan</label>
                        <div class="col-md-6">
                            <input id="planTanggal" type="text" class="form-control @error('planTanggal') is-invalid @enderror" name="planTanggal" value="{{ $rop->planTanggal ?? old('planTanggal') }}" required>
                            @error('planTanggal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="planBudget" class="col-md-4 col-form-label text-md-right">Rencana Anggaran</label>
                        <div class="col-md-6">
                            <input id="planBudget" type="number" min="1000" class="form-control @error('planBudget') is-invalid @enderror" name="planBudget" value="{{ $rop->planBudget ?? old('planBudget') }}" required >
                            @error('planBudget')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="planSource" class="col-md-4 col-form-label text-md-right">Rencana Sumber Dana</label>
                        <div class="col-md-6">
                            <input id="planSource" type="text" class="form-control @error('planSource') is-invalid @enderror" name="planSource" value="{{ $rop->planSource ?? old('planSource') }}" required >
                            @error('planSource')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="planTarget" class="col-md-4 col-form-label text-md-right">Rencana Sasaran</label>
                        <div class="col-md-6">
                            <input id="planTarget" type="text" class="form-control @error('planTarget') is-invalid @enderror" name="planTarget" value="{{ $rop->planTarget ?? old('planTarget') }}" required >
                            @error('planTarget')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="realTanggal" class="col-md-4 col-form-label text-md-right">Realisasi Waktu Pelaksanaan</label>
                        <div class="col-md-6">
                            <input id="realTanggal" type="text" class="form-control @error('realTanggal') is-invalid @enderror" name="realTanggal" value="{{ $rop->realTanggal ?? old('realTanggal') }}" required>
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
                            <input id="realBudget" type="number" min="1000" class="form-control @error('realBudget') is-invalid @enderror" name="realBudget" value="{{ $rop->realBudget ?? old('realBudget') }}" required >
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
                            <input id="realSource" type="text" class="form-control @error('realSource') is-invalid @enderror" name="realSource" value="{{ $rop->realSource ?? old('realSource') }}" required >
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
                            <input id="realTarget" type="text" class="form-control @error('realTarget') is-invalid @enderror" name="realTarget" value="{{ $rop->realTarget ?? old('realTarget') }}" required >
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
                            <textarea id="description"  class="form-control @error('description') is-invalid @enderror" name="description">{{ $rop->description ?? old('description') }}</textarea>
                            @error('description')
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

<script>
$('form').on('focus', 'input[type=number]', function (e) {
  $(this).on('wheel.disableScroll', function (e) {
    e.preventDefault()
  })
})
$('form').on('blur', 'input[type=number]', function (e) {
  $(this).off('wheel.disableScroll')
})
</script>
@endsection
