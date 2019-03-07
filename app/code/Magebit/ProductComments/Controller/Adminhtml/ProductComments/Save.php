<?php
/**
 *
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magebit\ProductComments\Controller\Adminhtml\ProductComments;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\TestFramework\Inspection\Exception;



class Save extends \Magento\Backend\App\Action
{
    protected $_productRepository;
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

    public function __construct(
        Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        DataPersistorInterface $dataPersistor,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
    ) {
        parent::__construct($context);
        $this->_productRepository = $productRepository;
        $this->coreRegistry = $coreRegistry;
        $this->dataPersistor = $dataPersistor;

    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $productId = $this->getRequest()->getPostValue('product_id');

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {

            $id = $this->getRequest()->getParam('comment_id');

            if (empty($data['comment_id'])) {
                $data['comment_id'] = null;
            }

            /** @var \Magento\Cms\Model\Block $model */
            $model = $this->_objectManager->create('Magebit\ProductComments\Model\Post')->load($id);

            try {
                $this->_productRepository
                    ->getById($productId);
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('No such product ID!'));
                return $resultRedirect->setPath('*/*/edit', ['comment_id' => $model->getId()]);
            }



            if (!$model->getId() && $id) {
                $this->messageManager->addError(__('This block no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('Comment saved.'));
                $this->dataPersistor->clear('cms_block');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['comment_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the block.'));
            }

            $this->dataPersistor->set('cms_block', $data);
            return $resultRedirect->setPath('*/*/edit', ['comment_id' => $this->getRequest()->getParam('comment_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}