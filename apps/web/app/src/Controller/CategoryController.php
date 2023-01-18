<?php

namespace App\Controller;

use App\Controller\AppController;


class CategoryController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->loadComponent('Cms');

        $this->modelName = 'Infos';
        $this->{$this->modelName} = $this->getTableLocator()->get($this->modelName);
        $this->slug = 'news';
        parent::beforeFilter($event);
    }

    public function index()
    {
        $this->setList();
        $this->setHeadTitle('Tin tức Nhật-Việt');
        $this->set('__description__', 'Kênh thông tin và chia sẻ Nhật- Việt');

        $category_id = $this->request->getQuery('category_id');
        $this->set('category_id', $category_id ?? 0);

        $options = [
            'limit' => 1,
            'paginate' => true,
            'contain' => [
                'PageConfigs',
                'Categories',
                'InfoAppendItems'
            ]
        ];

        if ($category_id) $options['append_cond']['Categories.id'] = intval($category_id);

        $this->set('infos', $this->Cms->findAll($this->slug, $options));

    }


    public function detail($id = null)
    {
        $this->setHeadTitle('Tin tức Nhật-Việt');
        $this->set('__description__', 'Kênh thông tin và chia sẻ Nhật- Việt');

        $info_array = $this->Cms->findFirst($this->slug, $id);
        if (is_null($info_array)) return $this->redirect(['action' => 'index']);
        $info = $info_array['info'] ?? [];
        extract($info_array);

        $this->set(compact('contents', 'info'));

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
