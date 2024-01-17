<?php 
    include_once __DIR__ . '/conferences.php'; 
?>

<section class="summary">
    <div class="summary__grid">
        <div class="summary__block">
            <p class="summary__text summary__text--number"><?php echo $totalSpeakers; ?></p>
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

<section class="speakers">
    <h2 class="speakers__heading">Speakers</h2>
    <p class="speakers__description">Meet Our DevWebCamp Experts</p>

    <div class="speakers__grid">
        <?php foreach($speakers as $speaker) { ?>
            <div class="speaker">
                <picture>
                    <source srcset="img/speakers/<?php echo $speaker->image;?>.webp" type="image/webp">
                    <source srcset="img/speakers/<?php echo $speaker->image;?>.png" type="image/png">
    
                    <img class="speaker__image" loading="lazy" width="200" height="300" src="img/speakers/<?php echo $speaker->image;?>.png" alt="Speaker Image">
                </picture>
                <div class="speaker__info">
                    <h4 class="speaker__name"><?php echo $speaker->name . " " . $speaker->lastName; ?></h4>
                    <p class="speaker__location"><?php echo $speaker->city . ", " . $speaker->country; ?></p>
    
                    <nav class="speaker-socials">
                        <?php $socials = json_decode($speaker->socials); ?>
                        <?php if(!empty($socials->facebook)) { ?>
                            <a class="speaker-socials__link" rel="noopener noreferrer" target="_blank" href="<?php echo $socials->facebook; ?>">
                                <span class="speaker-socials__hide">Facebook</span>
                            </a>
                        <?php } ?>
    
                        <?php if(!empty($socials->twitter)) { ?>
                            <a class="speaker-socials__link" rel="noopener noreferrer" target="_blank" href="<?php echo $socials->twitter; ?>">
                                <span class="speaker-socials__hide">Twitter</span>
                            </a>
                        <?php } ?> 
                        
                        <?php if(!empty($socials->youtube)) { ?>
                            <a class="speaker-socials__link" rel="noopener noreferrer" target="_blank" href="<?php echo $socials->youtube; ?>">
                                <span class="speaker-socials__hide">YouTube</span>
                            </a>
                        <?php } ?>
    
                        <?php if(!empty($socials->instagram)) { ?>
                            <a class="speaker-socials__link" rel="noopener noreferrer" target="_blank" href="<?php echo $socials->instagram; ?>">
                                <span class="speaker-socials__hide">Instagram</span>
                            </a>
                        <?php } ?> 
    
                        <?php if(!empty($socials->tiktok)) { ?>
                            <a class="speaker-socials__link" rel="noopener noreferrer" target="_blank" href="<?php echo $socials->tiktok; ?>">
                                <span class="speaker-socials__hide">TikTok</span>
                            </a>
                        <?php } ?> 
                        
                        <?php if(!empty($socials->github)) { ?>
                            <a class="speaker-socials__link" rel="noopener noreferrer" target="_blank" href="<?php echo $socials->github; ?>">
                                <span class="speaker-socials__hide">GitHub</span>
                            </a>
                        <?php } ?>
                    </nav>
    
                    <ul class="speaker__skills">
                        <?php
                            $tags = explode(",", $speaker->tags);
                            foreach($tags as $tag){ 
                        ?>
                                <li class="speaker__skill"><?php echo $tag; ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        <?php } ?>
    </div>
</section>