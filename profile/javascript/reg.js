let firstname=document.getElementById("txtfirstname");
let lastname=document.getElementById("txtlastname");
let email=document.getElementById("txtEmail");
let phone=document.getElementById("txtphone");
let address=document.getElementById("txtaddress");
let pwd=document.getElementById("txtPwd");
let conPwd=document.getElementById("txtConPwd");
let form=document.querySelector("form");

function validateInput()
{
  	//firstname validation 
    if(firstname.value.trim()==="")
    {
    	onError(firstname,"Firstname cannot be empty");
        return false;
    }
    else if(firstname.value.length<=2)
    {
    	onError(firstname,"Firstname min 3 char");
        return false;   
	}
	else if (firstname.value.match(/[^A-Z][^a-z]/i))
	{
		onError(firstname,"Firstname cannot be number");
        return false;   
    }
    else
    {
    	onSuccess(firstname);
    }

    //lastname validation 
    if(lastname.value.trim()==="")
    {
    	onError(lastname,"Lastname cannot be empty");
        return false;
    }
    else if(lastname.value.length<=2)
    {
    	onError(lastname,"Lastname min 3 char");
        return false;  
    }
    else if (lastname.value.match(/[^A-Z][^a-z]/i))
    {
    	onError(lastname,"Lastname cannot be number");
        return false;        
    }
    else
    {
        onSuccess(lastname);
    }

    // email validation
    if(email.value.trim()==="")
    {
        onError(email,"Email cannot be empty");
        return false;
    }
    else if(!isValidEmail(email.value.trim()))
    {
		onError(email,"Email is not valid");
        return false;
    }
    else
    {
		onSuccess(email);
    }

    // phone validation
    if(phone.value.trim()==="")
    {
        onError(phone,"Phone number cannot be empty");
        return false;
    }
    else if(!isValidPhone(phone.value.trim()))
    {
        onError(phone,"Phone number is not valid");
        return false;
    }
    else
    {
        onSuccess(phone);
    }

    //address validation 
    if(address.value.trim()==="")
    {
    	onError(address,"Address cannot be empty");
        return false;
    }
    else if(address.value.length<=4)
    {
		onError(address,"Address min 5 char");
        return false;    
    } 
    else
    {
       	onSuccess(address);
    }

    //password validation
    if(pwd.value.trim()==="")
    {
        onError(pwd,"Password cannot be empty");
        return false;
    }
    else if(!isValidPassword(pwd.value.trim()))
    {
		onError(pwd,"Incorrect password format");
        return false;
    }
    else
    {
        onSuccess(pwd);
    }

    // cpassword validation
    if(conPwd.value.trim()==="")
    {
        onError(conPwd,"Confirm password cannot be empty");
        return false;
    }
    else if(pwd.value.trim()!==conPwd.value.trim())
    {
        onError(conPwd,"Password & Confirm password not matching");
        return false;
    }
    else
    {
        onSuccess(conPwd);
    }
}

// document.querySelector("button")
// .addEventListener("click",(event)=>{
//     event.preventDefault();
//     validateInput();
// });

function onSuccess(input)
{
    let parent=input.parentElement;
    let messageEle=parent.querySelector("small");
    messageEle.style.visibility="hidden"; 
    parent.classList.remove("error");
    parent.classList.add("success");  
}

function onError(input,message)
{
    let parent=input.parentElement;
    let messageEle=parent.querySelector("small");
    messageEle.style.visibility="visible";
    messageEle.innerText=message;  
    parent.classList.add("error");
    parent.classList.remove("success");
}

function isValidEmail(email)
{
   return /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

// "Must contain atleast 10 numbers and non-negative"
function isValidPhone(phone)
{
    return /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(phone);
}

// "Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters"
function isValidPassword(password)
{
    return /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}/.test(password); 
}