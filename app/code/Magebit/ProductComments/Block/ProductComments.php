<?php

namespace Magebit\ProductComments\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class ProductComments extends \Magento\Framework\View\Element\Template
{

    protected $product;

    protected $productRepository;

    protected $productCollectionFactory;

    public function __construct(
        Context $context,
        ProductFactory $product,
        ProductRepositoryInterface $productRepository,
        CollectionFactory  $productCollectionFactory,
        array $data = []
    )
    {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->product = $product;
        $this->productRepository = $productRepository;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function getProductCollection()
    {
        $productcollection = $this->productCollectionFactory
            ->create()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('allow_comments','1')
            ->load();
        return $productcollection;
    }

}



