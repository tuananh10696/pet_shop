―――――――――――――――――――――――――――――――― 
  このメッセージはお問い合わせ受付システムより自動送信されています。
  このメールに心当たりのない場合やご不明な場合はご連絡ください。
―――――――――――――――――――――――――――――――― 

この度は、WEBサイトよりお問い合わせいただきまして、誠にありがとうございます。
ご送信いただきました内容は以下の通りでございます。


*************************************************
　お問い合わせ内容
*************************************************
<?php endif; ?>
【お名前】
<?= $form['name']['value']; ?>　

【フリガナ】
<?= $form['kana']['value']; ?>　

【電話番号】
<?= $form['tel']['value']; ?>　

【メールアドレス】
<?= $form['email']['value']; ?>　

【問い合わせ内容】
<?= $form['content']['value']; ?>　


<?= $this->element('Email/signature'); ?>