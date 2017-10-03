<?php

namespace Matchtv\HttpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/log_action")
     */
    public function httpLogAction()
    {
        return $this->render('MatchtvHttpBundle:Default:index.html.twig');
    }
}
