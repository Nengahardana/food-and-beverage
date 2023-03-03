<?php
include "koneksi.php";
require('fpdf185/fpdf.php');


$sql = $koneksi->query("SELECT pemesanan.*,user.nama_lengkap
                  FROM pemesanan
                  LEFT JOIN user ON  pemesanan.id_user =user.id_user ")->fetch_all(MYSQLI_ASSOC);

//Inisiasi untuk membuat header kolom

$column_no = "";
$column_tanggal_pemesanan = "";
$column_total_belanja = "";
$column_nama_lengkap  = "";


//For each row, add the field to the corresponding column
$x = 1;
foreach ($sql as $row) {


    $tanggal_pemesanan = $row["tanggal_pemesanan"];
    $total_belanja = $row["total_belanja"];
    $nama_lengkap = $row["nama_lengkap"];


    $column_no = $column_no . $x . "\n";
    $column_tanggal_pemesanan = $column_tanggal_pemesanan . $tanggal_pemesanan . "\n";
    $column_total_belanja = $column_total_belanja . $total_belanja . "\n";
    $column_nama_lengkap = $column_nama_lengkap . $nama_lengkap . "\n";

    $x++;
}
//Create a new PDF file
$pdf = new FPDF('P', 'mm', array(297, 210)); //L For Landscape / P For Portrait
$pdf->AddPage();

//Menambahkan Gambar
// $pdf->Image('picture/logo.jpg',10,10,-175);
// $pdf->Cell(10);
// $pdf->Image("gambar/pdam.png", 10, 10 , 20 , 20);
// $pdf->Cell(170);
// $pdf->Image("gambar/sgs.jpg", 180, 10 , 20 , 20);
// $pdf->Ln();

//judul
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(80);
$pdf->Cell(30, 5, 'APLIKASI LAPORAN', 0, 0, 'C');
$pdf->Ln();
$pdf->Cell(80);
$pdf->Cell(30, 5, 'PROVINSI KALIMANTAN SELATAN', 0, 0, 'C');
$pdf->Ln();

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(80);
$pdf->Cell(30, 5, 'Jl. Achmad Yani Km. 6 No.9, pemurus dalam, kec Banjarmasin selatan 70238', 0, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(80);
$pdf->Cell(30, 5, 'Telp. 085116783999', 0, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(80);
$pdf->Cell(30, 5, 'Website : zhmhotels.com e-mail : zuriexpresbjm.com', 0, 0, 'C');

$pdf->Line(10, 36, 200, 36);
$pdf->Ln();

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(80);
$pdf->Cell(30, 10, 'LAPORAN PENDAPATAN PERKAMAR', 0, 0, 'C');
$pdf->Ln();


//tabel
//Fields Name position
$Y_Fields_Name_position = 45;

//header
//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(191);
//Bold Font for Field Name
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetY($Y_Fields_Name_position);

$pdf->SetX(10);
$pdf->Cell(10, 8, 'No', 1, 0, 'C', 1);

$pdf->SetX(20);
$pdf->Cell(60, 8, 'Nomor Kamar', 1, 0, 'C', 1);

$pdf->SetX(80);
$pdf->Cell(50, 8, 'Total Belanja', 1, 0, 'C', 1);

$pdf->SetX(130);
$pdf->Cell(50, 8, 'Tanggal Pemesanan', 1, 0, 'C', 1);





$pdf->Ln();

//isi
//Table position, under Fields Name
$Y_Table_Position = 53;

//Now show the columns
$pdf->SetFont('Arial', '', 10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(10);
$pdf->MultiCell(10, 6, $column_no, 1, 'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(20);
$pdf->MultiCell(60, 6, $column_nama_lengkap, 1, 'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(80);
$pdf->MultiCell(50, 6, $column_total_belanja, 1, 'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(130);
$pdf->MultiCell(50, 6, $column_tanggal_pemesanan, 1, 'L');







$pdf->Output();
