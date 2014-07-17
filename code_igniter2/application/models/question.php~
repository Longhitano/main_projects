<?php

	class Question extends CI_Model{

	

	function __construct()
    	{
       		parent::__construct();
       		$this->load->database();
    	}



	public function insertQuestion($data){
	
	
		
		if( isset($data)){
		$user_id = $data['user_id'];
		$title = $data['title'];
		$question = $data['question'];
		$tag = $data['tag'];

		$query1 = "insert into Questions (Questions.author_id , Questions.title , Questions.content) values ('$user_id' , '$title' , '$question')";

		$query2 = "insert into question_tags (question_tags.question_id) values ('$tag')";
		$this->db->query($query1);
		$this->db->query($query2);
		redirect('/homepage/index');
		
	}
        
	}	

 	
	public function searchData($data){
	
		

	$answer= array();
	$where=array();
	//print_r($data);
	// If searching for tag
	//if(){echo'no';}
	if((isset($data['tag']))&& ($data['author_name']=="")&& ($data['title']=="")){
		//$where=	array('tag'=>$data['tag']);
		
		$where = array('tags.tag' => $data['tag']);
		
		
	}
	//print_r($where);
	// If searching for author
	if((isset($data['author_name']))&& ($data['title']=="")&& ($data['tag']=="")){
		//$where=	array('author_name'=>$data['author_name']);
		//print_r($data);
		$where = array('users.username' => $data['author_name']);
		
	}
	// If searching for title
	if((isset($data['title']))&& ($data['author_name']=="")&& ($data['tag']=="")){
		
		//print_r($data);
		$where = array('Questions.title' => $data['title']);
		
	}		
	// If searching for tag and title
	if(($data['tag']!="")&& ($data['title']!="")&& ($data['author_name']=="")  ){
		$where = array('tags.tag' => $data['tag'], 'Questions.title'=>$data['title']);
		
	}	
	// If searching for tag and author
	if(($data['tag']!="") && ($data['author_name']!="")&& ($data['title']=="")  ){
		$where = array('tags.tag' => $data['tag'], 'users.username' => $data['author_name']);
		
	}
	// If searching for title and author
	if(($data['title']!="") && ($data['author_name']!="")&& ($data['author_name']!="")){
		$where = array('Questions.title' => $data['title'],'users.username' => $data['author_name']);
		
	}
	

	//$where= array('tags.tag'=>$data['tag'],'users.username'=>$data['author_name']);	
	
	echo '<br><br>';
	//print_r($where);
	$res = $this->db->select('Questions.question_id, Questions.content , users.username , tags.tag , Questions.title, answers.content AS acontent, answers.answer_id , answers.score');

	$this->db->from('Questions');
	$this->db->join('users' , 'Questions.author_id = users.user_id');
	$this->db->join('answers', 'Questions.question_id=answers.question_id');
	$this->db->join('question_tags','Questions.question_id = question_tags.question_id');
	$this->db->join('tags','question_tags.tag_id = tags.tag_id');
	$this->db->where($where);
	//$this->db->where('Questions.title', $title);
	//$this->db->where('users.username', $author);

	$this->db->order_by("Questions.question_id", "asc"); 
	$res = $this->db->get();
	$res = $res->result();
	
	//print("<br>This is the first Query:");
	//print_r($res);
	//echo"<br>";	
	$final_res= array();
	
	//total->question->answers(an1, an2)
	$total = array();
	$question = array();
	$question['id'] = null;
	$answers= array();
	$answers['0'] = null;
	$tot_counter=0;
	$counter=1;
	foreach($res as $key=>$result)
	{
		//print_r($key);
		// If the question id is the same as the previous then create a new question
		//echo'<br>',$result->content;
		if($question['id']!=$result->question_id){
			$tot_counter += 1;
			$counter=1;
			$question['title']= $result->title;
			$question['author']=$result->username;
			$question['content']=$result->content;
			$question['tag']=$result->tag;
			$question['id']=$result->question_id;
			$question['answers']=array();
			$question['answers'][$counter]['content']=$result->acontent;
			$question['answers'][$counter]['answer_id']=$result->answer_id;
			$question['answers'][$counter]['score']=$result->score;
			$author= $this->db->select('users.username');
			$this->db->from('answers');
			$this->db->join('users' , 'answers.author_id = users.user_id');
			$this->db->where('answers.answer_id', $question['answers'][$counter]['answer_id']);
			$author=$this->db->get();

			$author=$author->result();
			foreach($author as $key=>$result)
			{
				$author =$result->username;
				$question['answers'][$counter]['user']=$author;
			}
			
			//print_r($result->acontent);
		}
		//If the question id is the same as the previous entry then append a new answer
		else if($question['id'] == $result->question_id){
			$question['answers'][$counter]['content'] =$result->acontent;
			
			$question['answers'][$counter]['answer_id']=$result->answer_id;
			$question['answers'][$counter]['score']=$result->score;
			$author= $this->db->select('users.username');
			$this->db->from('answers');
			$this->db->join('users' , 'answers.author_id = users.user_id');
			$this->db->where('answers.answer_id', $question['answers'][$counter]['answer_id']);
			$author=$this->db->get();

			$author=$author->result();
			foreach($author as $key=>$result)
			{
				$author =$result->username;
				$question['answers'][$counter]['user']=$author;
			}
			
			//print_r($question);
		}
		
	$counter+=1;
	$total[$tot_counter] = $question;
	}

	
	//print_r($total);
	$total = json_encode($total);
	//print_r($total);
	return $total;
	
	

	}

	
	function insertAnswer($data)
	{
		
		// Retrieve user id
		// Add Answer (author_id, question_id, content, date, score)
		//print_r($data);
		$session_id = $this->session->userdata('session_id');
		$author_id = null;
		$score =0;
		//print_r($session_id);
    		$res = $this->db->get_where('logins',array('session_id' => $session_id));
    		if ($res->num_rows() == 1) {
        		$row = $res->row_array();
			$author_id=$row['user_id'];
        		
    		}
		
		$content = $data['answer'];
		$question_id=$data['question_id'];
		
		
		$query1 = "insert into answers (answers.question_id , answers.author_id, answers.content, answers.score) values ('$question_id' , $author_id, '$content' , '$score')";


		$this->db->query($query1);
		
		redirect('/homepage/index');



	}
}		



?>
