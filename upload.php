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
	$mime_result = ' '.@mime_content_type($tmp_name).@shell_exec('file -bi '. $tmp_name);

	
	// thanks to @dewoweb 
	if (!preg_match("/(jpe?g|gif|bmp|png)$/i", $filename_ext)) {   // check file extension 
		// error
		@unlink($tmp_name);
        echo json_encode(array('success' => false, 'error' => 100)); // file type error 
	} else if ( !stripos($mime_result, 'jpeg') &&							// check file mime-type 
		!stripos($mime_result, 'jpg') &&
		!stripos($mime_result, 'gif') &&
		!stripos($mime_result, 'bmp') &&
		!stripos($mime_result, 'png') ) {
		@unlink($tmp_name);
		echo json_encode(array('success'=> false, 'error' => 101));
	} else if (!getimagesize($tmp_name)) {								// check file size, if filesize is zero, return fail 
		@unlink($tmp_name);
		echo json_encode(array('success'=> false, 'error' => 102));
	} else {
		
        $file_name = sprintf('%u', ip2long($_SERVER['REMOTE_ADDR'])).'_'.get_microtime().".".$filename_ext;
		$save_dir = sprintf('%s/%s', $data_dir, $file_name);
        $save_url = sprintf('%s/%s', $data_url, $file_name);
		
		@move_uploaded_file($tmp_name, $save_dir);

		echo json_encode(array('success' => true, 'save_url' => $save_url ));
	}
} else {
    $error = $_FILES['SummernoteFile']['error'];

    // refer to error code : http://www.php.net/manual/en/features.file-upload.errors.php
    // example)  1 is error for upload_max_filesize 
    echo json_encode(array('success'=> false, 'error' => $error));
}
?>
