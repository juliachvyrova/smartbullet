<ul>
    
    <?php if($data->game_status == 0): ?>
     <b><?php echo CHtml::encode($data->getAttributeLabel('id')) ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)) ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('game_status')) ?>:</b>
	<?php echo CHtml::encode($data->game_status) ?>
	<br />
   <?php endif; ?>
    
</ul>
