<?php
namespace Webit\ReservierungExt\Tests\Unit\Domain\Model;

/**
 * Test case.
 */
class DefaultTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Webit\ReservierungExt\Domain\Model\Default
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Webit\ReservierungExt\Domain\Model\Default();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function dummyTestToNotLeaveThisFileEmpty()
    {
        self::markTestIncomplete();
    }
}
