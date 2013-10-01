<?php

namespace GameOfLife\Algorithm;

use GameOfLife\Playground;
use GameOfLife\State;

class SimpleAlgorithm implements AlgorithmInterface
{

    /**
     * @var Playground
     */
    private $playground;

    /**
     * @param Playground $playground
     */
    public function __construct(Playground $playground)
    {
        $this->playground = $playground;
    }

    /**
     * @param State $state
     * @return State
     */
    public function next(State $state)
    {
        $newData = array();
        for ($y=0;$y<$this->playground->getHeight();$y++) {
            $newRow = array();
            for ($x=0; $x<$this->playground->getWidth();$x++) {
                $isCurrentlyAlive = $state->isAlive($this->playground, $x, $y);
                $numberOfNeighbours = $state->countNeighbours($this->playground, $x, $y);
                $willBeAliveInNextRound = $isCurrentlyAlive;
                if ($isCurrentlyAlive) {
                    if ($numberOfNeighbours<2 || $numberOfNeighbours>3) {
                        $willBeAliveInNextRound = false;
                    }
                } else {
                    if ($numberOfNeighbours==3) {
                        $willBeAliveInNextRound = true;
                    }
                }
                $newRow[] = $willBeAliveInNextRound;
            }
            $newData[] = $newRow;
        }
        $newState = new State($newData);
        return $newState;
    }
}