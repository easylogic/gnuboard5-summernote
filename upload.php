<?php
include "./_common.php";


$isUpload = is_uploaded_file($_FILES['SummernoteFile']['tmp_name']);
// SUCCESSFUL
if($isUpload) {
    $ym = date('ym', G5_SERVER_TIME);

    $data_dir = G5_DATA_PATH.'/editor/'.$ym;
    $data_url = G5_DATA_URL.'/editor/'.$ym;

    @mkdir($data_dir, G5_DIR_PERMISSION);
    @chmod($data_dir, G5_DIR_PERMISSION);

	$tmp_name = $_FILES['SummernoteFile']['tmp_name'];
	$name = $_FILES['SummernoteFile']['name'];
	
	$filename_ext = strtolower(array_pop(explode('.',$name)));

	
	if (!preg_match("/(jpe?g|gif|bmp|png)$/i", $filename_ext)) {
		// error
        echo 'fail';
	} else {
		
        $file_name = sprintf('%u', ip2long($_SERVER['REMOTE_ADDR'])).'_'.get_microtime().".".$filename_ext;
		$save_dir = sprintf('%s/%s', $data_dir, $file_name);
        $save_url = sprintf('%s/%s', $data_url, $file_name);
		
		@move_uploaded_file($tmp_name, $save_dir);

		echo $save_url;
	}
}
?>
