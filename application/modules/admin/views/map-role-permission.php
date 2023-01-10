<style>
	ul,
	#myUL {
		list-style-type: none;
	}

	#myUL {
		margin: 0;
		padding: 0;
	}

	.caret {
		cursor: pointer;
		-webkit-user-select: none;
		/* Safari 3.1+ */
		-moz-user-select: none;
		/* Firefox 2+ */
		-ms-user-select: none;
		/* IE 10+ */
		user-select: none;
	}

	.caret::before {
		content: "\25B6";
		color: #f7b731;
		font-size: 20px;
		display: inline-block;
		margin-right: 6px;
	}

	.nested {
		display: none;
		margin-left: 33px;
	}

	.active {
		display: block;
	}
</style>
<div class="main-content app-content mt-0">
	<form autocomplete="off" method="post" action="" enctype="multipart/form-data" id="map_role_form">
		<div class="side-app">
			<!-- CONTAINER -->
			<div class="main-container container-fluid">
				<!-- PAGE-HEADER -->
				<div class="page-header">
					<div>
						<h1 class="page-title">
							Mapping Role & Permission</h1>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo base_url();?>admin-dashboard">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">
								Mapping Role & Permission</li>
						</ol>
					</div>
				</div>
				<?php
				if ($this->session->userdata('master_map_message')) {
				?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>
							Success!
						</strong>
						Mapping Permission Data Update.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php $this->session->unset_userdata('master_map_message');
				} ?>
				<div class="row">

					<div class="col-lg-6 col-md-6">

						<div class="">
							<div class="main-card mb-3 card">
								<div class="card-body">
									<h5 class="card-title">Mapping Role-Permission</h5>
									<?php $i = 1;
									$j = 1;
									$k = 3;
									$sub = 1;
									$sub_sub = 1;
									$mi = 1;
									$mj = 1;
									$mk = 1;
									foreach ($master_menu as $menu) { ?>
										<ul id="myUL">
											<li>
												<span class="caret">
													<input type="checkbox" value="<?php echo $menu['menu_id']; ?>" name="main_menu_id[]">
													<?php echo $menu['menu_description']; ?> </span>
												<ul class="nested">
													<?php $menuid = $menu['menu_id'];
													foreach ($master_sub_menu as $submenu) {
														if ($submenu['menu_id'] == $menuid) { ?>
															<li>
																<input type="checkbox" value="<?php echo $menuid . "$" . $submenu['sub_menu_id']; ?>" id="sub_menu_id
																<?php echo $i . "." . $sub; ?>" name="sub_menu_id[]" data-val="<?php echo $mi . '-' . $mj . '-' . $mk; ?>">
																<?php echo $submenu['sub_menu_description']; ?>
															</li>

													<?php }
													} ?>

												</ul>

											</li>

										</ul>

									<?php } ?>




								</div>
							</div>
						</div>

					</div>
					<div class="col-lg-6 col-md-6">
						<div class="">
							<div class="main-card mb-3 card">
								<div class="card-body">
									<h5 class="card-title">Mapping Role-Permission</h5>
									<ul id="myUL">
										<div class="form-group col-md-12 mb-3">
											<label class="form-label">Select Role:</label>
											<select class="form-control select2 form-select" data-placeholder="Select Status">
												<option label="Choose one">
												</option>
												<option value="">Select Role</option>

												<?php foreach ($master_role as $mr) { ?>

													<option value="<?php echo $mr['role_id']; ?>"><?php echo $mr['role_name']; ?></option>

												<?php } ?>

											</select>
										</div>
									</ul>
									<div class="col-md-6">
										<label>Choose Permissions:</label>
										<?php foreach ($master_permission as $mp) { ?>

											<div class="checkbox checkbox-primary checkbox-info" style="margin-left:20px">

												<input type="checkbox" value="<?php echo $mp['permission_id']; ?>" name="Permission[]"><label style="margin-left: 10px;"><?php echo $mp['permission_description']; ?></label>

											</div>

										<?php } ?>
									</div>
									<input type="submit" value="Submit" class="mt-1 btn btn-warning mt-3 pull-right" id="map_button" />
								</div>
							</div>
						</div>

					</div>

				</div>

	</form>
	<div class="row row-sm">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="">
						<div class="table-responsive ">
							<table id="example" class="display nowrap" style="width:100%">
								<thead>
									<tr class="bg-gray-light">
										<th>Sr.no</th>
										<th>Role Name</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1;
									foreach ($master_role as $mr) { ?>
										<tr>
											<td><?php echo $i++; ?></td>
											<td><?php echo $mr['role_name']; ?></td>
											<?php if ($mr['status'] == 1) { ?>
												<td><span class="badge bg-warning  me-1 mb-1 mt-1">Active</span></td>
											<?php } else { ?>
												<td><span class="badge bg-danger  me-1 mb-1 mt-1">Deactive</span></td>
											<?php } ?>
											<td><a href="<?php echo base_url() . 'edit-map-role-permission/' . rtrim(strtr(base64_encode($mr['role_id']), '+/', '-_'), '='); ?>"><i class="fa fa-edit"></i></a></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<!-- CONTAINER CLOSED -->

</div>
<script>
	var toggler = document.getElementsByClassName("caret");
	var i;
	for (i = 0; i < toggler.length; i++) {
		toggler[i].addEventListener("click", function() {
			this.parentElement.querySelector(".nested").classList.toggle("active");
			this.classList.toggle("caret-down");
		});
	}
	$(document).ready(function() {
		$("#map_button").click(function() {
			var url = "https://pravasibandhu.org/map-role-permission-form-save"; // the script where you handle the form input.
			$.ajax({
				type: "POST",
				url: url,
				data: $("#map_role_form").serialize(), // serializes the form's elements.
				success: function(data) {
					if (data == 0) {
						$('.alert').css('display', 'block');
						$('.alert').fadeIn().fadeOut(2000);
					}
					if (data == 1) {
						location.reload();
					}
				}
			});
			e.preventDefault(); // avoid to execute the actual submit of the form
		});
	});
</script>