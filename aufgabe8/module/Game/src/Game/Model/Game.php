<?php
namespace Game\Model;

class Game
{
	public $id = "";
	public $player1Name = "";
	public $player1Email = "";
	public $player2Name = "";
	public $player2Email = "";
	public $player1Choice = "0";
	public $player2Choice = "0";
	public $winner = "0";

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
	}
	
	public function gameToMongoArray(){
		return array("_id" => $this->id, "player1Name" => $this->player1Name, "player1Email" => $this->player1Email, "player2Name" => $this->player2Name, "player2Email" => $this->player2Email, "player1Choice" => $this->player1Choice, "player2Choice" => $this->player2Choice, "winner" => $this->winner);
	}
	
	public function mongoArrayToGame($data)
	{
		$this->id     		 = $data['_id'];
		$this->player1Name	 = $data['player1Name'];
		$this->player1Email  = $data['player1Email'];
		$this->player2Name 	 = $data['player2Name'];
		$this->player2Email	 = $data['player2Email'];
		$this->player1Choice = $data['player1Choice'];
		$this->player2Choice = $data['player2Choice'];
		$this->winner 		 = $data['winner'];
	}
	
	public function setID($id){
		$this->id = $id;
	}
	
	public function setPlayer2Choice($player2Choice){
		$this->player2Choice = $player2Choice;
	}
	
	public function setWinner($winner){
		$this->winner = $winner;
	}
}