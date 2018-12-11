<?php
namespace WebitDe\AcmeReservation\Controller;

/***
 *
 * This file is part of the "Acme Reservation" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018
 *
 ***/

/**
 * ReservierungController
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
      //  $reservierungs = $this->reservierungRepository->findAll();
        //$this->view->assign('reservierungs', $reservierungs);
        $this->view->render('list');

    }

    /**
     * action show
     *
     * @param \WebitDe\AcmeReservation\Domain\Model\Reservierung $reservierung
     * @return void
     */
    public function showAction(\WebitDe\AcmeReservation\Domain\Model\Reservierung $reservierung)
    {
        $this->view->assign('reservierung', $reservierung);
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {

    }

    /**
     * action create
     *
     * @param \WebitDe\AcmeReservation\Domain\Model\Reservierung $newReservierung
     * @return void
     */
    public function createAction(\WebitDe\AcmeReservation\Domain\Model\Reservierung $newReservierung)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->reservierungRepository->add($newReservierung);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \WebitDe\AcmeReservation\Domain\Model\Reservierung $reservierung
     * @ignorevalidation $reservierung
     * @return void
     */
    public function editAction(\WebitDe\AcmeReservation\Domain\Model\Reservierung $reservierung)
    {
        $this->view->assign('reservierung', $reservierung);
    }

    /**
     * action update
     *
     * @param \WebitDe\AcmeReservation\Domain\Model\Reservierung $reservierung
     * @return void
     */
    public function updateAction(\WebitDe\AcmeReservation\Domain\Model\Reservierung $reservierung)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->reservierungRepository->update($reservierung);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \WebitDe\AcmeReservation\Domain\Model\Reservierung $reservierung
     * @return void
     */
    public function deleteAction(\WebitDe\AcmeReservation\Domain\Model\Reservierung $reservierung)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->reservierungRepository->remove($reservierung);
        $this->redirect('list');
    }
}
