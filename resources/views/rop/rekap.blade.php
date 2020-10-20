@extends('layouts.app')

@section('content')
<div class="" style="padding: 30px">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lapor Rencana Operasional</div>

                <div class="card-header alert-success">
                    <h4>Laporan {{$user->name}}</h4>
                    <form action="{{route('plan')}}">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-md-right">Kategori</label>
                            <div class="col-md-4">
                                <select name="category" id="Kategori" class="form-control" >
                                    <option value="all">- Semua -</option>        
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}"  @if ($q['category']==$category->id) {{'selected'}} @endif>{{$category->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <label class="col-md-2 col-form-label text-md-right">Sub-Kategori</label>
                            <div class="col-md-4">
                                <select name="subcategory" id="SubKategori" class="form-control" >
                                    <option value="all">- Semua -</option>                                   
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Kategori" class="col-md-2 col-form-label text-md-right">Pelaksanaan</label>
                            <div class="col-md-4">
                                <select name="pelaksana" id="pelaksana" class="form-control " >
                                    @if ($user->role=='admin')
                                        <option value="all">- Semua -</option>        
                                        @foreach ($users as $pelaksana)
                                        {{$pelaksana}}
                                        <option value="{{$pelaksana->id}}" @if ($q['pelaksana']==$pelaksana->id) {{'selected'}} @endif>{{$pelaksana->name}}</option>
                                        @endforeach
                                    @else
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endif
                                   
                                </select>
                            </div>
                            <label for="sumber" class="col-md-2 col-form-label text-md-right">Sumber Dana</label>
                            <div class="col-md-4">
                                <select name="sumber" id="sumber" class="form-control">
                                    <option value="all">- Semua -</option>
                                    <option @if ($q['sumber']=='APBN') {{'selected'}} @endif>APBN</option>
                                    <option @if ($q['sumber']=='APBD I') {{'selected'}} @endif>APBD I</option>
                                    <option @if ($q['sumber']=='APBD II') {{'selected'}} @endif>APBD II</option>
                                    <option @if ($q['sumber']=='DID') {{'selected'}} @endif>DID</option>
                                    <option @if ($q['sumber']=='DBHCHT') {{'selected'}} @endif>DBHCHT</option>
                                    <option @if ($q['sumber']=='BTT') {{'selected'}} @endif>BTT</option>
                                </select>
                            </div>
                        </div>                        
                        <div class="form-group row">
                            <div class="offset-2 col-md-2">
                                <button type="submit" class="btn btn-primary btn-sm">Lihat</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div style="overflow: scroll">
                    <table class="table" id="data">
                        <thead>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Penginput</th>
                                <th rowspan="2">Kategori</th>
                                <th rowspan="2">Sub Kategori</th>
                                <th rowspan="2">Kegiatan</th>
                                <th colspan="4" class="left">Rencana</th>
                                <th colspan="4" class="left">Realisasi</th>
                                <th rowspan="2">Penyedia</th>
                                <th colspan="4" class="left">Kontrak</th>
                                <th colspan="2" class="left">Berita Acara Serah Terima</th>
                                <th rowspan="2" class="left">Metode</th>
                                <th rowspan="2" class="left">Keterangan</th>
                                <th rowspan="2">Lampiran</th>
                                <th rowspan="2">Aksi</th>
                            </tr>
                            <tr>
                                <th class="left">Waktu Pelaksanaan</th>
                                <th>Biaya</th>
                                <th>Sumber dana</th>
                                <th>Sasaran</th>

                                <th class="left">Waktu Pelaksanaan</th>
                                <th>Biaya</th>
                                <th>Sumber dana</th>
                                <th>Sasaran</th>

                                <th>Tanggal Kontrak</th>
                                <th>Nomor Kontrak</th>
                                <th>Jangka Waktu</th>
                                <th>Sampai</th>

                                <th>Nomor BAST</th>
                                <th>Tanggal BAST</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plans as $plan)
                            @php
                                $jmlReal = count($plan->real);
                                if ($jmlReal==0) {
                                    $jmlReal=1;
                                }
                            @endphp
                                <tr>
                                    <td rowspan="{{$jmlReal}}">{{ $loop->iteration }}</td>
                                    <td rowspan="{{$jmlReal}}">{{ $plan->user->name }}</td>
                                    <td rowspan="{{$jmlReal}}">{{ $plan->category->category }}</td>
                                    <td rowspan="{{$jmlReal}}">{{ $plan->subcategory->category }}</td>
                                    <td rowspan="{{$jmlReal}}">{{ $plan->action }}</td>
                                    <td rowspan="{{$jmlReal}}"  class="left">{{ $plan->planTanggal }}</td>
                                    <td rowspan="{{$jmlReal}}">{{ number_format($plan->planBudget,2) }}</td>
                                    <td rowspan="{{$jmlReal}}">{{ $plan->planSource }}</td>
                                    <td rowspan="{{$jmlReal}}">{{ $plan->planTarget }}</td>

                                @isset($plan->real)
                                    @foreach ($plan->real as $real)
                                        @php
                                            $month_name = $real->realTanggal;
                                            if (is_numeric($real->realTanggal)) {
                                                $month_name = date("F", mktime(0, 0, 0, $real->realTanggal, 10));    
                                            }
                                        @endphp
                                        @if ($loop->iteration > 1)
                                            <tr>
                                        @endif
                                                <td  class="left">{{ $month_name }}</td>
                                                <td>{{ number_format($real->realBudget,2) }}</td>
                                                <td>{{ $real->realSource }}</td>
                                                <td>{{ $real->realTarget }}</td>
                                                <td>{{ $real->penyedia }}</td>
                                                <td>{{ $real->noKontrak }}</td>
                                                <td>{{ $real->tglKontrak }}</td>
                                                <td>{{ $real->startKontrak }}</td>
                                                <td>{{ $real->endKontrak }}</td>
                                                <td>{{ $real->noBAST }}</td>
                                                <td>{{ $real->tglBAST }}</td>
                                                <td>{{ $real->metode }}</td>
                                                <td class="left">{{ $real->description }}</td>
                                                <td>@if ($real->report)
                                                    <a href="{{ $real->report }}" target="_blank" class="btn btn-sm btn-success" >Download</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('real.destroy', ['id'=>$real->id]) }}" method="post">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <a href="{{ route('real.edit',['id'=>$real->id]) }}" class=" btn btn-sm btn-primary">Edit</a>
                                                        <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
                                                    </form>
                                                </td>
                                                @if ($loop->iteration > 1)
                                            </tr>
                                            @endif
                                            @endforeach
                                @endif
                                </tr>
                            @endforeach
                        <tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready( function () {
    $('#data').DataTable();
} );

$("#Kategori").change(function(){
    category = $(this).val();
    console.log(category);
    $.get("{{route('ajax.subcategory')}}",{category:category},
        function(data){
            if(data.status){
                sub = data.data;
                opt = "<option value='all'>- Semua -</option>";
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
