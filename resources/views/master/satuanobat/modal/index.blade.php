    <div class="modal fade" id="modalshift">
        <div class="modal-dialog modal-m">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formSatuanObat" enctype="multipart/form-data">
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
