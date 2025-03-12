@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')
@section('content')
    <!-- [ breadcrumb ] start -->
    <x-breadcrumb title="{{ $pageTitle }}" :links="[
        'Dashboard' => route('dashboard'),
        $pageTitle => '#',
    ]" />

    @can('comparison-list')
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ Typography ] start -->
            @can('comparison-create')
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('compare-texts') }}" onsubmit="return false" method="post" id="form-action">
                                @csrf
                                <x-forms.form-textarea label="Plaint Text" name="input2" placeholder="Tulis text" rows="5" />
                                <x-forms.form-input label="Karakter Comparison" type="text" name="input1" placeholder="..." />
                                <div class="d-grib">
                                    <button type="submit" class="btn btn-primary">Comparison Text</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            @endcan

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Result Text Comparison</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover text-center">
                            <thead class="table-info">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Plaintext</th>
                                    <th scope="col">Comparasion</th>
                                    <th scope="col">Persen</th>
                                    <th scope="col">Match Karakter</th>
                                    <th scope="col">Karakter</th>
                                    <th scope="col">Tanggal</th>
                                    @can('comparison-delete')
                                        <th scope="col">Aksi</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($textComparison) > 0)
                                    @foreach ($textComparison as $index => $item)
                                        <tr>
                                            <th>{{ $textComparison->firstItem() + $index }}</th>
                                            <td>{{ $item->input2 }}</td>
                                            <td>{{ $item->input1 }}</td>
                                            <td>{{ $item->percentage }} %</td>
                                            <td>{{ $item->match_count }}</td>
                                            <td>{{ $item->matched_chars }}</td>
                                            <td>{{ $carbon::create($item->created_at)->format('d F Y') }}</td>
                                            @can('comparison-delete')
                                                <td>
                                                    <button type="button" class="btn btn-outline btn-sm m-1 modal-del"
                                                        tabel="comparison" id="{{ $item->id }}"><i
                                                            class="fa-solid text-danger fa-trash-can fa-xl"></i></button>
                                                </td>
                                            @endcan

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8"><i>Empty</i></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {{ $textComparison->links('pagination::bootstrap-5') }}
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
