-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Mar 2023 pada 10.18
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpemesanan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(50) NOT NULL,
  `tanggal_pemesanan` date NOT NULL,
  `total_belanja` int(50) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan_produk`
--

CREATE TABLE `pemesanan_produk` (
  `id_pemesanan_produk` int(50) NOT NULL,
  `id_pemesanan` int(50) NOT NULL,
  `id_menu` varchar(50) NOT NULL,
  `jumlah` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemesanan_produk`
--

INSERT INTO `pemesanan_produk` (`id_pemesanan_produk`, `id_pemesanan`, `id_menu`, `jumlah`) VALUES
(62, 63, '8', 1),
(63, 64, '8', 1),
(64, 64, '7', 1),
(65, 65, '7', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_menu` int(50) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `jenis_menu` varchar(50) NOT NULL,
  `stok` int(50) NOT NULL,
  `harga` int(50) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_menu`, `nama_menu`, `jenis_menu`, `stok`, `harga`, `gambar`) VALUES
(6, 'Bakso Urat', 'Makanan', -1, 12000, 'bakso.jpeg'),
(7, 'Mie Ayam', 'Makanan', -1, 13000, 'mieayam.jpg'),
(8, 'Mie Ayam Bakso', 'Makanan', -1, 17000, 'mieayambakso.jpg'),
(9, 'Ayam Bakar', 'Makanan', -1, 20000, 'ayambakar.jpg'),
(10, 'Lele Bakar', 'Makanan', -1, 12000, 'lele.jpg'),
(11, 'Nasi Goreng', 'Makanan', -1, 10000, 'nasgor.jpg'),
(12, 'Nasi Putih', 'Makanan', -1, 2000, 'nasi.jpeg'),
(13, 'Es Jeruk', 'minuman', -1, 8000, 'esjeruk.jpg'),
(14, 'Jus Alpukat', 'Minuman', -1, 10000, 'juspukat.jpg'),
(16, 'Teh Obeng', 'Minuman', -1, 5000, 'tehobeng.jpg'),
(17, 'Air Mineral', 'Minuman', -1, 4000, 'sanford.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `nama_lengkap` varchar(25) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(25) NOT NULL,
  `hp` varchar(25) NOT NULL,
  `status` enum('admin','user','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_lengkap`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `hp`, `status`) VALUES
(1, '301', '301', '301', 'Laki-Laki', '2023-01-14', 'banjarmasin', '089560328673', 'user'),
(2, '501', '501', '501', 'Laki-Laki', '2023-01-11', 'banjarmasin', '085233748222', 'user'),
(3, 'admin', 'admin', 'nengah ardana yasa', 'Laki-Laki', '1999-12-23', 'Way Kanan', '085600998811', 'admin'),
(4, '601', '601', '601', 'Laki-Laki', '2023-01-22', 'banjarmasin', '089560328673', 'user'),
(5, '701', '701', '701', 'Laki-Laki', '2023-01-02', 'banjarmasin', '085700998867', 'user'),
(6, '506', '506', '506', 'Laki-Laki', '2023-01-14', 'banjarmasin', '0853413213', 'user'),
(7, 'nengah', 'nengah', 'nengah ardana', 'Laki-Laki', '2023-01-04', 'banjit', '123456', 'admin'),
(8, '801', '801', '801', 'permpuan', '2023-01-01', 'banjarmasin', '085312122312', 'user'),
(9, '302', '302', 'rqetgaw', 'Laki-Laki', '0000-00-00', '426', '67890', 'admin'),
(10, '901', '901', 'gshhhhj', 'Perempuan', '6775-05-31', '75486', '957068', 'user'),
(11, '302', '302', 'sgsfhy', 'Laki-Laki', '0000-00-00', 'banjar', '36578', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indeks untuk tabel `pemesanan_produk`
--
ALTER TABLE `pemesanan_produk`
  ADD PRIMARY KEY (`id_pemesanan_produk`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT untuk tabel `pemesanan_produk`
--
ALTER TABLE `pemesanan_produk`
  MODIFY `id_pemesanan_produk` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_menu` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
