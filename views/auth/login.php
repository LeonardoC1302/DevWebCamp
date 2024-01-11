<main class="auth">
    <h2 class="auth__heading"> <?php echo $title; ?> </h2>
    <p class="auth__text">Login to DevWebCamp</p>

    <?php
        require_once __DIR__ . '/../templates/alerts.php';
    ?>

    <form method="POST" action="/login" class="form">
        <div class="form__field">
            <label for="email" class="form__label">Email</label>
            <input class="form__input" type="email" placeholder="Your Email" id="email" name="email">
        </div> <!-- / .form__field -->
        <div class="form__field">
            <label for="password" class="form__label">Password</label>
            <input class="form__input" type="password" placeholder="Your Password" id="password" name="password">
        </div> <!-- / .form__field -->

        <input type="submit" class="form__submit" value="Log In">
    </form>

    <div class="actions">
        <a href="/register" class="actions__link">Don't have an account? Register</a>
        <a href="/forgot" class="actions__link">Forgot Password?</a>
    </div>
</main>