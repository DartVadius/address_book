<div class="row">
    <div class="col-lg-12" style="border:1px solid black; padding: 5px">
        <h1 style="text-align: center"><?= $title ?></h1>
    </div>
</div>
<div class="row form-group">
    <div class="col-lg-12" style="border:1px solid black; padding: 5px">
        <form method="post" action="/admin/save" name="edit_form" class="entry" enctype="multipart/form-data"
              onSubmit="return checkform()">
            <input name=" row_id
        " type="text" style="display: none" value="<?= $book_row['id'] ?? '' ?>">
            <div class="row">
                <div class="col-lg-12" style="text-align: center"><h3>Note: records marked with <span
                                style="color: red;">*</span> are required</h3>
                </div>
            </div>
            <div class="row" style="padding: 5px">
                <div class="col-lg-6"><span style="float: right"><span style="color: red">*</span> First name</span>
                </div>
                <div class="col-lg-6">
                    <input type="text" name="first_name" style="float: left"
                           value="<?= $book_row['first_name'] ?? '' ?>">
                    &nbsp;<span class="msg text-danger" id="first_name_msg"></span>
                </div>
            </div>
            <div class="row" style="padding: 5px">
                <div class="col-lg-6"><span style="float: right"><span style="color: red">*</span> Last name</span>
                </div>
                <div class="col-lg-6">
                    <input type="text" name="last_name" style="float: left"
                           value="<?= $book_row['last_name'] ?? '' ?>">
                    &nbsp;<span class="msg text-danger" id="last_name_msg"></span>
                </div>
            </div>
            <div class="row" style="padding: 5px">
                <div class="col-lg-6"><span style="float: right"><span style="color: red">*</span> E-mail</span></div>
                <div class="col-lg-6">
                    <input type="text" name="email" style="float: left"
                           value="<?= $book_row['email'] ?? '' ?>">
                    &nbsp;<span class="msg text-danger" id="email_msg"></span>
                </div>
            </div>
            <div class="row" style="padding: 5px">
                <div class="col-lg-6"><span style="float: right"><span style="color: red">*</span> Country</span></div>
                <div class="col-lg-6">
                    <select name="country" style="float: left; width: 175px" class="country">
                        <option value="">--Select Country--</option>
                        <?php if (!empty($country_list)): ?>
                            <?php foreach ($country_list as $country): ?>
                                <option value="<?= $country['id'] ?>" <?= ($country['id'] == $book_row['country_id']) ? 'selected' : '' ?>><?= $country['name'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    &nbsp;<span class="msg text-danger" id="country_msg"></span>
                </div>
            </div>
            <div class="row" style="padding: 5px">
                <div class="col-lg-6"><span style="float: right"><span style="color: red">*</span> City</span></div>
                <div class="col-lg-6">
                    <select name="city" style="float: left; width: 175px" id="city_val">
                        <option value="">--Select City--</option>
                        <?php if (!empty($cities_list)): ?>
                            <?php foreach ($cities_list as $city): ?>
                                <option value="<?= $city['id'] ?>" <?= ($city['id'] == $book_row['city_id']) ? 'selected' : '' ?>><?= $city['name'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    &nbsp;<span class="msg text-danger" id="city_msg"></span>
                </div>
            </div>
            <div class="row" style="padding: 5px">
                <div class="col-lg-6"><span style="float: right"> Photo</span>
                </div>
                <div class="col-lg-6 photo">
                    <input name="photo" type="file" accept="image/*,image/jpeg" id="photo">
                </div>
            </div>
            <div class="row" style="padding: 5px">
                <div class="col-lg-6">
                </div>
                <div class="col-lg-6 photo">
                    <?php if (!empty($book_row['photo_url'])): ?>
                        <img id="preview" src="/<?= $book_row['photo_url'] ?>" width="400" height="300">
                    <?php else: ?>
                        <img id="preview" src="#" style="display: none" width="400" height="300">
                    <?php endif; ?>

                </div>
            </div>
            <div class="row" style="padding: 5px; text-align: center">
                <div class="col-lg-12"><h3>Notes</h3></div>
            </div>
            <div class="row form-group" style="padding: 5px">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <textarea rows="5" name="notes" class="form-control"><?= $book_row['notes'] ?></textarea>
                </div>
                <div class="col-lg-2"></div>
            </div>
            <div class="row" style="padding: 5px">
                <div class="col-lg-6"><input type="submit" value="Save" class="btn btn-default" style="float: right"
                                             id="submit">
                </div>
                <div class="col-lg-6"><a href="/admin/address_book" class="btn btn-default"
                                         style="float: left">Return</a></div>
            </div>

        </form>
    </div>
</div>
<script>
    function checkform() {
        $('.msg').empty();
        var errors = 0;
        if (!$('input[name=first_name]').val()) {
            $('#first_name_msg').text('First Name is required');
            errors++;
        }
        if (!$('input[name=last_name]').val()) {
            $('#last_name_msg').text('Last Name is required');
            errors++;
        }
        if (!$('input[name=email]').val()) {
            $('#email_msg').text('Email is required');
            errors++;
        }
        if (!$('select[name=country] option:selected').val()) {
            $('#country_msg').text('Country is required');
            errors++;
        }
        if (!$('select[name=city] option:selected').val()) {
            $('#city_msg').text('City is required');
            errors++;
        }
        if (errors === 0) {
            return true;
        }
        return false
    }

    $(document).ready(function () {

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#photo").change(function () {
            readURL(this);
        });

        $('.country').change(function () {
            var city_id = $(this).val();
            $.ajax({
                method: 'post',
                url: '/admin/get_cities',
                data: {'city_id': city_id},
                success: function (responce) {
                    $('#city_val').empty();
                    var obj = $.parseJSON(responce);
                    $('#city_val').append($("<option></option>").attr("value", '').text('--Select City--'));
                    $.each(obj.list, function (idx, row) {
                        $('#city_val').append($("<option></option>").attr("value", row['id']).text(row['name']));
                    });

                }
            });
            console.log(city_id);
        });
    });
</script>