<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 
   $this->load->view('common/header');
   $this->load->view('common/sidebar');
?>

    <div class="app-content content container-fluid">
    <div class="content-wrapper">
           <?php if(($this->session->flashdata('success'))){ ?>
        <div class="alert alert-success" id="successMessage">
        <strong> <?php echo $this->session->flashdata('success'); ?></strong> 
        </div>
      <?php } ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="pink"><?php echo Count($student);?></h3>
                                <span>Total Student</span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="icon-users pink font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="pink"><?php echo Count($inquiry);?></h3>
                                <span>Today Inquires</span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="icon-paper pink font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content-body"><!-- Basic Tables start -->
  
<!-- Table head options start -->
<div class="row">

    <div class="col-md-12">
     
       <?php //echo $this->session->flashdata('success');?>
    
      
       
   
            
    </div>
</div>
<!-- Table head options end -->



        </div>
      </div>

      
    </div>
<!---start Delete menu--->
<div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document" style="margin:20% auto;">
        <div class="modal-content">
            <div class="modal-body" >
                <p>Are you sure you want to delete this record?</p>
              </div>
              <div class="modal-footer text-center">
                <!--<button type="button" class="next_btn" id="yes_btn" name="update">Yes</button>-->
        <center><button type="button" class="btn-md btn-icon btn-link p4" id="yes_btn" ><a href="" id="deleteYes" value="Yes"  class="btn btn-success">Yes</a></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button></center>
            </div>
        </div>
    </div>
</div>
<!---End Delete menu--->
<?php 
$this->load->view('common/footer');
?>

<script>
$(function() { 
    setTimeout(function() {
  $('#successMessage').fadeOut('fast');
}, 3000);
   
});

function deletedata(id){  
   // alert(id);
    $('#myModal').modal('show')
   
        $('#yes_btn').click(function(){
           
                url="<?php echo base_url();?>"
                $.ajax({
                url: url+"/user/deletedata/",
                type: "post",
                data: {id:id} ,
                success: function (response) {  
                console.log(response);           
                //document.location.href = url+'user/userlist';                  

            },
            error: function(jqXHR, textStatus, errorThrown) {
                 console.log(textStatus, errorThrown);
            }
            })
           

        });
    
   

}
</script>

