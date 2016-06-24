<?php //$objDB = new DB(); ?>
<div class="bluBx">
	<div class="whiteArea">
		<div class="forArea">
		<!------------------------------ Start Form HTML ---------------------->
		<div class="formBx">
    	<h1>Fill in Form for UPT Compost Site</h1>
        <form id="form1" name="form1" class="wufoo topLabel page1" accept-charset="UTF-8" autocomplete="on" enctype="multipart/form-data" method="post" action="a_manage_order.php" >
        	<input type="hidden" name="frmSubmit" id="frmSubmit" value="1" />
        	<?php if (isset($_SESSION[SUCCESS_MSG]) && $_SESSION[SUCCESS_MSG] != "") { ?>
		    	<div class="alartShowBx grnAlrt">
		        	<i class="fa fa-exclamation-triangle"></i><?php echo $_SESSION[SUCCESS_MSG]; ?> 
		    	</div>
			<?php unset($_SESSION[SUCCESS_MSG]); $_SESSION[SUCCESS_MSG] = "";
			} else if (isset($_SESSION[ERROR_MSG]) && $_SESSION[ERROR_MSG] != "") { ?>
				<div class="alartShowBx redAlrt">
		        	<i class="fa fa-exclamation-triangle"></i><?php echo $_SESSION[ERROR_MSG]; ?> 
		   		</div>
			<?php unset($_SESSION[ERROR_MSG]); $_SESSION[ERROR_MSG] = ""; } ?>
			<div class="alartShowBx redAlrt" id="formErrorDiv" style="display: none;">
	        	<i class="fa fa-exclamation-triangle"></i>
	   		</div>
	   		<div class="frmRw">
            	<div class="frmClmA">
			    <div class="inGroup">      
			        <input type="checkbox" id="existingCus" name="existingCus" class="" value="1" onclick="showCustomerIdBox();">Existing Customer
			        <label class="usedLvl2">Existing Customer</label>
			    </div>
                </div>
            </div>
            <div class="frmRw" id="customerIdDiv" style="display: none;">
            	<div class="frmClmA">
			   <div class="inGroup rqrIn">      
				        <input type="text" name="txtCustomerId" id="txtCustomerId" class="reqr" placeholder="" value="" onblur="showCustomerDetails(this.value);">
				        <span class="highlight"></span>
				        <span class="bar"></span>
				        <label>Customer Id</label>
				 </div>
			    <div class="alrtBx">
			        <span class=""></span>
			    </div>
                </div>
            </div>
        	<div class="frmRw">
            	<div class="frmClmA">
			    <div class="inGroup">      
			        <input type="text" id="datepicker" name="date" class="reqr" placeholder="MM/DD/YYYY" required="required" >
			        <span class="highlight"></span>
			        <span class="bar"></span>
			        <label class="usedLvl2">Date</label>
			    </div>
			    <div class="alrtBx">
			        <span class=""></span>
			    </div>
                </div>
            </div>
            <div class="frmRw">
            	<div class="frmClmA">
				    <div class="inGroup rqrIn">      
				        <input type="text" name="txtFirstname" id="txtFirstname" class="reqr" placeholder="">
				        <span class="highlight"></span>
				        <span class="bar"></span>
				        <label>First Name</label>
				    </div>
				    <div class="alrtBx">
				        <span class=""></span>
				    </div>
                </div>
                <div class="frmClmB">
				    <div class="inGroup rqrIn">      
				        <input type="text" name="txtLastname" id="txtLastname" class="reqr" placeholder="">
				        <span class="highlight"></span>
				        <span class="bar"></span>
				        <label>Last Name</label>
				    </div>
				    <div class="alrtBx">
				        <span class=""></span>
				    </div>
                </div>
            </div>
			<div class="frmRw">
			    <div class="frmClmA">
				    <div class="inGroup">      
				    	<input type="text" id="txtEmail" name="txtEmail" class="" placeholder="">
				    	<span class="highlight"></span>
				    	<span class="bar"></span>
				    	<label>Email</label>
				    </div>
				    <div class="alrtBx">
				    	<span class=""></span>
				    </div>
			    </div>
			</div> 
			<div class="frmRw">
			    <div class="frmClmA">
				    <div class="inGroup">      
				    	<input type="text" id="txtCompanyname" name="txtCompanyname" class="" placeholder="">
				    	<span class="highlight"></span>
				    	<span class="bar"></span>
				    	<label>Company Name (If applicable)</label>
				    </div>
				    <div class="alrtBx">
				    	<span class=""></span>
				    </div>
			    </div>
			</div> 
			<div class="frmRw">
			    <div class="frmClmA">
				    <div class="inGroup">      
				    	<input type="text" id="txtHousenumber" name="txtHousenumber" class="" placeholder="">
				    	<span class="highlight"></span>
				    	<span class="bar"></span>
				    	<label>House Number</label>
				    </div>
				    
				    <div class="alrtBx">
				    	<span class=""></span>
				    </div>
			    </div>
			</div> 
			
			<div class="frmRw">
			    <div class="frmClmA">
			    	<div class="inGroup">      
				    	<input type="text" name="txtStreetname" id="txtStreetname" class="" placeholder="">
				    	<span class="highlight"></span>
				    	<span class="bar"></span>
				    	<label>Street Name</label>
				    </div>
				    <div class="alrtBx">
				    	<span class=""></span>
				    </div>
			
			    </div>
			</div>
			      
			<?php
				$objDB = new DB();
				$townQuery = "SELECT * FROM town WHERE status = 1";
				$objDB->setQuery($townQuery);
				$townResult = $objDB->select();
			?>
			<div class="frmRw">
			    <div class="frmClmA">
				    <div class="inGroup rqrIn">      
						<select id="selTown" name="selTown" data-placeholder="Pick Name" class="dropdwn reqr mobdp" tabindex="9">
							<option value="">Pick Name</option>
							<?php
							if($townResult){
								foreach ($townResult as $town) { ?>
									<option value="<?php echo $town['id']; ?>" ><?php echo $town['name']; ?></option>
							<?php	}
										}
							?>
						</select>
				    	<span class="highlight"></span>
				    	<span class="bar"></span>
				    	<label class="usedLvl">Town</label>
				    </div>
				    <div class="alrtBx">
				    	<span class=""></span>
				    </div>            
				</div>
			</div>
			
			<div class="frmRw">
			    <div class="frmClmA">
			    <div class="inGroup rqrIn">      
					<select id="selWasteIn" name="selWasteIn" data-placeholder="Pick Amount" class="dropdwn mobdp reqr" tabindex="9">
			    		<option value="" selected="selected">PICK AMOUNT</option>
			    		<?php
							$yardWasteValue = 0.00;
							$incrementValue = 0.25;
							$limitValue = 40;
							$optionValue = 0;
							
							for($i=$yardWasteValue; $i<=$limitValue; $i++){ 
						?>
							<option value="<?php echo $yardWasteValue; ?>"><?php echo $yardWasteValue; ?></option>	
						<?php	$yardWasteValue = $yardWasteValue + $incrementValue; } ?>
					</select>	
			    	<span class="highlight"></span>
			    	<span class="bar"></span>
			    	<label class="usedLvl">Yard Waste IN (Cu Yds)</label>
			    </div>
			    <div class="alrtBx">
			    	<span class=""></span>
			    </div>            
			
				</div>
			</div>
			<?php //echo "OK9"; die(); ?> 
			<div class="frmRw">
			    <div class="frmClmA">
			    <div class="inGroup rqrIn">      
					<select id="selCompostOut" name="selCompostOut" data-placeholder="Pick Amount" class="dropdwn mobdp reqr" tabindex="9">
					    <option value="" selected="selected">PICK AMOUNT</option>
					    <?php
							$yardWasteValue = 0.00;
							$incrementValue = 0.25;
							$limitValue = 40;
							$optionValue = 0;
							
							for($i=$yardWasteValue; $i<=$limitValue; $i++){ 
						?>
							<option value="<?php echo $yardWasteValue; ?>"><?php echo $yardWasteValue; ?></option>	
						<?php $yardWasteValue = $yardWasteValue + $incrementValue;	} ?>
					</select>		
				    <span class="highlight"></span>
				    <span class="bar"></span>
				    <label class="usedLvl">Compost Out (Cu Yds)</label>
			    </div>
			    <div class="alrtBx">
			    	<span class=""></span>
			    </div>            
				</div>
			</div> 
		    <div class="frmRw">
		    	<div class="submBtn">
		        	<input type="button" id="orderSubmit" class="inSumt" value="Send" onclick="validateOrderForm();" />
		        </div>
		    </div>
    </form>
  </div><!--formBx-->
<!------------------------------ End Form HTML ---------------------->
</div>
</div><!--whiteArea-->
</div>
