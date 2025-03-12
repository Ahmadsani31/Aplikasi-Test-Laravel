@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')
@section('content')
    <!-- [ breadcrumb ] start -->
    <x-breadcrumb title="{{ $pageTitle }}" :links="[
        'Dashboard' => route('dashboard'),
        $pageTitle => '#',
    ]" />

    <!-- [ breadcrumb ] end -->
    @can('bmi-list')
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ Typography ] start -->
            @can('bmi-create')
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('bmi') }}" onsubmit="return false" method="post" id="form-action">
                                @csrf
                                <x-forms.form-input label="Nama" type="text" name="name" placeholder="..." />
                                <div class="row">
                                    <div class="col-md-6">
                                        <x-forms.form-input label="Berat Badan" type="number" name="weight" placeholder="cm" />
                                    </div>
                                    <div class="col-md-6">
                                        <x-forms.form-input label="Tinggi Badan" type="number" name="height" placeholder="cm" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Gender</label>
                                    <select class="form-control select-2" name="gender" id="gender">
                                        {!! OptionCreate(['male', 'female'], ['Laki-Laki', 'Perempuab'], '') !!}
                                    </select>
                                </div>
                                <div class="d-grib">
                                    <button type="submit" class="btn btn-primary">Calculate Ideal</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            @endcan
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Result BMI Calculator</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover text-center">
                            <thead class="table-info">
                                <tr>
                                    <th scope="col">No</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Berat (kg)</th>
                                    <th>Tinggi (cm)</th>
                                    <th>BMI</th>
                                    <th>Kategori</th>
                                    <th>Berat Ideal</th>
                                    <th scope="col">Tanggal</th>
                                    @can('bmi-delete')
                                        <td>Aksi</td>
                                    @endcan

                                </tr>
                            </thead>
                            <tbody>
                                @if (count($bmi) > 0)
                                    @foreach ($bmi as $index => $item)
                                        <tr>
                                            <th>{{ $bmi->firstItem() + $index }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->gender == 'male' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                            <td>{{ $item->weight }}</td>
                                            <td>{{ $item->height }}</td>
                                            <td>{{ number_format($item->bmi, 2) }}</td>
                                            <td>{{ $item->category }}</td>
                                            <td>{{ number_format($item->ideal_weight, 2) }} kg</td>
                                            <td>{{ $carbon::create($item->created_at)->format('d F Y') }}</td>
                                            @can('bmi-delete')
                                                <td>
                                                    <button type="button" class="btn btn-outline btn-sm m-1 modal-del"
                                                        tabel="bmi" id="{{ $item->id }}"><i
                                                            class="fa-solid text-danger fa-trash-can fa-xl"></i></button>
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10"><i>Empty</i></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {{ $bmi->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    @endcan

@endsection
@pushOnce('scripts')
    <script>
        $("form#form-action").on("submit", function(event) {
            event.preventDefault();
            $('#page-pre-loader').show();

            const form = this;
            let settings = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            };
            axios.post($(form).attr('action'), form, settings)
                .then(response => {
                    $('#page-pre-loader').hide();

                    $('input').removeClass('is-invalid');
                    $('textarea').removeClass('is-invalid');
                    $('select').removeClass('is-invalid');
                    if (response.data.param == true) {
                        Toast.fire({
                            icon: 'success',
                            title: response.data.message,
                        });
                        location.reload();

                    } else {
                        Toast.fire({
                            icon: 'warning',
                            title: response.data.message,
                        });
                    }
                    console.log(response)
                }).catch(error => {
                    $('#page-pre-loader').hide();

                    $('input').removeClass('is-invalid');
                    $('textarea').removeClass('is-invalid');
                    $('select').removeClass('is-invalid');
                    if (error.response.status == 422) {
                        let msg = error.response.data.errors;
                        $.each(msg, function(key, value) {
                            console.log(key);
                            console.log(value);

                            $('#error-' + key).html(value[0]);
                            $('#' + key).addClass('is-invalid');
                        });

                        Swal.fire({
                            title: "Kesalahan",
                            text: error.response.data.message,
                            icon: "warning",

                        });
                    } else {
                        Swal.fire({
                            title: "Kesalahan",
                            text: "error sistem",
                            icon: "error",
                            showConfirmButton: false,
                        });
                    }

                    console.log(error.response.data.message)
                });
        });
    </script>
@endPushOnce
