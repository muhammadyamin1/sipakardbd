<?php
session_start();
if (isset($_SESSION['nama']) && isset($_SESSION['role'])) {
  $idUserAktif = $_SESSION['idUser'];
  $nama = $_SESSION['nama'];
} else {
  header("Location: index.php?pesan=belum-login");
  exit();
}

// Set the default timezone to UTC+7
date_default_timezone_set('Asia/Jakarta');
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 * @group header
 * @group footer
 * @group page
 * @group pdf
 */

// Include the main TCPDF library (search for installation path).
require_once('laporan/TCPDF/tcpdf_include.php');
include 'dbKoneksi.php';

// Fungsi untuk mengambil data diagnosis berdasarkan ID
function getDataDiagnosis($idDiagnosis)
{
  global $conn;
  $sql = "SELECT * FROM tb_diagnosis WHERE idDiagnosis = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $idDiagnosis);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $stmt->close();
  return $row;
}

// Ambil ID diagnosis dari parameter GET
$idDiagnosis = $_GET['idDiagnosis'];

// Ambil data diagnosis berdasarkan ID
$diagnosis = getDataDiagnosis($idDiagnosis);

if (!$diagnosis) {
  die('ID diagnosis tidak valid atau tidak ditemukan.');
}

$gejalaTerpilih = explode(',', $diagnosis['gejalaTerpilih']);

class MYPDF extends TCPDF
{
  // Load data
  public function Footer()
  {
    // Position at 15 mm from bottom
    $this->SetY(-15);
    // Set font
    $this->SetFont('helvetica', 'I', 8);
    // Page number and printed by information
    $printedBy = $_SESSION['nama'];
    $currentDateTime = date('d-m-Y H:i:s'); // Tanggal dan waktu saat ini
    // Page number and printed by information
    $this->Cell(0, 10, 'Halaman '.$this->getAliasNumPage().' dari '.$this->getAliasNbPages().' | Dicetak oleh: ' . $printedBy . ' | Waktu cetak: ' . $currentDateTime, 0, false, 'C', 0, '', 0, false, 'T', 'M');
  }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Muhammad Yamin');
$pdf->setTitle('Laporan Diagnosis DBD');
$pdf->setSubject('Laporan Diagnosis Riwayat Penyakit DBD');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
  require_once(dirname(__FILE__) . '/lang/eng.php');
  $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->setFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

$html = <<<EOD
<h4 style="text-align: center;">Laporan Diagnosis Pasien</h4>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// Tambahkan teks ke halaman PDF
$pdf->SetFont('helvetica', '', 12);

// Tambahkan informasi dari data diagnosis ke PDF
$pdf->Ln();
$pdf->Cell(0, 10, '1. Nama Pasien: ' . $diagnosis['namaPasien'], 0, 1);
$pdf->Cell(0, 10, '2. Umur: ' . $diagnosis['umur'] . ' Tahun', 0, 1);

$pdf->Cell(0, 10, '3. Gejala Terpilih: ', 0, 1);

foreach ($gejalaTerpilih as $gejala) {
  $pdf->Cell(10, 5, '#', 0, 0, 'C', false);
  $pdf->Cell(0, 5, $gejala, 0, 1);
}

$pdf->Cell(0, 20, 'Kategori Penyakit: ', 0, 1);
$pdf->SetFont('helvetica', '', 12);
$pdf->MultiCell(0, 10, $diagnosis['penyakit'], 0, 1);
$pdf->SetFont('helvetica', 'I', 10);
$pdf->Cell(0, 9, 'Tanggal Diagnosis: ' . date('d-m-Y', strtotime($diagnosis['tanggal'])), 0, 1); // Tanggal dalam format dd-mm-yyyy

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('Laporan Diagnosis DBD ' . $diagnosis['namaPasien'] . '.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+