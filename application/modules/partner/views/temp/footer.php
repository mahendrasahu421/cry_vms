
<footer>
<p class="text-center mt-3">Copyright 2020 All Rights Reserved | Developed By <a href="http://www.neuralinfo.in/" target="_blank">Neural Info Solutions Pvt. Ltd.</a></p>
</footer>

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/js/vendor-all.min.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/js/plugins/bootstrap.min.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/js/pcoded.min.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/js/menu-setting.min.js"></script>

<script src="<?php echo base_url('admin/'); ?>assets/js/plugins/ckeditor.js"></script>
<script type="text/javascript">
    $(window).on('load', function() {
        ClassicEditor.create(document.querySelector('#classic-editor'))
            .catch(error => {
                console.error(error);
            });
    });
</script>
<script src="<?php echo base_url('admin/'); ?>assets/js/plugins/jquery.bootstrap.wizard.min.js"></script>
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

<script type="text/javascript">
    setTimeout(function() {
        $('#simpletable').DataTable();
    }, 600);
</script>




<script src="<?php echo base_url('admin/'); ?>assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/js/plugins/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/js/plugins/dataTables.colReorder.min.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/js/pages/data-reorder-custom.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/js/plugins/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/js/pages/data-responsive-custom.js"></script>


<script src="<?php echo base_url('admin/'); ?>assets/js/plugins/buttons.colVis.min.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/js/plugins/buttons.print.min.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/js/plugins/pdfmake.min.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/js/plugins/jszip.min.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/js/plugins/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/js/plugins/buttons.html5.min.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/js/plugins/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/js/pages/data-export-custom.js"></script>

<script src="<?php echo base_url('admin/'); ?>assets/js/plugins/select.bootstrap4.min.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/js/plugins/dataTables.select.min.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/js/pages/data-autofill-custom.js"></script>

<script src="<?php echo base_url('admin/'); ?>assets/js/pages/data-source-custom.js"></script>

<script src="<?php echo base_url('admin/'); ?>assets/js/plugins/moment.min.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/js/plugins/daterangepicker.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/js/pages/ac-datepicker.js"></script>

<script src="<?php echo base_url('admin/'); ?>assets/js/plugins/select2.full.min.js"></script>

<script src="<?php echo base_url('admin/'); ?>assets/js/pages/form-select-custom.js"></script>

<script src="<?php echo base_url('admin/'); ?>assets/js/plugins/apexcharts.min.js"></script>

<script src="<?php echo base_url('admin/'); ?>assets/js/plugins/jquery.peity.min.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/js/plugins/jquery.knob.min.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/js/pages/jquery.knob-custom.min.js"></script>

<script src="<?php echo base_url('admin/'); ?>assets/plugins/vendors/d3/d3.min.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/plugins/vendors/c3-master/c3.min.js"></script>

<script src="<?php echo base_url('admin/'); ?>assets/plugins/vendors/sparkline/jquery.sparkline.min.js"></script>

<script src="<?php echo base_url('admin/'); ?>assets/plugins/vendors/raphael/raphael-min.js"></script>
<script src="<?php echo base_url('admin/'); ?>assets/plugins/vendors/morrisjs/morris.js"></script>

<script src="<?php echo base_url('admin/'); ?>assets/js/pages/dashboard-server.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/bootstrap-datepicker.js"></script>

<script>
    $('.dob_caf').datepicker({
    //startView: 2,
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    autoclose: true,
    format: 'dd-mm-yyyy',
	 //maxViewMode: 0,
    });
</script>
<script>
// $(document).ready(function(){
// $('.img').change( function(event) {
//     var tmppath = URL.createObjectURL(event.target.files[0]);
//     var choose_img = '<img src="'+tmppath+'" width="100%">';
//     //$('#choose_image').html(choose_img);
//     var post_image1 = $(this).val();
//     //var url = $(this).attr('url');
//     //var post_type = $('[name="post_type"]').val();
//     var post_image2 = post_image1.split("\\");
//     var post_image = post_image2[2];
//     var fd = new FormData();
//     var files = $(this)[0].files[0];
//     // console.log(files);
//     fd.append('post_image',files);
//     alert(post_image);
//      $.ajax({
//             url: '<?php echo base_url();?>do-upload',
//             type: 'POST',
//             data:{post_image:fd},
//             cache:false,
//             success: function(response){
//                 alert(response);
//             },
//         });
//     console.log(files);
//     console.log(choose_img);
//     });
// });
//     $(document).ready(function(){
 
//         $('.img').change(function(e){
//             alert("Upload Image Successful.");
//             e.preventDefault(); 
//                 $.ajax({
//                     url:'<?php //echo base_url();?>do-upload',
//                     type:"post",
//                     data:new FormData('#form'),
//                     processData:false,
//                     contentType:false,
//                     cache:false,
//                     async:false,
//                     success: function(data){
//                         alert("Upload Image Successful.");
//                     }
//                 });
//             });
        

//         });

$(document).ready(function(){
    $('.img11').change(function(){
        alert('hskj');
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
    $('.show').click(function(){
        $(this).css('display','none');
        var id = $(this).attr('showid');
        $('#'+id).removeAttr('style');
        //alert(id);
    });
    $('.hide').click(function(){
        var showid = $(this).attr('showid');
        $('#'+showid).css('display','block');
        var id = $(this).attr('hideid');
        $('#'+id).css('display','none');
    });
    // $('#submit').click(function(){
    //     //alert('sja');
    //     //return false;
    //     //var valunteers = $('.volunteers').val();
    //     //console.log(valunteers);
    //     //alert('sja');

    //     var v = $('input[name="valunteers[]"]').val();
    //     console.log(v);
        

    //         // if($(this).is(":checked")){

    //         // console.log("Checkbox is checked.");

    //         // }

    //         // else if($(this).is(":not(:checked)")){

    //         // console.log("Checkbox is unchecked.");

    //         // }
    //     return false;
    // });
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
     url: "<?php echo base_url('uploadProfileImageForPartner'); ?>",
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
			  //$("#result").html("unexpected , try again .");
			  $("#result").html(response);
		  }
        
		}
      });
 });
 $(document).on('change','.profileImageFormForTask',function(e) {
	 //alert("check");
     e.preventDefault();
     $.ajax({
     url: "<?php echo base_url('uploadProfileImageForTask'); ?>",
     type: "POST",           
     data: new FormData(this),
     contentType: false,       
     cache: false,           
     processData:false,       
     success: function(response){
         console.log(response);
         alert(response);
         
		//  if(response==1){
		// 	    location.reload();
		//   }
        //   else{
		// 	  //$("#result").html("unexpected , try again .");
		// 	  $("#result").html(response);
		//   }
        
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
</body>

</html>
