<script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#simpan').hide();
            $('#update').hide();

            let table = $('#kategoriobatDatatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('master.kategori-obat.load') }}",
                    type: "POST",
                },
                pageLength: 10,
                searching: true,
                aoColumns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: "text-center",
                    }, {
                        data: 'nama',
                    }, {
                        data: 'aksi',
                        className: 'text-center'
                    }
                ]
            });

            $('#tambah').on('click', function() {
                $('#simpan').show();
                $('#update').hide();

                $('#formKategoriObat').find(".errorMessage").find("ul").html('');
                $('#formKategoriObat').find(".errorMessage").css('display', 'none');

                $('#formKategoriObat').find(':input').each(function() {
                    switch (this.type) {
                        case 'select-one':
                            $(this).val(null).change()
                            break;
                        case 'text':
                            $(this).val(null)
                            break;
                        case 'date':
                            $(this).val(null)
                            break;
                        case 'textarea':
                            $(this).val(null)
                            break;
                    }
                });
                $('#modalTitle').text("Tambah")
                $("#modalshift").modal('show')
            });

            $('#simpan').click(function(e) {
                e.preventDefault();
                var form = $('#formKategoriObat')[0]; // atau .get(0)
                var formData = new FormData(form);
                $.ajax({
                    data: formData,
                    url: "{{ route('master.kategori-obat.save') }}",
                    type: "POST",
                    processData: false, // ✅ penting untuk FormData
                    contentType: false, // ✅ penting untuk FormData
                    dataType: 'json',
                    beforeSend: function() {
                        $('#simpan').html('Saving..');
                        $('#simpan').prop('disabled', true);
                    },
                    success: function(data) {
                        $('#formKategoriObat').trigger("reset");
                        if(data.status){
                            Swal.fire({
                                title: "Berhasil",
                                text: data.message,
                                icon: "success"
                            });

                        }else{
                            Swal.fire({
                                title: "Gagal",
                                text: data.message,
                                icon: "error"
                            });

                        }

                        $('#modalshift').modal('hide');
                        table.draw();
                    },
                    error: function(data) {
                        $('#formKategoriObat').find(".errorMessage").find("ul").html('');
                        $('#formKategoriObat').find(".errorMessage").css('display', 'block');
                        $.each(data.responseJSON.errors, function(key, value) {
                            $('#formKategoriObat').find(".errorMessage").find("ul")
                                .append(
                                    '<li>' + value + '</li>');
                        });
                    },
                    complete: function(data) {
                        $('#simpan').html('Simpan');
                        $('#simpan').prop('disabled', false);
                    }
                });
            });

            $('#update').click(function(e) {
               e.preventDefault();
                var form = $('#formKategoriObat')[0]; // atau .get(0)
                var formData = new FormData(form);
                $.ajax({
                    data: formData,
                    url: "{{ route('master.kategori-obat.update') }}",
                    type: "POST",
                    processData: false, // ✅ penting untuk FormData
                    contentType: false, // ✅ penting untuk FormData
                    dataType: 'json',
                    beforeSend: function() {
                        $('#update').html('Sending..');
                        $('#update').prop('disabled', true);
                    },
                    success: function(data) {
                        $('#formKategoriObat').trigger("reset");

                        Swal.fire({
                            title: "Berhasil",
                            text: data.message,
                            icon: "success"
                        });

                        $('#modalshift').modal('hide');
                        table.draw();
                    },
                    error: function(data) {
                        $('#formKategoriObat').find(".errorMessage").find("ul").html('');
                        $('#formKategoriObat').find(".errorMessage").css('display', 'block');
                        $.each(data.responseJSON.errors, function(key, value) {
                            $('#formKategoriObat').find(".errorMessage").find("ul")
                                .append(
                                    '<li>' + value + '</li>');
                        });
                    },
                    complete: function(data) {
                        $('#update').html('Update');
                        $('#update').prop('disabled', false);
                    }
                });
            });
        });

        function edit(id) {
            $('#simpan').hide();
            $('#update').show();

            $('#formKategoriObat').find(".errorMessage").find("ul").html('');
            $('#formKategoriObat').find(".errorMessage").css('display', 'none');

            $('#formKategoriObat').find(':input').each(function() {
                switch (this.type) {
                    case 'select-one':
                        $(this).val(null).change()
                        break;
                    case 'text':
                        $(this).val(null)
                        break;
                    case 'date':
                        $(this).val(null)
                        break;
                    case 'textarea':
                        $(this).val(null)
                        break;
                }
            });

            $('#id').val(id)

            $.ajax({
                data: {
                    id: id
                },
                url: "{{ route('master.kategori-obat.dataEdit') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    const dataSatuanObat = data.data
                    $('#nama').val(dataSatuanObat.nama)
                    $('#modalTitle').text("Edit")
                    $("#modalshift").modal('show')
                }
            });
        }

        function hapus(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success right-gap",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, hapus",
                cancelButtonText: "Tidak, kembali!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('master.kategori-obat.delete') }}",
                        type: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        success: function(response) {
                            swalWithBootstrapButtons.fire({
                                title: "Terhapus!",
                                text: response.message,
                                icon: "success"
                            });

                            let tabel = $('#kategoriobatDatatable').DataTable();
                            tabel.ajax.reload();
                        },
                        error: function(data) {
                            swalWithBootstrapButtons.fire({
                                title: "Gagal!",
                                text: data.responseJSON.message,
                                icon: "warning"
                            });
                        },
                    });

                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Batal",
                        text: "Data tidak dihapus!",
                        icon: "error"
                    });
                }
            });
        }
    </script>
