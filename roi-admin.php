<?php 
	$val1 = get_option('val1');
	$val2 = get_option('val2');
	$val3 = get_option('val3');
	$val4 = get_option('val4');
	$val5 = get_option('val5');
	$val6 = get_option('val6');

	if( isset($_POST['val1']) && $_POST['val2'] ) {
		$val1 = $_POST['val1'];
		$val2 = $_POST['val2'];
		$val3 = $_POST['val3'];
		$val4 = $_POST['val4'];
		$val5 = $_POST['val5'];
		$val6 = $_POST['val6'];
        update_option( 'val1', $val1 );
        update_option( 'val2', $val2 );
        update_option( 'val3', $val3 );
        update_option( 'val4', $val4 );
        update_option( 'val5', $val5 );
        update_option( 'val6', $val6 );

    }

    function ifExistsThen($var){
    	if(isset($var)){echo $var;}
    }


 ?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <style>
		.form-inner-row{
			clear: both;
			margin-bottom: 20px;
		}
		.form-inner-row label {
    		font-weight: bold;
    		display: block;
    		margin-bottom: 5px;
		}
		input.roi-submit {
    	padding: 10px 15px;
    	border: none;
    	background-color: #3498db;
    	color: white;
    	border-radius: 3px;
		}
		input.form-inner-input {
    		padding: 10px;
    		border: none;
		}
    </style>
</head>

<body>
    <h2>ROI Calculator</h2>
    <form action="" method="post">
        <div class="form-inner-row">
            <label for="">Depreciation Schedule (yrs)</label>
            <input type="text" class="form-inner-input" name="val1" value="<?php ifExistsThen($val1); ?>" />
        </div>
        <div class="form-inner-row">
            <label for="">Tax Rate (%)</label>
            <input type="text" class="form-inner-input" name="val2" value="<?php ifExistsThen($val2); ?>" />
        </div>
        <div class="form-inner-row">
            <label for="">Savings / Unit ($)</label>
            <input type="text" class="form-inner-input" name="val3" value="<?php ifExistsThen($val3); ?>" />
        </div>
        <div class="form-inner-row">
            <label for="">MYYIELD 2500</label>
            <input type="text" class="form-inner-input" name="val4" value="<?php ifExistsThen($val4); ?>" />
        </div>
        <div class="form-inner-row">
            <label for="">MYYIELD 5000</label>
            <input type="text" class="form-inner-input" name="val5" value="<?php ifExistsThen($val5); ?>" />
        </div>
        <div class="form-inner-row">
            <label for="">MYYIELD 7500</label>
            <input type="text" class="form-inner-input" name="val6" value="<?php ifExistsThen($val6); ?>" />
        </div>
        <div class="form-inner-row">
            <input type="submit" class="roi-submit" value="Submit" />
        </div>
    </form>
</body>


</html>
