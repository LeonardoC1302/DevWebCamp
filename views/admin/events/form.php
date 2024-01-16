<fieldset class="form__fieldset">
    <legend class="form__legend">Event Information</legend>

    <div class="form__field">
        <label for="name" class="form__label">Event Name</label>
        <input class="form__input" type="text" id="name" name="name" placeholder="Event's name" value="<?php echo $event->name; ?>">
    </div> <!-- /field -->

    <div class="form__field">
        <label for="description" class="form__label">Description</label>
        <textarea class="form__input" type="text" id="description" name="description" placeholder="Event's description" rows="8"><?php echo $event->description; ?></textarea>
    </div> <!-- /field -->

    <div class="form__field">
        <label for="category" class="form__label">Category</label>
        <select class="form__select" id="category" name="categoryId">
            <option value="">-- Choose a Category --</option>
            <?php foreach ($categories as $category): ?>
                <option <?php echo ($event->categoryId === $category->id) ? 'selected' : '' ?> value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
            <?php endforeach; ?>
        </select>
    </div> <!-- /field -->

    <div class="form__field">
        <label for="category" class="form__label">Day of the Event</label>
        <div class="form__radio">
            <?php foreach ($days as $day): ?>
                <div>
                    <input type="radio" id="<?php strtolower($day->name);?>" name="day" value="<?php echo $day->id; ?>" <?php echo ($event->dayId ===$day->id) ? 'checked' : ''; ?>>
                    <label for="<?php strtolower($day->name);?>"><?php echo $day->name; ?></label>
                </div>
            <?php endforeach; ?>
        </div>
        <input type="hidden" name="dayId" value="<?php echo $event->dayId; ?>">
    </div> <!-- /field -->

    <div id="hours" class="form__field">
        <label class="form__label">Hour of the Event</label>

        <ul id="hours" class="hours">
            <?php foreach($hours as $hour): ?>
                <li data-hourId="<?php echo $hour->id; ?>" class="hours__hour hours__hour--disabled"><?php echo $hour->hour; ?></li>
            <?php endforeach; ?>
        </ul>
        <input type="hidden" name="hourId" value="<?php echo $event->hourId; ?>">
    </div> <!-- /field -->

</fieldset>

<fieldset class="form__fieldset">
    <legend class="form__legend">Additional Information</legend>

    <div class="form__field">
        <label for="speakers" class="form__label">Speaker</label>
        <input class="form__input" type="text" id="speakers" placeholder="Search Speaker">
        <ul class="speakers-list" id="speakers-list"></ul>
        <input type="hidden" name="speakerId" value="<?php echo $event->speakerId; ?>">
    </div> <!-- /field -->

    <div class="form__field">
        <label for="availables" class="form__label">Available Spaces</label>
        <input class="form__input" type="number" id="availables" min="1" placeholder="E.g. 20" name="availables" value="<?php echo $event->availables; ?>">
    </div> <!-- /field -->

</fieldset>