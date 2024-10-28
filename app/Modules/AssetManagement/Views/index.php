<?php
$session = session();

// $display = 'style="display:none;"'; // Default hidden
// $addClass = 'hidden'; // Default class hidden

$arrayUser = $session->get();


if (isset($arrayUser['isLoggedIn']) && $arrayUser['isLoggedIn'] === true) {

    $roleUser = $arrayUser['role'];


    if ($roleUser == 'admin') {
        $display = '';
        $addClass = '';
    } else {
        $display = 'style="display: none"';
        $addClass = 'hidden';
    }
}
?>


<?= $this->extend('layout/dashboard'); ?>

<?= $this->section('content'); ?>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Asset Management</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                                <li class="breadcrumb-item">Data Center Asset Management</li>
                                <li class="breadcrumb-item active" aria-current="page">Asset Management</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#tambah-asset_management" role="button"><i class="icon-copy fi-plus"></i>
                            &nbsp;
                            Tambah Data
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Asset Management Infrastruktur IT</h4>
                </div>

                <div class="pb-20">
                    <table class="table table-striped table-row-bordered table-rounded  table-hover border gy-5 gs-7" id="table-asset_management">
                        <thead>
                            <tr>
                                <th class="table-plus">#</th>
                                <th>Jenis Perangkat</th>
                                <th>Merk</th>
                                <th>Tipe</th>
                                <th>Serial No.</th>
                                <th>No. Asset</th>
                                <th>Lokasi Perangkat</th>
                                <th>Status</th>
                                <th>Catatan</th>
                                <th <?php echo $display; ?> class="datatable-nosort <?php echo $addClass; ?>">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="data-asset_management">

                        </tbody>
                    </table>

                    <table style="display:none" id="table-export">
                        <thead>
                            <tr>
                                <th class="table-plus" scope="col">#</th>
                                <th scope="col">Jenis Perangkat</th>
                                <th scope="col">Merk</th>
                                <th scope="col">Tipe</th>
                                <th scope="col">Serial No.</th>
                                <th scope="col">No. Asset</th>
                                <th scope="col">Lokasi Perangkat</th>
                                <th scope="col">Status</th>
                                <th scope="col">Catatan</th>
                            </tr>
                        </thead>
                        <tbody id="data-export">

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- MODAL TAMBAH -->
            <div class="modal fade" id="tambah-asset_management" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modal-lg">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Tambah Data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form id="form-tambahAsset" method="post">
                                <div class="form-group">
                                    <label>Jenis Perangkat</label>
                                    <select id="jenisTambah" class="custom-select2 form-control" name="jenis_perangkat"
                                        style="width: 100%; height: 38px;">
                                        <optgroup label="Jenis Perangkat">
                                            <?php foreach ($jenis_perangkat as $jenis) { ?>
                                                <option value="<?= $jenis->id_jenis; ?>">
                                                    <?= $jenis->nama_jenis_perangkat; ?></option>
                                            <?php } ?>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Merk Perangkat</label>
                                    <select id="merkTambah" class="custom-select2 form-control" name="merk"
                                        style="width: 100%; height: 38px;">
                                        <optgroup label="Merk Perangkat">
                                            <?php foreach ($merk_perangkat as $merk) { ?>
                                                <option value="<?php echo $merk->id_merk; ?>">
                                                    <?php echo $merk->nama_merk; ?></option>
                                            <?php } ?>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tipe</label>
                                    <input class="form-control" id="tipe_perangkat" name="tipe" type="text" value=""
                                        placeholder="Silahkan input tipe perangkat">
                                </div>
                                <div class="form-group">
                                    <label>Nomor Serial</label>
                                    <input class="form-control" id="serial_no" name="serial_no" type="text" value=""
                                        placeholder="Silahkan input no. serial perangkat">
                                </div>
                                <div class="form-group">
                                    <label>Nomor Asset</label>
                                    <input class="form-control" id="no_asset" name="no_asset" type="text" value=""
                                        placeholder="Silahkan input no. asset perangkat">
                                </div>
                                <div class="form-group">
                                    <label>Lokasi Perangkat</label>
                                    <select id="lokasiTambah" class="custom-select2 form-control"
                                        name="lokasi_perangkat" style="width: 100%; height: 38px;">
                                        <optgroup label="Rak Data Center">
                                            <?php foreach (array_slice($lokasi_pemasangan, 0, 9) as $lokasi) { ?>
                                                <option value="<?php echo $lokasi->id_lokasi; ?>">
                                                    <?php echo $lokasi->nama_lokasi; ?></option>
                                            <?php } ?>
                                        </optgroup>
                                        <optgroup label="Ruang Shaft Gedung GKP">
                                            <?php foreach ($ruang_shaft as $lokasi) { ?>
                                                <option value="<?php echo $lokasi->id_lokasi; ?>">
                                                    <?php echo $lokasi->nama_lokasi; ?></option>
                                            <?php } ?>
                                        </optgroup>
                                        <optgroup label="Gedung Kantor Pusat">
                                            <?php foreach ($gkp as $lokasi) { ?>
                                                <option value="<?php echo $lokasi->id_lokasi; ?>">
                                                    <?php echo $lokasi->nama_lokasi; ?></option>
                                            <?php } ?>
                                        </optgroup>
                                        <optgroup label="Gudang IT">
                                            <?php foreach ($gudang as $lokasi) { ?>
                                                <option value="<?php echo $lokasi->id_lokasi; ?>">
                                                    <?php echo $lokasi->nama_lokasi; ?></option>
                                            <?php } ?>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status Perangkat</label>
                                    <select id="statusTambah" class="custom-select2 form-control" name="status"
                                        style="width: 100%; height: 38px;">
                                        <optgroup label="Status Perangkat">
                                            <?php foreach ($status_asset as $status) { ?>
                                                <option value="<?php echo $status->id_status; ?>">
                                                    <?php echo $status->nama_status; ?></option>
                                            <?php } ?>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Catatan</label>
                                    <textarea id="catatan" name="catatan" class="form-control"
                                        placeholder="Silahkan input notes untuk aset ini"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="button" onclick="addData()" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL EDIT -->
            <div class="modal fade" id="edit-asset_management" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Edit Data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form id="form-editAsset" method="post">
                                <div class="form-group">
                                    <input type="hidden" name="id_asset" id="id_asset" class="form-control">
                                    <label>Jenis Perangkat</label>
                                    <select id="jenisEdit" class="custom-select2 form-control" name="jenis_perangkat"
                                        style="width: 100%; height: 38px;">
                                        <optgroup label="Jenis Perangkat">
                                            <?php foreach ($jenis_perangkat as $jenis) { ?>
                                                <option value="<?php echo $jenis->id_jenis; ?>">
                                                    <?php echo $jenis->nama_jenis_perangkat; ?></option>
                                            <?php } ?>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Merk Perangkat</label>
                                    <select id="merkEdit" class="custom-select2 form-control" name="merk"
                                        style="width: 100%; height: 38px;">
                                        <optgroup label="Merk Perangkat">
                                            <?php foreach ($merk_perangkat as $merk) { ?>
                                                <option value="<?php echo $merk->id_merk; ?>">
                                                    <?php echo $merk->nama_merk; ?></option>
                                            <?php } ?>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tipe</label>
                                    <input class="form-control" id="tipe_perangkatEdit" name="tipe" type="text" value=""
                                        placeholder="Silahkan input tipe perangkat">
                                </div>
                                <div class="form-group">
                                    <label>Nomor Serial</label>
                                    <input class="form-control" id="serial_noEdit" name="serial_no" type="text" value=""
                                        placeholder="Silahkan input no. serial perangkat">
                                </div>
                                <div class="form-group">
                                    <label>Nomor Asset</label>
                                    <input class="form-control" id="no_assetEdit" name="no_asset" type="text" value=""
                                        placeholder="Silahkan input no. asset perangkat">
                                </div>
                                <div class="form-group">
                                    <label>Lokasi Perangkat</label>
                                    <select id="lokasiEdit" class="custom-select2 form-control" name="lokasi_perangkat"
                                        style="width: 100%; height: 38px;">
                                        <optgroup label="Rak Data Center">
                                            <?php foreach (array_slice($lokasi_pemasangan, 0, 9) as $lokasi) { ?>
                                                <option value="<?php echo $lokasi->id_lokasi; ?>">
                                                    <?php echo $lokasi->nama_lokasi; ?></option>
                                            <?php } ?>
                                        </optgroup>
                                        <optgroup label="Ruang Shaft GKP">
                                            <?php foreach ($ruang_shaft as $lokasi) { ?>
                                                <option value="<?php echo $lokasi->id_lokasi; ?>">
                                                    <?php echo $lokasi->nama_lokasi; ?></option>
                                            <?php } ?>
                                        </optgroup>
                                        <optgroup label="Gedung Kantor Pusat">
                                            <?php foreach ($gkp as $lokasi) { ?>
                                                <option value="<?php echo $lokasi->id_lokasi; ?>">
                                                    <?php echo $lokasi->nama_lokasi; ?></option>
                                            <?php } ?>
                                        </optgroup>
                                        <optgroup label="Gudang IT">
                                            <?php foreach ($gudang as $lokasi) { ?>
                                                <option value="<?php echo $lokasi->id_lokasi; ?>">
                                                    <?php echo $lokasi->nama_lokasi; ?></option>
                                            <?php } ?>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status Perangkat</label>
                                    <select id="statusEdit" class="custom-select2 form-control" name="status"
                                        style="width: 100%; height: 38px;">
                                        <optgroup label="Status Perangkat">
                                            <?php foreach ($status_asset as $status) { ?>
                                                <option value="<?php echo $status->id_status; ?>">
                                                    <?php echo $status->nama_status; ?></option>
                                            <?php } ?>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Catatan</label>
                                    <textarea id="catatanEdit" name="catatan" class="form-control"
                                        placeholder="Silahkan input notes untuk aset ini"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="button" onclick="updateData()" class="btn btn-primary">Ubah</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KONFIRMASI -->
            <div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content bg-warning">
                        <div class="modal-body text-center">
                            <h3 class="mb-15"><i class="fa fa-exclamation-triangle"></i> Peringatan</h3>
                            <h6 class="mb-10">Apakah anda yakin akan menghapus
                                data ini?</h6>
                            <p class="text-sm">Data yang dihapus tidak dapat dikembalikan.</p>
                            <input type="hidden" name="id_asset" id="id_delete" class="form-control">
                        </div>
                        <div class="row align-self-center" style="max-width: 170px; margin: 0 auto;">
                            <div class="col-6">
                                <button type="button" class="btn border-radius-100 btn-dark btn-block confirmation-btn"
                                    onclick="deleteData()" data-dismiss="modal"><i
                                        class="ion-checkmark-round"></i></button>
                                <p class="text-center mt-1">YA</p>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn border-radius-100 btn-light btn-block confirmation-btn"
                                    data-dismiss="modal"><i class="ion-close-round"></i></button>
                                <p class="text-center mt-1">TIDAK</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function() {

                    setTimeout(() => {

                        displayData();
                    }, time);
                    displayDataExport();
                })

                function forceKeyPressUppercase(e) {
                    var charInput = e.keyCode;
                    if ((charInput >= 97) && (charInput <= 122)) {
                        if (!e.ctrlKey && !e.metaKey && !e.altKey) {
                            var newChar = charInput - 32;
                            var start = e.target.selectionStart;
                            var end = e.target.selectionEnd;
                            e.target.value = e.target.value.substring(0, start) + String.fromCharCode(newChar) + e.target.value
                                .substring(end);
                            e.target.setSelectionRange(start + 1, start + 1);
                            e.preventDefault();
                        }
                    }
                }

                document.getElementById("tipe_perangkat").addEventListener("keypress", forceKeyPressUppercase, false);
                document.getElementById("serial_no").addEventListener("keypress", forceKeyPressUppercase, false);
                document.getElementById("no_asset").addEventListener("keypress", forceKeyPressUppercase, false);
                document.getElementById("tipe_perangkatEdit").addEventListener("keypress", forceKeyPressUppercase, false);
                document.getElementById("serial_noEdit").addEventListener("keypress", forceKeyPressUppercase, false);
                document.getElementById("no_assetEdit").addEventListener("keypress", forceKeyPressUppercase, false);

                function displayData() {
                    $("#data-asset_management").LoadingOverlay("show", {

                        image: "",
                        fontawesome: "fa fa-cog fa-spin",
                        fontawesomeColor: '#1a477d',
                    });
                    $.ajax({
                        type: 'get',
                        dataType: "html",
                        url: 'asset-management/displayData',
                        success: function(response) {
                            $('#table-asset_management').DataTable().destroy();
                            $('#data-asset_management').html(response);
                            $('#table-asset_management').DataTable({
                                scrollCollapse: true,
                                autoWidth: false,
                                responsive: true,
                                columnDefs: [{
                                        targets: "restricted",
                                        visible: false,
                                        searchable: false
                                    },
                                    {
                                        targets: "datatable-nosort",
                                        orderable: false,
                                    },
                                ],
                                "language": {
                                    "emptyTable": "Tidak ada data yang tersedia pada tabel ini",
                                    "info": "_START_ sampai _END_ dari _TOTAL_ entri",
                                    "infoEmpty": "0 sampai 0 dari _TOTAL_ entri",
                                    "lengthMenu": "Tampilkan _MENU_ entri",
                                    "infoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                                    "search": "Cari:",
                                    "zeroRecords": "Tidak ditemukan data yang sesuai",
                                    "loadingRecords": "Sedang memuat...",
                                    "processing": "Sedang memproses...",
                                    searchPlaceholder: "Filter Data",
                                    paginate: {
                                        next: '<i class="ion-chevron-right"></i>',
                                        previous: '<i class="ion-chevron-left"></i>'
                                    },

                                },
                                dom: 'Bfrtip',
                                buttons: [{
                                        extend: 'print',
                                        text: 'Cetak',
                                        title: 'Asset Manajemen Infrastruktur IT',
                                        exportOptions: {
                                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                                        }
                                    },
                                    {
                                        extend: 'excelHtml5',
                                        exportOptions: {
                                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                                        },
                                        title: 'Asset Manajemen Infrastruktur IT',
                                        customize: function(xlsx) {
                                            var sheet = xlsx.xl.worksheets['sheet1.xml'];

                                            $('c[r=A1] t', sheet).attr('s', '22');
                                        }
                                    },
                                    {
                                        extend: 'csvHtml5',
                                        exportOptions: {
                                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                                        },
                                        title: 'Asset Manajemen Infrastruktur IT',
                                    },
                                    {
                                        extend: 'pdfHtml5',
                                        exportOptions: {
                                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                                        },
                                        title: 'Asset Manajemen Infrastruktur IT',
                                    },

                                ],
                            });
                            $("#data-asset_management").LoadingOverlay("hide");
                        },
                        error: function(err) {
                            console.log(err)
                        },
                    });
                }

                function displayDataExport() {
                    $.ajax({
                        type: 'get',
                        dataType: "html",
                        url: 'asset-management/displayDataExport',
                        success: function(response) {
                            $('#data-export').html(response);
                        },
                        error: function(err) {
                            console.log(err)
                        },
                    });
                }

                const alertMessage = (message, type) => {
                    swal({
                        title: message,
                        type: type,
                        toast: true,
                        padding: 20,
                        position: 'top-end',
                        showCloseButton: false,
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 2000,
                    })
                }

                function addData() {
                    var validation = validate();

                    if (validation !== 'sukses') {
                        alertMessage(`Silahkan Lengkapi Data ${validation}`, 'error')
                    } else {

                        var formData = $("#form-tambahAsset").serialize()

                        $.ajax({
                            type: "POST",
                            dataType: "html",
                            url: "asset-management/store",
                            data: formData,
                            success: function(response) {
                                $("#form-tambahAsset")[0].reset()
                                $('#tambah-asset_management').modal('hide');
                                alertMessage('Berhasil menambahkan data asset!', 'success')
                                displayData();
                                displayDataExport();
                            },
                            error: function(err) {
                                let err_log = err.responseJSON.errors;
                                console.log(err)
                            }
                        });
                    }
                };

                function validate() {
                    var validate = 'sukses';
                    if ($("#tipe_perangkat").val() == '') {
                        return 'Tipe Perangkat';
                    } else if ($("#serial_no").val() == '') {
                        return 'Nomor Serial';
                    } else if ($("#no_asset").val() == '') {
                        return 'Nomor Aset';
                    }
                    return validate;
                }

                $('#data-asset_management').on('click', '.editAsset', function() {
                    $('#edit-asset_management').modal('show');
                    $("#id_asset").val($(this).data('id'));
                    $("#jenisEdit").val($(this).data('jenis_perangkat'));
                    $("#merkEdit").val($(this).data('merk'));
                    $("#tipe_perangkatEdit").val($(this).data('tipe'));
                    $("#serial_noEdit").val($(this).data('serial_no'));
                    $("#no_assetEdit").val($(this).data('no_asset'));
                    $("#lokasiEdit").val($(this).data('lokasi_perangkat'));
                    $("#statusEdit").val($(this).data('status'));
                    $("#catatanEdit").val($(this).data('catatan'));

                    var namaJenis = $(this).data('nama_jenis_perangkat');
                    var namaMerk = $(this).data('nama_merk');
                    var namaLokasi = $(this).data('nama_lokasi');
                    var namaStatus = $(this).data('nama_status');

                    $("#select2-jenisEdit-container").text(namaJenis);
                    $("#select2-merkEdit-container").text(namaMerk);
                    $("#select2-lokasiEdit-container").text(namaLokasi);
                    $("#select2-statusEdit-container").text(namaStatus);

                });



                function validateEdit() {
                    var validate = 'sukses';
                    if ($("#tipe_perangkatEdit").val() == '') {
                        return 'Tipe Perangkat';
                    } else if ($("#serial_noEdit").val() == '') {
                        return 'Nomor Serial';
                    } else if ($("#no_assetEdit").val() == '') {
                        return 'Nomor Aset';
                    }
                    return validate;
                }

                function updateData() {

                    var id = $('#id_asset').val();

                    var formData = $("#form-editAsset").serialize()

                    var validation = validateEdit();


                    if (validation !== 'sukses') {
                        alertMessage(`Silahkan Lengkapi Data ${validation}`, 'error')
                    } else {

                        $.ajax({
                            type: "POST",
                            dataType: "html",
                            url: `asset-management/update/${id}`,
                            data: formData,
                            success: function(response) {
                                $("#form-editAsset")[0].reset()
                                $('#edit-asset_management').modal('hide');
                                alertMessage('Berhasil merubah data asset!', 'success')

                                displayData();
                                displayDataExport();
                            },
                            error: function(err) {
                                let err_log = err.responseJSON.errors;
                                console.log(err)
                            }

                        });
                    }
                };

                $('#data-asset_management').on('click', '.deleteAsset', function() {
                    var id = $(this).data('id');
                    $('#confirmation-modal').modal('show');
                    $('#id_delete').val(id);
                });

                function deleteData() {
                    var id = $('#id_delete').val();
                    $.ajax({
                        type: "POST",
                        dataType: "html",
                        url: `asset-management/delete/${id}`,
                        data: {
                            id
                        },
                        success: function(response) {
                            $("#" + id).remove();
                            $('#id_delete').val("");
                            alertMessage('Berhasil menghapus data asset!', 'success')

                            displayData();
                            displayDataExport();
                        }
                    });
                    return false;
                };

                function exportPDF() {

                    var doc = new jsPDF('landscape')

                    var header = function(data) {
                        doc.setFontSize(11);
                        doc.setTextColor(40);
                        doc.setFontStyle('times');
                        doc.text("ASSET INFRASTRUKTUR IT", 120, 10);
                        doc.text("PT. INDUSTRI TELEKOMUNIKASI INDONESIA (INTI)", 100, 17);
                    }

                    doc.autoTable({
                        margin: {
                            top: 23,
                            left: 10,
                            right: 10,
                            bottom: 50
                        },
                        html: '#table-export',
                        theme: 'grid',
                        headStyles: {
                            fillColor: "#efefef",
                            textColor: "black",
                            lineWidth: 0.1
                        },
                        styles: {
                            font: "Times",
                            lineColor: "black"
                        },
                        didDrawPage: header,
                    })

                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0');
                    if (mm == 0o1) {
                        mm = 'Januari'
                    } else if (mm == 0o2) {
                        mm = 'Februari'
                    } else if (mm == 0o3) {
                        mm = 'Maret'
                    } else if (mm == 0o4) {
                        mm = 'April'
                    } else if (mm == 0o5) {
                        mm = 'Mei'
                    } else if (mm == 0o6) {
                        mm = 'Juni'
                    } else if (mm == 0o7) {
                        mm = 'Juli'
                    } else if (mm == 8) {
                        mm = 'Agustus'
                    } else if (mm == 9) {
                        mm = 'September'
                    } else if (mm == 10) {
                        mm = 'Oktober'
                    } else if (mm == 11) {
                        mm = 'November'
                    } else if (mm == 12) {
                        mm = 'Desember'
                    }

                    var yyyy = today.getFullYear();

                    today = dd + ' ' + mm + ' ' + yyyy;
                    let finalY = doc.previousAutoTable.finalY;
                    doc.setFontSize(12);
                    doc.setFontStyle('times');
                    doc.text("Bandung, " + today, 212, finalY + 20);
                    doc.setFontSize(11);
                    doc.setFontStyle('times');
                    doc.text("Penanggung Jawab", 219, finalY + 25);
                    doc.setFontSize(11);
                    doc.setFontStyle('times');
                    doc.text("Kepala Infrastruktur TI", 216, finalY + 30);
                    doc.setFontSize(12);
                    doc.setFontStyle('times');
                    doc.text("(....................................................)", 205, finalY + 60);


                    doc.save("Asset Manajemen Infrastruktur IT [" + today + "].pdf")
                }
            </script>

            <?= $this->endSection(); ?>