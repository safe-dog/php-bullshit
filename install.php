<?php
$table_settings = tablename("weapp_goupibutong_settings");
$table_ads = tablename("weapp_goupibutong_ads");

$sql = <<<EOT
CREATE TABLE IF NOT EXISTS $table_settings (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `key` varchar(255) NOT NULL DEFAULT '' COMMENT '对应的小程序appid',
  `title` varchar(255) NOT NULL DEFAULT "狗屁不通文章生成器" COMMENT '小程序标题',
  `keywords` varchar(255) COMMENT '默认关键字列表,分割',
  `logo` varchar(255) COMMENT '小程序logo',
  `share_img` varchar(255) COMMENT '分享图片',
  `share_txt` varchar(255) COMMENT '分享文字',
  `created_at` int(11) COMMENT '创建时间',
  `updated_at` int(11) COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS $table_ads (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `key` varchar(255) NOT NULL DEFAULT '' COMMENT '对应的小程序appid',
  `ad01` varchar(255) COMMENT '首页banner广告',
  `enabled` int(11) NOT NULL DEFAULT 1 COMMENT '开启广告',
  `created_at` int(11) COMMENT '创建时间',
  `updated_at` int(11) COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
EOT;

pdo_query($sql);