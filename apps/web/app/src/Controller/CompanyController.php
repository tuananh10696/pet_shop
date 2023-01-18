<?php

namespace App\Controller;

use App\Controller\AppController;


class CompanyController extends AppController
{

    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->loadComponent('Cms');

        $this->modelName = 'Infos';
        $this->{$this->modelName} = $this->getTableLocator()->get($this->modelName);
        parent::beforeFilter($event);
    }


    public function index()
    {
        $this->setHeadTitle('企業情報');
        $this->set('__description__', 'アトムエンジニアリングの企業情報を掲載しています。');
        $today = new \DateTime();
        $options = [
            'limit' => false,
            'paginate' => false,
            'contain' => ['PageConfigs', 'InfoContents', 'InfoAppendItems'],
            'append_cond' => ['Infos.start_datetime <=' => $today]
        ];

        $this->set('infos', $this->Cms->findAll(STAFF, $options));
    }


    public function detail($id = null)
    {
        $info_array = $this->Cms->findFirst(STAFF, $id);
        if (is_null($info_array)) return $this->redirect(['action' => 'index']);
        $info = $info_array['info'] ?? [];
        extract($info_array);

        $this->set(compact('contents', 'info'));
    }
}
