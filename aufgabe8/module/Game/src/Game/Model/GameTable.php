<?php
namespace Game\Model;

use Zend\Db\TableGateway\TableGateway;

class GameTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    private function getDB(){
    	$mongo = new Mongo();
    	return $mongo->selectDB(“test”);
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    

    public function getGame($id)
    {
		$db = getDB();
		$query = array();
    }
    
    public function gameCompleted(Game $game){
    	if($game->player2Choice == 0){
    		return false;
    	}
    	else{
    		return true;
    	}
    }
    
    public function completeGame(Game $game){
    	$id = $game->id;
    	$player2Choice = $game->player2Choice;
    	$winner = $game->winner;
    	
    	$data = array(
    			'player2Choice' => $player2Choice,
    			'winner'		=> $winner,
    	);
    	
    	$this->tableGateway->update($data, array('id' => $id));
    }

    public function saveGame(Game $game)
    {
        $id = hash('sha1', $game->player1Name.$game->player2Name.time());
        $data = array(
        	'id' => $id,
            'player1Name' => $game->player1Name,
            'player1Email' => $game->player1Email,
        	'player2Name' => $game->player2Name,
        	'player2Email' => $game->player2Email,
        	'player1Choice' => $game->player1Choice,
        );

       	$this->tableGateway->insert($data);
       	return $id;
        
    }
    
    private function groupAndCount($player1Winner, $player2Winner){
    	$winners = array();
    	foreach($player1Winner as $winner){
    		if(array_key_exists($winner->player1Name, $winners)){
    			$winners[$winner->player1Name]++;
    		}
    		else{
    			$winners[$winner->player1Name] = 1;
    		}
    	}
    	foreach($player2Winner as $winner){
    		if(array_key_exists($winner->player2Name, $winners)){
    			$winners[$winner->player2Name]++;
    		}
    		else{
    			$winners[$winner->player2Name] = 1;
    		}
    	}
    	arsort($winners);
    	return $winners;
    }
    
    public function getHighscore(){
    	//$result = $this->tableGateway->select(array('winner'=>1));
    	/*
    	$result->from($this->tableGateway, array('count(player1Name) as wins'));
    	$result->where('winner=1');
    	$result->order('player1Name');
    	$result->group('wins desc','player1Name');
    	*/
    	$result1 = $this->tableGateway->getSql()->select();
    	$result1->where('winner = 1');
    	$result1 = $this->tableGateway->selectWith($result1);
    	$result2 = $this->tableGateway->getSql()->select();
    	$result2->where('winner = 2');
    	$result2 = $this->tableGateway->selectWith($result2);
    	$highscore = $this->groupAndCount($result1, $result2);
    	
    	return $highscore;
    }
}