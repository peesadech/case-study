<?= $this->extend('home_layout'); ?>
<?= $this->section('content'); ?>
 <!-- BEGIN: Theme CSS-->
 <link rel="stylesheet" type="text/css" href="<?php echo base_url("app-assets/css/bootstrap.css");?>">
   
   
<div class="heroe" >
<div class="col-6">
<h1>Welcome to  <?php
        echo APP_PROJECT_NAME;
        ?></h1>

<h2>The small Case Study with powerful Best Case</h2>

</div>

</div>
<?= $this->endSection(); ?>