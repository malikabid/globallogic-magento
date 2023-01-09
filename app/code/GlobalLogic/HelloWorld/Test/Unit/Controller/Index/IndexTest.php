<?php

namespace GlobalLogic\HelloWorld\Test\Unit\Controller\Index;

use PHPUnit\Framework\TestCase;
use Magento\Framework\Controller\ResultInterface;
use GlobalLogic\HelloWorld\Controller\Index\Index;
use Magento\Framework\HTTP\PhpEnvironment\Request as HttpRequest;
use Magento\Framework\View\Result\Page as PageResult;
use Magento\Framework\App\Action\Context as ActionContext;
use Magento\Framework\View\Result\PageFactory as PageResultFactory;
use Magento\Framework\Controller\Result\Redirect as RedirectResult;
use Magento\Framework\Controller\Result\RedirectFactory as RedirectResultFactory;


use stdClass;

class IndexTest extends TestCase
{
    /** @var Index */
    private $controller;

    /** @var HttpRequest |  MockObject */
    private $mockRequest;

    /** @var PageResult | MockObject */
    private $mockPageResult;

    /** @var stdClass | MockObject */
    private $mockUseCase;

    /** @var RedirectResult | MockObject */
    private $mockRedirectResult;

    protected function setUp(): void
    {
        $this->mockRequest = $this->getMockBuilder(HttpRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockPageResult = $this->getMockBuilder(PageResult::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockUseCase = $this->getMockBuilder(\stdClass::class)
            ->setMockClassName('UseCase')
            ->addMethods(['doSomething'])
            ->getMock();

        $this->mockRedirectResult = $this->getMockBuilder(RedirectResult::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var RedirectResultFactory | MockObject */
        $mockRedirectResultFactory = $this->getMockBuilder(RedirectResultFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mockRedirectResultFactory->method('create')->willReturn($this->mockRedirectResult);

        /** @var ActionContext | MockObject */
        $mockContext = $this->getMockBuilder(ActionContext::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mockPageResultFactory = $this->getMockBuilder(PageResultFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mockPageResultFactory->method('create')->willReturn($this->mockPageResult);

        $mockContext->method('getRequest')->willReturn($this->mockRequest);
        $mockContext->method('getResultRedirectFactory')->willReturn($mockRedirectResultFactory);

        $this->controller = new Index($mockContext, $mockPageResultFactory, $this->mockUseCase);
    }

    public function testReturnsResultInstance()
    {
        $this->mockRequest->method('getMethod')->willReturn('POST');
        $this->assertInstanceOf(ResultInterface::class,  $this->controller->execute());
    }


    public function testReturn405ErrorOnNonPostRequest()
    {
        $this->mockRequest->method('getMethod')->willReturn('GET');
        $this->mockPageResult->expects($this->once())->method('setHttpResponseCode')->with(405);
        $this->controller->execute();
    }


    public function testReturn404OnMissingArguments()
    {
        $incompleteArgs = [];
        $this->mockRequest->method('getMethod')->willReturn('POST');
        $this->mockRequest->method('getParams')->willReturn($incompleteArgs);

        $this->mockUseCase->expects($this->once())
            ->method('doSomething')
            ->with($incompleteArgs)
            ->willThrowException(new \Exception("Test Exception: Required Arguments Missing"));

        $this->mockPageResult->expects($this->once())->method('setHttpResponseCode')->with(400);
        $this->controller->execute();
    }

    public function testRedirectsToHomePageIfAllRequestValid()
    {
        $this->mockRequest->method('getMethod')->willReturn('POST');
        $this->mockRequest->method('getParams')->willReturn(['id' => 123]);

        $this->mockRedirectResult->expects($this->once())->method('setPath');

        $this->assertSame($this->mockRedirectResult, $this->controller->execute());
    }
}
