function changepwd_changed(changepwdCheckBox){
  if(changepwdCheckBox.checked){
        //Set the disabled property to FALSE and enable the input fields.
        document.getElementById("newpwd").disabled = false;
        document.getElementById("confirmpwd").disabled = false;
    } else{
        //Otherwise, disable the input fields.
        document.getElementById("newpwd").disabled = true;
        document.getElementById("confirmpwd").disabled = true;
        document.getElementById("confirmpwd").innerHTML = "";
        document.getElementById("newpwd").innerHTML = "";
    }
}