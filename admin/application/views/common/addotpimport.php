<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 
	 $this->load->view('common/header');
	 $this->load->view('common/sidebar');
?>
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        
      <div class="content-body"><!-- Basic form layout section start -->
<section id="basic-form-layouts">
	<div class="row match-height">
		<div class="col-md-12">
		<?php if(($this->session->flashdata('successmsg'))){ ?>
        <div class="alert alert-success" id="successMessage">
        <strong><?php echo $this->session->flashdata('successmsg'); ?></strong> 
        </div>
   		<?php } ?>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-form">Edit Profile 
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
				</div></h4>
				<div class="card-body collapse in">
					<div class="card-block">
						<form class="form" method="post" id="form_importdata" action="<?php echo base_url();?>home/importotp/" enctype="multipart/form-data">
							<div class="form-body">
								<h4 class="form-section"><i class="icon-clipboard4"></i>Requirements</h4>
								<div class="form-group">
									<label>Title</label>
									<input type="file" class="form-control" value="<?php //echo $PageTitle; ?>" placeholder="OTP FILE" name="otpfile" id="otpfile" onchange="readURL(this);">
									<span id="otperror"></span>
								</div>
								<hr>
                              <div class="form-group">								
									<input type="submit" class="btn btn-black" value="Update" name="btnupdate" minlength="2" maxlength="50">
								</div>
							</div>
								
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- // Basic form layout section end -->
    </div>
  </div>
</div>
<?php 
$this->load->view('common/footer');	
?>

<script>
$(function() { 
    setTimeout(function() {
  $('#successMessage').fadeOut('fast');
}, 3000);
   
});
$.validator.addMethod('filesize', function (value, element, param) {
	return this.optional(element) || (element.files[0].size <= param)
	} ,'File size must be equal to or less then 2MB');
$(document).ready(function()
{
	$("#form_importdata").validate(
	{
	rules: {	
			otpfile:{
					extension: "xls|xlsx",
					filesize: 2097152,   
			},
	},
	 errorPlacement: function (error, element) {
            console.log('dd', element.attr("name"))
            if (element.attr("name") == "otpfile") {
                error.appendTo("#otperror");
            } else{
                  error.insertAfter(element)
            }
        }

	});
});

function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah').css('display', 'block');
                    $('#blah').attr('src', e.target.result);
                };
             reader.readAsDataURL(input.files[0]);
            }
}
</script>