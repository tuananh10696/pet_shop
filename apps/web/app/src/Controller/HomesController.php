<?php

namespace App\Controller;

use Cake\Event\Event;
use App\Form\ContactForm;

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
        $this->slug = 'blog';
        $this->set('header_class', 'home');
    }


    public function index()
    {
        $options = [
            'limit' => 3,
            'paginate' => true
        ];
        $this->set('infos', $this->Cms->findAll($this->slug, $options));

        $param = $this->request->getQueryParams();
        extract($param);
        if (isset($param) && !empty($param)) {
            $contact = new ContactForm();
            $contact->_sendmail($param);
            $this->redirect(['action' => 'thanks']);
        };
    }

    public function thanks()
    {
        $options = [
            'limit' => 6,
            'paginate' => true
        ];
        $this->set('infos', $this->Cms->findAll($this->slug, $options));
    }
}
