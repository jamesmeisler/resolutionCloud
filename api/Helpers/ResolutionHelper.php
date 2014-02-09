<?php
	namespace Helpers;

	Class ResolutionHelper
	{
		private $wordFile;

		public function __construct()
		{
			
		}

		public function setWordList($filename)
		{

			$ignored = array('a','be','to','','the','of','for','into','and','with', 'my');
			ini_set("auto_detect_line_endings", true);

			$file = file_get_contents("files/$filename");
			
			$words = explode(' ',str_replace("\n", " ", $file));
			$wordCount = array();
			
			foreach($words as $word) {

				if (isset($wordCount[$word]))
				{
					$wordCount[$word]++;
				} elseif (!in_array($word, $ignored)){
					$wordCount[$word] = 1;
				}

			}
			$keys = array_keys($wordCount);
			$values = array_values($wordCount);
			$max = max($values);
			$wordCount = array_map(function($value) use ($max) { return $value/$max; }, $wordCount);
			$return = array();
			foreach($wordCount as $k => $word) {
				$return[] = array(
					'word' => $k,
					'size' => $word
				);
			}

			return json_encode($return);
		}

		public function fullSentence($filename)
		{
			ini_set("auto_detect_line_endings", true);
			$file = file_get_contents("files/$filename");
			$sentences = explode("\n", $file);
			return json_encode($sentences);
		}
	}

?>