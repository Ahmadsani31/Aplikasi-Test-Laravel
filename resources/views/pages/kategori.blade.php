@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')
@section('content')
    <!-- [ breadcrumb ] start -->
    <x-breadcrumb title="{{ $pageTitle }}" :links="[
        'Dashboard' => route('dashboard'),
        $pageTitle => '#',
    ]" />

    <!-- [ breadcrumb ] end -->
    @can('kategori-list')
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ Typography ] start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex align-items-start justify-content-between">
                        <h4>Data Katagori</h4>
                        @can('kategori-create')
                            <button class="btn btn-primary btn-sm modal-cre" id="kategori" parent="0" judul="Tambah Bahan Baku"><i
                                    class="fa-solid fa-square-plus"></i> |
                                Tambah</button>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table class="table table-hover text-center">
                            <thead class="table-info">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($kategori) > 0)
                                    @foreach ($kategori as $index => $item)
                                        <tr>
                                            <th>{{ $kategori->firstItem() + $index }}</th>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $carbon::create($item->created_at)->format('d F Y') }}</td>
                                            <td>
                                                @can('kategori-edit')
                                                    <button type="button" class="btn btn-sm btn-outline m-1 modal-cre"
                                                        id="kategori" parent="{{ $item->id }}"><i
                                                            class="fa-solid text-primary fa-pen-to-square fa-xl"></i></button>
                                                @endcan
                                                @can('kategori-delete')
                                                    <button type="button" class="btn btn-outline btn-sm m-1 modal-del"
                                                        tabel="kategori" id="{{ $item->id }}"><i
                                                            class="fa-solid text-danger fa-trash-can fa-xl"></i></button>
                                                @endcan

                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4"><i>Empty</i></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {{ $kategori->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    @endcan

    <!-- [ Typography ] end -->
@endsection
