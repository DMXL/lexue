<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 13/07/16
 * Time: 4:18 PM
 */

return [
    'bct' => [
        'teachers' => [
            [
                'title' => '课程',
                'route' => 'lectures.index',
            ],
            [
                'title' => '设置',
                'route' => 'settings.index',
                'children' => [
                    [
                        'route' => 'settings.profile.edit',
                        'title' => '个人资料'
                    ]
                ]
            ]
        ],

        'admins' => [
            [
                'title' => '所有教师',
                'route' => 'teachers.index',
                'children' => [
                    [
                        'title' => '新建教师',
                        'route' => 'teachers.create'
                    ], [
                        'title' => '修改教师',
                        'route' => 'teachers.edit'
                    ]
                ]
            ], [
                'title' => '所有课程',
                'route' => 'lectures.index',
                'children' => [
                    [
                        'title' => '新建课程',
                        'route' => 'lectures.create'
                    ], [
                        'title' => '修改课程',
                        'route' => 'lectures.edit'
                    ]
                ]
            ]
        ]
    ],

    'menu' => [
        'admins' => [
            [
                'title' => '教师管理',
                'route' => 'teachers.index'
            ],
            [
                'title' => '课程',
                'route' => 'lectures.index'
            ],
        ],
    ],
];