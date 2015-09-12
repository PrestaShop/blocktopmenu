<?php

require_once dirname(__FILE__).'/../src/BlocktopmenuNode.php';
require_once dirname(__FILE__).'/../src/BlocktopmenuNodeVisitor.php';
require_once dirname(__FILE__).'/../src/SuperfishNodeVisitor.php';

class SuperfishNodeVisitorTest extends PHPUnit_Framework_TestCase
{
    public function testVisitProductNode()
    {
        $visitor = new SuperfishNodeVisitor();

        $node = new BlocktopmenuNode(BlocktopmenuNode::TYPE_PRODUCT, array(
            'name' => 'Foo',
            'link' => 'http://prestashop.com',
        ));

        $node->setSelected(false);
        $visitor->visit($node);
        $this->assertEquals((string) $visitor, '<li><a href="http://prestashop.com" title="Foo">Foo</a></li>');

        $visitor->reset();
        $node->setSelected(true);
        $visitor->visit($node);
        $this->assertEquals((string) $visitor, '<li class="sfHover"><a href="http://prestashop.com" title="Foo">Foo</a></li>');
    }

    public function testVisitLinkNode()
    {
        $visitor = new SuperfishNodeVisitor();

        $node = new BlocktopmenuNode(BlocktopmenuNode::TYPE_LINK, array(
            'name' => 'Foo',
            'link' => 'http://prestashop.com',
            'new_window' => true
        ));

        $node->setSelected(false);
        $visitor->visit($node);
        $this->assertEquals((string) $visitor, '<li><a href="http://prestashop.com" title="Foo" onclick="return !window.open(this.href);">Foo</a></li>');
    }

    public function testVisitCategoryNode()
    {
        $category = new BlocktopmenuNode(BlocktopmenuNode::TYPE_CATEGORY, array(
            'name' => 'Foo',
            'link' => 'http://foo.prestashop.com',
        ));

        $subCategory1 = new BlocktopmenuNode(BlocktopmenuNode::TYPE_CATEGORY, array(
            'name' => 'Bar',
            'link' => 'http://bar.prestashop.com',
        ));
        $category->addChild($subCategory1);

        $subCategory2 = new BlocktopmenuNode(BlocktopmenuNode::TYPE_CATEGORY, array(
            'name' => 'Baz',
            'link' => 'http://baz.prestashop.com',
        ));
        $category->addChild($subCategory2);

        $thumbnails = new BlocktopmenuNode(BlocktopmenuNode::TYPE_CATEGORY_THUMBNAILS, array(
            'images' => array(
                array(
                    'src' => 'http://prestashop.com/logo.jpg',
                    'alt' => 'PrestaShop',
                    'title' => 'PrestaShop',
                ),
                array(
                    'src' => 'http://prestashop.com/logo.jpg',
                    'alt' => 'PrestaShop',
                    'title' => 'PrestaShop',
                ),
            ),
        ));
        $category->addChild($thumbnails);

        $visitor = new SuperfishNodeVisitor();
        $visitor->visit($category);

        $expected = <<<EXPECTED
        <li>
            <a href="http://foo.prestashop.com" title="Foo">Foo</a>
            <ul>
                <li><a href="http://bar.prestashop.com" title="Bar">Bar</a></li>
                <li><a href="http://baz.prestashop.com" title="Baz">Baz</a></li>
                <li class="category-thumbnail">
                    <div><img src="http://prestashop.com/logo.jpg" alt="PrestaShop" title="PrestaShop" class="imgm" /></div>
                    <div><img src="http://prestashop.com/logo.jpg" alt="PrestaShop" title="PrestaShop" class="imgm" /></div>
                </li>
            </ul>
        </li>
EXPECTED;

        $this->assertEquals((string) $visitor, str_replace(array(PHP_EOL, '  '), array('', ''), $expected));
    }
}
