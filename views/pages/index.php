<?php 
    include_once __DIR__ . '/conferences.php'; 
?>

<section class="summary">
    <div class="summary__grid">
        <div class="summary__block">
            <p class="summary__text summary__text--number"><?php echo $speakers; ?></p>
            <p class="summary__text">Speakers</p>
        </div> <!-- .summary__block -->

        <div class="summary__block">
            <p class="summary__text summary__text--number"><?php echo $conferences; ?></p>
            <p class="summary__text">Conferences</p>
        </div> <!-- .summary__block -->

        <div class="summary__block">
            <p class="summary__text summary__text--number"><?php echo $workshops; ?></p>
            <p class="summary__text">Workshops</p>
        </div> <!-- .summary__block -->

        <div class="summary__block">
            <p class="summary__text summary__text--number">500</p>
            <p class="summary__text">Assistants</p>
        </div> <!-- .summary__block -->
    </div>
</section>