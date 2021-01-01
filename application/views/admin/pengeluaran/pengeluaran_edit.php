<!DOCTYPE html>
<html lang="en">

<head>

   <?php $this->load->view('_partial/meta') ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('_partial/sidebar') ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php $this->load->view('_partial/topbar') ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">
                            Edit Pengeluaran
                        </h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Pendapatan hari ini -->
                        <div class="col-12">
                            <div class="card shadow">
                                <div class="card-header">
                                    <a class="btn btn-sm text-primary" href="<?php echo site_url('pengeluaran/detail_pengeluaran/'.$pengeluaran->id_pengeluaran) ?>"><i class="fas fa-arrow-left mr-1"></i> Kembali<span class="hide-mobile"> ke detail pengeluaran</span></a>
                                </div>
                                <div class="card-body">
                                   <div class="col py-2">
                                        <?php if ($this->session->flashdata('success')): ?>
                                            <div class="alert alert-success" role="alert">
                                                <?php var_dump( $this->session->flashdata('success')) ?>
                                            </div>
                                        <?php endif; ?>

                                        <form action="<?=site_url('pengeluaran/simpan_edit_pengeluaran')?>" method="post" onsubmit="return dataValidation()">

                                            <input type="hidden" name="id" value="<?=$pengeluaran->id_pengeluaran?>">

                                            <div class="form-group row">
                                                <label for="tgl" class="col-lg-2 col-form-label">Tanggal Pengeluaran</label>
                                                <div class="col-lg-10">
                                                    <input type="date" class="form-control"
                                                     id="tgl" name="tgl"  placeholder=""
                                                     value="<?= date("Y-m-d", strtotime($pengeluaran->tgl_pengeluaran))?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="jenis" class="col-lg-2 col-form-label">Jenis Pengeluaran</label>
                                                <div class="input-group col-lg-10">
                                                <select class="custom-select" name="jenis" id="jenis">
                                                    <option value="pengeluaran harian" <?php echo ($pengeluaran->jenis == "pengeluaran harian") ? " selected" : "" ?>>Pengeluaran harian (Modal)</option>
                                                    <option value="lainnya" <?php echo ($pengeluaran->jenis == "lainnya") ? " selected" : "" ?>>Lainnya</option>
                                                </select>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="barang-group-dynamic">
                                            <?php foreach($detail_pengeluarans as $detail_pengeluaran):?>
                                                <div class="remove">
                                                    <div class="form-group form-row">
                                                        
                                                        <input type="hidden" name="idDetail[]" value="<?=$detail_pengeluaran->id_detail_pengeluaran?>">

                                                        <div class="col-md-5 mb-2 mb-md-0">
                                                            <input type="text" class="form-control form-control-sm" name="barang[]" placeholder="Nama barang" aria-label="Nama barang" 
                                                            value="<?=$detail_pengeluaran->nama_barang?>">
                                                        </div>
                                                        <div class="col-md-3 mb-2 mb-md-0">
                                                            <input type="text" class="form-control form-control-sm" name="jumlah[]" placeholder="Jumlah" aria-label="Jumlah"
                                                            value="<?=$detail_pengeluaran->jumlah_barang?>">
                                                        </div>
                                                        <div class="col-md-3 mb-2 mb-md-0">
                                                            <div class="input-group input-group-sm">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">Rp.</div>
                                                                </div>
                                                                <input type="text" class="form-control price form-control-sm" name="harga[]" placeholder="Harga" aria-label="Harga"
                                                            value="<?=$detail_pengeluaran->harga?>">
                                                            </div>
                                                        </div>
                                                        
                                                        <a href="#" class="remove-field btn btn-sm btn-outline-danger col-md-1"><i class="fas fa-minus"></i></a>
                                                    </div>
                                                </div>
                                            <?php endforeach;?>
                                            
                                            </div>

                                            <div class="barang-group">
                                                <div class="form-group form-row">
                                                    
                                                    <input type="hidden" name="idDetail[]">

                                                    <div class="col-md-5 mb-2 mb-md-0">
                                                        <input type="text" class="form-control form-control-sm <?php echo form_error('barang') ? 'is-invalid':'' ?>"
                                                        name="barang[]" placeholder="Nama barang" aria-label="Nama barang">
                                                        <div class="invalid-feedback">
                                                            <?php echo form_error('barang') ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mb-2 mb-md-0">
                                                        <input type="text" class="form-control form-control-sm" 
                                                        name="jumlah[]" placeholder="Jumlah" aria-label="Jumlah">
                                                    </div>
                                                    <div class="col-md-3 mb-2 mb-md-0">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">Rp.</div>
                                                            </div>
                                                            <input type="text" class="form-control price form-control-sm <?php echo form_error('harga') ? 'is-invalid':'' ?>" 
                                                             name="harga[]" placeholder="Harga" aria-label="Harga">
                                                            <div class="invalid-feedback">
                                                                <?php echo form_error('harga') ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="add-field btn btn-sm btn-outline-primary col-md-1 mb-2 mb-md-0"><i class="fas fa-plus"></i></a>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary mt-4">Simpan</button>

                                        </form>
                                   </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Content Row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php $this->load->view('_partial/modal_logout') ?>
    <?php $this->load->view('_partial/modal_message') ?>

    <!-- Javascript Import -->
    <?php $this->load->view('_partial/jsScript') ?>

    <script>
        const prices = document.querySelectorAll('.price');
        for(const price of prices){
            priceFormat(price)
        }
        function priceFormat(field){
            field.addEventListener('focus', (event) => {
                var x = event.target.value;
                var group = new Intl.NumberFormat().format(1111).replace(/1/g, '');
                var decimal = new Intl.NumberFormat().format(1.1).replace(/1/g, '');
                var reversedVal = x.replace(new RegExp('\\' + group, 'g'), '');
                reversedVal = reversedVal.replace(new RegExp('\\' + decimal, 'g'), '.');
                event.target.value = Number.isNaN(reversedVal)?0:reversedVal;
                event.target.type = 'number';
            });

            field.addEventListener('blur', (event) => {
                event.target.type = 'text'
                var x = event.target.value;
                event.target.value = Intl.NumberFormat().format(x);
            });
        }

        function reverseFormatting(){
            const prices = document.querySelectorAll('.price');
            for(const price of prices){
                var x = price.value;
                var group = new Intl.NumberFormat().format(1111).replace(/1/g, '');
                var decimal = new Intl.NumberFormat().format(1.1).replace(/1/g, '');
                var reversedVal = x.replace(new RegExp('\\' + group, 'g'), '');
                reversedVal = reversedVal.replace(new RegExp('\\' + decimal, 'g'), '.');
                price.value = Number.isNaN(reversedVal)?0:reversedVal;
                price.type = 'number'
            }
        }


        $('.add-field').click(function(){
            $('.barang-group').clone().appendTo('.barang-group-dynamic');
            $('.barang-group-dynamic .barang-group').addClass('single remove');
            $('.single .add-field').remove();
            $('.single > .form-row').append('<a href="#" class="remove-field btn btn-sm btn-outline-danger col-md-1"><i class="fas fa-minus"></i></a>');
            $('.barang-group-dynamic > .single').attr("class", "remove");
            $('.barang-group').find('input').each(function() {
                $(this).val("")
            });
            $('.is-invalid').each(function(){
                $(this).removeClass('is-invalid');
            });
            
            const prices = document.querySelectorAll('.price');
            priceFormat(prices[prices.length-2]);
        });
        $(document).on('click', '.remove-field', function(e) {
            $(this).parents('.remove').remove();
            e.preventDefault();

        });

        function dataValidation(){
            var emptyInput = false

            const inputs = document.querySelector('.barang-group').querySelectorAll('input');
            if(inputs[0].value != "" || inputs[1].value != "" || inputs[2].value != ""){
                document.querySelector('.add-field').click();
            }

            const fields = document.querySelectorAll('.remove');
            for(field of fields){
                const inputs = field.querySelectorAll('input');
                if(inputs[0].value == "" && inputs[1].value == "" && inputs[2].value == ""){
                    field.remove()
                }else{
                    for(input of inputs){
                        if(input.getAttribute('type') == "hidden") continue;
                        input.classList.remove("is-invalid");
                        if(input.value == "") {
                            emptyInput = true;
                            input.classList.add("is-invalid");
                        }
                    }
                }
                
            }

            if(fields.length == 0){
                const inputs = document.querySelector('.barang-group').querySelectorAll('input');
                for(input of inputs){
                    if(input.getAttribute('type') == "hidden") continue;
                    input.classList.remove("is-invalid");
                    if(input.value == "") {
                        emptyInput = true;
                        input.classList.add("is-invalid");
                    }
                }
            }
            
            reverseFormatting();
            if(emptyInput){
                $('#messageModal').modal('show'); 
                $('#messageModal').find('#message').text('Harap isi data barang dengan lengkap'); 
            };
            return(!emptyInput);
        }


    </script>

</body>

</html>