<?php
require_once ('config.php');
?>
<!DOCTYPE>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Login</title>

	<script language="javascript">
	function chk(mainForm){
		if (mainForm.user_user.value.replace(/(^\s*)|(\s*$)/g, "") == ""){
			alert("Account can not be empty!");
			mainForm.user_user.focus(); 
			return (false);   
		}
		if (mainForm.user_password.value.replace(/(^\s*)|(\s*$)/g, "") == ""){
			alert("Password can not be empty!");
			mainForm.user_password.focus();   
			return (false);   
		}
		if (mainForm.user_password.value != mainForm.pass.value){
			alert("Enter the password twice is not the same!");
			mainForm.pass.focus();   
			return (false);   
		}
	}
	</script>

	<?php
	if($_POST["submit"])
	{
		if(empty($_POST['user_user']))
			echo "<script>alert('Account can not be empty!');location='?tj=register';</script>";
		else if(empty($_POST['user_password']))
			echo "<script>alert('Password can not be empty!');location='?tj=register';</script>";
		else if($_POST['user_password']!=$_POST['pass'])
			echo "<script>alert('Password can not be empty!');location='?tj=register';</script>";
		else if(!empty($_POST['user_phone'])&&!is_numeric($_POST['user_phone']))
			echo "<script>alert('Phone number must is all digital!');location='?tj=register';</script>";
		else if(!empty($_POST['user_email'])&&!ereg("([0-9a-zA-Z]+)([@])([0-9a-zA-Z]+)(.)([0-9a-zA-Z]+)",$_POST['user_email']))
			echo "<script>alert('Wrong E-mail!');location='?tj=register';</script>";
		else{
			$_SESSION['user']=$_POST['user_user'];
			$user_skills=$_POST["user_skills"];
			$allskills = implode (",", $user_skills);
			$sql="insert into user values('','".$_POST['user_user']."','".md5($_POST['user_password'])."','".$_POST['user_name']."','".$_POST['user_sex']."','".$_POST['user_phone']."','".$_POST['user_email']."','".$allskills."')";
			$result=mysql_query($sql)or die(mysql_error());
			if($result)
				echo "<script>alert('Registration is successful, immediately enter the information page!');location='user.php';</script>";
			else{
				echo "<script>alert('Registration failed, please try again!');location='index.php';</script>";
				mysql_close();}
		}
	}
	?>
</head>

<body>
<?php if($_GET['tj'] == 'register'){ ?>

<form id="mainForm" name="mainForm" method="post" action="" onSubmit="return chk(this)" runat="server">
  <table>
  	<tr>
  		<td>User Name</td>
    		<td><input type="text" name="user_user" id="user_user" placeholder="Username"></td>
    	</tr>
  	<tr>
  		<td>Password</td>
    		<td><input name="user_password" type="password" id="user_password" placeholder="Password"></td>
    	</tr>
  	<tr>
  		<td>Re-enter the password</td>
    		<td><input name="pass" type="password" id="pass"  placeholder="Password"></td>
    	</tr>
  	<tr>
  		<td>Real Name</td>
    		<td><input type="text" name="user_name" id="user_name" placeholder="Real Name"></td>
    	</tr>
  	<tr>
  		<td>Sex</td>
    		<td><input type="radio" name="user_sex" id="0" value="Male" checked>
		Male</td>
      		<td><input type="radio" name="user_sex" id="1" value="Female">
		Female</td>
    	</tr>
  	<tr>
  		<td>Phone</td>
    		<td><input type="text" name="user_phone" id="user_phone" placeholder="Phone"></td>
	</tr>
	<tr>
  		<td>E-mail</td>
    		<td><input type="text" name="user_email" id="user_email" placeholder="E-mail"></td>
	</tr>
	<tr>
  		<td>Skills</td>
    		<td><input name="user_skills[]" type="checkbox" value="C">C</td>
    		<td><input name="user_skills[]" type="checkbox" value="Java">Java</td>
    		<td><input name="user_skills[]" type="checkbox" value="Python">Python</td>
	</tr>
	<tr>
  		<td><input  type="reset" name="button" id="button" value="Reset" /></td>
  		<td><input  type="submit" name="submit" id="submit" value="Register" /></td>
	</tr>
	</table>
</form>

<?php
} 
	if($_GET['tj']== ''){
?>

<?php
	if($_POST["Login"]){
		$name=$_POST['name'];
		$pw=md5($_POST['password']);
		$sql="select * from user where user_user='".$name."'"; 
		$result=mysql_query($sql) or die("Incorrect account!");
		$num=mysql_num_rows($result);
		if($num==0){
			echo "<script>alert('Account does not exist!');location='index.php';</script>";
			}
		while($rs=mysql_fetch_object($result)){
			if($rs->user_password!=$pw){
				echo "<script>alert('Wrong Password!');location='index.php';</script>";
				mysql_close();
			}
			else {
				$_SESSION['user']=$_POST['name'];
				header("Location:user.php");
				mysql_close();
				}
			}
	}
?>

<form  action="" method="post" name="regForm" onSubmit="return Checklogin();" >
	<table>
		<tr>
			<td>Login</td>
		</tr>
		<tr>
			<td>Username</td>
			<td><input type="text" name="name" id="name" placeholder="Username"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input name="password" type="password" id="name" placeholder="Password"></td>
		</tr>
		<tr>
			<td><button  name="Login" type="submit" value="Login"/>Login</button></td>
			<td><a href='index.php?tj=register'>No Account? Register Now!</a></td>

		</tr>
	</table>		
</form>

<?php } ?>
</body>
</html>