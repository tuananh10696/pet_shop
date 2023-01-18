-- カレンダー
CREATE TABLE schedules
(
	id int unsigned NOT NULL AUTO_INCREMENT,
	created datetime NOT NULL,
	modified datetime NOT NULL,
	date date NOT NULL,
	status int unsigned DEFAULT 0 NOT NULL,
	memo text NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;


-- 消費税
CREATE TABLE taxes
(
	id int unsigned NOT NULL AUTO_INCREMENT,
	created datetime NOT NULL,
	modified datetime NOT NULL,
	type tinyint unsigned DEFAULT 0 NOT NULL,
	rate decimal(3,1) unsigned DEFAULT 0.0 NOT NULL,
	start date DEFAULT '0000-00-00' NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

-- 都道府県
CREATE TABLE prefectures
(
    id int unsigned NOT NULL AUTO_INCREMENT,
    name varchar(10) NOT NULL DEFAULT '',
    PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;
insert into prefectures(id,name) values(1, '北海道');
insert into prefectures(id,name) values(2, '青森県');
insert into prefectures(id,name) values(3, '岩手県');
insert into prefectures(id,name) values(4, '宮城県');
insert into prefectures(id,name) values(5, '秋田県');
insert into prefectures(id,name) values(6, '山形県');
insert into prefectures(id,name) values(7, '福島県');
insert into prefectures(id,name) values(8, '茨城県');
insert into prefectures(id,name) values(9, '栃木県');
insert into prefectures(id,name) values(10, '群馬県');
insert into prefectures(id,name) values(11, '埼玉県');
insert into prefectures(id,name) values(12, '千葉県');
insert into prefectures(id,name) values(13, '東京都');
insert into prefectures(id,name) values(14, '神奈川県');
insert into prefectures(id,name) values(15, '新潟県');
insert into prefectures(id,name) values(16, '富山県');
insert into prefectures(id,name) values(17, '石川県');
insert into prefectures(id,name) values(18, '福井県');
insert into prefectures(id,name) values(19, '山梨県');
insert into prefectures(id,name) values(20, '長野県');
insert into prefectures(id,name) values(21, '岐阜県');
insert into prefectures(id,name) values(22, '静岡県');
insert into prefectures(id,name) values(23, '愛知県');
insert into prefectures(id,name) values(24, '三重県');
insert into prefectures(id,name) values(25, '滋賀県');
insert into prefectures(id,name) values(26, '京都府');
insert into prefectures(id,name) values(27, '大阪府');
insert into prefectures(id,name) values(28, '兵庫県');
insert into prefectures(id,name) values(29, '奈良県');
insert into prefectures(id,name) values(30, '和歌山県');
insert into prefectures(id,name) values(31, '鳥取県');
insert into prefectures(id,name) values(32, '島根県');
insert into prefectures(id,name) values(33, '岡山県');
insert into prefectures(id,name) values(34, '広島県');
insert into prefectures(id,name) values(35, '山口県');
insert into prefectures(id,name) values(36, '徳島県');
insert into prefectures(id,name) values(37, '香川県');
insert into prefectures(id,name) values(38, '愛媛県');
insert into prefectures(id,name) values(39, '高知県');
insert into prefectures(id,name) values(40, '福岡県');
insert into prefectures(id,name) values(41, '佐賀県');
insert into prefectures(id,name) values(42, '長崎県');
insert into prefectures(id,name) values(43, '熊本県');
insert into prefectures(id,name) values(44, '大分県');
insert into prefectures(id,name) values(45, '宮崎県');
insert into prefectures(id,name) values(46, '鹿児島県');
insert into prefectures(id,name) values(47, '沖縄県');

CREATE TABLE sequences
(
    id int unsigned NOT NULL AUTO_INCREMENT,
    k varchar(30) NOT NULL DEFAULT '',
    val int unsigned NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
