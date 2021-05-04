<?php 

namespace Test\Headbands\Test\Unit\Block;
use Test\Headbands\Block\PostView;
use Magento\Framework\App\Action\Context;
use Test\Headbands\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;

class BlockTest extends \PHPUnit\Framework\TestCase {

    /**
     * @var  FeedList
     */
    private $object;

    protected function setUp() : void
    {
        /** @var \Magento\Backend\Block\Template\Context $context */
        $context = $this->getMockBuilder('Magento\Backend\Block\Template\Context')
                        ->disableOriginalConstructor()
                        ->getMock();
        $CollectionFactory = $this->getMockBuilder('Test\Headbands\Model\ResourceModel\Post\CollectionFactory')
                        ->disableOriginalConstructor()
                        ->getMock();
        $Registry = $this->getMockBuilder('Magento\Framework\Registry')
                        ->disableOriginalConstructor()
                        ->getMock();

        $this->object = new PostView($context, $CollectionFactory, $Registry, []);
    }

    public function testBlockInstance()
    {
        $this->assertInstanceOf(PostView::class, $this->object);
    }

    public function testBlockInterface()
    {
        $this->assertInstanceOf(Template::class, $this->object);
    }
}