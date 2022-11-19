/*
 Navicat Premium Data Transfer

 Source Server         : MariaDB_Local
 Source Server Type    : MariaDB
 Source Server Version : 100420
 Source Host           : localhost:3306
 Source Schema         : hotspot

 Target Server Type    : MariaDB
 Target Server Version : 100420
 File Encoding         : 65001

 Date: 19/11/2022 15:50:17
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_mikrotik
-- ----------------------------
DROP TABLE IF EXISTS `admin_mikrotik`;
CREATE TABLE `admin_mikrotik`  (
  `id_m` int(11) NOT NULL AUTO_INCREMENT,
  `ip_mikrotik` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pass_m` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_m`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_mikrotik
-- ----------------------------
INSERT INTO `admin_mikrotik` VALUES (2, 'a7e20995a3b1.sn.mynetname.net', 'admin', 'admin');

-- ----------------------------
-- Table structure for akun_hotspot
-- ----------------------------
DROP TABLE IF EXISTS `akun_hotspot`;
CREATE TABLE `akun_hotspot`  (
  `id_h` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tipe` enum('voucher','member') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `profil` enum('guru','pegawai','siswa') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_h` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pass_h` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_h` enum('diterima','ditunda','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `masa_berlaku` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_kirim` int(11) NOT NULL,
  PRIMARY KEY (`id_h`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of akun_hotspot
-- ----------------------------
INSERT INTO `akun_hotspot` VALUES (1, 'emaildummy@gmail.com', 'member', 'siswa', '12345', '4321', 'diterima', '1', 1571316171);
INSERT INTO `akun_hotspot` VALUES (2, 'emaildummy@gmail.com', 'voucher', 'pegawai', '1234', '1234', 'diterima', '1', 1571315035);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nisn_nip` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `level` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah_max_akun` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_daftar` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'Admin', '11111111111111', 'emaildummy@gmail.com', '$2y$10$c2ih/rzL8VAgnssERQkjs.1o3C3PlHEzSPjoWtIdXtCAS0Z/iSGMK', 'admin', '1', '', 1570069394);

SET FOREIGN_KEY_CHECKS = 1;
