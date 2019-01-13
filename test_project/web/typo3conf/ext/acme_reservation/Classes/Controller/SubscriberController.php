<?php
namespace WebitDe\AcmeReservation\Controller;
// The use statements of course belong into the file header.
use Symfony\Component\HttpFoundation\JsonResponse;
use WebitDe\AcmeReservation\Domain\Model\Subscriber;
/**
 * @var SubscriberController
 */
class SubscriberController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var \WebitDe\AcmeReservation\Domain\Repository\SubscriberRepository
     * @inject
     */
    protected $SubscriberRepository;

    /**
     * action create
     *
     * @param Subscriber $Subscriber
     * @return void
     */
    public function createAction()
    {

        $data = json_decode(file_get_contents('php://input'), true);
        $is_subscribed = $this->SubscriberRepository->findByIdentifier($data['endpoint']);
        if (is_null($is_subscribed)) {
            $is_new = true;
            $subscriber = new Subscriber();
            $subscriber->setEnabled(1);
            $subscriber->setBrowserKey($data['key']);
            $subscriber->setEndpoint($data['endpoint']);
            $subscriber->setAuthSecret($data['authSecret']);
            $now = new \DateTime();
            $subscriber->setSubscribedAt($now) ;
            $this->SubscriberRepository->add($subscriber);
                    # Den Vorschlaghammer instanzieren / aus der Kiste kramen
            $persistenceManager = $this->objectManager->get("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
            $persistenceManager->persistAll();
        }
                return new JsonResponse(array('new' => $is_new, "success" => true));

}




    /**
     * action delete
     *
     * @param \WebitDe\AcmeReservation\Domain\Model\Subscriber $subscriber
     * @return void
     */
    public function deleteAction(Subscriber $subscriber)
    {
        $this->addFlashMessage(
            'The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html',
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING
        );
        $this->SubscriberRepository->remove($subscriber);
        $this->redirect('list');
    }
}
