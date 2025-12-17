<?php 
include("../includes/header.php"); 
include '../includes/db_connect.php'; // Pastikan nama file koneksi Anda sudah benar

// Query untuk mengambil data Sniper Rifle (ID 5, 6, 7, 8)
$sql = "SELECT id, name, price, caliber, capacity, image_url FROM products WHERE id >= 5 AND id <= 8";
$result = $conn->query($sql);
?>

<div class="category-hero">
    <h1>Sniper Rifle Collection</h1>
    <p>Senapan laras panjang presisi untuk olahraga dan operasi jarak jauh.</p>
</div>

<section class="product-grid">

<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Tampilkan setiap produk
        $id = htmlspecialchars($row['id']);
        $name = htmlspecialchars($row['name']);
        $price = number_format($row['price'], 0, ',', '.');
        $spec = htmlspecialchars($row['caliber']) . ' • ' . htmlspecialchars($row['capacity']);
        $img_url = htmlspecialchars($row['image_url'] ?? 'default.jpg');
?>
        <div class="product-card">
            <div class="product-img">
                <img src="../assets/images/<?php echo $img_url; ?>" alt="<?php echo $name; ?>">
            </div>
            <h3><?php echo $name; ?></h3>
            <p class="spec"><?php echo $spec; ?></p>
            <p class="price">$<?php echo $price; ?></p>
            <a href="product-detail.php?id=<?php echo $id; ?>" class="btn-product">View Details</a> 
        </div>
<?php
    }
} else {
    echo "<p>Belum ada produk sniper rifle yang tersedia saat ini.</p>";
}
$conn->close();
?>

</section>

<?php include("../includes/footer.php"); ?>