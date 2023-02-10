<?php

namespace App\Form;

use Cake\Mailer\Email;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\Mailer\TransportFactory;
use App\Utils\CustomUtility;

class ContactForm extends AppForm
{

    const MAIL_SUBJECT_ADMIN = '【大村商事】お問い合わせがありました';
    const MAIL_SUBJECT_USER = '【大村商事】お問い合わせ受付完了';


    protected function _buildSchema(Schema $schema)
    {
        return $schema
            ->addField('name', 'string')
            ->addField('kana', 'string')
            ->addField('address', 'string')
            ->addField('phone_number', 'string')
            ->addField('email', 'string')
            ->addField('confirm_email', 'string')
            ->addField('category', 'string')
            ->addField('content', 'string')
            ->addField('chk_privacy', 'integer');
    }

    protected function _buildValidator(Validator $validator)
    {
        $validator->setProvider('App', 'App\Validator\AppValidation');

        $validator
            ->notBlank('name', '※必須項目です')
            ->add('name', 'length', ['rule' => ['maxLength', 100], 'message' => '※100字以内で入力してください'])

            ->notBlank('kana', '※必須項目です')
            ->add('kana', 'length', ['rule' => ['maxLength', 100], 'message' => '※100字以内で入力してください'])

            ->notBlank('name', '※必須項目です')
            ->add('name', 'length', ['rule' => ['maxLength', 40], 'message' => '※40字以内で入力してください'])

            ->notBlank('kana', '※必須項目です')
            ->add('kana', 'length', ['rule' => ['maxLength', 40], 'message' => '※40字以内で入力してください'])
            ->add('kana', 'checkKana', ['rule' => ['checkKana'], 'provider' => 'App', 'message' => '全角カタカナで入力してください'])

            ->allowEmptyString('address')
            ->add('address1', 'maxlength', ['rule' => ['maxLength', 100], 'message' => '50字以内で入力してください'])

            ->notBlank('phone_number', '※必須項目です')
            ->add('phone_number', 'checkTel', ['rule' => ['checkTel'], 'provider' => 'App', 'message' => '電話番号の形式が正しくありません'])

            ->notBlank('email', '※必須項目です')
            ->add('email', 'custom', ['rule' => [$this, 'checkEmail'], 'message' => '※メールアドレスの形式が正しくありません　全て半角で入力してください'])

            ->notBlank('confirm_email', '※必須項目です')
            ->notEmptyString('confirm_email', '※必須項目です')
            ->maxLength('confirm_email', 100, '100字以内でご入力ください')
            ->add(
                'confirm_email',
                [
                    'custom' => [
                        'rule' => function ($value, $context) {
                            if ($value != $context['data']['email']) {
                                return '確認用メールアドレスが一致しません';
                            }
                            return true;
                        },
                    ],
                ],
            )

            ->integer('category')
            ->add(
                'category',
                [
                    'custom' => [
                        'rule' => function ($value, $context) {
                            if (intval($value) == 0) {
                                return '選択してください';
                            }
                            return true;
                        },
                    ],
                ],
            )

            ->notBlank('content', '※必須項目です')
            ->notEmptyString('content', '※必須項目です')
            ->add('content', 'maxlength', ['rule' => ['maxLength', 3000], 'message' => '3000字以内で入力してください'])

            ->notBlank('chk_privacy', '※同意してください')
            ->add('chk_privacy', 'custom', ['rule' => [$this, 'checkIsPrivacy'], 'message' => '※同意してください']);

        return $validator;
    }

    public function getMailFrom()
    {
        $mail = '';

        if (env('SITE_MODE') == 'develop' || strpos(env('HTTP_HOST'), 'test') !== false || strpos(env('HTTP_HOST'), 'caters') !== false) {
            $mail = 'test+from@caters.co.jp';
        } else {
            $mail = '';
        }

        return $mail;
    }

    public function getMailTo()
    {
        $mail = '';

        if (env('SITE_MODE') == 'develop' || strpos(env('HTTP_HOST'), 'test') !== false || strpos(env('HTTP_HOST'), 'caters') !== false) {
            $mail = 'test+to@caters.co.jp';
        } else {
            $mail = '';
        }

        return $mail;
    }

    public function getAdminSubject()
    {
        return self::MAIL_SUBJECT_ADMIN;
    }

    public function getUserSubject()
    {
        return self::MAIL_SUBJECT_USER;
    }

    public function _sendmail($form)
    {
        // 文字化け対応
        // $form['content'] = CustomUtility::_preventGarbledCharacters($form['content']);

        $to = ['bui.tuanAnh@caters.co.jp'];
        $from = ['bui.tuanAnh@caters.co.jp' => "MER's HOUSE - Tiệm thú cưng"];

        // $test_dev_local_server = (strpos($_SERVER["HTTP_HOST"], 'test') !== false ||
        //     strpos($_SERVER["HTTP_HOST"], 'caters') !== false ||
        //     strpos($_SERVER["HTTP_HOST"], 'loca') !== false ||
        //     strpos($_SERVER["HTTP_HOST"], 'localhost') !== false);

        // $is_honban = !Configure::read('debug') && !$test_dev_local_server;

        // if ($is_honban) {
        //     // 本番の場合
        //     $to = ['bui.tuanAnh@caters.co.jp'];
        //     $from = ['bui.tuanAnh@caters.co.jp' => "MER's House"];
        // }

        $info_email = new Email();
        $info_email
            ->template('admin_contact')
            ->emailFormat('text')
            ->setViewVars(['value' => $form])
            ->setFrom($from)
            ->setTo($to)
            ->setSubject("MER's HOUSE - Tiệm thú cưng")
            ->send();


        $thank_email = new Email();
        $thank_email
            ->template('contact')
            ->emailFormat('text')
            ->setViewVars(['value' => $form])
            ->setFrom($from)
            ->setTo($form['email'])
            ->setSubject("MER's HOUSE - Tiệm thú cưng")
            ->send();

        return true;
    }
}
