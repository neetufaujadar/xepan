<?php

namespace xShop;

class Model_Quotation_Cancelled extends Model_Quotation{

	function init(){
		parent::init();

		$this->addCondition('status','cancelled');

	}

	

}