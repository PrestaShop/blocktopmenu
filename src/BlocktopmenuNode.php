<?php

class BlocktopmenuNode implements ArrayAccess, Countable, IteratorAggregate
{
    const TYPE_CATEGORY = 'category';
    const TYPE_CATEGORY_THUMBNAILS = 'category-thumbnails';
    const TYPE_PRODUCT = 'product';
    const TYPE_MANUFACTURERS = 'manufacturers';
    const TYPE_MANUFACTURER = 'manufacturer';
    const TYPE_SUPPLIERS = 'suppliers';
    const TYPE_SUPPLIER = 'supplier';
    const TYPE_CMS = 'cms';
    const TYPE_CMS_CATEGORY = 'cms-category';
    const TYPE_SHOP = 'shop';
    const TYPE_LINK = 'link';

    private $type;
    private $selected = false;
    private $data = array();
    private $children = array();

    public function __construct($type, array $data = array())
    {
        $this->type = $type;
        $this->data = $data;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getData($name)
    {
        return isset($this->data[$name]) ? $this->data[$name] : null;
    }

    public function addChild(BlocktopmenuNode $node)
    {
        $this->children[] = $node;

        return $this;
    }

    public function setSelected($selected = true)
    {
        $this->selected = $selected;

        return $this;
    }

    public function isSelected()
    {
        return $this->selected;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function offsetExists($offset)
    {
        return null !== $this->offsetGet($offset);
    }

    public function offsetGet($offset)
    {
        switch ($offset) {
            case 'selected' :
                return $this->selected;
            case 'children' :
                return $this->children;
            case 'data' :
                return $this->data;
                break;
            case 'type' :
                return $this->type;
                break;
        }
    }

    public function offsetSet($offset, $value)
    {
        // Read only
    }

    public function offsetUnset($offset)
    {
        // Read only
    }

    public function getIterator()
    {
        return new ArrayIterator($this->children);
    }

    public function count()
    {
        return count($this->children);
    }
}
