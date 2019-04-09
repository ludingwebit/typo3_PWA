<?php
/**
 * Created by PhpStorm.
 * User: Paul L
 * Date: 08.04.2019
 * Time: 13:34
 */

namespace WebitDe\AcmeReservation\Controller;

use WebitDe\AcmeReservation\Domain\Model\Reservierung;

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
//        $newReservation = $this->ReservierungRepository->findAll();
//        $this->view->assign('newReservations', $newReservation);
    }

    /**
     * action create
     * @param Reservierung $newReservation
     * @return void
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
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
        $this->redirect('list');

    }


    /**
     * action update
     * @throws
     * @param Reservierung $newReservation
     * @return void
     */
    public function updateAction(Reservierung $newReservation)
    {
        $this->addFlashMessage(
            'The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html',
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING
        );
        $this->reservierungRepository->update($newReservation);
        $this->redirect('list');
    }


}