<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class MastermindController extends AbstractController
{

	/**
	* @route("/", name="home")
	*/
	function homepage (Request $request) {
		
		// $game = new Game();

	    $form = $this->createFormBuilder()
	        ->add('expertmode', CheckboxType::class, [
    			'label'    => 'Mode Expert(la même couleur peut être présente plusieurs fois dans la combinaison)',
    			'required' => false,
				])
	        ->add('numberofcolours', ChoiceType::class, [
    			'choices'  => [
       			 	'4' => 4,
        			'5' => 5,
        			'5' => 6,],
    			// *this line is important*
    			'choice_value' => '4',
    			'label'    => 'Nombre de positions à deviner (4, 5 ou 6)',
				])
	        ->add('save', SubmitType::class, ['label' => 'Nouveau jeu'])
	        ->getForm();

	    $form->handleRequest($request);

	    if ($form->isSubmitted() && $form->isValid()) {
	        $param = $form->getData();
	        $this->iniGame($param);

	        return $this->redirectToRoute('task_success');
	        return $this->render('game.html.twig', ['combinaison' => $combinaison]);
	    }

	    return $this->render('init.html.twig', [
	        'form' => $form->createView(),
	    ]);		

	}


	function initGame ($param) {
		$row = 1;
		$expertMode = 0; // 1 pour activer le mode expert (la même couleur peut être utilisée plusieurs fois dans la combinaison)
		$numberOfColoursToFind = 5;

		$combinaison = $this->createCombinaison($numberOfColoursToFind);

		return $this->render('init.html.twig', ['combinaison' => $combinaison]);

	}

	function createCombinaison ($numberOfColoursToFind) {
		$availableColors = ['blanc' => '#FFFFFF', 'jaune' => '#FFF933', 'orange' => '#FF5733', 'rouge' => '#FF0000', 'bleu' => '#0000FF', 'vert' => '#00FF00', 'gris' => '#808080', 'rose' => '#FF00FF'];
		$positionsColor = [];
		for ($i = 1; $i <= $numberOfColoursToFind; $i++) {
    		$positionsColor[$i] = $availableColors[array_rand($availableColors)];
		}
		return $positionsColor;
	}

	function checkRow () {

	}


}

