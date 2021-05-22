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
                            Input Pesanan
                        </h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Pendapatan hari ini -->
                        <div class="col-12">
                            <div class="card shadow">
                                <div class="card-header">
                                    <a class="btn btn-sm text-primary" href="<?php echo site_url('pesanan') ?>"><i class="fas fa-arrow-left mr-1"></i> Kembali<span class="hide-mobile"> ke data pesanan</span></a>
                                </div>
                                <div class="card-body">
                                   <div class="col py-2">
                                        <?php if ($this->session->flashdata('success')): ?>
                                            <div class="alert alert-success" role="alert">
                                                <?php echo $this->session->flashdata('success'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($this->session->flashdata('error')): ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?php echo $this->session->flashdata('error'); ?>
                                            </div>
                                        <?php endif; ?>

                                        <form action="<?=site_url('pesanan/simpan_pesanan')?>" method="post" onsubmit="return dataValidation()">

                                            <div class="form-group row">
                                                <label for="tgl_dipesan" class="col-lg-2 col-form-label">Tanggal Dipesan</label>
                                                <div class="col-lg-10">
                                                    <input type="date" class="form-control <?php echo form_error('tgl_dipesan') ? 'is-invalid':'' ?>"
                                                     id="tgl_dipesan"  name="tgl_dipesan"  placeholder="">
                                                    <div class="invalid-feedback">
                                                        <?php echo form_error('tgl_dipesan') ?>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="tgl_diambil" class="col-lg-2 col-form-label">Tanggal Diambil</label>
                                                <div class="col-lg-10">
                                                    <input type="date" class="form-control <?php echo form_error('tgl_diambil') ? 'is-invalid':'' ?>"
                                                     id="tgl_diambil"  name="tgl_diambil"  placeholder="">
                                                    <div class="invalid-feedback">
                                                        <?php echo form_error('tgl_diambil') ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="nama" class="col-lg-2 col-form-label">Nama Pemesan</label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control <?php echo form_error('nama') ? 'is-invalid':'' ?>"
                                                     id="nama"  name="nama"  placeholder="">
                                                    <div class="invalid-feedback">
                                                        <?php echo form_error('nama') ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="no_hp" class="col-lg-2 col-form-label">NO HP</label>
                                                <div class="col-lg-10">
                                                    <input type="number" class="form-control <?php echo form_error('no_hp') ? 'is-invalid':'' ?>"
                                                     id="no_hp"  name="no_hp"  placeholder="">
                                                    <div class="invalid-feedback">
                                                        <?php echo form_error('no_hp') ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label">Harga</label>
                                                <div class="col-lg-10">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="hargaRadio" id="hargaRadio1" value="harga_satuan_normal" checked>
                                                        <label class="form-check-label" for="hargaRadio1">
                                                            Harga Normal
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="hargaRadio" id="hargaRadio2" value="harga_satuan_reseller">
                                                        <label class="form-check-label" for="hargaRadio2">
                                                            Harga Reseller
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="dibayar" class="col-lg-2 col-form-label">Dibayar</label>
                                                <div class="col-lg-10">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">Rp.</div>
                                                        </div>
                                                        <input type="number" class="form-control price <?php echo form_error('dibayar') ? 'is-invalid':'' ?>"
                                                        id="dibayar"  name="dibayar"  placeholder="">
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        <?php echo form_error('dibayar') ?>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            <h5 class="border-bottom border-primary mb-3 mt-4">Barang yang dipesan</h5>

                                            <div class="barang-group-dynamic"></div>

                                            <div class="barang-group">
                                                <div class="form-group form-row mb-4 mb-lg-3">
                                                    <div class="col-lg-4 mb-2 mb-lg-0">
                                                        <div class="input-group input-group-sm">
                                                            <select class="custom-select" name="idBarang[]">
                                                                <option value="">-- Pilih Nama Produk --</option>
                                                                <?php foreach($barangs as $barang): ?>
                                                                    <option value="<?=$barang->id_barang?>"><?=$barang->nama_barang?></option> 
                                                                <?php endforeach;?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 mb-2 mb-lg-0">
                                                        <input type="number" class="form-control form-control-sm" 
                                                        name="jumlah[]" placeholder="Jumlah" aria-label="Jumlah">
                                                    </div>
                                                    <div class="col-lg-4 mb-2 mb-lg-0">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">Rp.</div>
                                                            </div>
                                                            <input type="text" class="form-control form-control-sm" 
                                                             name="subtotal[]" placeholder="Subtotal" aria-label="Subtotal" disabled>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="add-field btn btn-sm btn-outline-primary col-lg-1 mb-2 mb-lg-0"><i class="fas fa-plus"></i></a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-7 col-sm-6 text-lg-right"></div>
                                                <div class="col-lg-5 col-sm-6 p-0">
                                                    <div class="input-group border border-primary rounded">
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
            price.addEventListener('focus', (event) => {
                var x = event.target.value;
                var group = new Intl.NumberFormat().format(1111).replace(/1/g, '');
                var decimal = new Intl.NumberFormat().format(1.1).replace(/1/g, '');
                var reversedVal = x.replace(new RegExp('\\' + group, 'g'), '');
                reversedVal = reversedVal.replace(new RegExp('\\' + decimal, 'g'), '.');
                event.target.value = Number.isNaN(reversedVal)?0:reversedVal;
                event.target.type = 'number'
            });

            price.addEventListener('blur', (event) => {
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

        document.getElementById('tgl_dipesan').valueAsDate = new Date();

        $('.add-field').click(function(){
            $('.barang-group').clone().appendTo('.barang-group-dynamic');
            $('.barang-group-dynamic .barang-group').addClass('single remove');
            $('.single .add-field').remove();
            $('.single > .form-row').append('<a href="#" class="remove-field btn btn-sm btn-outline-danger col-lg-1"><i class="fas fa-minus"></i></a>');
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
        $('select[name="idBarang[]"]').each(function(){
            countJmlSubtotal($(this));
        });
        function initCountJmlUang(){
            $('select[name="idBarang[]"]').change(function(){
                countJmlSubtotal($(this));
            });
            $('input[name="jumlah[]"]').keyup(function(){
                countJmlSubtotal($(this));
            });
            $('input[name="hargaRadio"]').change(function(){
                $('select[name="idBarang[]"]').each(function(){
                    countJmlSubtotal($(this));
                });
            });
            
        }
        function countJmlSubtotal(object){
            var idBarang = object.parents('.form-row').find('select[name="idBarang[]"]').val();
            var jumlah =  object.parents('.form-row').find('input[name="jumlah[]"]').val() 
            IntJumlah = Number.isInteger(jumlah) ? 0 : jumlah;
            var subtotal = object.parents('.form-row').find('input[name="subtotal[]"]');
            $.ajax({
                url:'<?=base_url()?>barang/get_barang_json',
                method: 'post',
                data: {id_barang: idBarang},
                dataType: 'json',
                success: function(response){
                    var len = response.length;
                    if(len > 0){
                        // Read values
                        var jenisHarga = $("input[name='hargaRadio']:checked").val();
                        var harga = 0;
                        var total = 0;
                        if(jenisHarga == "harga_satuan_normal"){
                            harga = response[0].harga_satuan_normal;
                        }else if(jenisHarga == "harga_satuan_reseller"){
                            harga = response[0].harga_satuan_reseller;
                        }
                        console.log("harga = "+harga);
                        subtotal.type = 'text';
                        subtotal.val(Intl.NumberFormat().format(jumlah * harga));

                        $('input[name="subtotal[]"]').each(function(){
                            subtotal = parseInt(removeFormatting($(this).val()));
                            if(Number.isNaN(subtotal)){return;};
                            total += subtotal;
                        });
                        $('input[name="total"]').val(Intl.NumberFormat().format(total));
                    }else{
                        subtotal.val("0");
                    }
                    
                }
            });
        }

        function dataValidation(){
            $(".alert").remove();
            var emptyInput = false

            $('#idPenjual').removeClass('is-invalid');
            $('#tgl_diambil').removeClass('is-invalid');
            $('#nama').removeClass('is-invalid');
            $('#no_hp').removeClass('is-invalid');
            if($('#idPenjual').val() === ""){
                emptyInput = true;
                $('#idPenjual').addClass('is-invalid');
            }
            if($('#tgl_diambil').val() === ""){
                emptyInput = true;
                $('#tgl_diambil').addClass('is-invalid');
            }
            if($('#nama').val() === ""){
                emptyInput = true;
                $('#nama').addClass('is-invalid');
            }
            if($('#no_hp').val() === ""){
                emptyInput = true;
                $('#no_hp').addClass('is-invalid');
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
                if(selects[0].value == "" && inputs[0].value == ""){
                    field.remove()
                }else{
                    selects[0].classList.remove("is-invalid");
                    if(selects[0].value == "") {
                        emptyInput = true;
                        selects[0].classList.add("is-invalid");
                    }
                    inputs[0].classList.remove("is-invalid");
                    if(inputs[0].value == "") {
                        emptyInput = true;
                        inputs[0].classList.add("is-invalid");
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

                inputs[0].classList.remove("is-invalid");
                if(inputs[0].value == "") {
                    emptyInput = true;
                    inputs[0].classList.add("is-invalid");
                }
            }

            reverseFormatting();
            if(emptyInput){
                $('#messageModal').modal('show'); 
                $('#messageModal').find('#message').text('Harap isi data pesanan dengan lengkap'); 
                $('input[name="subtotal"]').type = 'text';
            }else{
                $('input[name="subtotal[]"]').prop('disabled', false);
                $('input[name="subtotal[]"]').each(function(){
                    $(this).val(removeFormatting($(this).val()));
                });
            }
            return(!emptyInput);
        }


    </script>

</body>

</html>