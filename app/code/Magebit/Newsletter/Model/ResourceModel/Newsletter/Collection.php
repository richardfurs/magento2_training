<?php
namespace Magebit\Newsletter\Model\ResourceModel\Newsletter;

class Collection extends \Magento\Newsletter\Model\ResourceModel\Subscriber\Collection
{

    protected function _initSelect()
    {
        parent::_initSelect();
        $this->showCustomerInfo(true)->addSubscriberTypeField()->showStoreInfo();
        $this->_map['fields']['name'] = 'main_table.name';
        return $this;
    }
}