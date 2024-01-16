<h2 class="dashboard__heading"><?php echo $title; ?></h2>

<div class="dashboard__container-button">
    <a class="dashboard__button" href="/admin/events">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Go Back
    </a>
</div>

<div class="dashboard__form">
    <?php
        include_once __DIR__ . "/../../templates/alerts.php";
    ?>
    <form method="POST" class="form">
        <?php include_once __DIR__ . "/form.php"; ?>

        <input class="form__submit form__submit--register" type="submit" value="Save Changes">
    </form>
</div>