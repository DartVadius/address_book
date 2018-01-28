<br>
<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-5">
        <div class="row">
            <div class="col-lg-6">
                <p><b>Name:</b></p>
                <p><b>Location:</b></p>
                <p><b>Email:</b></p>
            </div>
            <div class="col-lg-6">
                <p><?= $row['first_name'] . ' ' . $row['last_name'] ?></p>
                <p><?= $row['city_name'] . ', ' . $row['country_name'] ?></p>
                <p><a href="mailto:<?= $row['email'] ?>"><?= $row['email'] ?></a></p>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <?php if (!empty($row['photo_url'])): ?>
            <img src="/<?= $row['photo_url'] ?>">
        <?php endif; ?>
    </div>
    <div class="col-lg-1"></div>
</div>
<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10" style="border-bottom: solid black 1px; padding-bottom: 20px; padding-top: 20px"><b>Notes:</b></div>
    <div class="col-lg-1"></div>
</div>
<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10" style="padding-top: 20px"><?= $row['notes'] ?></div>
    <div class="col-lg-1"></div>
</div>
<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10" style="padding-top: 20px; text-align: center"><a href="/index"><b>Back to the list</b></a></div>
    <div class="col-lg-1"></div>
</div>