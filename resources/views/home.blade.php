@extends('layouts.app')

@section('content')
<div class="" style="padding: 30px">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Menurut Kategori</div>

                <div class="card-body">
                    <table class="table">
                        <tr><th>Kategory</th><th>Rencana Anggaran</th><th>Realisasi</th><th>Prosentase</th></tr>
                    @foreach ($categories as $item)
                        <tr>
                            <td>{{$item->category}}</td>
                            <td>{{number_format($item->anggaran)}}</td>
                            <td>{{number_format($item->serapan)}}</td>
                            <td>{{number_format(($item->serapan/$item->anggaran)*100,2) }}%</td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Menurut Pelaksana</div>

                <div class="card-body">
                    <table class="table">
                        <tr><th>Pelaksana</th><th>Rencana Anggaran</th><th>Realisasi</th><th>Prosentase</th></tr>
                    @foreach ($actors as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{number_format($item->anggaran)}}</td>
                            <td>{{number_format($item->serapan)}}</td>
                            <td>{{number_format(($item->serapan/$item->anggaran)*100,2) }}%</td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
