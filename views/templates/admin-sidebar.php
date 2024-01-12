<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/admin/dashboard" class="dashboard__link <?php echo current_page('/dashboard') ? 'dashboard__link--current' : ''?>">
            <i class="fa-solid fa-house dashboard__icon"></i>
            <span class="dashboard__menu-text">Home</span>
        </a> <!-- /.dashboard__link -->

        <a href="/admin/speakers" class="dashboard__link <?php echo current_page('/speakers') ? 'dashboard__link--current' : ''?>">
            <i class="fa-solid fa-microphone dashboard__icon"></i>
            <span class="dashboard__menu-text">Speakers</span>
        </a> <!-- /.dashboard__link -->

        <a href="/admin/events" class="dashboard__link <?php echo current_page('/events') ? 'dashboard__link--current' : ''?>">
            <i class="fa-solid fa-calendar dashboard__icon"></i>
            <span class="dashboard__menu-text">Events</span>
        </a> <!-- /.dashboard__link -->

        <a href="/admin/users" class="dashboard__link <?php echo current_page('/users') ? 'dashboard__link--current' : ''?>">
            <i class="fa-solid fa-user dashboard__icon"></i>
            <span class="dashboard__menu-text">Users</span>
        </a> <!-- /.dashboard__link -->

        <a href="/admin/gifts" class="dashboard__link <?php echo current_page('/gifts') ? 'dashboard__link--current' : ''?>">
            <i class="fa-solid fa-gift dashboard__icon"></i>
            <span class="dashboard__menu-text">Gifts</span>
        </a> <!-- /.dashboard__link -->
    </nav>
</aside>