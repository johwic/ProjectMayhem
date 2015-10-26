<?php

namespace AppBundle\Utils;

class StatBuilder {

    public $filters;
    private $groupedEvents;
    private $groupedEventsByPlayer;
    private $groupedEventsByTeam;

    function __construct()
    {
        $this->filters = json_decode(file_get_contents(__DIR__ . '\\..\\Resources\\filters\\Filters.json'));
    }

    public function add($e)
    {
        foreach ($this->filters as $filterIndex => $filter) {
            $satisfied = true;

            foreach ($filter->satisfier as $satisfier) {
                $key = $satisfier->func;
                $satisfied = $satisfied && EventFilter::$key($e, $satisfier->value);
            }

            if ($satisfied) {
                $this->groupedEvents[$filterIndex][] = $e;
                if (isset($e->playerId)) {
                    $this->groupedEventsByPlayer[$e->playerId][$filterIndex][] = $e;
                }

                if (isset($e->teamId)) {
                    $this->groupedEventsByTeam[$e->teamId][$filterIndex][] = $e;
                }
            }
        }
    }

    public function getMinutesPlayed($playerId, $started)
    {
        $index = 0;
        foreach ($this->filters as $filterIndex => $filter) {
            if ($filter->filterName == "SubstitutionMinute") {
                $index = $filterIndex;
                continue;
            }
        }

        if (isset($this->groupedEventsByPlayer[$playerId][$index])) {
            if ($started == 1) {
                return $this->groupedEventsByPlayer[$playerId][$index][0]->minute + 1;
            }

            return 90 - $this->groupedEventsByPlayer[$playerId][$index][0]->minute - 1;
        }

        if ($started == 1) return 90;

        return 0;
    }

    public function getEventsGroupedByPlayer()
    {
        //dump($this->groupedEvents);die();
        //$eventsGroupedByPlayer = array();
        foreach ($this->groupedEvents as $filterIndex => $events) {
            foreach ($events as $event) {
                if (isset($event->playerId)) {
                    $this->groupedEventsByPlayer[$event->playerId][$filterIndex][] = $event;
                }
            }
        }

        return $this->groupedEventsByPlayer;
    }

    public function getFilterValue($filterIndex, $playerId)
    {
        if (isset($this->groupedEventsByPlayer[$playerId][$filterIndex])) {
            if (isset($this->filters[$filterIndex]->value)) return $this->filters[$filterIndex]->value;
            if (isset($this->filters[$filterIndex]->return)) return $this->groupedEventsByPlayer[$playerId][$filterIndex][0]->{$this->filters[$filterIndex]->return} + 1;

            return count($this->groupedEventsByPlayer[$playerId][$filterIndex]);
        }
        return 0;
    }
}