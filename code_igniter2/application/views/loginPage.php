<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
  "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<title>Code Eaters</title>
 <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>" type="text/css" media="screen"/>  

<meta charset=”utf-8”> 
</head>
<body>

<div id="container">
	<div id="header">
		<div id="logo"><h1>Code Eaters</h1></div>
		<div id="login"><a href="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/auth" id="loginLink"	>Login</a>
	 <a href="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/auth/register" id="registerLink">
	register
	<a href="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/auth/logout" 				id="logout">Logout</a></div>
		<div id="navbar">
			<ul id="nav">
				<li><a href="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/homepage/index">Home</a></li>
				<li><a href="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/insert/displayQuestion">Place a question</a></li>			
				<li><a href="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/search/displaySearch">Search for questions</a></li>
				<li>Contacts/FAQ</li>			
			</ul>		
		
		</div>
		<div id="section">
		<h2>Login</h2>	
			<form action="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/auth/login" method="POST">
			Username:<input type="text" name="uname" /><br />
			Password<input type="password" name="password" /><br />
			Submit<input type="submit" name="submitx" />
			</form>
		</div>
	</div>

<div id="content">
<div id="main"></div>
<div id="footer"></div>	
</div>

</div>

<?php if(isset($username)){
	
	print("<script>   var x=document.getElementById('loginLink'); x.style.visibility = 'hidden';</script>");	
	print("<script>   var x=document.getElementById('registerLink'); x.style.visibility = 'hidden';</script>");	
	print("hi ");print_r($username);
	
}

	else {
	
	print("<script>   var x=document.getElementById('logout'); x.style.visibility = 'hidden';</script>");	
	
}
?>
</body>
</html>
