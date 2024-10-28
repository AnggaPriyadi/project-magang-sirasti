<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>
<div class="main-container">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row justify-content-between align-items-center"> <!-- Menambahkan class justify-content-between dan align-items-center -->
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>MAC Address Management</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Radius</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">MAC Address Management</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?= site_url('radius/create') ?>" class="btn btn-primary">Tambah</a>
                </div>

            </div>
        </div>

        <form action="<?= site_url('radius/deleteSelected') ?>" method="post">
            <?= csrf_field() ?>
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Data Table Mac Address</h4>
                    <div class="col-md-6 col-sm-12 text-right">
                    <form action="<?= site_url('radius/search') ?>" method="post" class="form-inline"> 
                        <?= csrf_field() ?>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama...">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
                <div class="pb-20">
                    <table class="table table-striped">
                        <thead> 
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>MAC Address</th>
                                <th>Nama</th>
                                <th>Inventaris</th>
                                <th>Divisi</th>
                                <th>Jenis Perangkat</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataMAC as $user): ?>
                            <?php if (isset($search) && !empty($search) && stripos($user['username'], $search) === false) continue; ?>
                            <tr>
                                <td><input type="checkbox" name="selected[]" value="<?= $user['id'] ?>"></td>
                                <td><?= $user['username'] ?></td>
                                <td><?= $user['firstname'] ?></td>
                                <td><?= $user['lastname'] ?></td>
                                <td>
                                    <?php //foreach ($departments as $department): ?>
                                        <?php //if ($user['department_id'] == $department['id']): ?>
                                            <?php //echo $department['nama_department'] ?>
                                        <?php //endif; ?>
                                    <?php //endforeach; ?>
                                </td>
                                <td>
                                    <?php //foreach ($jenis_perangkat as $perangkat): ?>
                                        <?php //if ($user['jenis_perangkat_id'] == $perangkat['id']): ?>
                                            <?php //echo $perangkat['nama_perangkat'] ?>
                                        <?php //endif; ?>
                                    <?php //endforeach; ?>
                                </td>
                                <td>
                                    <a href="<?= site_url('radius/edit/' . $user['id']) ?>" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="<?= site_url('radius/delete') ?>" method="post" style="display: inline;">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="mac" value="<?= $user['id'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <button style="margin-left:20px" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus item terpilih?')">Delete Selected</button>
                </div>                
            </div>
        </form>

        <script>
            // Script untuk memilih semua checkbox
            document.getElementById('select-all').addEventListener('change', function() {
                var checkboxes = document.querySelectorAll('input[name="selected[]"]');
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = this.checked;
                }, this);
            });
        </script>
    </div>

<?= $this->endSection() ?>
