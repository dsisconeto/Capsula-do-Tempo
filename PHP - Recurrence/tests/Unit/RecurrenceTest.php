<?php

namespace Test\Unit;


use \DateTime;
use PHPUnit\Framework\TestCase;
use DSisconeto\Recurrence\Recurrence;

class RecurrenceTest extends TestCase
{


    public function test_create()
    {
        $recurrence = new Recurrence();
        $holidays = [
            new  DateTime('2018-07-23'),
            new DateTime('2018-07-24'),
            new DateTime('2018-07-25'),
        ];

        $recurrence->setHolidays($holidays)
            ->create(new DateTime('2018-07-01'), new DateTime('2018-07-20'));


        $dates = array_map(function (DateTime $dateTime) {
            return $dateTime->format('Y-m-d');
        }, $recurrence->getDates());

        $expectDates = array_flip([
            '2018-07-02',
            '2018-07-03',
            '2018-07-04',
            '2018-07-05',
            '2018-07-06',
            '2018-07-09',
            '2018-07-10',
            '2018-07-11',
            '2018-07-12',
            '2018-07-13',
            '2018-07-16',
            '2018-07-17',
            '2018-07-18',
            '2018-07-19',
            '2018-07-20',
            '2018-07-26',
            '2018-07-27',
            '2018-07-30',
            '2018-07-31',
            '2018-08-01',
        ]);

        foreach ($dates as $date) {
            $this->assertArrayHasKey($date, $expectDates);
        }

        $this->assertEquals(20, $recurrence->length());
        $this->assertEquals('2018-07-02', $recurrence->getDateStart()->format('Y-m-d'));
        $this->assertEquals('2018-08-01', $recurrence->getDateEnd()->format('Y-m-d'));
    }


}
