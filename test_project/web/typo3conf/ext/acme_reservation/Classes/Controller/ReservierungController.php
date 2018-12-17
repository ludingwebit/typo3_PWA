<?php
namespace WebitDe\AcmeReservation\Controller;

use WebitDe\AcmeReservation\Domain\Model\Reservierung;

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
        //  $reservierungs = $this->reservierungRepository->findAll();
        //$this->view->assign('reservierungs', $reservierungs);
        $this->view->render('list');
    }

    /**
     * action show
     *
     * @param Reservierung $reservierung
     * @return void
     */
    public function showAction(Reservierung $reservierung)
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
     * @var \WebitDe\AcmeReservation\Repository\ReservierungRepository
     * @inject
     */
    protected $ReservierungRepository;
    /**
     * action create
     *
     * @param Reservierung $newReservierung
     * @return void
     */
    public function createAction(Reservierung $newReservierung)
    {
                $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager::class)->persistAll();
                $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
                $this->ReservierungRepository->add($newReservierung);
                $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param Reservierung $reservierung
     * @ignorevalidation $reservierung
     * @return void
     */
    public function editAction(Reservierung $reservierung)
    {
        $this->view->assign('reservierung', $reservierung);
    }

    /**
     * action update
     *
     * @param Reservierung $reservierung
     * @return void
     */
    public function updateAction(Reservierung $reservierung)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->reservierungRepository->update($reservierung);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param Reservierung $reservierung
     * @return void
     */
    public function deleteAction(Reservierung $reservierung)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->reservierungRepository->remove($reservierung);
        $this->redirect('list');
    }
}
