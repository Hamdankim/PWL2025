@empty($stok)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('/stok') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/stok/' . $stok->stok_id . '/update_ajax') }}" method="POST" id="form-edit">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Stok</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Dropdown Supplier -->
                    <div class="form-group">
                        <label>Supplier</label>
                        <select class="form-control" id="supplier_id" name="supplier_id" required>
                            <option value="">- Pilih Supplier -</option>
                            @foreach ($suppliers as $item)
                                <option value="{{ $item->supplier_id }}" {{ $stok->supplier_id == $item->supplier_id ? 'selected' : '' }}>
                                    {{ $item->supplier_nama }}
                                </option>
                            @endforeach
                        </select>
                        <small id="error-supplier_id" class="error-text form-text text-danger"></small>
                    </div>

                    <!-- Dropdown Barang -->
                    <div class="form-group">
                        <label>Barang</label>
                        <select class="form-control" id="barang_id" name="barang_id" required>
                            <option value="">- Pilih Barang -</option>
                            @foreach ($barang as $item)
                                <option value="{{ $item->barang_id }}" {{ $stok->barang_id == $item->barang_id ? 'selected' : '' }}>
                                    {{ $item->barang_nama }}
                                </option>
                            @endforeach
                        </select>
                        <small id="error-barang_id" class="error-text form-text text-danger"></small>
                    </div>

                    <!-- Dropdown User -->
                    <div class="form-group">
                        <label>User</label>
                        <select class="form-control" id="user_id" name="user_id" required>
                            <option value="">- Pilih User -</option>
                            @foreach ($users as $item)
                                <option value="{{ $item->user_id }}" {{ $stok->user_id == $item->user_id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        <small id="error-user_id" class="error-text form-text text-danger"></small>
                    </div>

                    <!-- Input Jumlah -->
                    <div class="form-group">
                        <label>Jumlah Stok</label>
                        <input type="number" class="form-control" id="stok_jumlah" name="stok_jumlah" 
                            value="{{ $stok->stok_jumlah }}" required min="1">
                        <small id="error-stok_jumlah" class="error-text form-text text-danger"></small>
                    </div>

                    <!-- Input Tanggal -->
                    <div class="form-group">
                        <label>Tanggal Stok</label>
                        <input type="datetime-local" class="form-control" id="stok_tanggal" name="stok_tanggal" 
                            value="{{ date('Y-m-d\TH:i', strtotime($stok->stok_tanggal)) }}" required>
                        <small id="error-stok_tanggal" class="error-text form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            $("#form-edit").validate({
                rules: {
                    supplier_id: {
                        required: true
                    },
                    barang_id: {
                        required: true
                    },
                    user_id: {
                        required: true
                    },
                    stok_tanggal: {
                        required: true,
                        date: true
                    },
                    stok_jumlah: {
                        required: true,
                        digits: true,
                        min: 1
                    }
                },
                messages: {
                    supplier_id: {
                        required: "Supplier harus dipilih."
                    },
                    barang_id: {
                        required: "Barang harus dipilih."
                    },
                    user_id: {
                        required: "User harus dipilih."
                    },
                    stok_tanggal: {
                        required: "Tanggal stok harus diisi.",
                        date: "Format tanggal tidak valid."
                    },
                    stok_jumlah: {
                        required: "Jumlah stok harus diisi.",
                        digits: "Jumlah stok harus berupa angka.",
                        min: "Jumlah stok minimal 1."
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) {
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                dataStok.ajax.reload();
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
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
@endempty