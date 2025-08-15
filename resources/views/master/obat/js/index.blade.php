<script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#simpan').hide();
            $('#update').hide();

            $('.select_option').select2({
                dropdownParent: $('#modalObat .modal-content'),
                theme: 'bootstrap-5',
                placeholder: "Silahkan Pilih..."
            });

            $('#distributor').select2({
                theme: "bootstrap-5",
                width: "100%",
                placeholder: "Silahkan Pilih..",
                dropdownParent: $('#modalObat .modal-content'),
                minimumInputLength: 0,
                ajax: {
                    url: "{{ route('master.distributor.getData') }}",
                    dataType: 'json',
                    type: "POST",
                    data: function(params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map((distributor) => {
                                return {
                                    text: `${distributor.nama}`,
                                    id: distributor.id,
                                    ...distributor,
                                };
                            }),
                            pagination: {
                                more: data.current_page < data.last_page,
                            },
                        };
                    },
                    cache: true
                }
            });

            $('#jenis').select2({
                theme: "bootstrap-5",
                width: "100%",
                placeholder: "Silahkan Pilih..",
                dropdownParent: $('#modalObat .modal-content'),
                minimumInputLength: 0,
                ajax: {
                    url: "{{ route('master.jenis-obat.getData') }}",
                    dataType: 'json',
                    type: "POST",
                    data: function(params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map((jenis) => {
                                return {
                                    text: `${jenis.nama}`,
                                    id: jenis.id,
                                    ...jenis,
                                };
                            }),
                            pagination: {
                                more: data.current_page < data.last_page,
                            },
                        };
                    },
                    cache: true
                }
            });

            $('#kategori').select2({
                theme: "bootstrap-5",
                width: "100%",
                placeholder: "Silahkan Pilih..",
                dropdownParent: $('#modalObat .modal-content'),
                minimumInputLength: 0,
                ajax: {
                    url: "{{ route('master.kategori-obat.getData') }}",
                    dataType: 'json',
                    type: "POST",
                    data: function(params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map((kategori) => {
                                return {
                                    text: `${kategori.nama}`,
                                    id: kategori.id,
                                    ...kategori,
                                };
                            }),
                            pagination: {
                                more: data.current_page < data.last_page,
                            },
                        };
                    },
                    cache: true
                }
            });

            $('#sediaan').select2({
                theme: "bootstrap-5",
                width: "100%",
                placeholder: "Silahkan Pilih..",
                dropdownParent: $('#modalObat .modal-content'),
                minimumInputLength: 0,
                ajax: {
                    url: "{{ route('master.sediaan-obat.getData') }}",
                    dataType: 'json',
                    type: "POST",
                    data: function(params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map((sediaan) => {
                                return {
                                    text: `${sediaan.nama}`,
                                    id: sediaan.id,
                                    ...sediaan,
                                };
                            }),
                            pagination: {
                                more: data.current_page < data.last_page,
                            },
                        };
                    },
                    cache: true
                }
            });

            let table = $('#obatDatatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('master.obat.load') }}",
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
                        data: 'sediaan',
                    }, {
                        data: 'jenis',
                    }, {
                        data: 'kategori',
                    }, {
                        data: 'distributor',
                    },{
                        data: 'aksi',
                        className: 'text-center'
                    }
                ]
            });

            $('#tambah').on('click', function() {
                $('#simpan').show();
                $('#update').hide();

                $('#formObat').find(".errorMessage").find("ul").html('');
                $('#formObat').find(".errorMessage").css('display', 'none');

                $('#formObat').find(':input').each(function() {
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
                $("#modalObat").modal('show')
            });

            $('#simpan').click(function(e) {
                e.preventDefault();
                var form = $('#formObat')[0]; // atau .get(0)
                var formData = new FormData(form);
                $.ajax({
                    data: formData,
                    url: "{{ route('master.obat.save') }}",
                    type: "POST",
                    processData: false, // ✅ penting untuk FormData
                    contentType: false, // ✅ penting untuk FormData
                    dataType: 'json',
                    beforeSend: function() {
                        $('#simpan').html('Saving..');
                        $('#simpan').prop('disabled', true);
                    },
                    success: function(data) {
                        $('#formObat').trigger("reset");
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

                        $('#modalObat').modal('hide');
                        table.draw();
                    },
                    error: function(data) {
                        $('#formObat').find(".errorMessage").find("ul").html('');
                        $('#formObat').find(".errorMessage").css('display', 'block');
                        $.each(data.responseJSON.errors, function(key, value) {
                            $('#formObat').find(".errorMessage").find("ul")
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
                var form = $('#formObat')[0]; // atau .get(0)
                var formData = new FormData(form);
                $.ajax({
                    data: formData,
                    url: "{{ route('master.obat.update') }}",
                    type: "POST",
                    processData: false, // ✅ penting untuk FormData
                    contentType: false, // ✅ penting untuk FormData
                    dataType: 'json',
                    beforeSend: function() {
                        $('#update').html('Sending..');
                        $('#update').prop('disabled', true);
                    },
                    success: function(data) {
                        $('#formObat').trigger("reset");

                        Swal.fire({
                            title: "Berhasil",
                            text: data.message,
                            icon: "success"
                        });

                        $('#modalObat').modal('hide');
                        table.draw();
                    },
                    error: function(data) {
                        $('#formObat').find(".errorMessage").find("ul").html('');
                        $('#formObat').find(".errorMessage").css('display', 'block');
                        $.each(data.responseJSON.errors, function(key, value) {
                            $('#formObat').find(".errorMessage").find("ul")
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

            $('#formObat').find(".errorMessage").find("ul").html('');
            $('#formObat').find(".errorMessage").css('display', 'none');

            $('#formObat').find(':input').each(function() {
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
                url: "{{ route('master.obat.dataEdit') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    const dataObat = data.data
                    const dataSediaan = data.dataSediaan
                    const dataKategori = data.dataKategori
                    const dataJenis = data.dataJenis
                    const dataDistributor = data.dataDistributor
                    $('#nama').val(dataObat.nama)

                    if (dataSediaan) {
                        $("#sediaan").html(`<option value=${dataSediaan.id} selected>${dataSediaan.nama}
                    </option>`);
                    }
                    if (dataKategori) {
                        $("#kategori").html(`<option value=${dataKategori.id} selected>${dataKategori.nama}
                    </option>`);
                    }
                    if (dataJenis) {
                        $("#jenis").html(`<option value=${dataJenis.id} selected>${dataJenis.nama}
                    </option>`);
                    }
                    if (dataDistributor) {
                        $("#distributor").html(`<option value=${dataDistributor.id} selected>${dataDistributor.nama}
                    </option>`);
                    }
                    $('#modalTitle').text("Edit")
                    $("#modalObat").modal('show')
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
                        url: "{{ route('master.obat.delete') }}",
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

                            let tabel = $('#obatDatatable').DataTable();
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
