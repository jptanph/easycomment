<?php

class Input_class
{
	private $_aReplaceWords;
	private $_aBadWords;

	public function __construct()
	{
		/** Just construct the object **/
	}

	public function filter_data($sData)
	{
		return $this->_sanitize_data($sData);
	}

	private function _sanitize_data($sData)
	{
		$sNewWord = '';
		$iCharCount = strlen($sData);

		for($i = 0 ; $i < $iCharCount ; $i++)
		{
			if($sData[$i] =='\\')
			{
				$sNewWord .= '';
			}
			else
			{
				$sNewWord .= htmlentities( $sData[$i] );
			}
		}

		return $this->_strip_quotes($sNewWord);
	}

	private function _strip_quotes($sData)
	{
		return filter_var($sData,FILTER_SANITIZE_MAGIC_QUOTES);
	}

	public function filter_word($sSentence)
	{
		$sNewWord = '';
		$sSubWords = '';
		$sExplodeSentence = explode(' ',$sSentence);

		foreach($sExplodeSentence as $key => $val)
		{
			$sSubWords = $this->_generate_word($this->_aReplaceWords);

			if( in_array ( $val , $this->_aBadWords ) )
			{
				$sNewWord .= $sSubWords . ' ';
			}
			else
			{
				$sNewWord .= $val . ' ';
			}
		}
		return $sNewWord;
	}

	public function set_filter($aBadWords = array(), $aReplaceWords = array())
	{
		$this->_aReplaceWords	 = 	$aReplaceWords;
		$this->_aBadWords	 = 	$aBadWords;
	}

	private function _generate_word($aWords)
	{
		shuffle($aWords);
		foreach($aWords as $key => $val)
		{
			return $val;
		}
	}
	public function html_decode($sData)
	{
		return htmlspecialchars_decode($sData);
	}
}