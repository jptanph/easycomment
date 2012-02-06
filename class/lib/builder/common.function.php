<?php

function getVar( $sVarName )
{
	$returnValue = '';
	$gVars = array_merge( $_POST , $_GET , $_REQUEST , $_FILES );
	if( array_key_exists ( $sVarName ,  $gVars) && isset ( $gVars[ $sVarName ] ) )
	{
		$returnValue = $gVars[$sVarName];
	}
	else
	{
		$returnValue = FALSE;
	}
	return $returnValue;
}

function checkVar($var)
{
	echo "<pre>";
		var_dump($var);
	echo "</pre>";
}

function limitChar($str , $perStr)
{
	$countStr = strlen($str);
	$resultStr = '';

	if($countStr < $perStr){
		return $str;
	}else{
		for( $i = 0 ; $i < $perStr ; $i++ )
		{
			if( $i <= $perStr  )
			{
				$resultStr .= $str[$i];
			}
		}
		return $resultStr . '...';
	}
}

function sliceBracket($sStr)
{
	$sResult = str_replace('[','\[',$sStr);
	$sResult = str_replace(']','\]',$sResult);
	return $sResult;
}

function pageLinksDrawer($iPageNum,$iTotalRows,$iLimit,$sWebPage,$qryStr){

	$limit = $iLimit;
	/** Get page number. If page is not set then assign 1 as default value.**/
	$current_page = $iPageNum;

	/** Adjusted the page number by 2**/
	$adjust = 2;

	/** Go to page itself.**/
	$web_page = $sWebPage;

	/** Created an offset  when the page number is set.**/
	$offset = ($current_page - 1) * $limit;

	/** Total page number to create.**/
	$total_page = ceil($iTotalRows/$limit); // Total page links

	/** Variables for displaying the pagination**/

	if($current_page>$total_page){
		$current_page = $total_page;
	}
	/** Loop trough the total pages.**/
	$paginate = ($iPageNum==1) ? "<span title='Previous'>prev</span>" : "<a href='$web_page?page=".($iPageNum-1)."$qryStr' class='activity' title='Prev'>prev</a>";

	for( $link = 1 ; $link <= $total_page ; $link++){

		/** Disable the current page when click**/
		if($link==$current_page){
			$paginate.="<a href='$web_page?page=$link$qryStr'class='current'>$link</a>";
		}

		/** Create page number starting from 1 **/
		if(($link-$current_page)<=$adjust && $current_page<($adjust+3) && $link!=$current_page){
			$paginate.="<a href='$web_page?page=$link$qryStr' class='num'> $link </a>";
		}

		/** Create the middle page number  and hide left and right page number.**/
		if($link<$total_page+($adjust+$adjust) && $current_page>($adjust+$adjust) && $current_page<1+($link+2) && $current_page>=($link-$adjust) && $link!=$current_page){
			$paginate.="<a href='$web_page?page=$link$qryStr' class='num'> $link </a>";
		}

		/** Create page number 1 and triple dot (...)**/
		if($link==1 && $link !=$current_page && $current_page>($adjust+2)){
			$paginate.="<a href='$web_page?page=$link$qryStr' class='num'> $link </a> . . . ";
		}

		/** Create last page number and triple dot (...)**/
		if($link==$total_page && $current_page!=$total_page && $current_page<=$total_page-($adjust+1)){
			$paginate.=". . . <a href='$web_page?page=$link$qryStr' class='num'> $link </a>";
		}
	}
	$paginate  .= ($iPageNum==$total_page) ? "<span title='Next'>next</span>" : "<a href='$web_page?page=".($iPageNum+1)."$qryStr' class='activity' title='Next'>next</a>";
	/** Return result pages **/
	return $paginate;

}