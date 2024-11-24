$(document).on("click",".edit-question-modal",function(){let t=$(this),e=$("#surveyQuestionUpdateModal"),n=e.find("#surveyQuestionUpdateForm"),l="/admin/dashboard/surveys/questions/edit/"+t.data("question-uuid");n.find("#question_text").val(""),n.find(".repeater").remove(),axios.get(l).then(s=>{if(s.status===200){let{data:i}=s.data,{options:o}=i;console.log(i),e.find("#question_text").val(i==null?void 0:i.question_text);let u=e.find("#uuid");if(u.length>0?u.val(i.uuid):r(n,i.uuid),o&&o.length>0){n.find('input[name="answer_text[]"]').first().val(o[0].answer_text);for(let a=1;a<o.length;a++)d(n,o[a].answer_text)}e.modal("show")}}).catch(s=>{error(s)})});const d=(t,e="")=>{let n=`
        <div class="form-group repeater">
            <label for="answer">Soru Seçeneği</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="answer_text[]" value="${e}">
                </div>
                <div class="col-md-6">
                   <button type="button" class="btn btn-icon btn-circle btn-transparent-danger remove-answer"><i class="flaticon2-trash"></i></button>
                </div>
            </div>
        </div>
    `;t.append(n)};$(document).on("click","#surveyQuestionUpdateModal #addAnswer",function(t){t.preventDefault();let e=$(this).closest("form");d(e)});$(document).on("click","#surveyQuestionUpdateModal .remove-answer",function(t){t.preventDefault(),$(this).closest(".repeater").remove()});const r=(t,e)=>{$("<input>").attr({type:"hidden",id:"uuid",name:"uuid",value:e}).appendTo(t)};
