$.fn.check = function(mode){
   //var mode = mode || 'on'; //default
    return this.each(function(){
        switch(mode){
            case 'on':
                this.checked = true;
                break;
            case 'off':
                this.checked = false;
                break;
            case 'toggle':
              this.checked = !this.checked;
                break;
				//default :
					//mode = 'on';
        }
    });
};

function formtypechange(val){
	if(val=='select'){
		trOptions.style.display='';
		document.myform.defaultvalue.rows=1;

	}else if(val=='text'){
		trOptions.style.display='none';
		document.myform.defaultvalue.rows=1;
	}else if(val=='textarea'){
		trOptions.style.display='none';
		document.myform.defaultvalue.rows=10;
	}else if(val=='radio'){
		trOptions.style.display='';
	}else if(val=='checkbox'){
		trOptions.style.display='';
	}else{
		trOptions.style.display='none';
		document.myform.defaultvalue.rows=1;
	}
}

$(function(){
$("#checkall1").click(function(){
$("input[@name='del[]']").check('on');
})
$("#checktog1").click(function(){
$("input[@name='del[]']").check('toggle')
})
});