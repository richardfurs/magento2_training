<?php

namespace Magebit\ProductComments\Model;

class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'comments_table';

    protected $_cacheTag = 'comments_table';

    protected $_eventPrefix = 'comments_table';

    protected function _construct()
    {
        $this->_init('Magebit\ProductComments\Model\ResourceModel\Post');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}