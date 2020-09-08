<?php
require __DIR__ . '/../part/__connect_db.php';

$stmt = $pdo->query("SELECT * FROM `product-list` LIMIT 5");

$rows = $stmt->fetchAll();
?>
<?php include __DIR__ . '/../part/__html_head.php' ?>
<style>
    img {
        width: 120px;
        height: 120px;
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
                            <p style="display: none;">
                                <?= $r['img'] ?></p><img src="<?= WEB_ROOT ?>/img/<?= $r['img'] ?>.jpg" id="img" name="img">
                            <input type="hidden" name="img" value="<?= $r['img'] ?>">
                            </p>
                        </td>

                        <td class="align-middle">
                            <sapn><?= $r['name'] ?></sapn>
                            <input type="hidden" name="name" value="<?= $r['name'] ?>">
                        </td>

                        <td class="align-middle">
                            <span><?= $r['price'] ?></span>
                            <input type="hidden" name="price" value="<?= $r['price'] ?>">
                        </td>

                        <td class="align-middle">

                            <select type="number" value="<?= $i ?>" class="form-control" style="display: inline-block; width: auto;">

                                <?php for ($i = 1; $i <= 20; $i++) : ?>

                                    <option value="<?= $i ?>"><?= $i ?></option>

                                <?php endfor; ?>



                            </select>
                        </td>
                        <input type="hidden" name="quantity" value="">

                        <td class="align-middle">
                            <button type="submit" class=" btn btn-primary buy-btn btn-add-cart">加入購物車</button>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </form>

</div>

<?php include __DIR__ . '/../part/__scripts.php' ?>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script>
    $('.btn-add-cart').on('click', function() {
        console.log($(this).parent().siblings().eq(1).next().text());
        console.log($(this).parent().siblings().eq(2).next().text());
        console.log($(this).parent().siblings().eq(3).next().text());
        console.log($(this).parent().siblings().eq(4).find('select').val());

        // let tds = $(this).closest('tr').find('td');
        // console.log('tr', tds.eq(0).next().text().trim());
        // console.log('tr', tds.eq(1).next().text().trim());
        // console.log('tr', tds.eq(2).next().text().trim());
        // console.log('tr', $(this).find('option:selected').val());
        // const fd = new FormData(document.form1);
        // fd.append('img', tds.eq(0).next().text().trim());
        // fd.append('name', tds.eq(1).next().text().trim());
        // fd.append('price', tds.eq(2).next().text().trim());
        // fd.append('quantity', $(this).find('option:selected').val());

        // fetch('cart-api.php', {
        //         method: 'post',
        //         body: fd
        //     })
        //     .then(r => r.json())
        //     .then(str => {
        //         console.log(str);
        //     });
    })

    function checkForm() {
        const fd = new FormData(document.form1);
        //  fd.append('img', );
        //  fd.append('name', '123');
        //  fd.append('price', 12);
        //  fd.append('quantity', 123);

        fetch('cart-api.php', {
                method: 'post',
                body: fd
            })
            .then(r => r.json())
            .then(str => {
                console.log(str);
            });
    }

    $('select.form-control').on('change', function() {

        // console.log($(this).find('option:selected').val());
        // $(this).parent().next().val($(this).find('option:selected').val())
        // console.log($(this).parent().siblings().eq(0).text());
    })
</script>
<?php require __DIR__ . '/../part/__html_foot.php' ?>