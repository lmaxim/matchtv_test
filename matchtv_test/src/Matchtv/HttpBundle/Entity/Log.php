<?php

namespace Matchtv\HttpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Matchtv\HttpBundle\Entity\PkDateTime as PkDateTime;

/**
 * Log
 *
 * @ORM\Table(name="log")
 * @ORM\Entity(repositoryClass="Matchtv\HttpBundle\Repository\LogRepository")
 */
class Log
{
    /**
     * @var int
     *
     * @ORM\Column(name="hash", type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Matchtv\HttpBundle\Generator\NextGenerator")
     */
    private $hash;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=2000)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="reqhead", type="text")
     */
    private $reqhead;

    /**
     * @var string
     *
     * @ORM\Column(name="reqbody", type="text")
     */
    private $reqbody;

    /**
     * @var string
     *
     * @ORM\Column(name="reshead", type="text")
     */
    private $reshead;

    /**
     * @var string
     *
     * @ORM\Column(name="resbody", type="text")
     */
    private $resbody;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", options={"default" : 0})
     */
    private $status = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255)
     */
    private $ip;

    /**
     * @var \DateTime
     * @ORM\Column(name="date", type="pkdatetime")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime")
     */
    private $datetime;


    /**
     * Get id
     *
     * @return int
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Log
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set reqhead
     *
     * @param string $reqhead
     *
     * @return Log
     */
    public function setReqhead($reqhead)
    {
        $this->reqhead = $reqhead;

        return $this;
    }

    /**
     * Get reqhead
     *
     * @return string
     */
    public function getReqhead()
    {
        return $this->reqhead;
    }

    /**
     * Set reqbody
     *
     * @param string $reqbody
     *
     * @return Log
     */
    public function setReqbody($reqbody)
    {
        $this->reqbody = $reqbody;

        return $this;
    }

    /**
     * Get reqbody
     *
     * @return string
     */
    public function getReqbody()
    {
        return $this->reqbody;
    }

    /**
     * Set reshead
     *
     * @param string $reshead
     *
     * @return Log
     */
    public function setReshead($reshead)
    {
        $this->reshead = $reshead;

        return $this;
    }

    /**
     * Get reshead
     *
     * @return string
     */
    public function getReshead()
    {
        return $this->reshead;
    }

    /**
     * Set resbody
     *
     * @param string $resbody
     *
     * @return Log
     */
    public function setResbody($resbody)
    {
        $this->resbody = $resbody;

        return $this;
    }

    /**
     * Get resbody
     *
     * @return string
     */
    public function getResbody()
    {
        return $this->resbody;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Log
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return Log
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set date
     *
     * @param \Date $date
     *
     * @return Log
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     *
     * @return Log
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    protected function encodeQuestionMark($string){
        return str_replace('?', '&#63;', $string);
    }


    public function prepare(Request $request, Response $response) {

        $request_body_content = '';
        try {
            $request_body_content = $request->getContent();
        } catch (\LogicException $e) {
            $request_body_content = $e->getMessage();
        }

        $dt = new PkDateTime();
        $url = sprintf('%s %s %s', $request->getMethod(), $request->getRequestUri(), $request->server->get('SERVER_PROTOCOL'));
//        $this->setUrl(mb_substr($request->getRequestUri(), 0, 2000));

        $this->setUrl($this->encodeQuestionMark($url));
        $this->setReqhead($this->encodeQuestionMark($request->headers));
        $this->setReqbody($this->encodeQuestionMark($request_body_content));
        $this->setReshead($this->encodeQuestionMark($response->headers));
        $this->setResbody($this->encodeQuestionMark($response->getContent()));
        $this->setStatus($response->getStatusCode());
        $this->setIp($request->getClientIp());
        $this->setDate($dt); // new \DateTime()
        $this->setDateTime($dt);
    }

    public function __toString() {
        $value = sprintf('%s %s %s', date_format($this->datetime, 'U'), $this->ip, $this->url);
        return $value;
    }
}

