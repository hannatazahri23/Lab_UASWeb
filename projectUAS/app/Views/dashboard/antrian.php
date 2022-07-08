<?= $this->extend('_layouts/_layouts') ?>

<?= $this->section('content') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Halaman Penjaga</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="home">Home</a></li>
                    <li class="breadcrumb-item active">Antrian</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <h3 class="card-title">Antrian loket</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card text-center">
                                    <div class="card-header bg-primary">
                                        Loket <?php echo $own[0]['loket'] ?>
                                    </div>
                                    <div class="card-body">
                                        <h1 style=font-size:160px><?= $no ?></h1>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a id="play" class="btn btn-primary btn-block">
                                                    <i class="fa fa-plus"></i> <span>Panggil</span>
                                                </a>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="antrian_next/<?php echo $own[0]['id'] ?>" class="btn btn-primary btn-block">
                                                    <i class="fa fa-plus"></i> <span>Selanjutnya</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <?php foreach ($all as $key => $value) { ?>
                                        <div class="col-md-6">
                                            <div class="card text-center">
                                                <div class="card-header bg-primary">
                                                    Loket <?= $value['loket'] ?>
                                                </div>
                                                <div class="card-body">
                                                    <h1><?= $no_all[$key] ?></h1>
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

        </div>
    </div>
</section>
<audio id="suarabel" src="/audio/Bell.mp4"></audio>
<audio id="suarabelnomorurut" src="/audio/antrian/nomor-urut.wav"></audio>
<audio id="diloket" src="/audio/antrian/loket.wav"></audio>
<audio id="1" src="/audio/antrian/1.wav"></audio>
<audio id="2" src="/audio/antrian/2.wav"></audio>
<audio id="3" src="/audio/antrian/3.wav"></audio>
<audio id="4" src="/audio/antrian/4.wav"></audio>
<audio id="5" src="/audio/antrian/5.wav"></audio>
<audio id="6" src="/audio/antrian/6.wav"></audio>
<audio id="7" src="/audio/antrian/7.wav"></audio>
<audio id="8" src="/audio/antrian/8.wav"></audio>
<audio id="9" src="/audio/antrian/9.wav"></audio>
<audio id="10" src="/audio/antrian/sepuluh.wav"></audio>
<audio id="11" src="/audio/antrian/sebelas.wav"></audio>
<audio id="seratus" src="/audio/antrian/seratus.wav"></audio>
<audio id="belas" src="/audio/antrian/belas.wav"></audio>
<audio id="puluh" src="/audio/antrian/puluh.wav"></audio>
<audio id="ratus" src="/audio/antrian/ratus.wav"></audio>
<script>
    $('document').ready(function() {
        $('#play').click(function() {
            document.getElementById("suarabel").play();
            tw = document.getElementById("suarabel").duration * 1000;
            setTimeout(function() {
                document.getElementById("diloket").play();
            }, tw);
            tw = tw + 1500;
            setTimeout(function() {
                document.getElementById(<?= $own[0]['loket'] ?>).play();
            }, tw);
            tw = tw + 1500;
            setTimeout(function() {
                document.getElementById("suarabelnomorurut").play();
            }, tw);
            tw = tw + 1500;
            eja(<?= $no ?>, tw);

            function eja(no, tw) {
                if (no < 12) {
                    setTimeout(function() {
                        document.getElementById(no).play();
                    }, tw);
                    tw = tw + 1500;
                } else if (no < 20) {
                    eja(no % 10, tw)
                    tw = tw + 1500;
                    setTimeout(function() {
                        document.getElementById("belas").play();
                    }, tw);
                    tw = tw + 1500;
                } else if (no < 100) {
                    eja(parseInt(no / 10), tw)
                    tw = tw + 1500;
                    setTimeout(function() {
                        document.getElementById("puluh").play();
                    }, tw);
                    tw = tw + 1500;
                    eja(no % 10, tw)
                } else if (no < 200) {
                    setTimeout(function() {
                        document.getElementById("seratus").play();
                    }, tw);
                    tw = tw + 1500;
                    eja(no % 100, tw)
                    tw = tw + 1500;
                } else if (no < 1000) {
                    eja(parseInt(no / 100), tw)
                    tw = tw + 1500;
                    setTimeout(function() {
                        document.getElementById("ratus").play();
                    }, tw);
                    tw = tw + 1500;
                    eja(no % 100, tw)
                    tw = tw + 1500;
                }

            };



            // if(angka < 0 ){
            //     return "Negatif " + eja(-angka);
            // }else if ( angka < 12){
            //     return nolsebelas[angka];
            // }else if( angka < 20){
            //     return eja(angka % 10) + "belas";
            // }else if( angka < 100){
            //     return eja(angka / 10) + "puluh " + eja(angka % 10);
            // }else if( angka < 200){
            //     return "seratus " + eja(angka % 100 );
            // }else if( angka < 1000){
            //     return eja(angka / 100) + "ratus " + eja(angka % 100);
            // }else if( angka < 2000){
            //     return "seribu " + eja(angka % 1000);
            // }else if( angka < 10000){
            //     return eja(angka / 1000) + "ribu " + eja(angka % 1000);
            // }else{
            //     return "harus 4 digit sayang";
            // }
        });
    });
</script>
<?= $this->endSection() ?>

<?= $this->section('script') ?>

<?= $this->include('dashboard/script') ?>

<?= $this->endSection() ?>