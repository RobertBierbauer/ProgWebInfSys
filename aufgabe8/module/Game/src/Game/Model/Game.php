<?php
namespace Game\Model;

class Game
{
	public $id;
	public $player1Name;
	public $player1Email;
	public $player2Name;
	public $player2Email;
	public $player1Choice;
	public $player2Choice;
	protected $inputFilter;

	public function exchangeArray($data)
	{
		$this->id     = (isset($data['id'])) ? $data['id'] : null;
		$this->player1Name = (isset($data['player1Name'])) ? $data['player1Name'] : null;
		$this->player1Email = (isset($data['player1Email'])) ? $data['player1Email'] : null;
		$this->player2Name = (isset($data['player2Name'])) ? $data['player2Name'] : null;
		$this->player2Email = (isset($data['player2Email'])) ? $data['player2Email'] : null;
		$this->player1Choice = (isset($data['player1Choice'])) ? $data['player1Choice'] : null;
		$this->player2Choice = (isset($data['player2Choice'])) ? $data['player2Choice'] : null;
		$this->winner = (isset($data['winner'])) ? $data['winner'] : null;
	}
	
	public function gameToMongoArray(){
		return array("_id" => $id, "player1Name" => $player1Name, "player1Email" => $player1Email, "player2Name" => $player2Name, "player2Email" => $player2Email, "player1Choice" => $player1Choice, "player2Choice" => $player2Choice, "winner" => $winner);
	}
	
	public function setID($id){
		$this->id = $id;
	}
	
	public function setWinner($winner){
		$this->winner = $winner;
	}
}