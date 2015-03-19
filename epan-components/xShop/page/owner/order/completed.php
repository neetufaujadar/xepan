<?php
class page_xShop_page_owner_order_completed extends page_xShop_page_owner_main{
	function init(){
		parent::init();
		$this->add('PageHelp',array('page'=>'order_complete'));	
		$crud=$this->add('CRUD',array('grid_class'=>'xShop/Grid_Order'));
		$crud->setModel('xShop/Model_Order_Completed');
		$crud->add('xHR/Controller_Acl');
	}
}		