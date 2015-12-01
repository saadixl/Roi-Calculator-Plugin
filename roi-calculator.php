<?php
/*
Plugin Name: ROI Calculator
Author: Masudul Haque
Version: 0.0.1
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

/* Admin Panel */

add_action( 'admin_menu', 'register_my_custom_menu_page' );

function register_my_custom_menu_page() {

	add_menu_page( 'ROI Calculator', 'ROI Calculator', 'manage_options', 'roi-calculator/roi-admin.php', '', plugins_url( 'roi-calculator/icon.png' ));

}

// [roi_calc]
function roi_calc_func( $atts ) {

	$atts = shortcode_atts(
		array(
			'title' => 'ROI Title'
		), $atts, 'roi_calc' );
		$title = $atts['title'];
	$val1 = get_option('val1');
	$val2 = get_option('val2');
	$val3 = get_option('val3');
	$val4 = get_option('val4');
	$val5 = get_option('val5');
	$val6 = get_option('val6');
$str = '';


    $str = <<<EOD
	<div id='roi-calc'>
		<div style="display:none;" class="tab-row">
			<div class="col-title">
				<h3>Assumptions</h3>
			</div>
			<div style="margin-top:10px;" class="col-inner">
				<span style="margin-right:20px; display:inline-block; width:210px;">Depreciation Schedule (yrs)</span><span id="v1">$val1</span>
			</div>
			<div style="margin-top:10px;" class="col-inner">
				<span style="margin-right:20px; display:inline-block; width:210px;">Tax Rate (%)</span><span id="v2">$val2</span>
			</div>
			<div style="margin-top:10px;" class="col-inner">
				<span style="margin-right:20px; display:inline-block; width:210px;">Savings / Unit ($)</span><span id="v3">$val3</span>
			</div>
		</div>
		<div style="margin-top:20px; display:none;" class="tab-row">
			<div class="col-title">
				<h3>Equipment Cost</h3>
			</div>
			<div style="margin-top:10px;" class="col-inner">
				<span style="margin-right:20px; display:inline-block; width:300px;">Good</span><span>$$val4</span>
			</div>
			<div style="margin-top:10px;" class="col-inner">
				<span style="margin-right:20px; display:inline-block; width:300px;">Better</span><span>$$val5</span>
			</div>
			<div style="margin-top:10px;" class="col-inner">
				<span style="margin-right:20px; display:inline-block; width:300px;">Best</span><span>$$val6</span>
			</div>
		</div>
		<div style="margin-top:20px;" class="tab-row">
			<div class="col-title">
				<div class="headline"><h3>$title</h3></div>
			</div>
			<div style="float:left;" class="col-inner">
				<span style="margin-top:10px;margin-bottom:5px;margin-right:20px; display:inline-block; width:300px;">Select Equipment Level</span><span><select style="width:300px;padding:9px 0;" name="" id="v4">
					<option value="$val4">MYYIELD 2500</option>
					<option value="$val5">MYYIELD 5000</option>
					<option value="$val6">MYYIELD 7500</option>
				</select></span>
			</div>
			<div style="margin-top:10px;" class="col-inner">
				<span style="margin-top:10px;margin-bottom:5px;margin-right:20px; display:inline-block; width:276px;">Enter Annual Units</span><span><input id="v5" style="width: 276px;" type="text" /></span>
			</div>
			<div style="margin-top:10px;float:left;margin-right:20px;" class="col-inner">
				<span style="margin-top:10px;margin-bottom:5px;margin-right:20px; display:inline-block; width:276px;">Treatment Savings</span><span><input style="width: 276px;" value="$0" type="text" id="r1"/></span>
			</div>
			<div style="margin-top:10px;" class="col-inner">
				<span style="margin-top:10px;margin-bottom:5px;margin-right:20px; display:inline-block; width:276px;">Tax Savings (Depreciation)</span><span><input style="width: 276px;" value="0" type="text" id="r2" /></span>
			</div>
			<div style="margin-top:10px;float:left;margin-right:20px;" class="col-inner">
				<span style="margin-top:10px;margin-bottom:5px;margin-right:20px; display:inline-block; width:276px;">Annual Cash Flow</span><span><input style="width: 276px;background-color:rgb(250, 255, 189);" value="$0" type="text" id="r3" /></span>
			</div>
			<div style="margin-top:10px;" class="col-inner">
				<span style="margin-top:10px;margin-bottom:5px;margin-right:20px; display:inline-block; width:276px;">ROI</span><span><input id="r4" value="0 years" style="width: 276px;background-color:rgb(250, 255, 189);"  type="text" /></span>
			</div>
		</div>
		<p style="font-size: 14px;"><br />* All calculations are indicative estimates only<br/>* All financial information is presented on an after-tax basis</p>
	</div>

	<script>
	jQuery(document).ready(function(){

		jQuery('#v5').keyup(function(){
			roi_calculation();
		});
		jQuery('#v4').change(function(){
			roi_calculation();
		});
	});

	function roi_calculation(){
		var v1 = parseFloat(jQuery('#v1').text());
		var v2 = parseFloat(jQuery('#v2').text());
		var v3 = parseFloat(jQuery('#v3').text());
		var v4 = parseFloat(jQuery( "#v4 option:selected" ).val());
		var v5 = parseFloat(jQuery('#v5').val());
		var r1 = v5 * v3 * ( 1  - v2/100);
		var r2 = v4 /  ( v1 / (v2 / 100) );
		var r3 = r1 + r2;
		var r4 = 0;
		if((v4/r3)< 3){
			r4 = v4/r3;
		}

		if(jQuery('#v5').val()==""){
			jQuery("#r1").val('\$'+0 + " years");
			jQuery("#r2").val('\$'+0);
			jQuery("#r3").val('\$'+0);
		}
		else{
			jQuery("#r1").val('\$'+formatMoney(r1));
			jQuery("#r2").val(Math.ceil(r2));
			jQuery("#r3").val('\$'+formatMoney(Math.ceil(r3)));
			jQuery("#r4").val(Number((r4).toFixed(1)) + " years");

		}
	}
	function formatMoney(n){
		return n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,').slice(0, -3);
	}
	</script>
EOD;

return $str;
}
add_shortcode( 'roi_calc', 'roi_calc_func' );