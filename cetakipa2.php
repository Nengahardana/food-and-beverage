<?php
include "koneksi.php";
require('fpdf185/fpdf.php');


$sql = $koneksi->query("SELECT pemesanan_produk.*,produk.nama_menu,produk.harga
                  FROM pemesanan_produk
                  LEFT JOIN produk ON  pemesanan_produk.id_menu =produk.id_menu where jenis_menu='makanan'")->fetch_all(MYSQLI_ASSOC);


$sql2 = $koneksi->query("SELECT * from produk where jenis_menu='makanan'")->fetch_all(MYSQLI_ASSOC);


$cek_data1 = mysqli_query($koneksi, "SELECT pemesanan_produk.*,produk.nama_menu,produk.harga
                  FROM pemesanan_produk
                  LEFT JOIN produk ON  pemesanan_produk.id_menu =produk.id_menu where nama_menu='Bakso Urat'");

$cek_data2 = mysqli_query($koneksi, "SELECT pemesanan_produk.*,produk.nama_menu,produk.harga
                  FROM pemesanan_produk
                  LEFT JOIN produk ON  pemesanan_produk.id_menu =produk.id_menu where nama_menu='Mie Ayam'");

$cek_data3 = mysqli_query($koneksi, "SELECT pemesanan_produk.*,produk.nama_menu,produk.harga
                  FROM pemesanan_produk
                  LEFT JOIN produk ON  pemesanan_produk.id_menu =produk.id_menu where nama_menu='Mie Ayam Bakso'");
$cek_data4 = mysqli_query($koneksi, "SELECT pemesanan_produk.*,produk.nama_menu,produk.harga
                  FROM pemesanan_produk
                  LEFT JOIN produk ON  pemesanan_produk.id_menu =produk.id_menu where nama_menu='Ayam Bakar'");
$cek_data5 = mysqli_query($koneksi, "SELECT pemesanan_produk.*,produk.nama_menu,produk.harga
                  FROM pemesanan_produk
                  LEFT JOIN produk ON  pemesanan_produk.id_menu =produk.id_menu where nama_menu='Lele Bakar'");
$cek_data6 = mysqli_query($koneksi, "SELECT pemesanan_produk.*,produk.nama_menu,produk.harga
                  FROM pemesanan_produk
                  LEFT JOIN produk ON  pemesanan_produk.id_menu =produk.id_menu where nama_menu='Nasi Goreng'");
$cek_data7 = mysqli_query($koneksi, "SELECT pemesanan_produk.*,produk.nama_menu,produk.harga
                  FROM pemesanan_produk
                  LEFT JOIN produk ON  pemesanan_produk.id_menu =produk.id_menu where nama_menu='Nasi Putih'");
//Inisiasi untuk membuat header kolom

$column_no = "";
$column_total_menu = "";
$column_harga = "";
$column_nama_menu  = "";


//For each row, add the field to the corresponding column
$x = 1;
foreach ($sql2 as $row) {




    $nama_menu = $row["nama_menu"];

    if ($nama_menu == 'Bakso Urat') {
        $jumlah = mysqli_num_rows($cek_data1);


        $harga = $row["harga"];
        $total_menu = $harga * $jumlah;
    } else if ($nama_menu == 'Mie Ayam') {
        $jumlah = mysqli_num_rows($cek_data2);


        $harga = $row["harga"];
        $total_menu = $harga * $jumlah;
    } else if ($nama_menu == 'Mie Ayam Bakso') {
        $jumlah = mysqli_num_rows($cek_data3);


        $harga = $row["harga"];
        $total_menu = $harga * $jumlah;
    } else if ($nama_menu == 'Ayam Bakar') {
        $jumlah = mysqli_num_rows($cek_data4);


        $harga = $row["harga"];
        $total_menu = $harga * $jumlah;
    } else if ($nama_menu == 'Lele Bakar') {
        $jumlah = mysqli_num_rows($cek_data5);


        $harga = $row["harga"];
        $total_menu = $harga * $jumlah;
    } else if ($nama_menu == 'Lele Bakar') {
        $jumlah = mysqli_num_rows($cek_data5);


        $harga = $row["harga"];
        $total_menu = $harga * $jumlah;
    } else if ($nama_menu == 'Nasi Goreng') {
        $jumlah = mysqli_num_rows($cek_data6);


        $harga = $row["harga"];
        $total_menu = $harga * $jumlah;
    } else if ($nama_menu == 'Nasi Putih') {
        $jumlah = mysqli_num_rows($cek_data7);


        $harga = $row["harga"];
        $total_menu = $harga * $jumlah;
    }

    $column_no = $column_no . $x . "\n";
    $column_total_menu = $column_total_menu . $total_menu . "\n";
    $column_harga = $column_harga . $harga . "\n";
    $column_nama_menu = $column_nama_menu . $nama_menu . "\n";

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
$pdf->Cell(30, 10, 'LAPORAN PENDAPATAN MAKANAN', 0, 0, 'C');
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
$pdf->Cell(50, 8, 'Harga Satuan', 1, 0, 'C', 1);

$pdf->SetX(130);
$pdf->Cell(50, 8, 'Total Pemesanan Hari ini', 1, 0, 'C', 1);





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
$pdf->MultiCell(50, 6, $column_harga, 1, 'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(130);
$pdf->MultiCell(50, 6, $column_total_menu, 1, 'L');







$pdf->Output();
