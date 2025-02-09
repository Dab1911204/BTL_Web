-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 26, 2024 lúc 05:59 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `btl_web`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `id` int(20) NOT NULL,
  `maDonhang` int(20) NOT NULL,
  `maSanPham` int(20) NOT NULL,
  `donGia` int(20) NOT NULL,
  `soLuong` int(10) NOT NULL,
  `tongGia` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`id`, `maDonhang`, `maSanPham`, `donGia`, `soLuong`, `tongGia`) VALUES
(0, 1, 1, 15000, 2, 30000),
(0, 1, 3, 12000, 3, 36000),
(0, 1, 5, 25000, 1, 25000),
(0, 2, 6, 10000, 3, 30000),
(0, 2, 9, 18000, 2, 36000),
(0, 2, 12, 18000, 5, 90000),
(0, 3, 2, 18000, 2, 36000),
(0, 3, 4, 20000, 3, 60000),
(0, 3, 8, 12000, 1, 12000),
(0, 4, 3, 12000, 2, 24000),
(0, 4, 5, 25000, 1, 25000),
(0, 4, 7, 15000, 3, 45000),
(0, 5, 11, 15000, 4, 60000),
(0, 5, 20, 25000, 2, 50000),
(0, 207, 20, 25000, 1, 0),
(0, 207, 19, 20000, 1, 0),
(0, 207, 18, 22000, 1, 0),
(0, 210, 20, 25000, 1, 0),
(0, 210, 19, 20000, 1, 0),
(0, 210, 18, 22000, 1, 0),
(0, 211, 20, 25000, 1, 0),
(0, 211, 19, 20000, 1, 0),
(0, 211, 18, 22000, 1, 0),
(0, 212, 5, 25000, 1, 0),
(0, 213, 10, 20000, 52, 0),
(0, 214, 5, 25000, 6, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `maDanhMuc` int(20) NOT NULL,
  `tenDanhMuc` varchar(255) NOT NULL,
  `danhMucCha` int(20) NOT NULL,
  `duongDan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`maDanhMuc`, `tenDanhMuc`, `danhMucCha`, `duongDan`) VALUES
(1, 'Rau', -1, 'rau'),
(2, 'Củ', 1, '/danhmuc/cu'),
(3, 'Trái cây', -1, 'trai-cay'),
(13, 'Trong nước', 3, 'trong-nuoc'),
(14, 'Nhập khẩu', 3, 'nhap-khau'),
(15, 'Rau lá', 1, 'rau-la'),
(16, 'Nấm', 1, 'nam');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `maDonhang` int(20) NOT NULL,
  `maKhachHang` varchar(20) NOT NULL,
  `thoiGianDat` datetime NOT NULL,
  `diaChiKhachHang` varchar(255) NOT NULL,
  `tongGiaTri` int(100) NOT NULL,
  `ghiChu` varchar(200) DEFAULT NULL,
  `tinhTrang` enum('Chờ xử lý','Đã xác nhận','Đang giao','Đã giao','Đã hủy') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Chờ xử lý' COMMENT '0: Chờ xử lý, 1: Đã xác nhận, 2:Đang giao, 3:Đã giao, 4: Đã hủy'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`maDonhang`, `maKhachHang`, `thoiGianDat`, `diaChiKhachHang`, `tongGiaTri`, `ghiChu`, `tinhTrang`) VALUES
(1, 'KH1', '2024-06-28 00:00:00', '123 Đường ABC, Quận XYZ, TP HCM', 500000, 'Đơn hàng đầu tiên', 'Đã giao'),
(2, 'KH2', '2024-06-27 00:00:00', '456 Đường DEF, Quận UVW, Hà Nội', 300000, 'Đơn hàng số 2', 'Đã giao'),
(3, 'KH3', '2024-06-26 00:00:00', '789 Đường GHI, Quận KLM, Đà Nẵng', 150000, 'Đơn hàng số 3', 'Đã giao'),
(4, 'KH4', '2024-06-25 00:00:00', '012 Đường JKL, Quận PQR, Cần Thơ', 200000, 'Đơn hàng số 4', 'Đã giao'),
(5, 'KH5', '2024-06-24 00:00:00', '345 Đường MNO, Quận STU, Hải Phòng', 400000, 'Đơn hàng số 5', 'Đã giao'),
(6, 'KH1', '2022-09-08 05:56:54', '101 Đường Sồi, Huế', 451100, NULL, 'Đã giao'),
(7, 'KH3', '2020-03-18 14:20:22', '101 Đường Sồi, Huế', 891388, NULL, 'Đã giao'),
(8, 'KH4', '2020-06-08 11:11:53', '123 Đường Chính, Hà Nội', 297254, 'Ghi chú 8', 'Đã giao'),
(9, 'KH1', '2023-01-22 22:59:38', '202 Đường Thông, Nha Trang', 801882, NULL, 'Đã giao'),
(10, 'KH3', '2020-12-26 21:36:04', '456 Đường Phố, Sài Gòn', 886517, 'Ghi chú 10', 'Đã giao'),
(11, 'KH5', '2021-05-09 23:49:50', '202 Đường Thông, Nha Trang', 248681, 'Ghi chú 11', 'Đã giao'),
(12, 'KH2', '2021-02-22 20:21:51', '123 Đường Chính, Hà Nội', 259429, 'Ghi chú 12', 'Đã giao'),
(13, 'KH4', '2023-02-23 17:50:56', '101 Đường Sồi, Huế', 219496, NULL, 'Đã giao'),
(14, 'KH5', '2023-08-26 18:08:46', '456 Đường Phố, Sài Gòn', 693849, 'Ghi chú 14', 'Đã giao'),
(15, 'KH5', '2021-09-01 23:17:01', '123 Đường Chính, Hà Nội', 647692, NULL, 'Đã giao'),
(16, 'KH5', '2022-11-25 01:59:59', '123 Đường Chính, Hà Nội', 901222, NULL, 'Đã giao'),
(17, 'KH2', '2024-04-23 22:43:46', '101 Đường Sồi, Huế', 654036, 'Ghi chú 17', 'Đã giao'),
(18, 'KH5', '2024-03-13 02:29:39', '101 Đường Sồi, Huế', 447311, NULL, 'Đã giao'),
(19, 'KH1', '2021-08-29 00:24:35', '456 Đường Phố, Sài Gòn', 941849, NULL, 'Đã giao'),
(20, 'KH2', '2020-02-04 07:51:48', '202 Đường Thông, Nha Trang', 722695, NULL, 'Đã giao'),
(21, 'KH5', '2023-08-07 07:15:48', '456 Đường Phố, Sài Gòn', 944091, 'Ghi chú 21', 'Đã giao'),
(22, 'KH4', '2024-01-18 14:30:54', '456 Đường Phố, Sài Gòn', 654152, 'Ghi chú 22', 'Đã giao'),
(23, 'KH5', '2020-06-30 00:57:02', '456 Đường Phố, Sài Gòn', 304446, NULL, 'Đã giao'),
(24, 'KH4', '2021-04-28 19:42:56', '101 Đường Sồi, Huế', 799886, NULL, 'Đã giao'),
(25, 'KH4', '2020-05-23 15:40:21', '202 Đường Thông, Nha Trang', 510126, NULL, 'Đã giao'),
(26, 'KH3', '2020-08-10 15:01:38', '101 Đường Sồi, Huế', 181504, 'Ghi chú 26', 'Đã giao'),
(27, 'KH3', '2022-10-22 11:55:56', '123 Đường Chính, Hà Nội', 719203, 'Ghi chú 27', 'Đã giao'),
(28, 'KH1', '2023-06-08 05:47:51', '123 Đường Chính, Hà Nội', 376110, 'Ghi chú 28', 'Đã giao'),
(29, 'KH5', '2023-09-27 05:33:16', '123 Đường Chính, Hà Nội', 945043, 'Ghi chú 29', 'Đã giao'),
(30, 'KH2', '2023-07-28 17:03:19', '456 Đường Phố, Sài Gòn', 183682, 'Ghi chú 30', 'Đã giao'),
(31, 'KH5', '2020-05-06 11:23:14', '101 Đường Sồi, Huế', 269220, 'Ghi chú 31', 'Đã giao'),
(32, 'KH2', '2024-07-05 21:20:00', '202 Đường Thông, Nha Trang', 982595, 'Ghi chú 32', 'Đã giao'),
(33, 'KH2', '2024-10-21 17:09:25', '456 Đường Phố, Sài Gòn', 737953, 'Ghi chú 33', 'Đã giao'),
(34, 'KH3', '2022-02-01 03:57:06', '789 Đường Lá, Đà Nẵng', 300747, NULL, 'Đã giao'),
(35, 'KH4', '2022-01-14 00:43:23', '456 Đường Phố, Sài Gòn', 758954, NULL, 'Đã giao'),
(36, 'KH4', '2020-03-16 20:50:52', '202 Đường Thông, Nha Trang', 902011, 'Ghi chú 36', 'Đã giao'),
(37, 'KH5', '2020-01-27 02:14:38', '101 Đường Sồi, Huế', 880275, NULL, 'Đã giao'),
(38, 'KH2', '2021-11-29 01:26:35', '789 Đường Lá, Đà Nẵng', 231462, 'Ghi chú 38', 'Đã giao'),
(39, 'KH3', '2020-10-14 10:15:15', '202 Đường Thông, Nha Trang', 321044, 'Ghi chú 39', 'Đã giao'),
(40, 'KH3', '2021-12-16 18:56:48', '101 Đường Sồi, Huế', 511932, 'Ghi chú 40', 'Đã giao'),
(41, 'KH1', '2022-10-23 05:33:34', '123 Đường Chính, Hà Nội', 100110, 'Ghi chú 41', 'Đã giao'),
(42, 'KH5', '2020-04-25 04:35:02', '202 Đường Thông, Nha Trang', 870450, NULL, 'Đã giao'),
(43, 'KH1', '2022-04-26 17:03:59', '101 Đường Sồi, Huế', 256417, NULL, 'Đã giao'),
(44, 'KH3', '2024-09-06 01:11:09', '101 Đường Sồi, Huế', 227725, 'Ghi chú 44', 'Đã giao'),
(45, 'KH3', '2020-08-20 06:05:36', '789 Đường Lá, Đà Nẵng', 474886, NULL, 'Đã giao'),
(46, 'KH1', '2021-06-17 22:50:57', '202 Đường Thông, Nha Trang', 737885, 'Ghi chú 46', 'Đã giao'),
(47, 'KH1', '2022-10-28 20:49:33', '789 Đường Lá, Đà Nẵng', 359144, NULL, 'Đã giao'),
(48, 'KH3', '2022-02-11 21:50:55', '101 Đường Sồi, Huế', 518112, NULL, 'Đã giao'),
(49, 'KH5', '2022-12-20 00:27:20', '456 Đường Phố, Sài Gòn', 364839, NULL, 'Đã giao'),
(50, 'KH3', '2022-09-16 05:17:43', '456 Đường Phố, Sài Gòn', 638673, NULL, 'Đã giao'),
(51, 'KH2', '2020-07-24 20:56:03', '123 Đường Chính, Hà Nội', 123185, 'Ghi chú 51', 'Đã giao'),
(52, 'KH1', '2021-07-07 17:58:39', '123 Đường Chính, Hà Nội', 119209, NULL, 'Đã giao'),
(53, 'KH4', '2022-03-19 18:42:21', '789 Đường Lá, Đà Nẵng', 140329, 'Ghi chú 53', 'Đã giao'),
(54, 'KH3', '2024-09-26 22:31:58', '789 Đường Lá, Đà Nẵng', 373583, 'Ghi chú 54', 'Đã giao'),
(55, 'KH5', '2023-06-04 05:02:48', '123 Đường Chính, Hà Nội', 165981, NULL, 'Đã giao'),
(56, 'KH1', '2020-05-01 05:59:03', '789 Đường Lá, Đà Nẵng', 893716, NULL, 'Đã giao'),
(57, 'KH3', '2023-04-13 07:42:09', '456 Đường Phố, Sài Gòn', 293346, 'Ghi chú 57', 'Đã giao'),
(58, 'KH5', '2021-05-28 09:05:23', '123 Đường Chính, Hà Nội', 983670, 'Ghi chú 58', 'Đã giao'),
(59, 'KH5', '2021-08-27 10:30:45', '101 Đường Sồi, Huế', 915586, 'Ghi chú 59', 'Đã giao'),
(60, 'KH3', '2024-01-17 08:28:18', '123 Đường Chính, Hà Nội', 818967, NULL, 'Đã giao'),
(61, 'KH2', '2024-01-02 05:29:10', '789 Đường Lá, Đà Nẵng', 768278, 'Ghi chú 61', 'Đã giao'),
(62, 'KH4', '2020-05-12 00:08:01', '123 Đường Chính, Hà Nội', 205989, NULL, 'Đã giao'),
(63, 'KH3', '2024-05-29 01:10:00', '789 Đường Lá, Đà Nẵng', 117983, 'Ghi chú 63', 'Đã giao'),
(64, 'KH3', '2020-03-13 16:09:56', '789 Đường Lá, Đà Nẵng', 827604, 'Ghi chú 64', 'Đã giao'),
(65, 'KH5', '2020-01-18 03:34:00', '101 Đường Sồi, Huế', 980520, NULL, 'Đã giao'),
(66, 'KH4', '2021-09-21 21:05:05', '202 Đường Thông, Nha Trang', 823828, NULL, 'Đã giao'),
(67, 'KH3', '2021-03-17 17:11:02', '123 Đường Chính, Hà Nội', 754608, NULL, 'Đã giao'),
(68, 'KH5', '2021-02-22 01:41:41', '789 Đường Lá, Đà Nẵng', 388672, NULL, 'Đã giao'),
(69, 'KH1', '2021-04-13 22:25:42', '456 Đường Phố, Sài Gòn', 538357, 'Ghi chú 69', 'Đã giao'),
(70, 'KH3', '2020-08-29 22:45:48', '202 Đường Thông, Nha Trang', 432523, 'Ghi chú 70', 'Đã giao'),
(71, 'KH5', '2020-03-01 17:25:02', '101 Đường Sồi, Huế', 739290, NULL, 'Đã giao'),
(72, 'KH2', '2023-02-25 14:33:58', '123 Đường Chính, Hà Nội', 405316, 'Ghi chú 72', 'Đã giao'),
(73, 'KH2', '2020-10-10 22:01:33', '101 Đường Sồi, Huế', 814417, 'Ghi chú 73', 'Đã giao'),
(74, 'KH3', '2022-06-21 03:38:46', '456 Đường Phố, Sài Gòn', 224448, 'Ghi chú 74', 'Đã giao'),
(75, 'KH3', '2020-12-02 18:31:44', '202 Đường Thông, Nha Trang', 545252, NULL, 'Đã giao'),
(76, 'KH2', '2020-12-14 22:22:24', '123 Đường Chính, Hà Nội', 895305, 'Ghi chú 76', 'Đã giao'),
(77, 'KH2', '2024-09-05 16:28:54', '101 Đường Sồi, Huế', 504147, 'Ghi chú 77', 'Đã giao'),
(78, 'KH1', '2020-01-18 08:48:36', '123 Đường Chính, Hà Nội', 350634, NULL, 'Đã giao'),
(79, 'KH2', '2024-12-04 08:52:56', '101 Đường Sồi, Huế', 507491, NULL, 'Đã giao'),
(80, 'KH5', '2021-11-24 11:42:24', '101 Đường Sồi, Huế', 397413, NULL, 'Đã giao'),
(81, 'KH2', '2023-08-26 10:39:38', '456 Đường Phố, Sài Gòn', 818683, NULL, 'Đã giao'),
(82, 'KH4', '2020-05-14 03:16:11', '123 Đường Chính, Hà Nội', 611559, 'Ghi chú 82', 'Đã giao'),
(83, 'KH1', '2024-01-16 00:10:18', '123 Đường Chính, Hà Nội', 252566, NULL, 'Đã giao'),
(84, 'KH4', '2023-10-07 05:16:45', '123 Đường Chính, Hà Nội', 453311, 'Ghi chú 84', 'Đã giao'),
(85, 'KH3', '2020-03-14 09:16:13', '456 Đường Phố, Sài Gòn', 118983, NULL, 'Đã giao'),
(86, 'KH5', '2020-08-01 15:36:06', '123 Đường Chính, Hà Nội', 682260, 'Ghi chú 86', 'Đã giao'),
(87, 'KH4', '2024-03-15 15:33:04', '123 Đường Chính, Hà Nội', 931427, 'Ghi chú 87', 'Đã giao'),
(88, 'KH4', '2023-06-10 16:52:51', '202 Đường Thông, Nha Trang', 683794, 'Ghi chú 88', 'Đã giao'),
(89, 'KH2', '2020-11-03 06:53:02', '123 Đường Chính, Hà Nội', 133860, 'Ghi chú 89', 'Đã giao'),
(90, 'KH4', '2024-06-07 04:07:49', '202 Đường Thông, Nha Trang', 567001, 'Ghi chú 90', 'Đã giao'),
(91, 'KH1', '2021-07-27 20:08:38', '456 Đường Phố, Sài Gòn', 525133, NULL, 'Đã giao'),
(92, 'KH1', '2022-02-11 03:25:48', '202 Đường Thông, Nha Trang', 646167, NULL, 'Đã giao'),
(93, 'KH1', '2020-01-12 01:10:55', '123 Đường Chính, Hà Nội', 783251, NULL, 'Đã hủy'),
(94, 'KH1', '2024-09-27 04:51:39', '202 Đường Thông, Nha Trang', 527341, 'Ghi chú 94', 'Đã giao'),
(95, 'KH3', '2024-06-21 06:14:44', '456 Đường Phố, Sài Gòn', 560598, NULL, 'Đã giao'),
(96, 'KH1', '2020-02-08 11:40:05', '202 Đường Thông, Nha Trang', 836826, 'Ghi chú 96', 'Đã giao'),
(97, 'KH4', '2020-03-16 03:28:04', '123 Đường Chính, Hà Nội', 637972, 'Ghi chú 97', 'Đã giao'),
(98, 'KH5', '2020-11-24 03:05:45', '101 Đường Sồi, Huế', 583603, 'Ghi chú 98', 'Đã giao'),
(99, 'KH5', '2022-02-13 00:45:39', '101 Đường Sồi, Huế', 912752, 'Ghi chú 99', 'Đã giao'),
(100, 'KH5', '2024-02-08 12:20:28', '101 Đường Sồi, Huế', 123132, 'Ghi chú 100', 'Đã giao'),
(101, 'KH4', '2021-04-24 17:01:41', '202 Đường Thông, Nha Trang', 173940, 'Ghi chú 1', 'Đã giao'),
(102, 'KH3', '2024-09-21 15:47:03', '123 Đường Chính, Hà Nội', 625046, NULL, 'Đã giao'),
(103, 'KH5', '2023-12-10 06:48:08', '789 Đường Lá, Đà Nẵng', 683071, NULL, 'Đã giao'),
(104, 'KH1', '2022-02-04 08:46:10', '456 Đường Phố, Sài Gòn', 636168, 'Ghi chú 4', 'Đã giao'),
(105, 'KH5', '2024-09-25 13:35:19', '202 Đường Thông, Nha Trang', 956451, 'Ghi chú 5', 'Đã giao'),
(106, 'KH2', '2020-03-11 21:13:46', '789 Đường Lá, Đà Nẵng', 266228, 'Ghi chú 106', 'Chờ xử lý'),
(107, 'KH2', '2020-05-21 18:13:31', '123 Đường Chính, Hà Nội', 558043, 'Ghi chú 107', 'Đang giao'),
(108, 'KH3', '2022-09-02 03:00:28', '101 Đường Sồi, Huế', 753756, NULL, 'Đang giao'),
(109, 'KH1', '2023-08-07 14:03:33', '789 Đường Lá, Đà Nẵng', 428650, NULL, 'Đã giao'),
(110, 'KH2', '2020-06-18 01:35:55', '456 Đường Phố, Sài Gòn', 870831, NULL, 'Đã giao'),
(111, 'KH3', '2023-04-15 21:47:50', '101 Đường Sồi, Huế', 428648, NULL, 'Đang giao'),
(112, 'KH5', '2021-07-27 20:27:58', '101 Đường Sồi, Huế', 179827, 'Ghi chú 112', 'Đang giao'),
(113, 'KH3', '2023-08-15 20:14:08', '202 Đường Thông, Nha Trang', 527387, NULL, 'Đã hủy'),
(114, 'KH3', '2022-12-11 22:29:25', '456 Đường Phố, Sài Gòn', 379921, NULL, 'Đã giao'),
(115, 'KH1', '2022-09-05 00:20:34', '123 Đường Chính, Hà Nội', 779335, 'Ghi chú 115', 'Đã hủy'),
(116, 'KH5', '2023-06-20 16:06:14', '123 Đường Chính, Hà Nội', 914282, NULL, 'Chờ xử lý'),
(117, 'KH1', '2023-05-04 13:45:32', '456 Đường Phố, Sài Gòn', 363900, 'Ghi chú 117', 'Đang giao'),
(118, 'KH5', '2021-10-21 19:50:46', '101 Đường Sồi, Huế', 309529, NULL, 'Chờ xử lý'),
(119, 'KH5', '2021-04-23 13:07:33', '123 Đường Chính, Hà Nội', 206566, 'Ghi chú 119', 'Đã giao'),
(120, 'KH2', '2023-03-06 20:05:29', '789 Đường Lá, Đà Nẵng', 427961, NULL, 'Chờ xử lý'),
(121, 'KH4', '2024-03-05 19:43:16', '789 Đường Lá, Đà Nẵng', 465830, NULL, 'Đã xác nhận'),
(122, 'KH1', '2022-06-18 22:27:49', '123 Đường Chính, Hà Nội', 879165, 'Ghi chú 122', 'Đã giao'),
(123, 'KH5', '2024-05-21 06:42:00', '123 Đường Chính, Hà Nội', 568112, 'Ghi chú 123', 'Đã xác nhận'),
(124, 'KH1', '2023-01-14 08:11:23', '202 Đường Thông, Nha Trang', 383824, 'Ghi chú 124', 'Đã xác nhận'),
(125, 'KH2', '2021-04-03 23:48:45', '456 Đường Phố, Sài Gòn', 780153, NULL, 'Đã hủy'),
(126, 'KH4', '2024-11-05 22:05:13', '456 Đường Phố, Sài Gòn', 818763, 'Ghi chú 126', 'Đã hủy'),
(127, 'KH5', '2024-03-27 16:26:36', '789 Đường Lá, Đà Nẵng', 349131, 'Ghi chú 127', 'Chờ xử lý'),
(128, 'KH4', '2020-02-07 16:32:28', '789 Đường Lá, Đà Nẵng', 593003, 'Ghi chú 128', 'Đã xác nhận'),
(129, 'KH3', '2023-01-23 03:17:56', '101 Đường Sồi, Huế', 437508, NULL, 'Chờ xử lý'),
(130, 'KH3', '2022-11-01 15:14:34', '456 Đường Phố, Sài Gòn', 803207, NULL, 'Chờ xử lý'),
(131, 'KH2', '2022-08-14 18:48:05', '456 Đường Phố, Sài Gòn', 559866, 'Ghi chú 131', 'Đang giao'),
(132, 'KH4', '2024-08-09 00:57:41', '101 Đường Sồi, Huế', 511069, NULL, 'Đang giao'),
(133, 'KH4', '2020-01-17 07:22:08', '123 Đường Chính, Hà Nội', 191806, NULL, 'Đã giao'),
(134, 'KH5', '2020-03-08 22:59:45', '456 Đường Phố, Sài Gòn', 520834, 'Ghi chú 134', 'Đã hủy'),
(135, 'KH2', '2021-05-21 05:28:05', '456 Đường Phố, Sài Gòn', 490184, 'Ghi chú 135', 'Đang giao'),
(136, 'KH2', '2020-08-04 16:51:11', '789 Đường Lá, Đà Nẵng', 472572, NULL, 'Đã hủy'),
(137, 'KH5', '2021-11-21 15:12:47', '101 Đường Sồi, Huế', 128775, NULL, 'Đã hủy'),
(138, 'KH4', '2022-10-12 09:53:06', '123 Đường Chính, Hà Nội', 209586, 'Ghi chú 138', 'Đang giao'),
(139, 'KH2', '2024-01-29 21:21:32', '202 Đường Thông, Nha Trang', 109356, NULL, 'Đã giao'),
(140, 'KH3', '2022-02-04 03:36:20', '456 Đường Phố, Sài Gòn', 819237, 'Ghi chú 140', 'Đang giao'),
(141, 'KH1', '2022-10-21 16:27:46', '789 Đường Lá, Đà Nẵng', 718663, NULL, 'Đã xác nhận'),
(142, 'KH1', '2021-10-02 08:28:30', '456 Đường Phố, Sài Gòn', 921103, 'Ghi chú 142', 'Đã giao'),
(143, 'KH5', '2020-01-13 13:01:05', '101 Đường Sồi, Huế', 108322, 'Ghi chú 143', 'Đã giao'),
(144, 'KH1', '2022-06-12 16:27:25', '456 Đường Phố, Sài Gòn', 548365, NULL, 'Đã giao'),
(145, 'KH1', '2021-04-19 01:11:28', '123 Đường Chính, Hà Nội', 468489, 'Ghi chú 145', 'Đã hủy'),
(146, 'KH5', '2024-07-21 10:34:42', '101 Đường Sồi, Huế', 726338, 'Ghi chú 146', 'Đang giao'),
(147, 'KH3', '2020-05-24 20:52:00', '202 Đường Thông, Nha Trang', 496478, 'Ghi chú 147', 'Đã xác nhận'),
(148, 'KH4', '2021-10-08 09:15:35', '789 Đường Lá, Đà Nẵng', 681044, 'Ghi chú 148', 'Đã xác nhận'),
(149, 'KH1', '2021-12-16 10:58:12', '456 Đường Phố, Sài Gòn', 767773, NULL, 'Đã giao'),
(150, 'KH1', '2021-04-06 02:52:58', '123 Đường Chính, Hà Nội', 737510, 'Ghi chú 150', 'Đã xác nhận'),
(151, 'KH4', '2021-10-30 21:34:45', '202 Đường Thông, Nha Trang', 312307, 'Ghi chú 151', 'Đã xác nhận'),
(152, 'KH2', '2022-02-04 08:39:50', '202 Đường Thông, Nha Trang', 265738, 'Ghi chú 152', 'Đang giao'),
(153, 'KH4', '2020-05-18 00:19:50', '123 Đường Chính, Hà Nội', 354518, 'Ghi chú 153', 'Đã hủy'),
(154, 'KH2', '2024-01-09 13:05:23', '789 Đường Lá, Đà Nẵng', 998456, NULL, 'Chờ xử lý'),
(155, 'KH2', '2021-06-08 11:33:59', '789 Đường Lá, Đà Nẵng', 662181, 'Ghi chú 155', 'Đã giao'),
(156, 'KH1', '2022-03-24 12:27:09', '202 Đường Thông, Nha Trang', 461566, NULL, 'Đang giao'),
(157, 'KH3', '2023-03-25 06:16:51', '123 Đường Chính, Hà Nội', 399250, 'Ghi chú 157', 'Đã xác nhận'),
(158, 'KH1', '2024-11-30 14:06:47', '101 Đường Sồi, Huế', 427955, 'Ghi chú 158', 'Đang giao'),
(159, 'KH1', '2022-06-30 22:49:41', '123 Đường Chính, Hà Nội', 531439, 'Ghi chú 159', 'Đã xác nhận'),
(160, 'KH1', '2021-09-11 22:09:26', '202 Đường Thông, Nha Trang', 767756, 'Ghi chú 160', 'Đã giao'),
(161, 'KH1', '2022-03-31 11:41:00', '123 Đường Chính, Hà Nội', 340650, NULL, 'Đang giao'),
(162, 'KH2', '2020-09-16 16:15:46', '101 Đường Sồi, Huế', 588568, NULL, 'Chờ xử lý'),
(163, 'KH1', '2020-01-06 00:37:43', '202 Đường Thông, Nha Trang', 235927, 'Ghi chú 163', 'Đang giao'),
(164, 'KH4', '2022-01-27 14:32:35', '123 Đường Chính, Hà Nội', 417676, 'Ghi chú 164', 'Đang giao'),
(165, 'KH2', '2022-12-13 08:53:04', '123 Đường Chính, Hà Nội', 979541, NULL, 'Đã xác nhận'),
(166, 'KH3', '2024-12-09 23:18:52', '123 Đường Chính, Hà Nội', 302948, NULL, 'Đã hủy'),
(167, 'KH2', '2020-08-05 16:49:15', '202 Đường Thông, Nha Trang', 481686, NULL, 'Đã giao'),
(168, 'KH1', '2023-08-24 17:45:39', '123 Đường Chính, Hà Nội', 565192, 'Ghi chú 168', 'Chờ xử lý'),
(169, 'KH1', '2024-10-04 07:26:31', '101 Đường Sồi, Huế', 373741, NULL, 'Đang giao'),
(170, 'KH2', '2021-06-05 07:51:59', '101 Đường Sồi, Huế', 744506, 'Ghi chú 170', 'Chờ xử lý'),
(171, 'KH1', '2024-06-11 03:47:46', '456 Đường Phố, Sài Gòn', 651976, 'Ghi chú 171', 'Đã xác nhận'),
(172, 'KH4', '2024-10-02 22:37:11', '456 Đường Phố, Sài Gòn', 473363, 'Ghi chú 172', 'Đã hủy'),
(173, 'KH2', '2020-03-13 19:58:00', '123 Đường Chính, Hà Nội', 915881, 'Ghi chú 173', 'Đã hủy'),
(174, 'KH4', '2020-09-14 13:30:39', '202 Đường Thông, Nha Trang', 708237, NULL, 'Đang giao'),
(175, 'KH2', '2021-08-18 08:04:16', '123 Đường Chính, Hà Nội', 740466, NULL, 'Đã xác nhận'),
(176, 'KH2', '2022-10-26 12:01:23', '123 Đường Chính, Hà Nội', 503397, 'Ghi chú 176', 'Đang giao'),
(177, 'KH4', '2024-05-23 22:35:46', '123 Đường Chính, Hà Nội', 947773, 'Ghi chú 177', 'Đang giao'),
(178, 'KH5', '2020-03-09 23:53:30', '456 Đường Phố, Sài Gòn', 161733, 'Ghi chú 178', 'Chờ xử lý'),
(179, 'KH2', '2023-12-26 18:18:31', '101 Đường Sồi, Huế', 972193, 'Ghi chú 179', 'Đã giao'),
(180, 'KH3', '2020-11-19 16:36:41', '123 Đường Chính, Hà Nội', 660178, 'Ghi chú 180', 'Chờ xử lý'),
(181, 'KH1', '2021-12-22 03:43:12', '123 Đường Chính, Hà Nội', 713083, 'Ghi chú 181', 'Đã hủy'),
(182, 'KH4', '2020-04-09 03:53:15', '789 Đường Lá, Đà Nẵng', 731685, NULL, 'Chờ xử lý'),
(183, 'KH1', '2024-09-12 22:27:16', '456 Đường Phố, Sài Gòn', 238332, NULL, 'Đã xác nhận'),
(184, 'KH1', '2020-08-21 15:22:16', '202 Đường Thông, Nha Trang', 475968, NULL, 'Đã giao'),
(185, 'KH4', '2024-11-28 16:14:47', '456 Đường Phố, Sài Gòn', 470850, NULL, 'Đã giao'),
(186, 'KH5', '2021-05-16 09:00:24', '123 Đường Chính, Hà Nội', 876817, NULL, 'Đã giao'),
(187, 'KH5', '2020-03-18 03:10:47', '123 Đường Chính, Hà Nội', 336981, 'Ghi chú 187', 'Đã hủy'),
(188, 'KH3', '2021-07-04 15:40:27', '789 Đường Lá, Đà Nẵng', 841996, 'Ghi chú 188', 'Đang giao'),
(189, 'KH5', '2023-08-23 05:30:38', '789 Đường Lá, Đà Nẵng', 212222, NULL, 'Đã hủy'),
(190, 'KH4', '2024-08-06 01:02:36', '456 Đường Phố, Sài Gòn', 180450, 'Ghi chú 190', 'Chờ xử lý'),
(191, 'KH1', '2022-11-26 08:22:14', '789 Đường Lá, Đà Nẵng', 327623, 'Ghi chú 191', 'Đang giao'),
(192, 'KH1', '2023-01-03 15:36:45', '101 Đường Sồi, Huế', 861596, NULL, 'Đang giao'),
(193, 'KH4', '2021-04-15 22:44:30', '202 Đường Thông, Nha Trang', 129368, NULL, 'Đang giao'),
(194, 'KH1', '2020-12-06 04:43:19', '123 Đường Chính, Hà Nội', 580618, NULL, 'Đang giao'),
(195, 'KH1', '2020-02-27 04:00:41', '789 Đường Lá, Đà Nẵng', 507424, 'Ghi chú 195', 'Đã xác nhận'),
(196, 'KH5', '2020-03-15 16:16:02', '789 Đường Lá, Đà Nẵng', 457121, 'Ghi chú 196', 'Đang giao'),
(197, 'KH3', '2020-04-04 09:29:13', '101 Đường Sồi, Huế', 747265, 'Ghi chú 197', 'Đã xác nhận'),
(198, 'KH4', '2023-01-24 19:07:50', '123 Đường Chính, Hà Nội', 790139, 'Ghi chú 198', 'Đã xác nhận'),
(199, 'KH4', '2020-04-25 12:47:58', '456 Đường Phố, Sài Gòn', 750650, 'Ghi chú 199', 'Đã xác nhận'),
(200, 'KH4', '2024-10-13 07:50:29', '123 Đường Chính, Hà Nội', 234627, NULL, 'Đang giao'),
(201, 'KH4', '2020-02-22 02:38:25', '123 Đường Chính, Hà Nội', 230136, 'Ghi chú 201', 'Đã hủy'),
(202, 'KH3', '2022-05-25 14:08:35', '202 Đường Thông, Nha Trang', 594344, 'Ghi chú 202', 'Đang giao'),
(203, 'KH2', '2020-09-14 03:14:32', '101 Đường Sồi, Huế', 387202, 'Ghi chú 203', 'Đã xác nhận'),
(204, 'KH3', '2022-10-30 11:59:18', '101 Đường Sồi, Huế', 468871, 'Ghi chú 204', 'Đã hủy'),
(205, 'KH1', '2022-04-15 08:36:17', '456 Đường Phố, Sài Gòn', 519585, NULL, 'Đã xác nhận'),
(207, 'KH1', '2024-07-02 10:56:14', 'dsadsa', 97000, '', 'Chờ xử lý'),
(208, 'KH1', '2024-07-04 04:25:14', 'ádfnm', 97000, '', 'Chờ xử lý'),
(209, 'KH1', '2024-07-04 04:26:25', 'át', 97000, 'ưeryhjk', 'Chờ xử lý'),
(210, 'KH1', '2024-07-04 04:27:39', 'át', 97000, 'ẻtyuio', 'Chờ xử lý'),
(211, 'KH1', '2024-07-04 04:39:26', 'ádf', 97000, '', 'Chờ xử lý'),
(212, 'KH1', '2024-07-09 21:05:28', 'dsadsa', 55000, '', 'Đã giao'),
(213, 'KH7', '2024-07-10 13:12:06', '123456', 1070000, '', 'Đã xác nhận'),
(214, 'KH1', '2024-07-10 13:27:50', 'dsadsa', 180000, '', 'Đã hủy');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `maGioHang` int(11) NOT NULL,
  `maKhachHang` varchar(20) NOT NULL,
  `maSanPham` int(20) NOT NULL,
  `tenSanPham` varchar(250) NOT NULL,
  `soLuong` int(10) NOT NULL,
  `loaiGioHang` enum('normal','buynow') DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giohang`
--

INSERT INTO `giohang` (`maGioHang`, `maKhachHang`, `maSanPham`, `tenSanPham`, `soLuong`, `loaiGioHang`) VALUES
(141, 'KH6', 1, 'Cà chua', 2, 'normal'),
(142, 'KH6', 3, 'Mướp đắng', 3, 'normal'),
(143, 'KH6', 5, 'Bí đỏ', 1, 'normal'),
(144, 'KH6', 7, 'Củ cải', 4, 'normal'),
(145, 'KH6', 10, 'Củ đậu', 2, 'normal'),
(146, 'KH2', 6, 'Khoai tây', 3, 'normal'),
(147, 'KH2', 9, 'Củ hành', 2, 'normal'),
(148, 'KH2', 12, 'Cam', 5, 'normal'),
(149, 'KH2', 15, 'Dâu tây', 1, 'normal'),
(150, 'KH2', 18, 'Hành tây', 4, 'normal'),
(151, 'KH3', 2, 'Cải bó xôi', 2, 'normal'),
(152, 'KH3', 4, 'Cải thảo', 3, 'normal'),
(153, 'KH3', 8, 'Khoai lang', 1, 'normal'),
(154, 'KH3', 11, 'Táo', 4, 'normal'),
(155, 'KH3', 13, 'Cherry', 2, 'normal'),
(156, 'KH4', 3, 'Mướp đắng', 2, 'normal'),
(157, 'KH4', 5, 'Bí đỏ', 1, 'normal'),
(158, 'KH4', 7, 'Củ cải', 3, 'normal'),
(159, 'KH4', 14, 'Lê', 4, 'normal'),
(160, 'KH4', 16, 'Nấm', 2, 'normal'),
(161, 'KH5', 1, 'Cà chua', 3, 'normal'),
(162, 'KH5', 4, 'Cải thảo', 2, 'normal'),
(163, 'KH5', 9, 'Củ hành', 5, 'normal'),
(164, 'KH5', 11, 'Táo', 1, 'normal'),
(165, 'KH5', 20, 'Nghệ', 2, 'normal');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `maKhachHang` varchar(20) NOT NULL,
  `tenKhachhang` varchar(50) NOT NULL,
  `soDienThoai` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `matkhau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`maKhachHang`, `tenKhachhang`, `soDienThoai`, `email`, `matkhau`) VALUES
('KH1', 'Nguyễn Đức Anh', '0965786699', 'nguyenducanhpx2004@gmail.com', '987654321'),
('KH2', 'Khách hàng A', '0123456789', 'khachhangA@email.com', 'mkhA@123'),
('KH3', 'Khách hàng B', '0987654321', 'khachhangB@email.com', 'mkhB@123'),
('KH4', 'Khách hàng C', '0369852147', 'khachhangC@email.com', 'mkhC@123'),
('KH5', 'Khách hàng D', '0543217896', 'khachhangD@email.com', 'mkhD@123'),
('KH6', 'Khách hàng E', '0123456780', 'khachhangE@email.com', 'mkhE@123'),
('KH7', 'Nguyễn Đức Anh', '0965786690', 'ducanhpx2004@gmail.com', '123456789');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khohang`
--

CREATE TABLE `khohang` (
  `maLoai` int(20) NOT NULL,
  `maSanPham` int(20) NOT NULL,
  `tenSanPham` varchar(50) NOT NULL,
  `ngayNhap` date NOT NULL,
  `maNhaCungCap` int(20) NOT NULL,
  `soLuong` int(10) NOT NULL,
  `giaNhap` int(6) NOT NULL,
  `hanSuDung` date NOT NULL,
  `tongTienNhap` int(50) NOT NULL,
  `tinhTrang` enum('Hàng mới','Hàng cũ','Hỏng') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khohang`
--

INSERT INTO `khohang` (`maLoai`, `maSanPham`, `tenSanPham`, `ngayNhap`, `maNhaCungCap`, `soLuong`, `giaNhap`, `hanSuDung`, `tongTienNhap`, `tinhTrang`) VALUES
(3, 1, 'Cà chua', '2024-06-01', 1, 0, 12000, '2024-06-30', 2400000, 'Hỏng'),
(4, 2, 'Cải bó xôi', '2024-06-02', 2, 0, 15000, '2024-06-25', 2250000, 'Hỏng'),
(5, 3, 'Mướp đắng', '2024-06-03', 3, 0, 11000, '2024-07-01', 1980000, 'Hỏng'),
(6, 4, 'Cải thảo', '2024-06-04', 4, 0, 16000, '2024-06-28', 2720000, 'Hỏng'),
(7, 5, 'Bí đỏ', '2024-06-05', 1, 6, 18000, '2024-07-05', 3420000, ''),
(8, 6, 'Khoai tây', '2024-06-06', 2, 0, 9000, '2024-06-20', 1980000, 'Hỏng'),
(9, 7, 'Củ cải', '2024-06-07', 3, 0, 14000, '2024-06-22', 2800000, 'Hỏng'),
(10, 8, 'Khoai lang', '2024-06-08', 4, 0, 10000, '2024-06-26', 1800000, 'Hỏng'),
(11, 9, 'Củ hành', '2024-06-09', 1, 0, 17000, '2024-07-02', 3230000, 'Hỏng'),
(12, 10, 'Củ đậu', '2024-06-10', 2, 0, 19000, '2024-06-24', 3990000, 'Hỏng'),
(13, 11, 'Táo', '2024-06-11', 3, 0, 13000, '2024-06-21', 3120000, 'Hỏng'),
(14, 12, 'Cam', '2024-06-12', 4, 0, 16000, '2024-06-29', 3520000, 'Hỏng'),
(15, 13, 'Cherry', '2024-06-13', 1, 0, 18000, '2024-07-03', 4680000, 'Hỏng'),
(16, 14, 'Lê', '2024-06-14', 2, 0, 12000, '2024-06-27', 2280000, 'Hỏng'),
(17, 15, 'Dâu tây', '2024-06-15', 3, 0, 22000, '2024-06-23', 6160000, 'Hỏng'),
(18, 16, 'Nấm', '2024-06-16', 4, 0, 15000, '2024-07-04', 3000000, 'Hỏng'),
(19, 17, 'Hạt điều', '2024-06-17', 1, 0, 28000, '2024-06-19', 6720000, 'Hỏng'),
(20, 18, 'Hành tây', '2024-06-18', 2, 0, 17000, '2024-06-30', 3060000, 'Hỏng'),
(21, 19, 'Ớt chuông', '2024-06-19', 3, 0, 19000, '2024-07-01', 4940000, 'Hỏng'),
(22, 20, 'Nghệ', '2024-06-20', 4, 0, 20000, '2024-06-18', 4600000, 'Hỏng'),
(23, 3, 'Mướp đắng', '2024-06-29', 3, 0, 10000, '2024-07-01', 1000000, 'Hỏng'),
(50, 5, 'Bí đỏ', '2024-07-09', 1, 93, 9999, '2024-07-12', 999900, 'Hàng mới'),
(52, 10, 'Củ đậu', '2024-07-10', 2, 48, 19000, '2024-07-12', 1900000, 'Hàng mới');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `maNhaCungCap` int(20) NOT NULL,
  `tenNhaCungCap` varchar(255) NOT NULL,
  `diaChi` varchar(250) NOT NULL,
  `email` varchar(30) NOT NULL,
  `soDienThoai` varchar(10) NOT NULL,
  `ghiChu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nhacungcap`
--

INSERT INTO `nhacungcap` (`maNhaCungCap`, `tenNhaCungCap`, `diaChi`, `email`, `soDienThoai`, `ghiChu`) VALUES
(1, 'Nhà cung cấp A', 'Địa chỉ A', 'nhacungcapA@email.com', '0123456789', 'Ghi chú A'),
(2, 'Nhà cung cấp B', 'Địa chỉ B', 'nhacungcapB@email.com', '0987654321', 'Ghi chú B'),
(3, 'Nhà cung cấp C', 'Địa chỉ C', 'nhacungcapC@email.com', '0369852147', 'Ghi chú C'),
(4, 'Nhà cung cấp D', 'Địa chỉ D', 'nhacungcapD@email.com', '0543217896', 'Ghi chú D'),
(34, 'Nguyễn Vân Trường', 'Hà Nội', 'nguyenducanhpx2004@gmail.com', '0412352678', '456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `maNhanVien` varchar(20) NOT NULL,
  `tenNhanVien` varchar(50) NOT NULL,
  `ngaySinh` date NOT NULL,
  `diaChi` varchar(100) NOT NULL,
  `gioiTinh` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `soDienThoai` varchar(10) NOT NULL,
  `ghiChu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `maSanPham` int(20) NOT NULL,
  `tenSanPham` varchar(255) NOT NULL,
  `maNhaCungCap` int(20) NOT NULL,
  `maDanhMuc` int(20) NOT NULL,
  `soLuong` int(10) NOT NULL,
  `donGia` int(20) NOT NULL,
  `tinhTrang` varchar(50) NOT NULL,
  `moTaSanPham` text NOT NULL,
  `anhSanPham` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`maSanPham`, `tenSanPham`, `maNhaCungCap`, `maDanhMuc`, `soLuong`, `donGia`, `tinhTrang`, `moTaSanPham`, `anhSanPham`) VALUES
(1, 'Cà chua', 1, 1, 0, 15000, 'Hết hàng', 'Mô tả sản phẩm Cà chua', 'cachua.png'),
(2, 'Cải bó xôi', 1, 15, 0, 18000, 'Hết hàng', 'Mô tả sản phẩm Rau cải', 'cai-bo-xoi.png'),
(3, 'Mướp đắng', 3, 1, 0, 12000, 'Hết hàng', 'Mô tả sản phẩm Mướp đắng', 'muopdang.jpg'),
(4, 'Cải thảo', 4, 1, 0, 20000, 'Hết hàng', 'Mô tả sản phẩm Cải thảo', 'cai-thao.jpg'),
(5, 'Bí đỏ', 1, 1, 86, 25000, 'Hết hàng', 'Mô tả sản phẩm Bí đỏ', 'bido.jpg'),
(6, 'Khoai tây', 2, 2, 0, 10000, 'Hết hàng', 'Mô tả sản phẩm Khoai tây', 'khoai-tay.jpg'),
(7, 'Củ cải', 3, 2, 0, 15000, 'Hết hàng', 'Mô tả sản phẩm Củ cải', 'cu-cai.jpg'),
(8, 'Khoai lang', 4, 2, 0, 12000, 'Hết hàng', 'Mô tả sản phẩm Khoai lang', 'khoat-lanng.png'),
(9, 'Củ hành', 1, 2, 0, 18000, 'Hết hàng', 'Mô tả sản phẩm Củ hành', 'cu-hanh.webp'),
(10, 'Củ đậu', 2, 2, -4, 20000, 'Hết hàng', 'Mô tả sản phẩm Củ đậu', 'cu-dau.jpg'),
(11, 'Táo', 3, 3, 0, 15000, 'Hết hàng', 'Mô tả sản phẩm Táo', 'tao.jpg'),
(12, 'Cam', 4, 3, 0, 18000, 'Hết hàng', 'Mô tả sản phẩm Cam', 'cam.png'),
(13, 'Cherry', 1, 3, 0, 20000, 'Hết hàng', 'Mô tả sản phẩm Cherry', 'cherry.jpg'),
(14, 'Lê', 2, 3, 0, 12000, 'Hết hàng', 'Mô tả sản phẩm Lê', 'le.jpg'),
(15, 'Dâu tây', 3, 3, 0, 25000, 'Hết hàng', 'Mô tả sản phẩm Dâu tây', 'dau-tay.jpg'),
(16, 'Nấm', 4, 16, 0, 18000, 'Hết hàng', 'Mô tả sản phẩm Nấm', 'nam.jpg'),
(17, 'Hạt điều', 1, 16, 0, 30000, 'Hết hàng', 'Mô tả sản phẩm Hạt điều', 'hat-dieu.jpg'),
(18, 'Hành tây', 2, 16, 0, 22000, 'Hết hàng', 'Mô tả sản phẩm Hành tây', 'hanh-tay.jpg'),
(19, 'Ớt chuông', 3, 16, 0, 20000, 'Hết hàng', 'Mô tả sản phẩm Ớt chuông', 'ot-chuong.jpg'),
(20, 'Nghệ', 4, 16, 0, 25000, 'Hết hàng', 'Mô tả sản phẩm Nghệ', 'nghe.webp'),
(21, 'Rau muống', 1, 1, 0, 10000, 'Hết hàng', 'sadasd', 'raumuong.png'),
(24, 'Xoài', 1, 13, 0, 50000, 'Hết hàng', 'Mô tả sản phẩm Xoài', 'download-removebg-preview (4).png'),
(25, 'Dâu tây', 1, 13, 0, 125000, 'Hết hàng', 'Mô tả sản phẩm Dâu tây', 'product-4.jpg'),
(26, 'Dứa', 1, 13, 0, 20000, 'Hết hàng', 'Mô tả sản phẩm Dứa', 'product-2.jpg'),
(27, 'Cam nhập khẩu', 4, 14, 0, 35000, 'Hết hàng', 'Mô tả sản phẩm Cam', 'download-removebg-preview (3).png'),
(28, 'Rau muống', 3, 15, 0, 10000, 'Hết hàng', 'Mô tả sản phẩm Rau muống', 'Remove-bg.ai_1716737844310.png'),
(29, 'Rau cải', 2, 15, 0, 20000, 'Hết hàng', 'Mô tả sản phẩm Rau cải', 'cai-bo-xoi.png'),
(30, 'Cải bó xôi', 2, 15, 0, 15000, 'Hết hàng', 'Mô tả sản phẩm Cải bó xôi', 'cai-bo-xoi.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `maTaiKhoan` int(20) NOT NULL,
  `tenTaiKhoan` varchar(255) NOT NULL,
  `Mat_khau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`maTaiKhoan`, `tenTaiKhoan`, `Mat_khau`) VALUES
(1, 'kid1412', '123456789');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tintuc`
--

CREATE TABLE `tintuc` (
  `maTintuc` int(20) NOT NULL,
  `tieuDe` varchar(500) NOT NULL,
  `noiDung` varchar(2000) NOT NULL,
  `anhTinTuc` varchar(1000) NOT NULL,
  `ngayThang` date NOT NULL,
  `maNhanVien` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tintuc`
--

INSERT INTO `tintuc` (`maTintuc`, `tieuDe`, `noiDung`, `anhTinTuc`, `ngayThang`, `maNhanVien`) VALUES
(6, 'gjklssdadsghshshsh', '<p>dfghjkl;</p>\r\n\r\n<p>hhdhdhd</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'ba chỉ.jpg', '2024-07-09', 'NV1');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD KEY `maDonhang` (`maDonhang`),
  ADD KEY `maSanPham` (`maSanPham`),
  ADD KEY `donGia` (`donGia`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`maDanhMuc`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`maDonhang`),
  ADD KEY `maKhachHang` (`maKhachHang`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`maGioHang`),
  ADD KEY `maKhachHang` (`maKhachHang`),
  ADD KEY `maSanPham` (`maSanPham`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`maKhachHang`);

--
-- Chỉ mục cho bảng `khohang`
--
ALTER TABLE `khohang`
  ADD PRIMARY KEY (`maLoai`),
  ADD KEY `maSanPham` (`maSanPham`),
  ADD KEY `maNhaCungCap` (`maNhaCungCap`);

--
-- Chỉ mục cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  ADD PRIMARY KEY (`maNhaCungCap`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`maNhanVien`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`maSanPham`),
  ADD KEY `maNhaCungCap` (`maNhaCungCap`),
  ADD KEY `sp_pk_1` (`maDanhMuc`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`maTaiKhoan`);

--
-- Chỉ mục cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`maTintuc`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `maDanhMuc` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `maDonhang` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `maGioHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT cho bảng `khohang`
--
ALTER TABLE `khohang`
  MODIFY `maLoai` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  MODIFY `maNhaCungCap` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `maSanPham` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `maTaiKhoan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  MODIFY `maTintuc` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `chitietdonhang_ibfk_1` FOREIGN KEY (`maDonhang`) REFERENCES `donhang` (`maDonhang`),
  ADD CONSTRAINT `chitietdonhang_ibfk_2` FOREIGN KEY (`maSanPham`) REFERENCES `sanpham` (`maSanPham`);

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`maKhachHang`) REFERENCES `khachhang` (`maKhachHang`);

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`maKhachHang`) REFERENCES `khachhang` (`maKhachHang`),
  ADD CONSTRAINT `giohang_ibfk_2` FOREIGN KEY (`maSanPham`) REFERENCES `sanpham` (`maSanPham`);

--
-- Các ràng buộc cho bảng `khohang`
--
ALTER TABLE `khohang`
  ADD CONSTRAINT `khohang_ibfk_1` FOREIGN KEY (`maSanPham`) REFERENCES `sanpham` (`maSanPham`),
  ADD CONSTRAINT `khohang_ibfk_2` FOREIGN KEY (`maNhaCungCap`) REFERENCES `nhacungcap` (`maNhaCungCap`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`maNhaCungCap`) REFERENCES `nhacungcap` (`maNhaCungCap`),
  ADD CONSTRAINT `sp_pk_1` FOREIGN KEY (`maDanhMuc`) REFERENCES `danhmuc` (`maDanhMuc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
