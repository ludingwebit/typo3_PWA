<?php
namespace WebitDe\AcmeReservation\Domain\Model;

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
     * @var \DateTimeInterface
     */
    protected $datum = null;

    /**
     * zeit
     * 
     * @var \DateTimeInterface
     */
    protected $zeit = 0;

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
     * @return \DateTimeInterface $datum
     */
    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    /**
     * Sets the datum
     * 
     * @param \DateTimeInterface $datum
     * @return void
     */
    public function setDatum(\DateTimeInterface $datum): self
    {
        $this->datum = $datum;
    }

    /**
     * Returns the zeit
     *
     * @param \DateTimeInterface $zeit
     * @return \DateTimeInterface $zeit
     */
    public function getZeit()
    {
        return $this->zeit;
    }

    /**
     * Sets the zeit
     *
     * @param \DateTimeInterface $zeit
     * @return void
     */
    public function setZeit(\DateTimeInterface $zeit): self
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
