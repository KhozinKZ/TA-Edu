-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Mar 2024 pada 15.16
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eshop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `berandas`
--

CREATE TABLE `berandas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailukuran`
--

CREATE TABLE `detailukuran` (
  `id_detail_ukuran` int(11) NOT NULL,
  `id_barang` varchar(200) NOT NULL,
  `id_ukuran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detailukuran`
--

INSERT INTO `detailukuran` (`id_detail_ukuran`, `id_barang`, `id_ukuran`) VALUES
(159, 'BR001', 'UK002'),
(160, 'BR001', 'UK003'),
(161, 'BR001', 'UK004'),
(162, 'BR002', 'UK001'),
(163, 'BR002', 'UK002'),
(164, 'BR002', 'UK003'),
(165, 'BR003', 'UK001'),
(166, 'BR003', 'UK002'),
(167, 'BR003', 'UK003'),
(168, 'BR003', 'UK004'),
(169, 'BR003', 'UK005'),
(170, 'BR004', 'UK001'),
(171, 'BR004', 'UK002'),
(172, 'BR004', 'UK003'),
(173, 'BR005', 'UK001'),
(174, 'BR005', 'UK002'),
(175, 'BR005', 'UK003'),
(176, 'BR005', 'UK004'),
(177, 'BR006', 'UK001'),
(178, 'BR006', 'UK002'),
(179, 'BR006', 'UK003'),
(180, 'BR007', 'UK001'),
(181, 'BR007', 'UK002'),
(182, 'BR007', 'UK003'),
(183, 'BR007', 'UK004'),
(184, 'BR008', 'UK002'),
(185, 'BR008', 'UK003'),
(186, 'BR008', 'UK004'),
(187, 'BR009', 'UK002'),
(188, 'BR009', 'UK003'),
(189, 'BR009', 'UK004'),
(190, 'BR010', 'UK002'),
(191, 'BR010', 'UK003'),
(192, 'BR010', 'UK004');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_resets_table', 1),
(11, '2019_08_19_000000_create_failed_jobs_table', 1),
(12, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(13, '2023_12_08_031021_create_pakaians_table', 1),
(14, '2023_12_08_031457_create_barangs_table', 1),
(18, '2023_12_14_101424_create_ukurans_table', 2),
(19, '2024_01_03_033845_create_detailukurans_table', 2),
(20, '2024_02_18_022012_create_berandas_table', 3),
(21, '2024_02_21_140237_create_keranjangs_table', 4),
(22, '2024_02_24_224954_create_transaksis_table', 5),
(23, '2024_03_01_144507_create_permission_tables', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Dasboard', 'web', '2024-03-01 18:37:23', '2024-03-01 18:37:23'),
(2, 'Pembeli', 'web', '2024-03-01 19:22:10', '2024-03-01 19:22:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2024-03-01 18:37:22', '2024-03-01 18:37:22'),
(2, 'Pembeli', 'web', '2024-03-01 19:22:10', '2024-03-01 19:22:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id` varchar(200) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `id_pakaian` varchar(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`id`, `nama_produk`, `id_pakaian`, `harga`, `stok`, `gambar`, `keterangan`) VALUES
('BR001', 'Kaos Baju Distro World Distrust Black to Black Hitam Unisex Pria Wanita Cotton Combed', 'PK001', 82499, 120, 'kaosdistro.jpeg', 'Kaos Baju Distro World Distrust Black to Black Hitam Unisex Pria Wanita Cotton Combed 24s NB088\r\n\r\nDesain Keren Kekinian Dipadu Dengan Teknik Sablon Terkini Sehingga Menghasilkan Kualitas Kaos Yang Sempurna\r\n\r\nMaterial :\r\nCotton COmbed 24s\r\nSablon Plastisol\r\nJahitan Rapi Dengan Overdeck 3 Jarum'),
('BR002', 'SEVENKEY T-SHIRT DISTRO ORIGINAL BRAND KAOS DISTRO SEVENKEY KAOS DISTRO PRIA DAN WANITA', 'PK001', 45000, 199, 'distro2.jpeg', 'Kaos Sevenkey Original\r\n\r\n*Material : Cotton Combed30S\r\n*Jahitan Overdeck dan Jahitan Rantai di Bagian pundak \r\n*Warna Kain tidak akan luntur \r\n*Sablon Plastisol Japan : Rapi, Kuat dan tidak akan pecah bila di cuci\r\n\r\nSize : L dan XL\r\nL : Panjang 70cm Lingkar Dada 105cm\r\nXL : Panjang 72cm Lingkar Dada 110cm\r\n\r\n NOTE\r\n-harga Yg tertera di produk merupakan harga satuan\r\n-pengiriman pesanan setiap hari kecuali hari minggu dan hari libur nasional\r\n-pesanan Yg masuk sebelum jam 16.00 akan dikirim di hari sama jika lewat dari itu dikirim di hari berikut nya\r\n-Selama produk masih bisa di pesan berarti stok ready'),
('BR003', 'Kaos Pria Distro Lengan Pendek Kayser Time Baju T-Shirt KerenDISTRO SEVENKEY KAOS DISTRO PRIA DAN WANITA', 'PK001', 49000, 498, 'distro3.jpeg', 'Bahan Babyterry, Kualitas Bahan sedang.\r\n- Motif Sablon dengan heat press sistem  bukan manual (tangan)\r\n- Leher manset dan tangan manset menggunakan RIB Good Quality.\r\n- Lengan Pendek.\r\n\r\n>> DETAIL SIZE (Lengan Pendek dan Panjang Ukuran sama, hanya beda pada Lengannya) :\r\n- SIZE M- L : Lingkar Dada 104CM x Panjang baju 68CM\r\nLebar Baju 52CM\r\n\r\n- SIZE XL : Lingkar Dada 107CM x Panjang baju 70CM\r\nLebar Baju 54CM\r\n\r\n- Size XXL : Lingkar Dada 114CM x Panjang 72CM\r\nLebar Baju 57CM\r\n\r\nLeher manset dan tangan manset menggunakan RIB Good Quality\r\nNyaman di pakai\r\nTidak Pudar (Tajam)  & Tahan Lama dan tidak mudah Melar\r\nSisi jahitan, Samping + bawah sangat rapih.'),
('BR004', 'KAOS POLOS COTTON COMBED PREMIUM', 'PK004', 30000, 300, 'lengan.jpeg', 'Kaos Polos Cotton Combed Premium lengan Panjang Adalah Kaos Polos Fashion Pria Wanita style korean, retro,formal untuk kegiatan daily/sehari hari juga nyaman banget dengan harga termurah langsung dari PABRIKINYA !\r\n\r\nDESKRIPSI PRODUK :\r\n✔️ PRODUK TIDAK BERMERK, HANYA ADA SIZE.\r\n✔️ PRODUK COCOK UNTUK YANG INGIN DI JUAL ULANG ATAU DI SABLON LAGI.\r\n✔️ BAHAN POLYESTER\r\n\r\nTersedia Size : \r\nS = Lebar 47 cm, Panjang 66cm\r\nM = Lebar 48 cm, Panjang 68cm\r\nL = Lebar 50 cm, Panjang 70 cm\r\nXL = Lebar 52 cm, Panjang 72 cm'),
('BR005', 'Baju Kemeja Flanel Pria Lengan Panjang Motif Kotak-Kotak Casual', 'PK004', 55000, 200, 'lengan2.jpeg', 'Kemeja flanel yang bisa dipakai pria maupun wanita. Bisa dipakai acara formal maupun non formal. seperti kuliah, kondangan, atau dipakai ngapel juga bisa hehe...\r\n\r\nBahan flanel yang gak terlalu tebel juga gak tipis jadi sangat nyaman ketika dipakai.\r\n\r\nPilihan motifnya juga banyak. Kakak bisa pilih motif apapun yang kakak suka.\r\n\r\nMotif mirip di gambar ya kak (kalau gak sama dengan gambar, bisa di kembalikan)\r\n\r\nTERSEDIA UKURAN   L, XL\r\nUNTUK PANDUAN UKURAN ADA DIBAWAH INI\r\n\r\nsize chart:\r\nM: Panjang 70cm x lebar 48.5cm\r\nL: Panjang 72cm x lebar 51.5cm\r\nXL: Panjang 74cm x lebar 53 cm'),
('BR006', 'KEMEJA PRIA MENS POLOSAN LENGAN PANJANG COOLMAN', 'PK004', 33000, 300, 'lengan3.jpeg', 'SIZE STANDAR INDONESIA🇮🇩\r\nBahan : Catton Signature Original, Halus lembut adem dan nyaman'),
('BR007', 'JAKET PRIA OVERSIZE  ZIPPER HOODIE BREAK  JAKET BAHAN FLECE TEBAL GAYA JAPANESE', 'PK003', 51000, 399, 'jaket.jpeg', '-Sweater /Jaket dengan bahan 100% Fleece yang nyaman. Bersiluet santai.\r\n- Terdapat rib pada pergelangan untuk memudahkan menggulung lengan.\r\n- Sweater / Jaket   serbaguna yang cocok untuk gaya apapun.\r\n- Bahannya memiliki kelembutan yang pas untuk dikenakan dalam berbagai suhu.\r\n- Sweater Uniseks bergaya korean yang lembut, dari bahan fleece gramasi 240 yang sejuk.\r\n- Desain bergaya streetstyle.\r\n\r\n\r\nSweater / jaket yang cocok untuk sista and agan yang selalu mengikuti trend kekinian dan juga fashionable\r\nkarna bahan lembut juga tidak mudah kusut tentunya menambah kesan rapih 😍\r\n‌hissss jangan ragu ya sista karna Kemiripan barang 98% karna kita buat semirip  mungkin dengan gambar .jadi apa yang kaka liat itu yang akan kaka dapatkan. \r\nburuan di order sebelum stok kehabisan'),
('BR008', 'Jaket Cagoule Parasut Pria Nagoya', 'PK003', 135000, 111, 'jaket2.jpeg', 'Spesifikasi Produk\r\nBahan : Taslan\r\nPuring :  Billabong\r\nSablon : Polyflex\r\nMode : Cagoule\r\nSize Chart : \r\nL panjang 69cm lebar 52cm lengan 66cm\r\nXL panjang 71 cm lebar 56cm lengan 68cm\r\n\r\nCara Pencucian\r\n1. Siapkan bak berukuran besar, dan kemudian rendam jaket.\r\n2. Sebaiknya kamu juga menggunakan deterjen cair daripada deterjen bubuk.\r\n3. Jika Anda ingin menghilangkan noda menempel, ambil sikat gigi lalu gosok perlahan.\r\n3. Angkat jaket taslan dan peras secara perlahan.\r\n4. Lalu jemur jaket diusahakan untuk tidak terkena langsung sinar matahari.\r\n5. Ketika setrika jaket gunakan panas low atau medium.'),
('BR009', 'JAKET BOMBER PRIA', 'PK003', 104000, 499, 'jaket3.jpeg', 'ELEGANT BOMBER Merupakan Model Jaket Pria Masa kini ,Desing Simple dan Modist TeTap Elegant dan Nyaman di Gunakan sehari hari.Menggunakan Bahan Luar BABY KAMPAS BAGIAN DALAM KAOS YG LEMBUT TIDAK BIKIN GERAH Yg relatip Tebal Dan Tahan Angin.sangat cocok Buat di gunakan sehari hari  Berkendara buat Pelindung diri dari masuk Angin..Tunggu APalagi Buruan beli sekarang keburu kehabisan..'),
('BR010', 'CELANA CARGO PANJANG PALING KEREN MURAH MERIAH', 'PK005', 65000, 0, 'celana.jpeg', 'bahan : tebal, halus, tidak kaku, dan tidak luntur saat di cuci \r\nmodel : fashion stndar slimfit\r\njahitan rapih dan pola normal, sesuai deskripsi\r\nsize : 27-33\r\n\r\nukuran BB   L/pinggang      L/paha      L/kaki\r\n27 :       35     74 cm             27 cm        17 cm         \r\n28 :       40     76 cm             27 cm        17 cm         \r\n29 :       45     78 cm             28 cm        18 cm         \r\n30 :       50     80 cm             28 cm        18 cm         \r\n31 :       55     82 cm             29 cm        19 cm         \r\n32 :       60     84 cm             30 cm        19 cm         \r\n33 :       65     86 cm             30 cm        20 cm');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_keranjang`
--

CREATE TABLE `tbl_keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `tgl_pesanan` date NOT NULL,
  `id_user` int(20) NOT NULL,
  `id_barang` varchar(200) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_ukuran` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `pembayaran` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_keranjang`
--

INSERT INTO `tbl_keranjang` (`id_keranjang`, `tgl_pesanan`, `id_user`, `id_barang`, `jumlah`, `id_ukuran`, `status`, `pembayaran`) VALUES
(34, '2024-03-02', 2, 'BR001', 2, 'UK002', 'Selesai', 'TR001'),
(47, '2024-03-02', 2, 'BR003', 1, 'UK003', 'Selesai', 'TR002'),
(49, '2024-03-02', 2, 'BR007', 1, 'UK003', 'proses', 'TR003'),
(50, '2024-03-02', 2, 'BR009', 1, 'UK003', 'new', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pakaian`
--

CREATE TABLE `tbl_pakaian` (
  `id_pakaian` varchar(20) NOT NULL,
  `nama_jenis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_pakaian`
--

INSERT INTO `tbl_pakaian` (`id_pakaian`, `nama_jenis`) VALUES
('PK001', 'Kaos'),
('PK002', 'Hoodie'),
('PK003', 'Jaket'),
('PK004', 'Lengan Panjang'),
('PK005', 'Celana Panjang'),
('PK006', 'Celana Pendek');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` int(20) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `total_bayar` varchar(20) NOT NULL,
  `pembayaran` varchar(20) NOT NULL,
  `file_bayar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `id_user`, `total_bayar`, `pembayaran`, `file_bayar`) VALUES
(10, 2, '164998', 'TR001', 'tfbri.jpeg'),
(57, 2, '49000', 'TR002', 'bayar2.jpeg'),
(58, 2, '51000', 'TR003', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ukuran`
--

CREATE TABLE `tbl_ukuran` (
  `id_ukuran` varchar(20) NOT NULL,
  `nama_ukuran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_ukuran`
--

INSERT INTO `tbl_ukuran` (`id_ukuran`, `nama_ukuran`) VALUES
('UK001', 'S'),
('UK002', 'M'),
('UK003', 'L'),
('UK004', 'XL'),
('UK005', 'XXL');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'khozinkz', 'khozinkz48@yahoo.com', NULL, '$2y$10$p3GIuJuAiFFUwEBrxHxxL.69tSXlKqPF1A.HpqE05e1PZfqV64g4y', NULL, '2023-12-25 21:10:34', '2023-12-25 21:10:34'),
(2, 'Khozin Khoirul Zaki', 'khozinkz49@gmail.com', NULL, '$2y$10$HinVDPz2MmzPqWa4eKHUc.YCT8NYnWYx0kq1FNZnNZFmAHxJPB3TO', NULL, '2024-02-29 21:50:29', '2024-02-29 21:50:29');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `berandas`
--
ALTER TABLE `berandas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detailukuran`
--
ALTER TABLE `detailukuran`
  ADD PRIMARY KEY (`id_detail_ukuran`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indeks untuk tabel `tbl_pakaian`
--
ALTER TABLE `tbl_pakaian`
  ADD PRIMARY KEY (`id_pakaian`);

--
-- Indeks untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `tbl_ukuran`
--
ALTER TABLE `tbl_ukuran`
  ADD PRIMARY KEY (`id_ukuran`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `berandas`
--
ALTER TABLE `berandas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detailukuran`
--
ALTER TABLE `detailukuran`
  MODIFY `id_detail_ukuran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaksi` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
