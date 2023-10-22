<main class="auth">
    <h2 class="auth__heading"> <?php echo $title; ?> </h2>
    <p class="auth__text">Register into WebDevCamp</p>

    <form class="form">
        <div class="form__field">
            <label for="name" class="form__label">Name</label>
            <input class="form__input" type="text" placeholder="Your Name" id="name" name="name">
        </div> <!-- / .form__field -->
        <div class="form__field">
            <label for="lastName" class="form__label">Last Name</label>
            <input class="form__input" type="text" placeholder="Your last name" id="lastName" name="lastName">
        </div> <!-- / .form__field -->
        <div class="form__field">
            <label for="email" class="form__label">Email</label>
            <input class="form__input" type="email" placeholder="Your Email" id="email" name="email">
        </div> <!-- / .form__field -->
        <div class="form__field">
            <label for="password" class="form__label">Password</label>
            <input class="form__input" type="password" placeholder="Your Password" id="password" name="password">
        </div> <!-- / .form__field -->
        <div class="form__field">
            <label for="password2" class="form__label">Confirm Password</label>
            <input class="form__input" type="password" placeholder="Confirm Password" id="password2" name="password2">
        </div> <!-- / .form__field -->

        <input type="submit" class="form__submit" value="Create Account">
    </form>

    <div class="actions">
        <a href="/login" class="actions__link">Already have an account? Login</a>
        <a href="/forgot" class="actions__link">Forgot Password?</a>
    </div>
</main>