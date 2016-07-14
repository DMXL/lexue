<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 13/07/16
 * Time: 4:18 PM
 */

return [
    'teachers' => [
        'lectures.index' => [
            'title' => '课程',
        ],
        'settings.index' => [
            'title' => '设置',
            'children' => [
                'settings.profile.edit' => [
                    'title' => '个人资料'
                ]
            ]
        ]
    ]
];