-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 12:46 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `suratpbf`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokumen`
--

CREATE TABLE `dokumen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event` varchar(191) NOT NULL,
  `nama_dokumen` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokumen`
--

INSERT INTO `dokumen` (`id`, `event`, `nama_dokumen`, `created_at`, `updated_at`, `user_id`) VALUES
(7, 'hackhaton', '1719017243_ERD Reslab_Kelompok 2.pdf', '2024-06-21 17:47:23', '2024-06-21 17:47:23', 1),
(8, 'isce', '1719122274_asdsda_10_isce.docx', '2024-06-22 22:57:54', '2024-06-22 22:57:54', 9),
(9, 'isce', '1719122916_asdsda_1_isce.docx', '2024-06-22 23:08:36', '2024-06-22 23:08:36', 9),
(10, 'dsasd', '1719123380_4_HMSI_dsasd.docx', '2024-06-22 23:16:20', '2024-06-22 23:16:20', 1),
(11, 'asdas', '1719124113_ss_HMSI_asdas.docx', '2024-06-22 23:28:33', '2024-06-22 23:28:33', 1),
(12, 'isce', '1719210799_ad_HMSI_isce.docx', '2024-06-23 23:33:19', '2024-06-23 23:33:19', 1),
(13, 'asdaddwdw', '1719213212_bhjbhj_Himpunan_Mahasiswa_Teknik_Komputer_asdaddwdw.docx', '2024-06-24 00:13:32', '2024-06-24 00:13:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `instansis`
--

CREATE TABLE `instansis` (
  `id` int(10) UNSIGNED NOT NULL,
  `alamat` varchar(191) NOT NULL,
  `file` varchar(191) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instansis`
--

INSERT INTO `instansis` (`id`, `alamat`, `file`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'asdas', 'uploads/logo/17178192261630461083061.jpeg', 1, '2024-06-07 21:00:26', '2024-06-07 21:00:26'),
(2, 'sekretariat hmsi FTI Unand', 'uploads/logo/1719122171images.jpeg', 9, '2024-06-22 22:56:11', '2024-06-22 22:56:11');

-- --------------------------------------------------------

--
-- Table structure for table `jabatans`
--

CREATE TABLE `jabatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `nama_jabatan` varchar(191) NOT NULL,
  `nama` varchar(191) NOT NULL,
  `nim_nip` int(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatans`
--

INSERT INTO `jabatans` (`id`, `id_user`, `nama_jabatan`, `nama`, `nim_nip`, `created_at`, `updated_at`) VALUES
(2, 1, 'Pimpinan', 'prof mwkdnwkdnkw', 111, '2024-06-24 08:22:35', '2024-06-24 08:22:35'),
(3, 1, 'Ketua', 'amin', 123, '2024-06-24 08:24:28', '2024-06-24 08:45:00'),
(19, 1, 'Sekretaris', 'ruchil', 222, '2024-06-25 05:28:10', '2024-06-25 05:28:10');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) NOT NULL,
  `uraian` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `uraian`, `created_at`, `updated_at`) VALUES
(1, 'Undangan', 'Surat undangan dari organisasi lain', '2024-04-05 21:14:11', '2024-04-05 21:22:32'),
(2, 'Peminjaman', 'Peminjaman alat/barang', '2024-06-19 06:20:20', '2024-06-19 06:20:20'),
(3, 'surat peringatan', 'syurggygadn,smdn', '2024-06-24 00:11:24', '2024-06-24 00:11:24');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2020_01_12_102751_create_klasifikasi_table', 1),
(6, '2020_02_01_133812_tambah_field_userid', 1),
(8, '2020_02_03_030401_create_disposisi_table', 1),
(9, '2020_02_04_014420_tambah_foreign_key_constraint', 1),
(10, '2024_04_06_033814_kategori', 2),
(11, '2024_04_06_034019_created_kategori_table', 2),
(12, '2024_04_06_035652_create_kategori_table', 3),
(13, '2024_06_01_171909_create_dokumen_table', 4),
(14, '2020_02_01_150517_create_instansis_table', 5),
(15, '2024_06_07_143141_add_user_id_to_dokumen_table', 6),
(20, '2024_06_01_172143_create_suratmasuk_table', 7),
(21, '2024_06_01_172230_add_foreign_keys_to_suratmasuk_table', 7),
(22, '2024_06_01_173326_create_suratkeluar_table', 7),
(23, '2024_06_01_173536_add_foreign_keys_to_suratkeluar_table', 7),
(24, '2024_06_19_150248_create_suratkeluar_table', 8),
(25, '2024_06_19_150745_create_suratkeluar_table', 9),
(26, '2024_06_21_074930_rename_suratkeluar_to_transaksisurat', 10),
(27, '2024_06_24_081834_create_jabatans_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_surat`
--

CREATE TABLE `transaksi_surat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dokumen_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `kategori_id` int(10) UNSIGNED NOT NULL,
  `penerima` varchar(191) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `balasan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi_surat`
--

INSERT INTO `transaksi_surat` (`id`, `dokumen_id`, `user_id`, `kategori_id`, `penerima`, `keterangan`, `balasan`, `created_at`, `updated_at`) VALUES
(10, 7, 1, 1, '11', '-', 'okei', '2024-06-23 23:54:33', '2024-06-23 23:56:52'),
(11, 13, 1, 3, '12', '-', 'oke', '2024-06-24 00:14:11', '2024-06-24 00:15:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `namaorganisasi` varchar(200) NOT NULL,
  `jenisorganisasi` varchar(200) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `role` varchar(191) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `namaorganisasi`, `jenisorganisasi`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'BEMKM Unand', 'Bem KM Unand', 'BEM', 'admin@gmail.com', '$2y$10$tmFBV9A1jzfwEztkewdRVevslUlW3RK1sZo7koVM5H5tsiv6cg8ee', 'admin', 'U8K0vpqRpOWdbKv2rNZ8loTYeIKlkTQ7XR7zFwLcC3pamXSMIJgAGWGRVKWT', '2020-02-04 01:49:00', '2024-06-10 03:59:33'),
(9, 'insan', 'HMSI', 'HIMA', 'insan@gmail.com', '$2y$10$bCxxoHsrnPtksT5yR9zX5./177N4Flw3MMnTvOBdKc2WKSi78x6zy', 'user', NULL, '2024-04-03 19:31:02', '2024-04-03 19:31:02'),
(10, 'BemFTI', 'BEM FTI', 'BEM', 'bemftiii@gmail.com', '$2y$10$gMiOvJQ0ABKgwbjG0/Ufb.ZeMondHXQeEyoNEuYhap5hxOG50m9La', 'user', NULL, '2024-06-19 06:26:08', '2024-06-19 06:26:53'),
(11, 'hmti', 'Himpunan Mahasiswa Teknik Industri', 'HIMA', 'aanalamin987@gmail.com', '$2y$10$6tmZtpLMHPVVkLZnRQpceuuoTxYGh7mKCKUfVlM/3FSnRmIN3xkYO', 'user', NULL, '2024-06-23 23:50:28', '2024-06-23 23:53:22'),
(12, 'himatekom', 'Himpunan Mahasiswa Teknik Komputer', 'HIMA', 'aanalamin246@gmail.com', '$2y$10$XqV6cD8iHGwEiioXreq.Lu3KrC8/SRjVj.q9BdSy7XNdEVWxLldE.', 'user', NULL, '2024-06-24 00:08:22', '2024-06-24 00:08:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokumen_user_id_foreign` (`user_id`);

--
-- Indexes for table `instansis`
--
ALTER TABLE `instansis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instansis_user_id_foreign` (`user_id`);

--
-- Indexes for table `jabatans`
--
ALTER TABLE `jabatans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jabatans_id_user_foreign` (`id_user`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `transaksi_surat`
--
ALTER TABLE `transaksi_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suratkeluar_dokumen_id_foreign` (`dokumen_id`),
  ADD KEY `suratkeluar_user_id_foreign` (`user_id`),
  ADD KEY `suratkeluar_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `instansis`
--
ALTER TABLE `instansis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jabatans`
--
ALTER TABLE `jabatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `transaksi_surat`
--
ALTER TABLE `transaksi_surat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `dokumen_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `instansis`
--
ALTER TABLE `instansis`
  ADD CONSTRAINT `instansis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jabatans`
--
ALTER TABLE `jabatans`
  ADD CONSTRAINT `jabatans_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi_surat`
--
ALTER TABLE `transaksi_surat`
  ADD CONSTRAINT `suratkeluar_dokumen_id_foreign` FOREIGN KEY (`dokumen_id`) REFERENCES `dokumen` (`id`),
  ADD CONSTRAINT `suratkeluar_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`),
  ADD CONSTRAINT `suratkeluar_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
