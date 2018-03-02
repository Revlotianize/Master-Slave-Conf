<?php
use yii\helpers\Html; 
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField; 

?>
<script src="/TableDetails/web/assets/9d892228/jquery.js"></script>
<?php
 	$form = ActiveForm::begin() ?>    
 	<?= $form->field($model, 'tablename')->dropDownList(($data),["prompt" => "Select Table"]); ?>
    <div id="slave"><?= $form->field($model,'slave')->dropDownList(["jd"=>"JD","madras"=>"madras"],["prompt"=>"Select"]);?></div> 
    <div id="location"><?= $form->field($model, 'location')->textInput(['readonly' => true, 'value' => 'master']) ?></div> 
    <?= $form->field($model, 'query')->textArea()->hint('Enter your Query'); ?>
           
    <?= Html::Button('Submit',['class' => 'btn btn-primary', 'id' => 'submitButton']) ?>    
<?php ActiveForm::end() ?>

<script>	
	var db = 'master'; // default value
	var detail = '<?php echo json_encode($detail);?>';
	var obj = JSON.parse(detail);
	var details = Object.values(obj);

	$('#location').hide();
	$('#slave').hide();		
	$('#details-tablename').change(function() {
		var table = $("#details-tablename").val();
		alert("You have selected "+table);
		for (i = 0; i < details.length; i++) { 
			if (table == details[i]) {
					$('#slave').show();
					$('#location').hide();
					var flag = 1;
					break;
			}
			else {
				$('#location').show();
				$('#slave').hide();			
			}
		}
		if (flag == 1){
			$('#details-slave').click(function() {
					var db = $("#details-slave").val();
			});
		}
	});	
	$('#submitButton').click(function(e) {
		e.preventDefault();
		var query = $("#details-query").val();
		alert("Your query is -- "+query);
		var formData = $('#w0').serialize();
		
		$.ajax({ 
			type: "POST", 
			url: "execute", //Sending values to the action in controller
			data: formData, 
			success: function (response) {  
			 }, 
		}) 
		location.reload(true);
	});
		
</script>
<!-- Values captured  
details -> to get the details of the slave tables 
db -> to connect the  
 -->