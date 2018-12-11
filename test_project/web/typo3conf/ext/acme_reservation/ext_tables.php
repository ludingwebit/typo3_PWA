<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'WebitDe.AcmeReservation',
            'Reservaciaplugini',
            'Reservierung'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('acme_reservation', 'Configuration/TypoScript', 'Acme Reservation');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_acmereservation_domain_model_subscriber', 'EXT:acme_reservation/Resources/Private/Language/locallang_csh_tx_acmereservation_domain_model_subscriber.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_acmereservation_domain_model_subscriber');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_acmereservation_domain_model_reservierung', 'EXT:acme_reservation/Resources/Private/Language/locallang_csh_tx_acmereservation_domain_model_reservierung.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_acmereservation_domain_model_reservierung');

    }
);
