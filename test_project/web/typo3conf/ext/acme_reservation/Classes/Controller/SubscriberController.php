<?php
namespace WebitDe\AcmeReservation\Controller;

use WebitDe\AcmeReservation\Domain\Model\Subscriber;

/**
 * @var SubscriberController
 */
class SubscriberController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var \WebitDe\AcmeReservation\Domain\Repository\SubscriptionRepository
     * @inject
     */
    protected $SubscriptionRepository;

    /**
     * action create
     *
     * @param Subscriber $newSubscriber
     * @return void
     */
    public function createAction(Subscriber $newSubscriber)
    {
        xdebug_break();
        $this->subscriberRepository->add($newSubscriber);
        # Den Vorschlaghammer instanzieren / aus der Kiste kramen
        $persistenceManager = $this->objectManager->get(
            \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager::class
        );
        # Mit dem Vorschlaghammer in die Datenbank speichern / Nägel mit Köpfen machen
        $persistenceManager->persistAll();
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
