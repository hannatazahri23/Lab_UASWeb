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
                    <li class="breadcrumb-item active">Pelayanan</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" action="/pelayan_tambah">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input required type="text" name="fullname" class="form-control" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input required type="text" name="username" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input required type="text" name="alamat" class="form-control" placeholder="Alamat">
                    </div>
                    <div class="form-group">
                        <label>NO telp</label>
                        <input required type="text" name="telepon" class="form-control" placeholder="NO telp">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input required type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select required class="form-control" name="role">
                            <option value="">pilih</option>
                            <option value="0">Admin</option>
                            <option value="1">pelayan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input required type="text" name="password" class="form-control" placeholder="password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php foreach ($users as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Users</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form" action="/pelayan_edit/<?= $value['id'] ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input required type="text" value=<?= $value['fullname'] ?> name="fullname" class="form-control" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input required type="text" value=<?= $value['username'] ?> name="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input required type="text" value=<?= $value['alamat'] ?> name="alamat" class="form-control" placeholder="Alamat">
                        </div>
                        <div class="form-group">
                            <label>NO telp</label>
                            <input required type="text" value=<?= $value['telepon'] ?> name="telepon" class="form-control" placeholder="NO telp">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input required type="email" value=<?= $value['email'] ?> name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select required class="form-control" name="role">
                                <option <?php if ($value['role'] == 0) { ?> selected <?php }  ?> value="0">Admin</option>
                                <option <?php if ($value['role'] == 1) { ?> selected <?php }  ?>value="1">pelayan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control" placeholder="KOSONGKAN BILA TIDAK DI EDIT">
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
                                        <i class="fa fa-plus"></i> <span>Tambah Users</span>
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
                                        Daftar Users
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">username</th>
                                                    <th scope="col">alamat</th>
                                                    <th scope="col">no telp</th>
                                                    <th scope="col">email</th>
                                                    <th scope="col">role</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($users as $key => $value) { ?>
                                                    <tr>
                                                        <th scope="row"><?= $key + 1 ?></th>
                                                        <td><?= $value['fullname'] ?></td>
                                                        <td><?= $value['username'] ?></td>
                                                        <td><?= $value['alamat'] ?></td>
                                                        <td><?= $value['telepon'] ?></td>
                                                        <td><?= $value['email'] ?></td>
                                                        <td><?php if ($value['role'] == 1) {
                                                                echo "pelayan";
                                                            } else {
                                                                echo "admin";
                                                            } ?></td>
                                                        <td><a data-toggle="modal" data-target="#edit<?= $value['id'] ?> " class="btn btn-warning btn-sm">
                                                                <i class="fa fa-pen"></i>
                                                            </a>
                                                            <a onclick="c()" href="/pelayan_hapus/<?= $value['id'] ?>" class="btn btn-danger btn-sm">
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