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
                                    <td rowspan="{{$jmlReal}}">{{ $plan->planBudget }}</td>
                                    <td rowspan="{{$jmlReal}}">{{ $plan->planSource }}</td>
                                    <td rowspan="{{$jmlReal}}">{{ $plan->planTarget }}</td>

                                @isset($plan->real)
                                    @foreach ($plan->real as $real)
                                        @php
                                            $month_name = date("F", mktime(0, 0, 0, $real->realTanggal, 10));    
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
</script>
@endsection
