<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('reservierung_ext', 'Configuration/TypoScript', 'Reservierung');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_reservierungext_domain_model_default', 'EXT:reservierung_ext/Resources/Private/Language/locallang_csh_tx_reservierungext_domain_model_default.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_reservierungext_domain_model_default');

    }
);
