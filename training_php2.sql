-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th10 03, 2022 lúc 12:05 PM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `training_php2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delete_flg` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `email`, `phone`, `delete_flg`) VALUES
(4, 'admin', '202cb962ac59075b964b07152d234b70', 'Nguyen Quoc Quy ', 'Quynq@vnu.edu', '0923488371', 0),
(5, 'admin1', '202cb962ac59075b964b07152d234b70', 'Nguyen Quoc Quy 1', 'quy123@email.com', '0923488373', 0),
(6, 'kien', 'dd420062f73fc59f8c9d3a017782c63d', 'Kiendm', 'kien12@vnu.edu', '0971238771', 0),
(7, 'user', '1a1dc91c907325c69271ddf0c944bc72', 'Quy', 'quy@email.com', '0923488372', 0),
(8, 'khanhnq', '202cb962ac59075b964b07152d234b70', 'Nguyen Quoc Khanh', 'khanh@vnu.edu', '0866975704', 0),
(9, 'quynq', '536d5fa6e12c45f3ce17a036acd24afb', 'QuyNQ', '20020140vnu.edu', '0923488372', 1),
(10, 'huyNL', '11967d5e9addc5416ea9224eee0e91fc', 'Tran Minh Huy', 'huy@email.com', '0923477381', 0),
(11, 'username', '202cb962ac59075b964b07152d234b70', 'Quy NQ123', '20020140@uet.vnu', '1234567890', 0),
(12, 'Khanhnq123', '81eec642c706e7d1eb379564c5ac02f7', 'Khanh NQ', 'khanh@uet.vnu.vn', '1234567890', 0),
(13, 'emin', '202cb962ac59075b964b07152d234b70', 'Hai Minh', '20021420@vnu.edu.vn', '0923488372', 0),
(14, 'nquy', '1a1dc91c907325c69271ddf0c944bc72', 'Quốc Quý Nguyễn', 'quocquynguyen0311@gmail.com', '0923488371', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
