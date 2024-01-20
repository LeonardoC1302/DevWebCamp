<h2 class="dashboard__heading"><?php echo $title; ?></h2>

<div class="dashboard__container">
    <?php if(!empty($registers)){ ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Name</th>
                    <th scope="col" class="table__th">Email</th>
                    <th scope="col" class="table__th">Plan</th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php foreach($registers as $register){ ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $register->user->name . " " . $register->user->lastName; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $register->user->email; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $register->package->name; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">No Registers Yet</p>
    <?php } ?>
</div>

<?php echo $pagination; ?>