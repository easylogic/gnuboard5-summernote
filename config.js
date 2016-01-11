(function ($) {
  $(document).ready(function () {
    $(".summernote").summernote({
      lang: 'ko-KR',
      height: 300,
      dialogsInBody : true,
      // toolbar
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview']],
        ['help', ['help']]
      ],
      onImageUpload: function (files) {
        var maxSize = 1 * 1024; 
        // TODO: implements insert image
        var isMaxSize = false; 
        var maxFile = null;
        for (var i = 0; i < files.length; i++) {
          if (files[i].size > maxSize) {
            isMaxSize = true;
            maxFile = files[i].name; 
            break;   
          }
          //sendFile(files[i], this);
        }

        if (isMaxSize) { // 사이즈 제한에 걸렸을 때 
           alert('[' + maxFile + '] 파일이 업로드 용량(1MB)을 초과하였습니다.');
        } else {
            for(var i = 0; i < files.length; i++) {
                sendFile(files[i], this);
            }
        }
      }
    });
  });
})(jQuery);
