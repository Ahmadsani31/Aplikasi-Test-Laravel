@inject('role', '\Spatie\Permission\Models\Role')
@php
    $role = $role->all();
    foreach ($role as $val) {
        $roleName[] = $val->name;
    }
    $roleUser = '';
    $user = \App\Models\User::find(request()->parent);
    if ($user) {
        $name = $user->name;
        $email = $user->email;
        $level = $user->level;
        $status = $user->status;
        $roleUser = @$user->roles->pluck('name')[0];
    }

@endphp
<form action="{{ route('user.update', request()->parent) }}" onsubmit="return false" method="post" id="form-action">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <x-forms.form-input label="Nama" type="text" name="name" placeholder="Tulis nama" :value="$name" />
        <x-forms.form-input label="Email" type="email" name="email" placeholder="Tulis email" :value="$email" />
        <div class="mb-3">
            <label class="form-label">Role</label>
            <select class="form-control" name="role" id="role">
                {!! OptionCreate($roleName, $roleName, $roleUser) !!}
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select class="form-control select-2" name="status" id="status">
                {!! OptionCreate(['Y', 'N'], ['Aktif', 'Non Aktif'], '') !!}
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
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
                DTable.ajax.reload(null, false);
                if (response.data.param == true) {
                    $('#myModals').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: response.data.message,
                    });

                } else {
                    Toast.fire({
                        icon: 'warning',
                        title: response.data.message,
                    });
                }
                console.log(response)
            }).catch(error => {
                $('#page-pre-loader').hide();
                DTable.ajax.reload(null, false);

                if (error.response.status == 422) {
                    let msg = error.response.data.errors;
                    $.each(msg, function(key, value) {
                        console.log(key);
                        console.log(value);

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
            })
    });
</script>
