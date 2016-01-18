function get_editor_wr_content()
{
    return $("#wr_content").summernote('code');
}

function put_editor_wr_content(content)
{
    $("#wr_content").summernote('code', content);
    return;
}
