<?php
namespace Test\Headbands\Model\ResourceModel;


class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	protected $_isPkAutoIncrement = false;
  
	public function __construct(
      \Magento\Framework\Model\ResourceModel\Db\Context $context
  )
	{
		parent::__construct($context);
	}
	
	protected function _construct()
	{
		$this->_init('test_headbands_post', 'entity_id');
	}
	
}
