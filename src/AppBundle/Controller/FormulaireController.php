<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Formulaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Formulaire controller.
 *
 * @Route("admin/formulaire")
 */
class FormulaireController extends Controller
{
    /**
     * Lists all formulaire entities.
     *
     * @Route("/", name="app_formulaire_index")
     * @Method({"GET", "POST"})
     */
	public function indexAction(Request $request)
    {
        $formulaire = new Formulaire();
        $form = $this->createForm('AppBundle\Form\FormulaireType', $formulaire);
        $form->handleRequest($request);
        
        $em = $this->getDoctrine()->getManager();
        
        $formulaires = $em->getRepository('AppBundle:Formulaire')->findAll();
        
        
        if ($form->isSubmitted() && $form->isValid()) {
        	$em = $this->getDoctrine()->getManager();
        	$formulaire->setActifFormulaire(1);
        	$em->persist($formulaire);
        	$em->flush();
        	
        	return $this->redirectToRoute('app_formulaire_index');
        }
        
        
        return $this->render('AppBundle:admin:formulaire.html.twig', array(
            'formulaires' => $formulaires,
        	'form' => $form->createView(),
        		
        ));
    }

    /**
     * Creates a new formulaire entity.
     *
     * @Route("/new", name="app_formulaire_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $formulaire = new Formulaire();
        $form = $this->createForm('AppBundle\Form\FormulaireType', $formulaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formulaire);
            $em->flush();

            return $this->redirectToRoute('app_formulaire_show', array('idFormulaire' => $formulaire->getIdformulaire()));
        }

        return $this->render('formulaire/new.html.twig', array(
            'formulaire' => $formulaire,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a formulaire entity.
     *
     * @Route("/{idFormulaire}", name="app_formulaire_show")
     * @Method("GET")
     */
    public function showAction(Formulaire $formulaire)
    {
        $deleteForm = $this->createDeleteForm($formulaire);

        return $this->render('formulaire/show.html.twig', array(
            'formulaire' => $formulaire,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing formulaire entity.
     *
     * @Route("/{idFormulaire}/edit", name="app_formulaire_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Formulaire $formulaire)
    {
        $deleteForm = $this->createDeleteForm($formulaire);
        $editForm = $this->createForm('AppBundle\Form\FormulaireType', $formulaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_formulaire_edit', array('idFormulaire' => $formulaire->getIdformulaire()));
        }

        return $this->render('formulaire/edit.html.twig', array(
            'formulaire' => $formulaire,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a formulaire entity.
     *
     * @Route("/{idFormulaire}", name="app_formulaire_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Formulaire $formulaire)
    {
        $form = $this->createDeleteForm($formulaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($formulaire);
            $em->flush();
        }

        return $this->redirectToRoute('app_formulaire_index');
    }

    /**
     * Creates a form to delete a formulaire entity.
     *
     * @param Formulaire $formulaire The formulaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Formulaire $formulaire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('app_formulaire_delete', array('idFormulaire' => $formulaire->getIdformulaire())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
