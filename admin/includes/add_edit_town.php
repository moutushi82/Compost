<?php
if (!isset($_SESSION[ADMIN_SESSION_VAR])) {
	header("location: index.php?p=login");
	exit();
}
$objDB = new DB();
?>

<div class="content">

	<div class="main-container">

		<div class="container">

			<div class="row">

				<div class="col-lg-12">

					<!-- Box Start -->
					<?php if(isset($_REQUEST['a']) && $_REQUEST['a'] == 'add') { ?>
					<div class="box">

						<!-- Title Bar Start -->

						<div class="box-title">

							<span>Add Town</span>

						</div>

						<!-- Title Bar End -->

						<!-- Content Start -->

						<div class="content">

							<form action="a_town_manager.php" class="basic-form inline-form" method="post" onsubmit="return validateDepositForm(this);">
								<input type="hidden" id="action" name="action" value="add">

								<div class="row">
									<div class="col-md-2">
										<label for="password">Town Name</label>
									</div>
									<div class="col-md-10">
										<input name="town_name" type="text" id="town_name" />
									</div>
								</div>

								<div class="row">
									<div class="col-md-10 col-md-offset-2">
										<!-- <input type="checkbox" name="checkbox" id="checkbox" value="1" class="icheck-blue" checked="checked"/> Check me out<br/>-->
										<input value="Add Town" type="submit" name="submit" class="btn btn-sm btn-success submitbutton" style="width:100px;"/>
										<span class="error_message"></span>
									</div>

								</div>

								<div class="clearfix"></div>

							</form>

						</div>

					</div>

					<?php } else if(isset($_REQUEST['a']) && $_REQUEST['a'] == 'edit') { 
						if(isset($_REQUEST['id']) && $_REQUEST['id'] != ""){
							$townId = $_REQUEST['id'];
							
							$selectQuery = "SELECT * FROM town WHERE id = ".$townId;
							$objDB->setQuery($selectQuery);
							$townDetails = $objDB->select();
					?>
					<div class="box">

						<!-- Title Bar Start -->

						<div class="box-title green">

							<span>Edit Town</span>

						</div>

						<!-- Title Bar End -->

						<!-- Content Start -->

						<div class="content">

							<form action="a_town_manager.php" class="basic-form inline-form" method="post" onsubmit="return validateDepositForm(this);">
								<input type="hidden" id="action" name="action" value="edit" />
								<input type="hidden" id="town_id" name="town_id" value="<?php echo $townId; ?>" />

								<div class="row">
									<div class="col-md-2">
										<label for="password">Town Name</label>
									</div>
									<div class="col-md-10">
										<input name="town_name" type="text" id="town_name" value="<?php echo $townDetails[0]['name']; ?>" />
									</div>
								</div>
								<div class="row">
									<div class="col-md-2">
										<label for="password">Status</label>
									</div>
									<div class="col-md-10">
										<input type="radio" name="town_status" value="1" <?php if($townDetails[0]['status'] == 1) { ?>checked="checked" <?php } ?>  />Active
										<input type="radio" name="town_status" value="2" <?php if($townDetails[0]['status'] == 2) { ?>checked="checked" <?php } ?> />In Active
									</div>
								</div>

								<div class="row">
									<div class="col-md-10 col-md-offset-2">
										<!-- <input type="checkbox" name="checkbox" id="checkbox" value="1" class="icheck-blue" checked="checked"/> Check me out<br/>-->
										<input value="Edit Town" type="submit" name="submit" class="btn btn-sm btn-success submitbutton" style="width:100px;"/>
										<span class="error_message"></span>
									</div>

								</div>

								<div class="clearfix"></div>

							</form>

						</div>

					</div>
			
							
						
					<?php } } else {
						header("location: index.php?p=town_list");
						exit();
					} ?>
				</div>

			</div>

		</div>
	</div>
</div>