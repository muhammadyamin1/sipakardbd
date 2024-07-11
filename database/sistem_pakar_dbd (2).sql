-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jul 2024 pada 19.34
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_pakar_dbd`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_diagnosis`
--

CREATE TABLE `tb_diagnosis` (
  `idDiagnosis` int(11) NOT NULL,
  `namaPasien` varchar(100) NOT NULL,
  `umur` int(3) NOT NULL,
  `gejalaTerpilih` text NOT NULL,
  `penyakit` varchar(255) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gejala`
--

CREATE TABLE `tb_gejala` (
  `idGejala` varchar(5) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_gejala`
--

INSERT INTO `tb_gejala` (`idGejala`, `nama`, `deskripsi`) VALUES
('G1', 'Demam naik turun', '-'),
('G10', 'Penurunan tekanan darah', '-'),
('G11', 'Pendarahan saluran cerna', '-'),
('G12', 'Sulit bernapas', '-'),
('G13', 'Penurunan trombosit', '-'),
('G14', 'Hematokrit meningkat', '-'),
('G15', 'Leukosit turun', '-'),
('G16', 'Nyeri ulu hati', '-'),
('G17', 'Mencret', '-'),
('G18', 'Sakit kepala berat', '-'),
('G2', 'Mual', '-'),
('G3', 'Muntah', '-'),
('G4', 'Bintik-bintik merah', '-'),
('G5', 'Perut kembung', '-'),
('G6', 'Mimisan', '-'),
('G7', 'Nyeri sendi', '-'),
('G8', 'Lemas', '-'),
('G9', 'Nafsu makan hilang', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penyakit`
--

CREATE TABLE `tb_penyakit` (
  `idPenyakit` varchar(5) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_penyakit`
--

INSERT INTO `tb_penyakit` (`idPenyakit`, `nama`, `deskripsi`) VALUES
('P1', 'Dengue Fever', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rule`
--

CREATE TABLE `tb_rule` (
  `idRule` varchar(8) NOT NULL,
  `gejalaTerpilih` text NOT NULL,
  `idPenyakit` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_rule`
--

INSERT INTO `tb_rule` (`idRule`, `gejalaTerpilih`, `idPenyakit`) VALUES
('R1', 'A', 'P1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `idUser` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`idUser`, `nama`, `email`, `password`, `role`) VALUES
(14, 'M. Yamin', 'muhammadyamin1081@gmail.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin'),
(18, 'Riski Tanjung', 'riski123@gmail.com', '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', 'admin'),
(20, 'Aldi', 'aldi123@gmail.com', '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_diagnosis`
--
ALTER TABLE `tb_diagnosis`
  ADD PRIMARY KEY (`idDiagnosis`);

--
-- Indeks untuk tabel `tb_gejala`
--
ALTER TABLE `tb_gejala`
  ADD PRIMARY KEY (`idGejala`);

--
-- Indeks untuk tabel `tb_penyakit`
--
ALTER TABLE `tb_penyakit`
  ADD PRIMARY KEY (`idPenyakit`);

--
-- Indeks untuk tabel `tb_rule`
--
ALTER TABLE `tb_rule`
  ADD PRIMARY KEY (`idRule`),
  ADD KEY `idPenyakit` (`idPenyakit`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_diagnosis`
--
ALTER TABLE `tb_diagnosis`
  MODIFY `idDiagnosis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_rule`
--
ALTER TABLE `tb_rule`
  ADD CONSTRAINT `tb_rule_ibfk_1` FOREIGN KEY (`idPenyakit`) REFERENCES `tb_penyakit` (`idPenyakit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
