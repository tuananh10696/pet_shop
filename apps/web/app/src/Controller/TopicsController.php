<?php

namespace App\Controller;

use App\Controller\AppController;


class TopicsController extends AppController
{


    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->loadComponent('Cms');

        $this->modelName = 'Infos';
        $this->{$this->modelName} = $this->getTableLocator()->get($this->modelName);
        $this->slug = TOPICS;
        parent::beforeFilter($event);

        $this->setHeadTitle('新着情報');
        $this->set('__description__', 'アトムエンジニアリングの新着情報一覧です。当社からのご案内、展示会、セミナー情報、サイト更新のお知らせなど新着情報をご案内いたします。アトムエンジニアリングはお客様の業務改善をトータルでサポートいたします。');
    }


    public function index()
    {
        $options = [
            'limit' => 10,
            'paginate' => true
        ];

        $this->set('infos', $this->Cms->findAll($this->slug, $options));
    }


    public function detail($id = null)
    {
        $info_array = $this->Cms->findFirst($this->slug, $id);
        if (is_null($info_array)) return $this->redirect(['action' => 'index']);
        $info = $info_array['info'] ?? [];
        extract($info_array);

        $this->set(compact('contents', 'info'));
    }
}
