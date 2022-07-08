<?= $this->extend('_layouts/_layouts') ?>
<?= $this->section('content') ?>

<?= $this->include('dashboard/_partials/breadcrumb/breadcrumb') ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <h3 class="card-title">Dashboard</h3>
                            </div>
                            <?php if (!session()->get('id')) { ?>
                                <div class="col-4">
                                    <div class="float-sm-right">
                                        <a href="/ambil_antrian" class="btn btn-primary btn-sm">
                                            <i class="fa fa-plus"></i> <span>Ambil Antrian</span>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md">
                                <div class="card text-center">
                                    <div class="card-header bg-primary">
                                        Panggilan Antrian
                                    </div>
                                    <div class="card-body">
                                        <h1 style=font-size:160px><?php if ($dipanggil[0]) {
                                                                        echo $dipanggil[0]['no_antrian'];
                                                                    } else {
                                                                        echo '-';
                                                                    } ?> </h1>
                                    </div>
                                    <div class="card-footer bg-primary">
                                        <?php if ($dipanggil[0]) {
                                            echo 'Loket ' . $dipanggil[0]['loket'];
                                        } else {
                                            echo '-';
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach ($loket as $key => $value) { ?>
                            <div class="col-md-3">
                                <div class="card text-center">
                                    <div class="card-header bg-primary">
                                        Loket <?= $value['loket'] ?>
                                    </div>
                                    <div class="card-body">
                                        <h1><?= $no_antrian[$key] ?></h1>
                                    </div>
                                    <div class="card-footer">
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>

    </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('script') ?>

<?= $this->include('dashboard/script') ?>

<?= $this->endSection() ?>