(function ($) {
  $(document).ready(function () {
    $(".summernote").summernote({
      lang: 'ko-KR',
      height: 300,
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

        // TODO: implements insert image
        for (var i = 0; i < files.length; i++) {
          sendFile(files[i], this);
        }
      }
    });


  });
})(jQuery);