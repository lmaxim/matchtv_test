<?php
/**
 * Created by JetBrains PhpStorm.
 * User: lmaxim
 * Date: 03/10/17
 * Time: 15:56
 * To change this template use File | Settings | File Templates.
 */

namespace Matchtv\HttpBundle\Generator;


use Doctrine\ORM\Id\AbstractIdGenerator;

class NextGenerator extends AbstractIdGenerator {
    public function generate(\Doctrine\ORM\EntityManager $em, $entity)
    {
        return md5((string)$entity);
    }
}