<?php

class Entry{
	
	private $id;
	private $title;
	private $text;
	

	public function __construct($id, $t, $d){
		$this->id = $id;
		$this->title = $t;
		$this->text = $d;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getTitle(){
		return $this->title;
	}
	
	public function getTextFormat(){
		return $this->parseText($this->text);
	}
	
	public function getText(){
		return $this->text;
	}
	
	public function __toString(){
		return "<html>".
					"<h3>Titel: ".$this->title."</h3>".
					"<p>Beschreibung: ".$this->parseText($this->text)."</p>".
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
		$db = new DatabaseConnect();
		$text3 = preg_replace("/\[\[(.*?)\]\]/e", '"<a href=show.php?id=".$db->getIdByTitle("$1").">$1</a>"', $text);
		return $text3;
	}

}

?>