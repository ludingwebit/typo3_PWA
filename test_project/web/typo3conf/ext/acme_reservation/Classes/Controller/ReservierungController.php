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
    public function createAction(Request $request)
    {
        $newReservierung = new Reservierung();
        $isSw = (bool)$request->headers->get($this->getParameter('headerSW'));

        /**ToDo: Action implementieren. Einfügen der Formulardaten in die Datenbank ( Beispiel SBG nehmen)**/
        $this->addFlashMessage(
            'The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html',
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING
        );

        # Update auf das Repository anwenden
        $this->ReservierungRepository->add($newReservierung);

        # Den Vorschlaghammer instanzieren / aus der Kiste kramen
        $persistenceManager = $this->objectManager->get(
            "TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager"
        );

        # Mit dem Vorschlaghammer in die Datenbank speichern / Nägel mit Köpfen machen
        $persistenceManager->persistAll();
        $newReservierung->setStatus("Angekommen");
        if ($isSw) {
            return new Response('ok');
        }
        echo "wenn dieser Controller funktioniert gibt es eine Rückgabe";   // gibt '16' aus.
        return "hans peter ist der bester";
    }


    /**
     * action update
     *
     * @param Reservierung $reservierung
     * @return void
     */
    public function updateAction(Reservierung $reservierung)
    {
        $this->addFlashMessage(
            'The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html',
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING
        );
        $this->reservierungRepository->update($reservierung);
        $this->redirect('list');
    }

}
