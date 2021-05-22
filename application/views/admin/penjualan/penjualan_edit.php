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
                            Edit Penjualan
                        </h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Pendapatan hari ini -->
                        <div class="col-12">
                            <div class="card shadow">
                                <div class="card-header">
                                    <a class="btn btn-sm text-primary" href="<?php echo site_url('penjualan') ?>"><i class="fas fa-arrow-left mr-1"></i> Kembali<span class="hide-mobile"> ke daftar penjualan</span></a>
                                </div>
                                <div class="card-body">
                                   <div class="col py-2">
                                        <?php if ($this->session->flashdata('success')): ?>
                                            <div class="alert alert-success" role="alert">
                                                <?= $this->session->flashdata('success') ?>
                                            </div>
                                        <?php endif; ?>

                                        <form action="<?=site_url('penjualan/simpan_edit_penjualan')?>" method="post" onsubmit="return dataValidation()">

                                            <input type="hidden" name="id" value="<?=$penjualan->id_penjualan?>">
                                            <div class="form-group row">
                                                <label for="tgl" class="col-lg-2 col-form-label">Tanggal Penjualan</label>
                                                <div class="col-lg-10">
                                                    <input type="date" class="form-control"
                                                     id="tgl" name="tgl"  placeholder=""
                                                     value="<?= date("Y-m-d", strtotime($penjualan->tgl_penjualan))?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="idPenjual" class="col-lg-2 col-form-label">Nama Penjual</label>
                                                <div class="input-group col-lg-10">
                                                <select class="custom-select" name="idPenjual" id="idPenjual">
                                                    <option value="">-- Pilih Nama Penjual --</option>
                                                    <?php foreach($penjuals as $penjual): ?>
                                                        <option value="<?=$penjual->id_penjual?>" <?php echo ($penjual->id_penjual == $penjualan->id_penjual) ? " selected" : "" ?>><?=$penjual->nama_penjual?></option> 
                                                    <?php endforeach;?>
                                                </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="dibayar" class="col-lg-2 col-form-label">Dibayar</label>
                                                <div class="col-lg-10">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">Rp.</div>
                                                        </div>
                                                        <input type="text" class="form-control price <?php echo form_error('dibayar') ? 'is-invalid':'' ?>"
                                                        id="dibayar"  name="dibayar"  placeholder=""
                                                        value="<?=number_format($pembayaran->jumlah_uang)?>" disabled>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        <?php echo form_error('dibayar') ?>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <h5 class="border-bottom border-primary mb-3 mt-4">Barang yang dijual</h5>
                                            <div class="row mb-2 hide-tablet">
                                                <div class="col-lg-4">Nama Produk</div>
                                                <div class="col-lg-2">Jumlah</div>
                                                <div class="col-lg-2">Terjual</div>
                                                <div class="col-lg-3">Uang</div>
                                            </div>

                                            <div class="barang-group-dynamic">
                                            <?php foreach($detail_penjualans as $detail_penjualan):?>
                                                <div class="remove">
                                                    <div class="form-group form-row">
                                                        
                                                        <input type="hidden" name="idDetail[]" value="<?=$detail_penjualan->id_detail_penjualan?>">

                                                        <div class="col-lg-4 mb-2 mb-lg-0">
                                                            <div class="input-group input-group-sm">
                                                                <select class="custom-select" name="idBarang[]">
                                                                    <option value="">-- Pilih Nama Produk --</option>
                                                                    <?php foreach($barangs as $barang): ?>
                                                                        <option value="<?=$barang->id_barang?>" <?php echo ($detail_penjualan->id_barang == $barang->id_barang) ? " selected" : "" ?>><?=$barang->nama_barang?></option> 
                                                                    <?php endforeach;?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 mb-2 mb-lg-0">
                                                            <input type="number" class="form-control form-control-sm" 
                                                            name="jumlah[]" placeholder="Jumlah" aria-label="Jumlah"
                                                            value="<?=$detail_penjualan->jml_produk?>">
                                                        </div>
                                                        <div class="col-lg-2 mb-2 mb-lg-0">
                                                            <input type="number" class="form-control form-control-sm" 
                                                            name="terjual[]" placeholder="Terjual" aria-label="Terjual" 
                                                            value="<?=$detail_penjualan->jml_terjual?>">
                                                        </div>
                                                        <div class="col-lg-3 mb-2 mb-lg-0">
                                                            <div class="input-group input-group-sm">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">Rp.</div>
                                                                </div>
                                                                <input type="text" class="form-control price form-control-sm" 
                                                                name="uang[]" placeholder="Jumlah Uang" aria-label="Jumlah Uang" 
                                                                value="<?=number_format($detail_penjualan->jml_uang)?>">
                                                            </div>
                                                        </div>
                                                        
                                                        <a href="#" class="remove-field btn btn-sm btn-outline-danger col-lg-1"><i class="fas fa-minus"></i></a>
                                                    </div>
                                                </div>
                                            <?php endforeach;?>
                                            
                                            </div>

                                            <div class="barang-group">
                                                <div class="form-group form-row">
                                                    
                                                    <input type="hidden" name="idDetail[]">

                                                    <div class="col-lg-4 mb-2 mb-lg-0">
                                                        <div class="input-group input-group-sm">
                                                            <select class="custom-select" name="idBarang[]" id="idBarang">
                                                                <option value="">-- Pilih Nama Produk --</option>
                                                                <?php foreach($barangs as $barang): ?>
                                                                    <option value="<?=$barang->id_barang?>"><?=$barang->nama_barang?></option> 
                                                                <?php endforeach;?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 mb-2 mb-lg-0">
                                                        <input type="number" class="form-control form-control-sm" 
                                                        name="jumlah[]" placeholder="Jumlah" aria-label="Jumlah">
                                                    </div>
                                                    <div class="col-lg-2 mb-2 mb-lg-0">
                                                        <input type="number" class="form-control form-control-sm" 
                                                        name="terjual[]" placeholder="Terjual" aria-label="Terjual">
                                                    </div>
                                                    <div class="col-lg-3 mb-2 mb-lg-0">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">Rp.</div>
                                                            </div>
                                                            <input type="text" class="form-control price form-control-sm" 
                                                             name="uang[]" placeholder="Jumlah Uang" aria-label="Jumlah Uang">
                                                        </div>
                                                    </div>
                                                    <a href="#" class="add-field btn btn-sm btn-outline-primary col-lg-1 mb-2 mb-md-0"><i class="fas fa-plus"></i></a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-8 col-sm-6 text-lg-right"></div>
                                                <div class="col-lg-4 col-sm-6 p-0">
                                                    <div class="input-group  border border-primary rounded">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">Rp.</div>
                                                        </div>
                                                        <input type="text" class="form-control font-weight-bold bg-light" 
                                                         name="total" placeholder="Total" aria-label="total" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary mt-4">Simpan</button>

                                        </form>

                                        <div class="text-right small <?=(!isset($penjualan))? ' d-none': '' ?>">
                                            <div class="row">
                                                <div class="col">Dibuat :</div>
                                                <div class="col-auto"><?=$penjualan->date_created?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col">Terakhir diperbarui :</div>
                                                <div class="col-auto"><?=$penjualan->date_modified?></div>
                                            </div>
                                        </div>

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
            <?php $this->load->view('_partial/footer') ?>
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

        function removeFormatting(value){
            var group = new Intl.NumberFormat().format(1111).replace(/1/g, '');
            var decimal = new Intl.NumberFormat().format(1.1).replace(/1/g, '');
            var reversedVal = value.replace(new RegExp('\\' + group, 'g'), '');
            reversedVal = reversedVal.replace(new RegExp('\\' + decimal, 'g'), '.');
            return reversedVal.replace(new RegExp('\\' + decimal, 'g'), '.');
        }


        $('.add-field').click(function(){
            $('.barang-group').clone().appendTo('.barang-group-dynamic');
            $('.barang-group-dynamic .barang-group').addClass('single remove');
            $('.single .add-field').remove();
            $('.single > .form-row').append('<a href="#" class="remove-field btn btn-sm btn-outline-danger col-md-1"><i class="fas fa-minus"></i></a>');
            $('.barang-group-dynamic > .single').attr("class", "remove");
            //reset value of input
            $('.barang-group').find('input').each(function() {
                $(this).val("")
            });
            //reset selected of select-option
            $('.barang-group').find('select').each(function() {
                $(this).val("");
                $(this).find('option').each(function(){
                    $(this).attr('selected', false);
                });
            });
            //reset invalid (error) fields
            $('.is-invalid').each(function(){
                $(this).removeClass('is-invalid');
            });
            //add price format to new clone
            const prices = document.querySelectorAll('.price');
            priceFormat(prices[prices.length-2]);
            initCountJmlUang();

            $('html, body').animate({
                scrollTop: $(".barang-group").offset().top
            }, 1000);
        });
        $(document).on('click', '.remove-field', function(e) {
            $(this).parents('.remove').remove();
            e.preventDefault();

        });

        $('select').on('change', function(){
            $(this).find('option').each(function(){
                $(this).attr('selected', false);
            });
            $(this).find("option[value=" + $(this).val() +"]").attr('selected', true);
        });

        initCountJmlUang();
        function initCountJmlUang(){
            $('select[name="idBarang[]"]').change(function(){
                countJmlUang($(this));
            });
            $('input[name="terjual[]"]').keyup(function(){
                countJmlUang($(this));
            });
        }
        function countJmlUang(object){
            var idBarang = object.parents('.form-row').find('select[name="idBarang[]"]').val();
            var terjual =  object.parents('.form-row').find('input[name="terjual[]"]').val() 
            IntTerjual = Number.isInteger(terjual) ? 0 : terjual;
            var inputUang = object.parents('.form-row').find('input[name="uang[]"]');
            $.ajax({
                url:'<?=base_url()?>barang/get_barang_json',
                method: 'post',
                data: {id_barang: idBarang},
                dataType: 'json',
                success: function(response){
                    var len = response.length;
                    if(len > 0){
                        // Read values
                        var harga_reseller = response[0].harga_satuan_reseller;
                        inputUang.val(Intl.NumberFormat().format(terjual * harga_reseller));

                        countTotal();
                    }else{
                        inputUang.val("0");
                    }
                    
                }
            });
        }

        countTotal();
        function countTotal(){
            var total = 0;
            $('input[name="uang[]"]').each(function(){
                subtotal = parseInt(removeFormatting($(this).val()));
                if(Number.isNaN(subtotal)){return;};
                total += subtotal;
            });
            $('input[name="total"]').val(Intl.NumberFormat().format(total));
        }

        function dataValidation(){
            $(".alert").remove();
            var emptyInput = false

            $('#idPenjual').removeClass('is-invalid');
            if($('#idPenjual').val() == ""){
                emptyInput = true;
                $('#idPenjual').addClass('is-invalid');
            }

            const inputs = document.querySelector('.barang-group').querySelectorAll('input');
            const selects = document.querySelector('.barang-group').querySelector('select');
            if(selects.value != "" || inputs[0].value != "" ){
                document.querySelector('.add-field').click();
            }

            const fields = document.querySelectorAll('.remove');
            for(field of fields){
                const inputs = field.querySelectorAll('input');
                const selects = field.querySelectorAll('select');
                if(selects[0].value == "" && inputs[1].value == ""){
                    field.remove()
                }else{
                    selects[0].classList.remove("is-invalid");
                    if(selects[0].value == "") {
                        emptyInput = true;
                        selects[0].classList.add("is-invalid");
                    }
                    inputs[1].classList.remove("is-invalid");
                    if(inputs[1].value == "") {
                        emptyInput = true;
                        inputs[1].classList.add("is-invalid");
                    }
                }
            }

            if(fields.length < 1){
                console.log("remove = "+fields.length);
                const selects = document.querySelector('.barang-group').querySelectorAll('select');
                const inputs = document.querySelector('.barang-group').querySelectorAll('input');
                
                selects[0].classList.remove("is-invalid");
                if(selects[0].value == "") {
                    emptyInput = true;
                    selects[0].classList.add("is-invalid");
                }

                inputs[1].classList.remove("is-invalid");
                if(inputs[1].value == "") {
                    emptyInput = true;
                    inputs[1].classList.add("is-invalid");
                }
            }
            
            reverseFormatting();
            if(emptyInput){
                $('#messageModal').modal('show'); 
                $('#messageModal').find('#message').text('Harap isi data penjualan dengan lengkap'); 
            }
            return(!emptyInput);
        }


    </script>

</body>

</html>