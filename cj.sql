/*
 Navicat Premium Data Transfer

 Source Server         : a
 Source Server Type    : MySQL
 Source Server Version : 50619
 Source Host           : localhost
 Source Database       : cj

 Target Server Type    : MySQL
 Target Server Version : 50619
 File Encoding         : utf-8

 Date: 01/23/2015 19:07:55 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(13) DEFAULT NULL,
  `pass` varchar(255) NOT NULL,
  `cj_data` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `user`
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES ('1', '2012311674', '021995', '{\"error\":0,\"score\":[{\"kch\":\"177000010\",\"kxh\":\"403\",\"kcm\":\"\\u6559\\u80b2\\u793e\\u4f1a\\u5b66\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u4efb\\u9009\",\"cj\":\"100\"},{\"kch\":\"177000050\",\"kxh\":\"400\",\"kcm\":\"\\u73ed\\u4e3b\\u4efb\\u5de5\\u4f5c\\u827a\\u672f\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u4efb\\u9009\",\"cj\":\"78\"},{\"kch\":\"310120035\",\"kxh\":\"01\",\"kcm\":\"\\u7efc\\u5408\\u9020\\u578b\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u9009\\u4fee\",\"cj\":\"\"},{\"kch\":\"310133045\",\"kxh\":\"01\",\"kcm\":\"\\u7efc\\u5408\\u7ed8\\u753b\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u9009\\u4fee\",\"cj\":\"\"},{\"kch\":\"310133055\",\"kxh\":\"01\",\"kcm\":\"\\u7efc\\u5408\\u7ed8\\u753b\\u4e0e\\u6750\\u6599\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u9009\\u4fee\",\"cj\":\"\"},{\"kch\":\"2790510\",\"kxh\":\"401\",\"kcm\":\"\\u5fc3\\u7406\\u5b66\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u5fc5\\u4fee\",\"cj\":\"\"},{\"kch\":\"310110225\",\"kxh\":\"01\",\"kcm\":\"\\u7ed8\\u753b\\u7f8e\\u5b66\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u5fc5\\u4fee\",\"cj\":\"\"},{\"kch\":\"310110335\",\"kxh\":\"01\",\"kcm\":\"\\u7f8e\\u672f\\u5b66\\u79d1\\u6559\\u5b66\\u8bba\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u5fc5\\u4fee\",\"cj\":\"\"},{\"kch\":\"2790520\",\"kxh\":\"410\",\"kcm\":\"\\u6559\\u80b2\\u5b66\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u5fc5\\u4fee\",\"cj\":\"\"},{\"kch\":\"4390015\",\"kxh\":\"401\",\"kcm\":\"\\u73b0\\u4ee3\\u6559\\u80b2\\u6280\\u672f\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u5fc5\\u4fee\",\"cj\":\"\"},{\"kch\":\"310110205\",\"kxh\":\"04\",\"kcm\":\"\\u98ce\\u666f\\u5199\\u751f\\uff08\\u4e8c\\uff09\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u5fc5\\u4fee\",\"cj\":\"\\u826f\\u597d\"},{\"kch\":\"310110215\",\"kxh\":\"03\",\"kcm\":\"\\u521b\\u4f5c\\u7ec3\\u4e60\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u5fc5\\u4fee\",\"cj\":\"90\"}]}'), ('2', '2012311674', '021995', '{\"error\":0,\"score\":[{\"kch\":\"177000010\",\"kxh\":\"403\",\"kcm\":\"\\u6559\\u80b2\\u793e\\u4f1a\\u5b66\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u4efb\\u9009\",\"cj\":\"\"},{\"kch\":\"177000050\",\"kxh\":\"400\",\"kcm\":\"\\u73ed\\u4e3b\\u4efb\\u5de5\\u4f5c\\u827a\\u672f\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u4efb\\u9009\",\"cj\":\"78\"},{\"kch\":\"310120035\",\"kxh\":\"01\",\"kcm\":\"\\u7efc\\u5408\\u9020\\u578b\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u9009\\u4fee\",\"cj\":\"\"},{\"kch\":\"310133045\",\"kxh\":\"01\",\"kcm\":\"\\u7efc\\u5408\\u7ed8\\u753b\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u9009\\u4fee\",\"cj\":\"\"},{\"kch\":\"310133055\",\"kxh\":\"01\",\"kcm\":\"\\u7efc\\u5408\\u7ed8\\u753b\\u4e0e\\u6750\\u6599\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u9009\\u4fee\",\"cj\":\"\"},{\"kch\":\"2790510\",\"kxh\":\"401\",\"kcm\":\"\\u5fc3\\u7406\\u5b66\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u5fc5\\u4fee\",\"cj\":\"\"},{\"kch\":\"310110225\",\"kxh\":\"01\",\"kcm\":\"\\u7ed8\\u753b\\u7f8e\\u5b66\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u5fc5\\u4fee\",\"cj\":\"\"},{\"kch\":\"310110335\",\"kxh\":\"01\",\"kcm\":\"\\u7f8e\\u672f\\u5b66\\u79d1\\u6559\\u5b66\\u8bba\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u5fc5\\u4fee\",\"cj\":\"\"},{\"kch\":\"2790520\",\"kxh\":\"410\",\"kcm\":\"\\u6559\\u80b2\\u5b66\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u5fc5\\u4fee\",\"cj\":\"\"},{\"kch\":\"4390015\",\"kxh\":\"401\",\"kcm\":\"\\u73b0\\u4ee3\\u6559\\u80b2\\u6280\\u672f\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u5fc5\\u4fee\",\"cj\":\"\"},{\"kch\":\"310110205\",\"kxh\":\"04\",\"kcm\":\"\\u98ce\\u666f\\u5199\\u751f\\uff08\\u4e8c\\uff09\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u5fc5\\u4fee\",\"cj\":\"\\u826f\\u597d\"},{\"kch\":\"310110215\",\"kxh\":\"03\",\"kcm\":\"\\u521b\\u4f5c\\u7ec3\\u4e60\",\"ywkcm\":\"\",\"xf\":\"2\",\"kcsx\":\"\\u5fc5\\u4fee\",\"cj\":\"87\"}]}');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
