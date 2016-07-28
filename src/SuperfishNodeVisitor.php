<?php

class SuperfishNodeVisitor implements BlocktopMenuNodeVisitor
{
    private $output;

    public function reset()
    {
        $this->output = '';
    }

    public function visit(BlocktopMenuNode $node)
    {
        $cssClasses = array();
        if ($node->isSelected()) {
            $cssClasses[] = 'sfHover';
        }
        if ($node->getType() === BlocktopMenuNode::TYPE_CATEGORY_THUMBNAILS) {
            $cssClasses[] = 'category-thumbnail';
        }

        $this->output .= '<li'.(!empty($cssClasses) ? ' class="'.implode(' ', $cssClasses).'"' : '').'>';
        switch ($node->getType()) {
            case BlocktopMenuNode::TYPE_CATEGORY_THUMBNAILS:
                foreach ($node->getData('images') as $image) {
                    $this->output .= '<div><img src="'.$image['src'].'" alt="'.$image['alt'].'" title="'.$image['title'].'" class="imgm" /></div>';
                }
                break;
            case BlocktopMenuNode::TYPE_LINK:
                $newWindow = true === $node->getData('new_window');
                $this->output .= '<a href="'.$node->getData('link').'" title="'.$node->getData('name').'"'.($newWindow ? ' onclick="return !window.open(this.href);"' : '').'>'.$node->getData('name').'</a>';
                break;
            default :
                $this->output .= '<a href="'.$node->getData('link').'" title="'.$node->getData('name').'">'.$node->getData('name').'</a>';
        }

        if (count($node) > 0) {
            $this->output .= '<ul>';
            foreach ($node as $childNode) {
                $this->visit($childNode);
            }
            $this->output .= '</ul>';
        }
        $this->output .= '</li>';
    }

    public function __toString()
    {
        return $this->output;
    }
}
