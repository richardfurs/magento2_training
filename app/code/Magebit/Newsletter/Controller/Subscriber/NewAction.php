<?php
namespace Magebit\Newsletter\Controller\Subscriber;

use Magento\Newsletter\Model\Subscriber;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Phrase;

class NewAction extends \Magento\Newsletter\Controller\Subscriber\NewAction
{
    /**
     * New subscription action
     *
     * @return void
     */
    public function execute()
    {
        if ($this->getRequest()->isPost() && $this->getRequest()->getPost('email')) {
            $email = (string)$this->getRequest()->getPost('email');
            $name = (string)$this->getRequest()->getPost('name');

            try {
                $this->validateEmailFormat($email);
                $this->validateGuestSubscription();
                $this->validateEmailAvailable($email);

                $subscriber = $this->_subscriberFactory->create()->loadByEmail($email);



                if ($subscriber->getId()
                    && (int) $subscriber->getSubscriberStatus() === Subscriber::STATUS_SUBSCRIBED
                ) {
                    throw new LocalizedException(
                        __('This email address is already subscribed.')
                    );
                }

                $status = (int) $this->_subscriberFactory->create()->subscribe($email);
                $subscriber = $this->_subscriberFactory->create()->loadByEmail($email);

                $subscriber->setName($name);
                $subscriber->save();

                $this->messageManager->addSuccessMessage($this->getSuccessMessage($status));
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage(
                    $e,
                    __('There was a problem with the subscription: %1', $e->getMessage())
                );
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong with the subscription.'));
            }
        }
        $this->getResponse()->setRedirect($this->_redirect->getRedirectUrl());
    }

    /**
     * @param int $status
     * @return Phrase
     */
    private function getSuccessMessage(int $status): Phrase
    {
        if ($status === Subscriber::STATUS_NOT_ACTIVE) {
            return __('The confirmation request has been sent.');
        }

        return __('Thank you for your subscription.');
    }
}