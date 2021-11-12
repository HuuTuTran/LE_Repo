-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 12, 2021 lúc 10:42 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `litedb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `img`
--

CREATE TABLE `img` (
  `id` int(6) UNSIGNED NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `thumb` varchar(200) DEFAULT NULL,
  `status` bit(1) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `img`
--

INSERT INTO `img` (`id`, `title`, `thumb`, `status`, `description`) VALUES
(1, 'buc tranh nau an', 'Resource/Cay-Phong-La-Do-11-01.JPG', b'1', 'desc'),
(2, 'buc tranh', 'Resource/p31.png', b'0', '1'),
(3, 'buc tranh', 'Resource/p31.png', b'0', 'this is a des'),
(4, 'buc tranh', 'Resource/p31.png', b'0', 'this is a des'),
(5, 'buc tranh', 'Resource/p31.png', b'0', 'this is a des'),
(6, 'buc tranh', 'Resource/p31.png', b'0', 'this is a des'),
(7, 'buc tranh', 'Resource/p31.png', b'0', 'this is a des'),
(8, 'buc tranh', 'Resource/p31.png', b'0', 'this is a des'),
(9, 'buc tranh', 'Resource/p31.png', b'0', 'this is a des'),
(10, 'buc tranh', 'Resource/p31.png', b'0', 'this is a des'),
(11, 'buc tranh', 'Resource/p31.png', b'0', 'this is a des'),
(20, 'buc tranh', 'Resource/1gt2.jpg', b'0', '1');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `img`
--
ALTER TABLE `img`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
