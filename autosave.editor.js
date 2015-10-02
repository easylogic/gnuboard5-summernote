function get_editor_wr_content()
{
    return $("#wr_content").code();
}

function put_editor_wr_content(content)
{
    $("#wr_content").code(content);
    return;
}
