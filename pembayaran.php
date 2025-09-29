<?php
require "koneksi.php"; 
require 'vendor/autoload.php';

// Ambil ID order dari parameter URL
$id_order = isset($_GET['id']) ? $_GET['id'] : null;

// Cek validitas ID order
if (!isset($id_order) || empty($id_order) || !is_numeric($id_order)) {
    die("ID order tidak valid.");
}

// Ambil data order dan pembayaran
$query_order = "SELECT o.*, p.tgl_bayar, p.nm_bank, p.jml_pembayaran, p.nm_pembayar, p.bukti_transfer
FROM tbl_order o LEFT JOIN tbl_pembayaran p ON o.id_order = p.id_order 
WHERE o.id_order = '$id_order'";

$result_order = mysqli_query($db, $query_order);

// Cek apakah kueri berhasil
if (!$result_order) {
    die("Error: " . mysqli_error($db));
}

// Ambil data order dari hasil query
$order_data = mysqli_fetch_assoc($result_order);
if (!$order_data) {
    die("Data order tidak ditemukan.");
}

// Ambil detail order
$query_items = "SELECT d.nm_produk, d.jml_order, d.harga 
FROM tbl_detail_order d 
WHERE d.id_order = '$id_order'";
$result_items = mysqli_query($db, $query_items);

// Cek apakah kueri detail order berhasil
if (!$result_items) {
    die("Error: " . mysqli_error($db));
}

// Cek jika tombol unduh ditekan
if (isset($_POST['download_pdf'])) {
    // Buat PDF
    ob_start(); // Mulai buffer output
    ?>
    <h2>Toko Alat Kesehatan Medkita - Laporan Belanja Anda</h2>
    <p><strong>Tanggal Order:</strong> <?php echo $order_data['tgl_order']; ?></p>
    <p><strong>Tanggal Pembayaran:</strong> <?php echo $order_data['tgl_bayar'] ?: 'Belum dibayar'; ?></p>
    <p><strong>Nama Bank:</strong> <?php echo $order_data['nm_bank'] ?: 'Tidak ada'; ?></p>
    <p><strong>No Resi:</strong> <?php echo $order_data['no_resi'] ?: 'Belum ada'; ?></p>
    <p><strong>User ID:</strong> <?php echo $order_data['id_pelanggan']; ?></p>
    <p><strong>Nama:</strong> <?php echo $order_data['nm_penerima']; ?></p>
    <p><strong>Alamat:</strong> <?php echo $order_data['alamat_pengiriman']; ?></p>
    <p><strong>No HP:</strong> <?php echo $order_data['telp']; ?></p>
    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total Belanja (termasuk pajak)</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            while ($item = mysqli_fetch_assoc($result_items)) { ?>
                <tr>
                    <td><?php echo $item['nm_produk']; ?></td>
                    <td><?php echo $item['jml_order']; ?></td>
                    <td><?php echo 'Rp. ' . number_format($item['harga']); ?></td>
                    <td><?php echo 'Rp. ' . number_format($item['jml_order'] * $item['harga']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php
    $content = ob_get_clean(); 

    // Buat file PDF
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($content);
    $mpdf->Output('struk_belanja.pdf', 'D'); // D untuk download
    exit; // Keluar dari script setelah output PDF
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Export - Struk Belanja</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        h2 {
            margin-bottom: 20px;
        }
        .info-container {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }
        .info-block {
            width: 45%;
            text-align: left;
            padding: 10px;
            border: 0;
            border-radius: 0;
        }
        .btn {
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            display: inline-block;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Toko Alat Kesehatan Medkita - Laporan Belanja Anda</h2>

        <div class="info-container">
            <div class="info-block">
                <p><strong>Tanggal Order:</strong> <?php echo $order_data['tgl_order']; ?></p>
                <p><strong>Tanggal Pembayaran:</strong> <?php echo $order_data['tgl_bayar'] ?: 'Belum dibayar'; ?></p>
                <p><strong>Nama Bank:</strong> <?php echo $order_data['nm_bank'] ?: 'Tidak ada'; ?></p>
                <p><strong>No Resi:</strong> <?php echo $order_data['no_resi'] ?: 'Belum ada'; ?></p>
                
                <!-- Tombol untuk Mengunduh PDF -->
                <form method="post">
                    <button type="submit" name="download_pdf" class="btn">Unduh PDF</button>
                </form>
            </div>
            <div class="info-block">
                <p><strong>User ID:</strong> <?php echo $order_data['id_pelanggan']; ?></p>
                <p><strong>Nama:</strong> <?php echo $order_data['nm_penerima']; ?></p>
                <p><strong>Alamat:</strong> <?php echo $order_data['alamat_pengiriman']; ?></p>
                <p><strong>No HP:</strong> <?php echo $order_data['telp']; ?></p>
            </div>
        </div>

        <div class="table-container">
            <table id="mauexport">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Total Belanja (termasuk pajak)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    while ($item = mysqli_fetch_assoc($result_items)) { ?>
                        <tr>
                            <td><?php echo $item['nm_produk']; ?></td>
                            <td><?php echo $item['jml_order']; ?></td>
                            <td><?php echo 'Rp. ' . number_format($item['harga']); ?></td>
                            <td><?php echo 'Rp. ' . number_format($item['jml_order'] * $item['harga']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#mauexport').DataTable({
                dom: 'Bfrtip',
                buttons: ['excel', 'pdf', 'print']
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
</body>
</html>
