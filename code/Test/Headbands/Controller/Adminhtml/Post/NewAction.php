<?php
 
namespace Test\Headbands\Controller\Adminhtml\Post;
 
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
 
class NewAction extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Backend\Model\View\Result\Forward
     */
    protected $_resultForwardFactory;
 
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
    ) {
        $this->_resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }
    
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Test_Headbands::save');
    }
  
    
    /**
     * Forward to edit
     *
     * @return \Magento\Backend\Model\View\Result\Forward
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Forward $resultForward */
        $resultForward = $this->_resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}