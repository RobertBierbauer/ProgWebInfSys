<?php
namespace Game\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

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
	}
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}
	
	public function getInputFilter()
	{
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();
			$factory     = new InputFactory();
	
	
			$inputFilter->add($factory->createInput(array(
					'name'     => 'player1Name',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 30,
									),
							),
					),
			)));
	
			$inputFilter->add($factory->createInput(array(
					'name'     => 'player1Email',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 40,
									),
							),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'player2Name',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 30,
									),
							),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'player2Email',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 40,
									),
							),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'player1Choice',
					'required' => true,
               		'filters'  => array(
                    	array('name' => 'Int'),
                	),
					'validators' => array(
							array(
									'name'    => 'Between',
									'options' => array(
											'min'      => 1,
											'max'      => 5,
									),
							),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'player2Choice',
					'required' => true,
					'filters'  => array(
							array('name' => 'Int'),
					),
			)));
	
			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
}