<?= $this->extend('layout/homeLayout') ?>
<?= $this->section('content') ?>
    <?= $this->include('layout/partials/homeHero') ?>
        <main id="main">
            <?= $this->include('layout/partials/homeAbout') ?>
            <?= $this->include('layout/partials/homeGallery') ?>
            <?= $this->include('layout/partials/homePengurus') ?>
        </main>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url('js/SignOut.js') ?>"></script>
<?= $this->endSection() ?>