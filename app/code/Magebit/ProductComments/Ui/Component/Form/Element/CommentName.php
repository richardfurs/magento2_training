<?php

namespace Magebit\ProductComments\Ui\Component\Form\Element;

use Magento\Framework\View\Element\UiComponent\ContextInterface;

class CommentName extends \Magento\Ui\Component\Form\Element\Input
{
    protected $authSession;

    public function __construct(
        ContextInterface $context,
        \Magento\Backend\Model\Auth\Session $authSession,
        $components = [],
        array $data = []
    ) {
        $this->authSession = $authSession;
        parent::__construct($context, $components, $data);
    }

    /**
     * Prepare component configuration
     *
     * @return void
     */
    public function prepare()
    {
        parent::prepare();
        $config = $this->getData('config');

        $adminName = $this->authSession->getUser()->getUsername();

        if (isset($config['dataScope']) && $config['dataScope'] == 'comment_name') {
            $config['default'] = $adminName;
            $this->setData('config', (array)$config);
        }
    }
}

