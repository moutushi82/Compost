<!doctype html>
<html class="fuelux" lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>UPT Compost</title>

  <link rel="stylesheet" type="text/css" href="css/assets/assets/bootstrap3/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="font/font-awesome-4.4.0/css/font-awesome.min.css">

  <!-- Google Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Lato:400,100italic,100,300italic,300,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
  <script src="css/assets/assets/jquery/tinymce/js/tinymce/tinymce.min.js"></script>
 <script>
 
    tinymce.init({
        selector: "textarea",
        statusbar: false,
		theme: "modern",
		setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        },
		plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
		
        
		
		});
   </script>
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->

  <!-- Theme Styles -->
  <link rel="stylesheet" type="text/css" href="css/assets/css/demo.css">
  <link rel="stylesheet" type="text/css" href="css/assets/css/styles.css">
  <link rel="stylesheet" type="text/css" href="css/assets/css/responsive.css">
  <link rel="stylesheet" type="text/css" href="css/assets/css/tables.css">
  <link rel="stylesheet" type="text/css" href="css/assets/assets/icheck/flat/_all.css">

  <!-- Google Maps -->
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
  

  <link rel="shortcut icon" href="favicon.ico" type="image/png">
  <link rel="shortcut icon" type="css/assets/image/png" href="favicon.ico" />

</head>

<body>

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
<?php  if(isset($_SESSION[ADMIN_SESSION_VAR])) { include_once("left.php"); } ?>
  <!-- Left Sidebar End -->

  <!-- Top Content Bar Start -->
  <div class="top-bar">
    <div class="main-container">
    <div class="container">
      <div class="row">

        <div class="col-lg-6 col-sm-6 hidden-xs">
          <ul class="left-icons icon-list">
            <li><a href="#" class="sidebar-collapse"><i class="fa fa-dedent"></i></a></li>
          </ul>
        </div>

        <div class="col-lg-6 col-sm-6">
          <ul class="right-icons icon-list">
          </ul>
        </div>

      </div>
    </div>
    </div>
  </div>
  <!-- Top Content Bar End -->