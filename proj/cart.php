<?php
require __DIR__ . '/../part/__connect_db.php';

$stmt = $pdo->query("SELECT * FROM `cart` LIMIT 20");

$rows = $stmt->fetchAll();

// $totalPrice = 0;
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
    <form name="form1" onsubmit="" novalidata>

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
                    <th scope="col">小計</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($rows as $r) : ?>
                    <?php

                    $subTotal = $r['price'] * $r['quantity'];
                    $totalPrice = (isset($totalPrice)) ? $totalPrice : 0 +  $subTotal;

                    ?>

                    <tr>

                        <td style="display: none;"><?= $r['sid'] ?></td>

                        <td>
                            <p style="display: none;"><?= $r['img'] ?></p><img src="<?= WEB_ROOT ?>/img/<?= $r['img'] ?>.jpg" id="img" name="img">
                        </td>

                        <td class="align-middle"><?= $r['name'] ?></td>

                        <td class="price align-middle"><?= $r['price'] ?></td>

                        <td class="quantity align-middle" data-sid="<?= $r['sid'] ?>">

                            <select type="number" class="form-control" id="form-control" style="display: inline-block; width: auto;">

                                <option value="<?= $r['quantity'] ?>"><?= $r['quantity'] ?></option>

                                <?php for ($i = 1; $i <= 20; $i++) : ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>

                            </select>
                        </td>

                        <td class="sub-total align-middle"><?= $subTotal ?></td>

                        <td class="align-middle">

                            <a href="delete-api.php?sid=<?= $r['sid'] ?>" onclick="ifDel(event)" sid="<?= $r['sid'] ?>">
                                <button type="button" class=" btn btn-danger buy-btn btn-add-cart-remove">刪除商品</button>
                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </form>

    <div class="row">

        <div class="col">

            <div class="alert alert-primary" role="alert">
                總計: <span id="total-price"><?= $totalPrice ?></span>
            </div>

        </div>

    </div>

    <div class="d-flex justify-content-end"><button type="button" class=" btn btn-primary buy-btn btn-add-cart">結帳</button></div>

</div>
<?php include __DIR__ . '/../part/__scripts.php' ?>
<script>
    function ifDel(event) {
        const a = event.currentTarget;
        console.log(event.target, event.currentTarget);
        const sid = a.getAttribute('sid');
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


    // $('.form-control').on('change', function() {
    //     console.log($(this).parent().parent().siblings().eq(1).text());
    //     console.log($(this).parent().parent().siblings().eq(2).text());
    //     console.log($(this).parent().parent().siblings().eq(3).text());
    //     console.log($(this).parent().parent().siblings().eq(4).text());
    // })

    window.onload = function() {
        $("tbody>tr").each(function() {
            var subtotal = parseInt($(this).find(".price").text()) * parseInt($(this).find('select').val());
            // $(this).find(".sub-total").text(subtotal)
        })
        var total = 0;
        $(".sub-total").each(function() {
            total += parseInt($(this).text())
        });
        // $('#total-price').text(total);
        //console.log("文档加载完毕！");
    };


    $('.quantity').change(function() {
        $("tbody>tr").each(function() {
            var subtotal = parseInt($(this).find(".price").text()) * parseInt($(this).find('select').val());
            $(this).find(".sub-total").text(subtotal)
            //console.log("select", $(this).find('select').val());
        })
        var total = 0;
        $(".sub-total").each(function() {
            total += parseInt($(this).text())
        });
        $('#total-price').text(total);



        const fd = new FormData(document.form1);
        console.log($(this).data('sid'));
        fd.append('quantity', $(this).find('select').val());
        fd.append('sid', $(this).data('sid'));
        // fd.append('price', 123);
        // fd.append('quantity', 123);


        fetch('edit-cart-api.php', {
                method: 'post',
                body: fd
            })
            .then(r => r.json())
            .then(str => {
                console.log(str);
            });


    });
</script>
<?php require __DIR__ . '/../part/__html_foot.php' ?>