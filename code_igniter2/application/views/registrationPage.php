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
		<div id="login"></div>
		<div id="navbar">
			<ul id="nav">
				<li><a href="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/homepage/index">Home</a></li>
				<li><a href="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/insert/displayQuestion">Place a question</a></li>			
				<li><a href="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/search/displaySearch">Search for questions</a></li>
				<li>Contacts/FAQ</li>			
			</ul>		
		
		</div>
		<div id="section">
		<h2>Register</h2>	
		<form action="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/auth/createAccount" method="POST">
    		Enter your name (max 50 characters):
        	<input type="text" name='name' length="20" size="50">  <br>
    		Choose your username (max 10 characters):
        	<input type="text" name='uname' length="10" size="10">  <br>
    		Choose password:
        	<input type="password" name='password' length="15" size="30"> <br>
    		Confirm password:
        	<input type="password" name='conf_password' length="15" size="30">
    		<input type="submit" value='Register!'>

</form>	
		</div>
	</div>

<div id="content">
<div id="main"></div>
<div id="footer"></div>	
</div>

</div>
</body>
</html>
