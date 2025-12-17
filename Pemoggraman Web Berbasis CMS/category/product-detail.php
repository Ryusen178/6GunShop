<?php
// ==========================================================
// 1. KODE PENGAMBILAN DATA (Fetch Code)
// ==========================================================

// PENTING: Gunakan nama file koneksi yang benar, yaitu db.connect.php
// Path: Keluar dari folder category (../) lalu masuk ke includes/
include '../includes/db_connect.php'; 

$product_data = null; // Inisialisasi variabel

// Ambil ID dari URL (Contoh: product-detail.php?id=1)
if (isset($_GET['id'])) {
    // Karena ID di handgun.php sudah diubah ke INT (angka), kita pastikan itu di-cast sebagai integer
    $product_id = (int)$_GET['id'];
    
    // Query untuk mengambil SEMUA data produk berdasarkan ID
    $sql = "SELECT * FROM products WHERE id = ?";
    
    // Menggunakan Prepared Statement untuk keamanan
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $product_id); // "i" untuk integer
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Data ditemukan, masukkan ke variabel $product_data
            $product_data = $result->fetch_assoc();
        } 
        $stmt->close();
    }
}
$conn->close();
?>

<?php include("../includes/header.php"); ?>

<main class="product-page-container">
    <?php if ($product_data): ?>
    
    <div class="product-info-wrapper">
        
        <div class="product-image-area">
            <img src="../assets/images/<?php echo htmlspecialchars($product_data['image_url'] ?? 'default.jpg'); ?>" 
                 alt="<?php echo htmlspecialchars($product_data['name']); ?>">
        </div>

        <div class="product-details-area">
            <h1><?php echo htmlspecialchars($product_data['name']); ?></h1>
            
            <?php if (!empty($product_data['upc'])): ?>
                <p class="product-sku">SKU: <?php echo htmlspecialchars($product_data['upc']); ?></p>
            <?php endif; ?>
            
            <p class="product-price">$<?php echo number_format($product_data['price'], 2); ?></p>
            
            <button class="btn-add-to-cart">ADD TO CART</button>
            
            <div class="product-description">
                <h2>Product Information & Specs</h2>
                <p><?php echo nl2br(htmlspecialchars($product_data['description'] ?? 'Deskripsi produk ini belum tersedia.')); ?></p>
            </div>
        </div>
    </div>
    
    <hr>
    
    <div class="product-specs-section">
        <h2>Technical Specifications</h2>
        <table class="specs-table">
            <?php
            // Karena kita sudah cek $product_data di if ($product_data): di atas, kita langsung gunakan
            $specs = [
                'UPC' => $product_data['upc'] ?? '',
                'Action' => $product_data['action'] ?? '',
                'Barrel Length' => $product_data['barrel_length'] ?? '',
                'Barrel Type' => $product_data['barrel_type'] ?? '',
                'Caliber' => $product_data['caliber'] ?? '',
                'Capacity' => $product_data['capacity'] ?? '',
                'Finish' => $product_data['finish'] ?? '',
                'Muzzle Type' => $product_data['muzzle_type'] ?? '',
                'Optic Mount' => $product_data['optic_mount'] ?? '',
                'Sights' => $product_data['sights'] ?? '',
                'Thread Pattern' => $product_data['thread_pattern'] ?? '',
                'Weight' => $product_data['weight'] ?? ''
            ];
            
            foreach ($specs as $label => $value) {
                if (!empty($value)) {
                    echo '<tr>';
                    echo '<th>' . htmlspecialchars($label) . '</th>';
                    echo '<td>' . htmlspecialchars($value) . '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
        <p class="warning-text">⚠️ WARNING: [Teks Peringatan yang Relevan]</p>
    </div>

    <?php else: ?>
        <p class="error-message">Mohon maaf, produk yang Anda cari tidak ditemukan.</p>
    <?php endif; ?>

</main>

<?php include("../includes/footer.php"); ?>