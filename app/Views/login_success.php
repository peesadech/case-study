
<?= $this->extend('home_layout'); ?>
<?= $this->section('content'); ?>

<!-- </section> -->
<script src="<?php echo base_url("jquery-3.5.1/jquery-3.5.1.slim.min.js");?>"></script>
<script src="<?php echo base_url("jquery-3.5.1/jquery.validate.js");?>"></script>
<script src="<?php echo base_url("jquery-3.5.1/additional-methods.min.js");?>"></script>
<div class="row ">
                        <!-- Bootstrap Validation -->
                        <div class="col-8  mx-auto mt-5">
                            <div class="card">
                                <div class="card-header">
                                    <span class="card-title " style="color:darkgreen;font-size:24px;">Login success will to go Dashboard</span>
                                </div>
                                <div class="card-body">
                                
                                    
                                </div>
                               
                            </div>
                        </div>
</div>

<script type="text/javascript">
    var urlDashboard= '<?= base_url(route_to('dashboard')); ?>';
     setTimeout(
        function(){
            window.location = urlDashboard
        },
    100);
 
</script>
<?= $this->endSection(); ?>