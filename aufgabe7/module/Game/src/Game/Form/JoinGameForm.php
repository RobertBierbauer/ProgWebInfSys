<?php
namespace Game\Form;

use Zend\Form\Form;

class JoinGameForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('game');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'ID of the game: ',
            ),
        ));

        $this->add(array(
        		'name' => 'player2Choice',
        		'type'  => 'Zend\Form\Element\Select',
        
        		'options' => array(
        				'label' => 'Player 2 Choice: ',
        				'options' => array('0' => '', '1' => 'Rock', '2' => 'Scissors', '3' => 'Paper', '4' => 'Lizard', '5' => 'Spock'),
        		),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Join',
                'id' => 'submitbutton',
            ),
        ));
    }
}