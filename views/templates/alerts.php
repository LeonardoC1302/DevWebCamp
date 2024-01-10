<?php
    foreach ($alerts as $key => $alert) {
        foreach($alert as $msg){
?>
    <div class="alert alert--<?php echo $key; ?>"><?php echo $msg; ?></div>
<?php
        }
    } 
?>