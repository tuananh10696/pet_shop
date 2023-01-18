<?php

namespace App\Controller;

use App\Controller\AppController;


class StaffController extends AppController
{

    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->loadComponent('Cms');
        $this->modelName = 'Infos';
        $this->{$this->modelName} = $this->getTableLocator()->get($this->modelName);
        $this->slug = 'staff';
        parent::beforeFilter($event);
    }


    public function index()
    {
        $this->redirect('/company');
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
