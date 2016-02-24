function Comment(ID) {

	var token = document.getElementById('token').value;
	var komentar = document.getElementById('Komentar').value;
	
	if (validate(komentar))
	{
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		} else { // code for IE6, IE5
			
		}
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById("ajaxComment").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","comment.php?ID="+ ID +"&Komentar=" + komentar + "&token=" + token,true);
		xmlhttp.send();
	}
	else
	{
		return false;
	}
}

function showComment(ID) {

	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else { // code for IE6, IE5
		
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("ajaxComment").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","show_comment.php?ID=" + ID,true);
	xmlhttp.send();
}

function validate(komentar)
{	
	if (komentar == "")
	{
		alert('Komentar harus di isi');
		return false;
	}
	
	document.forms["comment_form"].reset();
	return true;
}

function validateRegistration(){
	var email = document.getElementById('Username').value;
	if (!validateEmail(email))
	{
		alert('Email tidak valid');
		return false;
	}
}

function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 

function ConfirmDelete(ID, token)
{
	if (confirm("Delete Post?")){
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		} else { // code for IE6, IE5
			
		}
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				var response = xmlhttp.responseText;
				if(response == "success"){
					alert("delete post success!");
				} else if(response == "user not valid") {
					alert("you do not have permission to delete this post!");
				} else {
					alert("internal server error!");
				}
				location.reload();
			}
		}
		xmlhttp.open("GET","delete_post.php?ID="+ ID +"&token="+ token,true);
		xmlhttp.send();
	}
}

function postValidation() {
    var Judul = document.getElementById("Judul");
	var Tanggal = document.getElementById("Tanggal");
	var Konten = document.getElementById("Konten");
	
	if (Judul.value =="")
	{
		alert('Judul harus di isi!');
		return false;
	}
	
	if (Tanggal.value =="")
	{
		alert('Tanggal harus di isi!');
		return false;
	}
	
	if (Konten.value =="")
	{
		alert('Konten harus di isi!');
		return false;
	}
	
	if (Tanggal.value!="")
	{
		var arrTanggal = Tanggal.value.split("-");
		
		var tanggal = new Date();
		tanggal.setFullYear(arrTanggal[0], parseInt(arrTanggal[1])-1, arrTanggal[2]);
		var date = new Date();
		
		if (tanggal < date)
		{
			alert('Tanggal harus sama atau lebih besar dari tanggal sekarang!');
			return false;
		}
	}
	
	return true;
}

function resetForm(FormId){
	document.forms[FormId].reset();
}

function makeYear(Tanggal){
	var tahun = Tanggal.charAt(0) + Tanggal.charAt(1) + Tanggal.charAt(2) + Tanggal.charAt(3);
	return parseInt(tahun);
}

function makeMonth(Tanggal){
	var bulan = Tanggal.charAt(5) + Tanggal.charAt(6);
	return parseInt(bulan);
}

function makeDay(Tanggal){
	var hari = Tanggal.charAt(8) + Tanggal.charAt(9);
	return parseInt(hari);
}

function secureForm(){
	var password = document.getElementById("Password").value;
	var shaObj = new jsSHA("SHA-256", "TEXT");
	shaObj.update(password);
	var hash = shaObj.getHash("HEX");
	document.getElementById("Password").value = hash;
	return true;
}