<?php
/**
 * Created by JetBrains PhpStorm.
 * User: lmaxim
 * Date: 03/10/17
 * Time: 13:12
 * To change this template use File | Settings | File Templates.
 */

namespace Matchtv\HttpBundle\Entity;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;

class PkDateTime extends \DateTime {

    const PK_DATE_TIME = 'pkdatetime';


    public function getName()
    {
        return self::PK_DATE_TIME;
    }

    public function __toString()
    {
        return $this->format('Y-m-d');
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }

    public function canRequireSQLConversion()
    {
        return false;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value instanceof PkDateTime) {
            return $value;
        }

        $val = $value;

        return $val;
    }
}