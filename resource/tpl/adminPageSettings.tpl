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
</form>
<div class="tbl_lb_wide_btn">
	<a href="#" class="btn_apply" title="Save changes" onclick="adminPageSettings.execSave();">Save</a>
	<a href="<?php echo $sUrlContents;?>" class="add_link" title="Reset to default">Return to Easycomment</a>
</div>
<div id="color_picker_area">
</div>

