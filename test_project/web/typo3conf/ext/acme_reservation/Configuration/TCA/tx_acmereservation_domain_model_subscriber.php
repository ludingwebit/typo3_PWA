<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:acme_reservation/Resources/Private/Language/locallang_db.xlf:tx_acmereservation_domain_model_subscriber',
        'label' => 'endpoint',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'endpoint,browser_key,auth_secret,subscribed_at,unsubscribed_at,enabled',
        'iconfile' => 'EXT:acme_reservation/Resources/Public/Icons/tx_acmereservation_domain_model_subscriber.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, endpoint, browser_key, auth_secret, subscribed_at, unsubscribed_at, enabled',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, endpoint, browser_key, auth_secret, subscribed_at, unsubscribed_at, enabled, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ]
                ],
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_acmereservation_domain_model_subscriber',
                'foreign_table_where' => 'AND tx_acmereservation_domain_model_subscriber.pid=###CURRENT_PID### AND tx_acmereservation_domain_model_subscriber.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/Resources/Private/Language/locallang_core.xlf:labels.enabled'
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'behaviour' => [
                'allowLanguageSynchronization' => true
            ],
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'behaviour' => [
                'allowLanguageSynchronization' => true
            ],
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
            ],
        ],

        'endpoint' => [
            'exclude' => true,
            'label' => 'LLL:EXT:acme_reservation/Resources/Private/Language/locallang_db.xlf:tx_acmereservation_domain_model_subscriber.endpoint',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'browser_key' => [
            'exclude' => true,
            'label' => 'LLL:EXT:acme_reservation/Resources/Private/Language/locallang_db.xlf:tx_acmereservation_domain_model_subscriber.browser_key',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'auth_secret' => [
            'exclude' => true,
            'label' => 'LLL:EXT:acme_reservation/Resources/Private/Language/locallang_db.xlf:tx_acmereservation_domain_model_subscriber.auth_secret',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'subscribed_at' => [
            'exclude' => true,
            'label' => 'LLL:EXT:acme_reservation/Resources/Private/Language/locallang_db.xlf:tx_acmereservation_domain_model_subscriber.subscribed_at',
            'config' => [
                'dbType' => 'datetime',
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 12,
                'eval' => 'datetime',
                'default' => null,
            ],
        ],
        'unsubscribed_at' => [
            'exclude' => true,
            'label' => 'LLL:EXT:acme_reservation/Resources/Private/Language/locallang_db.xlf:tx_acmereservation_domain_model_subscriber.unsubscribed_at',
            'config' => [
                'dbType' => 'datetime',
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 12,
                'eval' => 'datetime',
                'default' => null,
            ],
        ],
        'enabled' => [
            'exclude' => true,
            'label' => 'LLL:EXT:acme_reservation/Resources/Private/Language/locallang_db.xlf:tx_acmereservation_domain_model_subscriber.enabled',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/Resources/Private/Language/locallang_core.xlf:labels.enabled'
                    ]
                ],
                'default' => 0,
            ]
            
        ],
    
    ],
];
