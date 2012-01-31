<table border="1" cellpadding="0" cellspacing="0" class="table_hor_03">
<tr>
    <td>
        <table cellpadding="3" cellspacing="3">
            <tr>
                <td><span  class="title">Show by</span></td>
                <td>
                    <select class="optionbox" onchange="PG_Easycomment_content.execGetTime();" id="<?php echo $sPrefix;?>date_range">
                        <option value="custom" <?php if($sDateRange=='custom'){?>selected="selected"<?php }?>>Customized Search</option>
                        <option value="today"<?php if($sDateRange=='today'){?>selected="selected"<?php }?>>Today</option>
                        <option value="currentWeek" <?php if($sDateRange=='currentWeek'){?>selected="selected"<?php }?>>Current Week</option>
                        <option value="currentMonth"<?php if($sDateRange=='currentMonth'){?>selected="selected"<?php }?>>Current Month</option>
                    </select></td>

                <td><span  class="title">Start Date:</span> <input type="text" value="<?php echo $sStartDate;?>" id="<?php echo $sPrefix;?>start_date"  name="<?php echo $sPrefix;?>start_date" class="input_text" readonly="readonly" /><a href="#none"><label for="<?php echo $sPrefix;?>start_date" ><img style="cursor:pointer;" src="<?php echo $sImagePath;?>calendar_icon.png" /></label></a></td>
                <td><span  class="title">End Date: </span><input type="text" value="<?php echo $sEndDate;?>" id="<?php echo $sPrefix;?>end_date"  name="<?php echo $sPrefix;?>end_date" class="input_text" readonly="readonly" /><a href="#none"><label for="<?php echo $sPrefix;?>end_date" ><img style="cursor:pointer;"  src="<?php echo $sImagePath;?>calendar_icon.png" /></label></a></td>

            </tr>
            <tr>
                <td><span  class="title">Search Keyword</span></td>
                <td>
                    <select class="optionbox" id="<?php echo $sPrefix;?>field_search">
                        <option value="name">Name</option>
                        <option value="url">URL</option>
                    </select>
                </td>
                <td colspan="2"><input type="text" value="<?php echo $sKeyword; ?>" title="Search by URL or Name" id="<?php echo $sPrefix;?>keyword" class="input_search"/> <a href="#none" class="btn_nor_01 btn_width_search" title="Search Keyword" onclick="adminPageContents.execSearch();return false;" style="width:45px;height:13px" >Search</a><a href="#none" onclick="adminPageContents.execReset();" class="add_link" title="Reset to default">Reset</a></td>
            </tr>
        </table>
    </td>
</tr>
</table>
<div class="table_header_area">
    <ul class="row_2">
        <li>
            <a href="#none" class="btn_nor_01 btn_width_add" style="width:100px;height:13px" title="Add Comment" onclick="adminPageContents.execAddComment();" >Add Comment</a>
            <a href="#none" class="btn_nor_01 btn_width_st1" title="Delete Comment" onclick="PG_Easycomment_content.execDeleteAll();return false;">Delete</a>
        </li>
        <li class="show">
            <label for="{$sPrefix}show_row">Show Rows</label>
            <select id="<?php echo $sPrefix?>show_row" onchange="adminPageContents.execShowRows();">
                <option <?php if($iRow==10){?>selected="selected" <?php }?>>10</option>
                <option <?php if($iRow==20){?>selected="selected" <?php }?>>20</option>
                <option <?php if($iRow==30){?>selected="selected" <?php }?>>30</option>
                <option <?php if($iRow==50){?>selected="selected" <?php }?>>50</option>
                <option <?php if($iRow==100){?>selected="selected" <?php }?>>100</option>
            </select>
        </li>
    </ul>
</div>
<!-- // table header -->
<!-- table horizontal -->
<table border="1" cellpadding="0" cellspacing="0" class="table_hor_02">
<colgroup>
    <col width="44px" />
    <col width="48px" />
    <col  />
    <col />
    <col width="150px" />
    <col width="200px" />
</colgroup>
<thead>
<tr>
    <th class="chk"><input type="checkbox" title="Select All" id="select_all" onClick="adminPageContents.execSelectAll(this.id);" class="input_chk" /></th>
    <th>No.</th>
    <th><a href="#" class="">Name</a></th>
    <th><a href="#" class="">URL</a></th>
    <th><a href="#" class="">Date</a></th>
    <th class="no_border">Options</th>
</tr>
</thead>
<tbody>
<?php if($aData){?>
<?php foreach($aData as $rows){?>
    <tr onmouseover="this.className='over'" onmouseout="this.className=''">
        <td><input type="checkbox" title="" value="{$rows.ped_idx}" name="idx_val[]" class="input_chk" /></td>
        <td>1</td>
        <td><a href="{$rows.peu_url}" target="_blank" title="Edit Schedule"><?php echo $rows['name'];?></a></td>
        <td class="table_subtitle"><?php echo $rows['url_idx'] ?></td>
        <td><?php echo $rows['comment_date'];?></td>
        <td>
            <!--<a href="#none" class="btn_nor_02 btn_width_add" title="Add comment on the link" onclick="PG_Easycomment_content.execShowComment();">Comment</a>-->
            <a href="#none" class="btn_nor_01 btn_width_st1" title="Edit Comment" onclick="adminPageContents.execEditComment(<?php echo $rows['idx']?>);return false;">Edit</a>
            <a href="#none" class="btn_nor_01 btn_width_st1" title="Delete Comment" onclick="adminPageContents.execSingleDelete(<?php echo $rows['idx']?>);return false;">Delete</a>
        </td>
    </tr>
<?php } ?>
<?php }else{?>
<tr>
    <td colspan="6" class="not_fnd">There's no content.</td>
</tr>
<?php }?>
</tbody>
</table>
<!-- // table horizontal -->
<div class="table_header_area">
    <ul class="row_2">
        <!--<li>
            <select>
                <option>Select Action</option>
                <option>Expected</option>
                <option>Juan Dela Cruz</option>
                <option>Delete</option>
                <option>Move</option>
            </select>
            <a href="#none" class="btn_nor_01 btn_width_st1" title="Apply selected action">Apply</a>
        </li>-->
        <li>
            <a href="#none" class="btn_nor_01 btn_width_st1" title="Delete selected schedule" onclick="PG_Easycomment_content.execDeleteAll();return false;">Delete</a>
        </li>
        <li class="show">
            <a href="#none" onclick="adminPageContents.execAddComment();" class="btn_nor_01 btn_width_add" title="Add Comment"style="width:100px;height:13px"  >Add Comment</a>
        </li>
    </ul>
</div>
<!-- pagination -->
<div class="pagination">
<!--
    <span title="Previous">prev</span>
    <a href="#none" class="current">1</a>
    <a href="#none" class="num">2</a>
    <a href="#none" class="num">3</a>
    <a href="#none" class="num">4</a>
    <a href="#none" class="num">5</a>
    <a href="#none" class="num">6</a>
    <a href="#none" class="num">7</a> ...
    <a href="#none" class="num">41</a>
    <a href="#none" class="activity" title="Next">next</a>
-->

</div>
<input type="hidden" id="{$sPrefix}server_url" value="{$sServerUrl}">
<!-- // pagination -->
<!-- // table horizontal -->


<div style="display:none;" id="{$sPrefix}edit_popup" title="Edit Comment">
<table border="1" cellspacing="0" class="table_input_vr">
    <form>
    <input type="hidden" id="{$sPrefix}edit_idx">
    <colgroup>
        <col width="115px" />
        <col width="*" />
    </colgroup>
    <tr><th><label for="textarea_memo">URL</label></th><td>: <span id="{$sPrefix}edit_url"></span></td></tr>
    <tr><th><label for="textarea_memo">Name</label></th><td>: <span id="{$sPrefix}edit_name" ></span></td></tr>
    <tr>
        <th><label for="textarea_memo">Comment</label></th>
        <td>
            <textarea id="{$sPrefix}edit_comment"></textarea>
        </td>
    </tr>
    </table>
    <center><a href="#none" class="btn_ly" onclick="PG_Easycomment_content.execSaveComment()">Save</a> <a href="#none" onclick="PG_Easycomment_content.execCloseDialog('{$sPrefix}edit_popup')" class="btn_ly">Cancel</a></center>
    </form>
    <br />
    <br />
</div>

<div style="display:none;" id="<?php echo $sPrefix;?>add_comment">
    <div class="admin_popup_contents">
    <table border="1" cellspacing="0" class="table_input_vr">
        <form id="{$sPrefix}add_comment_form">
        <input type="hidden" id="{$sPrefix}edit_idx">
        <colgroup>
            <col width="65px" />
            <col width="320px" />
        </colgroup>
        <tr><th><label for="textarea_memo">URL</label></th><td><span class="neccesary">*</span> <input style="width:380px !important;" id="{$sPrefix}add_url"  type="text"/></td></tr>
        <tr><th><label for="textarea_memo">Name</label></th><td><span class="neccesary">*</span> <input style="width:380px !important;"  id="{$sPrefix}owner_name" type="text"/></td></tr>
        <tr>
            <th><label for="textarea_memo">Comment : </label></th>
            <td>
                <textarea id="{$sPrefix}add_comment" style="resize:none;height:90px;"></textarea>
            </td>
        </tr>
        </table>
        <center><a href="#none" class="btn_ly" onclick="PG_Easycomment_content.execSaveUserComment('{$sQrtStrings}')">Save</a> <a href="#none" onclick="PG_Easycomment_content.execCloseDialog('{$sPrefix}comment_popup')" class="btn_ly">Cancel</a></center>
        </form>
    </div>
</div>


<div style="display:none;" id="<?php echo $sPrefix;?>edit_comment">
    <div class="admin_popup_contents">
    <table border="1" cellspacing="0" class="table_input_vr">
        <form id="{$sPrefix}edit_comment_form">
        <input type="hidden" id="<?php echo $sPrefix?>edit_idx">
        <colgroup>
            <col width="65px" />
            <col width="320px" />
        </colgroup>
        <tr><th><label for="textarea_memo">URL</label></th><td><span class="neccesary">*</span> <input style="width:380px !important;" id="<?php echo $sPrefix;?>edit_url"  type="text"/></td></tr>
        <tr><th><label for="textarea_memo">Name</label></th><td><span class="neccesary">*</span> <input style="width:380px !important;"  id="<?php echo $sPrefix;?>edit_name" name="<?php echo $sPrefix;?>edit_name" type="text"/></td></tr>
        <tr>
            <th><label for="textarea_memo">Comment : </label></th>
            <td>
                <textarea id="<?php echo $sPrefix;?>edit_user_comment" style="resize:none;height:90px;"></textarea>
            </td>
        </tr>
        </table>
        <center><a href="#none" class="btn_ly" onclick="adminPageContents.execUpdate()">Save</a> <a href="#none" onclick="PG_Easycomment_content.execCloseDialog('{$sPrefix}comment_popup')" class="btn_ly">Cancel</a></center>
        </form>
    </div>
</div>
<div style="display:none;" id="<?php echo $sPrefix;?>delete_single_comment">
    <div class="admin_popup_contents">
        Are you sure you want to delete this record?
        <br />
        <br />
        <a class="btn_nor_01 btn_width_st1" href="#none" style='cursor:pointer;' title="Delete" onclick="adminPageContents.execDelete()"> Delete <a/>

    </div>
</div>