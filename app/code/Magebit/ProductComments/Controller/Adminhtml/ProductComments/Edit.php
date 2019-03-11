<?php

namespace Magebit\ProductComments\Controller\Adminhtml\ProductComments;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var \Magebit\ProductComments\Model\Post
     */
    protected $post;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    public function __construct(
        Action\Context $context,
        \Magebit\ProductComments\Model\Post $post,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->post = $post;
        $this->coreRegistry = $coreRegistry;
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Edit CMS block
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('comment_id');

        $model = $this->post;

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This comment no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/index');
            }
        }

        $this->coreRegistry->register('magebit_productcomment', $model);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Comment') : __('New Comment'));

        $this->_setActiveMenu('Magebit_ProductComments::Magebit');

        return $resultPage;
    }
}
