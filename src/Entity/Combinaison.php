<?php

namespace App\Entity;

class Combinaison
{
	private $position1;
	private $position2;
	private $position3;
	private $position4;
	private $position5;

	private $valeursPossibles = ['#FFFFFF', '#FFF933', '#FF5733', '#FF0000', '#0000FF', '#00FF00', '#808080', '#FF00FF'];

	public function setPosition1 ($position1) {
		if (in_array($position1, $valeursPossibles)) {
    		$this->position1 = $position1;
		} else {
			trigger_error('La force d\'un personnage doit être un nombre entier', E_USER_WARNING);
      		return;
		}		
	}

	public function getPosition1 () {
		return $this->position1;
	}

	public function setPosition2 ($position2) {
		if (in_array($position2, $valeursPossibles)) {
    		$this->position2 = $position2;
		} else {
			trigger_error('La force d\'un personnage doit être un nombre entier', E_USER_WARNING);
      		return;
		}		
	}

	public function getPosition2 () {
		return $this->position2;
	}

	public function setPosition3 ($position3) {
		if (in_array($position3, $valeursPossibles)) {
    		$this->position3 = $position3;
		} else {
			trigger_error('La force d\'un personnage doit être un nombre entier', E_USER_WARNING);
      		return;
		}		
	}

	public function getPosition3 () {
		return $this->position3;
	}

	public function setPosition4 ($position4) {
		if (in_array($position4, $valeursPossibles)) {
    		$this->position4 = $position4;
		} else {
			trigger_error('La force d\'un personnage doit être un nombre entier', E_USER_WARNING);
      		return;
		}		
	}

	public function getPosition4 () {
		return $this->position4;
	}

	public function setPosition5 ($position5) {
		if (in_array($position5, $valeursPossibles)) {
    		$this->position5 = $position5;
		} else {
			trigger_error('La force d\'un personnage doit être un nombre entier', E_USER_WARNING);
      		return;
		}		
	}

	public function getPosition5 () {
		return $this->position5;
	}

}

?>