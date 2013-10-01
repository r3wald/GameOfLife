<?php

namespace GameOfLife\Algorithm;

use GameOfLife\Playground;
use GameOfLife\State;

interface AlgorithmInterface {

    /**
     * @param Playground $playground
     */
    public function __construct(Playground $playground);

    /**
     * @param State $state
     * @return State
     */
    public function next(State $state);
}