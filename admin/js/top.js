//菜单
var oplist = new Array('dd','system','shop');
$(document).ready(function() {
	$('#top_menu').find("a").click(function() {
		var id = $(this).attr('id');
		$.each(oplist, function(i, n) {
			$('#'+n).attr('class', 'current');
		});
		$(this).parents("span").attr('class', 'current2');
	});
});
function set_menu(url,id){

	window.parent.frames.menu.location.href= url;
}