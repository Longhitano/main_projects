<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
  "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<title>Code Eaters</title>
<link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>" type="text/css" media="screen" />
<script>
var xmlhttp;
 
function fetch(t)
{
  
    xmlhttp = new XMLHttpRequest();
    // now build the URL of the server-side resource we want to
    // communicate with
    var url = "https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/search/questions?" + t;
    xmlhttp.onreadystatechange = myfunc;
    xmlhttp.open("GET",url);
    xmlhttp.send();
}
 
function myfunc()
{
    if (xmlhttp != null && xmlhttp.readyState == 4) {
        var txt = xmlhttp.responseText;
        document.getElementById('mydiv').innerHTML = txt;
    }
}
</script>
</head>
<body>

<div id="container">
	<div id="header">
		<div id="logo"><h1>Code Eaters</h1></div>
		<div id="login">
		<a href="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/auth" id="loginLink"	>Login</a>
	 <a href="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/auth/register" id="registerLink"> register
	<a href="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/auth/logout" id="logout">Logout</a>     </div>
		<div id="navbar">
			<ul id="nav">
				<li><a href="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/homepage/index">Home</a></li>
				<li><a href="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/insert/displayQuestion">Ask a question</a></li>			
				<li><a href="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/search/displaySearch">Search For Questions</a></li>
				<li>Contacts/FAQ</li>			
			</ul>		
		
		</div>
		<div class="section">
		<h2>Search</h2>	
		<form action="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/search/questions" 	method="GET">
			Tags<input type="text" name="tags" /><br /> 
			Author name:<input type="text" name="author_id" /><br />
			Match question title:<input type="text" name="title" /><br />
			
			<input type="submit">
		</form>

		
		</div>
		
		<br /><div id="mydiv">Results:<br />
	<?php	

	if(isset($result)){
	
	$result=json_decode($result);
	
	//print $result->{'1'}->{'author'};
	echo '<br><br>';
	
	foreach($result as $key=>$value){
		
		echo 'Question Title: ';
		print_r($value->title);
		echo '<br>';
		echo 'Question Author: ';
		print_r($value->author);
		echo '<br>';
		echo 'Question Content: ';
		print_r($value->content);
		echo '<br>';
		echo '<form action="https://w1345392.users.ecs.westminster.ac.uk/ecwm604/code_igniter/index.php/search/insertAnswer" method="POST">';
		echo '<input type="hidden" name="question_id" value="',$value->id,'"/>';
		echo '<input type="hidden" name="username" value="',$current_user,'"/>';
		echo 'Give an Answer: <input type="text" name="answer"/>';
		echo '<input type="submit" value="submit answer"/></form><br />';

		echo "The answers to this questions are: " . "<br />";
		foreach($value->answers as $key2=>$value2){
			print_r($value2->content);
			echo '  The Author of this Answer is: ';
			print_r($value2->user);	
			echo '<br>';
		}
		echo '<br><br>';
		
	}} 
	?>
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
