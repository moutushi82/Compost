<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<title>UPT COMPOST</title>

		<meta name="HandheldFriendly" content="true">
		<meta name="viewport" content="width=device-width, initial-scale=0.666667, maximum-scale=0.666667, user-scalable=0">
		<meta name="viewport" content="width=device-width">

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

		<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script>
			$(function() {
				 var currentDate = new Date();
				$("#datepicker").datepicker({ 
					dateFormat: 'dd-mm-yy', 
					defaultDate: new Date()
				});
				$("#datepicker").datepicker("setDate", currentDate);
				//$("#datepicker").datepicker('setDate', new Date());
			});
		</script>
		<script src="js/custom.js"></script>
		<!-- Font-Awesome Icon -->
		<link href="font/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link rel="shortcut icon" href="favicon.ico" type="image/png">
		<!--title icon-->

		<link rel="stylesheet" href="css/chosen.css">
		<!--Form Style sheet-->
		<link href="css/style.css" rel="stylesheet" type="text/css" />

	</head>
	<body>

		<div class="imgBg">
			<header>
				<img src="images/compostLOGOsm.png" />
			</header>
