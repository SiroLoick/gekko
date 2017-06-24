<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



class AdminController extends Controller
{
	/**
	 * @Route("/admin", name="homepageAdmin")
	 */
	public function indexAction(Request $request)
	{
		return $this->render('AppBundle:Default:index.html.twig');
	}
	
	
	/**
	 * @Route("/admin/question", name="question")
	 */
	public function questionAction(Request $request)
	{
		return $this->render('AppBundle:admin:question.html.twig');
		
	}
	/**
	 * @Route("/admin/resultat", name="resultat")
	 */
	public function resultatAction(Request $request)
	{
		return $this->render('AppBundle:admin:resultat.html.twig');
		
	}
	/**
	 * @Route("/admin/register", name="register")
	 */
	public function registerAction(Request $request)
	{
		return $this->render('AppBundle:admin:register.html.twig');
		
	}
	
}