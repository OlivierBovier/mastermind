<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Combinaison;


class MastermindController extends AbstractController
{
	/**
	* @route("/", name="home")
	*/
	function homepage (Request $request) {
		
		// $game = new Game();

	    $form = $this->createFormBuilder()
	        ->add('expertmode', CheckboxType::class, [
    			'label'    => 'Mode Expert (la même couleur peut être présente plusieurs fois dans la combinaison)',
    			'required' => false,
				])
	        ->add('numberofcolours', ChoiceType::class, [
    			'choices'  => [
       			 	'3' => 3,
        			'4' => 4,
        			'5' => 5,],
    			'label'    => 'Nombre de positions à deviner (3, 4 ou 5)',
				])
	        ->add('save', SubmitType::class, ['label' => 'Nouvelle partie'])
	        ->getForm();

	    $form->handleRequest($request);

	    if ($form->isSubmitted() && $form->isValid()) {
	        $param = $form->getData();
	        $combinaison = $this->initGame($param);

	        return $this->render('game.html.twig', ['combinaison' => $combinaison]);
	    }

	    return $this->render('init.html.twig', ['form' => $form->createView()]);		

	}


	function initGame ($param) {
		$expertMode = $param['expertmode']; 
		$numberOfColoursToFind = $param['numberofcolours'];

		$combinaison = $this->createCombinaison($expertMode, $numberOfColoursToFind);

		return $combinaison;
	}


	function createCombinaison ($expertMode, $numberOfColoursToFind) {
		$availableColors = ['blanc' => '#FFFFFF', 'jaune' => '#FFF933', 'orange' => '#FF5733', 'rouge' => '#FF0000', 'bleu' => '#0000FF', 'vert' => '#00FF00', 'gris' => '#808080', 'rose' => '#FF00FF'];
		$combinaison = [];
		for ($i = 1; $i <= $numberOfColoursToFind; $i++) {
			$couleurAléatoire = array_rand($availableColors);
    		$combinaison[$i] = $availableColors[$couleurAléatoire];
    		if ($expertMode == false) {
    			unset($availableColors[$couleurAléatoire]);
    		}    		
		}

		return $combinaison;
	}


	function checkRow () {

	}


	/**
	* @route("/scores", name="scores")
	*/
	function scores (Request $request) {

		 return $this->render('scores.html.twig');		
	}


}

