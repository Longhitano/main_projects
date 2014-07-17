<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
  "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>


 <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>" type="text/css" media="screen"/>  

<title>Code Eaters</title>

</head>
<body>

<div id="container">
	<div id="header">
		<div id="logo"><h1>Code Eaters</h1></div>
		<div id="login"><a href="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/auth/logout" id="logout">logout | register</a></div>
		<div id="navbar">
			<ul id="nav">
				<li><a href="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/homepage/index">Home</a></li>
				<li><a href="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/insert/displayQuestion">Place a question</a></li>			
				<li><a href="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/search/displaySearch">Search for questions</a></li>
				<li>Contacts/FAQ</li>			
			</ul>		
		
		</div>
		<div class="section">
		<h2>Place a question</h2>	
		<form action="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/insert/insertQuestion" 	method="GET">
			
			<h3>title</h3><input type="text" name="title" / >
			<h3>question</h3><input type="text" name="question" / >
			<h3>tag (lowercase)</h3><input type="text" name="tag" / ></br />
			
		<?php 	
			// Select the session id from the session, then
			// extract the user id from the login tables using
			// the session id

			$session_id = $this->session->userdata('session_id');
			
			$getIdFromName = " SELECT user_id FROM logins WHERE session_id ='$session_id'  ";
			$all = $this->db->query($getIdFromName);
	
			foreach ($all->result_array() as $result) {
	
    			$user_id = $result['user_id'];
		
	}
			
			echo " <input type ='hidden' name='user_id' value='$user_id'  >";
		 ?>	
	
			
		<input type="submit" value="submit" />
		</form>
		
	

		</div>
	</div>

<div id="content">
<div id="main"></div>
<div id="footer"></div>	
</div>

</div>
<?php 
	if(isset($username)){
	
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
