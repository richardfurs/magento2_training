<?php

namespace Magebit\ProductComments\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

/**
 * Class ProductActions
 *
 * @api
 * @since 100.0.2
 */
class Status extends Column
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items']))
        {

            // column name for which this class is specified
            $fieldName = $this->getData('name');

            foreach ($dataSource['data']['items'] as &$item)
            {
                if (isset($item[$fieldName]))
                {
                    if( $item[$fieldName] == 0 )
                    {
                        $item[$fieldName] = "Not Approved";
                    }

                    if( $item[$fieldName] == 1 )
                    {
                        $item[$fieldName] = "Approved";
                    }
                }
            }
        }

        return $dataSource;
    }
}