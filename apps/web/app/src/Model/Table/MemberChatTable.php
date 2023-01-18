<?php

namespace App\Model\Table;

class MemberChatTable extends AppTable
{

    // テーブルの初期値を設定する
    public $defaultValues = ["id" => null];


    // 新CMSの枠ブロックを使う場合の設定
    public $useHierarchization = [
        'contents_table' => 'info_contents',
        'contents_id_name' => 'info_content_id',
        'sequence_model' => 'SectionSequences',
        'sequence_table' => 'section_sequence',
        'sequence_id_name' => 'section_sequence_id'
    ];


    public $attaches = [
        'images' => [],
        'files' => [],
    ];


    // 推奨サイズ
    public $recommend_size_display = [
        // 'image' => true, //　編集画面に推奨サイズを常時する場合の指定
        // 'image' => ['width' => 300, 'height' => 300] // attaachesに書かれているサイズ以外の場合の指定
        // 'image' => false
        // 'image' => '横幅700以上を推奨。1200x1200以内に縮小されます。'
    ];


    // 
    public function initialize(array $config)
    {
        $this->belongsTo('Infos');
        $this->belongsTo('MemberInfos', [
            'className' => 'Infos',
        ])
            ->setForeignKey('member_id');

        parent::initialize($config);
    }
}
