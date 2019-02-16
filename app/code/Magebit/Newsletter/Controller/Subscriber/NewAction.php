<?php
namespace Magebit\Newsletter\Controller\Subscriber;

class NewAction extends \Magento\Newsletter\Controller\Subscriber\NewAction
{
    public function execute() {
        $name = $this->getRequest()->getPost();
        var_dump($name);exit;
    }
}