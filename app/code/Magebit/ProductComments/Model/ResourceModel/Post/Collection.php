<?php
namespace Magebit\ProductComments\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'comment_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magebit\ProductComments\Model\Post', 'Magebit\ProductComments\Model\ResourceModel\Post');
    }

}