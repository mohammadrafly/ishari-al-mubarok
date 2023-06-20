<?= $this->extend('layout/authLayout') ?>

<?= $this->section('content') ?>
    <?= $this->include('layout/partials/authSignUp') ?>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url('js/SignUp.js') ?>"></script>
<script src="<?= base_url('js/Main.js') ?>"></script>
<?= $this->endSection() ?>