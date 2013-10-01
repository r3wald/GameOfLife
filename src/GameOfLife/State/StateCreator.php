<?php

namespace GameOfLife\State;

use GameOfLife\State;
use GameOfLife\Playground;

class StateCreator
{

    /**
     * @param Playground $playground
     * @return State
     */
    public function create(Playground $playground)
    {
        $data = array();
        for ($y = 0; $y < $playground->getHeight(); $y++) {
            $row = array();
                for ($x = 0; $x < $playground->getWidth(); $x++) {
                $isAlive = 0 == rand(0, 1);
                $row[] = $isAlive;
            }
            $data[] = $row;
        }
        $result = new State($data);
        return $result;
    }

}