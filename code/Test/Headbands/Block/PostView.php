<?php
namespace Test\Headbands\Block;

class PostView extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Test\Headbands\Model\ResourceModel\Post\CollectionFactory
     */
    protected $_postCollectionFactory;

    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Test\Headbands\Model\ResourceModel\Post\CollectionFactory $postCollectionFactory,
        \Magento\Framework\Registry $registry,
        array $data = []
    )
    {
        $this->_registry = $registry;
        parent::__construct($context, $data);
        $this->_postCollectionFactory = $postCollectionFactory;
    }

    public function getCurrentCategory()
    {        
        return $this->_registry->registry('current_category');
    }

    /**
    * @return \Test\Headbands\Model\ResourceModel\Post\Collection
    */
    public function getPosts()
    {
        $currentCategoryId = $this->getCurrentCategory()->getId();

        if (!$this->hasData('posts') ) {
            $now = new \DateTime();

            $posts = $this->_postCollectionFactory
                          ->create()
                          ->addFieldToFilter('categories', ['finset' => $currentCategoryId])
                          ->addFieldToFilter('from_date', ['lteq' => $now->format('Y-m-d H:i:s')])
                          ->addFieldToFilter('to_date', ['gteq' => $now->format('Y-m-d H:i:s')])
                          ->setOrder(
                                  'created_at',
                                  'desc'
                              );

            $this->setData('posts', $posts);
        } 

        return  $this->getData('posts');

    }
}