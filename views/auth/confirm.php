<main class="auth">
    <h2 class="auth__heading"> <?php echo $title; ?> </h2>
    <p class="auth__text">Your account has been successfully confirmed</p>

    <?php
        include_once __DIR__ . '/../templates/alerts.php';
    ?>
    <?php if(isset($alerts['success'])){ ?>
        <div class="actions--center">
            <a href="/login" class="actions__link">Log In</a>
        </div>
    <?php } ?>
</main>