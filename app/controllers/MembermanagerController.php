<?php

class MembermanagerController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {

		
    }
	
    
    public function mainAction()
    {
    	$search_val = $this->request->getPost('search_val');
    	
    	echo $search_val;
    	
    	
    	log_message('aaaaaaaa');
    	
    	
    	
    	
    	$data['search_val'] = $search_val;
    	$this->view->setVar('data', $data);
    }
}

