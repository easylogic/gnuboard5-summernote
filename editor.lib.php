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

        ob_start();
?>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo $editor_url ?>/summernote/summernote.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
<script src="<?php echo $editor_url ?>/summernote/summernote.min.js"></script>
<script src="<?php echo $editor_url ?>/summernote/lang/summernote-ko-KR.js"></script>
<script type="text/javascript">

function sendFile(file, editor) {

    data = new FormData();
    data.append("SummernoteFile", file);
    $.ajax({
       data: data,
       type: "POST",
       url: "<?php echo $editor_url ?>/upload.php",
       cache: false,
       contentType: false,
       processData: false,
       success: function(data) {
         var obj =  JSON.parse(data);
         if (obj.success) {
             $(editor).summernote("insertImage", obj.save_url);
         } else {
            switch(obj.error) {
                case 1: alert('업로드 용량 제한에 걸렸습니다.'); break; 
            }
         }
       }
   });
}

</script>
<script src="<?php echo $editor_url ?>/config.js"></script>

<?php       
        $html .= ob_get_contents();
        ob_end_clean();

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
        return "var {$id}_editor_data = $('#{$id}').summernote('code');";
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
