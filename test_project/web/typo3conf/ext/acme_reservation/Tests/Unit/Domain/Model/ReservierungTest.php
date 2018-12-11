<?php
namespace WebitDe\AcmeReservation\Tests\Unit\Domain\Model;

/**
 * Test case.
 */
class ReservierungTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \WebitDe\AcmeReservation\Domain\Model\Reservierung
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \WebitDe\AcmeReservation\Domain\Model\Reservierung();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );
    }

    /**
     * @test
     */
    public function setNameForStringSetsName()
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'name',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getDatumReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getDatum()
        );
    }

    /**
     * @test
     */
    public function setDatumForDateTimeSetsDatum()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setDatum($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'datum',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getZeitReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getZeit()
        );
    }

    /**
     * @test
     */
    public function setZeitForIntSetsZeit()
    {
        $this->subject->setZeit(12);

        self::assertAttributeEquals(
            12,
            'zeit',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAnzahlReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getAnzahl()
        );
    }

    /**
     * @test
     */
    public function setAnzahlForIntSetsAnzahl()
    {
        $this->subject->setAnzahl(12);

        self::assertAttributeEquals(
            12,
            'anzahl',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getEmailReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getEmail()
        );
    }

    /**
     * @test
     */
    public function setEmailForStringSetsEmail()
    {
        $this->subject->setEmail('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'email',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getStatusReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getStatus()
        );
    }

    /**
     * @test
     */
    public function setStatusForStringSetsStatus()
    {
        $this->subject->setStatus('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'status',
            $this->subject
        );
    }
}
