Khách Đặt Lịch !!!
<?php $form_opt = ['Tắm gội', 'Cắt tỉa', 'Khám Bệnh', 'Mua sắm', 'Tất cả']; ?>

【 Tên Khách Hàng 】
<?= $value['name']; ?>　

【 Email 】
<?= $value['email']; ?>　

【 Phone 】
<?= $value['phone']; ?>　

【 Lịch Hẹn 】
<?= $value['date'] ." ". $value['time']; ?>　

【 Dịch Vụ 】
<?= $form_opt[$value['form_opt']]; ?>　