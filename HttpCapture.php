<?php
namespace Pequin\HttpCaptureBundle;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Monolog\Logger;

class HttpCapture
{
    /** @var Logger */
    protected $logger;
    protected $enabled;
    protected $maxLength = null;

    public function __construct(Logger $logger, $enabled = false)
    {
        $this->logger = $logger;
        $this->enabled = $enabled;
    }

    public function setMaxLength($length)
    {
        $this->maxLength = $length;
    }

    /**
     * @param \Symfony\Component\HttpKernel\Event\FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (!$this->enabled) {
            return;
        }

        $request = $event->getRequest();
        $response = $event->getResponse();

        $requestHeadersStr = '';
        foreach ($request->headers->all() as $k => $v) {
            $requestHeadersStr .= $k . ': ' . $v[0] . PHP_EOL;
        }

        $responseHeadersStr = '';
        foreach ($response->headers->all() as $k => $v) {
            $responseHeadersStr .= $k . ': ' . $v[0] . PHP_EOL;
        }

        $requestContent = $request->getContent();
        if ($this->maxLength && strlen($requestContent) > $this->maxLength) {
            $requestContent = substr($requestContent, 0, $this->maxLength) . '...';
        }

        $responseContent = $response->getContent();
        if ($this->maxLength && strlen($responseContent) > $this->maxLength) {
            $responseContent = substr($responseContent, 0, $this->maxLength) . '...';
        }

        $this->logger->info(
            <<<INFO

Path: {$request->getPathInfo()}
Method: {$request->getMethod()}
Remote Host: {$request->server->get('REMOTE_ADDR')}
= Request =
{$requestHeadersStr}
{$requestContent}
= Response =
{$responseHeadersStr}
{$responseContent}
INFO
        );
    }
}
