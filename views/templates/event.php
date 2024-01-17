<div class="event swiper-slide">
    <p class="event__hour"><?php echo $event->hour->hour; ?></p>
    <div class="event__info">
        <h4 class="event__name"><?php echo $event->name; ?></h4>
        <p class="event__introduction"><?php echo $event->description; ?></p>

        <div class="event__author-info">
            <picture>
                <source srcset="img/speakers/<?php echo $event->speaker->image;?>.webp" type="image/webp">
                <source srcset="img/speakers/<?php echo $event->speaker->image;?>.png" type="image/png">

                <img class="event__author-image" loading="lazy" width="200" height="300" src="img/speakers/<?php echo $event->speaker->image;?>.png" alt="Speaker Image">
            </picture>

            <p class="event__author-name"><?php echo $event->speaker->name . " " . $event->speaker->lastName; ?></p>
        </div>
    </div>
</div>