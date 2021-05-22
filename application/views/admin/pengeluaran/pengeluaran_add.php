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
                            Input Pengeluaran
                        </h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Pendapatan hari ini -->
                        <div class="col-12">
                            <div class="card shadow">
                                <div class="card-header">
                                    <a class="btn btn-sm text-primary" href="<?php echo site_url('pengeluaran') ?>"><i class="fas fa-arrow-left mr-1"></i> Kembali<span class="hide-mobile"> ke data pengeluaran</span></a>
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

                                        <form action="<?=site_url('pengeluaran/simpan_pengeluaran')?>" method="post" onsubmit="return dataValidation()">

                                            <div class="form-group row">
                                                <label for="tgl" class="col-lg-2 col-form-label">Tanggal Pengeluaran</label>
                                                <div class="col-lg-10">
                                                    <input type="date" class="form-control <?php echo form_error('tgl') ? 'is-invalid':'' ?>"
                                                     id="tgl" name="tgl"  placeholder="" min="<?=Date("Y-m-d")?>" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="jenis" class="col-lg-2 col-form-label">Jenis Pengeluaran</label>
                                                <div class="input-group col-lg-10">
                                                <select class="custom-select" name="jenis" id="jenis">
                                                    <option value="pengeluaran harian" selected>Pengeluaran harian (Modal)</option>
                                                    <option value="pengeluaran pesanan">Pengeluaran pesanan</option>
                                                    <option value="lainnya">Lainnya</option>
                                                </select>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="barang-group-dynamic"></div>

                                            <div class="barang-group">
                                                <div class="form-group form-row">
                                                    <div class="col-md-5 mb-2 mb-md-0">
                                                        <input type="text" class="form-control form-control-sm"
                                                        name="barang[]" placeholder="Nama barang" aria-label="Nama barang">
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
                                                            <input type="text" class="form-control price form-control-sm" 
                                                             name="harga[]" placeholder="Harga" aria-label="Harga">
                                                        </div>
                                                    </div>
                                                    <a href="#" class="add-field btn btn-sm btn-outline-primary col-md-1 mb-2 mb-md-0"><i class="fas fa-plus"></i></a>
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

        document.getElementById('tgl').valueAsDate = new Date();

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

            $('html, body').animate({
                scrollTop: $(".barang-group").offset().top
            }, 1000);
        });
        $(document).on('click', '.remove-field', function(e) {
            $(this).parents('.remove').remove();
            e.preventDefault();
        });

        $('input[name="harga[]"]').focusout(function(){
            var total = 0;
            $('input[name="harga[]"]').each(function(){
                console.log("+"+parseInt(removeFormatting($(this).val())));
                console.log($(this));
                subtotal = parseInt(removeFormatting($(this).val()));
                if(Number.isNaN(subtotal)){return;};
                total += subtotal;
                console.log("total : "+total);
            });
            $('input[name="total"]').val(Intl.NumberFormat().format(total));
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
                            input.classList.remove("is-invalid");
                        if(input.value == "") {
                            emptyInput = true;
                            input.classList.add("is-invalid");
                        }
                    }
                }
            }

            if(fields.length < 1){
                console.log("remove = "+fields.length);
                const inputs = document.querySelector('.barang-group').querySelectorAll('input');
                for(input of inputs){
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
            }
            return(!emptyInput);
        }


    </script>

</body>

</html>