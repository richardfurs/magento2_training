<?php

namespace Magebit\ProductComments\Block;

class CommentsTab extends \Magento\Catalog\Block\Product\View
{
    public function getAttributeValue()
    {
        return $this->getProduct()->getData('allow_comments');
    }
}