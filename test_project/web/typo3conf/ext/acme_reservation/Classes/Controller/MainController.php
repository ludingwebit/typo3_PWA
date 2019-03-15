<?php
//
//namespace WebitDe\AcmeReservation\Controller;
//
//use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
//
///**
// * @var MainController
// */
//class MainController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
//{
//
//    /**
//     * @var \WebitDe\AcmeReservation\Domain\Repository\ReservierungRepository
//     * @inject
//     */
//    protected $ReservierungRepository;
//    /**
//     * @var \WebitDe\AcmeReservation\Domain\Repository\SubscriberRepository
//     * @inject
//     */
//    protected $SubscriberRepository;
//
//    public function deleteSubscriberAction(\WebitDe\AcmeReservation\Domain\Model\Subscriber $subscriber)
//    {
//        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
//        $this->SubscriberRepository->remove($subscriber);
//        $this->redirect('list');
//    }
//
//    public function createSubscriberAction(\WebitDe\AcmeReservation\Domain\Model\Subscriber $newSubscriber)
//    {
//        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
//        $this->SubscriberRepository->add($newSubscriber);
//    }
//
//
//    public function createReservierungAction(\WebitDe\AcmeReservation\Domain\Model\Reservierung $newReservation)
//    {
//        # Update auf das Repository anwenden
//        $this->ReservierungRepository->add($newReservation);
//
//        # Den Vorschlaghammer instanzieren / aus der Kiste kramen
//        $persistenceManager = $this->objectManager->get(
//            PersistenceManager::class
//        );
//
//        # Mit dem Vorschlaghammer in die Datenbank speichern / NÃ¤gel mit KÃ¶pfen machen
//        $persistenceManager->persistAll();
//
//    }
//
//}
