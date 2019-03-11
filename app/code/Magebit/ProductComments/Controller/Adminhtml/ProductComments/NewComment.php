<?php

namespace Magebit\ProductComments\Controller\Adminhtml\ProductComments;

use Magento\Backend\App\Action;

class NewComment extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;

    protected $resultForwardFactory;

    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->resultForwardFactory = $resultForwardFactory;
    }
    public function execute()
    {
        $resultPage = $this->resultForwardFactory->create();

        return $resultPage->forward('edit');
    }
}