<main class="auth">
    <h2 class="auth__heading"> <?php echo $title; ?> </h2>
    <p class="auth__text">Set a new password</p>

    <?php
        require_once __DIR__ . '/../templates/alerts.php';
    ?>
    <?php if($validToken) { ?>
        <form method="POST" class="form">
            <div class="form__field">
                <label for="password" class="form__label">New Password</label>
                <input class="form__input" type="password" placeholder="Your New Password" id="password" name="password">
            </div> <!-- / .form__field -->
            <input type="submit" class="form__submit" value="Save Password">
        </form>
    <?php } ?>

    <div class="actions">
        <a href="/login" class="actions__link">Already have an account? Login</a>
        <a href="/register" class="actions__link">Don't have an account? Register</a>
    </div>

</main>