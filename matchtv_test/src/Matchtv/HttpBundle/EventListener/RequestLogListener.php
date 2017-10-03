<?php
/**
 * Created by JetBrains PhpStorm.
 * User: lmaxim
 * Date: 02/10/17
 * Time: 22:51
 * To change this template use File | Settings | File Templates.
 */

namespace Matchtv\HttpBundle\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Matchtv\HttpBundle\Entity\Log;

class RequestLogListener {

    protected $em;

    /**
     * RequestLogListener constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    public function onKernelTerminate($event) {
        // http://127.0.0.1:8000/app_dev.php/admin/http-log?log_param

        $request = $event->getRequest();

        if (!$request->query->has('log_param')) {
            return;
        }

        $response = $event->getResponse();

        $log = new Log();
        $log->prepare($request, $response);
        $this->em->persist($log);
        $this->em->flush($log);
    }
}