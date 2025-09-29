<?php require "header.php"; ?>

<style>
    .banner .img {
        width: 100%;
        height: 250px;
        background-image: url('assets/img/banner.jpg');
        padding: 0px;
        margin: 0px;
    }
    .img .box {
        height: 250px;
        background-color: rgba(41, 41, 41, 0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        padding-top: 70px;
    }
</style>

<?php
// Array kategori dan gambar terkait
$categories_with_images = [
    'jalan' => [
        ['src' => 'admin/assets/images/foto_pos/20.jpg', 'title' => 'Walker Roda'],
        ['src' => 'admin/assets/images/foto_pos/21.jpg', 'title' => 'Walking Crutches'],
        ['src' => 'admin/assets/images/foto_pos/22.jpg', 'title' => 'Wheelchair'],
        ['src' => 'admin/assets/images/foto_pos/23.jpg', 'title' => 'Commode Chair']
    ],
    'pernapasan' => [
        ['src' => 'admin/assets/images/foto_pos/19.jpg', 'title' => 'Portable Nebulizer'],
        ['src' => 'admin/assets/images/foto_pos/24.jpg', 'title' => 'Portable CPAP'],
        ['src' => 'admin/assets/images/foto_pos/25.jpg', 'title' => 'BiPAP'],
        ['src' => 'admin/assets/images/foto_pos/26.jpg', 'title' => 'Nebulizer']
    ],
    'tensimeter' => [
        ['src' => 'admin/assets/images/foto_pos/18.jpg', 'title' => 'Tensimeter Digital'],
        ['src' => 'admin/assets/images/foto_pos/27.jpg', 'title' => 'Tensimeter Aneroid'],
        ['src' => 'admin/assets/images/foto_pos/28.jpg', 'title' => 'Tensimeter Kit'],
        ['src' => 'admin/assets/images/foto_pos/29.jpg', 'title' => 'Tensimeter Manual']
    ],
    'thermometer' => [
        ['src' => 'admin/assets/images/foto_pos/17.jpg', 'title' => 'Thermometer Infrared'],
        ['src' => 'admin/assets/images/foto_pos/30.jpg', 'title' => 'Thermometer Digital'],
        ['src' => 'admin/assets/images/foto_pos/31.jpg', 'title' => 'Thermometer Scanner'],
        ['src' => 'admin/assets/images/foto_pos/32.jpg', 'title' => 'iHealt Wireless']
    ],
    'emergency' => [
        ['src' => 'admin/assets/images/foto_pos/16.jpg', 'title' => 'P3K'],
        ['src' => 'admin/assets/images/foto_pos/33.jpg', 'title' => 'Ambulance Stretchers'],
        ['src' => 'admin/assets/images/foto_pos/34.jpg', 'title' => 'Pocket CPR'],
        ['src' => 'admin/assets/images/foto_pos/35.jpg', 'title' => 'Regulator Oksigen']  
    ],
    'terapi' => [
        ['src' => 'admin/assets/images/foto_pos/15.jpg', 'title' => 'Neck Massager'],
        ['src' => 'admin/assets/images/foto_pos/36.jpg', 'title' => 'Vibration Back Massager'],
        ['src' => 'admin/assets/images/foto_pos/37.jpg', 'title' => 'Shoulder Massager'],
        ['src' => 'admin/assets/images/foto_pos/38.jpg', 'title' => 'Portable Massage']
    ],
    'gula darah' => [
        ['src' => 'admin/assets/images/foto_pos/14.jpg', 'title' => 'Blood Check Kit'],
        ['src' => 'admin/assets/images/foto_pos/39.jpg', 'title' => 'Glucometer'],
        ['src' => 'admin/assets/images/foto_pos/40.jpg', 'title' => 'USB Glucose Monitor'],
        ['src' => 'admin/assets/images/foto_pos/41.jpg', 'title' => 'Glucose Testing Kit']
    ],
    'ortopedi' => [
        ['src' => 'admin/assets/images/foto_pos/13.jpg', 'title' => 'Posture Corrector'],
        ['src' => 'admin/assets/images/foto_pos/42.jpg', 'title' => 'Ankle Stabilizer'],
        ['src' => 'admin/assets/images/foto_pos/43.jpg', 'title' => 'Back Posture Corrector'],
        ['src' => 'admin/assets/images/foto_pos/44.jpg', 'title' => 'Walker Boot']
    ]
];

// Ambil kategori dari URL (misal: ?category=jalan atau ?category=pernapasan)
$category = isset($_GET['category']) ? $_GET['category'] : null;

// Ambil gambar berdasarkan kategori yang dipilih
$images = isset($categories_with_images[$category]) ? $categories_with_images[$category] : [];

// Menampilkan gambar jika ada
?>

<div class="banner mb-5">
    <div class="container-fluid img">
        <div class="container-fluid box">
        <p>All Images > </p>
        <p> Home > <a href="blog.php" style="text-decoration: none; color: white;">Images</a> > 
            <a href="" class="text-primary" style="text-decoration: none;">
                <?php echo ucfirst($category); ?> Images</a> 
            </p>
        </div>
    </div>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="owl-carousel owl-theme" style="padding: 0; opacity: 1;">
            <?php foreach ($images as $image): ?>
            <div class="item card" style="margin: 5px;">
                <img src="<?php echo $image['src']; ?>" class="card-img-top" alt="<?php echo $image['title']; ?>" 
                style="width: 240px; height: auto; display: block; margin: 0 auto;">
                <div class="card-body text-center">
                    <strong><?php echo $image['title']; ?></strong>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('.owl-carousel').owlCarousel({
        items: 3, // Jumlah item yang ditampilkan di layar
        margin: 10, // Jarak antar item
        loop: true, // Mengulangi carousel
        nav: true, // Menampilkan navigasi
        autoplay: true // Mengaktifkan autoplay
    });
});
</script>

<?php require "footer.php"; ?>
