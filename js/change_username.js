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
 var name = document.getElementById('name').value;
 var form = document.getElementById("changeUsername");
 var er = document.getElementById('error');
 var valid = 0;

 // is name > 125 characters
 if(name.length < 126){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "<span class='icon-warning red'><'span>Username must be less than 126 characters";
    er.style.display = "inline-block";
    return
 }
 // is Address Line 2 > 125 characters
 if(name.length > 0){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "<span class='icon-warning red'><'span>Username is a required field";
    document.getElementById('name').style.backgroundColor = "#CC99CC";
    er.style.display = "inline-block";
    return
 }
 // if all checks clear submit the form
 form.submit();
}