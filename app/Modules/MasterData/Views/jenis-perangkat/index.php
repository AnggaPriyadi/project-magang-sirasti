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
                            <h4>Jenis Perangkat</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href=<?= base_url('dashboard') ?>>Home</a></li>
                                <li class="breadcrumb-item">Data Center Asset Management</li>
                                <li class="breadcrumb-item" aria-current="page">Master Data</li>
                                <li class="breadcrumb-item active" aria-current="page">Jenis Perangkat</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <button <?php echo $display; ?> type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#tambah-jenis_perangkat" role="button"><i class="icon-copy fi-plus"></i> &nbsp;
                            Tambah Data
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Data Jenis Perangkat</h4>
                </div>
                <div class="pb-20">
                    <table class="table stripe hover nowrap" id="table-jenis_perangkat">
                        <thead>
                            <tr>
                                <th class="table-plus">#</th>
                                <th>Jenis Perangkat</th>
                                <th <?php echo $display; ?> class="datatable-nosort <?php echo $addClass; ?>"
                                    style="width:15%">Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody id="data-jenis_perangkat">


                        </tbody>
                    </table>

                    <table style="display:none" id="table-export">
                        <thead>
                            <tr>
                                <th class="table-plus" scope="col">#</th>
                                <th scope="col">Jenis Perangkat</th>
                            </tr>
                        </thead>
                        <tbody id="data-export">

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- MODAL TAMBAH -->
            <div class="modal fade" id="tambah-jenis_perangkat" tabindex="-1" role="dialog"
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
                                    <label>Nama Jenis Perangkat</label>
                                    <input class="form-control" id="nama_jenisTambah" type="text" value=""
                                        placeholder="Silahkan input jenis perangkat">
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
            <div class="modal fade" id="edit-jenis_perangkat" tabindex="-1" role="dialog"
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
                                    <input type="hidden" name="id-jenis" id="id_jenis" class="form-control">
                                    <input class="form-control" id="nama_jenis" type="text" value=""
                                        placeholder="Silahkan input jenis perangkat">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="button" onclick="updateData()" class="btn btn-primary">Simpan</button>
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
                            <input type="hidden" name="id-jenis" id="id_delete" class="form-control">
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

                document.getElementById("nama_jenisTambah").addEventListener("keypress", forceKeyPressUppercase, false);
                document.getElementById("nama_jenis").addEventListener("keypress", forceKeyPressUppercase, false);

                function displayData() {
                    $("#data-jenis_perangkat").LoadingOverlay("show", {

                        image: "",
                        fontawesome: "fa fa-cog fa-spin",
                        fontawesomeColor: '#1a477d',
                    });
                    $.ajax({
                        type: 'get',
                        dataType: "html",
                        url: '<?= base_url('jenis-perangkat/displayData') ?>',
                        success: function(response) {
                            $('#table-jenis_perangkat').DataTable().destroy();
                            $('#data-jenis_perangkat').html(response);
                            $('#table-jenis_perangkat').DataTable({
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
                                        title: 'Daftar Asset Jenis Perangkat',
                                        exportOptions: {
                                            columns: [0, 1]
                                        }
                                    },
                                    {
                                        extend: 'excelHtml5',
                                        exportOptions: {
                                            columns: [0, 1]
                                        },
                                        title: 'Daftar Asset Jenis Perangkat',
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
                                        title: 'Daftar Asset Jenis Perangkat',
                                    },
                                    {
                                        extend: 'pdfHtml5',
                                        exportOptions: {
                                            columns: [0, 1]
                                        },
                                        title: 'Daftar Asset Jenis Perangkat',
                                    },

                                ],
                            });
                            $("#data-jenis_perangkat").LoadingOverlay("hide");
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
                        url: 'jenis-perangkat/displayDataExport',
                        success: function(response) {
                            $('#data-export').html(response);
                        },
                        error: function(err) {
                            console.log(err)
                        },
                    });
                }



                function saveData() {
                    var nama_jenis_perangkat = $('#nama_jenisTambah').val();

                    $.ajax({
                        type: "POST",
                        dataType: "html",
                        url: '<?= base_url('jenis-perangkat/store') ?>',
                        data: {
                            nama_jenis_perangkat
                        },
                        success: function(response) {
                            $('#nama_jenis').val("");
                            $('#tambah-jenis_perangkat').modal('hide');

                            swal({
                                title: 'Berhasil menambahkan data jenis perangkat!',
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

                $('#data-jenis_perangkat').on('click', '.editJenis', function() {
                    $('#edit-jenis_perangkat').modal('show');
                    $("#id_jenis").val($(this).data('id'));
                    $("#nama_jenis").val($(this).data('nama_jenis_perangkat'));
                });

                function updateData() {

                    var id = $('#id_jenis').val();
                    var nama_jenis_perangkat = $('#nama_jenis').val();
                    $.ajax({
                        type: "POST",
                        dataType: "html",
                        url: `jenis-perangkat/update/${id}`,
                        data: {
                            id,
                            nama_jenis_perangkat
                        },
                        success: function(response) {
                            $("#id_jenis").val("");
                            $("#nama_jenis").val("");
                            $('#edit-jenis_perangkat').modal('hide');

                            swal({
                                title: 'Berhasil memperbarui data jenis perangkat!',
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

                $('#data-jenis_perangkat').on('click', '.deleteJenis', function() {
                    var id = $(this).data('id');
                    $('#confirmation-modal').modal('show');
                    $('#id_delete').val(id);
                });

                function deleteData() {
                    var id = $('#id_delete').val();
                    $.ajax({
                        type: "POST",
                        dataType: "html",
                        url: `jenis-perangkat/delete/${id}`,
                        data: {
                            id
                        },
                        success: function(response) {
                            $("#" + id).remove();
                            $('#id_delete').val("");

                            swal({
                                title: 'Berhasil menghapus data jenis perangkat!',
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


                    doc.save("Daftar Asset Jenis Perangkat [" + today + "].pdf")
                }
            </script>

            <?= $this->endSection(); ?>