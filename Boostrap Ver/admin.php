<?php
require_once ('config.php');
?>

<html>
<head>
	<meta content="text/html; charset=utf-8" />
	<title>System</title>
  	<script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/css/bootstrap.min.css">

<?php
	if($_SESSION['user'] != "admin"){
	echo "<script>alert('Please Login!');location='index.php';</script>";
	}

	$sql="select * from user order by id asc";
	$result=mysql_query($sql);
	$total=mysql_num_rows($result);
	$page=isset($_GET['page'])?intval($_GET['page']):1;  
	$info_num=2; 
	$pagenum=ceil($total/$info_num); 
	If($page>$pagenum || $page == 0){
       Echo "Error : Can Not Found The page .";
       Exit;
	}
	$offset=($page-1)*$info_num; 
	$info=mysql_query("select * from user order by id desc limit $offset,$info_num"); 
?>
<?php
	if($_GET["tj"]=="del"){
	mysql_query($sql="delete from user where user_user='".$_GET['user']."'");
	echo "<script>alert('Deleted');location='admin.php';</script>";
	}
?>
<?php

	if($_GET["tj"]=="modify"){
	$sql="select * from user where user_user='".$_GET['user']."'";
	$rs=mysql_fetch_array(mysql_query($sql));

	$user_skills=$_POST["user_skills"];
	$allskills = implode (",", $user_skills);

	if($_POST["submit"]){	
	mysql_query($sql="update user set user_name='".$_POST['user_name']."',user_phone='".$_POST['user_phone']."',user_email='".$_POST['user_email']."',user_skills='".$allskills."' where user_user='".$_GET['user']."'");
	echo "<script>alert('Done.');location='admin.php';</script>";
	}
?>

</head>
<body>

<form class="form" method="post" action="">
	<table class="table">
		<tbody>
		<tr>
			<td>Modify the user <? echo $user; ?>information.</td>
		</tr>
		<tr>
			<td>User Name</td>
			<td><? echo $rs['user_user'];?></td>
		</tr>
		<tr>
			<td>Real Name</td>
			<td><input class="form-control" name="user_name" type="text" id="user_name" value="<? echo $rs['user_name'];?>"/></td>
		</tr>
		<tr>
			<td>Sex</td>
			<td><? echo $rs['user_sex'];?></td>
		</tr>
		<tr>
			<td>Phone</td>
			<td><input class="form-control" name="user_phone" type="text" id="user_phone" value="<? echo $rs['user_phone'];?>"></td>
		</tr>
		<tr>
			<td>E-mail</td>
			<td><input class="form-control" name="user_email" type="text" id="user_email" value="<? echo $rs['user_email'];?>"></td>
		</tr>
		<tr>
			<td>Skills</td>
			<td><input name="user_skills[]" type="checkbox" value="C" id="C"/>C
			<input name="user_skills[]" type="checkbox" value="JAVA" id="JAVA">JAVA
			<input name="user_skills[]" type="checkbox" value="PYTHON" id="Python"/>PYTHON</td>
		</tr>
		<tr>
			<td><input   class="btn btn-primary" type="reset" name="button" id="button" value="Reset" />
			<input   class="btn btn-primary" type="submit" name="submit" id="submit" value="Submit" /></td>
		</tr>
	</tbody>
	</table>
</form>

<?php } ?>

<table>
	<tr>
		<td><a href='user.php?tj=destroy'>Logout</a>&nbsp;&nbsp;<?php echo "It`s".$total."users,Please manage them.";?></td>
	</tr>
</table>
 
<?php while($rs=mysql_fetch_array($info)){ ?>
<table class="table">
		<tbody>
	<tr>
		<td >User</td>
		<td ><?php echo $rs['user_user']; ?></td>
	</tr>
	<tr>
		<td >Real Name</td>
		<td><?php echo $rs['user_name']; ?></td>
	</tr>
	<tr>
		<td >Sex</td>
		<td><?php echo $rs['user_sex']; ?></td>
	</tr>
	<tr>
		<td>Phone</td>
		<td><?php echo $rs['user_phone']; ?></td>
	</tr>
	<tr>
		<td>E-mail</td>
		<td><?php echo $rs['user_email']; ?></td>
	</tr>
	<tr>
		<td>Skills</td>
		<td><?php echo $rs['user_skills']; ?></td>
	</tr>
	<tr>
		<td>Manage</td>
		<td><?php echo "<a href='?tj=modify&user=".$rs['user_user']."'>Modify</a>&nbsp&nbsp";?>
		<?php echo "<a href='?tj=del&user=".$rs['user_user']."'>Delete</a>" ?>	</td>
	</tr>
</tbody>
</table>
<?php } ?>
<table>
	<tr>
		<td>
	<?php
	if( $page > 1 ){
    		echo "<a href='admin.php?page=".($page-1)."'>Prev</a>&nbsp";
	}else{
   		echo "Prev&nbsp&nbsp";
	}
	for($i=1;$i<=$pagenum;$i++){
		$show=($i!=$page)?"<a href='admin.php?page=".$i."'>".$i."</a>":"$i";
		Echo $show." ";
	}
	if( $page<$pagenum){
    		echo "<a href='admin.php?page=".($page+1)."'>Next</a>";
	}else{
		echo "Next";
     }
?>
		</td>
	</tr>
</table>
</body>
</html>