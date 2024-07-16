-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jul 2024 pada 03.46
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
  `penyakit` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_diagnosis`
--

INSERT INTO `tb_diagnosis` (`idDiagnosis`, `namaPasien`, `umur`, `gejalaTerpilih`, `penyakit`, `tanggal`) VALUES
(12, 'Hariski Ramadhan', 21, 'G1 - Demam naik turun,G2 - Mual,G4 - Bintik-bintik merah,G7 - Nyeri sendi,G9 - Nafsu makan hilang', 'Dengue Fever - Dengue Fever adalah penyakit virus yang ditularkan oleh nyamuk Aedes aegypti dan Aedes albopictus. Penyakit ini ditandai dengan demam tinggi mendadak, nyeri otot dan sendi, ruam kulit, kadang disertai dengan mual dan nafsu makan yang menurun. Gejala biasanya muncul 4-10 hari setelah gigitan nyamuk yang terinfeksi dan berlangsung selama 2-7 hari. Dengue Fever biasanya tidak menyebabkan perdarahan serius. Beberapa hal yang dapat dilakukan: Istirahat Cukup, Minum banyak cairan seperti air, jus buah, atau oralit untuk mencegah dehidrasi, Konsumsi obat penurun demam dan penghilang rasa sakit seperti paracetamol (hindari aspirin atau ibuprofen karena dapat meningkatkan risiko perdarahan), Pantau gejala dengan cermat jika gejala memburuk atau muncul tanda-tanda peringatan seperti muntah terus-menerus, sakit perut parah, pendarahan, atau kelelahan ekstrem. Karena hal tersebut dapat megindikasikan perubahan kategori penyakit menjadi Dengue Hemorrhagic Fever.', '2024-07-15'),
(14, 'Rika', 16, 'G1 - Demam naik turun,G2 - Mual,G4 - Bintik-bintik merah,G7 - Nyeri sendi,G9 - Nafsu makan hilang', 'Dengue Fever - Dengue Fever adalah penyakit virus yang ditularkan oleh nyamuk Aedes aegypti dan Aedes albopictus. Penyakit ini ditandai dengan demam tinggi mendadak, nyeri otot dan sendi, ruam kulit, kadang disertai dengan mual dan nafsu makan yang menurun. Gejala biasanya muncul 4-10 hari setelah gigitan nyamuk yang terinfeksi dan berlangsung selama 2-7 hari. Dengue Fever biasanya tidak menyebabkan perdarahan serius. Beberapa hal yang dapat dilakukan: Istirahat Cukup, Minum banyak cairan seperti air, jus buah, atau oralit untuk mencegah dehidrasi, Konsumsi obat penurun demam dan penghilang rasa sakit seperti paracetamol (hindari aspirin atau ibuprofen karena dapat meningkatkan risiko perdarahan), Pantau gejala dengan cermat jika gejala memburuk atau muncul tanda-tanda peringatan seperti muntah terus-menerus, sakit perut parah, pendarahan, atau kelelahan ekstrem. Karena hal tersebut dapat megindikasikan perubahan kategori penyakit menjadi Dengue Hemorrhagic Fever.', '2024-07-15'),
(16, 'Budi Santoso', 14, 'G1 - Demam naik turun,G2 - Mual,G3 - Muntah,G5 - Perut kembung,G7 - Nyeri sendi,G8 - Lemas,G9 - Nafsu makan hilang,G13 - Penurunan trombosit,G14 - Hematokrit meningkat,G15 - Leukosit turun,G16 - Nyeri ulu hati', 'Dengue Hemorrhagic Fever (DHF) Grade 1 - DHF Grade 1 adalah tahap awal dari Demam Berdarah Dengue yang ditandai dengan demam tinggi dan manifestasi perdarahan ringan seperti bintik-bintik merah pada kulit (petechiae) atau hasil tes rumple leed yang positif. Pada tahap ini, trombosit mulai menurun tetapi masih dalam batas yang tidak terlalu kritis. Beberapa hal yang dapat dilakukan: Istirahat yang cukup dan minum banyak cairan untuk mendukung proses pemulihan, Hindari aktivitas fisik berat dan perhatikan tanda-tanda perdarahan atau gejala yang memburuk.', '2024-07-16'),
(17, 'Tuti Nurafni', 16, 'G1 - Demam naik turun,G2 - Mual,G4 - Bintik-bintik merah,G7 - Nyeri sendi,G9 - Nafsu makan hilang', 'Dengue Fever - Dengue Fever adalah penyakit virus yang ditularkan oleh nyamuk Aedes aegypti dan Aedes albopictus. Penyakit ini ditandai dengan demam tinggi mendadak, nyeri otot dan sendi, ruam kulit, kadang disertai dengan mual dan nafsu makan yang menurun. Gejala biasanya muncul 4-10 hari setelah gigitan nyamuk yang terinfeksi dan berlangsung selama 2-7 hari. Dengue Fever biasanya tidak menyebabkan perdarahan serius. Beberapa hal yang dapat dilakukan: Istirahat Cukup, Minum banyak cairan seperti air, jus buah, atau oralit untuk mencegah dehidrasi, Konsumsi obat penurun demam dan penghilang rasa sakit seperti paracetamol (hindari aspirin atau ibuprofen karena dapat meningkatkan risiko perdarahan), Pantau gejala dengan cermat jika gejala memburuk atau muncul tanda-tanda peringatan seperti muntah terus-menerus, sakit perut parah, pendarahan, atau kelelahan ekstrem. Karena hal tersebut dapat megindikasikan perubahan kategori penyakit menjadi Dengue Hemorrhagic Fever.', '2024-07-16');

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
('G1', 'Demam naik turun', 'Suhu tubuh yang meningkat secara tiba-tiba hingga mencapai sekitar 39-40° Celsius atau lebih tinggi dan berulang, diikuti dengan penurunan suhu yang juga berulang secara periodik.'),
('G10', 'Penurunan tekanan darah', 'Tekanan darah berada di bawah nilai normalnya. Normalnya, tekanan darah diukur dengan dua angka: tekanan sistolik (tekanan saat jantung berkontraksi) dan tekanan diastolik (tekanan saat jantung beristirahat antara detak jantung). Penurunan tekanan darah pada DBD biasanya mengarah pada nilai tekanan sistolik di bawah 90 mmHg atau tekanan diastolik di bawah 60 mmHg.'),
('G11', 'Pendarahan saluran cerna', 'Keluarnya darah dari saluran pencernaan, biasanya berupa tinja berwarna gelap.'),
('G12', 'Sulit bernapas', 'Kesulitan untuk mengambil napas dengan normal.'),
('G13', 'Penurunan trombosit', 'Jumlah trombosit dalam darah lebih rendah dari normal. Pada kasus DBD, penurunan trombosit sering kali menyebabkan jumlah trombosit turun di bawah 150.000 per mikroliter darah.'),
('G14', 'Hematokrit meningkat', 'Hematokrit adalah persentase volume darah yang diisi dengan sel darah merah. Normalnya, hematokrit dalam darah manusia berada dalam rentang sekitar 40-50% untuk pria dan 35-45% untuk wanita. Peningkatan hematokrit dapat terjadi sebagai respons terhadap dehidrasi atau kondisi di mana jumlah sel darah merah dalam perbandingan dengan volume plasma darah meningkat.'),
('G15', 'Leukosit turun', ' Jumlah sel darah putih dalam darah lebih rendah dari normal. Jumlah leukosit dalam darah manusia berkisar antara 4.000 hingga 11.000 sel per mikroliter darah. Dalam konteks DBD, leukosit turun merupakan indikasi bahwa sistem kekebalan tubuh mungkin terganggu atau tidak berfungsi dengan optimal, yang dapat mempengaruhi kemampuan tubuh untuk melawan infeksi, termasuk infeksi yang dapat terjadi selama penyakit ini.'),
('G16', 'Nyeri ulu hati', 'Rasa sakit atau tidak nyaman di daerah atas perut.'),
('G17', 'Mencret', 'Tinja yang encer atau sering buang air besar.'),
('G18', 'Sakit kepala berat', 'Rasa sakit di kepala yang intens.'),
('G2', 'Mual', 'Sensasi tidak nyaman di perut yang seringkali menyebabkan keinginan untuk muntah.'),
('G3', 'Muntah', 'Keluarnya isi lambung melalui mulut, yang sering kali disertai dengan perasaan tidak nyaman di perut atau tenggorokan. Muntah dapat terjadi berulang kali dalam rentang waktu tertentu, tergantung pada tingkat keparahan penyakit.'),
('G4', 'Bintik-bintik merah', 'Bercak kecil yang muncul pada kulit yang bisa menandakan pendarahan di bawah kulit.'),
('G5', 'Perut kembung', 'Perasaan penuh atau kembung di perut.'),
('G6', 'Mimisan', 'Keluarnya darah dari hidung.'),
('G7', 'Nyeri sendi', 'Rasa sakit atau tidak nyaman pada persendian.'),
('G8', 'Lemas', 'Tubuh terasa lemah atau tidak bertenaga.'),
('G9', 'Nafsu makan hilang', 'Hilangnya keinginan untuk makan.');

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
('P1', 'Dengue Fever', 'Dengue Fever adalah penyakit virus yang ditularkan oleh nyamuk Aedes aegypti dan Aedes albopictus. Penyakit ini ditandai dengan demam tinggi mendadak, nyeri otot dan sendi, ruam kulit, kadang disertai dengan mual dan nafsu makan yang menurun. Gejala biasanya muncul 4-10 hari setelah gigitan nyamuk yang terinfeksi dan berlangsung selama 2-7 hari. Dengue Fever biasanya tidak menyebabkan perdarahan serius. Beberapa hal yang dapat dilakukan: Istirahat Cukup, Minum banyak cairan seperti air, jus buah, atau oralit untuk mencegah dehidrasi, Konsumsi obat penurun demam dan penghilang rasa sakit seperti paracetamol (hindari aspirin atau ibuprofen karena dapat meningkatkan risiko perdarahan), Pantau gejala dengan cermat jika gejala memburuk atau muncul tanda-tanda peringatan seperti muntah terus-menerus, sakit perut parah, pendarahan, atau kelelahan ekstrem. Karena hal tersebut dapat megindikasikan perubahan kategori penyakit menjadi Dengue Hemorrhagic Fever.'),
('P2', 'Dengue Hemorrhagic Fever (DHF) Grade 1', 'DHF Grade 1 adalah tahap awal dari Demam Berdarah Dengue yang ditandai dengan demam tinggi dan manifestasi perdarahan ringan seperti bintik-bintik merah pada kulit (petechiae) atau hasil tes rumple leed yang positif. Pada tahap ini, trombosit mulai menurun tetapi masih dalam batas yang tidak terlalu kritis. Beberapa hal yang dapat dilakukan: Istirahat yang cukup dan minum banyak cairan untuk mendukung proses pemulihan, Hindari aktivitas fisik berat dan perhatikan tanda-tanda perdarahan atau gejala yang memburuk.'),
('P3', 'Dengue Hemorrhagic Fever (DHF) Grade 2', 'DHF Grade 2 ditandai dengan semua gejala DHF Grade 1 ditambah dengan perdarahan spontan dari hidung atau gusi. Trombosit turun lebih signifikan, dan pasien mulai menunjukkan tanda-tanda kebocoran plasma seperti penumpukan cairan di rongga tubuh. Beberapa hal yang dapat dilakukan: Pemberian cairan melalui infus untuk menjaga keseimbangan cairan tubuh, Pemantauan ketat terhadap jumlah trombosit, hematokrit, dan tanda-tanda kebocoran plasma, dan Penanganan Perdarahan untuk mengatasi dan mencegah perdarahan lebih lanjut.'),
('P4', 'Dengue Hemorrhagic Fever (DHF) Grade 3', 'DHF Grade 3 merupakan tahap yang lebih parah dengan semua gejala dari Grade 2 ditambah dengan tanda-tanda syok seperti kulit dingin dan lembab, nadi yang cepat dan lemah, serta tekanan darah yang tidak stabil. Pasien pada tahap ini memerlukan perawatan medis intensif segera untuk mencegah komplikasi yang lebih serius. Hal yang dapat dilakukan: Perawatan Intensif, Pemberian cairan intravena dengan kontrol ketat untuk mengatasi syok dan kebocoran plasma, Transfusi darah atau produk darah mungkin diperlukan jika terjadi perdarahan berat, Penanganan segera terhadap komplikasi seperti gagal organ atau syok untuk mencegah kondisi yang lebih buruk.');

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
('R1', 'G1,G2,G4,G7,G9', 'P1'),
('R2', 'G1,G2,G3,G5,G7,G8,G9,G13,G14,G15,G16', 'P2'),
('R3', 'G1,G2,G3,G4,G6,G7,G8,G9,G13,G14,G15,G16', 'P3'),
('R4', 'G1,G2,G3,G4,G6,G7,G8,G9,G10,G11,G12,G13,G14,G15,G16,G17,G18', 'P4');

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
(18, 'Riski Tanjung', 'riski123@gmail.com', '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', 'user'),
(20, 'Aldi', 'aldi123@gmail.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin'),
(30, 'Dedi', 'dedi@gmail.com', '6a06e799110e15fe788ddc4dc62967d5e01a8acb8266ba24d8b13148664c4139', 'user');

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
  MODIFY `idDiagnosis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
