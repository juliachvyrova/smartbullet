<?php

class DataHelper{
	static function writeAt($str)
	{
		$time=strtotime($str); 
		return date("d.m.Y в H:i",$time);
	}

	static function writeData($str)
	{
		$data=strtotime($str); 
		return date("d.m.Y",$data);
	}
}