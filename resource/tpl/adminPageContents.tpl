<table border="1" cellpadding="0" cellspacing="0" class="table_hor_03">
<tr>
    <td>
        <table cellpadding="3" cellspacing="3">
            <tr>
                <td><span  class="title">Show by</span></td>
                <td>
                    <select class="optionbox" onchange="adminPageContents.execDateRange();" id="<?php echo $sPrefix;?>date_range">
                        <option id="1" value="custom" <?php if($sDateRange=='custom'){?>selected="selected"<?php }?>>Customized Search</option>
                        <option id="2" value="today"<?php if($sDateRange=='today'){?>selected="selected"<?php }?>>Today</option>
                        <option id="3" value="currentWeek" <?php if($sDateRange=='currentWeek'){?>selected="selected"<?php }?>>Current Week</option>
                        <option id="4" value="currentMonth"<?php if($sDateRange=='currentMonth'){?>selected="selected"<?php }?>>Current Month</option>
                    </select></td>

                <td><span  class="title">Start Date:</span> <input type="text" value="<?php echo $sStartDate;?>" id="<?php echo $sPrefix;?>start_date"  name="<?php echo $sPrefix;?>start_date" class="input_text" readonly="readonly" onclick="adminPageContents.execCustomDateRange()" /><a href="#none"><label for="<?php echo $sPrefix;?>start_date" ><img style="cursor:pointer;" src="<?php echo $sImagePath;?>calendar_icon.png" /></label></a></td>
                <td><span  class="title">End Date: </span><input type="text" value="<?php echo $sEndDate;?>" id="<?php echo $sPrefix;?>end_date"  name="<?php echo $sPrefix;?>end_date" class="input_text" readonly="readonly" onclick="adminPageContents.execCustomDateRange()" /><a href="#none"><label for="<?php echo $sPrefix;?>end_date" ><img style="cursor:pointer;"  src="<?php echo $sImagePath;?>calendar_icon.png" /></label></a></td>

            </tr>
            <tr>
                <td><span  class="title">Search Keyword</span></td>
                <td>
                    <select class="optionbox" id="<?php echo $sPrefix;?>field_search">
                        <option value="visitor_name"<?php if($sFieldSearch=='visitor_name'){?>selected="selected"<?php }?>>Name</option>
                        <option value="visitor_comment" <?php if($sFieldSearch=='visitor_comment'){?>selected="selected"<?php }?>>Comment</option>
                        <option value="url"<?php if($sFieldSearch=='url'){?>selected="selected"<?php }?>>URL</option>
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
            <a href="#none" class="btn_nor_01 btn_width_st1" title="Delete Comment" onclick="adminPageContents.execMultipleDelete();">Delete</a>
        </li>
        <li class="show">
            <label for="{$sPrefix}show_row">Show Rows</label>
            <select id="<?php echo $sPrefix?>show_row" onchange="adminPageContents.execShowRows('<?php echo $sQrySearch . $sQrySort?>');">
                <option <?php if($iRow==10){?>selected="selected" <?php }?>>10</option>
                <option <?php if($iRow==20 || $iRow==''){?>selected="selected" <?php }?>>20</option>
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
    <th><a href="<?php echo $sUrlContents;?>&sort=visitor_name&type=<?php if($sSort=='visitor_name'){ echo $sSortType;}else{ echo 'asc';}?><?php echo $sQrySearch . $sQryRow . $sQryPage;?>" class="<?php if($sSort=='visitor_name'){echo $sSortType;}?>">Name</a></th>
    <th><a href="<?php echo $sUrlContents;?>&sort=url&type=<?php if($sSort=='url'){ echo  $sSortType;}else{ echo 'asc';}?><?php echo $sQrySearch . $sQryRow . $sQryPage;?>" class="<?php if($sSort=='url'){echo $sSortType;}?>">URL</a></th>
    <th><a href="<?php echo $sUrlContents;?>&sort=comment_date&type=<?php if($sSort=='comment_date'){ echo  $sSortType;}else{ echo 'asc';}?><?php echo $sQrySearch . $sQryRow . $sQryPage;?>" class="<?php if($sSort=='comment_date'){echo $sSortType;}?>">Date</a></th>
    <th class="no_border">Options</th>
</tr>
</thead>
<tbody>
<?php if($aData){?>
<?php foreach($aData as $rows){?>
    <tr onmouseover="this.className='over'" onmouseout="this.className=''">
        <td><input type="checkbox" onclick="adminPageContents.execResetSelect();" value="<?php echo $rows['idx'];?>" name="idx_val[]" class="input_chk" /></td>
        <td><?php echo $rows['row'];?></td>
        <td><a href="#none"  onclick="adminPageContents.execEditComment(<?php echo $rows['idx']?>)" title="Edit Schedule"><?php echo $rows['name'];?></a></td>
        <td class="table_subtitle"><?php echo $rows['url_idx'] ?></td>
        <td><?php echo $rows['comment_date'];?></td>
        <td>
            <!--<a href="#none" class="btn_nor_02 btn_width_add" title="Add comment on the link" onclick="PG_Easycomment_content.execShowComment();">Comment</a>-->
            <a href="#none" class="btn_nor_01 btn_width_st1" title="Edit Comment" onclick="adminPageContents.execEditComment(<?php echo $rows['idx']?>)">Edit</a>
            <a href="#none" class="btn_nor_01 btn_width_st1" title="Delete Comment" onclick="adminPageContents.execSingleDelete(<?php echo $rows['idx']?>)">Delete</a>
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
            <a href="#none" class="btn_nor_01 btn_width_st1" title="Delete selected schedule" onclick="adminPageContents.execMultipleDelete();">Delete</a>
        </li>
        <li class="show">
            <a href="#none" onclick="adminPageContents.execAddComment();" class="btn_nor_01 btn_width_add" title="Add Comment"style="width:100px;height:13px"  >Add Comment</a>
        </li>
    </ul>
</div>

<!-- pagination -->
<?php echo $sPagination;?>
<!-- pagination -->

<input type="hidden" id="{$sPrefix}server_url" value="{$sServerUrl}">
<!-- // pagination -->
<!-- // table horizontal -->


<div style="display:none;" id="{$sPrefix}edit_popup" title="Edit Comment">
    <form>
    <table border="1" cellspacing="0" class="table_input_vr">
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
    <form id="{$sPrefix}add_comment_form">
    <input type="hidden" id="{$sPrefix}edit_idx">
    <table border="1" cellspacing="0" class="table_input_vr">
        <colgroup>
            <col width="65px" />
            <col width="320px" />
        </colgroup>
        <tr><th><label for="textarea_memo">URL</label></th><td><span class="neccesary">*</span> <input style="width:400px !important;" id="{$sPrefix}add_url"  type="text"/></td></tr>
        <tr><th><label for="textarea_memo">Name</label></th><td><span class="neccesary">*</span> <input style="width:400px !important;"  id="{$sPrefix}owner_name" type="text"/></td></tr>
        <tr>
            <th><label for="textarea_memo">Comment : </label></th>
            <td>
                <textarea id="{$sPrefix}add_comment"  style="resize:none;height:120px;padding:5px;"></textarea>
            </td>
        </tr>
        </table>
        <center><a href="#none" class="btn_ly" onclick="adminPageContents.execSave()">Save</a> <a href="#none" onclick="PG_Easycomment_content.execCloseDialog('{$sPrefix}comment_popup')" class="btn_ly">Cancel</a></center>
        </form>
    </div>
</div>


<div style="display:none;" id="<?php echo $sPrefix;?>edit_comment">
    <div class="admin_popup_contents">
        <form id="<?php echo $sPrefix;?>edit_comment_form" mehtod="post">
        <input type="hidden" id="<?php echo $sPrefix?>edit_idx">
        <table border="1" cellspacing="0" class="table_input_vr">
        <colgroup>
            <col width="65px" />
            <col width="320px" />
        </colgroup>
        <tr><th><label for="textarea_memo">URL</label></th><td> <span id="<?php echo $sPrefix;?>edit_url" /></span></td></tr>
        <tr><th><label for="textarea_memo">Name</label></th><td> <span id="<?php echo $sPrefix;?>edit_name"></span></td></tr>
        <tr>
            <th><label for="textarea_memo">Comment : </label></th>
            <td>
                <textarea id="<?php echo $sPrefix;?>edit_user_comment"  fw-filter="isFill" fw-label="<?php echo $sPrefix;?>edit_user_comment" style="resize:none;height:120px;padding:5px"></textarea>
            </td>
        </tr>
        </table>
        <center><a href="#none" class="btn_ly" onclick="adminPageContents.execUpdate('<?php echo $sQrySearch . $sQrySort . $sQryRow . $sQryPage;?>')">Save</a> <a href="#none" onclick="PG_Easycomment_content.execCloseDialog('{$sPrefix}comment_popup')" class="btn_ly">Cancel</a></center>
        </form>
    </div>
</div>

<div style="display:none;" id="<?php echo $sPrefix;?>delete_single_comment">
    <div class="admin_popup_contents">
        Are you sure you want to delete this record?
        <br />
        <br />
        <a class="btn_nor_01 btn_width_st1" href="#none" style='cursor:pointer;' title="Delete" onclick="adminPageContents.execDeleteSConfirm()"> Delete </a>
    </div>
</div>

<div style="display:none;" id="<?php echo $sPrefix;?>delete_multiple_comment">
    <div class="admin_popup_contents">
        Are you sure you want to delete the record?
        <br />
        <br />
        <a class="btn_nor_01 btn_width_st1" href="#none" style='cursor:pointer;' title="Delete" onclick="adminPageContents.execDeleteMConfirm()"> Delete </a>
    </div>
</div>

