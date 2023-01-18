-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ohmurasyouji`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(40) NOT NULL DEFAULT '',
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `created`, `modified`, `name`, `username`, `password`, `role`) VALUES
(1, '2022-12-08 17:55:21', '2022-12-08 17:55:21', '管理者', 'caters_admin', '$2y$10$7X.icRPhUBnFrsoBR784y.VMC9IrXxbbinEff3WMGa0N.WG3D8kH6', 0);

-- --------------------------------------------------------

--
-- Table structure for table `append_items`
--

CREATE TABLE `append_items` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `page_config_id` int(11) UNSIGNED NOT NULL,
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(40) NOT NULL DEFAULT '',
  `slug` varchar(30) NOT NULL DEFAULT '',
  `value_type` decimal(10,0) NOT NULL DEFAULT '0',
  `max_length` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `is_required` decimal(10,0) UNSIGNED NOT NULL DEFAULT '0',
  `mst_list_slug` varchar(40) DEFAULT NULL,
  `value_default` varchar(100) DEFAULT NULL,
  `attention` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `page_config_id` int(11) UNSIGNED NOT NULL,
  `parent_category_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` varchar(10) NOT NULL DEFAULT 'publish',
  `name` varchar(40) NOT NULL,
  `identifier` varchar(30) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
  `cate_color` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `categories`
--

INSERT INTO `categories` (`id`, `created`, `modified`, `page_config_id`, `parent_category_id`, `position`, `status`, `name`, `identifier`, `image`, `cate_color`) VALUES
(1, '2023-01-17 23:53:36', '2023-01-18 01:00:52', 1, 0, 1, 'publish', '新着情報', '', NULL, '0'),
(2, '2023-01-18 00:14:32', '2023-01-18 01:01:00', 1, 0, 2, 'publish', 'ブログ', '', NULL, '1'),
(3, '2023-01-18 00:14:48', '2023-01-18 01:01:21', 1, 0, 3, 'publish', '採用情報', '', NULL, '2'),
(4, '2023-01-18 00:14:56', '2023-01-18 00:14:56', 1, 0, 4, 'publish', '会社見学', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `infos`
--

CREATE TABLE `infos` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `page_config_id` int(10) UNSIGNED NOT NULL,
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` varchar(10) NOT NULL DEFAULT 'publish',
  `title` varchar(100) NOT NULL,
  `notes` text,
  `start_datetime` datetime DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `start_time` decimal(10,0) NOT NULL DEFAULT '0',
  `end_date` date DEFAULT NULL,
  `end_time` decimal(10,0) NOT NULL DEFAULT '0',
  `image` varchar(100) DEFAULT NULL,
  `meta_description` varchar(200) DEFAULT NULL,
  `meta_keywords` varchar(200) DEFAULT NULL,
  `regist_user_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `index_type` decimal(10,0) DEFAULT NULL,
  `multi_position` bigint(20) DEFAULT NULL,
  `parent_info_id` int(10) UNSIGNED DEFAULT NULL,
  `value_text` varchar(255) DEFAULT NULL,
  `popular` tinyint(1) DEFAULT NULL,
  `top_slide_display` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `infos`
--

INSERT INTO `infos` (`id`, `created`, `modified`, `page_config_id`, `position`, `status`, `title`, `notes`, `start_datetime`, `start_date`, `start_time`, `end_date`, `end_time`, `image`, `meta_description`, `meta_keywords`, `regist_user_id`, `category_id`, `index_type`, `multi_position`, `parent_info_id`, `value_text`, `popular`, `top_slide_display`) VALUES
(1, '2023-01-18 01:20:26', '2023-01-18 01:20:29', 2, 1, 'publish', 'タイトル', NULL, '2023-01-18 00:00:00', '2023-01-18', '0', '1900-01-01', '0', 'img_1_669859a1-86a4-428b-8b8a-61db0b17cda1.jpeg', '', '', 1, 0, '0', 0, 0, NULL, NULL, NULL),
(2, '2023-01-18 01:30:53', '2023-01-18 01:30:53', 1, 1, 'publish', 'タイトル', NULL, '2023-01-18 00:00:00', '2023-01-18', '0', '1900-01-01', '0', '', '', '', 1, 1, '0', 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `info_append_items`
--

CREATE TABLE `info_append_items` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `info_id` int(11) UNSIGNED NOT NULL,
  `append_item_id` int(11) UNSIGNED NOT NULL,
  `value_text` varchar(200) DEFAULT NULL,
  `value_textarea` text,
  `value_date` date DEFAULT NULL,
  `value_datetime` datetime DEFAULT NULL,
  `value_time` time DEFAULT NULL,
  `value_int` int(10) DEFAULT NULL,
  `value_key` varchar(30) DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL,
  `file_size` int(10) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `file_extension` varchar(10) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `info_categories`
--

CREATE TABLE `info_categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `info_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `info_contents`
--

CREATE TABLE `info_contents` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `info_id` int(11) NOT NULL,
  `block_type` decimal(10,0) NOT NULL,
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(100) DEFAULT NULL,
  `content` text,
  `image` varchar(100) DEFAULT NULL,
  `image_2` varchar(100) DEFAULT NULL,
  `image_3` varchar(100) DEFAULT NULL,
  `image_pos` varchar(10) DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL,
  `file_size` int(10) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `file_extension` varchar(10) DEFAULT NULL,
  `section_sequence_id` int(10) DEFAULT NULL,
  `option_value` varchar(255) DEFAULT NULL,
  `option_value2` varchar(40) DEFAULT NULL,
  `option_value3` varchar(40) DEFAULT NULL,
  `before_text` text,
  `after_text` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `info_stock_tables`
--

CREATE TABLE `info_stock_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `info_id` int(11) NOT NULL,
  `page_slug` varchar(40) DEFAULT NULL,
  `model_name` varchar(40) DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `info_tags`
--

CREATE TABLE `info_tags` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `info_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `info_tops`
--

CREATE TABLE `info_tops` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `page_config_id` int(11) NOT NULL,
  `position` int(10) NOT NULL DEFAULT '0',
  `info_id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kvs`
--

CREATE TABLE `kvs` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(50) DEFAULT NULL,
  `key_name` varchar(40) DEFAULT NULL,
  `val` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mst_lists`
--

CREATE TABLE `mst_lists` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `position` decimal(10,0) NOT NULL DEFAULT '0' COMMENT '表示順',
  `status` varchar(10) NOT NULL DEFAULT 'publish',
  `ltrl_cd` varchar(60) DEFAULT NULL,
  `ltrl_val` varchar(60) DEFAULT NULL,
  `ltrl_sub_val` text,
  `slug` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `sys_cd` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `page_configs`
--

CREATE TABLE `page_configs` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `site_config_id` int(11) NOT NULL,
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `page_title` varchar(100) NOT NULL,
  `slug` varchar(40) NOT NULL,
  `header` text,
  `footer` text,
  `is_public_date` decimal(10,0) DEFAULT NULL,
  `is_public_time` decimal(10,0) DEFAULT NULL,
  `page_template_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `is_category` varchar(10) NOT NULL DEFAULT 'N',
  `is_category_sort` varchar(10) NOT NULL DEFAULT 'N',
  `is_category_multiple` decimal(10,0) NOT NULL DEFAULT '0',
  `is_category_multilevel` decimal(10,0) NOT NULL DEFAULT '0',
  `modified_category_role` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `max_multilevel` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `disable_position_order` decimal(10,0) NOT NULL DEFAULT '0',
  `disable_preview` decimal(10,0) NOT NULL DEFAULT '0',
  `is_auto_menu` decimal(10,0) NOT NULL DEFAULT '0',
  `list_style` decimal(10,0) NOT NULL DEFAULT '1',
  `root_dir_type` decimal(10,0) NOT NULL DEFAULT '0',
  `link_color` varchar(10) DEFAULT NULL,
  `parent_config_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `page_configs`
--

INSERT INTO `page_configs` (`id`, `created`, `modified`, `site_config_id`, `position`, `page_title`, `slug`, `header`, `footer`, `is_public_date`, `is_public_time`, `page_template_id`, `description`, `keywords`, `is_category`, `is_category_sort`, `is_category_multiple`, `is_category_multilevel`, `modified_category_role`, `max_multilevel`, `disable_position_order`, `disable_preview`, `is_auto_menu`, `list_style`, `root_dir_type`, `link_color`, `parent_config_id`) VALUES
(1, '2023-01-17 07:50:30', '2023-01-17 07:50:30', 1, 1, 'ブログ', 'blog', '', '', '0', '0', 0, '', '', 'Y', 'N', '0', '0', 1, 0, '0', '0', '1', '1', '0', '#000000', 0),
(2, '2023-01-17 07:52:19', '2023-01-17 07:52:19', 1, 2, 'チラシ一', 'flyer', '', '', '0', '0', 0, '', '', 'N', 'N', '0', '0', 1, 0, '0', '0', '1', '1', '0', '#000000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `page_config_extensions`
--

CREATE TABLE `page_config_extensions` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `page_config_id` int(11) NOT NULL,
  `position` int(10) NOT NULL DEFAULT '0',
  `status` varchar(10) NOT NULL DEFAULT 'publish',
  `type` decimal(10,0) DEFAULT NULL,
  `option_value` varchar(100) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `page_config_items`
--

CREATE TABLE `page_config_items` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `page_config_id` int(11) NOT NULL,
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `parts_type` enum('main','block','section') NOT NULL DEFAULT 'main',
  `item_key` varchar(40) DEFAULT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `memo` varchar(40) DEFAULT NULL,
  `title` varchar(30) DEFAULT NULL,
  `sub_title` varchar(30) DEFAULT NULL,
  `editable_role` varchar(100) NOT NULL DEFAULT 'staff',
  `viewable_role` varchar(100) NOT NULL DEFAULT 'staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `page_config_items`
--

INSERT INTO `page_config_items` (`id`, `created`, `modified`, `page_config_id`, `position`, `parts_type`, `item_key`, `status`, `memo`, `title`, `sub_title`, `editable_role`, `viewable_role`) VALUES
(1, '2023-01-17 07:52:53', '2023-01-17 07:52:53', 2, 2, 'main', 'image', 'Y', '', '', '', 'staff', 'staff'),
(2, '2023-01-17 07:53:36', '2023-01-17 07:53:36', 2, 1, 'main', 'title', 'Y', '', '', '', 'staff', 'staff'),
(3, '2023-01-17 07:53:52', '2023-01-17 07:53:52', 2, 3, 'block', 'file', 'Y', '', '', '', 'staff', 'staff'),
(4, '2023-01-17 07:54:33', '2023-01-17 07:54:33', 2, 4, 'block', 'all', 'Y', '', '', '', 'staff', 'staff'),
(5, '2023-01-17 07:55:21', '2023-01-17 07:55:21', 1, 1, 'main', 'category', 'Y', '', '', '', 'staff', 'staff'),
(6, '2023-01-17 07:55:42', '2023-01-17 07:55:42', 1, 2, 'main', 'title', 'Y', '', '', '', 'staff', 'staff'),
(7, '2023-01-17 07:55:50', '2023-01-17 07:55:50', 1, 3, 'block', 'all', 'Y', '', '', '', 'staff', 'staff'),
(8, '2023-01-17 07:55:58', '2023-01-17 07:55:58', 1, 4, 'block', 'image', 'Y', '', '', '', 'staff', 'staff'),
(9, '2023-01-17 07:56:07', '2023-01-17 07:56:07', 1, 5, 'block', 'content', 'Y', '', '', '', 'staff', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `phinxlog`
--

CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phinxlog`
--

INSERT INTO `phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20221208022223, 'Initial', '2022-12-08 08:55:06', '2022-12-08 08:55:07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date` date NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'publish',
  `memo` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `section_sequences`
--

CREATE TABLE `section_sequences` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `info_content_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `site_configs`
--

CREATE TABLE `site_configs` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` varchar(10) NOT NULL DEFAULT 'draft',
  `site_name` varchar(100) NOT NULL,
  `slug` varchar(40) NOT NULL,
  `is_root` decimal(10,0) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site_configs`
--

INSERT INTO `site_configs` (`id`, `created`, `modified`, `position`, `status`, `site_name`, `slug`, `is_root`) VALUES
(1, '2022-12-08 18:30:49', '2022-12-08 18:30:49', 1, 'publish', '大村商事', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `tag` varchar(40) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'publish',
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `page_config_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `useradmins`
--

CREATE TABLE `useradmins` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(200) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `temp_password` varchar(40) DEFAULT NULL,
  `temp_pass_expired` datetime DEFAULT NULL,
  `temp_key` varchar(200) DEFAULT NULL,
  `name` varchar(60) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'publish',
  `face_image` varchar(100) DEFAULT NULL,
  `role` int(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `useradmins`
--

INSERT INTO `useradmins` (`id`, `created`, `modified`, `email`, `username`, `password`, `temp_password`, `temp_pass_expired`, `temp_key`, `name`, `status`, `face_image`, `role`) VALUES
(1, '2022-12-08 18:28:07', '2022-12-08 18:30:57', '', 'develop', '', 'caters040917', '1900-01-01 00:00:00', '', '開発', 'publish', '', 0),
(2, '2022-12-08 18:28:07', '2022-12-08 18:30:57', '', 'admin', '', 'g05kHonV', '1900-01-01 00:00:00', '', '管理者', 'publish', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `useradmin_sites`
--

CREATE TABLE `useradmin_sites` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `useradmin_id` int(11) NOT NULL,
  `site_config_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `useradmin_sites`
--

INSERT INTO `useradmin_sites` (`id`, `created`, `modified`, `useradmin_id`, `site_config_id`) VALUES
(1, '2022-12-08 18:30:57', '2022-12-08 18:30:57', 1, 1),
(2, '2022-12-08 18:30:57', '2022-12-08 18:30:57', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `append_items`
--
ALTER TABLE `append_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `infos`
--
ALTER TABLE `infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info_append_items`
--
ALTER TABLE `info_append_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info_categories`
--
ALTER TABLE `info_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info_contents`
--
ALTER TABLE `info_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info_stock_tables`
--
ALTER TABLE `info_stock_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info_tags`
--
ALTER TABLE `info_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info_tops`
--
ALTER TABLE `info_tops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kvs`
--
ALTER TABLE `kvs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_lists`
--
ALTER TABLE `mst_lists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sys_cd` (`sys_cd`,`slug`,`ltrl_cd`),
  ADD KEY `sys_cd_2` (`sys_cd`,`slug`);

--
-- Indexes for table `page_configs`
--
ALTER TABLE `page_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_config_extensions`
--
ALTER TABLE `page_config_extensions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_config_items`
--
ALTER TABLE `page_config_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_config_id` (`page_config_id`);

--
-- Indexes for table `phinxlog`
--
ALTER TABLE `phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section_sequences`
--
ALTER TABLE `section_sequences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_configs`
--
ALTER TABLE `site_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `useradmins`
--
ALTER TABLE `useradmins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `useradmin_sites`
--
ALTER TABLE `useradmin_sites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `append_items`
--
ALTER TABLE `append_items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`

  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;


--
-- AUTO_INCREMENT for table `infos`
--
ALTER TABLE `infos`

  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;


--
-- AUTO_INCREMENT for table `info_append_items`
--
ALTER TABLE `info_append_items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `info_categories`
--
ALTER TABLE `info_categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `info_contents`
--
ALTER TABLE `info_contents`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `info_stock_tables`
--
ALTER TABLE `info_stock_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `info_tags`
--
ALTER TABLE `info_tags`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `info_tops`
--
ALTER TABLE `info_tops`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kvs`
--
ALTER TABLE `kvs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_lists`
--
ALTER TABLE `mst_lists`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `page_configs`
--
ALTER TABLE `page_configs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `page_config_extensions`
--
ALTER TABLE `page_config_extensions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `page_config_items`
--
ALTER TABLE `page_config_items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `section_sequences`
--
ALTER TABLE `section_sequences`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_configs`
--
ALTER TABLE `site_configs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `useradmins`
--
ALTER TABLE `useradmins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `useradmin_sites`
--
ALTER TABLE `useradmin_sites`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
