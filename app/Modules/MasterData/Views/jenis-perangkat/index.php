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
            </script>

            <script>
                $(document).ready(function() {

                    setTimeout(() => {

                        displayData();
                    }, time);
                })

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
                            });
                            $("#data-jenis_perangkat").LoadingOverlay("hide");
                        }
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
                        }
                    });
                    return false;
                };
            </script>

            <?= $this->endSection(); ?>