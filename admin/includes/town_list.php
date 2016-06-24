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

$Query = "SELECT * from town ORDER BY name DESC";
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
                <span>Towns</span>
              </div>
              <!-- Title Bar End -->
			  
              <!-- Content Start -->
              <div class="content">
                <table class="regular-table non-stripped">
                  <thead>
                    <th width="6%">#</th>
                	<th width="15%">Name</th>
                    <th width="14%">Status</th>
                    <th width="10%">Action</th>
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
			 ?>  
              <tr align="center" valign="top" bgcolor="#FFFFFF" class="bodytext">
                
                <td align="left"><?php echo $rs[$i]['id'];?></td>
                <td align="left"><?php echo $rs[$i]['name'];?></td>
                <td align="left"><?php echo $townStatus;?></td>
                <td align="left"><a href="index.php?p=add_edit_town&a=edit&id=<?=$rs[$i]['id'];?>">Edit</a></td>
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
