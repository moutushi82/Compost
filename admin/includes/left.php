
<style>
.regular-table tbody tr td:last-child {
    text-align: left;
}

.box-title.green {
    background-color: #6AA3C8;
}

.sidebar-user-profile .avatar {
    border: 3px solid #FFFFFF;
	}
	
	.main-menu li.active a, a:hover, .main-menu li.active a:hover, .main-menu li a:hover, .main-menu li ul.submenu li a:hover {
    color: #6AA3C8;
}


.h1_change{font-size:20px;}

.box-title.green {
    background-color: #909090 !important;
}
</style>

  <!-- Left Sidebar Start -->
  <div class="sidebar sidebar-left">

    <!-- Logo Start -->
    <div class="logo-container">
      
          <div class="lgoutt" >
			
			<a href="index.php?a=logout" title="Logout"><i class="fa fa-power-off"></i></a>
			<span class=""><?php echo "ADMIN"; ?></span>
			
		  </div>
        
    </div>
    <!-- Logo End -->
    
    <!-- User Profile Start -->
    <div class="sidebar-user-profile">
      
      <!--<div class="avatar">
        <img src="<?php echo 'images/logo.png' ?>" alt="Jane Doe" style="max-width:100%;"/>
      </div>
      
      <div class="ul-icons">
        
        
      </div>
	  -->
      
    </div>
    <!-- User Profile End -->

    <!-- Menu Start -->
    <ul class="main-menu">
       <li class='active'>
        <a href="index.php?p=order_details">
          <i class="fa fa-pencil-square-o"></i>
          <span>View Order</span>
        </a>
      </li>
      <li class='active'>
        <a href="index.php?p=town_list">
          <i class="fa fa-home"></i>
          <span>Town</span>
        </a>
        <ul class="submenu" <?php if($p =="add_edit_town"){echo 'style="display:block;"';}?>>
		  <li <?php if($p == "add_edit_town"){ echo 'class="active"';} ?>>
            <a href="index.php?p=add_edit_town&a=add">Add Town</a>
          </li>
        </ul>
      </li>
	</ul>
    <!-- Menu End -->

  </div>
  <!-- Left Sidebar End -->

 