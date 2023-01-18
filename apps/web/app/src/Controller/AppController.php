<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    public $Session;
    public $error_messages;
    public $helpers = [
        'Paginator' => ['templates' => 'paginator-templates'],
        'Text'
    ];
    public $head_description = '在庫管理システム、WMS（倉庫管理システム）ならアトムエンジニアリング。物流・製造業の現場を改善し続けて30年の実績と確かなソリューションでお客様の業務改善を強力にサポート。';

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        $this->loadComponent('Paginator');
        $this->loadComponent('Csrf');
        $this->setHeadTitle();
        $this->Session = $this->request->getSession();

        $this->viewBuilder()->setLayout(false);

        $this->is_preview = $this->isUserLogin() && $this->request->getQuery('preview') == 'on';

        $this->set('__description__', $this->head_description);
        $this->set('body_class', '');
        $this->getCategory();
        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    protected function getCategory()
    {
        $list = [];

        $list['category'] = $this->loadModel('Categories')
            ->find('all')
            ->where([
                'Categories.status' => 'publish',
                'PageConfigs.slug' => 'news'
            ])
            ->contain('PageConfigs')
            ->order('Categories.position ASC')
            ->toArray();


        if (!empty($list)) $this->set(array_keys($list), $list);
        return $list;
    }
    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Http\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        // Note: These defaults are just to get started quickly with development
        // and should not be used in production. You should instead set "_serialize"
        // in each action as required.
        if (
            !array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->getType(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }

        $this->set('error_messages', $this->error_messages);

        if ($this->request->getParam('prefix') === 'smt') {
            $this->viewBuilder()->theme('Sp');
        }

        $this->request->addDetector(
            'mob',
            array(
                'env' => 'HTTP_USER_AGENT',
                'options' => array(
                    'Android', 'AvantGo', 'BlackBerry', 'DoCoMo', 'Fennec', 'iPod', 'iPhone', 'iPad',
                    'J2ME', 'MIDP', 'NetFront', 'Nokia', 'Opera Mini', 'Opera Mobi', 'PalmOS', 'PalmSource',
                    'portalmmm', 'Plucker', 'ReqwirelessWeb', 'SonyEricsson', 'Symbian', 'UP\\.Browser',
                    'webOS', 'Windows CE', 'Windows Phone OS', 'Xiino'
                )
            )
        );

        //Theme 設定
        $this->set('isMobile', $this->request->is('mob'));
    }


    public function beforeFilter(Event $event)
    {
        $is_en = $this->checkLang();
        if ($this->request->getParam('prefix') === 'admin') {
            // $this->viewBuilder()->theme('Admin');
            $this->viewBuilder()->setLayout('admin');
        } elseif ($this->request->getParam('prefix') === 'smt') {
            $this->viewBuilder()->setLayout('simple');
        } else {
            //Theme 設定
            $this->viewBuilder()->setLayout('simple');
            // $this->theme = 'Pc';

            // 準備
            $this->_prepare();
        }
    }


    protected function checkLang()
    {
        $url = $this->request->getRequestTarget();
        $split_url = explode('/', $url);
        $this->set('is_en', isset($split_url[1]) && $split_url[1] == 'en');
        return isset($split_url[1]) && $split_url[1] == 'en';
    }



    protected function _setView($lists)
    {
        $this->set(array_keys($lists), $lists);
    }


    private function _prepare()
    { }


    /**
     * Actionの後、実行される
     * @return [type] [description]
     */

    public function isAdminLogin()
    {
        $id = $this->Session->read('uid');
        return $id;
    }


    public function isUserLogin($role = 'admin')
    {
        if ($role == 'admin') {
            $userid = $this->Session->read('useradminId');
        } elseif ($role == 'member') {
            $userid = $this->Session->read('memberId');
        }
        return $userid;
    }


    public function isSiteUserLogin()
    {
        $site_user_id = $this->Session->read('site_user_id');
        return $site_user_id;
    }


    public function isSiteCustomerLogin()
    {
        $site_user_id = $this->Session->read('site_customer_id');
        return $site_user_id;
    }


    public function isExpertLogin()
    {
        return $this->isSiteCustomerLogin();
    }


    public function isCompanyLogin()
    {
        return $this->Session->read('companyId');
    }


    public function isShopLogin()
    {
        return $this->Session->read('shopId');
    }


    public function getUserId($role = 'admin')
    {
        return $this->isUserLogin($role);
    }


    public function checkLogin()
    {
        if (!$this->isAdminLogin()) {
            return $this->redirectWithException('/admin/');
        }
    }


    public function checkUserLogin()
    {
        if (!$this->isUserLogin()) {
            return $this->redirectWithException('/user_admin/');
        }
    }


    public function checkShopLogin()
    {
        if (!$this->isShopLogin()) {
            return $this->redirectWithException('/user_admin/');
        }
    }


    public function checkCompanyLogin()
    {
        if (!$this->isCompanyLogin()) {
            return $this->redirectWithException('/company/');
        }
    }


    public function checkSiteUserLogin()
    {
        $id = $this->isSiteUserLogin();
        if (!$id) {
            return $this->redirectWithException('/community/login/');
        }
        return $id;
    }


    public function checkSiteCustomerLogin()
    {
        $id = $this->isSiteCustomerLogin();
        if (!$id) {
            return $this->redirectWithException('/community/login/');
        }
        return $id;
    }


    public function isSiteLogin()
    {

        return ($this->isSiteUserLogin() || $this->isSiteCustomerLogin());
    }


    public function checkSiteLogin()
    {
        $id = $this->isSiteLogin();
        if (!$id) {
            return $this->redirectWithException('/community/login/');
        }
        return $id;
    }


    public function getSiteRole()
    {
        $role = 'nologin';

        if ($this->isSiteUserLogin()) {
            $role = 'user';
        } elseif ($this->isSiteCustomerLogin()) {
            $role = 'customer';
        }

        return $role;
    }


    /**
     * ハイアラーキゼーションと読む！（階層化という意味だ！）
     * １次元のentityデータを階層化した状態の構造にする
     */
    public function toHierarchization($id, $entity, $options = [])
    {
        // $options = array_merge([
        //     'section_block_ids' => [10]
        // ], $options);
        $data = $this->request->getData();
        $content_count = 0;
        $contents = [
            'contents' => []
        ];

        $contents_table = $this->{$this->modelName}->useHierarchization['contents_table'];
        $contents_id_name = $this->{$this->modelName}->useHierarchization['contents_id_name'];

        $sequence_table = $this->{$this->modelName}->useHierarchization['sequence_table'];
        $sequence_id_name = $this->{$this->modelName}->useHierarchization['sequence_id_name'];
        // if ($id && $entity->has($contents_table)) {
        if (!empty($entity->{$contents_table})) {
            $content_count = count($entity->{$contents_table});
            $block_count = 0;
            foreach ($entity->{$contents_table} as $k => $val) {
                $v = $val->toArray();

                // 枠ブロックの中にあるブロック以外　（枠ブロックも対象）
                if (!$v[$sequence_id_name] || ($v[$sequence_id_name] > 0 && in_array($v['block_type'], $options['section_block_ids']))) {
                    $contents["contents"][$block_count] = $v;
                    $contents["contents"][$block_count]['_block_no'] = $block_count;
                } else {
                    // 枠ブロックの中身
                    if (!array_key_exists($sequence_table, $v)) {
                        continue;
                    }
                    $sequence_id = $v[$sequence_id_name];
                    // if (!array_key_exists($block_count, $contents['contents'])) {
                    //     continue;
                    // }
                    $waku_number = false;
                    foreach ($contents['contents'] as $_no => $_v) {
                        if (in_array($_v['block_type'], $options['section_block_ids']) && $sequence_id == $_v[$sequence_id_name]) {
                            $waku_number = $_no;
                            break;
                        }
                    }
                    if ($waku_number === false) {
                        continue;
                    }

                    if (!array_key_exists('sub_contents', $contents["contents"][$waku_number])) {
                        $contents["contents"][$waku_number]['sub_contents'] = null;
                    }
                    $contents["contents"][$waku_number]['sub_contents'][$block_count] = $v;
                    $contents["contents"][$waku_number]['sub_contents'][$block_count]['_block_no'] = $block_count;
                }
                $block_count++;
            }
        }
        //  else {
        //     if (array_key_exists($contents_table, $data)) {
        //         $contents['contents'] = $data[$contents_table];
        //         $content_count = count($data[$contents_table]);
        //     }
        // }
        return [
            'contents' => $contents,
            'content_count' => $content_count
        ];
    }


    /**
     * 正常時のレスポンス
     */
    protected function rest_success($datas)
    {

        $data = array(
            'result' => array('code' => 0),
            'data' => $datas
        );

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }


    /**
     * エラーレスポンス
     */
    public function rest_error($code = '', $message = '', $result = [])
    {

        $http_status = 200;

        $state_list = array(
            '200' => 'empty',
            '400' => 'Bad Request', // タイプミス等、リクエストにエラーがあります。
            '401' => 'Unauthorixed', // 認証に失敗しました。（パスワードを適当に入れてみた時などに発生）
            // '402' => '', // 使ってない
            '403' => 'Forbidden', // あなたにはアクセス権がありません。
            '404' => 'Not Found', // 該当アドレスのページはありません、またはそのサーバーが落ちている。
            '500' => 'Internal Server Error', // CGIスクリプトなどでエラーが出た。
            '501' => 'Not Implemented', // リクエストを実行するための必要な機能をサポートしていない。
            '509' => 'Other', // オリジナルコード　例外処理
        );

        $code2messages = array(
            '1000' => 'パラメーターエラー',
            '1001' => 'パラメーターエラー',
            '1002' => 'パラメーターエラー',
            '2000' => '取得データがありませんでした',
            '2001' => '取得データがありませんでした',
            '9000' => '認証に失敗しました',
            '9001' => '不正なアクセス',
        );

        if (!array_key_exists($http_status, $state_list)) {
            $http_status = '509';
        }


        if ($message == "") {
            if (array_key_exists($code, $code2messages)) {
                $message = $code2messages[$code];
            } elseif (array_key_exists($http_status, $state_list)) {
                $message = $state_list[$http_status];
            }
        }
        if ($code == '') {
            $code = $http_status;
        }
        $data['result'] = array(
            'code' => intval($code),
            'message' => $message,
            'result' => $result
        );

        // セットヘッダー
        // $this->header("HTTP/1.1 " . $http_status . ' ' . $state_list[$http_status], $http_status);
        // $this->response->statusCode($http_status);
        // $this->header("Content-Type: application/json;");

        $this->set(compact('data'));
        $this->set('_serialize', 'data');

        return;
    }


    public function getCategoryEnabled()
    {
        return CATEGORY_FUNCTION_ENABLED;
    }


    public function getCategorySortEnabled()
    {
        return CATEGORY_SORT;
    }


    public function isCategoryEnabled($page_config, $mode = 'category')
    {

        if (!$this->getCategoryEnabled()) {
            return false;
        }

        if (empty($page_config)) {
            return false;
        }

        $mode = 'is_' . $mode;
        if ($page_config->{$mode} === 'Y' || strval($page_config->{$mode}) === '1') {
            return true;
        }

        return false;
    }


    public function isCategorySort($page_config_id)
    {
        if (!CATEGORY_SORT) {
            return false;
        }

        $page_config = $this->PageConfigs->find()->where(['PageConfigs.id' => $page_config_id])->first();
        if (empty($page_config)) {
            return false;
        }

        if ($page_config->is_category_sort == 'Y') {
            return true;
        }

        return false;
    }


    public function isViewSort($page_config, $category_id = 0)
    {

        if (
            $this->getCategoryEnabled() && $page_config->is_category === 'Y'
            && ($this->isCategorySort($page_config->id)) || (!$this->isCategorySort($page_config->id) && !$category_id)
        ) {
            return true;
        }

        return false;
    }


    /**
     * 記事がユーザーに権限のあるものかどうか
     * @param  [type]  $info_id [description]
     * @return boolean          [description]
     */
    public function isOwnInfoByUser($info_id)
    {
        $user_id = $this->isUserLogin();

        $info = $this->Infos->find()
            ->where(['Infos.id' => $info_id])
            ->contain([
                'PageConfigs' => function ($q) {
                    return $q->select(['site_config_id']);
                }
            ])
            ->first();
        if (empty($info)) {
            return false;
        }

        $user_site = $this->UseradminSites->find()->where(['UseradminSites.useradmin_id' => $user_id, 'UseradminSites.site_config_id' => $info->page_config->site_config_id])->first();
        if (empty($user_site)) {
            return false;
        }

        return true;
    }


    /**
     * ページがユーザーに権限のあるものかどうか
     * @param  [type]  $page_config_id [description]
     * @return boolean                 [description]
     */
    public function isOwnPageByUser($page_config_id)
    {
        $user_id = $this->isUserLogin();

        $page_config = $this->PageConfigs->find()->where(['PageConfigs.id' => $page_config_id])->first();
        if (empty($page_config)) {
            return false;
        }

        $user_site = $this->UseradminSites->find()->where(['UseradminSites.useradmin_id' => $user_id, 'UseradminSites.site_config_id' => $page_config->site_config_id])->first();
        if (empty($user_site)) {
            return false;
        }

        return true;
    }


    public function isOwnCategoryByUser($category_id)
    {
        $user_id = $this->isUserLogin();

        $category = $this->Categories->find()
            ->where(['Categories.id' => $category_id])
            ->contain([
                'PageConfigs' => function ($q) {
                    return $q->select(['site_config_id']);
                }
            ])
            ->first();
        if (empty($category)) {
            return false;
        }

        $user_site = $this->UseradminSites->find()->where(['UseradminSites.useradmin_id' => $user_id, 'UseradminSites.site_config_id' => $category->page_config->site_config_id])->first();
        if (empty($user_site)) {
            return false;
        }

        return true;
    }


    public function redirectWithException($url, $status = 302)
    {
        throw new \Cake\Routing\Exception\RedirectException(\Cake\Routing\Router::url($url, true), $status);
    }


    public function startupProcess()
    {
        try {
            return parent::startupProcess();
        } catch (\Cake\Routing\Exception\RedirectException $e) {
            return $this->redirect($e->getMessage(), $e->getCode());
        }
    }


    public function invokeAction()
    {
        try {
            return parent::invokeAction();
        } catch (\Cake\Routing\Exception\RedirectException $e) {
            return $this->redirect($e->getMessage(), $e->getCode());
        }
    }


    public function shutdownProcess()
    {
        try {
            return parent::shutdownProcess();
        } catch (\Cake\Routing\Exception\RedirectException $e) {
            return $this->redirect($e->getMessage(), $e->getCode());
        }
    }


    protected function token($len)
    {
        if ($len > 0) {
            $TOKEN_LENGTH = $len;
            $bytes = openssl_random_pseudo_bytes($TOKEN_LENGTH);
            return bin2hex($bytes);
        } else {
            return '';
        }
    }


    protected function _preventGarbledCharacters($bigText, $width = 249)
    {
        $pattern = "/(.{1,{$width}})(?:\\s|$)|(.{{$width}})/uS";
        $replace = '$1$2' . "\n";
        $wrappedText = preg_replace($pattern, $replace, $bigText);
        return $wrappedText;
    }


    public function getSiteUserRole()
    {
        $role = '';
        if ($this->isSiteUserLogin()) {
            $role = 'user';
        } elseif ($this->isExpertLogin()) {
            $role = 'expert';
        } else {
            $role = '';
        }

        return $role;
    }


    protected function _lists($cond = array(), $options = array())
    {

        $primary_key = $this->{$this->modelName}->getPrimaryKey();

        $this->paginate = array_merge(
            array(
                'order' => $this->modelName . '.' . $primary_key . ' DESC',
                'limit' => 10,
                'contain' => [],
                'paramType' => 'querystring',
                'url' => [
                    'sort' => null,
                    'direction' => null
                ],
                'rand' => null,
                'union' => null,
                'sql_debug' => false
            ),
            $options
        );
        if (!array_key_exists('contain', $options)) {
            $options['contain'] = [];
        }

        try {
            if ($this->paginate['limit'] === null) {
                unset($options['limit'],
                $options['paramType']);
                if (!empty($options['rand'])) {
                    $options['limit'] = $options['rand'];
                    $options['order'] = 'rand()';
                }
                if ($cond) {
                    $options['conditions'] = $cond;
                }
                // $datas = $this->{$this->modelName}->find('all', $options);
                $query = $this->{$this->modelName}->find()->where($cond)->order($options['order']);
                if (!empty($options['limit'])) {
                    $query->limit($options['limit']);
                }
                if ($options['contain']) {
                    $query->contain($options['contain']);
                }
                if (!empty($options['union'])) {
                    $query->unionAll($options['union']);
                }
                if (!empty($options['sql_debug']) && $options['sql_debug'] === true) {
                    dd($query->sql());
                }
                $data = $query->all();
            } else {
                $data = $this->paginate($this->{$this->modelName}->find()->where($cond));
                // if ($options['contain']) {
                //     $data_query->contain($options['contain']);
                // }
            }
            $count['total'] = $data->count();
        } catch (NotFoundException $e) {
            if (
                !empty($this->request->query['page'])
                && 1 < $this->request->query['page']
            ) {
                $this->redirect(array('action' => $this->request->action));
            }
        }
        $q = $this->{$this->modelName}->find()->where($cond);
        if (!empty($options['contain'])) {
            $q->contain($options['contain']);
        }
        $numrows = $q->count();

        $this->set(compact('data', 'numrows'));
    }

    protected function getPrefectureList()
    {
        $prefectures = [
            '北海道' => '北海道', '青森県' => '青森県', '岩手県' => '岩手県', '宮城県' => '宮城県', '秋田県' => '秋田県', '山形県' => '山形県', '福島県' => '福島県', '茨城県' => '茨城県', '栃木県' => '栃木県', '群馬県' => '群馬県', '埼玉県' => '埼玉県', '千葉県' => '千葉県', '東京都' => '東京都', '神奈川県' => '神奈川県', '新潟県' => '新潟県', '富山県' => '富山県', '石川県' => '石川県', '福井県' => '福井県', '山梨県' => '山梨県', '長野県' => '長野県', '岐阜県' => '岐阜県', '静岡県' => '静岡県', '愛知県' => '愛知県', '三重県' => '三重県', '滋賀県' => '滋賀県', '京都府' => '京都府', '大阪府' => '大阪府', '兵庫県' => '兵庫県', '奈良県' => '奈良県', '和歌山県' => '和歌山県', '鳥取県' => '鳥取県', '島根県' => '島根県', '岡山県' => '岡山県', '広島県' => '広島県', '山口県' => '山口県', '徳島県' => '徳島県', '香川県' => '香川県', '愛媛県' => '愛媛県', '高知県' => '高知県', '福岡県' => '福岡県', '佐賀県' => '佐賀県', '長崎県' => '長崎県', '熊本県' => '熊本県', '大分県' => '大分県', '宮崎県' => '宮崎県', '鹿児島県' => '鹿児島県', '沖縄県' => '沖縄県'
        ];

        return $prefectures;
    }


    protected function getPrefectureNumberList()
    {
        $prefectures = [
            '1' => '北海道', '2' => '青森県', '3' => '岩手県', '4' => '宮城県', '5' => '秋田県', '6' => '山形県', '7' => '福島県', '8' => '茨城県', '9' => '栃木県', '10' => '群馬県', '11' => '埼玉県', '12' => '千葉県', '13' => '東京都', '14' => '神奈川県', '15' => '新潟県', '16' => '富山県', '17' => '石川県', '18' => '福井県', '19' => '山梨県', '20' => '長野県', '21' => '岐阜県', '22' => '静岡県', '23' => '愛知県', '24' => '三重県', '25' => '滋賀県', '26' => '京都府', '27' => '大阪府', '28' => '兵庫県', '29' => '奈良県', '30' => '和歌山県', '31' => '鳥取県', '32' => '島根県', '33' => '岡山県', '34' => '広島県', '35' => '山口県', '36' => '徳島県', '37' => '香川県', '38' => '愛媛県', '39' => '高知県', '40' => '福岡県', '41' => '佐賀県', '42' => '長崎県', '43' => '熊本県', '44' => '大分県', '45' => '宮崎県', '46' => '鹿児島県', '47' => '沖縄県'
        ];

        return $prefectures;
    }


    protected function _getPrefectureNumberFromStr($name)
    {
        $prefecture_list = array_flip($this->getPrefectureNumberList());

        if (array_key_exists($name, $prefecture_list)) {
            return $prefecture_list[$name];
        }
        return 0;
    }


    protected function _getPrefectureFromNumber($pre_id)
    {
        $prefecture_list = $this->getPrefectureNumberList();

        if (array_key_exists($pre_id, $prefecture_list)) {
            return $prefecture_list[$pre_id];
        }
        return '';
    }


    /**
     * ファイルダウンロード　ファイル名が文字化けしないバージョン
     *
     * */
    public function download($id = 0, $columns = null)
    {
        $this->{$this->modelClass}->id = $id;
        if (!$columns) {
            $columns = key($this->{$this->modelName}->attaches['files']);
        }
        if ($this->{$this->modelClass}->exists()) {
            $data = $this->{$this->modelClass}->read();
            $_ = $data[$this->modelClass];
            if ($_[$columns]) {
                $file = WWW_ROOT . $_['attaches'][$columns]['src'];
                $name = $_['attaches'][$columns]['name'];

                $content = 'attachment;';
                $content .= 'filename=' . $name . ';';
                $content .= 'filename*=UTF-8\'\'' . rawurlencode($name);

                if (file_exists($file)) {
                    $this->response->header('Content-Disposition', $content);
                    $this->response->file($file);
                    return $this->response;
                }
            }
        }
        throw new NotFoundException();
    }


    public function mergeLoginedSupport()
    {
        $support_token = $this->Session->read('supportToken');
        if (empty($support_token)) {
            return;
        }
        $member_id = $this->isUserLogin('member');
        if (empty($member_id)) {
            return;
        }
        $member = $this->Members->find()->where(['id' => $member_id])->first();
        if (empty($member)) {
            return;
        }

        $cond = [
            'OR' => [
                ['uuid' => $support_token],
                ['member_id' => $member_id],
            ],
            'email' => $member->email
        ];
        $update = [
            'uuid' => $support_token,
            'member_id' => $member_id,
            'name' => $member->name
        ];

        $connection = ConnectionManager::get('default');
        $connection->begin();
        try {
            $this->ItemSupports->updateAll($update, $cond);

            $supports = $this->ItemSupports->find()->where($cond)->all();
            $support_item_ids = [];
            if (!empty($supports)) {
                foreach ($supports as $support) {
                    if (!in_array($support->item_id, $support_item_ids)) {
                        $support_item_ids[] = $support->item_id;
                    } else {
                        $this->ItemSupports->delete($support);
                    }
                }
            }

            $connection->commit();
        } catch (\Exception $e) {
            $connection->rollback();
        }
    }

    protected function setHeadTitle($title = Null, $isFull = False)
    {
        $_title = \Cake\Core\Configure::read('App.headTitle');
        if ($title) {
            $title = is_array($title) ? implode(' | ', $title) : $title;
            $_title = $isFull ? $title : __('{0} | {1}', [$title, $_title]);
        }
        $this->set('__title__', $_title);
        return $_title;
    }
}
