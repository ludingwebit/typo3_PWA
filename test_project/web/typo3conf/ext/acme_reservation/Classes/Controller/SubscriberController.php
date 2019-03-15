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
     * @param Subscriber $subscriber
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
                return new JsonResponse(array('new' => $is_new, "success" => true, $subscriber));

}


    /**
     * action delete
     *
     * @param \WebitDe\AcmeReservation\Domain\Model\Subscriber $subscriber
     * @return void
     */
    public function deleteAction()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $subscriber = new Subscriber();
        $subscriber->setEnabled(1);
        $subscriber->setBrowserKey($data['key']);
        $subscriber->setEndpoint($data['endpoint']);
        $subscriber->setAuthSecret($data['authSecret']);
        $this->SubscriberRepository->remove($subscriber);
        $servername = "84.129.199.240";
        $username = "root";
        $password = "xDxXDbK9UhYl8scD";
        $dbname = "typo3_db";
        // Create connection
        $hans = $subscriber->getEndpoint();
        $databaseConnect = mysqli_connect($servername, $username, $password, $dbname);
        $repositoryRemove = "DELETE FROM `tx_acmereservation_domain_model_subscriber` WHERE `endpoint` = '$hans'";
        $mysql = mysqli_query($databaseConnect, $repositoryRemove);
        mysqli_close($databaseConnect);
        $persistenceManager = $this->objectManager->get("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
        $persistenceManager->persistAll();
        return new JsonResponse(array("success" => true, "Wirklich",$hans ));

    }
}
