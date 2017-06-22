/*
This function checks user keypress for return and if true
sends the form for validation
*/
function checkForReturn(e){
    var keyNum = e.keyCode || e.which;
    if (keyNum == 13){
        validateForm();
    }
}
/*
Validates data in the form and if valis submits the form
else returns error message
*/
function validateForm(){
// create object variables from form
 var mail = document.getElementById('email').value;
 var form = document.getElementById("pwReset");
 var er = document.getElementById('error');
 var valid = 0;
 // Check #1: is email valid
 if(validateEmail(mail)){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "<span class='icon-warning red'><'span>Not a valid email address<br>Please correct and try again.";
    er.style.display = "inline-block";
    return
 }
 
 // if all checks clear submit the form
 form.submit();
}

/*
takes email as a parameter returns boolean true if valid else returns false
*/
function validateEmail(email){
   if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
       return true;
   }else return false;
}
