<?php

namespace WebitDe\AcmeReservation\Controller;

use WebitDe\AcmeReservation\Domain\Model\Reservierung;
use TYPO3\CMS\Core\Http\Response;

/**
 * @var ReservierungController
 */
class ReservierungController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{


    /**
     * @var \WebitDe\AcmeReservation\Domain\Repository\ReservierungRepository
     * @inject
     */
    protected $ReservierungRepository;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        /** @var \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings $querySettings */
//
//        $querySettings = $this->objectManager->get('TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings');
//        $querySettings->setRespectStoragePage(false);
//        $this->ReservierungRepository->setDefaultQuerySettings($querySettings);
//        $newReservations = $this->reservierungRepository->findAll();
        $this->view->render('list');
    }

    /**
     * action create
     * @param Reservierung $newReservation
     * @throws InvalidArgumentException if the provided argument is not of type 'json'.
     * @return void
     */
    public function createAction(Reservierung $newReservation)
    {
        # Update auf das Repository anwenden
        $newReservation->setStatus("Angekommen");
        $this->ReservierungRepository->add($newReservation);
        # Den Vorschlaghammer instanzieren / aus der Kiste kramen
        $persistenceManager = $this->objectManager->get(
            \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager::class
        );
        # Mit dem Vorschlaghammer in die Datenbank speichern / Nägel mit Köpfen machen
        $persistenceManager->persistAll();
        $this->view->render('list');

    }


    /**
     * action update
     * @throws
     * @param Reservierung $newReservierung
     * @return void
     */
    public function updateAction(Reservierung $newReservierung)
    {
        $this->addFlashMessage(
            'The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html',
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING
        );
        $this->reservierungRepository->update($newReservierung);
        $this->redirect('list');
    }

}
