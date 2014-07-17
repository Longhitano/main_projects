<?php

	class Homepage extends CI_Controller {
 
        /**
         * Index Page for this controller.
         *
         * Maps to the following URL
         *              http://example.com/index.php/welcome
         *      - or - 
         *              http://example.com/index.php/welcome/index
         *      - or -
         * Since this controller is set as the default controller in
         * config/routes.php, it's displayed at http://example.com/
         */
         
         
         
        public function loadDb()
        {
		
           	$this->load->database();    

		$result = $this->db->query('SELECT * FROM Questions');
   		$data = array();
   		 foreach ($result->result() as $row) {
       		$entry = array();
       		$entry['questionID'] = $row->question_id;
       		$entry['author'] = $row->author;
       		$data[] = $entry;
		print_r($data);
    	}
        	//$data['result'] = array("foo", "bar", "hallo", "world");
                
                
                //$this->db->select('*');
                //$this->db->from('Questions');
                
                //$query=$this->db->get();
                //$data = $query->result();


}
}
