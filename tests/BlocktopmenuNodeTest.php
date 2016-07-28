<?php

require_once dirname(__FILE__).'/../src/BlocktopmenuNode.php';

class BlocktopmenuNodeTest extends PHPUnit_Framework_TestCase
{
    public function testClassIsCountableAndIterable()
    {
        $category = new BlocktopmenuNode(BlocktopmenuNode::TYPE_CATEGORY);

        $subCategory1 = new BlocktopmenuNode(BlocktopmenuNode::TYPE_CATEGORY);
        $category->addChild($subCategory1);

        $subCategory2 = new BlocktopmenuNode(BlocktopmenuNode::TYPE_CATEGORY);
        $category->addChild($subCategory2);

        $this->assertCount(2, $category);
        $i = 0;
        foreach ($category as $key => $subCategory) {
            if ($key === 0) {
                $this->assertSame($subCategory1, $subCategory);
            }
            if ($key === 1) {
                $this->assertSame($subCategory2, $subCategory);
            }
            ++$i;
        }
        $this->assertEquals(2, $i);
    }
}