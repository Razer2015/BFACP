<?php

return [
    'main'  => [
        'title' => 'Navigationsleiste',
        'items' => [
            'dashboard'  => [
                'title' => 'Übersicht',
                'icon'  => [
                    'fa'  => 'fa-dashboard',
                    'ion' => null,
                ],
            ],
            'chatlogs'   => [
                'title' => 'Chatlogs',
                'icon'  => [
                    'fa'  => 'fa-comments',
                    'ion' => null,
                ],
            ],
            'servers' => [
                'title' => 'Server',
                'scoreboard'  => [
                    'title' => 'Live-Punkteübersicht',
                    'icon'  => [
                        'fa'  => 'fa-server',
                        'ion' => null,
                    ],
                ],
                'list'  => [
                    'title' => 'Serverübersicht',
                    'icon'  => [
                        'fa'  => 'fa-list',
                        'ion' => null,
                    ],
                ]
            ],
            'playerlist' => [
                'title' => 'Spielerübersicht',
                'icon'  => [
                    'fa'  => 'fa-users',
                    'ion' => null,
                ],
            ],
        ],
    ],
    'admin' => [
        'site'   => [
            'title' => 'Webadmin-Einstellungen',
            'items' => [
                'users'    => [
                    'title' => 'Benutzer',
                    'icon'  => [
                        'fa'  => 'fa-users',
                        'ion' => null,
                    ],
                    'items' => [
                        'edit' => [
                            'title' => 'Bearbeite Benutzer #:id',
                        ],
                    ],
                ],
                'roles'    => [
                    'title' => 'Rollen',
                    'icon'  => [
                        'fa'  => 'fa-list-ol',
                        'ion' => null,
                    ],
                    'items' => [
                        'edit'   => [
                            'title' => 'Bearbeite :name Rolle',
                        ],
                        'create' => [
                            'title' => 'Erstelle neue Rolle',
                        ],
                    ],
                ],
                'settings' => [
                    'title' => 'Einstellungen',
                    'icon'  => [
                        'fa'  => 'fa-cogs',
                        'ion' => null,
                    ],
                    'items' => [],
                ],
                'servers'  => [
                    'title' => 'Server',
                    'icon'  => [
                        'fa'  => 'fa-server',
                        'ion' => null,
                    ],
                    'items' => [
                        'edit' => 'Editing :servername',
                    ],
                ],
                'updater'  => [
                    'title' => 'Updater',
                    'icon'  => [
                        'fa'  => 'fa-wrench',
                        'ion' => null,
                    ],
                    'items' => [],
                ],
            ],
        ],
        'adkats' => [
            'title' => 'AdKats Einstellungen',
            'items' => [

                'banlist'         => [
                    'title' => 'Bannliste',
                    'icon'  => [
                        'fa'  => null,
                        'ion' => 'ion-hammer',
                    ],
                    'items' => [
                        'edit' => [
                            'title' => 'Bearbeite Bann #:id',
                        ],
                    ],
                ],
                'users'           => [
                    'title' => 'Benutzer',
                    'icon'  => [
                        'fa'  => 'fa-users',
                        'ion' => null,
                    ],
                    'items' => [
                        'edit' => [
                            'title' => 'Bearbeite Benutzer #:id',
                        ],
                    ],
                ],
                'special_players' => [
                    'title' => 'Specialplayers',
                    'icon'  => [
                        'fa'  => 'fa-users',
                        'ion' => null,
                    ],
                    'items' => [
                        'edit' => [
                            'title' => 'Bearbeite Special Player #:id',
                        ],
                    ],
                ],
                'infractions' => [
                    'title' => 'Infractions',
                    'icon'  => [
                        'fa'  => 'fa-users',
                        'ion' => null,
                    ],
                    'items' => [
                        'edit' => [
                            'title' => 'Editing Special Player #:id',
                        ],
                    ],
                ],
            ],
        ],
    ],
];
