function changepwd_changed(changepwdCheckBox){
    if(changepwdCheckBox.checked){
        //Set the disabled property to FALSE and enable the input fields.
        document.getElementById("newpwd").disabled = false;
        document.getElementById("confirmpwd").disabled = false;
    } 
    else{
        //Otherwise, disable the input fields.
        document.getElementById("newpwd").disabled = true;
        document.getElementById("confirmpwd").disabled = true;
        }
}


function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}