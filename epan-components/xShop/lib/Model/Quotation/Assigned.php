<?php

namespace xShop;

class Model_Quotation_Assigned extends Model_Quotation{

	function init(){
		parent::init();

		$this->addCondition('status','assigned');

	}

	

}