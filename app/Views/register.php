
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
                                    <span class="card-title " style="color:darkgreen;font-size:24px;">Register</span>
                                </div>
                                <div class="card-body">
                                <form class="row g-1 needs-validation" id="form_register" action="<?php echo base_url(route_to('register_process'));?>" method="post" novalidate  >  
                                     <div class="row col-12 ">
                                       
                                        <?php //dd($fieldTitle,$update_obj); ?>
                                        <div class="row col-12 pt-1">
                                            <div class="col-6 ">
                                                <label for="txt_shop_name" class="form-label">E-mail</label>
                                                <div class="input-group has-validation">
                                                <!-- <input type="hidden" name="id" id="id" value="<?php //echo $update_obj['storeAdmin_id']; ?>"> -->
                                                    <input type="email" class="form-control" id="txt_login_username" name="txt_login_username" autocomplete="off" aria-describedby="inputGroupPrepend" value="<?php if(session()->getFlashdata("input_email")) {echo session()->getFlashdata("input_email"); } ?>" autocomplete="off"  required>
                                                    <div class="invalid-feedback">Enter Email</div>
                                                </div>
                                            </div>
                                            <?php 
                                             // if (empty($id_edit)) {
                                            ?>
                                            <div class="col-6">

                                               
                                                    <label for="txt_mobile" class="form-label"> Password</label>
                                                  
                                                    <div class="input-group has-validation" >
                                                        <input type="password" class="form-control" id="txt_login_password" name="txt_login_password" aria-describedby="inputGroupPrepend" value="<?php //echo isset($update_obj[$fieldTitle.'_password'])?$update_obj[$fieldTitle.'_password']:""; ?>"  autocomplete="off"  required>
                                                        <div class="invalid-feedback">Enter Password </div>
                                                    </div>
                                                   
                                            </div>
                                            <?php //} ?>
                                        </div>
                                        <div class="row col-12 pt-1">
                                        <div class="col-12 d-flex justify-content-center ">
                                        <button class="btn btn-success me-1"  id="register_button" >Register</button>
                                        <button class="btn btn-success me-1 d-none" type="submit" id="register_submit_button"  >submit</button>
                                        <button class="btn btn-outline-secondary " onclick="window.location.href='<?= base_url();?>'" id="back_button" >Home</button>
                                    </div>
                                        </div>
                                        
                                       
                                       
                                       
                                      
                    </form>
                        <?php if(session()->getFlashdata("error_message")) { ?>
                        <div id="flash-message" style="display: none;margin-top:50px" class="alert alert-danger">


                        <p class='flashMsg flashError'> <?php echo session()->getFlashdata("error_message");?></p>

                            <!-- Flash message content will be inserted here -->
                        </div>
                        <?php } ?>
                                </div>

                               
                            </div>
                        </div>
</div>

<script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
       
        });
    
</script>      
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
        var isRtl = $('html').attr('data-textdirection') === 'rtl';
        if ($('#flash-message').length) {
        // Get flash message content
        var flashMessage = $('#flash-message').text().trim();
        
        // Show flash message
            $('#flash-message').slideDown().delay(5000).slideUp(); // Adjust delay as needed
        }
        
        $("#register_button").click(function() {
        
      //  var urlLink  = '<?= base_url(route_to('register_process')); ?>';
        var urlLink  = '<?= base_url(route_to('admin.insert_time_frame')); ?>';
       // alert(urlLink);
        var form = $("#form_register")
        if (form[0].checkValidity() === false) {
            event.preventDefault()
            event.stopPropagation()
        } else {
           // alert($moduleName.'.insert_'.$itemName);
           $("#register_submit_button").click();
        //     var data = new FormData($('#form_register')[0]);
        //     $.ajax({
        //     type : 'POST',
        //     url  : urlLink,
            
        //     data : data,
        //  //   enctype: 'multipart/form-data',
        //     processData: false,
        //     contentType: false,
        //     success :  function(data)
        //         {
        //            // console.log(data);
        //             var jsonResponse = $.parseJSON(data);
        //                 if(jsonResponse.status)
        //                 {
        //                     //   $("#username_nav").innerHTML = jsonResponse.new_username;
        //                         toastr['success'](jsonResponse.title, jsonResponse.msg, {
        //                         showMethod: 'slideDown',
        //                         hideMethod: 'fadeOut',
        //                         positionClass: 'toast-bottom-center',
        //                         timeOut: 500,
        //                         rtl: isRtl,
        //                         onHidden: function() {
        //                            //  if (jsonResponse.type==='create') {location.reload();}else{window.location.href="<?= base_url(route_to('user.auth'));?>"; } 
        //                         }
        //                         });
        //                    // console.log('Success');
        //                 }else{
        //                    // console.log('Error');
        //                 }
        //         },
        //     error: function (data) {
        //             // console.log(data);
        //         }
        //     });
        }
        form.addClass('was-validated');

    });    
});
</script>
<?= $this->endSection(); ?>