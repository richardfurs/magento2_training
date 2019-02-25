<?php

namespace Magebit\CategoryList\Block;

use Magento\Catalog\Model\Category;
use Magento\Framework\View\Element\Template;

class CategoryList extends \Magento\Framework\View\Element\Template
{
    protected $category;

    public function __construct(
        Template\Context $context,
        Category $category,
        array $data = []
    )
    {
        parent::__construct($context, $data);

        $this->category = $category;
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return $this->getData('category_id');
    }


    /**
     * @param int $id
     * @return Category
     */
    public function loadCategory($id) {
        return $this->category->load($id);
    }

    /**
     * @param \Magento\Catalog\Model\Category $category
     * @return \Magento\Catalog\Model\ResourceModel\Category\Collection|\Magento\Catalog\Model\Category[]
     */
    public function loadChildren($category)
    {
        return $category->getChildrenCategories();
    }
}