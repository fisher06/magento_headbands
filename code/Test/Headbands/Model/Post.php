<?php
namespace Test\Headbands\Model;

class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'test_headbands_post';

	protected $_cacheTag = 'test_headbands_post';

	protected $_eventPrefix = 'test_headbands_post';

	protected function _construct()
	{
		  $this->_init('Test\Headbands\Model\ResourceModel\Post');
	}

	public function getIdentities()
	{
		  return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		  $values = [];

		  return $values;
	}
}
