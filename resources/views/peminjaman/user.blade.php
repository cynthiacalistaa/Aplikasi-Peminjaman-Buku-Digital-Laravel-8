@extends('template')

@section('content')
<div class="card mt-3 mx-4">
    <h5 class="card-header">Pengguna Perpusta</h5>
    <div class="card-body">
        <a href="{{ route('cetak.pengguna') }}" class="btn btn-primary mb-3">Cetak Pengguna</a>
        <div class="card-datatable text-nowrap">
            <table class="dt-complex-header table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama Pengguna</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $i => $v)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$v->username}}</td>
                        <td>{{$v->namalengkap}}</td>
                        <td>{{$v->email}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
