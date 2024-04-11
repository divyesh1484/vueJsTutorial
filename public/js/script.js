$(document).ready(function(){
	$('#employee_profile_pic').after('<img id="profile_preview" src="#" alt="profile"/>');
	var profileImage = document.getElementById('profile_image').getAttribute('data-variable');
	console.log(profileImage);
	document.getElementById('profile_preview').src = profileImage;
	document.getElementById('profile_preview').height = "100";

});