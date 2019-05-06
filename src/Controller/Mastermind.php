<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class MastermindController extends AbstractController
{

	/**
	* @route("/", name="home")
	*/
	function initGame () {
		$row = 1;
		$expertMode = 0; // 1 pour activer le mode expert (la même couleur peut être utilisée plusieurs fois dans la combinaison)
		$combinaison = createCombinaison(4);

		return $this->render('init.html.twig', ['combinaison' => $combinaison]);

	}

	function createCombinaison ($nbPosition) {
		$availableColors = [$blanc => '#FFFFFF', $jaune => '#FFF933', $orange => '#FF5733', $rouge => '#FF0000', $bleu => '#0000FF', $vert => '#00FF00', $gris => '#808080', $rose => '#FF00FF'];
		$positionsColor = [];
		for ($i = 1; $i <= $nbPosition; $i++) {
    		$positionsColor[$i] = array_rand($availableColors);
		}
		var_dump($positionsColor);die();
		return $positionsColor;

	}

	function checkRow () {

	}


}





  ?>