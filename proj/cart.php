<?php
require __DIR__ . '/../part/__connect_db.php';

$stmt = $pdo->query("SELECT * FROM `cart` LIMIT 5");

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
        <h2>確認購物車</h2>
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
                    <td>
                        <p style="display: none;"><?= $r['img'] ?></p><img src="<?= WEB_ROOT ?>/img/<?= $r['img'] ?>.jpg" id="img" name="img">
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
                    <td><a href="delete-api.php?sid=<?= $r['sid'] ?>" onclick="ifDel(event)" sid="<?= $r['sid'] ?>"><button type="button" class=" btn btn-danger buy-btn btn-add-cart-remove">刪除商品</button></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-end"><button type="button" class=" btn btn-primary buy-btn btn-add-cart">結帳</button></div>

</div>
<?php include __DIR__ . '/../part/__scripts.php' ?>
<script>
    const table = document.querySelector('table');

    table.addEventListener('click', (event) => {
        const t = event.target;
        console.log(t.classList.contains('btn-add-cart-remove'));

        if (t.classList.contains('btn-add-cart-remove')) {
            t.closest('tr').remove();
        }
    })


    function ifDel(event) {
        const a = event.currentTarget;
        console.log(event.target, event.currentTarget);
        const sid = a.getAttribute('data-sid');
        if (!confirm(`是否要刪除編號為 ${sid} 的資料?`)) {
            event.preventDefault(); // 取消連往 href 的設定
        }
    }


    function delete_it(sid) {

        if (confirm(`是否要刪除編號為 ${sid} 的資料???`)) {
            location.href = 'delete-api.php?sid='
            sid;
        }
    }
</script>
<?php require __DIR__ . '/../part/__html_foot.php' ?>