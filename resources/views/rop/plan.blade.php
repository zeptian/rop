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

                    @if(isset($plan->id))
                    <form method="post" enctype="multipart/form-data" action="{{ route('plan.update', ['id'=>$plan->id]) }}">
                        @csrf
                        {{ method_field('PUT') }}
                    @else
                    <form method="post" enctype="multipart/form-data" action="{{ route('plan.create')}}">
                        @csrf
                    @endif
                    <h4>Laporan {{$user->name}}</h4>
                    <div class="form-group row">
                        <label for="Kategori" class="col-md-4 col-form-label text-md-right">Kategori</label>
                        <div class="col-md-6">
                            <select name="category" id="Kategori" class="form-control @error('category') is-invalid @enderror" >
                                @if (isset($plan->category))
                                <option value="{{$plan->category->id}}">{{$plan->category->category}}</option>
                                @else
                                <option value=""></option>                                    
                                @endif
                                @foreach ($categories as $category)
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
                        <label for="Kategori" class="col-md-4 col-form-label text-md-right">Sub-Kategori</label>
                        <div class="col-md-6">
                            <select name="subcategory" id="SubKategori" class="form-control @error('subcategory') is-invalid @enderror" >
                                @if (isset($plan->subcategory))
                                <option value="{{$plan->subcategory->id}}">{{$plan->subcategory->category}}</option>
                                @endif
                               
                            </select>
                            @error('subcategory')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Kegiatan" class="col-md-4 col-form-label text-md-right">Kegiatan</label>
                        <div class="col-md-6">
                            <input id="action" type="text" class="form-control @error('action') is-invalid @enderror" name="action" value="{{ $plan->action ?? old('action') }}" required>
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
                            <input id="planTanggal" type="text" class="form-control @error('planTanggal') is-invalid @enderror" name="planTanggal" value="{{ $plan->planTanggal ?? old('planTanggal') }}" required>
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
                            <input id="planBudget" type="number" min="1000" class="form-control @error('planBudget') is-invalid @enderror" name="planBudget" value="{{ $plan->planBudget ?? old('planBudget') }}" required >
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
                            <input id="planSource" type="text" class="form-control @error('planSource') is-invalid @enderror" name="planSource" value="{{ $plan->planSource ?? old('planSource') }}" required >
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
                            <input id="planTarget" type="text" class="form-control @error('planTarget') is-invalid @enderror" name="planTarget" value="{{ $plan->planTarget ?? old('planTarget') }}" required >
                            @error('planTarget')
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
