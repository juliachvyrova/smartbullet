<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

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
                <?php echo $form->labelEx($model, 'first_name'); ?>
            </td>
            <td>
                <?php echo $form->textField($model, 'first_name', array('size' => 32, 'maxlength' => 32)); ?>
                <?php echo $form->error($model, 'first_name'); ?>
            </td>
        </tr>

        <tr>
            <td>
                <?php echo $form->labelEx($model, 'last_name'); ?>
            </td>
            <td>
                <?php echo $form->textField($model, 'last_name', array('size' => 32, 'maxlength' => 32)); ?>
                <?php echo $form->error($model, 'last_name'); ?>
            </td>
        </tr>

        <tr>
            <td>
                <?php echo $form->labelEx($model, 'brth2'); ?>
            </td>
            <td>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'brth2',
                    'model' => $model,
                    'attribute' => 'brth2',
                    'language' => 'ru',
                    'options' => array(
                        'showAnim' => 'fold',
                    ),
                    'htmlOptions' => array(
                        'style' => 'height:18px; width:232px;'
                    ),
                ));
                ?>
                <?php echo $form->error($model, 'brth2'); ?>
            </td>
        </tr>

        <tr>
            <td>
                <?php echo $form->labelEx($model, 'city'); ?>
            </td>
            <td>
                <?php echo $form->textField($model, 'city', array('size' => 32, 'maxlength' => 32)); ?>
                <?php echo $form->error($model, 'city'); ?>
            </td>
        </tr>

        <tr>
            <td>
                <?php echo $form->labelEx($model, 'email'); ?>
            </td>
            <td>
<?php echo $form->textField($model, 'email', array('size' => 32, 'maxlength' => 32)); ?>
<?php echo $form->error($model, 'email'); ?>
            </td>
        </tr>

        <tr>
            <td>
                <?php echo $form->labelEx($model, 'image'); ?>
            </td>
            <td>
<?php echo CHtml::activeFileField($model, 'image'); ?>
<?php echo $form->error($model, 'image'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $form->labelEx($model, 'delPhoto'); ?>
            </td>
            <td>
<?php echo $form->checkBox($model, 'delPhoto'); ?>
            </td>
        </tr>

        <tr>
            <td>
            </td>
            <td>


                <div class="row buttons">
<?php echo CHtml::submitButton($model->isNewRecord ? 'Зарегистрироваться' : 'Сохранить'); ?>
                </div>
            </td>
        </tr>
    </table>


<?php $this->endWidget(); ?>

</div><!-- form -->