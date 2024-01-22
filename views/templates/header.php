<header class="header">
    <div class="header__container">
        <nav class="header__nav">
            <?php if(isAuth()) { ?>
                <a href="<?php echo isAdmin() ? '/admin/dashboard' : 'finish-registration'; ?>" class="header__link">Manage</a>
                <form method="POST" action="/logout" class="header__form">
                    <input type="submit" value="Log Out" class="header__submit">
                </form>
            <?php } else { ?>
                <a href="/register" class="header__link">Register</a>
                <a href="/login" class="header__link">Login</a>
            <?php } ?>
        </nav>

        <div class="header__content">
            <a href="/">
                <h1 class="header__logo">
                    &#60;DevWebCamp/>
                </h1>
            </a>
            <p class="header__text">October 5th-6th - 2024</p>
            <p class="header__text header__text--mode">Online - In-Person</p>
            <a href="<?php echo ($_SESSION['id'] == null ? '/register' : '/finish-registration'); ?>" class="header__button">Buy Pass</a>
        </div>
    </div>
</header>
<div class="bar">
    <div class="bar__content">
        <a href="/"><h2 class="bar__logo">&#60;DevWebCamp/></h2></a>
        <nav class="navigation">
            <a href="/devwebcamp" class="navigation__link <?php echo current_page('/devwebcamp') ? 'navigation__link--current' : ''; ?>">Events</a>
            <a href="/packages" class="navigation__link <?php echo current_page('/packages') ? 'navigation__link--current' : ''; ?>">Packages</a>
            <a href="/workshops-conferences" class="navigation__link <?php echo current_page('/workshops-conferences') ? 'navigation__link--current' : ''; ?>">Workshops / Conferences</a>
            <a href="/register" class="navigation__link <?php echo current_page('/register') ? 'navigation__link--current' : ''; ?>">Buy Pass</a>
        </nav>
    </div>
</div>