<?php
foreach ($comments as $c):
   
    if($c->post_id==$id_post)
    ?>

<div>
    <strong>
    <?php echo $c->author_id;?>
    </strong><br>

    <?php echo $c->text;?><br>
    <hr>
</div>
<?php endforeach; ?>