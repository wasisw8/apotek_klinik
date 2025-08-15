    <div class="modal fade" id="modalPembelian">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formPembelian" enctype="multipart/form-data">
                        @csrf
                        <div class="alert alert-danger errorMessage" style="display:none">
                            <ul></ul>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="noOrder" class="col-sm-12 form-label">No. Order</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="noOrder" id="noOrder">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggalOrder" class="col-sm-12 form-label">Tanggal Order</label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" name="tanggalOrder" id="tanggalOrder">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="noFaktur" class="col-sm-12 form-label">No.Faktur</label>
                                <div class="col-sm-12">
                                    <input type="hidden" class="form-control" name="id" id="id">
                                    <input type="text" class="form-control" name="noFaktur" id="noFaktur">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggalFaktur" class="col-sm-12 form-label">Tanggal Faktur</label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" name="tanggalFaktur" id="tanggalFaktur">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="obat" class="col-sm-12 form-label">Obat</label>
                                <select class="form-control select_option" id="obat" name="obat">
                                    <option value="">Silahkan Pilih...</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggalExpired" class="col-sm-12 form-label">Tanggal Expired</label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" name="tanggalExpired" id="tanggalExpired">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="sediaan" class="col-sm-12 form-label">Sediaan</label>
                                    <select class="form-control select_option" id="sediaan" name="sediaan">
                                        <option value="">Silahkan Pilih...</option>
                                    </select>
                            </div>
                            <div class="col-md-6">
                                <label for="jenis" class="col-sm-12 form-label">Jenis</label>
                                    <select class="form-control select_option" id="jenis" name="jenis">
                                        <option value="">Silahkan Pilih...</option>
                                    </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="kategori" class="col-sm-12 form-label">Kategori</label>
                                    <select class="form-control select_option" id="kategori" name="kategori">
                                        <option value="">Silahkan Pilih...</option>
                                    </select>
                            </div>
                            <div class="col-md-6">
                                <label for="distributor" class="col-sm-12 form-label">Distributor</label>
                                    <select class="form-control select_option" id="distributor" name="distributor">
                                        <option value="">Silahkan Pilih...</option>
                                    </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="gudang" class="col-sm-12 form-label">Gudang</label>
                                    <select class="form-control select_option" id="gudang" name="gudang">
                                        <option value="">Silahkan Pilih...</option>
                                    </select>
                            </div>
                            <div class="col-md-6">
                                <label for="nilai" class="col-sm-12 form-label">HNA <small>(Harga pembelian)</small></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control text-end" name="nilai" id="nilai">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="nip" class="col-sm-12 form-label">Jumlah <small>(strip,botol, dll)</small></label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" name="jumlah" id="jumlah">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="satuan" class="col-sm-12 form-label">Satuan</small></label>
                                <div class="col-sm-12">
                                    <select class="form-control select_option" id="satuan" name="satuan">
                                        <option value="">Silahkan Pilih...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="nilaippn" class="col-sm-12 form-label">HNA*PPN</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control text-end" style="background-color: #d1d4d6" name="nilaippn" id="nilaippn" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="markup" class="col-sm-12 form-label">MarkUp</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control text-end" style="background-color: #d1d4d6" name="markup" id="markup" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="jumlahperstrip" class="col-sm-12 form-label">Jumlah per <small>(Strip,botol,dll)</small></label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" name="jumlahperstrip" id="jumlahperstrip">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="satuan2" class="col-sm-12 form-label">Satuan</small></label>
                                <div class="col-sm-12">
                                    <select class="form-control select_option" id="satuan2" name="satuan2">
                                        <option value="">Silahkan Pilih...</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="hja" class="col-sm-12 form-label">HJA</label>
                                <div class="col-sm-12">
                                    <input type="hidden" class="form-control text-end"  name="hja" id="hja" readonly>
                                    <input type="text" class="form-control text-end" style="background-color: #d1d4d6" name="hjabulat" id="hjabulat" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="hjasatuan" class="col-sm-12 form-label">HJA Satuan</label>
                                <div class="col-sm-12">
                                    <input type="hidden" class="form-control text-end" name="hjasatuan" id="hjasatuan" readonly>
                                    <input type="text" class="form-control text-end" style="background-color: #d1d4d6" name="hjasatuanbulat" id="hjasatuanbulat" readonly>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 text-end">
                                <button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
                                <button type="submit" class="btn btn-warning" id="update">Update</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
