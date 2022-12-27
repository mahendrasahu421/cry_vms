<style>
table td{white-space:initial !important;}
.col-md-4 .card-header {
padding: 6px 25px !important;}
.col-md-3 .card-header {
padding: 6px 25px !important;}
.card .card-block, .card .card-body {
    padding: 1px 25px !important;
}
.col-md-1{
padding-left: 0px !important;
top:8px;}
</style>
<section class="pcoded-main-container">
<div class="pcoded-content">
<div class="page-header">
<div class="page-block">
<div class="row align-items-center">
<div class="col-md-12">
<div class="page-header-title">
<h5 class="m-b-10">Referal Link</h5>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard'; ?>"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item">Referal Link</li>
</ul>
</div>
</div>
</div>
</div>


<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-header">
<h5>Referal Link</h5>
</div><hr>

<div class="clearfix"></div>
<div class="card-body mb-4">
<h3 class="f-20 c-black" style="text-align:center;">Invite your friends to Volunteer<br> and earn a referral on each joining.</h3>
<center> <img src="<?php base_url();?>users/assets/images/referral-image.png" style="width:22%"; ></img></center><br>   
	<center><h4>Invite via social media link</h4></center>
	<center><a target="_blank" href="https://api.whatsapp.com/send?text=Share and Earn ,follow this link https://www.caritasindia.org/donate-test/<?php $name= $this->session->userdata('name_user'); echo strtoupper($name[0]).$this->session->userdata('userID')?>"><button class="btn btn-success  btn-sm mt-3 mb-4">WhatsApp</button></a>
	
	<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url();?>referral-register/<?php $name= explode(" ",$this->session->userdata('name_user')); echo strtoupper($name[0]).$this->session->userdata('userID')?>" target="_blank"><button class="btn btn-info btn-sm mt-3 mb-4">facebook</button></a>
	</center>
								
	
	<center><h4>OR</h4></center><br>
	<center><h4>More ways to invite your friends</h4></center><br>
	<div class="share-btn-ctr">
		  <input type="search" name="searchBy" id="copy-text" class="form-control" value="https://www.caritasindia.org/donate-test/<?php $name= $this->session->userdata('name_user'); echo strtoupper($name[0]).$this->session->userdata('userID')?>" readonly="">
		<button id="copyCodeBtn" class="btn  btn-primary btn-block form-control btn-send1 inv" onclick="myFunction()"> Copy Link</button>
	</div>
</div>
</div>
</div>

<!--<?php echo base_url();?>referral-register/-->
</div>
</div>
</section>

</div>

<script type="text/javascript">
    document.getElementById("copyCodeBtn").addEventListener("click", function() {
        copyToClipboardMsg(document.getElementById("copy-text"));
    });
	function copyToClipboardMsg(elem) {
        var succeed = copyToClipboard(elem);
        var msg;
        if (!succeed) {
            msg = "Copy not supported or blocked.  Press Ctrl+c to copy."
        } else {
            msg = "Text copied to the clipboard."
        }
    }
	function copyToClipboard(elem) {
        var targetId = "_hiddenCopyText_";
        var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
        var origSelectionStart, origSelectionEnd;
        if (isInput) {
            // can just use the original source element for the selection and copy
            target = elem;
            origSelectionStart = elem.selectionStart;
            origSelectionEnd = elem.selectionEnd;
        } else {
            // must use a temporary form element for the selection and copy
            target = document.getElementById(targetId);
            if (!target) {
                var target = document.createElement("textarea");
                target.style.position = "absolute";
                target.style.left = "50px";
                target.style.top = "0";
                target.id = targetId;
                document.body.appendChild(target);
            }
            target.textContent = elem.textContent;
        }
        // select the content
        var currentFocus = document.activeElement;
        target.focus();
        target.setSelectionRange(0, target.value.length);
        // copy the selection
        var succeed;
        try {
            succeed = document.execCommand("copy");
        } catch (e) {
            succeed = false;
        }
        // restore original focus
        if (currentFocus && typeof currentFocus.focus === "function") {
            currentFocus.focus();
        }
        if (isInput) {
            // restore prior selection
            elem.setSelectionRange(origSelectionStart, origSelectionEnd);
        } else {
            // clear temporary content
            target.textContent = "";
        } 
        //alert("Text Copied!");
		target.style.display = "none";
    }
	
	
    $("#btn-send1").click(function(){
        var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
        var u_email=$("#share-email-input").val();
            if (filter.test(u_email)) {
                jQuery.ajax({
			type:"POST",
			url:"<?php echo base_url()?>check-email-valid",
			data:{'USEREMAIL':u_email},                             
			success:function(dats){ 
											  
				if(dats==1){
				var link="<?php echo base_url();?>referral-register/<?php $name= $this->session->userdata('name_user'); echo strtoupper($name[0]).'-'.$this->session->userdata('userID')?>";
						$.ajax({
							method:"POST",
							data:{'email':u_email,"link":link},
							url:"<?php echo base_url() ?>send-referral-email",
							dataType:"json",
							success:function(result){
								if(result.status==1){
									$("#share-email-input").val('');
									$(".message").html("<span style='color:green';>Request Send Successfully.</span>");
								}else{
									$("#share-email-input").val('');
									$(".message").html("<span style='color:red';>User Already Exits.</span>");
									

								}
							},
							error:function(){
								alert("Something goes wrong");
							}
						});
				}else{
				   alert("Invalid email id");
				}                                           
			}
		});
		}else{
			alert("Please Enter Email Address");
		}
    });
</script>
