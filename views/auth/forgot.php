<main class="auth">
    <h2 class="auth__heading"> <?php echo $title; ?> </h2>
    <p class="auth__text">Recover your access to WebDevCamp</p>

    <?php
        require_once __DIR__ . '/../templates/alerts.php';
    ?>

    <form method="POST" action="/forgot" class="form">
        <div class="form__field">
            <label for="email" class="form__label">Email</label>
            <input class="form__input" type="email" placeholder="Your Email" id="email" name="email">
        </div> <!-- / .form__field -->
        <input type="submit" class="form__submit" value="Send Instructions">
    </form>

    <div class="actions">
        <a href="/login" class="actions__link">Already have an account? Login</a>
        <a href="/register" class="actions__link">Don't have an account? Register</a>
    </div>
</main>