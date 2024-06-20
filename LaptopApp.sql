-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: mysql
-- Thời gian đã tạo: Th5 20, 2024 lúc 08:43 AM
-- Phiên bản máy phục vụ: 8.0.28
-- Phiên bản PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `LaptopApp`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Apple'),
(2, 'Dell'),
(3, 'HP'),
(4, 'Lenovo'),
(5, 'Asus'),
(6, 'Acer'),
(7, 'MSI'),
(8, 'Microsoft'),
(9, 'Samsung'),
(10, 'LG');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `laptop_id` int NOT NULL,
  `quantity` int DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total_money` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart_items`
--

INSERT INTO `cart_items` (`id`, `user_id`, `laptop_id`, `quantity`, `created_at`, `updated_at`, `total_money`) VALUES
(48, 1, 1, 1, '2024-05-08 07:45:29', '2024-05-08 07:45:29', 999.99);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `laptops`
--

CREATE TABLE `laptops` (
  `id` int NOT NULL,
  `name` varchar(350) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Tên sản phẩm',
  `price` decimal(10,2) NOT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `brightness` int DEFAULT NULL COMMENT 'Độ sáng',
  `ram` int DEFAULT NULL COMMENT 'RAM (GB)',
  `rom` int DEFAULT NULL COMMENT 'Bộ nhớ trong (GB)',
  `processor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Chip xử lý',
  `graphics_card` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Card đồ họa',
  `brand_id` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `avatar_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `screen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `wireless` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `system` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `weight` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `battery` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `keyboard` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bluetooth` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `webcam` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `laptops`
--

INSERT INTO `laptops` (`id`, `name`, `price`, `thumbnail`, `description`, `brightness`, `ram`, `rom`, `processor`, `graphics_card`, `brand_id`, `created_at`, `updated_at`, `avatar_url`, `screen`, `wireless`, `system`, `color`, `weight`, `battery`, `keyboard`, `bluetooth`, `webcam`, `lan`) VALUES
(1, 'MacBook Air', 999.99, 'macbook_air_thumbnail.jpg', 'Description of MacBook Air', 300, 8, 256, 'M1', 'On board', 1, '2024-04-13 12:20:52', '2024-04-20 00:23:49', 'https://drive.google.com/thumbnail?id=1dobrW9tt0h3wUiKtAzS61bx5d2uanbiI', '13.3 inches QHD+ OLED 60Hz', 'wifi', 'MacOs', 'silver', '1.2 kg', 'up to 10hrs using', 'no led', 'v5.2', 'HD+ Webcam', '10/100 Mbps'),
(2, 'Dell XPS 13', 1299.99, 'dell_xps13_thumbnail.jpg', 'Description of Dell XPS 13', 350, 16, 512, 'Intel Core i7', 'Intel UHD Graphics', 2, '2024-04-13 12:20:52', '2024-04-18 09:35:40', 'https://drive.google.com/thumbnail?id=1GzKKg00mZ3msDeyxhqP97xz_HGm0lWiH', '15.6 inches  60 Hz', 'WiFi 802.11ax (Wifi 6)', 'Windows 11 Home SL + Office Home & Student 2021', 'gray', '2.5 kg', '4-cell Li-ion, 76 Whr', 'Có phím số, LED trắng', 'v5.2', 'HD Webcam', '10/100 Mbps'),
(3, 'HP Spectre x360', 1399.99, 'hp_spectre_x360_thumbnail.jpg', 'Description of HP Spectre x360', 400, 16, 512, 'Intel Core i5-1140P', 'Intel Iris Xe Graphics', 3, '2024-04-13 12:20:52', '2024-04-20 00:26:18', 'https://drive.google.com/thumbnail?id=191_ElrscoNhWVS-lO1vPkaAxpnITLSU_', '14 inches FHD+  90Hz', 'wifi', 'Windows 10 Home SL + Office Home & Student 2021', 'black', '1.5kg', '4-cell Li-ion, 76 Whr', 'white led', 'v5.2', 'HD Webcam', '10/100 Mbps'),
(5, 'Laptop ASUS Zenbook 14 OLED UM3402YA KM405W', 1099.99, 'asus_zenbook14_thumbnail.jpg', 'Description of Asus ZenBook 14', 700, 16, 512, 'Intel Core i7-13700H', 'NVIDIA GeForce MX450', 5, '2024-04-13 12:20:52', '2024-05-20 07:40:24', 'https://drive.google.com/thumbnail?id=1LXf2g6skjr_3f7D0x7eZvltQW9pTUqu4', '14 inches QHD+ 90Hz', 'WiFi 802.11ax (Wifi 6)', 'Windows 11 Home SL + Office Home & Student 2021', 'black', '1.5kg', '4-cell Li-ion, 76 Whr', 'black', 'v5.2', 'FHD+ Webcam', '10/100 Mbps'),
(6, 'Laptop gaming Acer Nitro 5 Tiger AN515 58 50EE', 899.99, 'acer_swift3_thumbnail.jpg', 'Đánh giá chi tiết Laptop Gaming Acer Nitro 5 Tiger AN515 58 50EE\r\nMới đây dòng Nitro yêu thích của nhà Acer đã cho ra mắt phiên bản mới mang tên Tiger. Acer Nitro 5 Tiger AN515 58 50EE hứa hẹn sẽ là một sự lựa chọn tuyệt vời cho các game thủ cần hiệu năng mạnh mẽ, thiết kế đậm chất gaming hoàn toàn mới và đặc biệt là giá cả hợp lí. Hãy cùng GEARVN tìm hiểu các thông số kĩ thuật của chiếc laptop này nhé!', 300, 8, 512, 'Intel® Core™ i5-12450H', 'RTX™ 3050', 6, '2024-04-13 12:20:52', '2024-05-20 07:24:31', 'https://drive.google.com/thumbnail?id=1npw13P1sCPOQU2an2aWbdQKmcwR_1_Oy', '15.6 inch FHD IPS 144Hz', 'KillerTM Wi-Fi 6 AX 1650i (2x2)', 'Windows 11 Home', 'Obsidian Black', '2.5 kg', '4 Cell 57.5WHr', 'RGB 4 vùng', 'Bluetooth® 5.1', 'HD Webcam', 'KillerTM Ethernet E2600'),
(7, 'MSI GS66 Stealth', 1899.99, 'msi_gs66_thumbnail.jpg', 'Description of MSI GS66 Stealth', 300, 32, 1000, 'Intel Core i9', 'NVIDIA GeForce RTX 3080', 7, '2024-04-13 12:20:52', '2024-04-17 10:56:20', 'https://drive.google.com/thumbnail?id=1az4WhFJqrjvVLteXoB4sgMwcfo1RbbOB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Microsoft Surface Laptop 4', 1299.99, 'surface_laptop4_thumbnail.jpg', 'Description of Microsoft Surface Laptop 4', 350, 16, 512, 'AMD Ryzen 7', 'AMD Radeon Graphics', 8, '2024-04-13 12:20:52', '2024-04-17 10:57:08', 'https://drive.google.com/thumbnail?id=1BPQkBqY0tRZx72Fj7CFXE7O7w2ZV7jfi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Samsung Galaxy Book Pro', 1199.99, 'samsung_galaxybookpro_thumbnail.jpg', 'Description of Samsung Galaxy Book Pro', 350, 16, 512, 'Intel Core i7', 'Intel Iris Xe Graphics', 9, '2024-04-13 12:20:52', '2024-04-17 11:01:38', 'https://drive.google.com/thumbnail?id=1wCT1feWpNCiqxbMzMWJCKuY5zV-xMPho', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'LG Gram 14', 1399.99, 'lg_gram14_thumbnail.jpg', 'Description of LG Gram 14', 300, 16, 512, 'Intel Core i7', 'Intel Iris Xe Graphics', 10, '2024-04-13 12:20:52', '2024-04-17 11:00:16', 'https://drive.google.com/thumbnail?id=1DdFHaO-c__wSxwAeiah4P3C_PmZzSYzG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'new laptop', 1699.00, NULL, 'super good', 500, 16, 1024, 'I7-13800H', 'RTX 4060', 7, '2024-04-14 06:58:30', '2024-04-15 12:39:34', 'https://drive.google.com/thumbnail?id=1Ek9bjb9tvcq2iYGeO01BT7e9HCm0ASeZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'MSI Bravo 2024', 1699.00, NULL, 'super good', 500, 16, 1024, 'R7-5900H', 'RX-9000', 7, '2024-04-14 07:17:58', '2024-04-17 16:03:31', 'https://drive.google.com/thumbnail?id=15-KwmrM9n5GG_0ThpMan-gO19wyfvefn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Laptop gaming ASUS ROG Zephyrus G16 GU605MV', 2599.00, NULL, 'Đánh giá chi tiết laptop gaming ASUS ROG Zephyrus G16 GU605MV QR196WS\r\nNổi tiếng với những series laptop gaming tuyệt vời, ASUS luôn không ngừng cải tiến sản phẩm của mình qua từng năm. Đặc biệt, có một dòng laptop gaming ASUS nổi tiếng với tiêu chuẩn cực kì độc đáo là trọng lượng nhẹ mang tên ROG Zephyrus và nay đã được ra mắt một phiên bản hoàn toàn mới với model ROG Zephyrus G16 GU605MV QR196WS.', 500, 32, 1024, 'Intel® Core™ Ultra 9', 'NVIDIA® GeForce RTX™ 4060', 5, '2024-04-14 07:32:49', '2024-05-20 07:42:10', 'https://drive.google.com/thumbnail?id=1xII-1eV7xaNKGHpzDy9gVP4LVxSxX5SF', '16\" WQXGA  OLED 144Hz', 'WiFi 802.11ax (Wifi 6)', 'Windows 11 Home', 'Platinum White', '1.85 kg', '4 Cell 90WHr', 'Platinum White', 'Bluetooth 5.3 (Dual band) 2*2', '1080P FHD IR Camera for Windows Hello', '10/100/1000/Gigabits Base T'),
(14, 'test 5', 1299.00, NULL, 'kakakaka', 5555, 16, 512, 'I7-13800H', 'RTX 4060', 8, '2024-04-14 08:04:52', '2024-04-14 09:13:55', 'https://drive.google.com/thumbnail?id=1jdupCoDehFh9TNDRxryENRg-MR1Qbqb5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'test 6', 1599.00, NULL, 'sfgasfqwfawg', 1222, 12, 300, 'I7-13800H', 'RTX 4060', 7, '2024-04-14 08:11:58', '2024-04-14 08:11:58', 'https://drive.google.com/thumbnail?id=1gtf_dukWRL_Qyb37vuM27f0bsGEGQ0Ju', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Laptop Acer Swift Go 14 SFG14 73 53X7', 1119.00, NULL, 'Đánh giá chi tiết laptop Acer Swift X SFX14 71G', 400, 16, 512, 'Intel® Core™ Ultra 5', 'Intel® ARC™ Graphics', 6, '2024-04-15 03:48:31', '2024-05-20 07:16:37', 'https://drive.google.com/thumbnail?id=1JCdtqCZTVp0qRP5A0yZWULcEGTXhNkbN', '14\" 2.8K  120Hz', 'wifi', 'Windows 12 Home SL + Office Home & Student 2024', 'ultra galaxy', '1.8 kg', '54 whs', 'Backlit Chiclet Keyboard 1-Zone RGB without Num-key With Copilot key', 'v5.2', 'HD+ Webcam', '10/100 Mbps'),
(17, 'laptop sieu vip pro', 1000000.00, NULL, 'có chức năng ai tạo ra laptop khác', 500, 160, 1024, 'i', 'RTX 4099', 7, '2024-04-15 11:07:02', '2024-04-15 11:07:02', 'https://drive.google.com/thumbnail?id=1WX4hPKH8ARZgQrFz8vEf6jfVvJDh4Ki_', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'test laptop', 1700.00, NULL, 'a very good laptop', 2000, 16, 1024, 'I7-13800H', 'RTX 4099', 4, '2024-04-17 03:53:43', '2024-04-17 16:01:48', 'https://drive.google.com/thumbnail?id=1-lAKxQziOWvd5quyVin1HuuK_XI8IsTV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'dell 19', 1599.00, NULL, 'dell 18 very good', 1500, 16, 256, 'I7-13800H', 'RTX 4099', 2, '2024-04-18 08:15:29', '2024-04-18 08:38:26', 'https://drive.google.com/thumbnail?id=1S7r0oIGiyzaWgQhCF9ZL09b95EucG5Av', '15.6 inches  120 Hz', 'WiFi 802.11ax (Wifi 6)', 'Windows 11 Home SL + Office Home & Student 2021', 'black', '2.5 kg', '3-cell Li-ion, 41 Whr', 'Có phím số, không LED', 'v5.2', 'FHD+ Webcam', '10/100 Mbps'),
(20, 'Dell vostro 5410 2024', 1200.00, NULL, 'dell vostro is a very good laptop for new student', 400, 16, 1024, 'Intel Core i9-13900H', 'Intel Iris Xe Graphics', 2, '2024-04-21 05:21:57', '2024-04-21 05:21:57', 'https://drive.google.com/thumbnail?id=1DRbEZ4AAe5yC1fI3INV8LoxFZQPiZDtc', '15.6 inches FHD+ 90 Hz', 'WiFi 802.11ax (Wifi 6)', 'Windows 12 Home SL + Office Home & Student 2024', 'ultra galaxy', '1.5kg', '4-cell Li-ion, 76 Whr', 'white led', 'v5.2', 'FHD+ Webcam, AI vision, FACE receiving sensor', '10/100 Mbps'),
(21, 'dell test 5', 1500.00, NULL, 'description of dell test 1', 1200, 8, 1024, 'Intel Core i5-1140P', 'On board', 2, '2024-04-21 10:26:29', '2024-04-21 10:28:39', 'https://drive.google.com/thumbnail?id=14qrRQ2CWAfRvCnBeWhrERwozg6Oh_jaX', '15.6 inches FHD+ 90 Hz', 'WiFi 802.11ax (Wifi 6)', 'Windows 11 Home SL + Office Home & Student 2021', 'gray', '1.5kg', '3-cell Li-ion, 41 Whr', 'gray', 'v5.2', 'HD Webcam', '10/100 Mbps'),
(22, 'Laptop ASUS Vivobook S 16 OLED S5606MA MX051W', 1200.00, NULL, 'ASUS Vivobook S 16 OLED (S5606) với sức mạnh vượt trội từ Chip AI Intel® Core™ Ultra 7 cùng phím tắt Co-pilot đảm bảo hiệu năng xử lý mọi tác vụ mượt mà & nhanh chóng. Thiết kế mỏng nhẹ trong khung máy hoàn toàn bằng kim loại cho tính di động tuyệt đối. Tối ưu hóa trải nghiệm với màn hình Lumina OLED 3.2K 120Hz sống động, bàn phím ASUS ErgoSense với đèn nền RGB tùy chỉnh.', 600, 16, 512, 'Intel® Core™ Ultra 7', 'Intel® Arc™ Graphics', 5, '2024-05-20 07:06:05', '2024-05-20 07:47:28', 'https://drive.google.com/thumbnail?id=1h5YBF54imscrgdZB0jjLMqU_Sl-ufoDS', '16\" 3.2K 120Hz', 'WiFi 802.11ax (Wifi 6)', 'Windows 11 Home SL + Office Home & Student 2021', 'Mist Blue Aluminum', '1.5 kg', '4 Cells 75WHrs', 'Mist Blue Aluminum', 'v5.3', 'FHD camera with IR function to support Windows Hello ; With privacy shutter', 'None'),
(23, 'Laptop Acer Swift X SFX14 71G 75CV', 1899.00, NULL, 'Đánh giá chi tiết laptop Acer Swift X SFX14 71G 75CV\r\nAcer Swift là một trong những series laptop văn phòng đình đám của Acer. Sở hữu ngoại hình mỏng nhẹ, hiệu năng ổn định cùng giá cả phải chăng, không bất ngờ khi Acer Swift là một trong những model laptop cho sinh viên đáng sở hữu. Và đương nhiên Acer Swift X SFX14 71G 75CV cũng không ngoại lệ.', 500, 16, 1024, 'Intel® Core™ i7-13700H', 'RTX™ Graphics 4050', 6, '2024-05-20 07:11:26', '2024-05-20 07:13:35', 'https://drive.google.com/thumbnail?id=1BQvymp0OGxSvbu5I4641aeC_ue1j6JWo', '14.5\" 2.8K 120Hz', 'WiFi 802.11ax (Wifi 6)', 'Windows 11 Home SL + Office Home & Student 2021', 'silver', '1.5kg', '4-cell Li-ion, 76 Whr', 'silver', 'v5.3', 'FHD+ Webcam, AI vision, FACE receiving sensor', '10/100 Mbps'),
(24, 'Laptop Acer Aspire 7 A715 76 57CY', 699.00, NULL, 'Đánh giá chi tiết laptop Acer Aspire 7 A715 76 57CY\r\nNgoại hình mỏng manh\r\nAcer Aspire 7 A715 76 57CY sở hữu ngoại hình thon gọn và thanh mảnh quen thuộc thường thấy ở những model laptop văn phòng. Khoác lên mình chiếc áo khoác đen mạnh mẽ, Acer Aspire 7 được chau chuốt từng chi tiết nhỏ khiến tổng thể máy trông sang trọng và chắc chắn. Trọng lượng laptop siêu nhẹ giúp bạn có thể dễ dàng bỏ laptop vào balo và đi đến bất cứ đâu.', 400, 8, 512, 'Intel Core  i5-12450H', 'Intel® UHD Graphics', 6, '2024-05-20 07:28:23', '2024-05-20 07:28:23', 'https://drive.google.com/thumbnail?id=192BRsosn7eRmSO9heN0lSJLwMouzLVfH', '15.6\" FHD  60Hz', 'WiFi 802.11ax (Wifi 6)', 'Windows 11 Home', 'black', '2.1 kg', '3-cell Li-ion, 41 Whr', 'white led', 'v5.2', 'HD Webcam', 'None'),
(25, 'Laptop gaming ASUS ROG Strix G16 G614JVR', 1999.00, NULL, 'Đánh giá chi tiết sản phẩm Laptop gaming ASUS ROG Strix G16 G614JVR N4141W\r\nLaptop gaming ASUS ROG Strix G16 G614JVR N4141W đây là một trong những chiếc laptop chuyên game cực khủng bởi nó mang trong mình một hiệu năng vượt trội từ những linh kiện cao cấp. Ngoài ra, với một dòng Flagship đến từ ASUS nên việc trang bị cho nó một lắp vỏ có một nét thẩm mỹ  và hầm hố là không thể bàn cãi.', 700, 32, 512, 'Intel® Core™ i9 14900HX', 'NVIDIA® GeForce RTX™ 4060', 5, '2024-05-20 07:46:13', '2024-05-20 07:46:13', 'https://drive.google.com/thumbnail?id=1X6tYN5rFphkORML5SG1Zi_GOqARURy0F', '16\" WQXGA IPS 2.5K, 240Hz', 'Wi-Fi 6E(802.11ax) (Triple band) 2*2', 'Windows 11 Home', 'Eclipse Gray', '2.5 kg', '4 Cell 90WHrs', 'Backlit Chiclet Keyboard Per-Key RGB', 'Bluetooth 5.3', '720P HD camera', '10/100/1000 Mbps');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `laptop_images`
--

CREATE TABLE `laptop_images` (
  `id` int NOT NULL,
  `laptop_id` int NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `laptop_images`
--

INSERT INTO `laptop_images` (`id`, `laptop_id`, `url`) VALUES
(4, 11, 'https://drive.google.com/thumbnail?id=1LHpmEgCrzekTLhMpdHnlSsLBeU4HTtzZ'),
(6, 18, 'https://drive.google.com/thumbnail?id=151s9j1oNOWG3rcvNtkecOMlcLG0zu6VF'),
(7, 18, 'https://drive.google.com/thumbnail?id=1akcEEp2UVPl-KM2p2zFjdHr1tnYmoIXF'),
(8, 18, 'https://drive.google.com/thumbnail?id=1CkRGa0eC7MImktqryfi6N4R27HxljX6-'),
(9, 19, 'https://drive.google.com/thumbnail?id=1hqwSWL_z7MfpDnBpAE3j8zS5dUam7an9'),
(10, 19, 'https://drive.google.com/thumbnail?id=1_QaW9V4H01SzI7EqmF4BZu9f1YVS_I7c'),
(11, 19, 'https://drive.google.com/thumbnail?id=1s4Y3XvKQsVu33d3M2Dp2E_0PfIFQnFm5'),
(12, 1, 'https://drive.google.com/thumbnail?id=1qZalNxPIXfi7PkO6cgtbdiJRPKWOl5Ps'),
(13, 1, 'https://drive.google.com/thumbnail?id=1fwK7kgNm6c7Mo5FOVytyswK-5kUCEBQC'),
(14, 1, 'https://drive.google.com/thumbnail?id=111u7RaGy3B2IiLkka93obWqtIMdeFkXl'),
(15, 2, 'https://drive.google.com/thumbnail?id=18_it2NUDMaFBDt5SuufrkX_EMHfy2x3f'),
(16, 2, 'https://drive.google.com/thumbnail?id=1sMCqaJeYHuoEeT1Rcoke8926_Q5bJADG'),
(17, 2, 'https://drive.google.com/thumbnail?id=1W9AGI9Oip6XDjoqMzXqPvl4ivwlTE0Db'),
(18, 3, 'https://drive.google.com/thumbnail?id=1lK4-5NgvCbw-hWQLhjq_pkM0AwuOll7n'),
(19, 3, 'https://drive.google.com/thumbnail?id=1VRje44pBOrtjmBCVVQJnmJEhI_iOHNWY'),
(22, 20, 'https://drive.google.com/thumbnail?id=1SPt-9KEHejw_76XzWNmCvx9BbSz5GDpw'),
(23, 20, 'https://drive.google.com/thumbnail?id=1IiWS5IRZY8eA5PDAYsFK6yZID806iwAk'),
(24, 20, 'https://drive.google.com/thumbnail?id=1pMFDSRh_vnhVZBZ_xNf172mGQEkL_Fdw'),
(25, 21, 'https://drive.google.com/thumbnail?id=1bl3gOm1ombUXFJkMpdCaZXn-fgH29Nj5'),
(26, 21, 'https://drive.google.com/thumbnail?id=1qwgFZHVd12IuWjdUHjksYrx_A4nvfYG7'),
(27, 21, 'https://drive.google.com/thumbnail?id=13AYDAAb2XXlULV1PUAp8kaR0KdirOLob'),
(28, 23, 'https://drive.google.com/thumbnail?id=10dmWM2XKW8smDFPFFlAuaSr79-GPPyE_'),
(29, 23, 'https://drive.google.com/thumbnail?id=1vTaNklFr8_8xP1t8xI88U4hAOfWhFQp8'),
(30, 23, 'https://drive.google.com/thumbnail?id=1e6IAP192NzbopMVCdaqCPowxEAZzd5Jo'),
(31, 23, 'https://drive.google.com/thumbnail?id=1YrlWzy5hSIHOw1KG97R0YG4NDiBJw2uO'),
(32, 16, 'https://drive.google.com/thumbnail?id=1JQOI2eWCMgFeHC9aMLRuFOJ9ZXBfx3QB'),
(33, 16, 'https://drive.google.com/thumbnail?id=1A9EeGa362kgyY5D_KwYiuS72v5KEBqQV'),
(34, 16, 'https://drive.google.com/thumbnail?id=1w5z-G7OVkDJmaaoVtuNGi-WmuUjE6bBL'),
(35, 16, 'https://drive.google.com/thumbnail?id=146AbS9Io4c_LZvs6g0k_2GcGsM05l2zX'),
(36, 6, 'https://drive.google.com/thumbnail?id=1m5BMG3DVUlVN_mnx5ef1CfnG0XcGSaIG'),
(37, 6, 'https://drive.google.com/thumbnail?id=1Ki_cc4TQYtsFqhNFLkCdRDrk8R65G2s-'),
(38, 6, 'https://drive.google.com/thumbnail?id=1VQs3XOchBuYl6etbeXPDeo1ov87Vw1bY'),
(39, 6, 'https://drive.google.com/thumbnail?id=1zz-mG99RPTSJ3l7JOIE_lptaN9cf5NEd'),
(40, 24, 'https://drive.google.com/thumbnail?id=1LpvtRalCwAOo2IpxzA5pdhnQnB5dVLuO'),
(41, 24, 'https://drive.google.com/thumbnail?id=1tMrjVK16LkNEx5DuL_qiaQLZqAWURtSQ'),
(42, 24, 'https://drive.google.com/thumbnail?id=1A2ySFCQgXCjtjfAuqwCubZIs9gOJrJI-'),
(43, 24, 'https://drive.google.com/thumbnail?id=17ndJSbUUYbLmSpZhpHcfhgikhuCNluc2'),
(44, 22, 'https://drive.google.com/thumbnail?id=1Xh1cDDX14HrTG04r2H6OrT7PRLQTPg25'),
(45, 22, 'https://drive.google.com/thumbnail?id=1fhMDzfntXvityQvHPA1M6HB0Kw65OvV_'),
(46, 22, 'https://drive.google.com/thumbnail?id=1nmZVLxnADZXIEp30sIRbhjZ_q8eDX5KK'),
(47, 22, 'https://drive.google.com/thumbnail?id=1CpMYXqzGC-oc2McLQv2yRbMTggXrytrN'),
(48, 13, 'https://drive.google.com/thumbnail?id=1J12pdoEyXx0mdmXP4e6NcN01-Uvs8ILP'),
(49, 13, 'https://drive.google.com/thumbnail?id=1bkkS8vPDO3wF93nV-otSkWkhjDXZNOvJ'),
(50, 13, 'https://drive.google.com/thumbnail?id=1yGHvALTwEVMvD1Qu-0JAKOeIMgcsaxPc'),
(51, 13, 'https://drive.google.com/thumbnail?id=1d478Wxwwi25j1ZVH-0WKYjhc0c8tQG92'),
(52, 5, 'https://drive.google.com/thumbnail?id=11VVXKotU5uWBQwlWM_7tgZihgw8Ncx5o'),
(53, 5, 'https://drive.google.com/thumbnail?id=1MZVicGg5eZBbCRxercSgk4dEcpC8QYzD'),
(54, 5, 'https://drive.google.com/thumbnail?id=1BMkoKbTeYv8uepBgmdirgKl0K63Wk1BX'),
(55, 5, 'https://drive.google.com/thumbnail?id=155-BxCESnhodppSW4GdOmX54NxElk80f'),
(56, 25, 'https://drive.google.com/thumbnail?id=15nDiwxz9xDxdLFC25Q6Q38kbw8fcMFLC'),
(57, 25, 'https://drive.google.com/thumbnail?id=1ABYzUAogLo9BzRQiY0ycU49WclwyZwBj'),
(58, 25, 'https://drive.google.com/thumbnail?id=1FVMcbYBoGFIltLZ8YS8U_K8DhMS2czDx'),
(59, 25, 'https://drive.google.com/thumbnail?id=14A4jQYsZsGJmZq7n6L5B8bBL2sN6Peiw');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_04_13_085254_brands', 1),
(6, '2024_04_13_085303_laptops', 1),
(7, '2024_04_13_085604_cart_items', 1),
(8, '2024_04_13_085613_orders', 1),
(9, '2024_04_13_085628_order_details', 1),
(10, '2024_04_18_032443_add_column_to_laptops', 2),
(11, '2024_04_18_170010_add_column_to_cart_items', 3),
(12, '2024_04_18_170811_add_column_to_cart_items_2', 4),
(13, '2024_04_21_063344_add_columns_to_orders', 5),
(15, '2024_05_08_120319_add_columnn_to_orders', 6),
(16, '2024_05_11_182025_add_columns_to_order', 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `fullname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `phone_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `note` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','processing','delivered','received','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `total_money` decimal(10,2) DEFAULT NULL,
  `shipping_address` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_method` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tax` double(8,2) DEFAULT NULL,
  `paid` tinyint(1) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `fullname`, `phone_number`, `note`, `order_date`, `status`, `total_money`, `shipping_address`, `payment_method`, `created_at`, `updated_at`, `tax`, `paid`, `email`) VALUES
(19, 4, 'cus1', '0987899977', 'nếu muốn phá sản hãy gửi hàng đểu', '2024-03-21 07:00:41', 'cancelled', 10669.91, '105, Tan Phong, District 7', 'COD', NULL, NULL, NULL, 0, ''),
(20, 4, 'Chí Kha', '1234554321', 'đóng gói cẩn thận nếu không muốn bị ban', '2024-03-21 07:11:25', 'received', 2639.98, 'Nhà Bè', 'COD', NULL, NULL, NULL, 0, ''),
(21, 4, 'cus2', '0333279377', 'che tên nếu không muốn bị hack', '2024-04-21 07:14:48', 'cancelled', 4619.97, '260, Mai Chi Tho, District 2, Ho Chi Minh City', 'COD', NULL, NULL, NULL, 0, ''),
(22, 14, 'Kha', '0888888888', 'nếu muốn phá sản hãy gửi hàng đểu', '2024-02-21 08:26:39', 'processing', 3078.90, 'xã Mỹ Hạnh Bắc, Đức Hòa, Long An', 'COD', NULL, NULL, NULL, 1, ''),
(23, 14, 'cus3', '777999888', 'che tên nếu không muốn bị hack', '2024-02-21 08:28:12', 'processing', 3299.97, '300, Mai Chi Tho, District 2, Ho Chi Minh City', 'COD', NULL, NULL, NULL, 1, ''),
(24, 4, 'cus1', '0987899977', 'hàng dễ vỡ xin nhẹ tay', '2024-04-21 09:46:54', 'cancelled', 11108.90, '105, Tan Phong, District 7, Ho Chi Minh City', 'COD', NULL, NULL, NULL, 1, ''),
(25, 4, 'test', '0888888888', 'đóng gói cẩn thận nếu không muốn bị ban', '2024-04-21 09:48:18', 'cancelled', 3187.80, 'xã Mỹ Hạnh Bắc, Đức Hòa, Long An', 'COD', NULL, NULL, NULL, 1, ''),
(26, 4, 'Kha', '0888888888', 'nếu muốn phá sản hãy gửi hàng đểu', '2024-04-21 09:49:27', 'processing', 3408.89, 'xã Mỹ Hạnh Bắc, Đức Hòa, Long An', 'COD', NULL, NULL, 340.89, 1, ''),
(27, 15, 'cus1', '0987899977', 'hàng dễ vỡ xin nhẹ tay', '2024-04-21 10:45:07', 'received', 6049.99, '105, Tan Phong, District 7, Ho Chi Minh City', 'COD', NULL, NULL, 605.00, 1, ''),
(28, 15, 'Kha', '0888888888', NULL, '2024-04-21 10:45:28', 'processing', 1429.99, 'xã Mỹ Hạnh Bắc, Đức Hòa, Long An', 'COD', NULL, NULL, 143.00, 1, ''),
(29, 15, 'Chí Kha', '1234554321', 'đóng gói cẩn thận nếu không muốn bị ban', '2024-04-21 10:45:41', 'cancelled', 1209.99, 'Nhà Bè, TP Hồ Chí Minh', 'COD', NULL, NULL, 121.00, 1, ''),
(30, 17, 'Kha', '0888888888', 'nếu muốn phá sản hãy gửi hàng đểu', '2024-04-22 03:48:00', 'delivered', 1429.99, 'xã Mỹ Hạnh Bắc, Đức Hòa, Long An', 'COD', NULL, NULL, 143.00, 0, ''),
(31, 17, 'd', 'd', NULL, '2024-04-22 04:03:34', 'cancelled', 9563.40, 'd', 'COD', NULL, NULL, 956.34, 0, ''),
(32, 1, 'Kha', '0888888888', 'che tên nếu không muốn bị hack', '2024-05-03 01:43:11', 'pending', 1613040.00, 'xã Mỹ Hạnh Bắc, Đức Hòa, Long An', 'COD', NULL, NULL, 161304.00, 0, ''),
(33, 4, 'Kha', '0888888888', 'hàng dễ vỡ xin nhẹ tay', '2024-05-03 06:59:35', 'pending', 5389.97, 'xã Mỹ Hạnh Bắc, Đức Hòa, Long An', 'COD', NULL, NULL, 539.00, 0, ''),
(34, 4, 'Chí Kha', '1234554321', 'đóng gói cẩn thận nếu không muốn bị ban', '2024-05-08 12:18:33', 'pending', 7699.92, 'Nhà Bè, TP Hồ Chí Minh', 'VNPAY', NULL, NULL, 769.99, 1, ''),
(35, 1, 'cus2', '0333279377', 'đóng gói cẩn thận nếu không muốn bị ban', '2024-05-11 02:58:13', 'pending', 1429.99, '260, Mai Chi Tho, District 2, Ho Chi Minh City', 'VNPAY', NULL, NULL, 143.00, 0, ''),
(36, 1, 'Chí Kha', '1234554321', 'đóng gói cẩn thận nếu không muốn bị ban', '2024-03-11 03:02:38', 'pending', 1539.99, 'Lê Văn Lương', 'VNPAY', NULL, NULL, 154.00, 1, ''),
(37, 4, 'Chí Kha', '1234554321', 'đóng gói cẩn thận nếu không muốn bị ban', '2024-03-11 03:14:14', 'pending', 1539.99, 'Nhà Bè, TP Hồ Chí Minh', 'VNPAY', NULL, NULL, 154.00, 1, ''),
(39, 4, 'Chí Kha', '1234554321', 'đóng gói cẩn thận nếu không muốn bị ban', '2024-05-11 03:19:04', 'cancelled', 3078.89, 'Nhà Bè, TP Hồ Chí Minh', 'VNPAY', NULL, NULL, 307.89, 0, ''),
(40, 4, 'Chí Kha', '1234554321', 'đóng gói cẩn thận nếu không muốn bị ban', '2024-05-12 12:22:58', 'cancelled', 3299.98, 'Nhà Bè, TP Hồ Chí Minh', 'VNPAY', NULL, NULL, 330.00, 1, ''),
(41, 4, 'Long', '555555555555', 'đóng gói cẩn thận nếu không muốn bị ban', '2024-05-12 12:25:12', 'cancelled', 1099.99, 'sao hỏa', 'VNPAY', NULL, NULL, 110.00, 1, ''),
(42, 4, 'Chí Kha', '1234554321', 'đóng gói cẩn thận nếu không muốn bị ban', '2024-05-12 17:50:52', 'cancelled', 3627.80, 'Nhà Bè, TP Hồ Chí Minh', 'VNPAY', NULL, NULL, 362.78, 1, 'chikha13122@gmail.com'),
(43, 4, 'Chí Kha', '1234554321', 'đóng gói cẩn thận nếu không muốn bị ban', '2024-04-12 17:58:45', 'pending', 2529.98, 'Nhà Bè, TP Hồ Chí Minh', 'VNPAY', NULL, NULL, 253.00, 1, 'chikha13122@gmail.com'),
(44, 4, 'Chí Kha', '1234554321', 'đóng gói cẩn thận nếu không muốn bị ban', '2024-04-13 16:11:12', 'pending', 3409.98, 'Nhà Bè, TP Hồ Chí Minh', 'VNPAY', NULL, NULL, 341.00, 1, 'chikha13122@gmail.com'),
(45, 4, 'MCK', '05050505', 'free or your shop will be destroyed', '2024-05-20 08:24:07', 'pending', 1209.99, 'New York City', 'COD', NULL, NULL, 121.00, 0, 'chikha13122@gmail.com'),
(46, 4, 'MCK', '05050505', 'free or your shop will be destroyed', '2024-05-20 08:26:03', 'pending', 2419.99, 'New York City', 'VNPAY', NULL, NULL, 242.00, 1, 'chikha13122@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `number_of_products` int DEFAULT '1',
  `total_money` decimal(10,2) DEFAULT '0.00',
  `color` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `price`, `number_of_products`, `total_money`, `color`) VALUES
(8, 19, 10, 1399.99, 5, 6999.95, NULL),
(9, 19, 6, 899.99, 3, 2699.97, NULL),
(10, 20, 1, 999.99, 1, 999.99, 'silver'),
(11, 20, 10, 1399.99, 1, 1399.99, NULL),
(12, 21, 3, 1399.99, 3, 4199.97, 'black'),
(13, 22, 13, 1599.00, 1, 1599.00, NULL),
(14, 22, 20, 1200.00, 1, 1200.00, 'ultra galaxy'),
(15, 23, 1, 999.99, 3, 2999.97, 'silver'),
(16, 24, 20, 1200.00, 7, 8400.00, 'ultra galaxy'),
(17, 24, 12, 1699.00, 1, 1699.00, NULL),
(18, 25, 14, 1299.00, 1, 1299.00, NULL),
(19, 25, 15, 1599.00, 1, 1599.00, NULL),
(20, 26, 10, 1399.99, 1, 1399.99, NULL),
(21, 26, 11, 1699.00, 1, 1699.00, NULL),
(22, 27, 21, 1500.00, 3, 4500.00, 'gray'),
(23, 27, 1, 999.99, 1, 999.99, 'silver'),
(24, 28, 2, 1299.99, 1, 1299.99, 'gray'),
(25, 29, 5, 1099.99, 1, 1099.99, 'black'),
(26, 30, 2, 1299.99, 1, 1299.99, 'gray'),
(27, 31, 14, 1299.00, 3, 3897.00, NULL),
(28, 31, 16, 1599.00, 3, 4797.00, NULL),
(29, 32, 20, 1200.00, 1222, 1466400.00, 'ultra galaxy'),
(30, 33, 5, 1099.99, 1, 1099.99, 'black'),
(31, 33, 7, 1899.99, 2, 3799.98, NULL),
(32, 34, 1, 999.99, 7, 6999.93, 'silver'),
(33, 35, 8, 1299.99, 1, 1299.99, NULL),
(34, 36, 3, 1399.99, 1, 1399.99, 'black'),
(35, 37, 3, 1399.99, 1, 1399.99, 'black'),
(36, 39, 5, 1099.99, 1, 1099.99, 'black'),
(37, 39, 11, 1699.00, 1, 1699.00, NULL),
(38, 40, 7, 1899.99, 1, 1899.99, NULL),
(39, 40, 5, 1099.99, 1, 1099.99, 'black'),
(40, 41, 1, 999.99, 1, 999.99, 'silver'),
(41, 42, 12, 1699.00, 1, 1699.00, NULL),
(42, 42, 13, 1599.00, 1, 1599.00, NULL),
(43, 43, 1, 999.99, 1, 999.99, 'silver'),
(44, 43, 2, 1299.99, 1, 1299.99, 'gray'),
(45, 44, 7, 1899.99, 1, 1899.99, NULL),
(46, 44, 9, 1199.99, 1, 1199.99, NULL),
(47, 45, 5, 1099.99, 1, 1099.99, 'black'),
(48, 46, 1, 999.99, 1, 999.99, 'silver'),
(49, 46, 20, 1200.00, 1, 1200.00, 'ultra galaxy');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('khamai05767@gmail.com', '$2y$10$15f4a6NckK58SCXQkwaWQ.gUmoJKe7XHcNjmfOEb.bNCzvCCEvZ12', '2024-05-15 03:53:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `order_id`, `method`, `amount`, `created_at`, `updated_at`, `status`) VALUES
(1, 4, 37, 'VNPAY', 1539.99, '2024-05-11 04:01:32', '2024-05-11 04:01:32', 'success'),
(2, 4, 42, 'VNPAY', 3627.80, '2024-05-12 17:51:40', '2024-05-12 17:51:40', 'success'),
(3, 4, 43, 'VNPAY', 2529.98, '2024-05-12 17:59:16', '2024-05-12 17:59:16', 'success'),
(4, 4, 43, 'VNPAY', 2529.98, '2024-05-12 18:00:44', '2024-05-12 18:00:44', 'success'),
(5, 4, 44, 'VNPAY', 3409.98, '2024-05-13 16:14:11', '2024-05-13 16:14:11', 'success'),
(6, 4, 46, 'VNPAY', 2419.99, '2024-05-20 08:28:04', '2024-05-20 08:28:04', 'success');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `user_type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'User 1', 'user1@example.com', NULL, '$2y$10$9LHkLy/6DCgxVu9IwL.jhOasZLPBHorEuoX3b.m7k53f.0sWK82nm', 'user', NULL, '2024-04-13 12:20:52', '2024-04-13 12:20:52'),
(2, 'User 2', 'user2@example.com', NULL, '$2y$10$zBsVPgGRURDPxaL6AoM9yurlcHcde1L00QOSXtF6yfd46X7fnzu7O', 'user', NULL, '2024-04-13 12:20:52', '2024-04-13 12:20:52'),
(3, 'admin', 'admin@example.com', NULL, '$2y$10$zBsVPgGRURDPxaL6AoM9yurlcHcde1L00QOSXtF6yfd46X7fnzu7O', 'admin', NULL, '2024-04-13 12:20:52', '2024-04-13 12:20:52'),
(4, 'Chí Kha', 'abc123@gmail.com', NULL, '$2y$10$603JGoPbRqsaZ0NxEOxRl.YdIt77S2ndtu2pUJ3r3ZqRMDATy2cM2', 'user', NULL, '2024-04-13 14:04:43', '2024-04-13 14:04:43'),
(5, 'Chi Kha', 'mck0506@gmail.com', NULL, '$2y$10$pfJGbpAlBDTjTiE9Klj63.mq8gNbMniq3QiSFNSLcLK7./tMwnZYW', 'user', NULL, '2024-04-15 11:25:56', '2024-04-15 11:25:56'),
(12, 'Kha test mail', 'khamai05767@gmail.com', NULL, '$2y$10$2RlVTzp26Cj0yCsdlqSiDu/IJe0TE19y2i9t8qiC6S0wtkurYGFSW', 'user', NULL, '2024-04-16 03:26:24', '2024-04-16 03:26:24'),
(14, 'mck', 'mck@gmail.com', NULL, '$2y$10$2wqUgTV92Q3t6xHNO7kFpuGciI2PPOZWybrLJUBwBaMYMujtA5.Va', 'user', NULL, '2024-04-21 08:26:05', '2024-04-21 08:26:05'),
(15, 'Nam', 'nam@gmail.com', NULL, '$2y$10$JZ7yO6DzNYl8Npc8EkYaZuu26UnbX9MyRp1JDeSo.dgUa/L0dLdoO', 'user', NULL, '2024-04-21 10:39:10', '2024-04-21 10:39:10'),
(16, 'Yen', 'chomatdin@gmail.com', NULL, '$2y$10$e8/qL8MM0iMeNBP12IRIhOz.SMoDBxz9w/r5iEBw71.coAbD9SFnC', 'user', NULL, '2024-04-22 03:38:19', '2024-04-22 03:38:19'),
(17, 'Yen', 'chomatdinh@gmail.com', NULL, '$2y$10$lPD0VHEl64G0ci4sv/vjn.qBg0AhwOiYSbFn5GlQXU4MhSDI6Jedm', 'user', 'OdAf5t6YzNsi9b56IvupbFEzEEYzhdpE352hCV9rAZwHyuuitB4NpTVNUrCb', '2024-04-22 03:39:55', '2024-04-22 04:03:51');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cart_items_cart_id` (`user_id`),
  ADD KEY `fk_cart_items_product_id` (`laptop_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `laptops`
--
ALTER TABLE `laptops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_laptops_brand_id` (`brand_id`);

--
-- Chỉ mục cho bảng `laptop_images`
--
ALTER TABLE `laptop_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laptop_id` (`laptop_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_details_order_id` (`order_id`),
  ADD KEY `fk_order_details_product_id` (`product_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `laptops`
--
ALTER TABLE `laptops`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `laptop_images`
--
ALTER TABLE `laptop_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `fk_cart_items_cart_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_cart_items_product_id` FOREIGN KEY (`laptop_id`) REFERENCES `laptops` (`id`);

--
-- Các ràng buộc cho bảng `laptops`
--
ALTER TABLE `laptops`
  ADD CONSTRAINT `fk_laptops_brand_id` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`);

--
-- Các ràng buộc cho bảng `laptop_images`
--
ALTER TABLE `laptop_images`
  ADD CONSTRAINT `laptop_images_ibfk_1` FOREIGN KEY (`laptop_id`) REFERENCES `laptops` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_order_details_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `fk_order_details_product_id` FOREIGN KEY (`product_id`) REFERENCES `laptops` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
