<?php

namespace App\Controller;

use App\Controller\AppController;


class BlogController extends AppController
{


    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->loadComponent('Cms');

        $this->modelName = 'Infos';
        $this->{$this->modelName} = $this->getTableLocator()->get($this->modelName);
        $this->slug = 'blog';
        parent::beforeFilter($event);

        $this->setHeadTitle('Tin Tức ');
        $this->set('header_class', 'blog');
    }

    public function index()
    {
        $param = $this->request->getQueryParams();
        extract($param);

        if (isset($category) && $category != '') $cond['Infos.category_id'] = intval($category);
        $options = [
            'limit' => 10,
            'paginate' => true,
            'append_cond' => @$cond,
        ];

        $this->set('infos', $this->Cms->findAll($this->slug, $options));
        $this->set('search_category_id', isset($category) && $category != '' ? $category : '');
    }


    public function detail($id = null)
    {
        $this->setList();
        $options = [
            'limit' => 10,
            'paginate' => true
        ];

        $info_array = $this->Cms->findFirst($this->slug, $id);
        if (is_null($info_array)) return $this->redirect(['action' => 'index']);
        $info = $info_array['info'] ?? [];
        extract($info_array);

        $this->set(compact('contents', 'info'));
        $this->set('infos', $this->Cms->findAll($this->slug, $options));
        $this->set('lq_blog', $this->Cms->findAll($this->slug, $options += ['append_cond' => ['Infos.id !=' => $id]]));
        $this->set('category', $this->setList());
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
            ->contain(['PageConfigs', 'Infos'])
            ->order('Categories.position ASC')
            ->toArray();

        if (!empty($list)) $this->set(array_keys($list), $list);
        return $list;
    }
}
