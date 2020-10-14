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
                                <th rowspan="2">User</th>
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
                                    <td>{{ $plan->planBudget }}</td>
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
