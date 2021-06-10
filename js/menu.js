function load_menu(){
	document.getElementById("sidebar").classList.toggle('active');
}
$(document).ready(function () {
	$('.toggle-btn').on('click', load_menu);
	
});
