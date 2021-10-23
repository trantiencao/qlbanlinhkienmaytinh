-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 23, 2021 lúc 06:34 PM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlbanlinhkienmaytinh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_product` int(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `id_user`, `id_product`, `quantity`, `price`) VALUES
(12, 1, 23, 5, 67495500),
(18, 1, 24, 5, 113995250),
(23, 9, 36, 1, 1199200),
(24, 11, 27, 1, 11519200);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `home` tinyint(4) DEFAULT 0,
  `status` tinyint(4) DEFAULT 1,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `home`, `status`, `create_at`, `update_at`) VALUES
(54, 'CPU-Bộ xử lí', 1, 1, '2020-12-06 13:43:29', '2020-12-17 04:01:55'),
(55, 'RAM', 1, 1, '2020-12-06 13:43:55', '2020-12-17 04:02:01'),
(56, 'Ổ cứng SSD', 1, 1, '2020-12-06 13:44:13', '2020-12-17 04:02:10'),
(57, 'Ổ cứng HDD', 1, 1, '2020-12-06 13:44:25', '2020-12-17 04:02:17'),
(58, 'ODD-Ổ đĩa quang', 1, 1, '2020-12-06 13:44:46', '2020-12-17 04:02:24'),
(59, 'VGA-Card Màn Hình', 1, 1, '2020-12-06 13:45:16', '2020-12-17 04:02:30'),
(60, 'Case - Vỏ Máy Tính', 1, 1, '2020-12-06 13:45:37', '2020-12-17 04:02:41'),
(61, 'PSU - Nguồn Máy Tính', 0, 1, '2020-12-06 13:45:57', '2020-12-06 13:45:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `id` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `pending` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`id`, `id_user`, `pending`, `created_at`) VALUES
(92, 1, 0, '2020-12-22 00:51:18'),
(93, 11, 1, '2021-10-20 21:25:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(10) NOT NULL,
  `id_order` int(10) NOT NULL,
  `id_product` int(10) NOT NULL,
  `name_product` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `sale` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`id`, `id_order`, `id_product`, `name_product`, `avatar`, `quantity`, `price`, `sale`) VALUES
(106, 91, 23, 'CPU Intel Xeon Silver 411000', 'intel_xeon_silver_right.jpg', 5, 14999000, 10),
(107, 91, 24, 'CPU Intel Core i9-10940X', '49437_hnc_intel_i9_10900x_right_facing_850x850.jpg', 5, 23999000, 5),
(108, 91, 34, 'Card màn hình Asus TUF RTX3090-O24G-GAMING ', '55637_tuf_rtx3090_o24g_gaming_09.jpg', 3, 50790000, 10),
(109, 92, 23, 'CPU Intel Xeon Silver 411000', 'intel_xeon_silver_right.jpg', 5, 14999000, 10),
(110, 92, 24, 'CPU Intel Core i9-10940X', '49437_hnc_intel_i9_10900x_right_facing_850x850.jpg', 5, 23999000, 5),
(111, 92, 34, 'Card màn hình Asus TUF RTX3090-O24G-GAMING ', '55637_tuf_rtx3090_o24g_gaming_09.jpg', 3, 50790000, 10),
(112, 93, 27, 'CPU Intel Core i9-9900X', '45079_hnc_intel_core_i9_xtreme_right_facing_850x850.jpg', 1, 14399000, 20);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `capacity` int(10) DEFAULT NULL,
  `sale` int(4) NOT NULL DEFAULT 0,
  `avatar` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `category_id` int(10) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `capacity`, `sale`, `avatar`, `stock`, `category_id`, `description`, `created_at`, `update_at`) VALUES
(23, 'CPU Intel Xeon Silver 411000', 14999000, NULL, 10, '45079_hnc_intel_core_i9_xtreme_right_facing_850x850.jpg', 10, 55, 'Dòng sản phẩm chuyên biệt dành cho server/máy trạm\r\n8 nhân & 16 luồng\r\nXung nhịp: 2.1GHz (Cơ bản) / 3.0GHz (Boost)\r\nSocket: LGA 3647\r\nHỗ trợ RAM ECC                                ', '2020-12-06 13:53:42', '2020-12-06 13:53:42'),
(24, 'CPU Intel Core i9-10940X', 23999000, NULL, 5, '49437_hnc_intel_i9_10900x_right_facing_850x850.jpg', 20, 54, 'CPU Core i thế hệ thứ 10 của Intel\r\n14 nhân & 28 luồng\r\nXung cơ bản: 3.3 GHz\r\nXung tối đa (boost): 4.6 GHz\r\nChạy tốt trên các mainboard socket 2066                                ', '2020-12-06 13:55:32', '2020-12-06 13:55:32'),
(25, 'CPU Intel Core i9-9900KF', 11999000, NULL, 15, '45160_hnc_intel_i9_9900kf_right_facing_850x850.jpg', 70, 54, 'Phiên bản cắt giảm đi nhân đồ họa tích hợp của 9900K\r\nSố nhân: 8\r\nSố luồng: 16\r\nTốc độ cơ bản: 3.6 GHz\r\nTốc độ tối đa: 5.0 GHz\r\nCache: 16MB\r\nTiến trình sản xuất: 14nm                                ', '2020-12-06 13:59:24', '2020-12-06 13:59:24'),
(26, 'CPU Intel Xeon E-2136', 7499000, NULL, 5, '43202_hnc_intel_xeon_e_coffee_lake_right_facing_850x850.jpg', 25, 54, 'Dòng sản phẩm chuyên biệt dành cho máy trạm giá rẻ\r\nPhù hợp cho các phần mềm render, thiết kế\r\n6 nhân & 12 luồng\r\nXung nhịp: 3.3 GHz (Cơ bản) / 4.5 GHz (Boost)\r\nSocket: LGA 1151v2 (C246)\r\nHỗ trợ RAM ECC\r\nKhông tích hợp sẵn iGPU                                ', '2020-12-06 14:00:33', '2020-12-06 14:00:33'),
(27, 'CPU Intel Core i9-9900X', 14399000, NULL, 20, '45079_hnc_intel_core_i9_xtreme_right_facing_850x850.jpg', 8, 54, 'Socket: FCLGA2066\r\nSố lõi/luồng: 10/20-Tần số cơ bản/turbo: 3.5/4.4 GHz\r\nBộ nhớ đệm: 19,5 MB\r\nMức tiêu thụ điện: 165 W                                ', '2020-12-06 14:01:48', '2020-12-06 14:01:48'),
(28, 'DDRam 4 Kingston ECC', 6190000, 32, 5, '47682_kingston_ecc__32gb2666_ksm26rd432hai.jpg', 10, 55, 'Dòng sản phẩm ECC của Kingston\r\nDung lượng: 1 x 32GB\r\nThế hệ: DDR4\r\nBus: 2666MHz                                ', '2020-12-06 14:10:09', '2020-12-06 14:10:09'),
(29, 'Ram Desktop ANTECMEMORY 1S (AMD4UZ32661908G)', 799000, 32, 5, '49037_ram_ddr4_antecmemory_8gb_2666_1_8gb_1s.jpg', 21, 55, 'Dòng RAM cơ bản nhất của Antecmemory\r\nDung lượng: 8GB\r\nKiểu: DDRam 4\r\nBus: 2666 MHz\r\nĐóng gói: 1 x 8GB                                ', '2020-12-06 14:11:59', '2020-12-06 14:11:59'),
(30, 'RAM Desktop Gskill Trident Z Neo (F4-3600C16D-16GTZNC)', 3099000, 16, 5, '48711_gskill_trident_z_neo_2.jpg', 47, 55, 'Dòng sản phẩm Gskill Trident Z Neo mới nhất của Gskill\r\nPhù hợp với nền tảng AMD\r\nDung lượng: 2 x 8GB\r\nThế hệ: DDR4\r\nBus: 3600MHz                                ', '2020-12-06 14:19:48', '2020-12-06 14:19:48'),
(31, 'Ổ cứng HDD Western Caviar Red', 1599000, 1024, 5, '4621_5250_c9522f779de18e42c1b5d0772144d7ea.jpg', 32, 57, '3.5 inch 5400RPM, SATA3 6Gb/s, 64MB Cache\r\nĐược thiết kế đặc biệt để sử dụng trong các hệ thống NAS tối đa 8 khay\r\nHỗ trợ tốc độ tải công việc lên tới 180 TB / năm.\r\nHệ thống NAS phù hợp cho văn phòng nhỏ và sử dụng tại nhà liên tục 24/7                                ', '2020-12-06 14:23:37', '2020-12-06 14:23:37'),
(32, 'Ổ cứng SSD Samsung 860 EVO', 1459000, 250, 5, '41502_ssd_samsung_860_evo_250gb_2_5_inch_sata3.jpg', 22, 56, 'Loại SSD: Giao tiếp Sata III\r\nKích thước: 2.5 inch\r\nDung lượng: 250GB\r\nTốc độ đọc: 550MBps\r\nTốc độ ghi: 520MBps\r\nTổng dung lượng đã ghi (TBW): 150TB                                ', '2020-12-06 14:26:19', '2020-12-06 14:26:19'),
(33, 'DVD Rewrite Asus SDRW-08D2S-U Ext USB', 775000, NULL, 15, '4621_5250_c9522f779de18e42c1b5d0772144d7ea.jpg', 4, 58, 'DVD Rewrite Asus SDRW-08D2S-U Ext USB, Disc Encryption tăng gấp đôi sự bảo mật bằng mật khẩu điều khiển và chức năng ẩn tập tin. \r\nThiết kế thẩm mỹ, công nghệ vượt trội                                ', '2020-12-06 15:15:16', '2020-12-06 15:15:16'),
(34, 'Card màn hình Asus TUF RTX3090-O24G-GAMING ', 50790000, 24, 10, '55637_tuf_rtx3090_o24g_gaming_09.jpg', 9, 59, 'Dung lượng bộ nhớ: 24GB GDDR6X\r\n10496 CUDA Cores\r\nCore Clock: 1770 MHz (Chế độ OC)\r\nKết nối: DisplayPort 1.4a, HDMI 2.1\r\nNguồn yêu cầu: 750W                                ', '2020-12-06 15:18:16', '2020-12-06 15:18:16'),
(35, 'Vỏ Case Thermaltake View 91 Tempered Glass', 9199000, NULL, 5, '44830_case_thermaltake_view_91_rgb_tempered_glass_0005_1__1_.jpg', 11, 60, 'Hỗ trợ mainboard: Mini-ITX, Micro-ATX, ATX, E-ATX, XL-ATX\r\nKhay 3.5\": 12\r\nKhay 2.5”: 12\r\nChiều dài VGA tối đa: 470mm\r\nChiều cao tản CPU tối đa: 200mm                                ', '2020-12-06 15:19:44', '2020-12-06 15:19:44'),
(36, 'Nguồn FSP Power Supply HEXA 85 Series Model HA650 Active PFC', 1499000, NULL, 20, '40891_fsp_power_supply_hexa_85_series_model_ha650_0000_1.jpg', 58, 61, 'Đạt tiêu chuẩn ATX12 v2.4 & EPS12 v2.92\r\nHiệu suất cao ≧ 85%\r\nActive PFC ≧ 90%\r\nTuân thủ chứng nhận 80 PLUS® Bronze\r\nThiết kế đường 12V Single Rail\r\nTụ điện hoàn toàn của Nhật Bản\r\nQuạt siêu êm 120mm\r\nBảo vệ hoàn toàn: OCP, OVP, SCP, OPP, OTP\r\nAn toàn toàn cầu được phê duyệt                                ', '2020-12-06 15:20:44', '2020-12-06 15:20:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `level` int(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `address`, `password`, `create_at`, `update_at`, `level`) VALUES
(10, 'Cao Admin', 'admin@php.hoclai', '0327147158', 'VN', '123', '2021-10-19 21:56:33', '2021-10-23 16:24:39', 1),
(11, 'Trần Cao', 'cao@php.hoclai', '0327147158', 'VN', '123', '2021-10-19 22:01:03', '2021-10-23 16:24:58', 2);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sp_fk_dm` (`category_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `sp_fk_dm` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
