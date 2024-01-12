<fieldset class="form__fieldset">
    <legend class="form__legend">Personal Information</legend>

    <div class="form__field">
        <label for="name" class="form__label">Name</label>
        <input class="form__input" type="text" id="name" name="name" placeholder="Speaker's Name" value="<?php echo $speaker->name ?? ''; ?>">
    </div> <!-- /field -->

    <div class="form__field">
        <label for="lastName" class="form__label">Last Name</label>
        <input class="form__input" type="text" id="lastName" name="lastName" placeholder="Speaker's Last Name" value="<?php echo $speaker->lastName ?? ''; ?>">
    </div> <!-- /field -->

    <div class="form__field">
        <label for="city" class="form__label">City</label>
        <input class="form__input" type="text" id="city" name="city" placeholder="Speaker's City'" value="<?php echo $speaker->city ?? ''; ?>">
    </div> <!-- /field -->

    <div class="form__field">
        <label for="country" class="form__label">Country</label>
        <input class="form__input" type="text" id="country" name="country" placeholder="Speaker's Country" value="<?php echo $speaker->country ?? ''; ?>">
    </div> <!-- /field -->

    <div class="form__field">
        <label for="image" class="form__label">Profile Picture</label>
        <input class="form__input form__input--file" type="file" id="image" name="image">
    </div> <!-- /field -->
</fieldset>

<fieldset class="form__fieldset">
    <legend class="form__legend">Additional Information</legend>

    <div class="form__field">
        <label for="tags__input" class="form__label">Top Skills (Separated By Commas)</label>
        <input class="form__input" type="text" id="tags__input" placeholder="E.g. Node.js, PHP, Laravel, CSS, UX / UI">

        <div id="tags" class="form__list"></div>
        <input type="hidden" name="tags" value="<?php echo $speaker->tags ?? ''; ?>">
    </div> <!-- /field -->
</fieldset>

<fieldset class="form__fieldset">
    <legend class="form__legend">Social Media</legend>

    <div class="form__field">
        <div class="form__container-icon">
            <div class="form__icon">
                <i class="fa-brands fa-facebook"></i>
            </div>
            <input class="form__input--socials" type="text" name="socials[facebook]" placeholder="Facebook" value="<?php echo $speaker->facebook ?? ''; ?>">
        </div>
    </div> <!-- /field -->

    <div class="form__field">
        <div class="form__container-icon">
            <div class="form__icon">
                <i class="fa-brands fa-twitter"></i>
            </div>
            <input class="form__input--socials" type="text" name="socials[twitter]" placeholder="Twitter" value="<?php echo $speaker->twitter ?? ''; ?>">
        </div>
    </div> <!-- /field -->

    <div class="form__field">
        <div class="form__container-icon">
            <div class="form__icon">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input class="form__input--socials" type="text" name="socials[youtube]" placeholder="Youtube" value="<?php echo $speaker->youtube ?? ''; ?>">
        </div>
    </div> <!-- /field -->

    <div class="form__field">
        <div class="form__container-icon">
            <div class="form__icon">
                <i class="fa-brands fa-instagram"></i>
            </div>
            <input class="form__input--socials" type="text" name="socials[instagram]" placeholder="Instagram" value="<?php echo $speaker->instagram ?? ''; ?>">
        </div>
    </div> <!-- /field -->

    <div class="form__field">
        <div class="form__container-icon">
            <div class="form__icon">
                <i class="fa-brands fa-tiktok"></i>
            </div>
            <input class="form__input--socials" type="text" name="socials[tiktok]" placeholder="TikTok" value="<?php echo $speaker->tiktok ?? ''; ?>">
        </div>
    </div> <!-- /field -->

    <div class="form__field">
        <div class="form__container-icon">
            <div class="form__icon">
                <i class="fa-brands fa-github"></i>
            </div>
            <input class="form__input--socials" type="text" name="socials[github]" placeholder="GitHub" value="<?php echo $speaker->github ?? ''; ?>">
        </div>
    </div> <!-- /field -->

</fieldset>