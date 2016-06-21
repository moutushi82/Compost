<?php
function loadVariable($name,$default)
{
	if(isset($_REQUEST[$name]))
		return $_REQUEST[$name];
	else
		return $default;
}

function pr($arr,$e=1)
{
	if(is_array($arr))
	{
		echo "<pre>";
		print_r($arr);
		echo "</pre>";		
	}
	else
	{
		echo "<br>Not and array...<br>";
		echo "<pre>";
		var_dump($arr);
		echo "</pre>";
		
	}
	if($e==1)
	{
		exit();
	}
	else
	{
		echo "<br>";
	}
	
}


function inputEscapeString($str,$Type='DB',$htmlEntitiesEncode = true)
{
	if($Type === 'DB')
	{
		if(get_magic_quotes_gpc()===0)
		{
			$str = addslashes($str);
		}
	}
	elseif($Type === 'FILE')
	{
		if(get_magic_quotes_gpc()===1)
		{
			$str = stripslashes($str);	
		}
	}
	else
	{
		$str = $str;
	}
	
	if($htmlEntitiesEncode === true)
	{
		$str = htmlentities($str);
	}
	
	return $str;
}


function outputEscapeString($str,$Type = 'INPUT', $htmlEntitiesDecode = true )
{

	if(get_magic_quotes_runtime()==1)
	{
		$str = stripslashes($str);	
	}
	
	if($htmlEntitiesDecode === true)
	{
		$str = html_entity_decode($str);
	}
	
	if($Type == 'INPUT')
	{
		$str = htmlentities($str);
	}
	elseif($Type == 'TEXTAREA')
	{
		$str = $str;
	}
	elseif($Type == 'HTML')
	{
		$str = nl2br($str);
	}
	else
	{
		$str = $str;
	}
	
	return $str;
}



function loadFromSession($key,$var,&$ptr)
{
	global $p;
	if(isset($_REQUEST[$var]))
	{
		if($_REQUEST[$var]<>'')
		{
			return false;
		}
	}
	if(isset($_SESSION[$key][$p][$var]))
	{
		if($_SESSION[$key][$p][$var]<>'')
		{
			$ptr = $_SESSION[$key][$p][$var];
			return true;
		}
		else
			return false;
	}
	else
		return false;
}

/*function checkLogout()
{
	$a=loadVariable('a','');
	if($a=="logout")
	{
		$_SESSION[SUCCESS_MSG] = "";
		$pos = strpos($_SERVER['PHP_SELF'],'admin');
		if($pos)
		{
			if(isset($_SESSION[ADMIN_SESSION_VAR]))
			{
				$_SESSION[ADMIN_SESSION_VAR] = "";
				$_SESSION[ADMIN_TYPE] = "";
				unset($_SESSION[ADMIN_SESSION_VAR]);
				unset($_SESSION[ADMIN_TYPE]);
				$_SESSION[SUCCESS_MSG] = "You have successfully logged out...";
			}
		}
		else
		{
			if(isset($_SESSION[USER_SESSION_VAR]))
			{
				$_SESSION[USER_SESSION_VAR]="";
				unset($_SESSION[USER_SESSION_VAR]);
				$_SESSION[USER_TYPE] = "";
				$_SESSION[DSC_CODE] = "";
				unset($_SESSION[DSC_CODE]);
				unset($_SESSION[USER_TYPE]);
				
				$_SESSION[SUCCESS_MSG] = "You have successfully logged out...";
			}
		}
		
		
	}
}*/

function checkLogout()
{
	$a=loadVariable('a','');
	if($a=="logout")
	{
		$_SESSION[SUCCESS_MSG] = "";
		$pos = 0;
		if($_SERVER['HTTP_HOST'] == 'localhost' || strpos($_SERVER['HTTP_HOST'],'192.168.1.')===0)
		{
			$pos = strpos($_SERVER['PHP_SELF'],'admin');
		}
		else
		{
			$urlArr = array();
			$urlArr = explode('.',$_SERVER['HTTP_HOST']);
			
			if(strpos($_SERVER['PHP_SELF'],'admin')){
				$pos =1;
			}
		}
		//$pos = strpos($_SERVER['PHP_SELF'],'admin');
		if($pos)
		{
			if(isset($_SESSION[ADMIN_SESSION_VAR]))
			{
				$_SESSION[ADMIN_SESSION_VAR] = "";
				unset($_SESSION[ADMIN_SESSION_VAR]);
				$_SESSION['LIST_PAGR'] = "";
				unset($_SESSION['LIST_PAGE']);
				$_SESSION[SUCCESS_MSG] = "You have successfully logged out...";
			}
		}
		else
		{
			if(isset($_SESSION[USER_SESSION_VAR]))
			{
				$_SESSION[USER_SESSION_VAR]="";
				unset($_SESSION[USER_SESSION_VAR]);
				$_SESSION[SUCCESS_MSG] = "You have successfully logged out...";
			}
			
		}
		
		
	}
}

function showMessage()
{
	if(isset($_SESSION[SUCCESS_MSG]))
	{
		if($_SESSION[SUCCESS_MSG] <> "")
		{
			echo "<p><span style='color:#3D673D'><b>".$_SESSION[SUCCESS_MSG]."</b></span></p>";
			$_SESSION[SUCCESS_MSG] = "";
			return true;		
		}
	}

	if(isset($_SESSION[ERROR_MSG]))
	{
		if($_SESSION[ERROR_MSG] <> "")
		{
			echo "<p><span style='color:#9E1010'><b>".$_SESSION[ERROR_MSG]."</b></span></p>";
			$_SESSION[ERROR_MSG] = "";
			return true;		
		}
	}
	
	return false;
	
}

function securityCheck($p)
{
	$pos = 0;
	if($_SERVER['HTTP_HOST'] == 'localhost' || strpos($_SERVER['HTTP_HOST'],'192.168.1.')===0)
	{
		$pos = strpos($_SERVER['PHP_SELF'],'admin');
	}
	else
	{
		$urlArr = array();
		$urlArr = explode('.',$_SERVER['HTTP_HOST']);
		//pr($urlArr);
		/*if(in_array('admin',$urlArr))
		{
			//$pos = strpos($_SERVER['HTTP_HOST'],'admin');
			$pos = 1;
		}*/
		
		if(strpos($_SERVER['PHP_SELF'],'admin')){
			$pos =1;
		}
		
		//$pos =1;
	}
	//echo $pos; die();
	//$pos = strpos($_SERVER['PHP_SELF'],'admin');
	$path = '';
	
	//echo $pos
	$pageArray = array();
	if($pos)
	{
		$path = 'admin';
		
		$pageArray = explode(',',ADMIN_UNSECURED_PAGES);
	}
	else
	{
		$pageArray = explode(',',USER_UNSECURED_PAGES);
	}
	//echo $p;
	//pr($pageArray);
	if(in_array($p,$pageArray))
	{
		return $p;
	}
	else
	{
		if($pos)
		{
			if(isset($_SESSION[ADMIN_SESSION_VAR]))
			{
				return $p;
			}
			else
			{
				return 'login';
			}
		}
		else
		{
			if(isset($_SESSION[USER_SESSION_VAR]))
			{
				return $p;
			}
			else
			{
				return 'login';
			}
		}
		
	}
}

function fillCombo($table,$value,$text,$selected = '',$condition = '')
{
	global $objDB;
	
	$Query = "select ".$value.",".$text." from ".$table." ";
	if($condition <> '')
		$Query .= $condition;
	$Query .=" ORDER BY ".$text;
	
	$objDB->setQuery($Query);
	
	$rs = $objDB->select();
	
	$str = "";
	
	for($i=0;$i<count($rs);$i++)
	{
		$str .= "<option value=\"".$rs[$i][$value]."\" ";
		
			if(is_array($selected))
			{
				foreach($selected as $val)
				{
					if($val == $rs[$i][$value])
						$str .= " selected ";

				}
			}
			else
			{
				if($selected == $rs[$i][$value])
					$str .= " selected ";
			
			}
		$str .= ">".$rs[$i][$text]."</option>\n";
	}
	
	return $str;
}

function getImageExtension($filename) 
{ 
	$filename = strtolower($filename) ; 
	$exts = split("[/\\.]", $filename) ; 
	$n = count($exts)-1;
	$exts = $exts[$n]; 
	return $exts; 
} 

function getAudioExtension($filename) 
{ 
	$filename = strtolower($filename) ; 
	$exts = split("[/\\.]", $filename) ; 
	$n = count($exts)-1;
	$exts = $exts[$n]; 
	return $exts; 
} 

function thumbnail($filethumb,$file,$Twidth,$Theight,$tag)
{
	list($width,$height,$type,$attr)=getimagesize($file);
	switch($type)
	{
		case 1:
			$img = imagecreatefromgif($file);
		break;
		case 2:
			$img = imagecreatefromjpeg($file);
		break;
		case 3:
			$img = imagecreatefrompng($file);
		break;
	}
	if($tag == "width") //width contraint
	{
		$Theight=round(($height/$width)*$Twidth);
	}
	elseif($tag == "height") //height constraint
	{
		$Twidth=round(($width/$height)*$Theight);
	}
	else
	{
		if($width > $height)
			$Theight=round(($height/$width)*$Twidth);
		else
			$Twidth=round(($width/$height)*$Theight);
	}
	$thumb=imagecreatetruecolor($Twidth,$Theight);
	
	if(imagecopyresampled($thumb,$img,0,0,0,0,$Twidth,$Theight,$width,$height))
	{
		
		switch($type)
		{
			case 1:
				imagegif($thumb,$filethumb);
			break;
			case 2:
				imagejpeg($thumb,$filethumb);
			break;
			case 3:
				imagepng($thumb,$filethumb);
			break;
		}
		chmod($filethumb,0666);
		return true;
	}
}

//==================================   Site Specific Functions ===========================================


function getProductName($productId)
{
	global $objDB;
	$productName = "";
	
	$Query = "select product_name from `product_master` where product_id='".$productId."'";
	$objDB->setQuery($Query);
	$rs = $objDB->select();
	
	if(count($rs) == 1)
	{
		$productName=$rs[0]['product_name'];
	}
	return $productName;
}

function getMenuName($id)
{
	global $objDB;
	$val = '';
	$Query = "select menuName from menus WHERE id='".$id."' ";
	$objDB->setQuery($Query);
	$rsTotal = $objDB->select();
	
	if(count($rsTotal) == 1)
	{
		$val = $rsTotal[0]['menuName'];
	}
	return $val;
}

function getAssociateName($id)
{
	global $objDB;
	$name = "";
	
	$Query = "select name from registration where associate_id = '".$id."'";
	//echo $Query; die();
	$objDB->setQuery($Query);
	$rs = $objDB->select();
	
	if(count($rs) > 0)
	{
		$name = $rs[0]['name'];
	}
	return $name;
}

function getAssociateNamebyAutoID($id,&$data=array())
{
	global $objDB;
	$name = "";
	
	$Query = "select r.name,r.phone  from registration r where r.pin_no in ( select distinct bin_id from auto_tree at where at.pin_no= '".$id."')";
	$objDB->setQuery($Query);
	$rs = $objDB->select();

	$data['phone'] = "--";
	if(count($rs) > 0)
	{
		$name = $rs[0]['name'];
		$data['phone'] = $rs[0]['phone'];
	}
	return $name;
}

function getAssociateIdAutoId($id)
{
	global $objDB;
	$associateId = "";
	
	$Query = "select bin_id from auto_tree where pin_no = '".$id."'";
	$objDB->setQuery($Query);
	$rs = $objDB->select();
	
	if(count($rs) > 0)
	{
		$associateId = $rs[0]['bin_id'];
	}
	return $associateId;
}

function getAutoIdByAssoc($id)
{
	global $objDB;
	$associateId = "";
	
	$Query = "select pin_no from auto_tree where bin_id = '".$id."'";
	$objDB->setQuery($Query);
	$rs = $objDB->select();
	
	if(count($rs) > 0)
	{
		$associateId = $rs[0]['pin_no'];
	}
	return $associateId;
}

function getAllAutoID($id){
global $objDB;
	$Query="select pin_no from auto_tree where bin_id='".$id."'";
	$objDB->setQuery($Query);
	$rsPins = $objDB->select();
	$arrPins='';
	for($i=0;$i<count($rsPins);$i++){
		$arrPins .="'".$rsPins[$i]['pin_no']."',";
	}
	return rtrim($arrPins,",");
}

function getAssociateId($id)
{
	global $objDB;
	$associateId = "";
	
	$Query = "select pin_no from `registration` where reg_id = '".$id."'";
	$objDB->setQuery($Query);
	$rs = $objDB->select();
	
	if(count($rs) > 0)
	{
		$associateId = $rs[0]['pin_no'];
	}
	return $associateId;
}

function getAssociateAutoIncrementId($associateId)
{
	global $objDB;
	$id = "";
	
	$Query = "select reg_id from `registration` where pin_no = '".$associateId."'";
	$objDB->setQuery($Query);
	$rs = $objDB->select();
	
	if(count($rs) > 0)
	{
		$id = $rs[0]['reg_id'];
	}
	return $id;
}


function getDSCName($id)
{
	global $objDB;
	$name = '';
	
	$Query = "select name from dsc WHERE dsc_id = '".$id."'";
	$objDB->setQuery($Query);
	$rs = $objDB->select();
	
	if(count($rs) == 1)
	{
		$name = $rs[0]['name'];
	}
	return $name;
}

function isValidAssociateId($id)
{
	global $objDB;
	$isValidID = false;
	
	$Query = "select count(reg_id) as CNT from `registration` where pin_no = '".$id ."'";
	$objDB->setQuery($Query);
	$rs = $objDB->select();
		
	if($rs[0]['CNT'] == 1)
	{
		$isValidID = true;
	}
	
	return $isValidID;
}

function countTotalMember()
{
	global $objDB;
	$total = 0; 
	
	$Query = "select count(reg_id) as CNT from `registration` where pStatus = '1' ";
	$objDB->setQuery($Query);
	$rs = $objDB->select();
		
	if($rs[0]['CNT'] > 0)
	{
		$total = $rs[0]['CNT'];
	}
	
	return $total;
}

function getTotalSubCMS($id)
{
	global $objDB;
	$val = 0;
	$Query = "select count(id) as CNT from contents WHERE parentId='".$id."'";
	$objDB->setQuery($Query);
	$rsTotal = $objDB->select();
	if($rsTotal)
	{
		$val = $rsTotal[0]['CNT'];
	}
	
	return $val;
}

function getAssociateImage($id)
{
	global $objDB;
	$image = "";
	
	$Query = "select image from `registration` where pin_no = '".$id."'";
	$objDB->setQuery($Query);
	$rs = $objDB->select();
	
	if(count($rs) > 0)
	{
		$image = $rs[0]['image'];
	}
	return $image;
}

function getAssociateAddress($id)
{
	global $objDB;
	$address = "";
	
	$Query = "select address from `registration` where pin_no = '".$id."'";
	$objDB->setQuery($Query);
	$rs = $objDB->select();
	
	if(count($rs) > 0)
	{
		$address = $rs[0]['address'];
	}
	return $address;
}

//============================ Update User Left Right Count ====================================
function updateLeftRightCountAndCarryUptoRoot($pid,$position)
{

	global $objDB;

	if(strtoupper($position) == "LEFT")
	{
		$SQL =  "update registration set totalLeftCount = ( totalLeftCount + 1 ) ,  totalLeftCarry = ( totalLeftCarry + 1 ) 
				 where associate_id = '".$pid."' ";
		
	}
	elseif(strtoupper($position) == "RIGHT")
	{
		$SQL =  "update registration set totalRightCount = ( totalRightCount + 1 ) ,  totalRightCarry = ( totalRightCarry + 1 ) 					 				 where associate_id = '".$pid."' ";
	}

	//echo $position."----".$SQL."<br>";

	$objDB->setQuery($SQL);
	$objDB->update();

	//===============================================================	

	$query = "select associate_id,reference_id,position from registration  where associate_id = '".$pid."' ";
	$objDB->setQuery($query);
	$rs =$objDB->select();

	 //echo $query." <br><br>";
	if(isset($rs[0]) && count($rs) == 1 && $rs[0]['reference_id'] <> '0')
	{
		updateLeftRightCountAndCarryUptoRoot($rs[0]['reference_id'],$rs[0]['position']);
	}

}

//====================== Calcuate the level of the logged in user ======================
function getLevel($userId,&$childArr,$maxNode,&$level)
{
	global $objDB;
	
	$sql = "select 	associate_id from `registration` where reference_id in(".$userId .")";
	$objDB->setQuery($sql);

	$rs = $objDB->select();
	
	if(count($rs) == $maxNode)
	{
		$userId = '';
		$level = $level + 1;
		$maxNode = pow(2,$level);
		
		for($i=0; $i<count($rs); $i++)
		{
			$userId .= $rs[$i]['associate_id'].","; 
		}
		$userId = substr($userId,0,-1);
		$childArr = getLevel($userId,$childArr,$maxNode,$level);
	}
}

?>