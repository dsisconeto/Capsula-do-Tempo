<?php

namespace DSisconeto\Recurrence;

use \DateTime;
use \DateInterval;
use \DatePeriod;


class Recurrence
{
    private $holidays = [];
    private $validDaysOfWeek = [
        DaysOfWeek::MONDAY => true,
        DaysOfWeek::TUESDAY => true,
        DaysOfWeek::WEDNESDAY => true,
        DaysOfWeek::THURSDAY => true,
        DaysOfWeek::FRIDAY => true,
    ];
    /**
     * @var array $dates
     */
    private $dates = [];
    private $format = 'Y-m-d';

    public function create(\DateTime $start, \DateTime $end): void
    {
        $period = $this->factoryPeriod($start, $end);
        $this->pushPeriod($period);
        $this->filter();
    }

    public function createFromDaysLater(\DateTime $start, int $days): void
    {
        $end = clone $start;
        $this->create($start, $end->modify("+{$days} day"));
    }


    private function filter()
    {

        /**
         * @var DateTime $date
         */
        $remove = false;
        foreach ($this->dates as $key => $date) {
            if ($this->isHoliday($date) === false && $this->isValidWeekDay($date) === true) {
                continue;
            }
            $remove = true;
            $this->pushNewDate();
            unset($this->dates[$key]);
        }
        $this->dates = array_values($this->dates);
        if ($remove == false) {
            return;
        }
        $this->filter();
    }


    private function push(DateTime $date)
    {
        array_push($this->dates, $date);
    }


    private function pushPeriod(DatePeriod $period): void
    {
        /**
         * @var DateTime $date
         */
        foreach ($period as $date) {
            $this->push($date);
        }
    }

    private function isValidWeekDay(DateTime $date)
    {
        return array_key_exists($date->format('w'), $this->validDaysOfWeek);
    }

    private function isHoliday(DateTime $date)
    {
        return array_key_exists($date->format($this->format), $this->holidays);
    }

    private function pushNewDate()
    {
        $date = clone $this->getDateEnd();
        $date = $date->modify('+1 day');
        $this->push($date);
    }


    private function factoryPeriod(DateTime $start, DateTime $end): \DatePeriod
    {
        return new DatePeriod($start, DateInterval::createFromDateString('1 day'), $end->modify('+1 day'));
    }


    public function setHolidays(array $holidays)
    {
        /**
         * @var DateTime $holiday
         */
        foreach ($holidays as $holiday) {
            $this->holidays[$holiday->format($this->format)] = true;
        }
        return $this;
    }

    public function getDateEnd(): DateTime
    {
        return end($this->dates);
    }

    public function getDateStart(): DateTime
    {
        return $this->dates[0];
    }

    public function getDates(): array
    {
        return $this->dates;
    }

    public function length(): int
    {
        return count($this->dates);
    }

}
