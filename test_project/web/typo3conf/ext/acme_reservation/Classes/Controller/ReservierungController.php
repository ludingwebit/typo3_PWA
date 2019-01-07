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
     * action list
     *
     * @return void
     */
    public function listAction()
    {
//        $reservierungs = $this->reservierungRepository->findAll();
//        $this->view->assign('reservierungs', $reservierungs);
        $this->view->render('list');
    }

    /**
     * @var \WebitDe\AcmeReservation\Domain\Repository\ReservierungRepository
     * @inject
     */
    protected $ReservierungRepository;

    /**
     * action create
     *
     * @param Reservierung $newReservierung
     * @return void
     */
    public function createAction(Reservierung $newReservation)
    {

        /**ToDo: Action implementieren. Einfügen der Formulardaten in die Datenbank ( Beispiel SBG nehmen)**/
        # Update auf das Repository anwenden
        $newReservierung->setStatus("Angekommen");
        $this->ReservierungRepository->add($newReservierung);

        # Den Vorschlaghammer instanzieren / aus der Kiste kramen
        $persistenceManager = $this->objectManager->get(
            "TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager"
        );

        # Mit dem Vorschlaghammer in die Datenbank speichern / Nägel mit Köpfen machen
        $persistenceManager->persistAll();
        return $this->redirect('list');

    }


    /**
     * action update
     *
     * @param Reservierung $reservierung
     * @return void
     */
    public function updateAction(Reservierung $reservierung)
    {
        $this->reservierungRepository->update($reservierung);
        $this->redirect('list');
    }

}
