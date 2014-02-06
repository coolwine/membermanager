<?php

// /require_once '../../app/library/paging.php';


define('__ROOT__', dirname(dirname(__FILE__)) );
require_once __ROOT__.'/library/paging.php';
require_once __ROOT__.'/library/mypaging.php';

class MembermanagerController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
		
    }
	
    
    
    public function mainAction()
    {
    	error_log('main action call');
    	
    	//controller에서 출력하는 방법
    	//$this->view->disable();
    	//die(var_dump($offset));
    	
    	
    	$now_page = $this->request->getQuery('page' , 'int' , 0);
    	//die(var_dump($now_page));
    	$per_page = 20;
    	$total_row = 0;
    	$block_num = 5;
    	$offset = ( $now_page > 0 ) ? (($now_page-1)*$per_page) : $now_page;
    	$Mmember_info = new MemberInfo();
    	$search_val = $this->request->getPost('search_val');
    	
    	
    	
    	error_log('offset = '.$offset);
    
    	
    	
    	if( $search_val == '' )
    	{
    		//$list = MemberInfo::get_memberinfo();
    		$list = $Mmember_info->get_memberinfo($search_val, $offset, $per_page, $total_row);
    		//error_log($this->pr($list));
    	}
    	else
    	{
    		$list = array();
    	}
    	
    	
    	
    	/* -----------------------------------
    	 *	paging
    	----------------------------------- */
    	$params = array(
    			'curPageNum' => $now_page,
    			'pageVar' => 'page',
    			'extraVar' => '&aaa=1&bbb=abc',
    			'totalItem' => 176,
    			'perPage' => 10,
    			'perItem' => 5,
    			'prevPage' => '[이전]',
    			'nextPage' => '[다음]',
    			'prevPerPage' => '[이전10페이지]',
    			'nextPerPage' => '[다음10페이지]',
    			'firstPage' => '[처음]',
    			'lastPage' => '[끝]',
    			'pageCss' => 'aaa',
    			'curPageCss' => 'bbb'
    	);
    	
    	$params = array(
    			'total_record' => $total_row
    			,'per_page' => $per_page
    			,'now_page' => $now_page
    			,'block_num' => $block_num
    			,'link_url' => 'membermanager/main'
    	);
    	
    	//$paging = YsPaging::getInstance($params);
    	$paging = new mypaging($params);
    	   
    	
    	
    	$data['data_pagination'] = $paging->create_links();
    	$data['search_val'] = $search_val;
    	$data['list'] = $list;
    	$data['total_row'] = $total_row;
    	$this->view->setVar('data', $data);
    }
    
    
    
    private function pr($data)
    {
    	return '<pre>'.print_r($data,true).'</pre>';
    }
}

