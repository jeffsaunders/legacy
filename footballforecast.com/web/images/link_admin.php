<?php
session_start();
include_once('includes/config.inc.php');

//handle login
if(isset($_POST['login_id'])) {
	if(($_POST['login_id']==$link_admin_id)&&($_POST['password']==$link_admin_password)) {
		$_SESSION['admin']='login';
	}
	else {
		$_SESSION['admin']=false;
		unset($_SESSION['admin']);
	}
}

//handle logout
if(isset($_GET['logout'])) {
	$_SESSION['admin']=false;
	unset($_SESSION['admin']);
}

if(!isset($_SESSION['admin'])) {
	$content='
<form name="form1" method="post" action="link_admin.php">
  <table width="400" border="0" align="center" cellpadding="5" cellspacing="0" style="font-family: Arial; font-size: 10pt">
    <tr>
      <td>Login ID </td>
      <td width="5" align="center">:</td>
      <td><input name="login_id" type="text" id="login_id" size="25"></td>
    </tr>
    <tr>
      <td>Password</td>
      <td width="5" align="center">:</td>
      <td><input name="password" type="password" id="password" size="25"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td width="5" align="center">&nbsp;</td>
      <td><input type="submit" name="Submit" value="Login"></td>
    </tr>
  </table>
</form>';
}
else {
    if(!isset($_GET['action'])) {
        $_GET['action']='submitted_link';
    }
	switch ($_GET['action']) {
		case 'submitted_link': {
			$query="SELECT * FROM link WHERE active=0 ORDER BY id DESC";
			$result=mysql_query($query);
			if($result && mysql_num_rows($result)>0) {
				while ($data=mysql_fetch_array($result)) {
					$link_row.='
  <tr bgcolor="#FFFFFF">
    <td>'.$data['name'].'</td>
    <td>'.$data['url'].'</td>
    <td>'.$data['description'].'</td>
    <td>'.$data['admin'].'</td>
    <td>'.$data['email'].'</td>
    <td>'.$data['phone'].'</td>
    <td>'.$data['contact'].'</td>
    <td align="center"><a href="?action=edit_link&link_id='.$data['id'].'"><img src="images/edit.gif" border="0"></a></td>
    <td align="center"><a onClick="return confirm(\'Delete '.addslashes($data['name']).'?\');" href="?action=delete_link&link_id='.$data['id'].'"><img src="images/delete.gif" border="0"></a></td>
  </tr>
';					
				}
			}
			else {
				$link_row='<tr><td colspan="9" align="center" bgcolor="#FFFFFF" style="color: #FF0000;">No new link submitted</td></tr>';
			}
			$content='
<table width="100%"  border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC" style="font-family: Arial; font-size: 10pt">
  <tr align="center" bgcolor="#EEEEEE">
    <td><strong>Website Name </strong></td>
    <td><strong>URL</strong></td>
    <td><strong>Description</strong></td>
    <td><strong>Admin</strong></td>
    <td><strong>Email</strong></td>
    <td><strong>Phone</strong></td>
    <td><strong>Contact</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  '.$link_row.'
</table>
';			
			break;
		}
		case 'approved_link': {
			$query="SELECT link.*,category.name as category_name FROM link LEFT JOIN category ON link.category_id=category.id WHERE link.active=1 ORDER BY link.name ASC";
			$result=mysql_query($query);
			if($result && mysql_num_rows($result)>0) {
				while ($data=mysql_fetch_array($result)) {
					$link_row.='
  <tr bgcolor="#FFFFFF">
    <td>'.$data['name'].'</td>
    <td>'.$data['url'].'</td>
    <td>'.$data['category_name'].'</td>
    <td>'.$data['admin'].'</td>
    <td>'.$data['email'].'</td>
    <td align="center"><a href="?action=edit_link&link_id='.$data['id'].'"><img src="images/edit.gif" border="0"></a></td>
    <td align="center"><a onClick="return confirm(\'Delete '.addslashes($data['name']).'?\');" href="?action=delete_link&link_id='.$data['id'].'"><img src="images/delete.gif" border="0"></a></td>
  </tr>
';					
				}
			}
			else {
				$link_row='<tr><td colspan="7" align="center" bgcolor="#FFFFFF" style="color: #FF0000;">No approved links in database</td></tr>';
			}
			$content='
<table width="100%"  border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC" style="font-family: Arial; font-size: 10pt">
  <tr align="center" bgcolor="#EEEEEE">
    <td><strong>Website Name </strong></td>
    <td><strong>URL</strong></td>
    <td><strong>Category</strong></td>
    <td><strong>Admin</strong></td>
    <td><strong>Email</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  '.$link_row.'
</table>
';			
			break;
		}
		case 'edit_link': {
			if(isset($_POST['name'])) {
				$query="UPDATE link SET name='".$_POST['name']."', description='".$_POST['description']."',
				url='".$_POST['url']."', category_id='".$_POST['category_id']."', admin='".$_POST['admin_name']."',
				email='".$_POST['email']."', phone='".$_POST['phone']."', contact='".$_POST['contact']."', active='".$_POST['status']."' WHERE id='".$_GET['link_id']."'";
				$result=mysql_query($query);
				if (mysql_affected_rows()>0) {
					if($_POST['status']==1)	{
						header('Location: link_admin.php?action=approved_link');
						die();
					}
					else {
						header('Location: link_admin.php?action=submitted_link');
						die();
					}
				}
				else {
					$message='Unable to save link data. Please try again later';
				}
			}
			$query="SELECT * FROM link WHERE id='".$_GET['link_id']."'";
			$result=mysql_query($query);
			$data=mysql_fetch_array($result);
			$link_status[$data['active']]='selected';

			//get category list
			$query="SELECT * FROM category ORDER BY name ASC";
			$result=mysql_query($query);
			$category_list='<option value="0">Select Category</option>';
			if($result && mysql_num_rows($result)>0) {
			    while($data2=mysql_fetch_array($result)) {
			        if($data2['id']==$data['category_id']) {
			            $status='selected';
			        }
			        else {
			            $status='';
			        }
			        $category_list.='<option '.$status.' value="'.$data2['id'].'">'.$data2['name'].'</option>';
			    }
			}
			$content='
<form name="form1" method="post" action="?action=edit_link&link_id='.$_GET['link_id'].'">
<div align="center" style="color: #FF0000">'.$message.'</div>
  <table width="500" border="0" align="center" cellpadding="5" cellspacing="0" style="font-family: Arial; font-size: 10pt">
    <tr align="center">
      <td colspan="3"><strong>Edit Link </strong></td>
    </tr>
    <tr>
      <td>Website Name </td>
      <td width="5" align="center">:</td>
      <td><input name="name" type="text" id="name" size="35" value="'.$data['name'].'"></td>
    </tr>
    <tr>
      <td>URL</td>
      <td width="5" align="center">:</td>
      <td><input name="url" type="text" id="url" size="35" value="'.$data['url'].'"></td>
    </tr>
    <tr>
      <td>Site Description</td>
      <td align="center">:</td>
      <td><textarea name="description" cols="30" rows="3" id="description">'.$data['description'].'</textarea></td>
    </tr>
    <tr>
      <td>Category</td>
      <td align="center">:</td>
      <td><select name="category_id">
      '.$category_list.'
      </select></td>
    </tr>
    <tr>
      <td>Admin Name </td>
      <td width="5" align="center">:</td>
      <td><input name="admin_name" type="text" id="admin_name" size="30" value="'.$data['admin'].'"></td>
    </tr>
    <tr>
      <td>Email</td>
      <td width="5" align="center">:</td>
      <td><input name="email" type="text" id="email" size="30" value="'.$data['email'].'"></td>
    </tr>
    <tr>
      <td>Phone</td>
      <td width="5" align="center">:</td>
      <td><input name="phone" type="text" id="phone" size="30" value="'.$data['phone'].'"></td>
    </tr>
    <tr>
      <td>Best Time to Contact</td>
      <td width="5" align="center">:</td>
      <td><input name="contact" type="text" id="contact" size="30" value="'.$data['contact'].'"></td>
    </tr>
    <tr>
      <td>Link Status</td>
      <td align="center">:</td>
      <td>
      <select name="status">
      <option value="0" '.$link_status[0].'>Not Active</option>
      <option value="1" '.$link_status[1].'>Active</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td><input type="submit" name="Submit" value="Save Link"></td>
    </tr>
  </table>
</form>';
			break;
		}
		case 'category' : {
			if(isset($_POST['name'])) {
				if($_POST['id']>0) {
					$query="UPDATE category SET name='".$_POST['name']."', description='".$_POST['description']."' WHERE id='".$_POST['id']."'";
				}
				else {
					$query="INSERT INTO category SET name='".$_POST['name']."', description='".$_POST['description']."'";
				}
				mysql_query($query);
			}
			if(isset($_GET['id'])) {
				$title='Edit Category';
			}
			else {
				$title='Add Category';
			}
			$query="SELECT * FROM category ORDER BY name ASC";
			$result=mysql_query($query);
			if($result && mysql_num_rows($result)) {
				while ($data=mysql_fetch_array($result)) {
					$category_row.='
  <tr bgcolor="#FFFFFF">
    <td>'.$data['name'].'</td>
    <td width="50" align="center"><a href="?action=category&id='.$data['id'].'"><img src="images/edit.gif" border="0"></a></td>
    <td width="50" align="center"><a onclick="return confirm(\'Delete '.addslashes($data['name']).'?\');" href="?action=delete_category&id='.$data['id'].'"><img src="images/delete.gif" border="0"></a></td>
  </tr>
';
				}
			}
			else {
				$category_row='<tr bgcolor="#FFFFFF"><td colspan="3" align="center">No category</td></tr>';
			}
			
			if(isset($_GET['id'])) {
				$query="SELECT * FROM category WHERE id='".$_GET['id']."'";
				$result=mysql_query($query);
				$data=mysql_fetch_array($result);
			}
			else {
				$data=array();
			}
			$content='
<table width="500" border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC" style="font-family: Arial; font-size: 10pt">
  <tr bgcolor="#eeeeee">
    <td><strong>Category Name </strong></td>
    <td width="50">&nbsp;</td>
    <td width="50">&nbsp;</td>
  </tr>
  '.$category_row.'
</table>
<form name="form1" method="post" action="?action=category">
  <table width="500" border="0" cellspacing="1" cellpadding="5" style="font-family: Arial; font-size: 10pt">
    <tr>
      <td colspan="3" align="center"><strong>'.$title.'</strong></td>
    </tr>
    <tr>
      <td>Category Name </td>
      <td width="5" align="center">:</td>
      <td><input name="name" type="text" id="name" size="30" value="'.$data['name'].'"></td>
    </tr>
    <tr>
      <td>Description</td>
      <td width="5" align="center">:</td>
      <td><textarea name="description" cols="35" rows="4" id="description">'.$data['description'].'</textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td><input type="submit" name="Submit" value="Save Category">
      <input name="id" type="hidden" id="id" value="'.$_GET['id'].'"></td>
    </tr>
  </table>
</form>';
			break;
		}
		case 'delete_link' : {
			$query="DELETE FROM link WHERE id='".$_GET['link_id']."'";
			mysql_query($query);
			header('Location: '.$_SERVER['HTTP_REFERER']);
			die();
			break;
		}
		case 'delete_category': {
			$query="DELETE FROM category WHERE id='".$_GET['id']."'";
			mysql_query($query);
			header('Location: '.$_SERVER['HTTP_REFERER']);
			break;			
		}
		case 'add': {
		    //handle form submission
		    if(isset($_POST['name'])) {
		        $query="INSERT INTO link SET name='".$_POST['name']."', description='".$_POST['description']."',
                url='".$_POST['url']."', category_id='".$_POST['category_id']."', admin='".$_POST['admin_name']."',
                phone='".$_POST['phone']."', email='".$_POST['email']."', active='0'";
                mysql_query($query);
                header('Location: link_admin.php?action=submitted_link');
		    }
			//get category list
			$query="SELECT * FROM category ORDER BY name ASC";
			$result=mysql_query($query);
			$category_list='<option value="0">Select Category</option>';
			if($result && mysql_num_rows($result)>0) {
			    while($data2=mysql_fetch_array($result)) {
			        $category_list.='<option value="'.$data2['id'].'">'.$data2['name'].'</option>';
			    }
			}

		    $content='
<form name="form1" method="post" action="?action=add">
  <table width="500" border="0" align="center" cellpadding="5" cellspacing="0" style="font-family: Arial; font-size: 10pt">
    <tr align="center">
      <td colspan="3"><strong>Add New Link </strong></td>
    </tr>
    <tr>
      <td>Website Name </td>
      <td width="5" align="center">:</td>
      <td><input name="name" type="text" id="name" size="35"></td>
    </tr>
    <tr>
      <td>URL</td>
      <td width="5" align="center">:</td>
      <td><input name="url" type="text" id="url" size="35"></td>
    </tr>
    <tr>
      <td>Site Description</td>
      <td align="center">:</td>
      <td><textarea name="description" cols="30" rows="3" id="description"></textarea></td>
    </tr>
    <tr>
      <td>Category</td>
      <td align="center">:</td>
      <td><select name="category_id">
      '.$category_list.'
      </select></td>
    </tr>
    <tr>
      <td>Admin Name </td>
      <td width="5" align="center">:</td>
      <td><input name="admin_name" type="text" id="admin_name" size="30"></td>
    </tr>
    <tr>
      <td>Email</td>
      <td width="5" align="center">:</td>
      <td><input name="email" type="text" id="email" size="30"></td>
    </tr>
    <tr>
      <td>Phone</td>
      <td width="5" align="center">:</td>
      <td><input name="phone" type="text" id="phone" size="30"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td><input type="submit" name="Submit" value="Save Link"></td>
    </tr>
  </table>
</form>';
		}
	
	}
}
?>
<html>

<head>
<title>Dennis Tobler's Football Forecast Weekly</title>
<link href="css/style.css" type="text/css" rel="stylesheet">
</head>

<body>
<? include('header.php'); ?>


<table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor=#336600>
<tr>



<td width="180" align=center valign="top">
<img border="0" src="images/spacer_content.gif" width="180" height="1"><br>
<? include('tdleft.php'); ?>
</td>



<td bgcolor="#FFFFFF" align="left" valign="top" style="padding: 10px; font-family:Arial; font-size:10pt; font-weight:bold">
<table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#000000">
  <tr align="center" bgcolor="#9C0000">
    <td bgcolor="#800000" style="border:1px solid #C0C0C0; font-family: Arial; font-size: 8pt; font-weight: bold"><a href="?action=submitted_link" class="admin_menu">
	<font color="#FFFFFF">Submitted Links</font></a></td>
    <td bgcolor="#800000" style="border:1px solid #C0C0C0; font-family: Arial; font-size: 8pt; font-weight: bold"><a href="?action=approved_link" class="admin_menu">
	<font color="#FFFFFF">Approved Links</font></a></td>
    <td bgcolor="#800000" style="border:1px solid #C0C0C0; font-family: Arial; font-size: 8pt; font-weight: bold"><a href="?action=add" class="admin_menu">
	<font color="#FFFFFF">Add New Link</font></a></td>
    <td bgcolor="#800000" style="border:1px solid #C0C0C0; font-family: Arial; font-size: 8pt; font-weight: bold"><a href="?action=category" class="admin_menu">
	<font color="#FFFFFF">Category List</font></a></td>
    <td bgcolor="#800000" style="border:1px solid #C0C0C0; font-family: Arial; font-size: 8pt; font-weight: bold"><a href="?logout=1" class="admin_menu">
	<font color="#FFFFFF">Logout</font></a></td>
  </tr>
</table>
<br />
<?php echo $content; ?>
</td>



<td align="center" valign="top" width="180">
<img border="0" src="images/spacer_content.gif" width="180" height="1"><br>
<? include('tdright.php'); ?>
</td>




</tr>
</table>



<? include('footer.php'); ?>
</body>

</html>