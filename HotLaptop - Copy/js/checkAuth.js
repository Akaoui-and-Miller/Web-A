// JavaScript Document
function checkAuth(){
var userName=document.getElementById('userName').value;
var passWord=document.getElementById('passWord').value;
//Account 1
if(userName.toLowerCase()=="admin")
{
	if(passWord.toLowerCase()=="admin")
	{
		alert("Welcome Admin");
		document.cookie="username=Admin";
	}else{ alert("Incorrect Password, if you beleive this is an error or if you have forgotten your login details please contact support@millerprogramming.com")
	}


}
//Account 2
if(userName.toLowerCase()=="ryan")
{
	if(passWord.toLowerCase()=="miller")
	{
		alert("Welcome Ryan");
				document.cookie="username=Ryan";
	}else{ alert("Incorrect Password, if you beleive this is an error or if you have forgotten your login details please contact support@millerprogramming.com")
	}

}
//Account 3
if(userName.toLowerCase()=="patrick")
{
	if(passWord.toLowerCase()=="akaoui")
	{
		alert("Welcome Patrick");
				document.cookie="username=Patrick";
	}else{ alert("Incorrect Password, if you beleive this is an error or if you have forgotten your login details please contact support@millerprogramming.com")
	}

}
//Account 4
if(userName.toLowerCase()=="bowen")
{
	if(passWord.toLowerCase()=="bowen")
	{
		alert("Welcome Mr.Bowen");
				document.cookie="username=Bowen";
	}else{ alert("Incorrect Password, if you beleive this is an error or if you have forgotten your login details please contact support@millerprogramming.com")
	}
}
document.getElementById('loginfield').innerHTML=userName;
document.getElementById('loginfield').innerHTML=passWord;
}