<?php
/**
 * News data helper
 */
namespace Test\Headbands\Helper;

use Magento\Framework\App\Filesystem\DirectoryList;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Media path to extension images
     *
     * @var string
     */
    const MEDIA_PATH    = 'test_headbands';

    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $_filesystem;
    
    /**
     * File Uploader factory
     *
     * @var \Magento\MediaStorage\Model\File\UploaderFactory
     */
    protected $_fileUploaderFactory;
    
    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Magento\Framework\HTTP\Adapter\FileTransferFactory
     */
    protected $_httpFactory;
    
    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\HTTP\Adapter\FileTransferFactory $httpFactory,
        \Magento\Framework\Filesystem $filesystem
    ) {
        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->_filesystem = $filesystem;
        $this->_storeManager = $storeManager;
        $this->_httpFactory = $httpFactory;
        parent::__construct($context);
    }
    
    /**
     * Remove news item image by image filename
     *
     * @param string $imageFile
     * @return bool
     */
    public function removeImage($imageFile)
    {
        $io = $this->_ioFile;
        $io->open(array('path' => $this->getBaseDir()));
        if ($io->fileExists($imageFile)) {
            return $io->rm($imageFile);
        }
        return false;
    }
    
    /**
     * Upload image and return uploaded image file name or false
     *
     * @throws Mage_Core_Exception
     * @param string $scope the request key for file
     * @return bool|string
     */
    public function uploadImage()
    {
        $adapter = $this->_httpFactory->create();

        if ($adapter->isUploaded()) {
            $uploader = $this->_fileUploaderFactory->create(['fileId' => 'image']);

            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            
            $uploader->setAllowRenameFiles(true);
            
            $uploader->setFilesDispersion(false);
    
            $uploader->setAllowCreateFolders(true);
    
            $path = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath('images/'.self::MEDIA_PATH);
            
            $result = $uploader->save($path);
    
            if (!$result) {
                throw new LocalizedException(
                    __('File can not be saved to the destination folder.')
                );
            }
    
            $url = $this->getBaseUrl() . $result['file'];
    
            return $url;
        }
        return false;
    }
    
    /**
     * Return the base media directory for News Item images
     *
     * @return string
     */
    public function getBaseDir()
    {
        $path = $this->filesystem->getDirectoryRead(
            DirectoryList::MEDIA
        )->getAbsolutePath(self::MEDIA_PATH);
        return $path;
    }
    
    /**
     * Return the Base URL for News Item images
     *
     * @return string
     */
    public function getBaseUrl()
    { 
        return $this->_storeManager->getStore()->getBaseUrl(
                \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
            ). 'images/' . self::MEDIA_PATH . '/';
    }
}
