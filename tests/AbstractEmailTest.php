<?php

use Emailables\Attachable;
use Emailables\BaseAttachment;
use Emailables\BaseEmail;

/**
 * Class AbstractEmailTest
 *
 * @group email
 */
class AbstractEmailTest extends PHPUnit_Framework_TestCase
{
    /** @var  BaseEmail|PHPUnit_Framework_MockObject_MockObject */
    protected $abstractEmailStub;

    public function setUp()
    {
        $stub = $this->getMockForAbstractClass(BaseEmail::class);
        $stub->expects($this->any())
            ->method('__toString')
            ->will($this->returnValue(true));

        $stub->expects($this->any())
            ->method('addAttachment');

        $this->abstractEmailStub = $stub;
    }

    public function testFreshEmailToString()
    {
        $cleanEmailObjectArray = [
            'to'          => null,
            'from'        => null,
            'replyTo'     => null,
            'subject'     => null,
            'html'        => null,
            'attachments' => []
        ];

        $this->assertEquals(json_encode($cleanEmailObjectArray), (string) $this->abstractEmailStub);
    }

    public function testAddAttachment()
    {
        $this->assertAttachmentCount(0);

        $this->addAttachmentToAbstractStub();
        $this->assertAttachmentCount(1);

        $this->addAttachmentToAbstractStub();
        $this->addAttachmentToAbstractStub();
        $this->assertAttachmentCount(3);
    }

    public function testFilledEmailToString()
    {
        $fullEmail = $this->getFullEmailArray();

        $this->fillAbstractEmail();

        // convert the stringified object back to an array
        $filledEmailArray = json_decode((string) $this->abstractEmailStub, true);

        foreach ($fullEmail as $key => $value) {
            $this->assertEquals($value, $filledEmailArray[$key]);
        }
    }

    protected function addAttachmentToAbstractStub()
    {
        $testAttachment = $this->getTestAttachment();
        $this->abstractEmailStub->addAttachment($testAttachment);
    }

    /**
     * @return Attachable
     */
    protected function getTestAttachment()
    {
        $testAttachment = new BaseAttachment();
        $testAttachment->setContentType('text')
            ->setFileLocation('someFakeLocation')
            ->setFileName('someFakeFileName');
        return $testAttachment;
    }

    protected function fillAbstractEmail()
    {
        $this->abstractEmailStub->expects($this->any())
            ->method('getRecipients')
            ->will($this->returnValue(['some@email.com' => 'testSome', 'another@email.com' => 'testAnother']));

        $this->abstractEmailStub->expects($this->any())
            ->method('getReplyTo')
            ->will($this->returnValue(['test@email.com' => 'testReplyTo']));

        $this->abstractEmailStub->expects($this->any())
            ->method('getSender')
            ->will($this->returnValue(['sender@email.com' => 'testSender']));

        $this->abstractEmailStub->expects($this->any())
            ->method('getSubject')
            ->will($this->returnValue('Here is a subject'));

        $this->abstractEmailStub->expects($this->any())
            ->method('getBody')
            ->will($this->returnValue('Here is a body'));

        $this->addAttachmentToAbstractStub();
    }

    /**
     * @return array
     */
    protected function getFullEmailArray()
    {
        $fullEmail = [
            'to'          => ['some@email.com' => 'testSome', 'another@email.com' => 'testAnother'],
            'from'        => ['sender@email.com' => 'testSender'],
            'replyTo'     => ['test@email.com' => 'testReplyTo'],
            'subject'     => 'Here is a subject',
            'html'        => 'Here is a body',
            'attachments' => [(string)$this->getTestAttachment()]
        ];
        return $fullEmail;
    }

    private function assertAttachmentCount($count)
    {
        $this->assertCount($count, $this->abstractEmailStub->getAttachments());
    }
}
