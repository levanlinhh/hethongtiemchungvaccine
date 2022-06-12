-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 21, 2022 lúc 11:07 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `vaccine_covid`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_type` int(11) DEFAULT 0 COMMENT '0 : Dân - 1 : Admin',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id`, `user`, `pass`, `email`, `user_type`, `date_created`) VALUES
(1, 'admin123', 'e10adc3949ba59abbe56e057f20f883e', 'admin@gmail.com', 1, '2022-05-21 09:06:44'),
(2, 'user12345', 'e10adc3949ba59abbe56e057f20f883e', 'user12345@gmail.com', 0, '2022-05-19 15:13:39'),
(3, 'user123456', 'e10adc3949ba59abbe56e057f20f883e', 'User123456@gmail.com', 0, '2022-05-20 01:51:40'),
(4, 'user12345678', 'e10adc3949ba59abbe56e057f20f883e', 'User12345678@gmail.com', 0, '2022-05-20 06:57:49'),
(5, 'user4321', 'e10adc3949ba59abbe56e057f20f883e', 'user4321@gmail.com', 0, '2022-05-20 16:35:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `place`
--

CREATE TABLE `place` (
  `id` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `place`
--

INSERT INTO `place` (`id`, `address`) VALUES
(1, 'Yên Nghĩa, Hà Đông, Hà Nội'),
(2, 'Mộ Lao, Hà Đông, Hà Nội'),
(3, 'Tân Mai, Hoàng Mai, Hà Nội'),
(4, 'La Khê, Hà Đông, Hà Nội'),
(5, 'Phúc La, Hà Đông, Hà Nội'),
(6, 'La Phù, Hoài Đức, Hà Nội');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `cccd` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` int(11) DEFAULT 0 COMMENT '0 : Nữ - 1 : Nam',
  `injection_times` int(11) DEFAULT NULL,
  `vaccine_id` int(11) DEFAULT NULL,
  `place_id` int(11) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `confirm` int(11) DEFAULT 0 COMMENT '0 : Chưa tiêm - 1 : Đã tiêm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `registration`
--

INSERT INTO `registration` (`id`, `account_id`, `name`, `cccd`, `birthday`, `gender`, `injection_times`, `vaccine_id`, `place_id`, `registration_date`, `confirm`) VALUES
(1, 1, 'Nguyễn Văn A', '0123123123', '2022-10-10', 1, 2, 1, 1, '2022-10-10', 0),
(3, 5, 'Nguyễn Văn C', '1231231234', '2002-10-10', 1, 1, 4, 4, '2002-10-10', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vaccine`
--

CREATE TABLE `vaccine` (
  `id` int(11) NOT NULL,
  `name_vaccine` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `vaccine`
--

INSERT INTO `vaccine` (`id`, `name_vaccine`) VALUES
(1, 'AstraZeneca'),
(2, 'Gam-COVID-Vac'),
(3, 'Vero Cell'),
(4, 'Comirnaty'),
(5, 'Spikevax'),
(6, 'Janssen'),
(9, 'Hello Adress');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `vaccine_id` (`vaccine_id`),
  ADD KEY `place_id` (`place_id`);

--
-- Chỉ mục cho bảng `vaccine`
--
ALTER TABLE `vaccine`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `place`
--
ALTER TABLE `place`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `vaccine`
--
ALTER TABLE `vaccine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `registration_ibfk_2` FOREIGN KEY (`vaccine_id`) REFERENCES `vaccine` (`id`),
  ADD CONSTRAINT `registration_ibfk_3` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
