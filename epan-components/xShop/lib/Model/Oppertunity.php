<?php

namespace xShop;

class Model_Oppertunity extends \Model_Document{
	public $table="xshop_oppertunity";
	public $status=array('Active','Dead');
	public $root_document_name="xShop\Oppertunity";

	public $actions=array(
			'can_view'=>array('caption'=>'Whose created Oppertunity this post can see'),
			'allow_edit'=>array('caption'=>'Whose created Oppertunity this post can edit'),
			'allow_add'=>array('caption'=>'Can this post create new Oppertunity'),
			'allow_del'=>array('caption'=>'Whose Created Oppertunity this post can delete'),
		);
	
	function init(){
		parent::init();

		$this->hasOne('xMarketingCampaign/Lead','lead_id');
		$this->hasOne('xShop/Customer','customer_id');
		$this->hasOne('xHR/Employee','employee_id')->caption('Handeled By');
		

		$this->addField('name')->caption('Oppertunity')->hint('New Sales of X product');

		$this->getElement('status')->enum($this->status)->defaultValue('Active');

		$this->hasMany('xShop/Quotation','oppertunity_id');

		$this->addHook('afterInsert',$this);

		//$this->add('dynamic_model/Controller_AutoCreator');
	}

	function afterInsert($obj,$new_id){
		$obj->load($new_id);

		$log_array = array(
				'from'=>'Employee',
				'from_id'=>$this->api->current_employee->id,
				'related'=>'Oppertunity',
				'related_id'=>$new_id,
				'subject'=> 'Oppertunity Created',
				'message'=> 'Oppertunity Created'
				);

		$log = $this->add('xCRM/Model_Communication');
		$log->create($log_array,'Created');
		
	}

	function mark_dead($reason){
		return "Quotation";
	}
}