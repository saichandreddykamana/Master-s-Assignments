var feedback_sections = [];
var update_comment = '';
var candidate_feedback_sections = [];

 function disableGenerateFeedbackBtn(){
   if(document.getElementById('template_id').value == ''){
     document.getElementById('generate').disabled = true;
   }
 }

 function openPDFs(){
   try{
     var content = unescape(document.getElementById('candidate_resume').value);
     var blob = new Blob([content], {type: 'application/pdf'});
     var blobURL = URL.createObjectURL(blob);
     window.open(blobURL);
 }catch(err){}
 }

 function showAddComment(){
   document.getElementById('add_new_comment').style.display = 'block';
   document.getElementById('add_new_comment_btn').style.display = 'none';
 }

 function hideAddComment(){
   document.getElementById('add_new_comment').style.display = 'none';
   document.getElementById('add_new_comment_btn').style.display = 'block';
 }

 function setCKEditorContent(){
   document.getElementById('ck_editor_input_text').value = CKEDITOR.instances.editor1.getData();
 }

 function editFeedbackComment(id){
 	try{
      id = id.split("_");
      feedback_sections = JSON.parse(document.getElementById('sections').value);
 	    update_comment = id[id.length - 1];
      if(feedback_sections.length == 0){
        feedback_sections = JSON.parse(document.getElementById('feedback_sections').value);
        document.getElementById('add_new_comment_text').value = feedback_sections[update_comment];
      }else{
        document.getElementById('add_new_comment_text').value = feedback_sections[update_comment];
      }
    	showAddComment();
    	document.getElementById("create_option").style.display = 'none';
     	document.getElementById("update_option").style.display = 'block';
  }catch(err){}
 }

 function updateCommentToTheList(){
   try{
     var comment_value = document.getElementById('add_new_comment_text').value;

     if(window.location.href!='http://localhost/NewFeedback/templates/create' && document.getElementById('sections').value != ''){
       feedback_sections = JSON.parse(document.getElementById('sections').value);
     }else{
       feedback_sections = JSON.parse(document.getElementById('feedback_sections').value);
     }

		 feedback_sections[update_comment] = comment_value;
     if(window.location.href!='http://localhost/NewFeedback/templates/create'){
       document.getElementById('sections').value = JSON.stringify(feedback_sections);
     }else{
       document.getElementById('feedback_sections').value = JSON.stringify(feedback_sections);
     }
    document.getElementById('comment_text_' + update_comment).innerHTML = feedback_sections[update_comment];
    document.getElementById('add_new_comment_text').value = '';
    document.getElementById("create_option").style.display = 'block';
    document.getElementById("update_option").style.display = 'none';
    hideAddComment();
  }catch(err){}
 }

 function addCommentsToTheList(){
   try{
		 var arr;
		 var add = true;
		 var comment_value = document.getElementById('add_new_comment_text').value;
		 if(document.getElementById('feedback_sections').value == ''){
			 arr = 0;
		 }else{
			 var comments = JSON.parse(document.getElementById('sections').value);
			 if(!comments.includes(comment_value)){
				 arr = comments.length;
			 }else{
				 add = false;
			 }
		 }
     if(document.getElementById('sections').value == ''){
       feedback_sections = [];
     }else{
       feedback_sections = JSON.parse(document.getElementById('sections').value);
     }
		 if(add && comment_value != ''){
			   feedback_sections.push(comment_value);
			   addToDOMList(arr,comment_value);
			   document.getElementById('feedback_sections').value = JSON.stringify(feedback_sections);
         document.getElementById('sections').value = JSON.stringify(feedback_sections);
				 document.getElementById('add_new_comment_text').value = '';
		 }
  }catch(err){alert(err);}
 }

 function addToDOMList(arr,comment_value){
 try{
   var parentSection = document.getElementById('feedback_comments_div');
	     parentSection.style.display = "flex";
	 var section = document.createElement('div');
			 section.setAttribute('class','col-md-4');
	 var childSectionLabel = document.createElement('span');
			 childSectionLabel.id = "comment_text_" + arr;
			 childSectionLabel.innerHTML = comment_value;
			 section.appendChild(childSectionLabel);
	var childSectionCheck = document.createElement('input');
			childSectionCheck.id = "checkbox_" + arr;
			childSectionCheck.type ="checkbox";
      childSectionCheck.style.margin = "8px 10px 0px 0px";
      childSectionCheck.style.float = 'left';
			childSectionCheck.checked = true;
			childSectionCheck.onclick = function () {removeUncheckedOptions(this.id)};
			section.appendChild(childSectionCheck);
	var childSectionEdit = document.createElement('button');
			childSectionEdit.className = "btn btn-primary btn-sm";
      childSectionEdit.innerHTML ='Edit';
      childSectionEdit.style.background = '#001e49ed';
      childSectionEdit.style.margin ='0 0 0 10px';
      childSectionEdit.style.borderColor = '#001e49ed';
			childSectionEdit.id = "edit_" + arr;
			childSectionEdit.onclick = function () {editFeedbackComment(this.id)};
			section.appendChild(childSectionEdit);
			parentSection.appendChild(section);
    }catch(err){}
 }


 function removeUncheckedOptions(id){
	 try{
		 var new_array = [];
		 sections = JSON.parse(document.getElementById('sections').value);
	   for(var i = 0 ; i < sections.length ; i++){
		   if(document.getElementById("checkbox_" + i).checked != false){
		   	 new_array.push(sections[i]);
		   }
	   }
     document.getElementById('feedback_sections').value = JSON.stringify(new_array);
    }catch(err){}
 }
 function getFeedbackOptions(){
	try{
        var id = "feedback_selected";
		    var id_value = document.getElementById(id).value.split(":");
	    	document.getElementById('feedback_selected_options').style.display = "block";
	    	document.getElementById('feedback_selected_options').value = id_value[1];
    }catch(err){}
 }

 function getPositionBox(){
	try{
        var id = "position_selected";
		    var id_value = document.getElementById(id).value.split(":");
		    document.getElementById('number_of_positions').style.display = "block";
		    document.getElementById('number_of_positions').value = id_value[1];
    }catch(err){}
 }

function getinterviewerBox(){
	try{
        var id = "interviewer_selected";
		    var id_value = document.getElementById(id).value.split(":");
	    	document.getElementById('interviewer_mail_id').style.display = "block";
	     	document.getElementById('interviewer_mail_id').value = id_value[1];
    }catch(err){}
}
