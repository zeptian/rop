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

                    <table class="table">
                        <thead>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Kegiatan</th>
                                <th colspan="4">Rencana</th>
                                <th colspan="4">Realisasi</th>
                                <th rowspan="2">Keterangan</th>
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

                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rops as $rop)
                                <tr>
                                    <td>1</td>
                                    <td>{{ $rop->action }}</td>
                                    <td>{{ $rop->planTanggal }}</td>
                                    <td>{{ $rop->planBudget }}</td>
                                    <td>{{ $rop->planSource }}</td>
                                    <td>{{ $rop->planTarget }}</td>
                                    <td>{{ $rop->realTanggal }}</td>
                                    <td>{{ $rop->realBudget }}</td>
                                    <td>{{ $rop->realSource }}</td>
                                    <td>{{ $rop->realTarget }}</td>
                                    <td>{{ $rop->description }}</td>
                                    <td>{{ $rop->report }}</td>
                                    <td>
                                        <form action="{{ route('rop.destroy', ['id'=>$rop->id]) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <a href="{{ route('rop.show',['id'=>$rop->id]) }}" class=" btn btn-sm btn-success">Detail</a>
                                            <a href="{{ route('rop.edit',['id'=>$rop->id]) }}" class=" btn btn-sm btn-primary">Edit</a>
                                            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        <tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
