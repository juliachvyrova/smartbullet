

<style>
    .post{
        margin: 0 auto;
        border: 1px solid black;
        width: 90%;
        padding: 10px;
        margin-top: 15px;
    }
</style>

<?php
foreach ($post as $p):
    ?>

<div class="post">
    <strong>
    <?php echo $p->user->login;?>
    </strong><br>

    <?php echo $p->text;?><br>
    <hr>
</div>
<?php endforeach; ?>

