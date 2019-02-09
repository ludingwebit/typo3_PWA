<?php

$TYPO3_CONF_VARS['FE']['addRootLineFields'] .= ',tx_realurl_pathsegment';

$TYPO3_CONF_VARS['EXTCONF']['realurl']['_DEFAULT'] = array(

    'pagePath' => array(

        'type' => 'user',

        'userFunc' => 'EXT:realurl/class.tx_realurl_advanced.php:&tx_realurl_advanced->main',

        'spaceCharacter' => '-',

        'languageGetVar' => 'L',

        'expireDays' => '3',

        'rootpage_id' => 3,

        'firstHitPathCache' => 1

    ),

    'init' => array(

        'enableCHashCache' => TRUE,

        'enableCHashCache' => 1,

        'respectSimulateStaticURLs' => 0,

        'enableUrlDecodeCache' => 1,

        'enableUrlEncodeCache' => 1

    ),

    'preVars' => [
        [
            'GETvar' => 'L',
            'valueMap' => [
                'en' => '1',
            ],
            'noMatch' => 'bypass',
        ],
    ],
    'fixedPostVars' => [
        'newsDetailConfiguration' => [
            [
                'GETvar' => 'tx_news_pi1[action]',
                'valueMap' => [
                    '' => 'detail',
                ],
                'noMatch' => 'bypass'
            ],
            [
                'GETvar' => 'tx_news_pi1[controller]',
                'valueMap' => [
                    '' => 'detail',
                ],
                'noMatch' => 'bypass'
            ],
            [
                'GETvar' => 'tx_news_pi1[news]',
                'lookUpTable' => [
                    'table' => 'tx_news_domain_model_news',
                    'id_field' => 'uid',
                    'alias_field' => 'IF(path_segment!="",path_segment,title)',
                    'addWhereClause' => ' AND NOT deleted',
                    'useUniqueCache' => 1,
                    'languageGetVar' => 'L',
                    'languageExceptionUids' => '',
                    'languageField' => 'sys_language_uid',
                    'transOrigPointerField' => 'l10n_parent',
                    'expireDays' => 180,
                    'enable404forInvalidAlias' => true
                ]
            ]
        ],
        'newsCategoryConfiguration' => [
            [
                'GETvar' => 'tx_news_pi1[overwriteDemand][categories]',
                'lookUpTable' => [
                    'table' => 'sys_category',
                    'id_field' => 'uid',
                    'alias_field' => 'title',
                    'addWhereClause' => ' AND NOT deleted',
                    'useUniqueCache' => 1,
                    'enable404forInvalidAlias' => true
                ]
            ]
        ],
        'newsTagConfiguration' => [
            [
                'GETvar' => 'tx_news_pi1[overwriteDemand][tags]',
                'lookUpTable' => [
                    'table' => 'tx_news_domain_model_tag',
                    'id_field' => 'uid',
                    'alias_field' => 'title',
                    'addWhereClause' => ' AND NOT deleted',
                    'useUniqueCache' => 1,
                    'enable404forInvalidAlias' => true
                ]
            ]
        ],
        '70' => 'newsDetailConfiguration',
        '701' => 'newsDetailConfiguration', // For additional detail pages, add their uid as well
        '71' => 'newsTagConfiguration',
        '72' => 'newsCategoryConfiguration',
    ],

    'postVarSets' => [
        '_DEFAULT' => [
            'controller' => [
                [
                    'GETvar' => 'tx_news_pi1[action]',
                    'noMatch' => 'bypass'
                ],
                [
                    'GETvar' => 'tx_news_pi1[controller]',
                    'noMatch' => 'bypass'
                ]
            ],

            'dateFilter' => [
                [
                    'GETvar' => 'tx_news_pi1[overwriteDemand][year]',
                ],
                [
                    'GETvar' => 'tx_news_pi1[overwriteDemand][month]',
                ],
            ],
            'page' => [
                [
                    'GETvar' => 'tx_news_pi1[@widget_0][currentPage]',
                ],
            ],
        ],
    ],


// configure filenames for different pagetypes

    'fileName' => array(

        'defaultToHTMLsuffixOnPrev' => 1,

        'index' => array(

            'print.html' => array(

                'keyValues' => array(

                    'type' => 98,

                ),

            ),

            'rss.xml' => array(

                'keyValues' => array(

                    'type' => 100,

                ),

            ),

            'rss091.xml' => array(

                'keyValues' => array(

                    'type' => 101,

                ),

            ),

            'rdf.xml' => array(

                'keyValues' => array(

                    'type' => 102,

                ),

            ),

            'atom.xml' => array(

                'keyValues' => array(

                    'type' => 103,

                ),

            ),

        ),

    ),

);

?>