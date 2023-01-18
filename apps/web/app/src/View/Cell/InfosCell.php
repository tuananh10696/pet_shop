<?php
namespace App\View\Cell;

use App\Model\Entity\Item;
use Cake\View\Cell;

class InfosCell extends Cell
{

    public function display()
    {
//        $this->loadModel('Messages');
//        $unread = $this->Messages->find('unread');
//        $this->set('unread_count', $unread->count());
    }

    public function preview_url($page_slug, $data, $args = [])
    {
      $preview_url = '';

      if ($page_slug == 'item_report') {
          $preview_url = '/products/' . Item::$stage_slug_list[$args->stage] . '/report/detail/' . $data->id;
      }

      $this->set(compact('preview_url'));
    }
}