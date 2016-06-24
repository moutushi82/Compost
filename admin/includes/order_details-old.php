<?php
if(!defined('__CONFIG__'))
{
	header("location:../index.php");
	die();
}

if(!isset($_SESSION[ADMIN_SESSION_VAR]))
{
	header("location: index.php?p=login");
	exit();
}

//=======================================================
/*$sql_user_id=mysqli_query($objDB->conn,"SELECT * FROM user WHERE email='".$_SESSION[USER_SESSION_VAR]."'");
$result_user_details=mysqli_fetch_assoc($sql_user_id);

$Query = "SELECT td.*, u.memberid FROM transaction_details td
		  LEFT JOIN user u ON u.id = td.user_id
		  WHERE td.transaction_type = 'deposit' AND td.user_id='".$result_user_details['id']."'";
$objDB->setQuery($Query);
$rs = $objDB->select();
*/

$Query = "SELECT * from order_details ORDER BY id DESC";
$objDB->setQuery($Query);
$rs = $objDB->select();

?>



<div class="content">
    <div class="main-container">
		<!-- start action -->
        <div class="container">
        <div class="row">

          <div class="col-lg-12">
            <!-- Box Start -->
            <div class="box">
				<div class="green">
				<?php 
					if(isset($_SESSION[SUCCESS_MSG]) && $_SESSION[SUCCESS_MSG] != ""){ ?>
						<div class="alartShowBx grnAlrt">
				        	<i class="fa fa-exclamation-triangle"></i><?php echo $_SESSION[SUCCESS_MSG]; ?> 
				    	</div>
					<?php	unset($_SESSION[SUCCESS_MSG]);
						$_SESSION[SUCCESS_MSG] = "";
					}
				?>
				</div>
              <!-- Title Bar Start -->
              <div class="box-title">
                <span>Order Details</span>
              </div>
              <!-- Title Bar End -->
			  
			  <style>
				@media (max-width: 360px) {
					.box > .scrBx {overflow: auto;}
				}
				.scrBx {}
			  </style>
			  
              <!-- Content Start -->
              <div class="content scrBx">
              	<?php
              		$currentMonth = date("n");
	  				$currentYear = date("Y");
	  				$loopCount = 5;
	  				$startYear = date("Y",strtotime("-".$loopCount." year"));
  				?>
              	<table class="regular-table non-stripped">
              		<tr>
              			<!--<td>
              				<select id="selMonth" name="selMonth">
              					<option value="">Select Month</option>
              					<option value="1" <?php if($currentMonth == 1) {?> selected <?php } ?> >January</option>
              					<option value="2" <?php if($currentMonth == 2) {?> selected <?php } ?> >February</option>
              					<option value="3" <?php if($currentMonth == 3) {?> selected <?php } ?> >March</option>
              					<option value="4" <?php if($currentMonth == 4) {?> selected <?php } ?> >April</option>
              					<option value="5" <?php if($currentMonth == 5) {?> selected <?php } ?> >May</option>
              					<option value="6" <?php if($currentMonth == 6) {?> selected <?php } ?> >June</option>
              					<option value="7" <?php if($currentMonth == 7) {?> selected <?php } ?> >July</option>
              					<option value="8" <?php if($currentMonth == 8) {?> selected <?php } ?> >August</option>
              					<option value="9" <?php if($currentMonth == 9) {?> selected <?php } ?> >September</option>
              					<option value="10" <?php if($currentMonth == 10) {?> selected <?php } ?> >October</option>
              					<option value="11" <?php if($currentMonth == 11) {?> selected <?php } ?> >November</option>
              					<option value="12" <?php if($currentMonth == 12) {?> selected <?php } ?> >December</option>
              				</select>
              			</td>-->
              			<td>
              				
              				<select id="selYear" name="selYear">
              					<option value="">Select Year</option>
              					<?php for($lp=0; $lp<=$loopCount; $lp++){ ?>
              						<option value="<?php echo date("Y",strtotime("-".$lp." year")); ?>"  <?php if($currentYear == date("Y",strtotime("-".$lp." year"))) {?> selected <?php } ?> ><?php echo date("Y",strtotime("-".$lp." year")); ?></option>
              					<?php } ?>
              				</select>
							&nbsp;&nbsp; <a href="javascript:void(0);" onclick="downloadOrderDetails('pdf');" target="_blank">PDF</a> | <a href="javascript:void(0);" onclick="downloadOrderDetails('xls');"  target="_blank">XLS</a>
              			</td>
              			<td>
							&nbsp;
						</td>
              		</tr>
              	</table>
              	<form name="downloadOrder" id="downloadOrder" action="" method="post" enctype="multipart/form-data" target="_blank">
              		<input type="hidden" name="month" id="month" value="0" />
              		<input type="hidden" name="year" id="year" value="0" />
              		<input type="hidden" name="doctype" id="doctype" value="" />
              	</form>
                <table class="regular-table non-stripped">
                  <thead>
                    <th width="6%">#</th>
                	<th width="15%">Name</th>
                	<th width="15%">Email</th>
                    <th width="14%">Company Name</th>
                    <th width="14%">Address</th>
                    <th width="14%">Yard Waste In</th>
                    <th width="14%">Compost Out</th>
                    <th width="14%">Date</th>
                  </thead>

                  <tbody>
				<?php
			 if($rs) {
				for($i=0;$i<count($rs);$i++)
				{
					$townStatus = "Active";
					
					if($rs[$i]['status'] == 2){
						$townStatus = "InActive";
					}
					
					$address = "";
					if($rs[$i]['housenumber'] != ""){
						$address .= $rs[$i]['housenumber'];
					}
					if($rs[$i]['streetname'] != ""){
						$address .= ",".$rs[$i]['streetname']."\n\r";
					}
					
					$townSql = "SELECT name FROM town WHERE id = '".$rs[$i]['town']."'";
					$objDB->setQuery($townSql);
					$town = $objDB->select();
					
					if($town[0]['name'] != ""){
						$address .= $town[0]['name'];
					}
					if($rs[$i]['state'] != ""){
						$address .= ",".$rs[$i]['state'];
					}
					
					$date = "";
					if($rs[$i]['date'] != ""){
						$date = $rs[$i]['date'];
					}
					
					
					
			 ?>  
              <tr align="center" valign="top" bgcolor="#FFFFFF" class="bodytext">
                
                <td align="left"><?php echo $rs[$i]['id'];?></td>
                <td align="left"><?php echo $rs[$i]['firstname']." ".$rs[$i]['lastname'];?></td>
                <td align="left"><?php echo $rs[$i]['email'];?></td>
                <td align="left"><?php echo $rs[$i]['companyname'];?></td>
                <td align="left"><?php echo $address;?></td>
                <td align="left"><?php echo $rs[$i]['yardwastein'];?></td>
                <td align="left"><?php echo $rs[$i]['compostout'];?></td>
                <td align="left"><?php echo date("m/d/Y", strtotime($date));?></td>
              </tr>
             <?php } } else { ?>
			 <tr align="center" valign="top" bgcolor="#FFFFFF" class="bodytext">
			 <td colspan="7">No Data Found</td>
			 </tr>
			 <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- Content End -->

            </div>
            <!-- Box End -->
          </div>
        </div>
		<!--end action-->
    </div>
  </div>
  </div>
<script>
	function downloadOrderDetails(doctype){
		$("#year").val( $("#selYear").val());
		$("#doctype").val(doctype);
              	
        if(doctype == 'pdf'){
        	$("#downloadOrder").attr('action', 'downloadPDF.php');
        	$('#downloadOrder').submit();
        } 
        else if(doctype == 'xls'){
        	$("#downloadOrder").attr('action', 'downloadXLS.php');
        	$('#downloadOrder').submit();
        }      		
	}
</script>