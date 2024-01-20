<h2 class="dashboard__heading"><?php echo $title; ?></h2>

<main class="blocks">
    <div class="blocks__grid">
        <div class="block">
            <h3 class="block__heading">Last Registers</h3>

            <?php foreach($registers as $register): ?>
                <div class="block__content">
                    <p class="block__text"><?php echo $register->user->name . " " . $register->user->lastName . ' - ' . $register->package->name; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="block">
            <h3 class="block__heading">Total Revenue</h3>
            <p class="block__text--amount">$<?php echo $revenue; ?></p>
        </div>

        <div class="block">
            <h3 class="block__heading">Events With Fewer Spaces Available</h3>
            <?php foreach($less_available as $event): ?>
                <div class="block__content">
                    <p class="block__text"><?php echo $event->name . ' - ' . $event->availables . ' Available'; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="block">
            <h3 class="block__heading">Events With More Spaces Available</h3>
            <?php foreach($more_available as $event): ?>
                <div class="block__content">
                    <p class="block__text"><?php echo $event->name . ' - ' . $event->availables . ' Available'; ?></p>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</main>