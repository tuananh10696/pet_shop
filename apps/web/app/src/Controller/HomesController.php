<?php

namespace App\Controller;

use Cake\Event\Event;

class HomesController extends AppController
{


    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Cms');
    }


    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->slug = 'news';
    }


    public function index()
    {
        $this->setList();
        $this->setHeadTitle('Share Life Style Pages');
        $this->set('__description__', 'Trang chia sẻ thông tin Nhật Bản');

        $category_id = $this->request->getQuery('category_id');
        $this->set('category_id', $category_id ?? 0);

        // $options = [
        //     ''
        // ];
    }

    public function setList()
    {
        $list = [];

        $list['category'] = $this->loadModel('Categories')
            ->find('all')
            ->where([
                'Categories.status' => 'publish',
                'PageConfigs.slug' => $this->slug
            ])
            ->contain('PageConfigs')
            ->order('Categories.position ASC')
            ->toArray();


        if (!empty($list)) $this->set(array_keys($list), $list);
        return $list;
    }
}
