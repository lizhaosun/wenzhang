-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.5.53 - MySQL Community Server (GPL)
-- 服务器操作系统:                      Win32
-- HeidiSQL 版本:                  9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- 导出 think 的数据库结构
CREATE DATABASE IF NOT EXISTS `think` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `think`;

-- 导出  表 think.think_article 结构
CREATE TABLE IF NOT EXISTS `think_article` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) NOT NULL COMMENT '文档标题',
  `title_img` varchar(200) NOT NULL COMMENT '标题图片',
  `is_hot` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否热门1是 0否',
  `is_top` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否置顶1是 0否',
  `cate_id` int(10) NOT NULL COMMENT '栏目主键',
  `user_id` int(10) NOT NULL COMMENT '用户主键',
  `content` text NOT NULL COMMENT '文档内容',
  `pv` int(10) NOT NULL DEFAULT '0' COMMENT '阅读量',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态 1显示 0隐藏',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

-- 正在导出表  think.think_article 的数据：3 rows
/*!40000 ALTER TABLE `think_article` DISABLE KEYS */;
INSERT INTO `think_article` (`id`, `title`, `title_img`, `is_hot`, `is_top`, `cate_id`, `user_id`, `content`, `pv`, `status`, `create_time`, `update_time`) VALUES
	(50, '最美的期待 周笔畅', '20190326\\33dce20dc5d53a162caf6232cff85c29.jpg', 0, 0, 2, 148, '最美的期待 周笔畅<br>', 7, 1, 1553573221, 1553573221),
	(49, '侧脸 于果', '20190326\\6e6d46b884fdb8bd853f475bc08dcdf0.jpg', 0, 0, 3, 148, '侧脸 于果<br>', 8, 1, 1553573197, 1553573197),
	(48, '好好学习天天向上', '20190326\\762bb1636315c44e6e9225586c49ff5a.jpg', 0, 0, 3, 148, '好好学习天天向上<br>', 26, 1, 1553573143, 1553573143);
/*!40000 ALTER TABLE `think_article` ENABLE KEYS */;

-- 导出  表 think.think_article_category 结构
CREATE TABLE IF NOT EXISTS `think_article_category` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_id` int(10) NOT NULL COMMENT '用户主键',
  `name` varchar(100) NOT NULL COMMENT '栏目名称',
  `sort` int(4) NOT NULL COMMENT '栏目排序',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态 1启用0禁用',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- 正在导出表  think.think_article_category 的数据：5 rows
/*!40000 ALTER TABLE `think_article_category` DISABLE KEYS */;
INSERT INTO `think_article_category` (`id`, `user_id`, `name`, `sort`, `status`, `create_time`, `update_time`) VALUES
	(3, 0, 'MySQL', 2, 1, 1550738318, 1550738318),
	(2, 0, 'PHP', 1, 1, 1550738318, 1550738318),
	(1, 0, '前端', 3, 1, 1550738318, 1550738318),
	(5, 0, 'Java', 5, 1, 1550738318, 1550738318),
	(6, 0, 'JS', 6, 1, 1550738318, 1550738318);
/*!40000 ALTER TABLE `think_article_category` ENABLE KEYS */;

-- 导出  表 think.think_pinglun 结构
CREATE TABLE IF NOT EXISTS `think_pinglun` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_id` int(4) unsigned NOT NULL COMMENT '用户主键',
  `art_id` int(4) unsigned NOT NULL COMMENT '文章主键',
  `lou` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '评论楼数',
  `reply_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复id',
  `status` tinyint(4) unsigned NOT NULL COMMENT '状态 1显示0隐藏',
  `content` text NOT NULL COMMENT '评论',
  `create_time` int(10) unsigned NOT NULL COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=187 DEFAULT CHARSET=utf8 COMMENT='评论';

-- 正在导出表  think.think_pinglun 的数据：4 rows
/*!40000 ALTER TABLE `think_pinglun` DISABLE KEYS */;
INSERT INTO `think_pinglun` (`id`, `user_id`, `art_id`, `lou`, `reply_id`, `status`, `content`, `create_time`, `update_time`) VALUES
	(172, 148, 50, 1, 1, 1, '还不错', 1553573237, 1553573237),
	(173, 148, 49, 1, 1, 1, '非常不错', 1553573267, 1553573267),
	(174, 148, 49, 2, 1, 1, '是吧', 1553573409, 1553573409),
	(175, 148, 49, 3, 1, 1, '尴尬了', 1553573464, 1553573464),
	(186, 133, 48, 2, 1, 1, '草\r\n', 1553574351, 1553574351),
	(185, 133, 48, 1, 1, 1, '我', 1553574346, 1553574346);
/*!40000 ALTER TABLE `think_pinglun` ENABLE KEYS */;

-- 导出  表 think.think_site 结构
CREATE TABLE IF NOT EXISTS `think_site` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) NOT NULL DEFAULT '默认站点' COMMENT '网站名称',
  `keywords` text NOT NULL COMMENT '关键字',
  `desc` text NOT NULL COMMENT '网站描述',
  `is_open` tinyint(4) NOT NULL DEFAULT '1' COMMENT '开启状态1 1开 0关',
  `is_comment` tinyint(4) NOT NULL DEFAULT '1' COMMENT '允许评论 1开 0关',
  `is_reg` tinyint(4) NOT NULL DEFAULT '1' COMMENT '允许注册 1开0关',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态 1允许 0禁用',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- 正在导出表  think.think_site 的数据：1 rows
/*!40000 ALTER TABLE `think_site` DISABLE KEYS */;
INSERT INTO `think_site` (`id`, `name`, `keywords`, `desc`, `is_open`, `is_comment`, `is_reg`, `status`, `create_time`, `update_time`) VALUES
	(1, '默认站点', '文章', '发布文章测试', 1, 1, 1, 1, 0, 0);
/*!40000 ALTER TABLE `think_site` ENABLE KEYS */;

-- 导出  表 think.think_user 结构
CREATE TABLE IF NOT EXISTS `think_user` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID主键',
  `name` varchar(30) DEFAULT '0' COMMENT '用户名',
  `email` varchar(200) DEFAULT '0' COMMENT '邮箱',
  `mobile` char(12) DEFAULT '0' COMMENT '手机号',
  `password` char(50) DEFAULT '0' COMMENT '密码',
  `status` int(2) DEFAULT '1' COMMENT '状态',
  `is_admin` int(2) DEFAULT '0' COMMENT '管理员',
  `admin_level` int(2) DEFAULT '0' COMMENT '管理员等级',
  `create_time` int(10) DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=149 DEFAULT CHARSET=utf8 COMMENT='账号密码表';

-- 正在导出表  think.think_user 的数据：2 rows
/*!40000 ALTER TABLE `think_user` DISABLE KEYS */;
INSERT INTO `think_user` (`id`, `name`, `email`, `mobile`, `password`, `status`, `is_admin`, `admin_level`, `create_time`, `update_time`) VALUES
	(148, 'lzs123123', 'lzs@163.com', '15874563212', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 1, 0, 0, 1553573083, 1553573083),
	(133, 'lzs592598525', 'lzs592598525@163.com', '15874569852', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 1, 1, 1, 1550228736, 1550228736);
/*!40000 ALTER TABLE `think_user` ENABLE KEYS */;

-- 导出  表 think.think_user_fav 结构
CREATE TABLE IF NOT EXISTS `think_user_fav` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `article_id` int(10) NOT NULL DEFAULT '0' COMMENT '文档主键',
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '用户主键',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

-- 正在导出表  think.think_user_fav 的数据：2 rows
/*!40000 ALTER TABLE `think_user_fav` DISABLE KEYS */;
INSERT INTO `think_user_fav` (`id`, `article_id`, `user_id`) VALUES
	(60, 49, 148),
	(59, 50, 148);
/*!40000 ALTER TABLE `think_user_fav` ENABLE KEYS */;

-- 导出  表 think.think_user_ok 结构
CREATE TABLE IF NOT EXISTS `think_user_ok` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `article_id` int(10) NOT NULL DEFAULT '0' COMMENT '文档主键',
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '用户主键',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- 正在导出表  think.think_user_ok 的数据：2 rows
/*!40000 ALTER TABLE `think_user_ok` DISABLE KEYS */;
INSERT INTO `think_user_ok` (`id`, `article_id`, `user_id`) VALUES
	(14, 50, 148),
	(15, 49, 148);
/*!40000 ALTER TABLE `think_user_ok` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
