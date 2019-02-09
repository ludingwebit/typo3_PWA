<?php
namespace WebitDe\AcmeReservation\Tests\Unit\Domain\Model;

/**
 * Test case.
 */
class SubscriberTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \WebitDe\AcmeReservation\Domain\Model\Subscriber
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \WebitDe\AcmeReservation\Domain\Model\Subscriber();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getEndpointReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getEndpoint()
        );
    }

    /**
     * @test
     */
    public function setEndpointForStringSetsEndpoint()
    {
        $this->subject->setEndpoint('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'endpoint',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getBrowserKeyReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getBrowserKey()
        );
    }

    /**
     * @test
     */
    public function setBrowserKeyForStringSetsBrowserKey()
    {
        $this->subject->setBrowserKey('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'browserKey',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAuthSecretReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAuthSecret()
        );
    }

    /**
     * @test
     */
    public function setAuthSecretForStringSetsAuthSecret()
    {
        $this->subject->setAuthSecret('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'authSecret',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSubscribedAtReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getSubscribedAt()
        );
    }

    /**
     * @test
     */
    public function setSubscribedAtForDateTimeSetsSubscribedAt()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setSubscribedAt($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'subscribedAt',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getUnsubscribedAtReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getUnsubscribedAt()
        );
    }

    /**
     * @test
     */
    public function setUnsubscribedAtForDateTimeSetsUnsubscribedAt()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setUnsubscribedAt($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'unsubscribedAt',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getEnabledReturnsInitialValueForBool()
    {
        self::assertSame(
            false,
            $this->subject->getEnabled()
        );
    }

    /**
     * @test
     */
    public function setEnabledForBoolSetsEnabled()
    {
        $this->subject->setEnabled(true);

        self::assertAttributeEquals(
            true,
            'enabled',
            $this->subject
        );
    }
}
