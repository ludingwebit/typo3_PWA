<?php

namespace WebitDe\AcmeReservation\Controller;

/**
 * @var MainController
 */
class MainController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    public function indexAction(){
        $this->view->render('index');
    }
    public function deleteSubscriberAction(\WebitDe\AcmeReservation\Domain\Model\Subscriber $subscriber)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->subscriberRepository->remove($subscriber);
        $this->redirect('list');
    }

    public function createSubscriberAction(\WebitDe\AcmeReservation\Domain\Model\Subscriber $newSubscriber)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->subscriberRepository->add($newSubscriber);
    }


    public function createReservierungAction(\WebitDe\AcmeReservation\Domain\Model\Reservierung $newReservierung)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->reservierungRepository->add($newReservierung);
    }

}
