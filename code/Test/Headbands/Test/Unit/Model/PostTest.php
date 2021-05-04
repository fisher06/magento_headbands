<?php 

namespace Test\Headbands\Test\Unit\Model;
use Test\Headbands\Model\Post;

class PostTest extends \PHPUnit\Framework\TestCase 
{
    /**
     * @var Post
     */
    protected $model;

    protected function setUp() : void
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $this->model = $objectManager->getObject(
            'Test\Headbands\Model\Post',
            []
        );
    }

    public function testPost()
    {
        $this->assertInstanceOf(Post::class, $this->model);
    }
}