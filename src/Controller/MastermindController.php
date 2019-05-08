<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MastermindController extends AbstractController
{

	/**
	* @route("/", name="home")
	*/
	function homepage (Request $request) {
		
		$game = new Game();

	    $form = $this->createFormBuilder($game)
	        ->add('expertmode', TextType::class)
	        ->add('numberofcolours', DateType::class)
	        ->add('save', SubmitType::class, ['label' => 'Nouveau jeu'])
	        ->getForm();

	    $form->handleRequest($request);

	    if ($form->isSubmitted() && $form->isValid()) {
	        // $form->getData() holds the submitted values
	        // but, the original `$task` variable has also been updated
	        $task = $form->getData();

	        // ... perform some action, such as saving the task to the database
	        // for example, if Task is a Doctrine entity, save it!
	        // $entityManager = $this->getDoctrine()->getManager();
	        // $entityManager->persist($task);
	        // $entityManager->flush();

	        return $this->redirectToRoute('task_success');
	    }

	    return $this->render('task/new.html.twig', [
	        'form' => $form->createView(),
	    ]);

		return $this->render('game.html.twig', ['combinaison' => $combinaison]);

	}


	function initGame () {
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

