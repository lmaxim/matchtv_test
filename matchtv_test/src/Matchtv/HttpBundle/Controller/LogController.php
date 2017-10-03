<?php

namespace Matchtv\HttpBundle\Controller;

use Matchtv\HttpBundle\Entity\Log;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Log controller.
 *
 * @Route("admin/old-http-log")
 */
class LogController extends Controller
{
    /**
     * Lists all log entities.
     *
     * @Route("/", name="admin_http-log_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $logs = $em->getRepository('MatchtvHttpBundle:Log')->findAll();

        return $this->render('log/index.html.twig', array(
            'logs' => $logs,
        ));
    }

    /**
     * Finds and displays a log entity.
     *
     * @Route("/{hash}", name="admin_http-log_show")
     * @Method("GET")
     */
    public function showAction(Log $log)
    {

        return $this->render('log/show.html.twig', array(
            'log' => $log,
        ));
    }
}
