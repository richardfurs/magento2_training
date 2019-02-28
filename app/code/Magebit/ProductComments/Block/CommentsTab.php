<?php

namespace Magebit\ProductComments\Block;

use Magebit\ProductComments\Model\ResourceModel\Post\CollectionFactory;

class CommentsTab extends \Magento\Catalog\Block\Product\View
{
    /**
     * @var CollectionFactory
     */
    protected $postCollection;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Url\EncoderInterface $urlEncoder,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Framework\Stdlib\StringUtils $string,
        \Magento\Catalog\Helper\Product $productHelper,
        \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig,
        \Magento\Framework\Locale\FormatInterface $localeFormat,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        CollectionFactory $postCollection,
        array $data = []
    ) {
        parent::__construct($context, $urlEncoder, $jsonEncoder, $string, $productHelper, $productTypeConfig,
            $localeFormat, $customerSession, $productRepository, $priceCurrency, $data);

        $this->postCollection = $postCollection;
    }

    public function getAttributeValue()
    {
        return $this->getProduct()->getData('allow_comments');
    }

    public function getFormAction()
    {
        return $this->getUrl('comments/index/post');
    }

    public function getCurrentProductId()
    {
        return $this->getProduct()->getId();
    }

    public function getCollection($productId)
    {
        /** @var \Magebit\ProductComments\Model\ResourceModel\Post\Collection $collection */
        $collection = $this->postCollection->create();
        $collection->addFieldToFilter('product_id', $productId);
        return $collection->load();
    }
}