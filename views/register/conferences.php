<h2 class="page__heading"><?php echo $title; ?></h2>
<p class="page__description">Choose up to 5 events you want to attend in person.</p>

<div class="register-events">
    <main class="register-events__list">
        <h3 class="register-events__heading--conferences">&lt;Conferences /></h3>

        <p class="register-events__date">Friday, October 5th</p>
        <div class="register-events__grid">
            <?php foreach($events['conferences_f'] as $event){ ?>
                <?php include __DIR__ . '/event.php'; ?>
                <?php } ?>
            </div>
            
        <p class="register-events__date">Saturday, October 6th</p>
        <div class="register-events__grid">
            <?php foreach($events['conferences_s'] as $event){ ?>
                <?php include __DIR__ . '/event.php'; ?>
            <?php } ?>
        </div>

        <h3 class="register-events__heading--workshops">&lt;Workshops /></h3>

        <p class="register-events__date">Friday, October 5th</p>
        <div class="register-events__grid events--workshops">
            <?php foreach($events['workshops_f'] as $event){ ?>
                <?php include __DIR__ . '/event.php'; ?>
                <?php } ?>
            </div>
        <p class="register-events__date">Saturday, October 6th</p>
        <div class="register-events__grid events--workshops">
            <?php foreach($events['workshops_s'] as $event){ ?>
                <?php include __DIR__ . '/event.php'; ?>
            <?php } ?>
        </div>
    </main>

    <aside class="register">
        <h2 class="register__heading">Your Record</h2>
        <div class="register__summary" id="register-summary"></div>

        <div class="register__gift">
            <label for="gift" class="register__label">Choose a Gift</label>
            <select id="gift" class="register__select">
                <option value="">-- Select your gift --</option>
                <?php foreach($gifts as $gift){ ?>
                    <option value="<?php echo $gift->id; ?>"><?php echo $gift->name; ?></option>
                <?php } ?>
            </select>
        </div>

        <form class="form" id="register">
            <div class="form__field">
                <input type="submit" class="form__submit form__submit--full" value="Register">
            </div>
        </form>
    </aside>

</div>