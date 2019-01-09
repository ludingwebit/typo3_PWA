<?php
namespace WebitDe\AcmeReservation\Controller;

/**
 * @var SubscriberController
 */
class SubscriberController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
    }
    /**
     * action create
     *
     * @param \WebitDe\AcmeReservation\Domain\Model\Subscriber $newSubscriber
     * @return void
     */
    public function createAction(\WebitDe\AcmeReservation\Domain\Model\Subscriber $newSubscriber)
    {
        /**ToDo: Elemente in die MySQL Datenbank schreiben werden vom Javascript generiert und müssen automatisch per Ajax geschrieben werden.**/
        $this->addFlashMessage(
            'The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html',
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING
        );
        $this->subscriberRepository->add($newSubscriber);
        $this->redirect('list');
    }


    /**
     * action delete
     *
     * @param \WebitDe\AcmeReservation\Domain\Model\Subscriber $subscriber
     * @return void
     */
    public function deleteAction(\WebitDe\AcmeReservation\Domain\Model\Subscriber $subscriber)
    {
        $this->addFlashMessage(
            'The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html',
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING
        );
        $this->subscriberRepository->remove($subscriber);
        $this->redirect('list');
    }
}
