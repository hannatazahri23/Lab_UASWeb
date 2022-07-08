<?= $this->extend('_layouts/_layouts') ?>

<?= $this->section('content') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Halaman Admin</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="home">Home</a></li>
                    <li class="breadcrumb-item active">Loket</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Loket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" action="/loket_tambah">
                <div class="modal-body">
                    <div class="form-group">
                        <label>No Loket</label>
                        <input required type="number" name="no" class="form-control" placeholder="nama">
                    </div>
                    <div class="form-group">
                        <label>Pelayan</label>
                        <select required class="form-control" name="users" id="users">
                            <option value="">pilih</option>
                            <?php foreach ($users as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['username'] ?></option>
                            <?php } ?>
                        </select>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php foreach ($loket as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Loket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form" action="/loket_edit/<?= $value['id'] ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>No Loket</label>
                            <input required type="number" value="<?= $value['loket'] ?>" name="no" class="form-control" placeholder="no lokrt">
                        </div>
                        <div class="form-group">
                            <label>Pelayan</label>
                            <select required class="form-control" name="users" id="users">
                                <option value="">pilih</option>
                                <?php foreach ($users as $k => $v) { ?>
                                    <option <?php if ($value['id_users'] = $v['id']) { ?> selected <?php } ?> value="<?= $v['id'] ?>"><?= $v['username'] ?></option>
                                <?php } ?>
                            </select>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <h3 class="card-title">Halaman Konfigurasi Admin</h3>
                            </div>
                            <div class="col-4">
                                <div class="float-sm-right">
                                    <a data-toggle="modal" data-target="#tambah" class="btn btn-primary btn-sm">
                                        <i class="fa fa-plus"></i> <span>Tambah Loket</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" id="print">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card text-center">
                                    <div class="card-header bg-primary">
                                        Daftar Loket Pelayanan
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">No loket</th>
                                                    <th scope="col">Pelayan</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($loket as $key => $value) { ?>
                                                    <tr>
                                                        <th scope="row"><?= $key + 1 ?></th>
                                                        <td><?= $value['loket'] ?></td>
                                                        <td><?= $value['username'] ?></td>
                                                        <td><?php if ($value['status'] == 0) {
                                                                echo "OFF";
                                                            } else {
                                                                echo "ON";
                                                            } ?></td>
                                                        <td><a data-toggle="modal" data-target="#edit<?= $value['id'] ?> " class="btn btn-warning btn-sm">
                                                                <i class="fa fa-pen"></i>
                                                            </a>
                                                            <a onclick="c()" href="/loket_hapus/<?= $value['id'] ?>" class="btn btn-danger btn-sm">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<script>
    function c() {
        confirm("Ingin menghapus?");
    }
</script>
<?= $this->endSection() ?>

<?= $this->section('script') ?>

<?= $this->include('dashboard/script') ?>

<?= $this->endSection() ?>