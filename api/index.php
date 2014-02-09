<?php
	require 'config.php';
	require 'vendor/autoload.php';


	$helper = new Helpers\ResolutionHelper();
	echo $helper->fullSentence('wordlist.txt');
?>