<form name="<?php echo $sPrefix?>settings_form" id="<?php echo $sPrefix?>settings_form" method="post">
<input type="hidden" value="<?php echo $iIdx?>" name="<?php echo $sPrefix;?>idx">
<!-- message box -->
	<p class="require"><span class="neccesary">*</span> Required</p>
	<!-- input area -->
	<table border="1" cellspacing="0" class="table_input_vr">
		<colgroup>
			<col width="130px" />
			<col width="*" />
		</colgroup>
		<tr>
			<th class="padt1"><label for="show_html_value">Pagination</label></th>
			<td class="padt1">
				<select title="select rows" class="rows" id="<?php echo $sPrefix?>comment_limit" name="<?php echo $sPrefix?>comment_limit">
					<?php for($i = 1 ; $i <= 21 ; $i++){?>
                        <option id="<?php echo $i;?>" value="<?php echo $i;?>" <?php if($iCommentLimit==$i){?> selected="selected" <?php }?>><?php echo $i;?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr>
			<th><label for="show_html_value">Un-authorized Word</label></th>
			<td>
				<textarea class="word_filter" name="<?php echo $sPrefix?>ua_word" id="<?php echo $sPrefix?>ua_word"><?php echo $sUnAuthorizedWord?></textarea>
			</td>
		</tr>
	</table>
	<!--  Display option  -->
	<div>
		<div>
			<p>
				<span class="module_title" style="display: <?php echo ($sShowCustom=='no') ? 'visible' : 'none';?>" onclick="adminPageSettings.execHideShow('down')" id="<?php echo $sPrefix;?>up">Design Customizing</span>
				<span class="module_title2" style="display:<?php echo ($sShowCustom=='yes') ? 'visible' : 'none';?>"; onclick="adminPageSettings.execHideShow('up')" id="<?php echo $sPrefix;?>down">Design Customizing</span>
			</p>
		</div>

		<table border="0" cellspacing="0" class="tbl_option" style="display:<?php echo ($sShowCustom=='yes') ? 'visible' : 'none';?>" id="<?php echo $sPrefix?>custom_area">
			<tr>
				<td><label for="module_label">Background Color</label></td>
				<td>
				<span id="module_label_wrap">
					<input type="text" id="<?php echo $sPrefix?>bg_color" name="<?php echo $sPrefix?>bg_color" class="fix" style="width:100px;" value="<?php echo $sBackgroundColor?>" />
				</span>
				<a href="#none" onclick="adminPageSettings.execColorPicker('<?php echo $sPrefix?>bg_color');"><img src="<?php echo $sImagePath;?>color_picker.png" class="ipick_color" /></a>
				</td>
			</tr>
			<tr>
				<td><label for="module_label">Text Color</label></td>
				<td>
				<span id="module_label_wrap">
					<input type="text" class="fix" name="<?php echo $sPrefix?>text_color" id="<?php echo $sPrefix?>text_color"style="width:100px" value="<?php echo $sTextColor?>" />
				</span>
				<a href="#none" onclick="adminPageSettings.execColorPicker('<?php echo $sPrefix?>text_color');"><img src="<?php echo $sImagePath;?>color_picker.png" class="ipick_color" /></a>
				</td>
			</tr>
			<tr>
				<td><label for="module_label">Header Color</label></td>
				<td>
				<span id="module_label_wrap">
					<input type="text" name="<?php echo $sPrefix?>header_color" id="<?php echo $sPrefix?>header_color" class="fix" style="width:100px" value="<?php echo $sHeaderColor?>" />
				</span>
				<a href="#none" onclick="adminPageSettings.execColorPicker('<?php echo $sPrefix?>header_color');"><img src="<?php echo $sImagePath;?>color_picker.png" class="ipick_color" /></a>
				</td>
			</tr>
			<tr>
				<td><label for="module_label">Header Text Color</label></td>
				<td>
				<span id="module_label_wrap">
					<input type="text" name="<?php echo $sPrefix?>htext_color" id="<?php echo $sPrefix?>htext_color" class="fix" style="width:100px" value="<?php echo $sHeaderTextColor?>" />
				</span>
				<a href="#none"  onclick="adminPageSettings.execColorPicker('<?php echo $sPrefix?>htext_color');"><img src="<?php echo $sImagePath;?>color_picker.png" class="ipick_color" /></a>
				</td>
			</tr>
		</table>
	</div>
</form>
<div class="tbl_lb_wide_btn">
	<a href="#none" class="btn_apply" title="Save changes" onclick="adminPageSettings.execSave();">Save</a>
	<a href="#none" class="add_link" title="Reset to default" onclick="adminPageSettings.execReset();">Reset to Default</a>
</div>
<div id="color_picker_area">
</div>

