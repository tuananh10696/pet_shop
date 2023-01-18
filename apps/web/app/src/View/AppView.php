<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\View;

use Cake\View\View;
use App\Model\Entity\Useradmin;

/**
 * Application View
 *
 * Your application’s default view class
 *
 * @link https://book.cakephp.org/3.0/en/views.html#the-app-view
 */
class AppView extends View
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading helpers.
     *
     * e.g. `$this->loadHelper('Html');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadHelper('Common');
        $this->loadHelper('Html', ['className' => 'MyHtml']);
        $this->loadHelper('Form', ['className' => 'MyForm',
                                   'errorClass' => 'error',
                                   'templates' => [
                                       'inputContainer' => '{{content}}',
                                        'inputContainerError' => '{{content}}<div class="error-message">{{error}}</div>',
                                        'nestingLabel' => '{{input}}<label{{attrs}}>{{text}}</label>',
                                        'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
                                        'radioWrapper' => '<span style="margin-right:10px;color:#000;">{{label}}</span>'
                                   ]]);

        $user_roles = [
            'develop' => Useradmin::ROLE_DEVELOP,
            'admin' => Useradmin::ROLE_ADMIN,
            'staff' => Useradmin::ROLE_STAFF
        ];
        $this->set(compact('user_roles'));
    }
}
/* 
デフォルトで設定されているもの

    'templates' => [
        'button' => '<button{{attrs}}>{{text}}</button>',
        'checkbox' => '
　　　　　　　　<input type="checkbox" name="{{name}}" 
           value="{{value}}"{{attrs}}>',
        'checkboxFormGroup' => '{{label}}',
        'checkboxWrapper' => '<div class="checkbox">{{label}}</div>',
        'dateWidget' => '
　　　　　　　　　　{{year}}{{month}}{{day}}
　　　　　　　　　　{{hour}}{{minute}}{{second}}{{meridian}}',
        'error' => '<div class="error-message">{{content}}</div>',
        'errorList' => '<ul>{{content}}</ul>',
        'errorItem' => '<li>{{text}}</li>',
        'file' => '<input type="file" name="{{name}}"{{attrs}}>',
        'fieldset' => '<fieldset{{attrs}}>{{content}}</fieldset>',
        'formStart' => '<form{{attrs}}>',
        'formEnd' => '</form>',
        'formGroup' => '{{label}}{{input}}',
        'hiddenBlock' => '<div style="display:none;">{{content}}</div>',
        'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/>',
        'inputSubmit' => '<input type="{{type}}"{{attrs}}/>',
        'inputContainer' => '
           <div class="input {{type}}{{required}}">
             {{content}}
            </div>',
        'inputContainerError' => '
　　　　　　　　　　<div class="input {{type}}{{required}} error">
　　　　　　　　　　　　{{content}}{{error}}
　　　　　　　　　　</div>',
        'label' => '<label{{attrs}}>{{text}}</label>',
        'nestingLabel' => '{{hidden}}<label{{attrs}}>{{input}}{{text}}</label>',
        'legend' => '<legend>{{text}}</legend>',
        'multicheckboxTitle' => '<legend>{{text}}</legend>',
        'multicheckboxWrapper' => '<fieldset{{attrs}}>{{content}}</fieldset>',
        'option' => '<option value="{{value}}"{{attrs}}>{{text}}</option>',
        'optgroup' => '
          <optgroup label="{{label}}"{{attrs}}>
             {{content}}
           </optgroup>',
        'select' => '<select name="{{name}}"{{attrs}}>{{content}}</select>',
        'selectMultiple' => '
          <select name="{{name}}[]" multiple="multiple"{{attrs}}>
             {{content}}
           </select>',
        'radio' => '
          <input type="radio" name="{{name}}"
              value="{{value}}"{{attrs}}>',
        'radioWrapper' => '{{label}}',
        'textarea' => '
          <textarea name="{{name}}"{{attrs}}>
              {{value}}
           </textarea>',
        'submitContainer' => '<div class="submit">{{content}}</div>',
    ]
    */