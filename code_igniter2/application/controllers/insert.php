<?php

	class Insert extends CI_Controller {
 
    	 public function __construct()
        {
                parent::__construct();
                $this->load->model('question');
		$this->load->library('authlib');
		$loggedin = $this->authlib->is_loggedin();
 
    		if ($loggedin === false) {
        	$this->load->helper('url');
       	 	redirect('/auth');
		
        	}
 
	}
        function displayQuestion(){
	

		$this->load->view('askQuestion');

	


	}

	function insertQuestion(){
	
		// Get the user_id of the author of the question to insert,
		// Then retrieve the remaining variables for title,content and so on ..
		$data['user_id'] = $this->input->get('user_id');
		$data['title'] = $this->input->get('title');
		$data['question'] = $this->input->get('question');
		$data['tag'] = $this->input->get('tag');

		$this->question->insertQuestion($data);
		
		//$this->load->view('finalResults' , $result);
	


	}

	
         
         
      
}
