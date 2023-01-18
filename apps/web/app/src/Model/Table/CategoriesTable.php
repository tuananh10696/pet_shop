<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CategoriesTable extends AppTable
{


    // テーブルの初期値を設定する
    public $defaultValues = [
        "id" => null,
        "position" => 0
    ];


    public $attaches = [
        'images' => [
            'image' => [
                'extensions' => ['jpg', 'jpeg', 'gif', 'png'],
                'width' => 1200,
                'height' => 1200,
                'file_name' => 'img_%d_%s',
                'thumbnails' => [
                    'r' => [
                        'prefix' => 'r_',
                        'width' => 183,
                        'height' => 117
                    ]
                ]
            ]
        ],
        'files' => [],
    ];


    // 
    public function initialize(array $config)
    {
        // 添付ファイル
        $this->addBehavior('FileAttache');
        $this->addBehavior('Position', [
            'group' => ['page_config_id', 'parent_category_id'],
            'order' => 'DESC'
        ]);

        // アソシエーション
        $this->hasMany('Infos');
        $this->belongsTo('PageConfigs');

        parent::initialize($config);
    }


    // Validation
    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('name', '入力してください')
            ->add('name', 'maxLength', [
                'rule' => ['maxLength', 40],
                'message' => __('40字以内で入力してください')
            ]);

        return $validator;
    }


    public function validationCaseStudy(Validator $validator)
    {
        $validator = $this->validationDefault($validator);

        $validator->notEmpty('identifier', '入力してください')
            ->add('identifier', 'maxLength', [
                'rule' => ['maxLength', 40],
                'message' => __('40字以内で入力してください')
            ]);

        return $validator;
    }


    public function validationCaseStudyCreate(Validator $validator)
    {
        $validator = $this->validationCaseStudy($validator);

        $validator->notEmpty('_image', '選択してください', 'create')
            ->add('_image', 'custom', [
                'rule' => function ($value, $context) {
                    if ($value['error'] != 0) return 'アップロードできません';
                    if (!in_array($value['type'], ['image/jpeg', 'image/gif', 'image/png'])) return 'アップロードできません';
                    return true;
                },
            ]);

        return $validator;
    }
}
