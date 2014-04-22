var openstep;
(function(){
var curstep = 1;
var item_no = 1;
$(".add-item").click(function(){
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
});
openstep = function(n){
	$(".step").fadeOut(200).promise().done(function(){
		$(".step[data-id="+n+"]").fadeIn(200);
	});
	$(".steps li").removeClass('selected');
	$(".steps li[data-id="+n+"]").addClass('selected');
};
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
	$("#questionnairejson").val(questions.getJSON());
});

var optionOnBlur = function(){
	var a = $(this);
	var option = a.parent()[0];
	var question = a.parent().parent();
	var l = question.find(".option");
	var inps = $(option).find("input");
	if((!inps[0].value)&&(!inps[1].value)){
		if(l[l.length-1]==option){
			$(option).removeClass("active");
			$(option).addClass("inactive");
		}else{
			$(option).remove();
			if($(l[l.length-1]).hasClass("active")){
				questions.get(question.data('id')-1).addOption();
			}
		}
	}
	a.bind("focus",optionOnFocus);
};
var optionOnFocus = function(){
	var a = $(this);
	var option = a.parent();
	var question = a.parent().parent();
	a.unbind("focus");
	a.bind("blur",optionOnBlur);
	if(option.hasClass('inactive')){
		option.removeClass('inactive');
		option.addClass('active');
		var questionObj = questions.get(question.data("id")-1);
		if(questionObj.getNoofOptions()<4)
			questionObj.addOption();
	}
};
var Question = function(n){
	this.qid = n-1;
	this.getJSON = function(){
		var s = '{"question":"'+this.getQ()+'",';
		s += '"weight":"'+this.getWeight()+'",';
		s += '"options":[';
		var options = $(this.dom).find(".active");
		for (var i = 0; i < options.length; i++) {
			var inps = $(options[i]).find("input");
			var inplen = inps.length;
			for (var j = 0; j < (inplen)/2; j++) {
				s += '{"option":"';
				s += inps[j*2].value+'","marks":"';
				s += inps[j*2+1].value+'"}';
				if(j!=inplen/2-1) s+= ',';
			};
			if(i!=options.length-1) s+= ',';
		};
		s += ']}';
		return s;
	};
	this.getQ = function(){
		return $(this.dom).find(".question-text").val();
	};
	this.getNoofOptions = function(){
		return $(this.dom).find(".option").length;
	};
	this.getWeight = function(){
		return $(this.dom).find(".question-weight").val();
	};
	this.setWeight = function(w){
		$(this.dom).find(".question-weight").val(w);
	};
	this.setNo = function(n){
		$(this.dom).find("legend").html("Question #"+n);
		$(this.dom).data("id",n);
	};
	this.setQ = function(q){
		$(this.dom).find(".question-text").val(q);
	};
	this.addOption = function(){
		var opt = $('<div class="pure-control-group inactive option"><label>Option</label><input type="text" required><label>Marks</label><input type="text" required></div>');
		$(this.dom).append(opt);
		opt.find("input").bind("focus",optionOnFocus);
	}
	this.init = function(n){
		var html = $('<div class="question" data-id="'+n+'">\
							<legend>Question #'+n+'</legend>\
							<div class="pure-control-group"><label>Question</label><textarea class="question-text" type="text" rows="4" cols="50" required></textarea></div>\
							<div class="pure-controls"><button class="remove-question">Remove this question</button></div>\
							<div class="pure-control-group"><label>Question Weightage</label><input type="text" class="question-weight" required></input></div>\
							<div class="pure-control-group active option"><label>Option</label><input type="text" required><label>Marks</label><input type="text" value="100" required></div>\
							<div class="pure-control-group inactive option"><label>Option</label><input type="text" required><label>Marks</label><input type="text" required></div>\
						</div>');
		this.dom = html[0];
		html.find('.remove-question').click(function(){
			questions.remove($(this));
			return false;
		});
		return this.dom;
	};
	this.init(n);
}
var questions = {
	list: [],
	get: function(i){return this.list[i];},
	add: function(){
		var a = new Question(this.list.length+1);
		this.list.push(a);
		$('.questionnaire').append(a.dom);
		$(a.dom).slideUp(0);
		$(a.dom).slideDown(300);
		$(a.dom).find(".option input").bind("focus",optionOnFocus);
	},
	remove: function(self){
		var q = self.parent().parent();
		var id = q.data("id")-1;
		q.slideUp(300,function(){
			q.remove();
			questions.list.splice(id,1);
			for (var j = id; j < questions.list.length; j++) {
				questions.list[j].setNo(j+1);
			};
		});
	},
	getJSON: function(){
		var s = "[";
		var n = this.list.length;
		for (var i = 0; i < n; i++) {
			s += this.list[i].getJSON();
			if(i!=n-1) s+=",";
		};
		s += "]";
		return s;
	}
}
questions.add();
$(".add-question").click(function(){questions.add();});
})();
