<?php
namespace WebitDe\AcmeReservation\Domain\Model;
/**
 * Reservierung
 */
class Reservierung extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * name
     * 
     * @var string
     */
    protected $name = '';

    /**
     * datum
     * 
     * @var string
     */
    protected $datum = '';

    /**
     * zeit
     * 
     * @var string
     */
    protected $zeit = '';

    /**
     * anzahl
     * 
     * @var int
     */
    protected $anzahl = 0;

    /**
     * email
     * 
     * @var string
     */
    protected $email = '';

    /**
     * status
     * 
     * @var string
     */
    protected $status = '';

    /**
     * Returns the name
     * 
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     * 
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the datum
     * 
     * @return string $datum
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * Sets the datum
     * 
     * @param string $datum
     * @return void
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;
    }

    /**
     * Returns the zeit
     *
     * @param string $zeit
     * @return string $zeit
     */
    public function getZeit()
    {
        return $this->zeit;
    }

    /**
     * Sets the zeit
     *
     * @param string $zeit
     * @return void
     */
    public function setZeit($zeit)
    {
        $this->zeit = $zeit;
    }

    /**
     * Returns the anzahl
     * 
     * @return int $anzahl
     */
    public function getAnzahl()
    {
        return $this->anzahl;
    }

    /**
     * Sets the anzahl
     * 
     * @param int $anzahl
     * @return void
     */
    public function setAnzahl($anzahl)
    {
        $this->anzahl = $anzahl;
    }

    /**
     * Returns the email
     * 
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the email
     * 
     * @param string $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Returns the status
     * 
     * @return string $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the status
     * 
     * @param string $status
     * @return void
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}
