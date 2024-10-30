<?php
$session = session();
// Mendapatkan seluruh data session, termasuk informasi user
$arrayUser = $session->get();

// Cek apakah data pengguna ada di session
if (isset($arrayUser['isLoggedIn']) && $arrayUser['isLoggedIn'] === true) {
    // Mendapatkan role pengguna dari data session
    $roleUser = $arrayUser['role'];

    // Logika penentuan tampilan berdasarkan role pengguna
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
                            <h4>Jenis Perangkat</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                                <li class="breadcrumb-item">Data Center Asset Management</li>
                                <li class="breadcrumb-item" aria-current="page">Master Data</li>
                                <li class="breadcrumb-item active" aria-current="page">Merk Perangkat</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <button <?= $display; ?> type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#tambah-merk_perangkat" role="button"><i class="icon-copy fi-plus"></i> &nbsp;
                            Tambah Data
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Data Merk Perangkat</h4>
                </div>

                <div class="pb-20">
                    <table class="table stripe hover nowrap" id="table-merk_perangkat">
                        <thead>
                            <tr>
                                <th class="table-plus">#</th>
                                <th>Merk Perangkat</th>
                                <th <?php echo $display; ?> class="datatable-nosort <?= $addClass ?>"
                                    style="width:20%">Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody id="data-merk_perangkat">

                        </tbody>
                    </table>

                    <table style="display:none" id="table-export">
                        <thead>
                            <tr>
                                <th class="table-plus" scope="col">#</th>
                                <th scope="col">Merk Perangkat</th>
                            </tr>
                        </thead>
                        <tbody id="data-export">

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- MODAL TAMBAH -->
            <div class="modal fade" id="tambah-merk_perangkat" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Tambah Data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label>Nama Merk Perangkat</label>
                                    <input class="form-control" id="nama_merkTambah" type="text" value=""
                                        placeholder="Silahkan input merk perangkat">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="button" onclick="saveData()" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL EDIT -->
            <div class="modal fade" id="edit-merk_perangkat" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Edit Data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label>Nama Jenis Perangkat</label>
                                    <input type="hidden" name="id-merk" id="id_merk" class="form-control">
                                    <input class="form-control" id="nama_merk" type="text" value=""
                                        placeholder="Silahkan input merk perangkat">
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
                            <input type="hidden" name="id-merk" id="id_delete" class="form-control">
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

                document.getElementById("nama_merkTambah").addEventListener("keypress", forceKeyPressUppercase, false);
                document.getElementById("nama_merk").addEventListener("keypress", forceKeyPressUppercase, false);

                function displayData() {
                    $("#data-merk_perangkat").LoadingOverlay("show", {

                        image: "",
                        fontawesome: "fa fa-cog fa-spin",
                        fontawesomeColor: '#1a477d',
                    });
                    $.ajax({
                        type: 'get',
                        dataType: "html",
                        url: 'merk-perangkat/displayData',
                        success: function(response) {
                            $('#table-merk_perangkat').DataTable().destroy();
                            $('#data-merk_perangkat').html(response);
                            $('#table-merk_perangkat').DataTable({
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
                                            columns: [0, 1]
                                        }
                                    },
                                    {
                                        extend: 'excelHtml5',
                                        exportOptions: {
                                            columns: [0, 1]
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
                                            columns: [0, 1]
                                        },
                                        title: 'Asset Manajemen Infrastruktur IT',
                                    },
                                    {
                                        extend: 'pdfHtml5',
                                        exportOptions: {
                                            columns: [0, 1]
                                        },
                                        title: 'Asset Manajemen Infrastruktur IT',
                                    },

                                ],
                            });
                            $("#data-merk_perangkat").LoadingOverlay("hide");
                        },
                        error: function(err) {
                            console.log(err)
                        },
                    });
                }

                function displayDataExport() {
                    $.ajax({
                        type: 'get',
                        dataType: 'html',
                        url: 'merk-perangkat/displayDataExport',
                        success: function(response) {
                            $('#data-export').html(response);
                        },
                        error: function(err) {
                            console.log(err)
                        },
                    });
                }

                function saveData() {
                    var nama_merk = $('#nama_merkTambah').val();

                    $.ajax({
                        type: "POST",
                        dataType: "html",
                        url: "merk-perangkat/store",
                        data: {
                            nama_merk
                        },
                        success: function(response) {
                            $('#nama_merk').val("");
                            $('#tambah-merk_perangkat').modal('hide');

                            swal({
                                title: 'Berhasil menambahkan data merk perangkat!',
                                type: 'success',
                                toast: true,
                                padding: 20,
                                position: 'top-end',
                                showCloseButton: false,
                                showCancelButton: false,
                                showConfirmButton: false,
                                timer: 2000,
                            })
                            displayData();
                            displayDataExport();
                        }
                    });
                    return false;
                };

                $('#data-merk_perangkat').on('click', '.editMerk', function() {
                    $('#edit-merk_perangkat').modal('show');
                    $("#id_merk").val($(this).data('id'));
                    $("#nama_merk").val($(this).data('nama_merk'));
                });

                function updateData() {

                    var id = $('#id_merk').val();
                    var nama_merk = $('#nama_merk').val();
                    $.ajax({
                        type: "POST",
                        dataType: "html",
                        url: `merk-perangkat/update/${id}`,
                        data: {
                            id,
                            nama_merk
                        },
                        success: function(response) {
                            $("#id_merk").val("");
                            $("#nama_merk").val("");
                            $('#edit-merk_perangkat').modal('hide');

                            swal({
                                title: 'Berhasil memperbarui data merk perangkat!',
                                type: 'success',
                                toast: true,
                                padding: 20,
                                position: 'top-end',
                                showCloseButton: false,
                                showCancelButton: false,
                                showConfirmButton: false,
                                timer: 2000,
                            })

                            displayData();
                            displayDataExport();
                        }
                    });
                    return false;
                };

                $('#data-merk_perangkat').on('click', '.deleteMerk', function() {
                    var id = $(this).data('id');
                    $('#confirmation-modal').modal('show');
                    $('#id_delete').val(id);
                });

                function deleteData() {
                    var id = $('#id_delete').val();
                    $.ajax({
                        type: "POST",
                        dataType: "html",
                        url: `merk-perangkat/delete/${id}`,
                        data: {
                            id
                        },
                        success: function(response) {
                            $("#" + id).remove();
                            $('#id_delete').val("");

                            swal({
                                title: 'Berhasil menghapus data merk perangkat!',
                                type: 'success',
                                toast: true,
                                padding: 20,
                                position: 'top-end',
                                showCloseButton: false,
                                showCancelButton: false,
                                showConfirmButton: false,
                                timer: 2000,
                            })

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