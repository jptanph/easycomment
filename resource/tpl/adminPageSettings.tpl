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
				<select title="select rows" class="rows" id="show_html_value">
					<?php for($i = 1 ; $i <= 21 ; $i++){?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<!--<tr>
			<th><label for="show_html_value">Map Type</label></th>
			<td>
				<select title="select rows" class="rows" id="show_html_value">
					<option selected="selected">Normal</option>
					<option>Satellite</option>
					<option>Hybrid</option>
					<option>Terrain</option>
				</select>
			</td>
		</tr>-->
		<tr>
			<th><label for="show_html_value">Un-authorized Word</label></th>
			<td>
				<textarea class="word_filter"></textarea>
			</td>
		</tr>
	</table>
	<!--  Display option  -->

	<div>
		<div>
			<p>
				<span class="module_title" style="display: none;">Design Customizing</span>
				<span class="module_title2" >Design Customizing</span>
			</p>

		</div>

		<table border="0" cellspacing="0" class="tbl_option" style="display:visible">
			<tr>
				<td><label for="module_label">Background Color</label></td>
				<td>
				<span id="module_label_wrap">
					<input type="text" id="module_label" class="fix" style="width:100px;" value="#FFFFFF" />
				</span>
				<a href="#"><img src="images/color_picker.png" class="ipick_color" /></a>
				</td>
			</tr>
			<tr>
				<td><label for="module_label">Text Color</label></td>
				<td>
				<span id="module_label_wrap">
					<input type="text" id="module_label" class="fix" style="width:100px" value="#FFFFFF" />
				</span>
				<a href="#"><img src="images/color_picker.png" class="ipick_color" /></a>
				</td>
			</tr>
			<tr>
				<td><label for="module_label">Header Color</label></td>
				<td>
				<span id="module_label_wrap">
					<input type="text" id="module_label" class="fix" style="width:100px" value="#FFFFFF" />
				</span>
				<a href="#"><img src="images/color_picker.png" class="ipick_color" /></a>
				</td>
			</tr>
			<tr>
				<td><label for="module_label">Header Text Color</label></td>
				<td>
				<span id="module_label_wrap">
					<input type="text" id="module_label" class="fix" style="width:100px" value="#FFFFFF" />
				</span>
				<a href="#"><img src="images/color_picker.png" class="ipick_color" /></a>
				</td>
			</tr>

		</table>

	</div>


	<div class="tbl_lb_wide_btn">
		<a href="#" class="btn_apply" title="Save changes" onclick="chk_validate();">Save</a>
		<a href="#" class="add_link" title="Reset to default">Reset to Default</a>
	</div>