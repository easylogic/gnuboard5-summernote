# gnuboard5-summernote
그누보드5 를 위한 Summernote 에디터 플러그인 

bootstrap 을 사용하는 위지윅 에디터를 gnuboard 플러그인 형태로 구성하였습니다. 

# 플러그인 적용 

* 다운로드 : https://github.com/easylogic/gnuboard5-summernote/archive/master.zip
* git clone : https://github.com/easylogic/gnuboard5-summernote.git 

두가지 형태로 소스를 받은 후에 

gnuboard 의  `plugin/editor/` 디렉토리에 넣어주세요. 
 
# 플러그인 사용 

[관리자 모드 > 환경 설정 > 기본 환경 설정] 메뉴의   [홈페이지 기본환경 설정 >  에디터 선택] 에서 summernote 를 선택해주세요. 


# auto save 적용하기 

* gnuboard v5.1.2 부터는 auto  save 설정없이 사용하실 수 있습니다. 
* 그 이하 버전에서는 아래 절차를 따라 주세요. 

auto save 를 적용 하기 위해서는 하드 코딩이 필요합니다. 

일단 /js/autosave.js 를 열어서 아래 2가지를 추가 해주세요. 

```javascript
function autosave () {
    ... 
      // summernote data 설정 
      } else if (g5_editor.indexOf("summernote") != -1 ) {
            this.wr_content.value = $("#wr_content").code();
     }
   ...
}

// autosave 내용 로드 
 $(document).on( "click", ".autosave_load", function(){
    ... 
     // summernote 내용 로드 
     } else if (g5_editor.indexOf("summernote") != -1 ) {
                $("#wr_content").code(content);
     }
     ... 
}

```
