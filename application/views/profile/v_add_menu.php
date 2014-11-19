<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>
  <link href="<?=$base_url?>public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?=$base_url?>public/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?=$base_url?>public/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="<?=$base_url?>public/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?=$base_url?>public/css/AdminLTE.css" rel="stylesheet" type="text/css" />
  
<style>

div#question{
	text-align: left;
	margin-left:20px;
	margin-bottom: 10px;
}

table#tbl-save tr td {
	text-align: left;
}

div.answer {
	padding: 20px;
	text-align: left;
	/*border: 1px solid black;*/
	margin-left:20px;
	width: 1200px;
}

div#questlist{
	width: 700px;
	position: absolute;
}

div.inc{
	margin-right:10px;
	float:left;
	width: 20px;
}

div.questionlist{
	margin-bottom:10px;
}

div.add_answer{
	margin-left: 30px;
}

div.answerlist{
	/*border:1px solid black;*/
	margin-left:30px;
	margin-top:10px;
	padding:10px;
}

div.inc_ans {
	margin-right:10px;
	float:left;
	width: 20px;
}

div#operation{
	margin:20px;
}	
.textCtrl:focus,
	.textCtrl.Focus
	{
		background: rgb(255,255,240) url('styles/custom/xenforo/gradients/form-element-focus-25.png') repeat-x;
border-top-color: rgb(150,150,150);
border-bottom-color: rgb(230,230,230);

	}	

	textarea.textCtrl:focus
	{
		background-image: url('styles/custom/xenforo/gradients/form-element-focus-100.png');

	}
.textCtrl
{
	font-size: 13px;
	font-family: Calibri, 'Trebuchet MS', Verdana, Geneva, Arial, Helvetica, sans-serif;
	color: #000000;
	background-color: #EEE;
	padding: 3px;
	margin-bottom: 2px;
	border-width: 1px;
	border-style: solid;
	border-top-color: rgb(192, 192, 192);
	border-right-color: rgb(233, 233, 233);
	border-bottom-color: rgb(233, 233, 233);
	border-left-color: rgb(192, 192, 192);
	border-radius: 4px;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	-khtml-border-radius: 4px;
	outline: 0;
}

textarea.textCtrl
{
	word-wrap: break-word;
	width: 95%;
}
</style>
</body>
 <script src="<?=$base_url?>public/js/jquery-1.8.0.min.js" type="text/javascript"></script>
 <h1 align="center">Add URL</h1>
 <div style="margin-top:100px; margin-left:100px;">
 <script>
	$(function(){
		$("#operation").hide();
		$("input#btn_add_question").on("click",function(){
			var one_question = '<div class="answer" id="'+num_quest+'">'+
				'<div class="questlist">'+
					'<div class="inc">['+num_quest+']</div>'+
					'<div class="questionlist">'+
						'<input type="text" id="question_'+num_quest+'" name="nama[]"  cols="150"   />'+
					'</div>'+
					'<div class="add_answer">'+
					'<input type="button" class="button gray" onclick="add_answer(\''+num_quest+'\')" value="Tambah Jawaban" />'+
					'</div>'+
				'</div>'+
				'<div class="answerlist" id='+num_quest+'>'+
				'</div>'+
			'</div>';

			$('#boxQA').append(one_question);
			num_quest++;
		});

		$('#form_save').on('submit',function(){
			var obj_question = collect_data();
			
			console.log(obj_question);
			$("#result_data").val(JSON.stringify(obj_question));
			return true;
		});

	});

	var num_quest = 1;
		var num_answer = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];


	function collect_data() {
		var obj_qa=[];
		var obj_answer_arr = [];
		
		for(var i=1; i<num_quest; i++){
			var obj_data = {};
			var obj_answer = [];
			var obj_answervalue = [];

			obj_data.question = $("#question_"+i).val()

			$(".answer_"+i).each(function(){
				obj_answer.push($(this).val());
			});

			$(".answervalue_"+i).each(function(){
				obj_answervalue.push($(this).val());
			});

			obj_answer_arr.push(obj_answer);
			obj_data.answer = obj_answer;
			obj_data.answervalue = obj_answervalue;

			obj_qa.push(obj_data);
		}

		return obj_qa;
	}

	function add_answer(id) {

		var idx = num_check_answer(id);
		if( typeof idx == 'undefined'){
			idx = 0;
		}else{
			idx++; 
		}
		console.log(idx);

		var n_ans = num_answer[idx];
		if(typeof n_ans == 'undefined'){
			alert('Pertanyaan terlalu banyak');
		}else{
			var one_answer = '<div class="inc_ans" itemid="'+id+'">'+n_ans+'</div>'+
				'<div class="answertext">'+
					'<input type="text" class="answer_'+id+'" size="10" name="nama2[]" value="" />'+
					'<input type="text" class="answer_'+id+'" size="88" name="url_name[]" value="" />'+
					// '<input type="button" value="Hapus">'+
				'</div>';

			$("div.answerlist").each(function(){
				if($(this).attr('id') == id ){
					$(this).append(one_answer);
				}
			});
			var objD = {};
			objD.idQ = id;
			objD.n_ans = idx;
			answerObj.push(objD);	
		}

		console.log(answerObj);
		show_operation();
	}

	function show_operation() {
		if(answerObj.length > 0){
			$('div#operation').show();
		}else{
			$('div#operation').hide();
		}
	}

	var answerObj = [];

	function num_check_answer(id) {
		for(var i=0; i<answerObj.length; i++){
			if(answerObj[i].idQ == id){
				var idx = answerObj[i].n_ans;
			}
		}
		return idx;
	}

</script>
<form action="<?php echo base_url() . 'profile/insert_account/'.$user.'/'.$pass; ?>" method="post" enctype="multipart/form-data" class="validate">
 <input type="button" name="btn_add_question" id="btn_add_question" class="button gray" value="Tambah Pertanyaan" />	
	<div id="boxQA">
	
	</div>
    <input type="submit" value="Go" name="go" />
    </form>
    </div>