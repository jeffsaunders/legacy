<?php
session_start();
include_once('includes/config.inc.php');
//handle login
if(isset($_POST['login_id'])) {
	if(($_POST['login_id']==$ffc_admin_id)&&($_POST['password']==$ffc_admin_password)) {
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
<form name="form1" method="post" action="ffc_admin.php">
  <table width="400" border="0" align="center" cellpadding="5" cellspacing="0" style="font: arial; font-size: 10pt; font-weight: bold;">
    <tr>
      <td align=rignt>Login ID </td>
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
	$_GET['action']='pick';
}
	switch ($_GET['action']) {
		case 'handicap': {
			if(isset($_POST['name'])) {
				if($_POST['id']>0) {
					if(is_file($_FILES['photo']['tmp_name']) && $_FILES['photo']['name']<>'') {
						if(move_uploaded_file($_FILES['photo']['tmp_name'],'images/handicapper/'.$_FILES['photo']['name'])) {
							//update handicap data
							$query="UPDATE handicap SET `date`=CURDATE(), name='".$_POST['name']."', 
							photo='images/handicapper/".$_FILES['photo']['name']."', week='".$_POST['week']."', description='".$_POST['description']."', 
							amount='".$_POST['amount']."' WHERE id='".$_POST['id']."'";
							mysql_query($query);
						}
						if(mysql_affected_rows()>0) {
							$message='Handicappers data updated';
						}
						else {
							$message='Unable to update handicap data, Please try again later.';
						}
					}
					else {
						//update handicap data
						$query="UPDATE handicap SET `date`=CURDATE(), name='".$_POST['name']."', 
						week='".$_POST['week']."', description='".$_POST['description']."', 
						amount='".$_POST['amount']."' WHERE id='".$_POST['id']."'";
						mysql_query($query);
						if(mysql_affected_rows()>0) {
							$message='Handicappers data updated';
						}
						else {
							$message='Unable to update handicap data, Please try again later.';
						}
					}
					
				}
				else {
					if(is_file($_FILES['photo']['tmp_name']) && $_FILES['photo']['name']<>'') {
						if(move_uploaded_file($_FILES['photo']['tmp_name'],'images/handicapper/'.$_FILES['photo']['name'])) {
							//insert new data
							$query="INSERT INTO handicap SET `date`=CURDATE(), name='".$_POST['name']."', photo='images/handcapper/".$_FILES['photo']['name']."', 
							week='".$_POST['week']."', description='".$_POST['description']."', amount='".$_POST['amount']."'";
							mysql_query($query);
							if(mysql_affected_rows()>0) {
								$message='New handicappers pick added into database';
							}
							else {
								$message='Unable to save handicappers pick into database';
							}
						}
						else {
						}
					}
				}
			}
			//set form title
			if(!isset($_GET['edit'])) {
				$form_title='Add New Handicappers Picks';
			}
			else {
				$form_title='Edit Handicappers Picks';
			}
			//get pick list
			$query="SELECT * FROM handicap ORDER BY `date` DESC";
			$result=mysql_query($query);
			if($result && mysql_num_rows($result)>0) {
				while ($data=mysql_fetch_array($result)) {
					$pick_list.='
  <tr bgcolor="#FFFFFF">
    <td>'.$data['date'].'</td>
    <td>'.$data['name'].'</td>
    <td>'.$data['photo'].'</td>
    <td align="center">'.$data['week'].'</td>
    <td align="center">$'.$data['amount'].'</td>
    <td width="50" align="center"><a title="Edit '.$data['title'].'" href="?action=handicap&edit='.$data['id'].'"><img src="images/edit.gif" border="0"></a></td>
    <td width="50" align="center"><a title="Delete '.$data['title'].'" onClick="return confirm(\'Delete '.addslashes($data['title']).'?\');" href="?action=handicap&delete='.$data['id'].'"><img src="images/delete.gif" border="0"></a></td>
  </tr>
';					
				}
				unset($data);
			}
			else {
				$pick_list='<tr><td align="center" style="color: #FF0000;" colspan="7" bgcolor="#FFFFFF">There\'s no handicap data in database</td></tr>';
			}
			
			if(isset($_GET['edit'])) {
				$query="SELECT * FROM handicap WHERE id='".$_GET['edit']."'";
				$result=mysql_query($query);
				$data=mysql_fetch_array($result);
			}
			else {
				$data['week']='99';
				$data['amount']='199';
			}

			$content='
<table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" style="font: arial; font-size: 10pt;">
  <tr bgcolor="#EEEEEE">
    <td align="center" width="75"><strong>Date</strong></td>
    <td align="center"><strong>Handicapper</strong></td>
    <td align="center"><strong>Photo</strong></td>
    <td align="center"><strong>Weekly Price</strong></td>
    <td align="center"><strong>Monthly Price</strong></td>
    <td width="50" align="center">&nbsp;</td>
    <td width="50" align="center">&nbsp;</td>
  </tr>
  '.$pick_list.'
</table>
<br /><hr>
<form action="?action=handicap" method="post" name="form1" enctype="multipart/form-data">
<div align="center" style="font: arial; font-size: 10pt; color: #FF0000; ">'.$message.'</div>
  <table width="500" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" align="center" style="font: arial; font-size: 10pt;">
    <tr align="center" bgcolor="#EEEEEE">
      <td colspan="2"><strong>'.$form_title.'</strong></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>Handicapper Name</td>
      <td><input name="name" type="text" id="name" size="30" value="'.$data['name'].'"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>Handicapper Photo</td>
      <td><input name="photo" type="file" size="45"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>Pick of The Week Price</td>
      <td>$ <input name="week" type="text" id="week" size="10" value="'.$data['week'].'"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>All Picks Price</td>
      <td>$ <input name="amount" type="text" id="amount" size="10" value="'.$data['amount'].'"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>Description</td>
      <td><textarea name="description" cols="35" rows="7" id="description">'.$data['description'].'</textarea></td>
    </tr>
    <tr bgcolor="#EEEEEE">
      <td>&nbsp;<input type="hidden" name="id" value="'.$_GET['edit'].'"></td>
      <td><input type="submit" name="Submit" value="Save Handicap"></td>
    </tr>
  </table>
</form>';
			break;
		}
		case 'pick': {
			//handle deletion
			if(isset($_GET['delete'])) {
				$query="DELETE FROM pick WHERE id='".$_GET['delete']."'";
				$result=mysql_query($query);
			}
			//handle form submission
			if(isset($_POST['title'])) {
				if($_POST['id']>0) {
					//update pick
					$query="UPDATE pick SET `date`=CURDATE(), title='".$_POST['title']."', 
					description='".$_POST['description']."', status='".$_POST['status']."', handicapper='".$_POST['handicapper']."', 
					competition='".$_POST['competition']."' WHERE id='".$_POST['id']."'";
					mysql_query($query);
					if(mysql_affected_rows()>0) {
						$message='Pick updated.';
					}
					else {
						$message='Unable to update pick into database. Please try again later.';
					}
				}
				else {
					//insert new pick
					$query="INSERT INTO pick SET `date`=CURDATE(), title='".$_POST['title']."', handicapper='".$_POST['handicapper']."', 
					description='".$_POST['description']."', status='".$_POST['status']."', competition='".$_POST['competition']."'";
					$result=mysql_query($query);
					if(mysql_affected_rows()>0) {
						$message='New pick saved into database';
					}
					else {
						$message='Unable to save new pick into database. Please try again later.';
					}
				}
			}
			
			//set form title
			if(!isset($_GET['edit'])) {
				$form_title='Add New Picks';
			}
			else {
				$form_title='Edit Picks';
			}
			//get pick list
			$query="SELECT pick.*,handicap.name as handicapper_name FROM pick LEFT JOIN handicap ON handicap.id=pick.handicapper WHERE pick.status='paid' ORDER BY `date` DESC";
			$result=mysql_query($query);
			if($result && mysql_num_rows($result)>0) {
				while ($data=mysql_fetch_array($result)) {
					$pick_list.='
  <tr bgcolor="#FFFFFF">
    <td>'.$data['date'].'</td>
    <td>'.$data['competition'].'</td>
    <td>'.$data['handicapper_name'].'</td>
    <td>'.$data['title'].'</td>
    <td align="center">'.$data['status'].'</td>
    <td width="50" align="center"><a title="Edit '.$data['title'].'" href="?action=pick&edit='.$data['id'].'"><img src="images/edit.gif" border="0"></a></td>
    <td width="50" align="center"><a title="Delete '.$data['title'].'" onClick="return confirm(\'Delete '.addslashes($data['title']).'?\');" href="?action=pick&delete='.$data['id'].'"><img src="images/delete.gif" border="0"></a></td>
  </tr>
';					
				}
				unset($data);
			}
			else {
				$pick_list='<tr><td align="center" style="color: #FF0000;" colspan="7" bgcolor="#FFFFFF">There\'s no pick in database</td></tr>';
			}
			
			//edit pick
			if($_GET['edit']>0) {
				$query="SELECT * FROM pick WHERE id='".$_GET['edit']."'";
				$result=mysql_query($query);
				$data=mysql_fetch_array($result);
				$status[$data['status']]='selected';
			}
			
			//get handicappers list
			$query="SELECT * FROM handicap ORDER BY name ASC";
			$result=mysql_query($query);
			$handicapper_list='<option value="0">Select Handicapper</option>';
			if($result && mysql_num_rows($result)>0) {
				while ($handicapper=mysql_fetch_array($result)) {
					if($handicapper['id']==$data['handicapper']) {
						$status='selected';
					}
					else {
						$status='';
					}
					$handicapper_list.='<option value="'.$handicapper['id'].'" '.$status.'>'.$handicapper['name'].'</option>';					
				}
			}

			$content='
<table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" style="font: arial; font-size: 10pt;">
  <tr bgcolor="#EEEEEE">
    <td align="center" width="75"><strong>Date</strong></td>
    <td align="center"><strong>Competition</strong></td>
    <td align="center"><strong>Handicapper</strong></td>
    <td align="center"><strong>Pick</strong></td>
    <td width="75" align="center"><strong>Status</strong></td>
    <td width="50" align="center">&nbsp;</td>
    <td width="50" align="center">&nbsp;</td>
  </tr>
  '.$pick_list.'
</table>
<br /><hr>
<form action="?action=pick" method="post" name="form1">
<div align="center" style="font: arial; font-size: 10pt; color: #FF0000;">'.$message.'</div>
  <table width="500" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" align="center" style="font: arial; font-size: 10pt;">
    <tr align="center" bgcolor="#EEEEEE">
      <td colspan="2"><strong>'.$form_title.'</strong></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>Pick</td>
      <td><input name="title" type="text" id="title" size="45" value="'.$data['title'].'"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>Competition</td>
      <td><select name="competition" id="competition">
        <option value="College" '.$status['College'].'>College</option>
        <option value="NFL" '.$status['NFL'].'>NFL</option>
      </select></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>Handicapper</td>
      <td><select name="handicapper" id="handicapper">
      '.$handicapper_list.'
      </select>
      <input type="hidden" name="status" value="paid">
      </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>Description</td>
      <td><textarea name="description" cols="35" rows="7" id="description">'.$data['description'].'</textarea></td>
    </tr>
    <tr bgcolor="#EEEEEE">
      <td>&nbsp;<input type="hidden" name="id" value="'.$_GET['edit'].'"></td>
      <td><input type="submit" name="Submit" value="Save Pick"></td>
    </tr>
  </table>
</form>';
			break;
		}
		case 'free_pick': {
			//handle deletion
			if(isset($_GET['delete'])) {
				$query="DELETE FROM pick WHERE id='".$_GET['delete']."'";
				$result=mysql_query($query);
			}
			//handle form submission
			if(isset($_POST['title'])) {
				if($_POST['id']>0) {
					//update pick
					$query="UPDATE pick SET `date`=CURDATE(), title='".$_POST['title']."', 
					description='".$_POST['description']."', status='".$_POST['status']."', handicapper='".$_POST['handicapper']."', 
					competition='".$_POST['competition']."' WHERE id='".$_POST['id']."'";
					mysql_query($query);
					if(mysql_affected_rows()>0) {
						$message='Pick updated.';
					}
					else {
						$message='Unable to update pick into database. Please try again later.';
					}
				}
				else {
					//insert new pick
					$query="INSERT INTO pick SET `date`=CURDATE(), title='".$_POST['title']."', handicapper='".$_POST['handicapper']."', 
					description='".$_POST['description']."', status='".$_POST['status']."', competition='".$_POST['competition']."'";
					$result=mysql_query($query);
					if(mysql_affected_rows()>0) {
						$message='New pick saved into database';
					}
					else {
						$message='Unable to save new pick into database. Please try again later.';
					}
				}
			}
			
			//set form title
			if(!isset($_GET['edit'])) {
				$form_title='Add New Picks';
			}
			else {
				$form_title='Edit Picks';
			}
			//get pick list
			$query="SELECT pick.* FROM pick WHERE status='free' ORDER BY `date` DESC";
			$result=mysql_query($query);
			if($result && mysql_num_rows($result)>0) {
				while ($data=mysql_fetch_array($result)) {
					$pick_list.='
  <tr bgcolor="#FFFFFF">
    <td>'.$data['date'].'</td>
    <td>'.$data['competition'].'</td>
    <td>'.$data['title'].'</td>
    <td align="center">'.$data['status'].'</td>
    <td width="50" align="center"><a title="Edit '.$data['title'].'" href="?action=free_pick&edit='.$data['id'].'"><img src="images/edit.gif" border="0"></a></td>
    <td width="50" align="center"><a title="Delete '.$data['title'].'" onClick="return confirm(\'Delete '.addslashes($data['title']).'?\');" href="?action=free_pick&delete='.$data['id'].'"><img src="images/delete.gif" border="0"></a></td>
  </tr>
';					
				}
				unset($data);
			}
			else {
				$pick_list='<tr><td align="center" style="color: #FF0000;" colspan="6" bgcolor="#FFFFFF">There\'s no pick in database</td></tr>';
			}
			
			//edit pick
			if($_GET['edit']>0) {
				$query="SELECT * FROM pick WHERE id='".$_GET['edit']."'";
				$result=mysql_query($query);
				$data=mysql_fetch_array($result);
				$status[$data['status']]='selected';
			}
			
			$content='
<table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" style="font: arial; font-size: 10pt;">
  <tr bgcolor="#EEEEEE">
    <td align="center" width="75"><strong>Date</strong></td>
    <td align="center"><strong>Competition</strong></td>
    <td align="center"><strong>Pick</strong></td>
    <td width="75" align="center"><strong>Status</strong></td>
    <td width="50" align="center">&nbsp;</td>
    <td width="50" align="center">&nbsp;</td>
  </tr>
  '.$pick_list.'
</table>
<br /><hr>
<form action="?action=free_pick" method="post" name="form1">
<div align="center" style="font: arial; font-size: 10pt; color: #FF0000;">'.$message.'</div>
  <table width="500" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" align="center" style="font: arial; font-size: 10pt;">
    <tr align="center" bgcolor="#EEEEEE">
      <td colspan="2"><strong>'.$form_title.'</strong></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>Pick</td>
      <td><input name="title" type="text" id="title" size="45" value="'.$data['title'].'"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>Competition</td>
      <td><select name="competition" id="competition">
        <option value="College" '.$status['College'].'>College</option>
        <option value="NFL" '.$status['NFL'].'>NFL</option>
      </select>
      <input type="hidden" name="status" value="free">
      </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>Description</td>
      <td><textarea name="description" cols="35" rows="7" id="description">'.$data['description'].'</textarea></td>
    </tr>
    <tr bgcolor="#EEEEEE">
      <td>&nbsp;<input type="hidden" name="id" value="'.$_GET['edit'].'"></td>
      <td><input type="submit" name="Submit" value="Save Pick"></td>
    </tr>
  </table>
</form>';
			break;
		}
		case 'video': {
			//handle file deletion
			if(isset($_GET['delete'])) {
				$query="DELETE FROM movie WHERE id='".$_GET['delete']."'";
				mysql_query($query);
			}
			//handle file upload
			if(isset($_POST['title'])) {
				if((int)$_POST['id']>0) {
					//update movie
					if(is_file($_FILES['movie']['tmp_name']) && $_FILES['movie']['name']<>'') {
						if(@move_uploaded_file($_FILES['movie']['tmp_name'],'multimedia/'.$_FILES['movie']['name'])) {
							$query="UPDATE movie SET title='".$_POST['title']."', description='".$_POST['description']."', 
							status='".$_POST['status']."', movie='multimedia/".$_FILES['movie']['name']."' WHERE id='".$_POST['id']."'";
							mysql_query($query);							
							if(mysql_affected_rows()>0) {
								$message='Video data updated';
							}
							else {
								$message='Unable to save video to database. Please try again later';
							}
						}
						else {
							$message='Unable to upload file. Please try again later';
						}
					}
					else {
						$query="UPDATE movie SET title='".$_POST['title']."', description='".$_POST['description']."', 
						status='".$_POST['status']."' WHERE id='".$_POST['id']."'";
						mysql_query($query);
						if(mysql_affected_rows()>0) {
							$message='Video data updated';
						}
						else {
							$message='Unable to save video to database. Please try again later';
						}
					}
				}
				else {
					//insert new movie
					//move uploaded file
					if(@move_uploaded_file($_FILES['movie']['tmp_name'],'multimedia/'.$_FILES['movie']['name'])) {
						$query="INSERT INTO movie SET title='".$_POST['title']."', description='".$_POST['description']."', 
						movie='multimedia/".$_FILES['movie']['name']."', status='".$_POST['status']."'";
						mysql_query($query);
						if(mysql_affected_rows()>0) {
							$message='New video uploaded and added to database';
						}
						else {
							$message='Unable to save video to database. Please try again later';
						}
					}
					else {
						$message='Unable to upload file. Please try again later';
					}
				}
			}
			
			if(!isset($_GET['edit'])) {
				$form_title='Upload New Video';
			}
			else {
				$form_title='Edit Video Data';
			}
			
			//get movie list
			$query="SELECT * FROM movie ORDER BY id DESC";
			$result=mysql_query($query);
			if($result && mysql_num_rows($result)>0) {
				while ($data=mysql_fetch_array($result)) {
					$movie_list.='
  <tr bgcolor="#FFFFFF">
    <td>'.$data['title'].'</td>
    <td>'.$data['movie'].'</td>
    <td align="center">'.$data['status'].'</td>
    <td width="50" align="center"><a title="Edit '.$data['title'].'" href="?action=video&edit='.$data['id'].'"><img src="images/edit.gif" border="0"></a></td>
    <td width="50" align="center"><a title="Delete '.$data['title'].'" onClick="return confirm(\'Delete '.addslashes($data['title']).'?\');" href="?action=video&delete='.$data['id'].'"><img src="images/delete.gif" border="0"></a></td>
  </tr>
';					
				}
			}
			else {
				$movie_list='<tr><td align="center" style="color: #FF0000;" colspan="5" bgcolor="#FFFFFF">There\'s no movie in database</td></tr>';
			}
			
			//seed variable for edit
			if(isset($_GET['edit']) && $_GET['edit']>0) {
				$query="SELECT * FROM movie WHERE id='".$_GET['edit']."'";
				$result=mysql_query($query);
				$data=mysql_fetch_array($result);
				$status[$data['status']]='selected';
			}
			
			$content='
<table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" style="font: arial; font-size: 10pt;">
  <tr bgcolor="#EEEEEE">
    <td align="center"><strong>Title</strong></td>
    <td align="center"><strong>File Name </strong></td>
    <td align="center"><strong>Status</strong></td>
    <td width="50" align="center">&nbsp;</td>
    <td width="50" align="center">&nbsp;</td>
  </tr>
  '.$movie_list.'
</table>
<br /><hr>
<form action="?action=video" method="post" enctype="multipart/form-data" name="form1">
<div align="center" style="font: arial; font-size: 10pt; color: #FF0000;">'.$message.'</div>
  <table width="500" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" align="center" style="font: arial; font-size: 10pt;">
    <tr align="center" bgcolor="#EEEEEE">
      <td colspan="2"><strong>'.$form_title.'</strong></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>Video Clip Title </td>
      <td><input name="title" type="text" id="title" size="35" value="'.$data['title'].'"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>Video File</td>
      <td><input name="movie" type="file" id="movie" size="35"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>Status</td>
      <td><select name="status" id="status">
        <option value="new" '.$status['new'].'>New File</option>
        <option value="archive" '.$status['archive'].'>Archive</option>
        <option value="hidden" '.$status['hidden'].'>Hidden</option>
      </select></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>Description</td>
      <td><textarea name="description" cols="35" rows="7" id="description">'.$data['description'].'</textarea></td>
    </tr>
    <tr bgcolor="#EEEEEE">
      <td>&nbsp;<input type="hidden" name="id" value="'.$_GET['edit'].'"></td>
      <td><input type="submit" name="Submit" value="Save Movie"></td>
    </tr>
  </table>
</form>';
			break;
		}
		case 'member': {
			if(isset($_POST['name']) && $_POST['member_login_id']<>'') {
				$query="UPDATE member SET name='".$_POST['name']."', email='".$_POST['email']."',
				address='".$_POST['address']."', city='".$_POST['city']."', state='".$_POST['state']."',
				phone='".$_POST['phone']."', `password`='".$_POST['member_password']."' WHERE 
				login_id='".$_POST['member_login_id']."'";
				$query=mysql_query($query);
				if(mysql_affected_rows()>0) {
					$message='Member Data Updated.';
				}
				else {
					$message='Unable to update member data. Please try again later.';
				}
				
				if(!is_array($_POST['week'])) {
				    $_POST['week']=array();
				}
				if(!is_array($_POST['monthly'])) {
				    $_POST['monthly']=array();
				}
				
				//edit subscription data
				foreach($_POST['week'] as $key=>$val) {
					if($val==1 && $_POST['week_expire'][$key]<>'') {
						//delete subscription from this handicapper
						$query="DELETE FROM subscription WHERE type='weekly' AND handicapper='".$key."' AND user_id='".$_POST['member_login_id']."'";
						$result=mysql_query($query);
						$query="INSERT INTO subscription SET user_id='".$_POST['member_login_id']."', 
						handicapper='".$key."', type='weekly', expire='".$_POST['week_expire'][$key]."'";
						mysql_query($query);
						$message='Member Data Updated.';
					}
				}

				foreach($_POST['monthly'] as $key=>$val) {
					if($val==1 && $_POST['monthly_expire'][$key]<>'') {
						//delete subscription from this handicapper
						$query="DELETE FROM subscription WHERE type='monthly' AND handicapper='".$key."' AND user_id='".$_POST['member_login_id']."'";
						$result=mysql_query($query);
						$query="INSERT INTO subscription SET user_id='".$_POST['member_login_id']."', 
						handicapper='".$key."', type='monthly', expire='".$_POST['monthly_expire'][$key]."'";
						mysql_query($query);
						$message='Member Data Updated.';
					}
				}
}
			//delete data
			if (isset($_GET['delete']) && $_GET['delete']>0) {
				$query="DELETE FROM member WHERE no='".$_GET['delete']."'";				
				mysql_query($query);
			}
			$row_per_page=30;
			if(!isset($_GET['page'])) {
				$_GET['page']=1;
			}
			$start=($_GET['page']-1)*$row_per_page;
			$query="SELECT COUNT(*) FROM member";
			$result=mysql_query($query);
			$data=mysql_fetch_array($result);
			$total_row=$data[0];
			$total_page=ceil($total_row/$row_per_page);
			for ($i=1;$i<=$total_page;$i++) {
				if($_GET['page']==$i) {
					$status='selected';
				}
				else {
					$status='';
				}
				$page_list.='<option '.$status.'>'.$i.'</option>';
			}
			
			switch ($_GET['order']) {
				case 'city': {
					$order_rule='ORDER BY city ASC';
					break;
				}
				case 'state': {
					$order_rule='ORDER BY state ASC';
					break;
				}
				case 'register': {
					$order_rule='ORDER BY registration_date DESC';
					break;
				}
				default: {
					$order_rule='ORDER BY name ASC';
				}
			}
			$query="SELECT * FROM member ".$order_rule." LIMIT $start,$row_per_page";
			$result=mysql_query($query);
			if($result && mysql_num_rows($result)>0) {
				while ($data=mysql_fetch_array($result)) {					
					$query="SELECT * FROM subscription WHERE user_id='".$data['login_id']."' AND expire>=CURDATE()";
					$result2=mysql_query($query);
					if($result2 && mysql_num_rows($result2)>0) {
						$membership_status='Paid Member';
					}
					else {
						$membership_status='Free Member';
					}
					$member_list.='
  <tr bgcolor="#FFFFFF">
    <td>'.$membership_status.'</td>
    <td>'.$data['name'].'</td>
    <td>'.$data['city'].'</td>
    <td align="center">'.$data['state'].'</td>
    <td align="center">'.$data['registration_date'].'</td>
    <td width="50" align="center"><a title="Edit '.$data['name'].'" href="?action=member&edit='.$data['no'].'"><img src="images/edit.gif" border="0"></a></td>
    <td width="50" align="center"><a title="Delete '.$data['name'].'" onClick="return confirm(\'Delete '.addslashes($data['name']).'?\');" href="?action=member&delete='.$data['no'].'"><img src="images/delete.gif" border="0"></a></td>
  </tr>
';					
				}
			}
			else {
				$member_list='  <tr bgcolor="#FFFFFF">
    <td colspan="7" align="center">No member yet in database</td>
</tr>';
			}
			unset($data);
			if(isset($_GET['edit']) && $_GET['edit']>0) {
				$query="SELECT * FROM member WHERE no='".$_GET['edit']."'";
				$result=mysql_query($query);
				$data=mysql_fetch_array($result);
				
				//get subscription data
				$query="SELECT * FROM subscription WHERE user_id='".$data['login_id']."' AND expire>=CURDATE()";
				$result=mysql_query($query);
				if($result&&mysql_num_rows($result)>0) {
					while ($data2=mysql_fetch_array($result)) {
						${$data2['type']}[$data2['handicapper']]='checked';
						${$data2['type'].'_expire'}[$data2['handicapper']]=$data2['expire'];
					}
				}
			}
			$content='
<form name="member" method="get" action="?action=member">
<table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" style="font: arial; font-size: 10pt;">
  <tr bgcolor="#EEEEEE">
    <td width="50" align="center"><strong>Status</strong></td>
    <td align="center"><a href="#" onClick="document.member.order.value=\'name\'; document.member.submit();"><strong>Name</strong></a></td>
    <td align="center"><a href="#" onClick="document.member.order.value=\'city\'; document.member.submit();"><strong>City</strong></a></td>
    <td align="center"><a href="#" onClick="document.member.order.value=\'state\'; document.member.submit();"><strong>State</strong></a></td>
    <td align="center"><a href="#" onClick="document.member.order.value=\'register\'; document.member.submit();"><strong>Registered</strong></a></td>
    <td width="50" align="center">&nbsp;</td>
    <td width="50" align="center">&nbsp;</td>
  </tr>
  '.$member_list.'
  <tr>
  <td colspan="7" align="center" bgcolor="#EEEEEE">
  <select name="page" onChange="document.member.submit();">
  '.$page_list.'
  </select>
  </td>
  </tr>
</table>
<input type="hidden" name="order" value="'.$_GET['order'].'">
<input type="hidden" name="action" value="member">
</form>
<br />
<hr />
<div align="center" style="color: #FF0000;">
	'.$message.'</div>
<form action="?action=member" method="post" name="form1">
  <div align="center">
  <table width="400" border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC" style="font-family: Arial; font-size: 10pt">
    <tr align="center">
      <td colspan="2" bgcolor="#000000" style="color:#FFFFFF; font-size: 14px; "><strong>Member Profile</strong></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">Name</td>
      <td><input name="name" type="text" id="name" size="25" value="'.$data['name'].'"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">Email</td>
      <td><input name="email" type="text" id="email" size="25" value="'.$data['email'].'"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">Address</td>
      <td><input name="address" type="text" id="address" size="25" value="'.$data['address'].'"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">City</td>
      <td><input name="city" type="text" id="city" size="25" value="'.$data['city'].'"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">State</td>
      <td><input name="state" type="text" id="state" size="25" value="'.$data['state'].'"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">Phone</td>
      <td><input name="phone" type="text" id="phone" size="25" value="'.$data['phone'].'"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td colspan="2" align="right">&nbsp;</td>
    </tr>
    <tr align="center">
      <td colspan="2" bgcolor="#000000" style="color:#FFFFFF; font-size: 14px; " align="right">
		<p align="center">
		<strong>Login information</strong></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">Member ID </td>
      <td><input name="old_login_id" disabled readonly type="text" id="login_id" size="25" value="'.$data['login_id'].'"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">Password</td>
      <td><input name="member_password" type="password" id="password" size="25" value="'.$data['password'].'"></td>
    </tr>
    <tr align="center">
      <td colspan="2" bgcolor="#000000" style="color:#FFFFFF; font-size: 14px; " align="right">
		<p align="center">
		<strong>Subscription</strong></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="left" colspan="2"><strong>Dennis Tobler</strong></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">&nbsp;</td>
      <td>
      <input type="checkbox" name="week[1]" value="1" '.$weekly[1].'>Pick Of The Week<br />
      </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">Expire</td>
      <td>
      <input type="text" name="week_expire[1]" value="'.$weekly_expire[1].'" size=10> YYYY-MM-DD
      </td>
    </tr>
    <tr bgcolor="#EEEEEE">
      <td align="right">&nbsp;</td>
      <td>
      <input type="checkbox" name="monthly[1]" '.$monthly[1].' value="1">Monthly Subscription<br />
      </td>
    </tr>
    <tr bgcolor="#EEEEEE">
      <td align="right">Expire</td>
      <td>
      <input type="text" name="monthly_expire[1]" value="'.$monthly_expire[1].'" size=10> YYYY-MM-DD
      </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="left" colspan="2"><strong>Jimbo</strong></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">&nbsp;</td>
      <td>
      <input type="checkbox" name="week[2]" value="1" '.$weekly[2].'>Pick Of The Week<br />
      </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">Expire</td>
      <td>
      <input type="text" name="week_expire[2]" value="'.$weekly_expire[2].'" size=10> YYYY-MM-DD
      </td>
    </tr>
    <tr bgcolor="#EEEEEE">
      <td align="right">&nbsp;</td>
      <td>
      <input type="checkbox" name="monthly[2]" '.$monthly[2].' value="1">Monthly Subscription<br />
      </td>
    </tr>
    <tr bgcolor="#EEEEEE">
      <td align="right">Expire</td>
      <td>
      <input type="text" name="monthly_expire[2]" value="'.$monthly_expire[2].'" size=10> YYYY-MM-DD
      </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="left" colspan="2"><strong>Handicapper 3</strong></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">&nbsp;</td>
      <td>
      <input type="checkbox" name="week[3]" value="1" '.$weekly[3].'>Pick Of The Week<br />
      </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">Expire</td>
      <td>
      <input type="text" name="week_expire[3]" value="'.$weekly_expire[3].'" size=10> YYYY-MM-DD
      </td>
    </tr>
    <tr bgcolor="#EEEEEE">
      <td align="right">&nbsp;</td>
      <td>
      <input type="checkbox" name="monthly[3]" '.$monthly[3].' value="1">Monthly Subscription<br />
      </td>
    </tr>
    <tr bgcolor="#EEEEEE">
      <td align="right">Expire</td>
      <td>
      <input type="text" name="monthly_expire[3]" value="'.$monthly_expire[3].'" size=10> YYYY-MM-DD
      </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td colspan="2" align="center"><input name="save" type="submit" id="save" value="Save Member Data"></td>
    </tr>
  </table>
  <input type="hidden" name="member_login_id" value="'.$data['login_id'].'">
	</div>
</form>
';
		}
	}
}

?>

<!--
Header
-->
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
    <td class="admin_menu" style="border:1px solid #C0C0C0; font-family: Arial; font-size: 8pt; font-weight: bold"><a href="?action=video" class="admin_menu">
	<font color="#FFFFFF">Video</font></a></td>
    <td class="admin_menu" style="border:1px solid #C0C0C0; font-family: Arial; font-size: 8pt; font-weight: bold"><a href="?action=pick" class="admin_menu">
	<font color="#FFFFFF">Paid Picks</font></a></td>
    <td class="admin_menu" style="border:1px solid #C0C0C0; font-family: Arial; font-size: 8pt; font-weight: bold"><a href="?action=free_pick" class="admin_menu">
	<font color="#FFFFFF">Free Picks</font></a></td>
    <td class="admin_menu" style="border:1px solid #C0C0C0; font-family: Arial; font-size: 8pt; font-weight: bold"><a href="?action=handicap" class="admin_menu">
	<font color="#FFFFFF">Handicappers</font></a></td>
    <td class="admin_menu" style="border:1px solid #C0C0C0; font-family: Arial; font-size: 8pt; font-weight: bold"><a href="?action=member" class="admin_menu">
	<font color="#FFFFFF">Members</font></a></td>
    <td class="admin_menu" style="border:1px solid #C0C0C0; font-family: Arial; font-size: 8pt; font-weight: bold"><a href="?logout=1" class="admin_menu">
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
