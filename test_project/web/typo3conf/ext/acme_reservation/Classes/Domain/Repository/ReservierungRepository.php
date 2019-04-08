<?php

namespace WebitDe\AcmeReservation\Domain\Repository;


use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;

class ReservierungRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * Initialize
     */
    public function initializeObject()
    {
        $defaultQuerySettings = $this->objectManager->get(Typo3QuerySettings::class);
        $defaultQuerySettings->setRespectStoragePage(false);
        $this->setDefaultQuerySettings($defaultQuerySettings);
    }
}