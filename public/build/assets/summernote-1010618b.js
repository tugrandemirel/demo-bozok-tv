$(document).ready(function(){$(".summernote").summernote({lang:"tr-TR",minHeight:200,toolbar:[["style",["style"]],["font",["bold","italic","underline","clear"]],["color",["color"]],["para",["ul","ol","paragraph"]],["table",["table"]],["insert",["link","picture","hr","codeview","video"]],["view",["fullscreen","help"]]],styleTags:["p","h1","h2","h3","h4","h5","h6","pre","blockquote"],codemirror:{lineNumbers:!0,theme:"monokai"},tableClassName:"table table-bordered table-striped",callbacks:{onPaste:function(t){for(var l=t.originalEvent.clipboardData,n=l.items,a=0;a<n.length;a++){var i=n[a];if(i.type.indexOf("image")===0){var s=i.getAsFile(),o=new FileReader;o.onload=function(c){var e=new Image;e.src=c.target.result,e.onload=function(){e.width=Math.min(e.width,800),e.height="auto";var d=$("<img>").attr("src",e.src);$(".summernote").summernote("insertNode",d[0])}},o.readAsDataURL(s),t.preventDefault()}}},onChange:function(t){r()}}});function r(){$("#summernote").next(".note-editable").find("iframe").each(function(){$(this).parent().hasClass("video-wrapper")||$(this).wrap('<div class="video-wrapper" style="text-align: center;"></div>')})}r()});