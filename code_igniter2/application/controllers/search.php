<?php

	class Search extends CI_Controller {
 
    	 public function __construct()
        {
                parent::__construct();
                $this->load->model('question');
        }
 
        function displayQuestion(){

		$this->load->view('askQuestion');

	}

	function displaySearch(){

		$this->load->view('search');

	}

	function questions(){
	
	    $this->load->library('authlib');
    	    $loggedin = $this->authlib->is_loggedin();
 
    		if ($loggedin === false) {
        		$this->load->helper('url');
       			redirect('/auth/login');
 
    		}
            	//$this->load->view('homeView',array('name' => $loggedin));
    		
		
		$data['author_name'] = $this->input->get('author_id');
		$data['tag'] = $this->input->get('tags');
		$data['title'] = $this->input->get('title');
		
		$result['result'] = $this->question->searchData($data);
		$result['current_user']=$loggedin;
		
		// Why storing results into [''] ?
		$test = json_decode($result['result'],true);
		//print_r($test);
		
		//print_r($result);
	
		$this->load->view('search' , $result);

	} 
         
	function insertAnswer(){
		$data['user'] = $this->input->post('username');
		$data['answer'] = $this->input->post('answer');
		$data['question_id'] = $this->input->post('question_id');
		//print_r($data);
		$this->question->insertAnswer($data);
	}         
      
}
