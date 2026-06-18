<?php

return [
    'install' => [
        'commands' => [
            // [
            //     'name' => 'app:npmbuild',
            //     'description' => 'Build frontend assets',
            //     'risk' => 'low',
            // ],
        ],

        'migrations' => [
            '2025_12_28_202444_InvoiceOutExtras.php',
        ],
    ],

    'uninstall' => [
        'commands' => [
            // [
            //     'name' => 'app:npmbuild',
            //     'description' => 'Rebuild frontend after uninstall',
            //     'risk' => 'low',
            // ],
        ],

        'migrations' => [
            // rollback handled by core
            '2025_12_28_202444_InvoiceOutExtras.php',
        ],
    ],
];
