<?php
	require_once('databaseConnect.php');
	$db = new DatabaseConnect();
	
	$baseText = "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, ".
				"sed diam nonumy eirmod tempor invidunt ut labore et dolore ".
				"magna aliquyam erat, sed diam voluptua. At vero eos et accusam ".
				"et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata ".
				"sanctus est Lorem ipsum dolor sit amet.";
	
	//to generate a random title
	$randomTitleArray = array("aa", "bb", "cc", "dd", "ee");
	
	for($i = 0; $i <10000; $i++){
		
		$generatorTitle = $randomTitleArray[rand(0, 4)];
		$generatorTitle .= $randomTitleArray[rand(0, 4)];
		$generatorTitle .= $randomTitleArray[rand(0, 4)];
		$generatorTitle .= $randomTitleArray[rand(0, 4)];
		$generatorTitle .= $i;
		
		$entryLength = rand(0, 6);
		
		//random length of entry text with different probabilities
		if($entryLength <= 3){
			$entryLength = rand(60, 180);
			$amountOfLinks = 3;
		}
		elseif($entryLength <= 5){
			$entryLength = rand(260, 390);
			$amountOfLinks = 5;
		}
		else{
			$entryLength = rand(450, 600);
			$amountOfLinks = 7;
		}
		
		$numberAllEntries = $db->getNumberEntries();
		//set amount of links in entry text
		
		if($amountOfLinks > $numberAllEntries){
			$amountOfLinks = $numberAllEntries;
		}
		
		
		$links = $db->getRandomFromDatabase($amountOfLinks);
		
		$generatorEntryText = "";
		
		//bring entry text to necessary length
		while(strlen($generatorEntryText) < $entryLength){
			$generatorEntryText .= $baseText;
		}
		
		
		//cut text to supposed length
		$generatorEntryText = substr($generatorEntryText, 0, $entryLength).".";
		
		$distanceLinks = strlen($generatorEntryText) % $amountOfLinks;
		$distanceLinks = (strlen($generatorEntryText) - $distanceLinks) / $amountOfLinks;
		
		foreach($links as $link){
			$generatorEntryText = substr($generatorEntryText, 0, ($distanceLinks))." [[$link]] ".substr($generatorEntryText, ($distanceLinks), strlen($generatorEntryText));
			$distanceLinks *= 2;
			$distanceLinks += (strlen($link)+6);
		}
		
		$db->insertEntryWithoutLink($generatorTitle, $generatorEntryText);
	}
	header( 'Location: entries.php');


?>