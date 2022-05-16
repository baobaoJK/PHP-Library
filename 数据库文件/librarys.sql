/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : library

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 16/05/2022 10:37:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for book
-- ----------------------------
DROP TABLE IF EXISTS `book`;
CREATE TABLE `book`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `groups` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `author` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `press` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `price` double(10, 2) NOT NULL DEFAULT 0.00,
  `quantity` int(5) NOT NULL DEFAULT 0,
  `isbn` varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of book
-- ----------------------------
INSERT INTO `book` VALUES (1, '地理', '房龙地理', '房龙', '文汇出版社', 29.00, 9, '9780000000001');
INSERT INTO `book` VALUES (2, '地理', '地理学与生活', '[美] 阿瑟·格蒂斯 ', '世界图书出版公司', 49.00, 9, '9780000000002');
INSERT INTO `book` VALUES (3, '地理', '古老阳光的末日', 'Thom Hartmann', '上海远东出版社', 20.00, 9, '9780000000003');
INSERT INTO `book` VALUES (4, '法律', '洞穴奇案', '[美] 萨伯', '生活.读书.新知三联书店', 18.00, 9, '9780000000004');
INSERT INTO `book` VALUES (5, '法律', '西窗法雨', '刘星', '法律出版社', 24.00, 9, '9780000000005');
INSERT INTO `book` VALUES (6, '法律', '审判为什么不公正', '[英] 卡德里', '新星出版社', 49.50, 9, '9780000000006');
INSERT INTO `book` VALUES (7, '军事', '亮剑（舒适阅读版）', '都梁', '北京联合出版公司', 45.00, 9, '9780000000007');
INSERT INTO `book` VALUES (8, '军事', '二战记忆 安妮日记', '[德] 安妮·弗兰克', '人民文学出版社', 23.00, 9, '9780000000008');
INSERT INTO `book` VALUES (9, '军事', '亮剑', '都梁', '解放军文艺出版社', 25.00, 9, '9780000000009');
INSERT INTO `book` VALUES (10, '历史', '历史是什么？', '爱德华·霍列特·卡尔', '商务印书馆', 19.00, 9, '9780000000010');
INSERT INTO `book` VALUES (11, '历史', '中国史学史', '金毓黻', '商务印书馆', 19.00, 9, '9780000000011');
INSERT INTO `book` VALUES (12, '历史', '史记选', '[清] 储欣', '商务印书馆', 48.00, 9, '9780000000012');
INSERT INTO `book` VALUES (13, '计算机', 'Java从入门到精通 ', '明日科技', '清华大学出版社', 69.00, 9, '9780000000013');
INSERT INTO `book` VALUES (14, '计算机', 'C++从入门到精通', '李伟明', '清华大学出版社', 49.00, 9, '9780000000014');
INSERT INTO `book` VALUES (15, '计算机', 'PHP从入门到精通', '千锋教育高教产品研发部', '清华大学出版社', 59.00, 9, '9780000000015');
INSERT INTO `book` VALUES (16, '地理', 'test', 'test', 'test', 66.00, 11, '1234567890');

-- ----------------------------
-- Table structure for book_type
-- ----------------------------
DROP TABLE IF EXISTS `book_type`;
CREATE TABLE `book_type`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of book_type
-- ----------------------------
INSERT INTO `book_type` VALUES (1, '地理');
INSERT INTO `book_type` VALUES (2, '法律');
INSERT INTO `book_type` VALUES (3, '军事');
INSERT INTO `book_type` VALUES (4, '历史');
INSERT INTO `book_type` VALUES (5, '计算机');

-- ----------------------------
-- Table structure for borrow
-- ----------------------------
DROP TABLE IF EXISTS `borrow`;
CREATE TABLE `borrow`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `isbn` varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `id_card` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `phone` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `time` datetime(0) NOT NULL DEFAULT '1970-01-01 00:00:00',
  `r_time` datetime(0) NOT NULL DEFAULT '1970-01-01 00:00:00',
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of borrow
-- ----------------------------
INSERT INTO `borrow` VALUES (1, '房龙地理', '9780000000001', '张一', '22020001', '13700000001', '2022-05-10 10:00:00', '2022-05-10 15:00:00');
INSERT INTO `borrow` VALUES (2, '地理学与生活', '9780000000002', '张一', '22020001', '13700000001', '2022-05-10 10:00:00', '2022-05-10 15:00:00');
INSERT INTO `borrow` VALUES (3, '古老阳光的末日', '9780000000003', '张一', '22020001', '13700000001', '2022-05-10 10:00:00', '2022-05-10 15:00:00');
INSERT INTO `borrow` VALUES (4, '洞穴奇案', '9780000000004', '张一', '22020001', '13700000001', '2022-05-10 10:00:00', '2022-05-31 15:00:00');
INSERT INTO `borrow` VALUES (5, '西窗法雨', '9780000000005', '张一', '22020001', '13700000001', '2022-05-10 10:00:00', '2022-05-31 15:00:00');
INSERT INTO `borrow` VALUES (6, '审判为什么不公正', '9780000000006', '张一', '22020001', '13700000001', '2022-05-10 10:00:00', '2022-05-31 15:00:00');
INSERT INTO `borrow` VALUES (7, '亮剑（舒适阅读版）', '9780000000007', '张一', '22020001', '13700000001', '2022-05-10 10:00:00', '2022-05-31 15:00:00');
INSERT INTO `borrow` VALUES (8, '二战记忆 安妮日记', '9780000000008', '张一', '22020001', '13700000001', '2022-05-10 10:00:00', '2022-05-31 15:00:00');
INSERT INTO `borrow` VALUES (9, '亮剑', '9780000000009', '张一', '22020001', '13700000001', '2022-05-10 10:00:00', '2022-05-31 15:00:00');
INSERT INTO `borrow` VALUES (10, '历史是什么？', '9780000000010', '张一', '22020001', '13700000001', '2022-05-10 10:00:00', '2022-05-31 15:00:00');
INSERT INTO `borrow` VALUES (11, '中国史学史', '9780000000011', '张一', '22020001', '13700000001', '2022-05-10 10:00:00', '2022-05-10 15:00:00');
INSERT INTO `borrow` VALUES (12, '史记选', '9780000000012', '张一', '22020001', '13700000001', '2022-05-10 10:00:00', '2022-05-10 15:00:00');
INSERT INTO `borrow` VALUES (13, 'Java从入门到精通 ', '9780000000013', '张一', '22020001', '13700000001', '2022-05-10 10:00:00', '2022-05-10 15:00:00');
INSERT INTO `borrow` VALUES (14, 'C++从入门到精通', '9780000000014', '张一', '22020001', '13700000001', '2022-05-10 10:00:00', '2022-05-10 15:00:00');
INSERT INTO `borrow` VALUES (15, 'PHP从入门到精通', '9780000000015', '张一', '22020001', '13700000001', '2022-05-10 10:00:00', '2022-05-10 15:00:00');

-- ----------------------------
-- Table structure for operation_record
-- ----------------------------
DROP TABLE IF EXISTS `operation_record`;
CREATE TABLE `operation_record`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `time` datetime(0) NOT NULL DEFAULT '1970-01-01 00:00:00',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `book_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `info` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 29 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of operation_record
-- ----------------------------
INSERT INTO `operation_record` VALUES (1, '1970-01-01 00:00:00', '张一', '房龙地理', '借走了 房龙地理 书籍');
INSERT INTO `operation_record` VALUES (2, '1970-01-01 00:00:00', '张一', '房龙地理', '借走了 房龙地理 书籍');
INSERT INTO `operation_record` VALUES (3, '1970-01-01 00:00:00', '张一', '房龙地理', '借走了 房龙地理 书籍');
INSERT INTO `operation_record` VALUES (4, '1970-01-01 00:00:00', '张一', '房龙地理', '借走了 房龙地理 书籍');
INSERT INTO `operation_record` VALUES (5, '1970-01-01 00:00:00', '张一', '房龙地理', '借走了 房龙地理 书籍');
INSERT INTO `operation_record` VALUES (6, '1970-01-01 00:00:00', '张一', '房龙地理', '借走了 房龙地理 书籍');
INSERT INTO `operation_record` VALUES (7, '1970-01-01 00:00:00', '张一', '房龙地理', '借走了 房龙地理 书籍');
INSERT INTO `operation_record` VALUES (8, '1970-01-01 00:00:00', '张一', '房龙地理', '借走了 房龙地理 书籍');
INSERT INTO `operation_record` VALUES (9, '1970-01-01 00:00:00', '张一', '房龙地理', '借走了 房龙地理 书籍');
INSERT INTO `operation_record` VALUES (10, '1970-01-01 00:00:00', '张一', '房龙地理', '借走了 房龙地理 书籍');
INSERT INTO `operation_record` VALUES (11, '1970-01-01 00:00:00', '张一', '房龙地理', '借走了 房龙地理 书籍');
INSERT INTO `operation_record` VALUES (12, '1970-01-01 00:00:00', '张一', '房龙地理', '借走了 房龙地理 书籍');
INSERT INTO `operation_record` VALUES (13, '1970-01-01 00:00:00', '张一', '房龙地理', '借走了 房龙地理 书籍');
INSERT INTO `operation_record` VALUES (14, '1970-01-01 00:00:00', '张一', '房龙地理', '借走了 房龙地理 书籍');
INSERT INTO `operation_record` VALUES (15, '1970-01-01 00:00:00', '张一', '房龙地理', '借走了 房龙地理 书籍');
INSERT INTO `operation_record` VALUES (16, '1970-01-01 00:00:00', '张一', '房龙地理', '借走了 房龙地理 书籍');
INSERT INTO `operation_record` VALUES (17, '1970-01-01 00:00:00', '张一', '房龙地理', '借走了 房龙地理 书籍');
INSERT INTO `operation_record` VALUES (18, '1970-01-01 00:00:00', '张一', '房龙地理', '借走了 房龙地理 书籍');
INSERT INTO `operation_record` VALUES (19, '1970-01-01 00:00:00', '张一', '房龙地理', '借走了 房龙地理 书籍');
INSERT INTO `operation_record` VALUES (20, '1970-01-01 00:00:00', '张一', '房龙地理', '借走了 房龙地理 书籍');
INSERT INTO `operation_record` VALUES (21, '2022-05-13 10:12:33', '张一', 'PHP从入门到精通', '借走了 PHP从入门到精通 书籍');
INSERT INTO `operation_record` VALUES (22, '2022-05-16 08:32:40', '张一', 'PHP从入门到精通', '借走了 PHP从入门到精通 书籍');
INSERT INTO `operation_record` VALUES (23, '2022-05-16 08:33:19', '张一', 'PHP从入门到精通', '借走了 PHP从入门到精通 书籍');
INSERT INTO `operation_record` VALUES (24, '2022-05-16 09:30:13', '张一', 'PHP从入门到精通', '归还了 PHP从入门到精通 书籍');
INSERT INTO `operation_record` VALUES (25, '2022-05-16 09:33:02', '张一', 'PHP从入门到精通', '归还了 PHP从入门到精通 书籍');
INSERT INTO `operation_record` VALUES (26, '2022-05-16 09:33:59', '张一', 'PHP从入门到精通', '归还了 PHP从入门到精通 书籍');
INSERT INTO `operation_record` VALUES (27, '2022-05-16 09:35:56', '张一', 'test', '借走了 test 书籍');
INSERT INTO `operation_record` VALUES (28, '2022-05-16 09:36:07', '张一', 'test', '归还了 test 书籍');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `groups` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'user',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `gender` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `id_card` int(8) NOT NULL DEFAULT 0,
  `phone` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `identity` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '学生',
  `book_count` int(255) NOT NULL DEFAULT 3,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', '管理员', 'Admin', '123456', '男', 22020000, '13700000000', '管理员', 3);
INSERT INTO `user` VALUES (2, 'user', '张一', '张一', '123456', '男', 22020001, '13700000001', '学生', 3);
INSERT INTO `user` VALUES (3, 'user', '张二', '张二', '123456', '男', 22020002, '13700000002', '学生', 3);
INSERT INTO `user` VALUES (4, 'user', '张三', '张三', '123456', '男', 22020003, '13700000003', '学生', 3);
INSERT INTO `user` VALUES (5, 'user', '张四', '张四', '123456', '男', 22020004, '13700000004', '学生', 3);
INSERT INTO `user` VALUES (6, 'user', '张五', '张五', '123456', '男', 22020005, '13700000005', '学生', 3);
INSERT INTO `user` VALUES (7, 'user', '李一', '李一', '123456', '男', 22020006, '13700000006', '老师', 3);
INSERT INTO `user` VALUES (8, 'user', '李二', '李二', '123456', '男', 22020007, '13700000007', '老师', 3);
INSERT INTO `user` VALUES (9, 'user', '李三', '李三', '123456', '男', 22020008, '13700000008', '老师', 3);
INSERT INTO `user` VALUES (10, 'user', '李四', '李四', '123456', '男', 22020009, '13700000009', '老师', 3);
INSERT INTO `user` VALUES (11, 'user', '李五', '李五', '123456', '男', 22020010, '13700000010', '老师', 3);
INSERT INTO `user` VALUES (12, 'user', '赵一', '赵一', '123456', '男', 22020011, '13700000011', '学生', 3);
INSERT INTO `user` VALUES (13, 'user', '赵二', '赵二', '123456', '男', 22020012, '13700000012', '学生', 3);
INSERT INTO `user` VALUES (14, 'user', '赵三', '赵三', '123456', '男', 22020013, '13700000013', '学生', 3);
INSERT INTO `user` VALUES (15, 'user', '赵四', '赵四', '123456', '男', 22020014, '13700000014', '学生', 3);
INSERT INTO `user` VALUES (16, 'user', '赵五', '赵五', '123456', '男', 22020015, '13700000015', '学生', 3);
INSERT INTO `user` VALUES (17, 'user', '法外狂徒', '法外狂徒', '123456', '男', 22020016, '13700000016', '学生', 3);

SET FOREIGN_KEY_CHECKS = 1;
