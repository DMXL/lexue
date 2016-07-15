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
                        'title' => '添加教师',
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
                        'title' => '添加课程',
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
                'route' => 'teachers.index',
                'children' => [
                    [
                        'title' => '添加教师',
                        'route' => 'teachers.create',
                        'hidden' => true,
                    ], [
                        'title' => '修改教师',
                        'route' => 'teachers.edit',
                        'hidden' => true,
                    ], [
                        'title' => '教师信息',
                        'route' => 'teachers.show',
                        'hidden' => true,
                    ]
                ]
            ],
            [
                'title' => '课程管理',
                'route' => 'lectures.index'
            ],
        ],
    ],
];