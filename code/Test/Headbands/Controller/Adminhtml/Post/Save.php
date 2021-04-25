<?php
namespace Test\Headbands\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Magento\Backend\App\Action
{
    protected $_fileUploaderFactory;
    protected $_filesystem;

    /**
     * @param Action\Context $context
     */
    public function __construct(
        \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
        \Magento\Framework\Filesystem $filesystem,
        Action\Context $context
    )
    {
        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->_filesystem = $filesystem;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Test_Headbands::save');
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            /** @var \Test\Headbands\Model\Post $model */
            $model = $this->_objectManager->create('Test\Headbands\Model\Post');
            
            $id = $this->getRequest()->getParam('entity_id');
            
            if ($id) {
                //edit
                $model->load($id);
                $model->setName($data['name']);
                $model->setLink($data['link']);
                $model->setFromDate($data['from_date']);
                $model->setToDate($data['to_date']);
                $model->setCategories(implode(",", $data['categories']));

            } else {
                //new
                $model->setData($data);
            }

            // save image data
            if (isset($data['image'])) {
                $imageData = $data['image'];
            } else {
                $imageData = array();
            }

            try {
                // delete the image
                if (isset($imageData['delete'])) {
                    $model->setImage(null);
                } 
                
                // insert the image
                $imageHelper = $this->_objectManager->get('Test\Headbands\Helper\Data');
                $imageFile = $imageHelper->uploadImage();

                if ($imageFile) {
                    $model->setImage($imageFile);
                }
                
                $model->save();
                
                $this->messageManager->addSuccess(__('You saved this Post.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['entity_id' => $model->getEntityId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the post.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $this->getRequest()->getParam('entity_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }


}
