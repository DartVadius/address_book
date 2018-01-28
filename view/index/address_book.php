<h1 style="text-align: center">Address Book</h1>
<div class="row" style="border:1px solid black; padding: 5px">
    <div class="col-lg-12" style="text-align: center;">
        <h4>Search</h4>
    </div>
</div>
<form method="post" action="/index/search">
    <div class="row" style="text-align: center; border:1px solid black; padding: 5px;">
        <div class="col-lg-4">
            <label for="search_word">Keywords:</label> <input type="text" size="20" name="search_word">
        </div>
        <div class="col-lg-4">
            <label for="country">Country:</label>
            <select name="country" style="width: 175px" class="country">
                <option value="">--All countries--</option>
                <?php if (!empty($country_list)): ?>
                    <?php foreach ($country_list as $country): ?>
                        <option value="<?= $country['id'] ?>"><?= $country['name'] ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="col-lg-4">
            <label for="city">City:</label>
            <select name="city" style="width: 175px" id="city_val">
                <option value="">--All cities--</option>
            </select>
        </div>
    </div>
    <div class="row" style="text-align: center; border:1px solid black; padding: 5px;">
        <input type="submit" value="Search" class="btn btn-default">
    </div>
</form>
<br>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered table-stripped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Country</th>
                <th>City</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($address_book_all)): ?>
                <?php foreach ($address_book_all as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><a href="/index/view?id=<?=$user['id']?>"><?= $user['first_name'] . ' ' . $user['last_name'] ?></a></td>
                        <td><?= $user['country_name'] ?></td>
                        <td><?= $user['city_name'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            <tr>
                <td colspan="6" style="padding: 5px">
                    <span style="float: left">
                        Show <a href="/index/index?show=2">2</a> |
                        <a href="/index/index?show=10">10</a> |
                        <a href="/index/index?show=0">All</a>
                        per page
                    </span>
                    <span style="float: right">
                        Page:
                        <a href="/index/index?page=<?= $nav['current'] - 1; ?>">Prev </a>
                        <?php if (!empty($nav['current-2'])): ?>
                            <a href="/index/index?page=<?= $nav['current-2'] ?>"><?= $nav['current-2'] ?></a>
                        <?php endif; ?>
                        <?php if (!empty($nav['current-1'])): ?>
                            <a href="/index/index?page=<?= $nav['current-1'] ?>"><?= $nav['current-1'] ?></a>
                        <?php endif; ?>
                        <a href="#"><?= $nav['current'] ?></a>
                        <?php if (!empty($nav['current+1'])): ?>
                            <a href="/index/index?page=<?= $nav['current+1'] ?>"><?= $nav['current+1'] ?></a>
                        <?php endif; ?>
                        <?php if (!empty($nav['current+1'])): ?>
                            <a href="/index/index?page=<?= $nav['current+2'] ?>"><?= $nav['current+2'] ?></a>
                        <?php endif; ?>
                        <a href="/index/index?page=<?= $nav['current'] + 1; ?>"> Next</Next></a>
                    </span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.country').change(function () {
            var city_id = $(this).val();
            $.ajax({
                method: 'post',
                url: '/admin/get_cities',
                data: {'city_id': city_id},
                success: function (responce) {
                    $('#city_val').empty();
                    var obj = $.parseJSON(responce);
                    $('#city_val').append($("<option></option>").attr("value", '').text('--All cities--'));
                    $.each(obj.list, function (idx, row) {
                        $('#city_val').append($("<option></option>").attr("value", row['id']).text(row['name']));
                    });

                }
            });
            console.log(city_id);
        });
    });
</script>
