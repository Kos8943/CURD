<?php
require __DIR__ . '/../part/__connect_db.php';

$stmt = $pdo->query("SELECT * FROM `product-list` LIMIT 5");

$rows = $stmt->fetchAll();
?>
<?php include __DIR__ . '/../part/__html_head.php' ?>
<style>
    img {
        width: 150px;
        height: 150px;
    }

    .card {
        margin: 30px;
    }

    p {
        margin-bottom: 8px;
    }
</style>
<?php include __DIR__ . '/../part/__navbar.php' ?>
<div class="container">
    <table class="table table-striped">
        <!-- `sid`, `name`, `price`, `mobile`, `birthday`, `address`, `created_at` -->
        <thead>
            <tr>
                <th scope="col" style="display: none;">#</th>
                <th scope="col">商品圖</th>
                <th scope="col">商品名稱</th>
                <th scope="col">價格</th>
                <th scope="col">數量</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $r) : ?>
                <tr>
                    <td style="display: none;"><?= $r['sid'] ?></td>
                    <td><p style="display: none;"><?= $r['img'] ?></p><img src="<?= WEB_ROOT ?>/img/<?= $r['img'] ?>.jpg" id="img" name="img">
                    </td>
                    <td><?= $r['name'] ?></td>
                    <td><?= $r['price'] ?></td>
                    <td>
                        <p>
                            <select type="number" class="form-control" style="display: inline-block; width: auto;">
                                <?php for ($i = 1; $i <= 20; $i++) : ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </p>
                    </td>
                    <td><button type="button" class=" btn btn-primary buy-btn btn-add-cart">加入購物車</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
<?php include __DIR__ . '/../part/__scripts.php' ?>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script>
    $('.btn-add-cart').on('click', function() {
        console.log($(this).parent().siblings().eq(1).text());
        console.log($(this).parent().siblings().eq(2).text());
        console.log($(this).parent().siblings().eq(3).text());
        console.log($(this).parent().siblings().eq(4).find('select').val());
    })
</script>
<?php require __DIR__ . '/../part/__html_foot.php' ?>