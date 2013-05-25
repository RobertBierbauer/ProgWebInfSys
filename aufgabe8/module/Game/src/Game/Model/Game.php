<?php
namespace Game\Model;


class Game
{
	protected $mongoClient;
	public $id = "";
	public $player1Name = "";
	public $player1Email = "";
	public $player2Name = "";
	public $player2Email = "";
	public $player1Choice = "0";
	public $player2Choice = "0";
	public $winner = "0";
	public $player1Message = "";
	public $player2Message = "";

	public function exchangeArray($data)
	{
		$this->id     = (isset($data['id'])) ? $data['id'] : hash('sha1', $data['player1Name'].$data['player2Name'].time());
		$this->player1Name = (isset($data['player1Name'])) ? $data['player1Name'] : $this->player1Name;
		$this->player1Email = (isset($data['player1Email'])) ? $data['player1Email'] : $this->player1Email;
		$this->player2Name = (isset($data['player2Name'])) ? $data['player2Name'] : $this->player2Name;
		$this->player2Email = (isset($data['player2Email'])) ? $data['player2Email'] : $this->player2Email;
		$this->player1Choice = (isset($data['player1Choice'])) ? $data['player1Choice'] : $this->player1Choice;
		$this->player2Choice = (isset($data['player2Choice'])) ? $data['player2Choice'] : $this->player2Choice;
		$this->winner = (isset($data['winner'])) ? $data['winner'] : $this->winner;
		$this->player1Message = (isset($data['player1Message'])) ? $data['player1Message'] : $this->player1Message;
		$this->player2Message = (isset($data['player2Message'])) ? $data['player2Message'] : $this->player2Message;
	}
	
	
	public function setID($id){
		$this->id = $id;
	}
	
	public function setPlayer2Choice($player2Choice){
		$this->player2Choice = $player2Choice;
	}
	public function setPlayer2Message($player2Message){
		$this->player2Message = $player2Message;
	}
	
	public function determineWinner(){
		$player1Choice = $this->player1Choice;
		$player2Choice = $this->player2Choice;
		 
		if($player1Choice == $player2Choice){
			$this->setWinner(0);
		}
		else if( ($player1Choice == "1" && ($player2Choice == "3" || $player2Choice == "5")) ||
				($player1Choice == "2" && ($player2Choice == "1" || $player2Choice == "5")) ||
				($player1Choice == "3" && ($player2Choice == "2" || $player2Choice == "4")) ||
				($player1Choice == "4" && ($player2Choice == "1" || $player2Choice == "3")) ||
				($player1Choice == "5" && ($player2Choice == "4" || $player2Choice == "2"))){
			$this->setWinner(2);
		}
		else{
			$this->setWinner(1);
		}
	}
	
	private function setWinner($winner){
		$this->winner = $winner;
	}
	
	private function gameToMongoArray(){
		return array("_id" => $this->id, "player1Name" => $this->player1Name, "player1Email" => $this->player1Email, "player2Name" => $this->player2Name, "player2Email" => $this->player2Email, "player1Choice" => $this->player1Choice, "player2Choice" => $this->player2Choice, "winner" => $this->winner, "player1Message" => $this->player1Message, "player2Message" => $this->player2Message);
	}
	
	private function mongoArrayToGame($data)
	{
		$this->id     		 = $data['_id'];
		$this->player1Name	 = $data['player1Name'];
		$this->player1Email  = $data['player1Email'];
		$this->player2Name 	 = $data['player2Name'];
		$this->player2Email	 = $data['player2Email'];
		$this->player1Choice = $data['player1Choice'];
		$this->player2Choice = $data['player2Choice'];
		$this->winner 		 = $data['winner'];
		$this->player1Message = $data['player1Message'];
		$this->player2Message = $data['player2Message'];
	}
	
	public function findByID($id){
		$this->mongoArrayToGame($this->getMongoClient()->findOne(array('_id' => $id)));
	}
	
	public function save(){
		$this->getMongoClient()->save($this->gameToMongoArray());
	}
	
	private function getMongoClient()
	{
		if (!$this->mongoClient) {
			$this->mongoClient = new \MongoClient();
			$this->mongoClient = $this->mongoClient->game->games;
		}
		return $this->mongoClient;
	}
}