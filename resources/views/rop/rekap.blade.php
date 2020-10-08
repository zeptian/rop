@extends('layouts.app')

@section('content')
<div class="" style="padding: 30px">
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
                    <h4>Laporan {{$user->name}}</h4>
                    <div style="overflow: scroll">
                    <table class="table">
                        <thead>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Kategori</th>
                                <th rowspan="2">Sub Kategori</th>
                                <th rowspan="2">Kegiatan</th>
                                <th colspan="4">Rencana</th>
                                <th colspan="4">Realisasi</th>
                                <th rowspan="2">Keterangan</th>
                                <th rowspan="2">Lampiran</th>
                                <th rowspan="2">Aksi</th>
                            </tr>
                            <tr>
                                <th>Waktu Pelaksanaan</th>
                                <th>Biaya</th>
                                <th>Sumber dana</th>
                                <th>Sasaran</th>

                                <th>Waktu Pelaksanaan</th>
                                <th>Biaya</th>
                                <th>Sumber dana</th>
                                <th>Sasaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plans as $plan)
                            @php
                                $jmlReal = count($plan->real);
                            @endphp
                                <tr>
                                    <td rowspan="{{$jmlReal}}">{{ $loop->iteration }}</td>
                                    <td rowspan="{{$jmlReal}}">{{ $plan->category->category }}</td>
                                    <td rowspan="{{$jmlReal}}">{{ $plan->subcategory->category }}</td>
                                    <td rowspan="{{$jmlReal}}">{{ $plan->action }}</td>
                                    <td rowspan="{{$jmlReal}}">{{ $plan->planTanggal }}</td>
                                    <td rowspan="{{$jmlReal}}">{{ $plan->planBudget }}</td>
                                    <td rowspan="{{$jmlReal}}">{{ $plan->planSource }}</td>
                                    <td rowspan="{{$jmlReal}}">{{ $plan->planTarget }}</td>
                                @foreach ($plan->real as $real)
                                    <td>{{ $real->realTanggal }}</td>
                                    <td>{{ $real->realBudget }}</td>
                                    <td>{{ $real->realSource }}</td>
                                    <td>{{ $real->realTarget }}</td>
                                    <td>{{ $real->description }}</td>
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
                                    </tr>
                                @endforeach
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
