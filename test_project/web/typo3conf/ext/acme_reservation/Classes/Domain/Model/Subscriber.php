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
 * Subscriber
 */
class Subscriber extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * endpoint
     *
     * @var string
     */
    protected $endpoint = '';

    /**
     * browserKey
     *
     * @var string
     */
    protected $browserKey = '';

    /**
     * authSecret
     *
     * @var string
     */
    protected $authSecret = '';

    /**
     * subscribedAt
     *
     * @var \DateTime
     */
    protected $subscribedAt = null;

    /**
     * unsubscribedAt
     *
     * @var \DateTime
     */
    protected $unsubscribedAt = null;

    /**
     * enabled
     *
     * @var bool
     */
    protected $enabled = false;

    /**
     * Returns the endpoint
     *
     * @return string $endpoint
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * Sets the endpoint
     *
     * @param string $endpoint
     * @return void
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * Returns the browserKey
     *
     * @return string $browserKey
     */
    public function getBrowserKey()
    {
        return $this->browserKey;
    }

    /**
     * Sets the browserKey
     *
     * @param string $browserKey
     * @return void
     */
    public function setBrowserKey($browserKey)
    {
        $this->browserKey = $browserKey;
    }

    /**
     * Returns the authSecret
     *
     * @return string $authSecret
     */
    public function getAuthSecret()
    {
        return $this->authSecret;
    }

    /**
     * Sets the authSecret
     *
     * @param string $authSecret
     * @return void
     */
    public function setAuthSecret($authSecret)
    {
        $this->authSecret = $authSecret;
    }

    /**
     * Returns the subscribedAt
     *
     * @return \DateTime $subscribedAt
     */
    public function getSubscribedAt()
    {
        return $this->subscribedAt;
    }

    /**
     * Sets the subscribedAt
     *
     * @param \DateTime $subscribedAt
     * @return void
     */
    public function setSubscribedAt(\DateTime $subscribedAt)
    {
        $this->subscribedAt = $subscribedAt;
    }

    /**
     * Returns the unsubscribedAt
     *
     * @return \DateTime $unsubscribedAt
     */
    public function getUnsubscribedAt()
    {
        return $this->unsubscribedAt;
    }

    /**
     * Sets the unsubscribedAt
     *
     * @param \DateTime $unsubscribedAt
     * @return void
     */
    public function setUnsubscribedAt(\DateTime $unsubscribedAt)
    {
        $this->unsubscribedAt = $unsubscribedAt;
    }

    /**
     * Returns the enabled
     *
     * @return bool $enabled
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Sets the enabled
     *
     * @param bool $enabled
     * @return void
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * Returns the boolean state of enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }
}
