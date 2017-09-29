<?
include_once($_SERVER['DOCUMENT_ROOT'] ."/lib/lib.php");

if($uid = user::secure() and is_file($_FILES['filedata']['tmp_name'])){

	$img_obj = new SimpleImage();
	if(!$menu_tumb_width)$menu_tumb_width = 200;
	
	$img_obj->load($_FILES['filedata']['tmp_name'])->crop(700)->desaturate()->save($_SERVER['DOCUMENT_ROOT'] . "/photos/big/$uid.jpg")->crop(250)->save($_SERVER['DOCUMENT_ROOT'] . "/photos/small/$uid.jpg");
	
}
?>