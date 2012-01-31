<div id="{$sPrefix}success" style="display:none;"></div>
<div id="{$sPrefix}error" style="display:none;"></div>
<table border="1" cellpadding="0" cellspacing="0" class="table_hor_03">
<tr>
    <td>
        <table cellpadding="3" cellspacing="3">
            <tr>
                <td><span  class="title">Show by</span></td>
                <td>
                    <select class="optionbox" onchange="PG_Easycomment_content.execGetTime();" id="{$sPrefix}date_search">
                        <option value="customs">Customized Search</option>
                        <option value="today">Today</option>
                        <option value="current_week">Current Week</option>
                        <option value="current_month">Current Month</option>
                    </select></td>
                
                <td><span  class="title">Start Date:</span> <input type="text" value="" id="{$sPrefix}start_date" class="input_text" readonly="readonly" /><a href="#none"><label for="{$sPrefix}start_date" ><img style="cursor:pointer;" src="images/calendar_icon.png" /></label></a></td>
                <td><span  class="title">End Date: </span><input type="text" value="" id="{$sPrefix}end_date"  class="input_text" readonly="readonly" /><a href="#none"><label for="{$sPrefix}end_date" ><img style="cursor:pointer;"  src="images/calendar_icon.png" /></label></a></td>
                
            </tr>
            <tr>
                <td><span  class="title">Search Keyword</span></td>
                <td>
                    <select class="optionbox" id="{$sPrefix}field_type">
                        <option value="name"  {if $sField=='name' || $sField==''}selected="selected"{/if}>Name</option>
                        <option value="url" {if $sField=='url'}selected="selected"{/if}>URL</option>
                    </select>
                </td>
                
                <td colspan="2"><input type="text" value="" title="Search by URL or Name" id="{$sPrefix}keyword" class="input_search"/> <a href="#none" class="btn_nor_01 btn_width_search" title="Search Keyword" onclick="PG_Easycomment_content.execSearch();return false;" style="width:45px;height:13px" >Search</a><a href="#none" onclick="PG_Easycomment_content.execReset();" class="add_link" title="Reset to default">Reset</a></td>          
            </tr>
        </table>
    </td>
</tr>   
</table>
<br />  
<div class="table_header_area">
    <ul class="row_2">
        <li>
            <a href="#none" class="btn_nor_01 btn_width_add" style="width:100px;height:13px" title="Add Comment" onclick="adminPageContents.execAddComment();" >Add Comment</a>
            <a href="#none" class="btn_nor_01 btn_width_st1" title="Delete Comment" onclick="PG_Easycomment_content.execDeleteAll();return false;">Delete</a>
        </li>
        <li class="show">
            <label for="{$sPrefix}show_row">Show Rows</label>
            <select id="{$sPrefix}show_row" onchange="PG_Easycomment_content.execShowRows('{$sQrySort}{$sQrySearch}');">
                <option {if $iTotalRow==10}selected="selected"{/if}>10</option>
                <option {if $iTotalRow==20}selected="selected"{/if}>20</option>
                <option {if $iTotalRow==30}selected="selected"{/if}>30</option>
                <option {if $iTotalRow==50}selected="selected"{/if}>50</option>
                <option {if $iTotalRow==100}selected="selected"{/if}>100</option>
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
    <col/>              
    <col width="150px" />               
    <col width="200px" />       
</colgroup>
<thead>         
<tr>
    <th class="chk"><input type="checkbox" title="" onClick="PG_Easycomment_content.execSelectAll();" class="input_chk" /></th>
    <th>No.</th>
    <th><a href="#" class="">URL</a></th>             
    <th><a href="#" class="">Name</a></th>      
    <th><a href="#" class="">Date</a></th>      
    <th class="no_border">Options</th>  
</tr>
</thead>
<tbody>
<?php if($aData){?>
<?php foreach($aData as $rows){?>
    <tr onmouseover="this.className='over'" onmouseout="this.className=''">
        <td><input type="checkbox" title="" value="{$rows.ped_idx}" name="{$sPrefix}check_box" class="input_chk" /></td>
        <td>1</td>
        <td class="table_subtitle"><a href="{$rows.peu_url}" target="_blank" title="Edit Schedule"><?php echo $rows['url_idx'] ?></a></td>
        <td><?php echo $rows['name'];?></td>               
        <td><?php echo $rows['comment_date'];?></td>                
        <td>
            <!--<a href="#none" class="btn_nor_02 btn_width_add" title="Add comment on the link" onclick="PG_Easycomment_content.execShowComment();">Comment</a>-->
            <a href="#none" class="btn_nor_01 btn_width_st1" title="Edit Comment" onclick="adminPageContents.execEditComment();return false;">Edit</a>
            <a href="#none" class="btn_nor_01 btn_width_st1" title="Delete Comment" onclick="PG_Easycomment_content.execDeleteAll();return false;">Delete</a>
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
        <tr><th><label for="textarea_memo">URL</label></th><td><span class="neccesary">*</span> <input style="width:320px !important;" id="{$sPrefix}add_url"  type="text"/></td></tr>
        <tr><th><label for="textarea_memo">Name</label></th><td><span class="neccesary">*</span> <input style="width:320px !important;"  id="{$sPrefix}owner_name" type="text"/></td></tr>
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
        <form id="{$sPrefix}add_comment_form">
        <input type="hidden" id="{$sPrefix}edit_idx">
        <colgroup>
            <col width="65px" />
            <col width="320px" />
        </colgroup>
        <tr><th><label for="textarea_memo">URL</label></th><td><span class="neccesary">*</span> <input style="width:320px !important;" id="{$sPrefix}add_url"  type="text"/></td></tr>
        <tr><th><label for="textarea_memo">Name</label></th><td><span class="neccesary">*</span> <input style="width:320px !important;"  id="{$sPrefix}owner_name" type="text"/></td></tr>
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