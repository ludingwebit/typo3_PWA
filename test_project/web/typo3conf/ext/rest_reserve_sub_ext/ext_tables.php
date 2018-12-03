<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Ludingwebit.RestReserveSubExt',
            'Reservesub',
            'Restaurant_webit_Ext'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('rest_reserve_sub_ext', 'Configuration/TypoScript', 'Reservierung Sub Ext');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_restreservesubext_domain_model_beispiel', 'EXT:rest_reserve_sub_ext/Resources/Private/Language/locallang_csh_tx_restreservesubext_domain_model_beispiel.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_restreservesubext_domain_model_beispiel');

    }
);
