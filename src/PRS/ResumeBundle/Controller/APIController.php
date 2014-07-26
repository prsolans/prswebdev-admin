<?php

namespace PRS\ResumeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use PRS\ResumeBundle\Entity\Project;

/**
 * API controller.
 *
 * @Route("/api")
 */
class APIController extends Controller
{

    /**
     * Lists all Project entities - JSON format.
     *
     * @Route("/project.json", name="api_project", defaults={"_format"="json"}))
     * @Method("GET")
     * @Template()
     */
    public function apiAction()
    {
	$projects = $this->getDoctrine()->getRepository('PRSResumeBundle:Project')->findAll();

	if(!$projects){
		$projects = false;
	}

	$jsonContent = array();

	foreach($projects AS $item){
		array_push($jsonContent, array('id' => $item->getId(), 'name' => $item->getName(), 'description' => $item->getDescription(), 'image' => $item->getImage()));
	}
	$data = json_encode($jsonContent);
	return $this->render('PRSResumeBundle:Project:api.html.twig', array('jsonContent' => $data));
    }

}
