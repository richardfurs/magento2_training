<?php

namespace Magebit\ProductComments\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Post extends \Magento\Framework\App\Action\Action
{

    /**
     * @var \Magebit\ProductComments\Model\Post
     */
    protected $comments;

    public function __construct(
        Context $context,
        \Magebit\ProductComments\Model\Post $comments
    ) {
        parent::__construct($context);

        $this->comments = $comments;
    }

    public function execute()
    {

        $post = (array)$this->getRequest()->getPost();

        if (!empty($post)) {

            $data = [
                'comment_name' => $post['comment_name'],
                'comment_email' => $post['comment_email'],
                'comment_text' => $post['comment_text'],
                'product_id' => $post['product_id']
            ];

            $this->comments->setData($data);
            $this->comments->save();

            $this->messageManager->addSuccessMessage('Comment added!');

            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($this->_redirect->getRefererUrl());

            return $resultRedirect;

        }

        // 2. GET request : Render the booking page
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}