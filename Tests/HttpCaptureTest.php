<?php
namespace THemming\HttpCaptureBundle\Tests;

use THemming\HttpCaptureBundle\HttpCapture;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Monolog\Logger;
use Monolog\Handler\TestHandler;

class HttpCaptureTest extends \PHPUnit_Framework_TestCase
{
    public function testDisable()
    {
        $handler = new TestHandler();
        $logger = new Logger('unittest');
        $logger->pushHandler($handler);

        $request = new Request(
            array('varOne' => 'one')

        );

        $response = new Response(
            'This is the result content',
            200,
            array(
                'Content-Type' => 'text/plain',
            )
        );

        $kernel = $this->getMock('\Symfony\Component\HttpKernel\HttpKernelInterface');
        $event = new FilterResponseEvent($kernel, $request, HttpKernelInterface::MASTER_REQUEST, $response);

        $capture = new HttpCapture($logger, true);
        $capture->setMaxLength(2000);
        $capture->onKernelResponse($event);

        $records = $handler->getRecords();

        $this->assertEquals('http_capture', $records[0]['context'][0]);
        $this->assertEquals('request', $records[0]['context'][1]);
        $this->assertContains('Request content is empty', $records[0]['message']);
        $this->assertEquals(\Monolog\Logger::INFO, $records[0]['level']);

        $this->assertEquals('http_capture', $records[1]['context'][0]);
        $this->assertEquals('response', $records[1]['context'][1]);
        $this->assertContains('This is the result content', $records[1]['message']);
        $this->assertContains('content-type: text/plain', $records[1]['message'], true);
        $this->assertEquals(\Monolog\Logger::INFO, $records[1]['level']);
    }
}
