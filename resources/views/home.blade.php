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
                        @php
                            isset($totalAnggaran) ? $totalAnggaran += $item->anggaran:$totalAnggaran=0;
                            isset($totalSerapan) ? $totalSerapan += $item->serapan:$totalSerapan=0;   
                        @endphp
                        <tr>
                            <td>{{$item->category}}</td>
                            <td class="text-right">{{number_format($item->anggaran)}}</td>
                            <td class="text-right">{{number_format($item->serapan)}}</td>
                            <td class="text-right">{{number_format(($item->serapan/$item->anggaran)*100,2) }}%</td>
                        </tr>
                    @endforeach
                        <tr>
                            <th class="text-right">TOTAL</th>
                            <th class="text-right">{{number_format($totalAnggaran)}}</th>
                            <th class="text-right">{{number_format($totalSerapan)}}</th>
                            <th class="text-right">{{number_format(($totalSerapan/$totalAnggaran)*100,2) }}%</th>
                        </tr>
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
                        @php
                            isset($totalAnggaran2) ? $totalAnggaran2 += $item->anggaran:$totalAnggaran2=0;
                            isset($totalSerapan2) ? $totalSerapan2 += $item->serapan:$totalSerapan2=0;   
                        @endphp
                        <tr>
                            <td>{{$item->name}}</td>
                            <td class="text-right">{{number_format($item->anggaran)}}</td>
                            <td class="text-right">{{number_format($item->serapan)}}</td>
                            <td class="text-right">{{number_format(($item->serapan/$item->anggaran)*100,2) }}%</td>
                        </tr>
                    @endforeach
                        <tr>
                            <th class="text-right">TOTAL</th>
                            <th class="text-right">{{number_format($totalAnggaran2)}}</th>
                            <th class="text-right">{{number_format($totalSerapan2)}}</th>
                            <th class="text-right">{{number_format(($totalSerapan2/$totalAnggaran2)*100,2) }}%</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
