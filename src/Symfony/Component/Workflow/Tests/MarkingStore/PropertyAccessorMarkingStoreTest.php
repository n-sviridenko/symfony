<?php

namespace Symfony\Component\Workflow\Tests\MarkingStore;

use Symfony\Component\Workflow\Marking;
use Symfony\Component\Workflow\MarkingStore\PropertyAccessorMarkingStore;

class PropertyAccessorMarkingStoreTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSetMarking()
    {
        $subject = new \stdClass();
        $subject->myMarks = null;

        $markingStore = new PropertyAccessorMarkingStore('myMarks');

        $marking = $markingStore->getMarking($subject);

        $this->assertInstanceOf(Marking::class, $marking);
        $this->assertCount(0, $marking->getPlaces());

        $marking->mark('first_place');

        $markingStore->setMarking($subject, $marking);

        $this->assertSame(array('first_place' => 1), $subject->myMarks);

        $marking2 = $markingStore->getMarking($subject);

        $this->assertEquals($marking, $marking2);
    }
}
