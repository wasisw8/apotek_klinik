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
                dropdownParent: $('#modalPembelian .modal-content'),
                theme: 'bootstrap-5',
                placeholder: "Silahkan Pilih..."
            });

            let table = $('#pembelianDatatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('pembelian.load') }}",
                    type: "POST",
                },
                pageLength: 10,
                searching: true,
                aoColumns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: "text-center",
                    }, {
                        data: 'tanggal',
                        render: function(data, type, row) {
                            if (!data) return '';

                            // Ubah string tanggal ke object Date
                            let date = new Date(data);

                            // Array nama bulan dalam bahasa Indonesia
                            const bulan = [
                                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                            ];

                            let tgl = date.getDate();
                            let bln = bulan[date.getMonth()];
                            let thn = date.getFullYear();

                            return `${tgl} ${bln} ${thn}`;
                        }
                    }, {
                        data: 'namaObat',
                    }, {
                        data: 'jumlah',
                    },{
                        data: 'satuan',
                    }, {
                        data: 'hna',
                        className: 'text-end',
                        render: function(data, type, row) {
                            // Pastikan data adalah angka
                            let number = parseFloat(data);
                            if (isNaN(number)) return data;

                            return 'Rp ' + number.toLocaleString('id-ID', {
                                minimumFractionDigits: 2
                            });
                        }
                    },{
                        data: 'aksi',
                        className: 'text-center'
                    }
                ]
            });

            let nilaiInput = document.getElementById('nilai');

            // Cegah karakter selain angka, koma, atau titik saat mengetik
            nilaiInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9.,]/g, '');
            });

            // Format jadi 2 angka di belakang koma saat blur
            nilaiInput.addEventListener('blur', function() {
                let val = parseFloat(this.value.replace(/,/g, '.'));
                if (!isNaN(val)) {
                    this.value = val.toFixed(2);
                } else {
                    this.value = ''; // kosongkan kalau bukan angka valid
                }
            });

            let nilaiJual = document.getElementById('hja');

            // Cegah karakter selain angka, koma, atau titik saat mengetik
            nilaiJual.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9.,]/g, '');
            });

            // Format jadi 2 angka di belakang koma saat blur
            nilaiJual.addEventListener('blur', function() {
                let val = parseFloat(this.value.replace(/,/g, '.'));
                if (!isNaN(val)) {
                    this.value = val.toFixed(2);
                } else {
                    this.value = ''; // kosongkan kalau bukan angka valid
                }
            });

            let nilaiJualSatuan = document.getElementById('hjasatuan');

            // Cegah karakter selain angka, koma, atau titik saat mengetik
            nilaiJualSatuan.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9.,]/g, '');
            });

            // Format jadi 2 angka di belakang koma saat blur
            nilaiJualSatuan.addEventListener('blur', function() {
                let val = parseFloat(this.value.replace(/,/g, '.'));
                if (!isNaN(val)) {
                    this.value = val.toFixed(2);
                } else {
                    this.value = ''; // kosongkan kalau bukan angka valid
                }
            });

            $('#obat').select2({
                theme: "bootstrap-5",
                width: "100%",
                placeholder: "Silahkan Pilih..",
                dropdownParent: $('#modalPembelian .modal-content'),
                minimumInputLength: 0,
                ajax: {
                    url: "{{ route('master.obat.getData') }}",
                    dataType: 'json',
                    type: "POST",
                    data: function(params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map((obat) => {
                                return {
                                    text: `${obat.nama}`,
                                    id: obat.id,
                                    ...obat,
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

            $('#distributor').select2({
                theme: "bootstrap-5",
                width: "100%",
                placeholder: "Silahkan Pilih..",
                dropdownParent: $('#modalPembelian .modal-content'),
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
                dropdownParent: $('#modalPembelian .modal-content'),
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
                dropdownParent: $('#modalPembelian .modal-content'),
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
                dropdownParent: $('#modalPembelian .modal-content'),
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

            $('#satuan').select2({
                theme: "bootstrap-5",
                width: "100%",
                placeholder: "Silahkan Pilih..",
                dropdownParent: $('#modalPembelian .modal-content'),
                minimumInputLength: 0,
                ajax: {
                    url: "{{ route('master.satuan-obat.getData') }}",
                    dataType: 'json',
                    type: "POST",
                    data: function(params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map((satuan) => {
                                return {
                                    text: `${satuan.nama}`,
                                    id: satuan.id,
                                    ...satuan,
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

            $('#satuan2').select2({
                theme: "bootstrap-5",
                width: "100%",
                placeholder: "Silahkan Pilih..",
                dropdownParent: $('#modalPembelian .modal-content'),
                minimumInputLength: 0,
                ajax: {
                    url: "{{ route('master.satuan-obat.getData') }}",
                    dataType: 'json',
                    type: "POST",
                    data: function(params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map((satuan) => {
                                return {
                                    text: `${satuan.nama}`,
                                    id: satuan.id,
                                    ...satuan,
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

            // belum dibuat menu master
            $('#gudang').select2({
                theme: "bootstrap-5",
                width: "100%",
                placeholder: "Silahkan Pilih..",
                dropdownParent: $('#modalPembelian .modal-content'),
                minimumInputLength: 0,
                ajax: {
                    url: "{{ route('master.gudang.getData') }}",
                    dataType: 'json',
                    type: "POST",
                    data: function(params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map((gudang) => {
                                return {
                                    text: `${gudang.nama}`,
                                    id: gudang.id,
                                    ...gudang,
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

            $('#obat').on('select2:select', function (e) {
                let data = e.params.data;
                // disabled
                $('#sediaan').on('select2:opening select2:unselecting', function(e) {
                    e.preventDefault();
                });
                $('#distributor').on('select2:opening select2:unselecting', function(e) {
                    e.preventDefault();
                });
                $('#jenis').on('select2:opening select2:unselecting', function(e) {
                    e.preventDefault();
                });
                $('#kategori').on('select2:opening select2:unselecting', function(e) {
                    e.preventDefault();
                });

                if (data.idSediaan) {
                    $("#sediaan").html(`<option value=${data.idSediaan} selected>${data.sediaan}
                </option>`);
                }

                if (data.idDistributor) {
                    $("#distributor").html(`<option value=${data.idDistributor} selected>${data.distributor}
                </option>`);
                }
                if (data.idJenis) {
                    $("#jenis").html(`<option value=${data.idJenis} selected>${data.jenis}
                </option>`);
                }
                if (data.idKategori) {
                    $("#kategori").html(`<option value=${data.idKategori} selected>${data.kategori}
                </option>`);
                }
            });



            $('#tambah').on('click', function() {
                $('#simpan').show();
                $('#update').hide();

                $('#formPembelian').find(".errorMessage").find("ul").html('');
                $('#formPembelian').find(".errorMessage").css('display', 'none');

                $('#formPembelian').find(':input').each(function() {
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
                $("#modalPembelian").modal('show')
            });

            $('#nilai, #jumlahperstrip, #jumlah').on('keyup', function() {
                hitung();
            });

            $('#simpan').click(function(e) {
                e.preventDefault();
                var form = $('#formPembelian')[0]; // atau .get(0)
                var formData = new FormData(form);
                $.ajax({
                    data: formData,
                    url: "{{ route('pembelian.save') }}",
                    type: "POST",
                    processData: false, // ✅ penting untuk FormData
                    contentType: false, // ✅ penting untuk FormData
                    dataType: 'json',
                    beforeSend: function() {
                        $('#simpan').html('Saving..');
                        $('#simpan').prop('disabled', true);
                    },
                    success: function(data) {
                        $('#formPembelian').trigger("reset");
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

                        $('#modalPembelian').modal('hide');
                        table.draw();
                    },
                    error: function(data) {
                        $('#formPembelian').find(".errorMessage").find("ul").html('');
                        $('#formPembelian').find(".errorMessage").css('display', 'block');
                        $.each(data.responseJSON.errors, function(key, value) {
                            $('#formPembelian').find(".errorMessage").find("ul")
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
                var form = $('#formPembelian')[0]; // atau .get(0)
                var formData = new FormData(form);
                $.ajax({
                    data: formData,
                    url: "{{ route('pembelian.update') }}",
                    type: "POST",
                    processData: false, // ✅ penting untuk FormData
                    contentType: false, // ✅ penting untuk FormData
                    dataType: 'json',
                    beforeSend: function() {
                        $('#update').html('Sending..');
                        $('#update').prop('disabled', true);
                    },
                    success: function(data) {
                        $('#formPembelian').trigger("reset");

                        Swal.fire({
                            title: "Berhasil",
                            text: data.message,
                            icon: "success"
                        });

                        $('#modalPembelian').modal('hide');
                        table.draw();
                    },
                    error: function(data) {
                        $('#formPembelian').find(".errorMessage").find("ul").html('');
                        $('#formPembelian').find(".errorMessage").css('display', 'block');
                        $.each(data.responseJSON.errors, function(key, value) {
                            $('#formPembelian').find(".errorMessage").find("ul")
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

        function hitung() {
            let jumlah          = parseFloat($('#jumlah').val()) || 0;
            let jumlahPerStrip  = parseFloat($('#jumlahperstrip').val()) || 0;
            let hna             = parseFloat($('#nilai').val()) || 0;
            let ppn             = pembulatanTambahSatuJikaKoma(11/100*hna);
            let hnappn          = ppn+hna;
            let markup          = hnappn*25/100;
            let hja             = (markup+hnappn)/jumlah;
            let hjaSatuan       = (jumlahPerStrip==0)? hja : hja/jumlahPerStrip;
            let hjabulat        = pembulatanRibuan(hja);
            let hjaSatuanBulat  = (jumlahPerStrip==0)? hjabulat : hjabulat/jumlahPerStrip;

            $('#nilaippn').val(ppn)
            $('#markup').val(markup)
            $('#hja').val(hja)
            $('#hjabulat').val(hjabulat)
            $('#hjasatuan').val(hjaSatuan)
            $('#hjasatuanbulat').val(hjaSatuanBulat)

            // console.log('PPN: '+ppn);
            // console.log('HNA+PPN: '+hnappn);
            // console.log('MarkUp: '+markup);
            // console.log('hja: '+hja);
            // console.log('hjasatuan: '+hjaSatuan);
            // console.log('hjasatuan: '+pembulatanRibuan(hja));
            // console.log('hjasatuan: '+hjaSatuan);

        }

        function pembulatanRibuan(angka) {
            let ribuan = Math.floor(angka / 1000) * 1000; // ambil ribuan bawah
            let selisih = angka - ribuan; // hitung sisa

            if (selisih >= 300) {
                return ribuan + 1000; // naik ribuan
            } else {
                return ribuan; // tetap di ribuan bawah
            }
        }

        function pembulatanTambahSatuJikaKoma(angka) {
            if (angka % 1 !== 0) {
                return Math.floor(angka) + 1; // kalau ada koma, tambah 1
            }
            return angka; // kalau bulat, biarkan
        }

        function edit(id) {
            $('#simpan').hide();
            $('#update').show();

            $('#formPembelian').find(".errorMessage").find("ul").html('');
            $('#formPembelian').find(".errorMessage").css('display', 'none');

            $('#formPembelian').find(':input').each(function() {
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
                url: "{{ route('pembelian.dataEdit') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    const dataPembelian = data.data
                    const dataObat = data.dataObat
                    const dataSatuan = data.dataSatuan
                    const dataSatuan2 = data.dataSatuan2
                    const dataSediaan = data.dataSediaan
                    const dataKategori = data.dataKategori
                    const dataGudang = data.dataGudang
                    const dataJenis = data.dataJenis
                    const dataDistributor = data.dataDistributor
                    $('#noOrder').val(dataPembelian.noOrder)
                    $('#tanggalOrder').val(dataPembelian.tanggal)
                    $('#noFaktur').val(dataPembelian.noFaktur)
                    $('#tanggalFaktur').val(dataPembelian.tanggalFaktur)
                    $('#tanggalExpired').val(dataPembelian.tanggalExpired)
                    $('#nilai').val(dataPembelian.hna)
                    $('#jumlah').val(dataPembelian.jumlah)
                    $('#nilaippn').val(dataPembelian.ppn)
                    $('#markup').val(dataPembelian.markup)
                    $('#jumlahperstrip').val(dataPembelian.jumlahPerStrip)
                    $('#hjabulat').val(dataPembelian.hjabulat)
                    $('#hja').val(dataPembelian.hja)
                    $('#hjasatuan').val(dataPembelian.hjaSatuan)
                    $('#hjasatuanbulat').val(dataPembelian.hjaSatuanBulat)



                    if (dataObat) {
                        $("#obat").html(`<option value=${dataObat.id} selected>${dataObat.nama}
                    </option>`);
                    }

                    if (dataSatuan) {
                        $("#satuan").html(`<option value=${dataSatuan.id} selected>${dataSatuan.nama}
                    </option>`);
                    }
                    if (dataSatuan2) {
                        $("#satuan2").html(`<option value=${dataSatuan2.id} selected>${dataSatuan2.nama}
                    </option>`);
                    }
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
                    if (dataGudang) {
                        $("#gudang").html(`<option value=${dataGudang.id} selected>${dataGudang.nama}
                    </option>`);
                    }


                    $('#modalTitle').text("Edit")
                    $("#modalPembelian").modal('show')
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
                        url: "{{ route('pembelian.delete') }}",
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

                            let tabel = $('#pembelianDatatable').DataTable();
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
