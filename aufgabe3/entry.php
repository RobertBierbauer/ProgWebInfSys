<?php

class Entry{
	
	private $id;
	private $title;
	private $description;
	

	public function __construct($id, $t, $d){
		$this->id = $id;
		$this->title = $t;
		$this->description = $d;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getTitle(){
		return $this->title;
	}
	
	public function getDescriptionFormat(){
		return $this->parseText($this->description);
	}
	
	public function getDescription(){
		return $this->description;
	}
	
	public function __toString(){
		return "<html>".
					"<h3>Titel: ".$this->title."</h3>".
					"<p>Beschreibung: ".$this->parseText($this->description)."</p>".
					"<a href='wiki.php?title=".$this->title."' class='btn btn-small btn-danger'>Anzeigen</a>".
				"</html>";
	}
	
	public function edit(){
		echo "Edit";
	}
	
	private function parseText($text){
		//search headlines
		$text2 = preg_replace("/---(.*?)---/","<h4>\\1</h4>",$text);
		
		//search links
		//$text3 = preg_replace_callback("/\[\[(.*?)\]\]/","getIdByTitle",$text2);
		//$text3 =  preg_replace("/\[\[(.*?)\]\]/", "<a href=\"show.php?id=' . getIdByTitle('\\1') . '\">\\1</a>" , $text2);
		$text3 = preg_replace("/\[\[(.*?)\]\]/e", '"<a href=show.php?id=".getIdByTitle("$1").">$1</a>"', $text);
		return $text3;
	}

}

?>