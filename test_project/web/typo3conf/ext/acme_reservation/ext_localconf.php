<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(function () {

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'WebitDe.AcmeReservation',
        'Reservaciaplugini',
        [
            'Main' => 'index, newSubscriber, newReservierung, create, edit, update, delete',
        ],
        // non-cacheable actions
        [
            'Main' => 'newSubscriber, newReservierung, update, delete',
        ]
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    reservaciaplugini {
                        iconIdentifier = acme_reservation-plugin-reservaciaplugini
                        title = LLL:EXT:acme_reservation/Resources/Private/Language/locallang_db.xlf:tx_acme_reservation_reservaciaplugini.name
                        description = LLL:EXT:acme_reservation/Resources/Private/Language/locallang_db.xlf:tx_acme_reservation_reservaciaplugini.description
                        tt_content_defValues {
                            CType = list
                            list_type = acmereservation_reservaciaplugini
                        }
                    }
                }
                show = *
            }
       }'
    );
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

    $iconRegistry->registerIcon(
        'acme_reservation-plugin-reservaciaplugini',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:acme_reservation/Resources/Public/Icons/user_plugin_reservaciaplugini.svg']
    );

});
