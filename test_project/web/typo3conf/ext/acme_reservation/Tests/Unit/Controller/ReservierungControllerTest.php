<?php
namespace WebitDe\AcmeReservation\Tests\Unit\Controller;

/**
 * Test case.
 */
class ReservierungControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \WebitDe\AcmeReservation\Controller\ReservierungController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\WebitDe\AcmeReservation\Controller\ReservierungController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllReservierungsFromRepositoryAndAssignsThemToView()
    {

        $allReservierungs = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $reservierungRepository = $this->getMockBuilder(\::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $reservierungRepository->expects(self::once())->method('findAll')->will(self::returnValue($allReservierungs));
        $this->inject($this->subject, 'reservierungRepository', $reservierungRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('reservierungs', $allReservierungs);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenReservierungToView()
    {
        $reservierung = new \WebitDe\AcmeReservation\Domain\Model\Reservierung();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('reservierung', $reservierung);

        $this->subject->showAction($reservierung);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenReservierungToReservierungRepository()
    {
        $reservierung = new \WebitDe\AcmeReservation\Domain\Model\Reservierung();

        $reservierungRepository = $this->getMockBuilder(\::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $reservierungRepository->expects(self::once())->method('add')->with($reservierung);
        $this->inject($this->subject, 'reservierungRepository', $reservierungRepository);

        $this->subject->createAction($reservierung);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenReservierungToView()
    {
        $reservierung = new \WebitDe\AcmeReservation\Domain\Model\Reservierung();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('reservierung', $reservierung);

        $this->subject->editAction($reservierung);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenReservierungInReservierungRepository()
    {
        $reservierung = new \WebitDe\AcmeReservation\Domain\Model\Reservierung();

        $reservierungRepository = $this->getMockBuilder(\::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $reservierungRepository->expects(self::once())->method('update')->with($reservierung);
        $this->inject($this->subject, 'reservierungRepository', $reservierungRepository);

        $this->subject->updateAction($reservierung);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenReservierungFromReservierungRepository()
    {
        $reservierung = new \WebitDe\AcmeReservation\Domain\Model\Reservierung();

        $reservierungRepository = $this->getMockBuilder(\::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $reservierungRepository->expects(self::once())->method('remove')->with($reservierung);
        $this->inject($this->subject, 'reservierungRepository', $reservierungRepository);

        $this->subject->deleteAction($reservierung);
    }
}
