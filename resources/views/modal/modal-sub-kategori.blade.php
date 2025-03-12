@inject('kategori', '\App\Models\Kategori')
@php
    $kategori = $kategori::all();
    foreach ($kategori as $key => $value) {
        $arrKategoriID[] = $value->id;
        $arrKategoriNama[] = $value->nama;
    }

@endphp
<form action="{{ route('sub-kategori.store') }}" onsubmit="return false" method="post" id="form-action">
    @csrf
    <input type="hidden" name="ID" value="{{ request()->parent }}">
    <div class="modal-body">
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select class="form-control select-2" name="kategori_id" id="kategori_id">
                {!! OptionCreate($arrKategoriID, $arrKategoriNama, '') !!}
            </select>
        </div>
        <x-forms.form-input label="Sub Kategori" type="text" name="nama" placeholder="Tulis program" required />
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
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
                    $('#myModals').modal('hide');
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
