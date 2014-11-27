
<nav>
    <a href="<?php echo Yii::app()->createUrl("user/update"); ?>"> Редактировать информацию </a>
    <a href="<?php echo Yii::app()->createUrl("user/changePass"); ?>"> Изменить пароль</a>
</nav>
<h1>Изменение пароля</h1>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <table class="registration" >


        <tr>
            <td>
                <?php echo $form->labelEx($model, 'password2'); ?>
            </td>
            <td>
                <?php echo $form->passwordField($model, 'password2', array('size' => 32, 'maxlength' => 40)); ?>
                <?php echo $form->error($model, 'password2'); ?>
            </td>
        </tr>

        <tr>
            <td>
                <?php echo $form->labelEx($model, 'password3'); ?>
            </td>
            <td>
                <?php echo $form->passwordField($model, 'password3', array('size' => 32, 'maxlength' => 40)); ?>
                <?php echo $form->error($model, 'password3'); ?>
            </td>
        </tr>

        <tr>
            <td>
            </td>
            <td>


                <div class="row buttons">
<?php echo CHtml::submitButton('Сохранить'); ?>
                </div>
            </td>
        </tr>
    </table>


<?php $this->endWidget(); ?>

</div><!-- form -->