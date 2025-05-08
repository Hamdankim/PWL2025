<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Pengguna</title>

    <!-- Fonts & Styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ url('/') }}" class="h1"><b>Admin</b>LTE</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Daftar Akun Baru</p>

                <form action="{{ url('postregister') }}" method="POST" id="form-register">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div class="input-group mb-3">
                        <input type="text" id="nama" name="nama" class="form-control"
                            placeholder="Nama Lengkap" autocomplete="name" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-user"></span></div>
                        </div>
                        <label for="nama" class="sr-only">Nama Lengkap</label>
                        <small id="error-nama" class="error-text text-danger"></small>
                    </div>

                    <!-- Username -->
                    <div class="input-group mb-3">
                        <input type="text" id="username" name="username" class="form-control" 
                            placeholder="Username" autocomplete="username" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-user-tag"></span></div>
                        </div>
                        <label for="username" class="sr-only">Username</label>
                        <small id="error-username" class="error-text text-danger"></small>
                    </div>

                    <!-- Password -->
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Password" autocomplete="new-password" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                        <label for="password" class="sr-only">Password</label>
                        <small id="error-password" class="error-text text-danger"></small>
                    </div>

                    <!-- Level -->
                    <div class="input-group mb-3">
                        <select id="level_id" name="level_id" class="form-control" autocomplete="off" required>
                            <option value="">-- Pilih Level --</option>
                            <option value="1">Admin</option>
                            <option value="2">Manager</option>
                            <option value="3">Staff/Kasir</option>
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-user-cog"></span></div>
                        </div>
                        <label for="level_id" class="sr-only">Level</label>
                        <small id="error-level_id" class="error-text text-danger"></small>
                    </div>

                    <!-- Submit -->
                    <div class="row">
                        <div class="col-8">
                            <a href="{{ url('login') }}">Sudah punya akun?</a>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                Daftar
                            </button>
                        </div>
                    </div>
                </form>


                <!-- Scripts -->
                <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
                <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
                <script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
                <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
                <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

                <script>
                    $(document).ready(function() {
                        $("#form-register").validate({
                            rules: {
                                nama: {
                                    required: true,
                                    maxlength: 100
                                },
                                username: {
                                    required: true,
                                    minlength: 4,
                                    maxlength: 20
                                },
                                password: {
                                    required: true,
                                    minlength: 6
                                },
                                level_id: {
                                    required: true
                                }
                            },
                            submitHandler: function(form) {
                                $.ajax({
                                    url: form.action,
                                    type: form.method,
                                    data: $(form).serialize(),
                                    success: function(response) {
                                        if (response.status) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Berhasil',
                                                text: response.message
                                            }).then(() => window.location = response.redirect);
                                        } else {
                                            $('.error-text').text('');
                                            $.each(response.msgField, function(prefix, val) {
                                                $('#error-' + prefix).text(val[0]);
                                            });
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Gagal',
                                                text: response.message
                                            });
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.log('Error:', xhr.responseText);
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'Terjadi kesalahan: ' + error
                                        });
                                    }
                                });
                                return false;
                            },
                            errorPlacement: function(error, element) {
                                error.addClass('invalid-feedback');
                                element.closest('.input-group').append(error);
                            },
                            highlight: function(element) {
                                $(element).addClass('is-invalid');
                            },
                            unhighlight: function(element) {
                                $(element).removeClass('is-invalid');
                            }
                        });
                    });
                </script>
</body>

</html>
