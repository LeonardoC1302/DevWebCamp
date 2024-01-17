<main class="schedule">
    <h2 class="schedule__heading">Workshops & Conferences</h2>
    <p class="schedule__description">Workshops and Conferences given by experts in web development</p>

    <div class="events">
        <h3 class="events__heading">&lt;Conferences /></h3>
        <p class="events__date">Friday, October 5th</p>
        <div class="events__list slider swiper">
            <div class="swiper-wrapper">
                <?php foreach($events['conferences_f'] as $event){ ?>
                    <?php include __DIR__ . '../../templates/event.php'; ?>
                <?php } ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <p class="events__date">Saturday, October 6th</p>
        <div class="events__list slider swiper">
            <div class="swiper-wrapper">
                <?php foreach($events['conferences_s'] as $event){ ?>
                    <?php include __DIR__ . '../../templates/event.php'; ?>
                <?php } ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div> <!-- .events -->

    <div class="events events--workshops">
        <h3 class="events__heading">&lt;Workshops /></h3>
        <p class="events__date">Friday, October 5th</p>
        <div class="events__list slider swiper">
            <div class="swiper-wrapper">
                <?php foreach($events['workshops_f'] as $event){ ?>
                    <?php include __DIR__ . '../../templates/event.php'; ?>
                <?php } ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <p class="events__date">Saturday, October 6th</p>
        <div class="events__list slider swiper">
            <div class="swiper-wrapper">
                <?php foreach($events['workshops_s'] as $event){ ?>
                    <?php include __DIR__ . '../../templates/event.php'; ?>
                <?php } ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div> <!-- .events -->
</main>