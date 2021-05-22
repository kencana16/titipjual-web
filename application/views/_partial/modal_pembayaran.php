<!-- message Modal-->
<div class="modal fade" id="pembayaranModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="info" class="mb-3 small">
                        <div class="row">
                            <div class="col d-flex justify-content-between"><span>Yang harus dibayar</span><span>:</span></div>
                            <div class="col" id="jumlah"></div>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-between"><span>Yang sudah dibayar</span><span>:</span></div>
                            <div class="col" id="dibayar"></div>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-between"><span>Kekurangan</span><span>:</span></div>
                            <div class="col" id="kurang" class="text-right"></div>
                        </div>
                        <button class="btn btn-sm btn-outline-primary" id="tambah-pembayaran"><i class="fas fa-plus"></i> Tambah</button>
                    </div>

                    <form action="" method="post" class="d-none" onsubmit="return submitPembayaran()">
                        <input type="hidden" name="id">
                        <div class="small text-right">Kekurangan : <span id="kekurangan"></span></div>

                        <div class="form-group">
                            <label for="tgl" class="text-sm">Waktu Pembayaran</label>
                            <input type="date" class="form-control form-control-sm"
                             id="tgl"  name="tgl"  placeholder="" >
                            <div class="invalid-feedback">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="uang" class="text-sm">Jumlah</label>
                            <input type="number" class="form-control form-control-sm"
                             id="uang"  name="uang"  placeholder="" value="">
                            <div class="invalid-feedback">
                            </div>
                        </div>
                        <input type="button" value="Batal" class="btn btn-sm btn-secondary">
                        <input type="submit" value="Simpan" class="btn btn-sm btn-primary">
                    </form>
                
                    <table class="table table-sm table-bordered mt-3">
                        <thead>
                            <th>No</th>
                            <th>Waktu</th>
                            <th>Pembayaran</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody >
                        </tbody>
                        <tfoot>
                            <th class="text-right" colspan="2">Total</th>
                            <th id="total" colspan="2"></th>
                        </tfoot>
                    </table>

                    <div id="delete" class="text-center">
                        <h3>Yakin ingin menghapus?</h3>
                        <span></span><br>
                        <button class="btn btn-sm btn-secondary">Batal</button>
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">OK</button>
                </div> -->
            </div>
        </div>
    </div>