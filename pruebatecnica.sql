/*
 Navicat Premium Data Transfer

 Source Server         : CEMLA_LOCAL
 Source Server Type    : MySQL
 Source Server Version : 50736
 Source Host           : localhost:3306
 Source Schema         : pruebatecnica

 Target Server Type    : MySQL
 Target Server Version : 50736
 File Encoding         : 65001

 Date: 13/06/2022 16:16:44
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `color` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 'a@a.com', '1234567890', 'Azul');
INSERT INTO `usuarios` VALUES (2, 'abcd@a.com', 'abcdefghijklm', 'Amarillo');
INSERT INTO `usuarios` VALUES (3, 'q@a.com', '1234567980', 'Rojo');
INSERT INTO `usuarios` VALUES (4, 'harry@gmail.com', '1234567890', 'Rojo');

SET FOREIGN_KEY_CHECKS = 1;
