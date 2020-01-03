<?php
session_start();
require "koneksi.php";
$title = 'eCommerce';

if (!isset($_GET['page'])) $page = 1;
else $page = $_GET['page'];
$offset = ($page - 1) * 4;
$totalData = $db->from('tbl_produk')->count();
$totalPage = ceil($totalData / 4);
$db->sql("set sql_mode = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';")->execute();
$listOfProducts = $db->from('tbl_produk')
    ->join('tbl_foto_produk', array('tbl_produk.id_produk' => 'tbl_foto_produk.id_produk'))->groupBy('tbl_foto_produk.id_produk')
    ->limit(4)->offset($offset)->many();

include "template/head.php";
?>

<body>
<div id="all">
    <?php
    include "template/components.php";
    include "template/header.php";
    ?>
    <div id="content">
        <div class="container">
            <div class="row bar">
                <div class="col-md-12">
                    <p class="text-muted lead text-center"><?php $msg->display(); ?></p>
                    <div class="products-big">
                        <div class="row products">
                            <?php
                            foreach ($listOfProducts as $product) {
                                ?>
                                <div class="col-lg-3 col-md-4">
                                    <div class="product">
                                        <div class="image"><a
                                                    href="<?php echo $base_url . "/produk.php?id_produk=" . $product['id_produk']; ?>"><img
                                                        src="<?php echo $base_url; ?>/produk/<?php echo $product['foto_produk']; ?>"
                                                        alt="" class="img-fluid image1"></a></div>
                                        <div class="text">
                                            <h3 class="h5"><a
                                                        href="<?php echo $base_url . "/produk.php?id_produk=" . $product['id_produk']; ?>"><?php echo $product['nm_produk']; ?></a>
                                            </h3>
                                            <p class="price"><?php echo "Rp " . number_format($product['harga'], 2, ',', '.'); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="pages">
                        <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                            <ul class="pagination">
                                <?php
                                for ($i = 0; $i < $totalPage; $i++) {
                                    if ($i + 1 == $page) {
                                        echo '<li class="page-item active"><a href="' . $base_url . '/index.php?page=' . ($i + 1) . '" class="page-link">' . ($i + 1) . '</a></li>';
                                    } else echo '<li class="page-item"><a href="' . $base_url . '/index.php?page=' . ($i + 1) . '" class="page-link">' . ($i + 1) . '</a></li>';
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- FOOTER -->
</div>
<?php include "template/footer.php"; ?>
</div>
<!-- Javascript files-->
<?php include "template/javascript.php"; ?>
</body>
</html>
