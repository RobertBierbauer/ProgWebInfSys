<?php
namespace Game\Form;

use Zend\Form\Form;

class CreateGameForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('game');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'player1Name',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Player 1 Name: ',
            ),
        ));
       	$this->add(array(
            'name' => 'player1Email',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Player 1 Email: ',
            ),
        ));
       	$this->add(array(
       			'name' => 'player2Name',
       			'attributes' => array(
       					'type'  => 'text',
       			),
       			'options' => array(
       					'label' => 'Player 2 Name: ',
       			),
       	));
       	$this->add(array(
       			'name' => 'player2Email',
       			'attributes' => array(
       					'type'  => 'text',
       			),
       			'options' => array(
       					'label' => 'Player 2 Email: ',
       			),
       	));
       	$this->add(array(
       			'name' => 'player1Choice',
       			'type'  => 'Zend\Form\Element\Select',

       			'options' => array(
       					'label' => 'Player 1 Choice: ',
       					'options' => array('0' => '', '1' => 'Rock', '2' => 'Scissors', '3' => 'Paper', '4' => 'Lizard', '5' => 'Spock'),
       			),
       	));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Create',
                'id' => 'submitbutton',
            ),
        ));
    }
}