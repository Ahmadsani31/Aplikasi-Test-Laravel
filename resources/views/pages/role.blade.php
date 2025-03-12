@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')
@section('content')
    <!-- [ breadcrumb ] start -->
    <x-breadcrumb title="{{ $pageTitle }}" :links="[
        'Dashboard' => route('dashboard'),
        $pageTitle => '#',
    ]" />

    <!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- [ Typography ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex align-items-start justify-content-between">
                    <h4>Data Katagori</h4>
                    <button class="btn btn-primary btn-sm modal-cre" id="role" parent="0" judul="Tambah Role"><i
                            class="fa-solid fa-square-plus"></i> |
                        Tambah</button>
                </div>
                <div class="card-body">
                    <table class="table table-hover text-center">
                        <thead class="table-info">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Permission</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($role) > 0)
                                @foreach ($role as $index => $item)
                                    <tr>
                                        <th>{{ $role->firstItem() + $index }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @foreach ($item->permissions as $permission)
                                                <li>{{ $permission->name }}</li>
                                            @endforeach
                                        </td>
                                        <td>{{ $carbon::create($item->created_at)->format('d F Y') }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline m-1 modal-cre"
                                                id="role" parent="{{ $item->id }}" judul="Edit Role"><i
                                                    class="fa-solid text-primary fa-pen-to-square fa-xl"></i></button>
                                            <button type="button" class="btn btn-outline btn-sm m-1 modal-del"
                                                tabel="role" id="{{ $item->id }}"><i
                                                    class="fa-solid text-danger fa-trash-can fa-xl"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5"><i>Empty</i></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $role->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
    <!-- [ Typography ] end -->
@endsection
