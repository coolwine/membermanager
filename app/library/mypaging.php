<?php

use Phalcon\Tag as Tag;

class mypaging 
{
	
	public $total_record;
	public $start_record;
	public $per_page;
	
	public $total_block;
	public $now_block;
	
	public $now_page;
	public $total_page;
	public $start_page;
	public $end_page;
	public $block_per_page;
	
	
	public $link_url;
	
	
	public function __construct($param)
	{
		if(!count($param)) {
			echo 'paging error!!!';
			return;
		}
		
		
		$this->total_record = $param['total_record'];
		$this->per_page = $param['per_page'];
		$this->now_page = $param['now_page'];
		$this->block_per_page = $param['block_num'];
		$this->link_url = $param['link_url'];
		
		
		
		$this->total_page = ceil($this->total_record / $this->per_page );
		$this->total_block = ceil( $this->total_page / $this->block_per_page );
		$this->now_block = (int)($this->now_page / $this->block_per_page );
		$this->start_record = (($this->now_page-1) * $this->per_page) +1;
		$this->start_page = (($this->now_block) * $this->block_per_page) +1;
		$this->end_page = (($this->start_page+$this->block_per_page) <= $this->total_page) ? ($this->start_page+$this->block_per_page) : $this->total_page;
		
		
		
		error_log('total_page : ' .$this->total_page);
		error_log('total_block : ' .$this->total_block);
		error_log('now_block : ' .$this->now_block);
		
		error_log('start_page : ' .$this->start_page);
		error_log('end_page : ' .$this->end_page);
		
	}
	
	
	/*
	 * 
	if ( $now_page > 1 ) { //이전페이지 링크 출력; }
	if( $now_page < $total_page ) { //다음페이지 링크 출력; }
	if( $block_num > 1 ) { //이전 블록 링크 출력; }
	if( $block_num < $total_block ) { //다음 블록 링크 출력; }
	if( $block_num > 2 ) { //앞 블록이 2블록 이상 차이날경우 처음으로 링크 출력; }
	if( $block_num < ($total_block-1) ) { //남은 블록이 2블록 이상인 경우 마지막으로 링크 출력; }
	*
	*/
	
	public function create_links()
	{
		$link_str = '';
		
		if( $this->now_page > 0 )
		{
			//처음으로 링크 출력
			$link_str.= Tag::linkTo($this->link_url, '[first]');
			
			//이전페이지 링크 출력
			$page_num = (($this->now_block-1)*$this->block_per_page)+1  ;
			$link_str.= Tag::linkTo($this->link_url."?page=$page_num", '[prev]');
		}
		
		//페이지 번호 출력 
		for( $i=$this->start_page; $i < $this->end_page ; $i++)
		{
			if( $this->now_page == $i )
			{
				$link_str .= "<span>[$i]</span>";
			}
			else
			{
				$link_str .= Tag::linkTo($this->link_url."?page=$i", "[$i]");
			}
		}
		
		if( $this->now_page < $this->total_page )
		{
			//다음페이지 링크 출력
			$page_num = (($this->now_block+1)*$this->block_per_page)+1  ;
			$link_str.= Tag::linkTo($this->link_url."?page=$page_num", '[next]');
			
			//마지막 링크 출력
			$link_str .= Tag::linkTo($this->link_url."?page=$this->total_page", '[end]');
		}
		
		return $link_str;
	}
	
}