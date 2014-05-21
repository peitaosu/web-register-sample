<?php 
require_once ('config.php'); 
if(empty($_SESSION['user'])){
	echo "<script>alert('Please Login or Register.');location='index.php';</script>";
}
?>
<!DOCTYPE>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>User Information.</title>
	<script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/css/bootstrap.min.css">
</head>
<body>
<?php
if($_GET["tj"]=="destroy"){
session_destroy();
echo "<script>alert('Exited.');location='index.php';</script>";}
?>

<?php
$user_skills=$_POST["user_skills"];
$allskills = implode (",", $user_skills);
if($_GET["tj"]=="modify") {
if($_POST["submit"]){
	mysql_query($sql="update user set user_name='".$_POST['user_name']."',
	user_phone='".$_POST['user_phone']."',
	user_email='".$_POST['user_email']."',
	user_skills='".$allskills."' where 
	user_user='".$_SESSION['user']."'");
	echo "<script>alert('Successful.');location='user.php';</script>";
} ?>
<?php
$sql="select * from user where user_user='".$_SESSION['user']."'";
$rs=mysql_fetch_array(mysql_query($sql));
?>
<table class="table">
	<tbody>
	<tr>
		<td>Modifying Data<a href="user.php">Main Page</a></td>
	</tr>
	</tbody>
</table>
<form class="form" method="post" action="">
	<table class="table">
	<tbody>
		<tr>
			<td>Username</td>
			<td><? echo $rs['user_user'];?></td>
		</tr>
		<tr>
			<td>Realname</td>
			<td><input class="form-control" name="user_name" type="text" id="user_name" value="<? echo $rs['user_name'];?>"/></td>
		</tr>
		<tr>
			<td>Sex</td>
			<td><? echo $rs['user_sex'];?></td>
		</tr>
		<tr>
			<td>Phone</td>
			<td><input class="form-control" name="user_phone" type="text" id="user_phone" value="<? echo $rs['user_phone'];?>"/></td>
		</tr>
		<tr>
			<td>E-mail</td>
			<td><input class="form-control" name="user_email" type="text" id="user_email" value="<? echo $rs['user_email'];?>" /></td>
		</tr>
		<tr>
			<td>Skills</td>
			<td><input name="user_skills[]" type="checkbox" value="C" id="C"/>C
			<input name="user_skills[]" type="checkbox" value="JAVA" id="JAVA">JAVA
			<input name="user_skills[]" type="checkbox" value="PYTHON" id="Python"/>PYTHON</td>
		</tr>
		<tr>
			<td><input   class="btn btn-primary" type="reset" name="button" id="button" value="Reset" /></td>
			<td><input   class="btn btn-primary" type="submit" name="submit" id="submit" value="Submit" /></td>
		</tr>
	</tbody>
	</table>
</form>

<?php } ?>
<?php
if($_SESSION['user'])              
{?>
<table>
	<tr>
		<td><a href='?tj=destroy'>Log out</a>&nbsp;&nbsp;
		<?php echo "<a href='?tj=modify'>Modify</a>";?>
		<?php if($_SESSION['user']=="admin"){?>
		<a href="admin.php">Manage</a><?php }?></td>
	</tr>
</table>

<?php
$result=mysql_query("select * from user where user_user='".$_SESSION['user']."'"); 
while($rs=mysql_fetch_array($result)){
?>

<table class="table">
	<tbody>
	<tr>
		<td>User Name</td>
		<td><?php echo htmlspecialchars($rs['user_user']); ?></td>
	</tr>
	<tr>
		<td>Real Name</td>
		<td><?php echo htmlspecialchars($rs['user_name']); ?></td>
	</tr>
	<tr>
		<td>Sex</td>
		<td><?php echo htmlspecialchars($rs['user_sex']); ?></td>
	</tr>
	<tr>
		<td>Phone</td>
		<td><?php echo htmlspecialchars($rs['user_phone']); ?></td>
	</tr>
	<tr>
		<td>E-mail</td>
		<td><?php echo htmlspecialchars($rs['user_email']); ?></td>
	</tr>
	<tr>
		<td>Skills</td>
		<td><?php echo htmlspecialchars($rs['user_skills']); ?></td>
	</tr>
	</tbody>
</table>
<?php } 
}
?>
</body>
</html>