<?php
namespace Webit\ReservierungExt\Tests\Unit\Controller;

/**
 * Test case.
 */
class DefaultControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Webit\ReservierungExt\Controller\DefaultController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Webit\ReservierungExt\Controller\DefaultController::class)
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
    public function listActionFetchesAllDefaultsFromRepositoryAndAssignsThemToView()
    {

        $allDefaults = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $defaultRepository = $this->getMockBuilder(\::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $defaultRepository->expects(self::once())->method('findAll')->will(self::returnValue($allDefaults));
        $this->inject($this->subject, 'defaultRepository', $defaultRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('defaults', $allDefaults);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }
}
