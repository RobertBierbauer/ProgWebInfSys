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

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getGame($id)
    {
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        return $row;
    }
    
    public function completeGame(Game $game){
    	$id = $game->id;
    	$player2Choice = $game->player2Choice;
    	
    	$data = array(
    			'player2Choice' => $player2Choice,
    	);
    	
    	if ($this->getGame($id)) {
    		$this->tableGateway->update($data, array('id' => $id));
    	} else {
    		throw new \Exception('Form id does not exist');
    	}
    }

    public function saveGame(Game $game)
    {
		$date = new \DateTime(null);
		$date = $date->format('Y-m-d H:i:s');
        $id = hash('sha1', $game->player1Name.$game->player2Name.$date);
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
}