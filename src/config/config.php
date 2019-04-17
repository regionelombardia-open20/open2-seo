<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\seo
 * @category   CategoryName
 */
return [
    'config' => [
        'metaRobotsList' => [
            'noindex',
            'nofollow',
            'nosnippet',
            'noarchive',
            'unavailable_after',
            'noimageindex'
        ],
        'metaGooglebotList' => [
            'noindex',
            'nofollow',
            'nosnippet',
            'noarchive',
            'unavailable_after',
            'noimageindex'
        ],
        'modulesEnabled' => [// TODO da capire se possiamo recuperarli in altra maniera
            'lispa\amos\news\AmosNews',
            'lispa\amos\discussioni\AmosDiscussioni',
        ],
    ],
    'params' => [
        //active the search
        'searchParams' => [
        ],
        //active the order
        'orderParams' => [
        ],
    ]
];
