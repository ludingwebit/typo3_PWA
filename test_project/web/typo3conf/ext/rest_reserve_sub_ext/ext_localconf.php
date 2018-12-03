<?php
defined('TYPO3_MODE') || die('Access denied.');


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Ludingwebit'.$_EXTKEY,
    'Reservesub',
    [
        'Beispiel' => 'list',
    ],
    // non-cacheable actions
    [
        'Beispiel' => 'list',
    ]
);

// wizards
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    reservesub {
                        iconIdentifier = rest_reserve_sub_ext-plugin-reservesub
                        title = LLL:EXT:rest_reserve_sub_ext/Resources/Private/Language/locallang_db.xlf:tx_rest_reserve_sub_ext_reservesub.name
                        description = LLL:EXT:rest_reserve_sub_ext/Resources/Private/Language/locallang_db.xlf:tx_rest_reserve_sub_ext_reservesub.description
                        tt_content_defValues {
                            CType = list
                            list_type = restreservesubext_reservesub
                        }
                    }
                }
                show = *
            }
       }'
);
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

$iconRegistry->registerIcon(
    'rest_reserve_sub_ext-plugin-reservesub',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:rest_reserve_sub_ext/Resources/Public/Icons/user_plugin_reservesub.svg']
);
		


