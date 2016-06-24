<link rel="stylesheet" type="text/css" href="css/assets/css/login.css">	


<div class="lgInPg">

<header>
	<img src="images/compostLOGOsm.png">
</header>

<div class="lgInPgin">
<div class="login-box">
    
    <div class="login-box-title red">Sign in to continue to UPT Compost</div>
    <div class="login-box-content">
    
     <form  method="post" action="valid_login.php" id="frmLogin" name="frmLogin" enctype="multipart/form-data">
       <div class="alartShowBx redAlrt" id="formErrorDiv" style="display: none;">
	    	<i class="fa fa-exclamation-triangle"></i>
		</div>
       <input type="text" name="username" id="username" placeholder="Your E-Mail..." value="" /> 
       
       <input type="password" name="password" id="password" placeholder="Your Password..." value="" /> 
       
	   <center>
       <input type="button" name="submit" class="inSumt22" id="submit" value="Sign in!" onclick="valid_login();" />
	   </center>
     
     </form>
     
     <!--<div class="half"><a href="forgotten-password.html">Forgot your password?</a></div>-->
     <div class="half last"></div>
    
    </div>
    
  </div>
  </div>
</div>