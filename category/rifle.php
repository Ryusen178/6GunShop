<?php 
include("../includes/header.php"); 
include '../includes/db_connect.php'; // Pastikan nama file koneksi Anda sudah benar

// Query untuk mengambil data Rifle (ID 9, 10, 11, 12)
$sql = "SELECT id, name, price, caliber, capacity, image_url FROM products WHERE id >= 9 AND id <= 12";
$result = $conn->query($sql);
?>

<div class="category-hero">
    <h1>Assault & Modern Sporting Rifle Collection</h1>
    <p>Senapan serbu dan olahraga semi-otomatis terbaik di dunia.</p>
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
    echo "<p>Belum ada produk rifle yang tersedia saat ini.</p>";
}
$conn->close();
?>

</section>

<?php include("../includes/footer.php"); ?>