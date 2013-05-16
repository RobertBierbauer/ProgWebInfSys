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
       			'attributes' => array(
       					'id' => 'player1Choice',
       					'type'  => 'hidden',
       					'value' => '0',
       			),
       			'options' => array(
       					'label' => 'Choose a weapon: ',
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