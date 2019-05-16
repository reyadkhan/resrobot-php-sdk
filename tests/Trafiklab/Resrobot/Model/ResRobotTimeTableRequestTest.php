<?php

namespace Trafiklab\ResRobot\Model;


use DateTime;
use PHPUnit_Framework_TestCase;
use Trafiklab\Common\Model\Enum\TimeTableType;
use Trafiklab\ResRobot\Model\Enum\ResRobotTransportType;

class ResRobotTimeTableRequestTest extends PHPUnit_Framework_TestCase
{

    function testSetType()
    {
        $request = new ResRobotTimeTableRequest();
        $request->setTimeTableType(TimeTableType::DEPARTURES);
        self::assertEquals(TimeTableType::DEPARTURES, $request->getTimeTableType());

        $request->setTimeTableType(TimeTableType::ARRIVALS);
        self::assertEquals(TimeTableType::ARRIVALS, $request->getTimeTableType());
    }

    function testSetStopId()
    {
        $request = new ResRobotTimeTableRequest();
        $request->setStopId("ABC012");
        self::assertEquals("ABC012", $request->getStopId());

        $request->setStopId("");
        self::assertEquals("", $request->getStopId());
    }

    function testSetDateTime()
    {
        $request = new ResRobotTimeTableRequest();
        $now = new DateTime();
        $request->setDateTime($now);
        self::assertEquals($now, $request->getDateTime());
    }

    function testSetProductFilter()
    {
        $request = new ResRobotTimeTableRequest();
        $request->addTransportTypeToFilter(ResRobotTransportType::TRAIN_LOCAL);
        self::assertEquals(ResRobotTransportType::TRAIN_LOCAL, $request->getVehicleFilter());

        $request->addTransportTypeToFilter(ResRobotTransportType::BUS_LOCAL);
        self::assertEquals(ResRobotTransportType::TRAIN_LOCAL + ResRobotTransportType::BUS_LOCAL,
            $request->getVehicleFilter());
    }

    function testSetOperatorFilter()
    {
        $request = new ResRobotTimeTableRequest();
        $request->addOperatorToFilter(253);
        self::assertEquals([253], $request->getOperatorFilter());

        $request->addOperatorToFilter(256);
        self::assertEquals([253,256], $request->getOperatorFilter());
    }

}
