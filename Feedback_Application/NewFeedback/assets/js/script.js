function showMenu(){
  document.getElementById("menu").classList.toggle("change");
  document.getElementById("nav").classList.toggle("change");
  if(document.getElementById("nav").classList == 'nav change'){
    document.getElementById("nav").style.display = "block";
  }else{
      document.getElementById("nav").style.display = "none";
  }
  document.getElementById("menu-bg").classList.toggle("change-bg");
}

function getPositionsForCompany(){
  try{
    var length = document.getElementsByClassName('company_names').length;
    for(var i = 0; i < length; i++){
      document.getElementsByClassName('company_names')[i].style.display = 'none';
    }
    document.getElementById('vacancy').value = "N/A";
   var company = document.getElementById('selected_company').value;
   if(company != 'select_company'){
     var com = document.getElementsByName(company);
     for(var i = 0 ; i < com.length; i++){
       com[i].style.display="block";
     }
   }
  }catch(err){}
}

function disableTemplateBtn(){
  if(document.getElementById('template_selected').value != 'select_template'){
     document.getElementById('selected_template_btn').disabled = false;
     document.getElementById('generate_feedback_btn').disabled = false;
     document.getElementById('selected_template_id').value = document.getElementById('template_selected').value;
  }else{
    document.getElementById('selected_template_btn').disabled = true;
    document.getElementById('generate_feedback_btn').disabled = true;
  }
}

function disablePositionBtn(){
  if(document.getElementById('position_selected').value != 'N/A'){
     document.getElementById('selected_position_btn').disabled = false;
  }else{
    document.getElementById('selected_position_btn').disabled = true;
  }
}

function disableFeedbackBtn(){
  if(document.getElementById('feedback_selected').value != 'N/A'){
     document.getElementById('selected_feedback_btn').disabled = false;
  }else{
     document.getElementById('selected_feedback_btn').disabled = true;
  }
}

function disableInterviewerBtn(){
  if(document.getElementById('interviewer_selected').value != 'N/A'){
     document.getElementById('selected_interviewer_btn').disabled = false;
  }else{
     document.getElementById('selected_interviewer_btn').disabled = true;
  }
}
