@extends('layouts.app')

@section('content')
<div class="" style="padding: 30px">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lapor Rencana Operasional</div>
                <div class="card-header alert-success">
                    <h4>Laporan {{$user->name}}</h4>
                    <form action="{{route('real')}}">
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
                                <th colspan="4">Rencana</th>
                                <th rowspan="2">Aksi</th>
                            </tr>
                            <tr>
                                <th>Waktu Pelaksanaan</th>
                                <th>Biaya</th>
                                <th>Sumber dana</th>
                                <th>Sasaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plans as $plan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $plan->user->name }}</td>
                                    <td>{{ $plan->category->category }}</td>
                                    <td>{{ $plan->subcategory->category }}</td>
                                    <td>{{ $plan->action }}</td>
                                    <td>{{ $plan->planTanggal }}</td>
                                    <td>{{ number_format($plan->planBudget,2) }}</td>
                                    <td>{{ $plan->planSource }}</td>
                                    <td>{{ $plan->planTarget }}</td>
                                    <td>
                                        <form action="{{route('real.create')}}" method="get">
                                            <input type="hidden" name="plan" value="{{$plan->id}}">
                                            <button class="btn btn-sm btn-success">Realisasi</button>
                                        </form>
                                        <form action="{{ route('plan.destroy', ['id'=>$plan->id]) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <a href="{{ route('plan.edit',['id'=>$plan->id]) }}" class=" btn btn-sm btn-primary">Edit</a>
                                            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                {{-- <tr><td colspan="2" class="text-right">Realisasi</td><td colspan="7"></td></tr> --}}
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
</script>
@endsection