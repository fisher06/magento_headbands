<?php
namespace Test\Headbands\Block\Adminhtml\Post\Edit;

/**
 * Adminhtml blog post edit form
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('post_form');
        $this->setTitle(__('Post Information'));
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Ashsmith\Blog\Model\Post $model */
        $model = $this->_coreRegistry->registry('offres_post');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'enctype'=>'multipart/form-data', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('post_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            [
                'legend' => __('General Information'), 
                'class' => 'fieldset-wide'
            ]
        );

        if ($model->getEntityId()) {
            $fieldset->addField(
                'entity_id', 
                'hidden', 
                [
                    'name' => 'entity_id'
                ]
            );
         }

        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name', 
                'label' => __('Post Title'), 
                'title' => __('Post name'), 
                'required' => true
            ]
        );

        $fieldset->addField(
            'link',
            'text',
            [
                'name' => 'link',
                'label' => __('URL'),
                'title' => __('URL'),
                'required' => true
            ]
        );

        $fieldset->addField(
            'image',
            'image', 
            [
                'name' => 'image',
                'label' => __('Upload Image'),
                'title' => __('Upload Image'),
                'note' => 'Allow image type: jpg, jpeg, png',
                'class' => 'required-entry required-file',
            ]
        );

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $modelCategorylist = $objectManager->create('\Test\Headbands\Model\Config\Source\CategoryList');

        $fieldset->addField(
            'categories',
            'multiselect',
            [
                'name' => 'categories',
                'label' => __('Categories'),
                'title' => __('Categories'),
                'required' => true,
                'values'   => $modelCategorylist->toOptionArray(),
                'disabled' => false
            ]
        );

        $fieldset->addField(
            'from_date',
            'date',
            [
                'name' => 'from_date',
                'label' => __('Date start'),
                'date_format' => 'yyyy-MM-dd',
                'time_format' => 'hh:mm:ss'
            ]
        );

        $fieldset->addField(
            'to_date',
            'date',
            [
                'name' => 'to_date',
                'label' => __('Date expire'),
                'date_format' => 'yyyy-MM-dd',
                'time_format' => 'hh:mm:ss'
            ]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
