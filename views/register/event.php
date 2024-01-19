<div class="event">
    <p class="event__hour"><?php echo $event->hour->hour; ?></p>
    <div class="event__info">
        <h4 class="event__name"><?php echo $event->name; ?></h4>
        <p class="event__introduction"><?php echo $event->description; ?></p>

        <div class="event__author-info">
            <picture>
                <source srcset="<?php echo $_ENV['HOST']; ?>/img/speakers/<?php echo $event->speaker->image;?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST']; ?>/img/speakers/<?php echo $event->speaker->image;?>.png" type="image/png">

                <img class="event__author-image" loading="lazy" width="200" height="300" src="img/speakers/<?php echo $event->speaker->image;?>.png" alt="Speaker Image">
            </picture>

            <p class="event__author-name"><?php echo $event->speaker->name . " " . $event->speaker->lastName; ?></p>
        </div>

        <button type="button" data-id="<?php echo $event->id; ?>" class="event__add" <?php echo ($event->availables === "0") ? 'disabled' : ''; ?>>
            <?php echo ($event->availables === "0") ? 'Sold Out' : 'Select - ' . $event->availables . ' Available' ?>
        </button>
    </div>
</div>