<?php
include "koneksi.php";
require('fpdf185/fpdf.php');

$id = $_GET['id'];
$sql = $koneksi->query("SELECT pemesanan_produk.*,produk.nama_menu,produk.harga
                  FROM pemesanan_produk
                  LEFT JOIN produk ON  pemesanan_produk.id_menu =produk.id_menu where pemesanan_produk.id_pemesanan=$id")->fetch_all(MYSQLI_ASSOC);

//Inisiasi untuk membuat header kolom

$column_no = "";
$column_id_pemesanan = "";
$column_nama_menu = "";
$column_harga  = "";
$column_jumlah  = "";
$column_sub_harga  = "";


//For each row, add the field to the corresponding column
$x = 1;
$total_harga = 0;
foreach ($sql as $row) {


    $id_pemesanan = $row["id_pemesanan"];
    $nama_menu = $row["nama_menu"];
    $harga = $row["harga"];
    $jumlah = $row["jumlah"];
    $sub_harga = $row["harga"] * $jumlah;
    $total_harga += $sub_harga;

    $column_no = $column_no . $x . "\n";
    $column_id_pemesanan = $column_id_pemesanan . $id_pemesanan . "\n";
    $column_nama_menu = $column_nama_menu . $nama_menu . "\n";
    $column_harga = $column_harga . $harga . "\n";
    $column_jumlah = $column_jumlah . $jumlah . "\n";
    $column_sub_harga = $column_sub_harga . $sub_harga . "\n";

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
$pdf->Cell(30, 10, 'TRANSAKSI ', 0, 0, 'C');
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
$pdf->Cell(60, 8, 'Nama Pesanan', 1, 0, 'C', 1);

$pdf->SetX(80);
$pdf->Cell(30, 8, 'Haga Satuan', 1, 0, 'C', 1);

$pdf->SetX(110);
$pdf->Cell(40, 8, 'Jumlah Pemesanan', 1, 0, 'C', 1);

$pdf->SetX(150);
$pdf->Cell(50, 8, 'Total Harga Pemesanan', 1, 0, 'C', 1);






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
$pdf->MultiCell(60, 6, $column_nama_menu, 1, 'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(80);
$pdf->MultiCell(30, 6, $column_harga, 1, 'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(110);
$pdf->MultiCell(40, 6, $column_jumlah, 1, 'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(150);
$pdf->MultiCell(50, 6, $column_sub_harga, 1, 'L');

$pdf->SetX(150);
$pdf->Cell(50, 8, number_format($total_harga), 1, 0, 'L', 1);







$pdf->Output();
