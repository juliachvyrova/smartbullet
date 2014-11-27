<?php

class Smiles{


    public static function codeToImg($text)
	{	 
		$location=$location=Yii::app()->baseUrl."/images/smiles/";
		$typeSmile= array(':)',':(',':D',':P',':x',':*','*sleep*','*angry*','XD','._.',';)','B)');
	 	$imgSmile=array('smile.png','sad.png','happy.png','tongue_happy.png','silence.png','kiss.png','sleep.png','angry.png','laugh.png','hm.png','ok.png','glas.png');
	    for ($i=0; $i<count($typeSmile);$i++)
	    {
	        $text=str_replace($typeSmile[$i],'<img class=smile src='.$location.$imgSmile[$i]." />", $text);      
	    }
	    return $text;
	}

	public static function show($textFild)
	{	 
		$text="";
		$location=$location=Yii::app()->baseUrl."../images/smiles/";
		$typeSmile= array(':)',':(',':D',':P',':x',':*','*sleep*','*angry*','XD','._.',';)','B)');
	 	$imgSmile=array('smile.png','sad.png','happy.png','tongue_happy.png','silence.png','kiss.png','sleep.png','angry.png','laugh.png','hm.png','ok.png','glas.png');
	    for ($i=0; $i<count($imgSmile);$i++)
	    {
	        $text.=' <img class=smile2 src='.$location.$imgSmile[$i]." onclick=writeSmile('".$typeSmile[$i]."',"."'".$textFild."'".") /> ";      
	    }
	    return $text;
	}
}
