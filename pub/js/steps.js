(function(){var curstep = 1;
var item_no = 1;
var add_item = function(){
	item_no++;
	var newItem = $('<div class="soq-item"><legend>Item #'+item_no+'</legend>\
					<div class="pure-control-group"><label>Item with Specifications</label><textarea type="text" rows="8" cols="50" required></textarea></div>\
					<div class="pure-control-group"><label>Quantity</label><input type="text" required></div>\
					<div class="pure-control-group"><label>EMD in INR</label><input type="text" required></div>\
					<div class="pure-controls"><input type="button" class="soq-remove" value="Remove this item"></div>\
				</div>');
	newItem.hide();
	$(".soq-items").append(newItem);
	newItem.slideDown(300);
	$('.soq-remove').unbind('click');
	$('.soq-remove').click(function(e){
		item_no--;
		var p = $(this).parent().parent();
		p.slideUp(300,function(){
			p.remove();
			var items = $('.soq-item');
			for (var i = 0; i < items.length; i++) {
				$(items[i]).children('legend').html('Item #'+(i+1));
			};
		});
		e.preventDefault();
	});
}
var openstep = function(n){
	$(".step").fadeOut(200).promise().done(function(){
		$(".step[data-id="+n+"]").fadeIn(200);
	});
	$(".steps li").removeClass('selected');
	$(".steps li[data-id="+n+"]").addClass('selected');
}
$(".steps li").click(function(){
	openstep($(this).data("id"));
});
openstep(1);
$(document).delegate("#newtenform","submit",function(e){
	for (var i = $("#newtenform [name][required]").length - 1; i >= 0; i--) {
		if($("#newtenform [name][required]")[i].value==''){
			$('#formmsg>p').html("Please Enter all details.<br>You can click the arrows at the top to go back to a specific step.");
			return false;
		}
	};
	var s = '[';
	items = $(".soq-item");
	for (var i = 0; i < items.length; i++) {
		s += '{';
		s += '"specification":"'+$($($(".soq-item")[i]).children("div")[0]).children("textarea").val()+'",';
		s += '"quantity":"'+$($($(".soq-item")[i]).children("div")[1]).children("input").val()+'",';
		s += '"emd":"'+$($($(".soq-item")[i]).children("div")[2]).children("input").val()+'"';
		s += '}';
		if(i!=items.length-1) s += ',';
	};
	s += ']';
	$("#itemsjson").val(s);
});
})();
