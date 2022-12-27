
<footer>
<p class="text-center mt-3">Copyright 2020 All Rights Reserved | Developed By <a href="http://www.neuralinfo.in/" target="_blank">Neural Info Solutions Pvt. Ltd.</a></p>
</footer>

<script src="<?php echo base_url('users/'); ?>assets/js/vendor-all.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/plugins/bootstrap.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/pcoded.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/menu-setting.min.js"></script>

<script src="<?php echo base_url('users/'); ?>assets/js/plugins/jquery.bootstrap.wizard.min.js"></script>

<script>
    $(document).ready(function() {
        $('#progresswizard').bootstrapWizard({
            withVisible: false,
            'nextSelector': '.button-next',
            'previousSelector': '.button-previous',
            'firstSelector': '.button-first',
            'lastSelector': '.button-last',
            onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index + 1;
                var $percent = ($current / $total) * 100;
                $('#progresswizard .progress-bar').css({
                    width: $percent + '%'
                });
            }
        });
        
    });
</script>

<script src="<?php echo base_url('users/'); ?>assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/plugins/dataTables.bootstrap4.min.js"></script>


<script src="<?php echo base_url('users/'); ?>assets/js/plugins/buttons.colVis.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/plugins/buttons.print.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/plugins/pdfmake.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/plugins/jszip.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/plugins/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/plugins/buttons.html5.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/plugins/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/pages/data-export-custom.js"></script>



<script src="<?php echo base_url('users/'); ?>assets/js/pages/data-source-custom.js"></script>

<script src="<?php echo base_url('users/'); ?>assets/js/plugins/moment.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/plugins/highcharts.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/plugins/highcharts-3d.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/pages/chart-highchart-custom.js"></script>

<script src="<?php echo base_url('users/'); ?>assets/js/plugins/daterangepicker.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/pages/ac-datepicker.js"></script>

<script src="<?php echo base_url('users/'); ?>assets/js/plugins/select2.full.min.js"></script>

<script src="<?php echo base_url('users/'); ?>assets/js/pages/form-select-custom.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/plugins/dropzone-amd-module.min.js"></script>

<!--<script src="<?php //echo base_url('users/'); ?>assets/js/plugins/apexcharts.min.js"></script>-->

<script src="<?php echo base_url('users/'); ?>assets/js/plugins/jquery.peity.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/plugins/jquery.knob.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/pages/jquery.knob-custom.min.js"></script>

<script src="<?php echo base_url('users/'); ?>assets/plugins/vendors/d3/d3.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/plugins/vendors/c3-master/c3.min.js"></script>

<!--<script src="<?php //echo base_url('users/'); ?>assets/plugins/vendors/sparkline/jquery.sparkline.min.js"></script>

<script src="<?php //echo base_url('users/'); ?>assets/plugins/vendors/raphael/raphael-min.js"></script>
<script src="<?php //echo base_url('users/'); ?>assets/plugins/vendors/morrisjs/morris.js"></script>

<script src="<?php //echo base_url('users/'); ?>assets/js/pages/dashboard-server.js"></script>-->
<script src="<?php echo base_url('users/'); ?>assets/js/my_js.js">
    
</script>
<script>
    $('#dob_caf').datepicker({
    //startView: 2,
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    autoclose: true,
    format: 'dd-mm-yyyy',
	 //maxViewMode: 0,
    });
</script>
<?php if(isset($userDetails[0]['gender'])){?>
    <script>
    $(document).ready(function(){
        gender = "<?php echo $userDetails[0]['gender']; ?>";
    });
        
    </script>
<?php } ?>

<script>
  $('#task').change(function(){
  	$('#filtercheck').submit();
  });
</script>

<script>
    $(document).on('click', '#submit_reason', function() {
   	var res=$('#mylist').val(); 
   	encoded_id=$('#encoded_id').val(); 
   	if(res!=""){
   		$.ajax({
           type:"Post",
           url:'<?php echo base_url()?>change-reject-status/'+encoded_id+'',
           data:{"reason":res},
           success:function(data){
           	  $("#myModal_reason").css("display","none");
          	 location.reload();
           },
           error:function(){
               alert("Somethings went wrong.");
           }
       });
   	}else{
   		alert('Please Enter a Reason.');
   	}
   });
</script>
<script>
 $(function () {
        $('select[name="showthis"]').hide();
        $('button[name="deactive"]').hide();

        //show it when the checkbox is clicked
        $('input[name="checkbox"]').on('click', function () {
            if ($(this).prop('checked')) {
                $('select[name="showthis"]').fadeIn();
                $('button[name="deactive"]').fadeIn();
            } else {
                $('select[name="showthis"]').hide();
                $('button[name="deactive"]').hide();
            }
        });
    });
	
</script>


<script>
$(document).ready(function(){
  $(document).on("change","#my_file",function(){
	 $("#profileImageForm").submit(); 
  });	
});
</script>

<script>
$(document).ready(function(e) {
 $(document).on('submit','#profileImageForm',function(e) {
	 //alert("check");
     e.preventDefault();
     $.ajax({
     url: "<?php echo base_url('uploadProfileImage'); ?>",
     type: "POST",           
     data: new FormData(this),
     contentType: false,       
     cache: false,           
     processData:false,       
     success: function(response){
		 if(response==1){
			    location.reload();
		  }
          else{
			  $("#result").html("unexpected , try again .");
		  }
        
		}
      });
 });
});
</script>

<script>
var maxLength = 40;
$('option').text(function(i, text) {
    if (text.length > maxLength) {
        return text.substr(0, maxLength) + '...';  
    }
});
</script>

<script>
    var count_ch=0;
    function count_ch(id)
    {
        count_ch++;
        var click_fun = "uncount_ch('"+id+"')";
        $('#'+id).removeAttr('onclick');
        $('#'+id).attr('onclick',click_fun);
        alert(count_ch);
    }
    function uncount_ch(id)
    {
        count_ch--;
        var click_fun = "count_ch('"+id+"')";
        $('#'+id).removeAttr('onclick');
        $('#'+id).attr('onclick',click_fun);
        alert(count_ch);
    }
    function check_submit()
    {
        if(count_ch>0)
        {

        }
        else{

        }
    }

$(document).ready(function(){
    $('.img11').change(function(){
        //alert('hskj');
        var value = $(this).val();
        if(value!='')
        {
            var _size = this.files[0].size;
            var final_size = (_size/1024)/1024;
            if(final_size<=1)
            {
                //alert(final_size);
            }
            else{
                $(this).val('');
                //alert(final_size);
            }
        }
        else{

        }
    });
</script>

</body>
</html>
