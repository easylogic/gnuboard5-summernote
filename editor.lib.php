<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

function editor_html($id, $content, $is_dhtml_editor=true)
{
    global $g5, $config;
    static $js = true;

    $editor_url = G5_EDITOR_URL.'/'.$config['cf_editor'];

    $html = "";
    $html .= "<span class=\"sound_only\">Summernote 시작</span>";

	if ($is_dhtml_editor && $js) {
		$html .= "\n".'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">';
		$html .= "\n".'<link rel="stylesheet" href="'.$editor_url.'/summernote/summernote.css">';
		$html .= "\n".'<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />';	
        $html .= "\n".'<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>';
        $html .= "\n".'<script src="'.$editor_url.'/summernote/summernote.min.js"></script>';
        $html .= "\n".'<script src="'.$editor_url.'/summernote/plugin/summernote-ext-video.js"></script>';
        $html .= "\n".'<script src="'.$editor_url.'/suumernote/lang/summernote-ko-KR.js"></script>';
		$html .= "\n".'<script>';

		$html .= "\n".'function sendFile(file, editor) {';
		$html .= "\n".'';
        $html .= "\n".'    data = new FormData();';
        $html .= "\n".'    data.append("file", file);';
        $html .= "\n".'    $.ajax({';
        $html .= "\n".'        data: data,';
        $html .= "\n".'       type: "POST",';
        $html .= "\n".'        url: "'.$editor_url.'/upload.php",';
        $html .= "\n".'        cache: false,';
        $html .= "\n".'        contentType: false,';
        $html .= "\n".'        processData: false,';
        $html .= "\n".'        success: function(url) {';
        $html .= "\n".'            $(editor).summernote("insertImage", url);';
        $html .= "\n".'        }';
        $html .= "\n".'    });';
        $html .= "\n".'}';

		$html .= "\n".'</script>';
        $html .= "\n".'<script src="'.$editor_url.'/config.js"></script>';
        $js = false;
    }

    $summernote_class = $is_dhtml_editor ? "summernote" : "";
    $html .= "\n<textarea id=\"$id\" name=\"$id\" class=\"$summernote_class\" >$content</textarea>";
    $html .= "\n<span class=\"sound_only\">Summernote 끝</span>";
    return $html;
}


// textarea 로 값을 넘긴다. javascript 반드시 필요
function get_editor_js($id, $is_dhtml_editor=true)
{
    if ($is_dhtml_editor) {
        return "var {$id}_editor_data = $('#{$id}').code();";
    } else {
        return "var {$id}_editor = document.getElementById('{$id}');\n";
    }
}


//  textarea 의 값이 비어 있는지 검사
function chk_editor_js($id, $is_dhtml_editor=true)
{
    if ($is_dhtml_editor) {
        return "if (!{$id}_editor_data) { alert(\"내용을 입력해 주십시오.\"); $('#{$id}').summernote('focus'); return false; }\n";
    } else {
        return "if (!{$id}_editor.value) { alert(\"내용을 입력해 주십시오.\"); {$id}_editor.focus(); return false; }\n";
    }
}
?>