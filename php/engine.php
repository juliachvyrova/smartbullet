<?php
$str='';
$str .= $_POST['value'] . ' ';
$str .= $_POST['select'];
echo json_encode(array(
                'result' => $str,
));

