<?php
return [
    'BE' => [
        'debug' => true,
        'explicitADmode' => 'explicitAllow',
        'installToolPassword' => '$pbkdf2-sha256$25000$a/K5vDVC779P1FQJ0YZ5eg$nY3shSH1uh1Rv86IKiVfPMFaUgrYfVYeAuK2lmGpgVE',
        'loginSecurityLevel' => 'normal',
    ],
    'DB' => [
        'Connections' => [
            'Default' => [
                'charset' => 'utf8',
                'dbname' => 'typo3_db',
                'driver' => 'mysqli',
                'host' => '127.0.0.1',
                'password' => 'xDxXDbK9UhYl8scD',
                'port' => 3306,
                'user' => 'typo3_user',
            ],
        ],
    ],
    'EXT' => [
        'extConf' => [
            'acme_reservation' => 'a:0:{}',
            'css_styled_content' => 'a:0:{}',
            'extension_builder' => 'a:3:{s:15:"enableRoundtrip";s:1:"1";s:15:"backupExtension";s:1:"1";s:9:"backupDir";s:35:"uploads/tx_extensionbuilder/backups";}',
            'go_maps_ext' => 'a:3:{s:15:"include_library";s:1:"0";s:16:"include_manually";s:1:"1";s:8:"footerJS";s:1:"1";}',
            'maps2' => 'a:20:{s:17:"googleMapsLibrary";s:62:"https://maps.googleapis.com/maps/api/js?key=|&libraries=places";s:26:"googleMapsJavaScriptApiKey";s:39:"AIzaSyBvQNb0hkcnBkfpVL1--9Pyd48MwjXAG18";s:23:"googleMapsGeocodeApiKey";s:39:"AIzaSyBvQNb0hkcnBkfpVL1--9Pyd48MwjXAG18";s:23:"explicitAllowGoogleMaps";s:1:"0";s:36:"explicitAllowGoogleMapsBySessionOnly";s:1:"0";s:14:"defaultCountry";s:11:"Deutschland";s:15:"defaultLatitude";s:0:"";s:16:"defaultLongitude";s:0:"";s:13:"defaultRadius";s:3:"250";s:29:"infoWindowContentTemplatePath";s:60:"EXT:maps2/Resources/Private/Templates/InfoWindowContent.html";s:20:"allowMapTemplatePath";s:55:"EXT:maps2/Resources/Private/Templates/AllowMapForm.html";s:11:"strokeColor";s:7:"#FF0000";s:13:"strokeOpacity";s:3:"0.8";s:12:"strokeWeight";s:1:"2";s:9:"fillColor";s:7:"#FF0000";s:11:"fillOpacity";s:4:"0.35";s:15:"markerIconWidth";s:2:"25";s:16:"markerIconHeight";s:2:"40";s:20:"markerIconAnchorPosX";s:2:"13";s:20:"markerIconAnchorPosY";s:2:"40";}',
            'news' => 'a:17:{s:13:"prependAtCopy";s:1:"1";s:6:"tagPid";s:1:"1";s:12:"rteForTeaser";s:1:"0";s:22:"contentElementRelation";s:1:"1";s:21:"contentElementPreview";s:1:"1";s:13:"manualSorting";s:1:"0";s:19:"categoryRestriction";s:4:"none";s:34:"categoryBeGroupTceFormsRestriction";s:1:"0";s:19:"dateTimeNotRequired";s:1:"0";s:11:"archiveDate";s:4:"date";s:12:"mediaPreview";s:1:"1";s:20:"advancedMediaPreview";s:1:"1";s:24:"showAdministrationModule";s:1:"1";s:35:"hidePageTreeForAdministrationModule";s:1:"0";s:12:"showImporter";s:1:"0";s:18:"storageUidImporter";s:1:"1";s:22:"resourceFolderImporter";s:12:"/news_import";}',
            'realurl' => 'a:6:{s:10:"configFile";s:26:"typo3conf/realurl_conf.php";s:14:"enableAutoConf";s:1:"0";s:14:"autoConfFormat";s:1:"0";s:17:"segTitleFieldList";s:0:"";s:12:"enableDevLog";s:1:"0";s:10:"moduleIcon";s:1:"0";}',
            'rest_reserve_sub_ext' => 'a:0:{}',
            'rsaauth' => 'a:1:{s:18:"temporaryDirectory";s:0:"";}',
            'saltedpasswords' => 'a:2:{s:3:"BE.";a:4:{s:21:"saltedPWHashingMethod";s:41:"TYPO3\\CMS\\Saltedpasswords\\Salt\\Pbkdf2Salt";s:11:"forceSalted";i:0;s:15:"onlyAuthService";i:0;s:12:"updatePasswd";i:1;}s:3:"FE.";a:5:{s:7:"enabled";i:1;s:21:"saltedPWHashingMethod";s:41:"TYPO3\\CMS\\Saltedpasswords\\Salt\\Pbkdf2Salt";s:11:"forceSalted";i:0;s:15:"onlyAuthService";i:0;s:12:"updatePasswd";i:1;}}',
            'scheduler' => 'a:4:{s:11:"maxLifetime";s:4:"1440";s:11:"enableBELog";s:1:"1";s:15:"showSampleTasks";s:1:"1";s:11:"useAtdaemon";s:1:"0";}',
            'templavoilaplus' => 'a:4:{s:3:"ds.";a:1:{s:11:"indentation";s:1:"0";}s:7:"enable.";a:3:{s:13:"oldPageModule";s:1:"0";s:19:"selectDataStructure";s:1:"0";s:15:"renderFCEHeader";s:1:"0";}s:9:"staticDS.";a:3:{s:6:"enable";s:1:"0";s:8:"path_fce";s:27:"fileadmin/templates/ds/fce/";s:9:"path_page";s:28:"fileadmin/templates/ds/page/";}s:13:"updateMessage";s:1:"0";}',
        ],
    ],
    'EXTCONF' => [
        'lang' => [
            'availableLanguages' => [
                'de',
            ],
        ],
    ],
    'FE' => [
        'debug' => true,
        'loginSecurityLevel' => 'normal',
    ],
    'GFX' => [
        'jpg_quality' => '80',
    ],
    'MAIL' => [
        'transport' => 'smtp',
        'transport_sendmail_command' => '',
        'transport_smtp_encrypt' => '',
        'transport_smtp_password' => '',
        'transport_smtp_server' => 'localhost:25',
        'transport_smtp_username' => '',
    ],
    'SYS' => [
        'caching' => [
            'cacheConfigurations' => [
                'extbase_object' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                    'frontend' => 'TYPO3\\CMS\\Core\\Cache\\Frontend\\VariableFrontend',
                    'groups' => [
                        'system',
                    ],
                    'options' => [
                        'defaultLifetime' => 0,
                    ],
                ],
            ],
        ],
        'devIPmask' => '127.0.0.1',
        'displayErrors' => 1,
        'enableDeprecationLog' => false,
        'encryptionKey' => '224999ad924d06030f8d71fbfaa4763edad02a471c6d259e43e17c9b54b01f2e802744c8cd04537dd96749beba2122d8',
        'exceptionalErrors' => 20480,
        'isInitialDatabaseImportDone' => true,
        'isInitialInstallationInProgress' => false,
        'sitename' => 'webit-test',
        'sqlDebug' => 0,
        'systemLogLevel' => 2,
    ],
];
