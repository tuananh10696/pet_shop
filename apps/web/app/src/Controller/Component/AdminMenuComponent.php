<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

/**
 * OutputHtml component
 */
class AdminMenuComponent extends Component
{
    public $menu_list = [];


    public function initialize(array $config)
    {
        $this->Controller = $this->_registry->getController();
        $this->Session = $this->Controller->getRequest()->getSession();
    }


    public function init()
    {
        if (!$this->Session->check('admin_menu.menu_list')) {
            $this->menu_list = [
                'main' => [
                    [
                        'title' => 'コンテンツ',
                        'role' => ['role_type' => 'staff'],
                        'buttons' => $this->setContent('main'),
                    ],
                    [
                        'title' => __('各種設定'),
                        'role' => ['role_type' => 'develop'],
                        'buttons' => [
                            ['name' => __('コンテンツ設定'), 'link' => '/user_admin/page-configs/', 'role' => ['role_type' => 'develop']],
                            ['name' => __('定数管理'), 'link' => '/user_admin/mst-lists/', 'role' => ['role_type' => 'admin']],
                            ['name' => __('カレンダー'), 'link' => '/user_admin/schedules/', 'role' => ['role_type' => 'admin']],
                        ]
                    ]
                ],
                'side' => [
                    [
                         'title' => 'コンテンツ',
                         'role' => [ 'role_type' => 'staff' ],
                         'buttons' => $this->setContent('main', [])
                    ],
                    [
                        'title' => __('各種設定'),
                        'role' => ['role_type' => 'develop'],
                        'buttons' => [
                            ['name' => __('コンテンツ設定'), 'link' => '/user_admin/page-configs/', 'role' => ['role_type' => 'develop']],
                            ['name' => __('定数管理'), 'link' => '/user_admin/mst-lists/', 'role' => ['role_type' => 'develop']],
                            ['name' => __('カレンダー'), 'link' => '/user_admin/schedules/', 'role' => ['role_type' => 'admin']],
                            ['name' => 'メニューリロード', 'link' => '/user_admin/menu-reload', 'position' => 'right', 'icon' => 'fas fa-sync-alt']
                        ]
                    ],
                ]

            ];

            $this->Session->write('admin_menu.menu_list', $this->menu_list);
        }

        $this->menu_list = $this->Session->read('admin_menu.menu_list');
    }


    public function reload()
    {
        $this->Session->delete('admin_menu.menu_list');
        $this->init();
    }


    public function setContent($type = 'main', $append_menus = [])
    {
        $this->PageConfigs = $this->Controller->loadModel('PageConfigs');
        $this->Users = $this->Controller->loadModel('Users');

        $content_buttons = [];

        $page_configs = $this->PageConfigs->find()
            ->where(['is_auto_menu' => 1])
            ->order(['PageConfigs.position' => 'ASC'])
            ->toArray();

        if (!empty($page_configs))

            if ($type == 'main')

                foreach ($page_configs as $config)
                    $content_buttons[] =  [
                        'name' => $config->page_title,
                        'link' => '/user_admin/infos/?sch_page_id=' . $config->id
                    ];

            elseif ($type == 'side')

                foreach ($page_configs as $config)
                    $content_buttons[] = [
                        'name' => $config->page_title,
                        'subMenu' => [
                            ['name' => __('新規登録'), 'link' => '/infos/edit/0?sch_page_id=' . $config->id],
                            ['name' => __('一覧'), 'link' => '/infos/?sch_page_id=' . $config->id]
                        ]
                    ];

        foreach ($append_menus as $menu)
            $content_buttons[] = $menu;

        return $content_buttons;
    }
}
