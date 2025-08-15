    <div class="modal fade" id="modalObat">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formObat" enctype="multipart/form-data">
                        @csrf
                        <div class="alert alert-danger errorMessage" style="display:none">
                            <ul></ul>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="nip" class="col-sm-12 form-label">Nama</label>
                                <div class="col-sm-12">
                                    <input type="hidden" class="form-control" name="id" id="id">
                                    <input type="text" class="form-control" name="nama" id="nama">
                                </div>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="distributor" class="col-sm-12 form-label">Distributor</label>
                                    <select class="form-control select_option" id="distributor" name="distributor">
                                        <option value="">Silahkan Pilih...</option>
                                    </select>
                            </div>
                            <div class="col-md-6">
                                <label for="sediaan" class="col-sm-12 form-label">Sediaan</label>
                                    <select class="form-control select_option" id="sediaan" name="sediaan">
                                        <option value="">Silahkan Pilih...</option>
                                    </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="jenis" class="col-sm-12 form-label">Jenis</label>
                                    <select class="form-control select_option" id="jenis" name="jenis">
                                        <option value="">Silahkan Pilih...</option>
                                    </select>
                            </div>
                            <div class="col-md-6">
                                <label for="kategori" class="col-sm-12 form-label">Kategori</label>
                                    <select class="form-control select_option" id="kategori" name="kategori">
                                        <option value="">Silahkan Pilih...</option>
                                    </select>
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
