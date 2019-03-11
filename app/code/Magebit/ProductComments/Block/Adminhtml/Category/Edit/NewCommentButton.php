<?php

namespace Magebit\ProductComments\Block\Adminhtml\Category\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Cms\Block\Adminhtml\Page\Edit\GenericButton;

/**
 * Class SaveButton
 * @package Magento\Customer\Block\Adminhtml\Edit
 */
class NewCommentButton extends GenericButton  implements ButtonProviderInterface
{

    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('New Comment'),
            'class' => 'save primary',
            'sort_order' => 90,
            'on_click' =>  sprintf("location.href = '%s';", $this->getUrl('*/*/newcomment'))
        ];
    }
}