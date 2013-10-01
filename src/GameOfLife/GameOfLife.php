<?php

namespace GameOfLife;

use GameOfLife\Algorithm\AlgorithmInterface;
use GameOfLife\Renderer\NcursesRenderer;
use GameOfLife\State\StateLoader;
use GameOfLife\State\StateCreator;
use GameOfLife\State;
use GameOfLife\Algorithm\SimpleAlgorithm;

class GameOfLife
{
    /**
     * @var Playground
     */
    private $playground;

    /**
     * @var State
     */
    private $currentState;

    /**
     * @var integer
     */
    private $count;

    /**
     * @var AlgorithmInterface
     */
    private $algorithm;

    /**
     * @var array[]State
     */
    private $lastStates;

    public function __construct()
    {
        $playground = new Playground(60, 30);

        $initialState = (new StateCreator())->create($playground);
        #$initialState = (new StateLoader)->load($playground);

        $this->count = 0;
        $this->algorithm = new SimpleAlgorithm($playground);
        $this->currentState = $initialState;
        $this->renderer = new NcursesRenderer($playground);
        $this->lastStates = array();
    }

    public function iterate()
    {
        $this->count++;

        array_unshift($this->lastStates, $this->currentState);
        if (count($this->lastStates)>10) {
            array_pop($this->lastStates);
        }

//        error_log(print_r(array_map(function($s){return $s->getHash();},$this->lastStates),true));

        $nextState = $this->algorithm->next($this->currentState);

//        error_log($nextState->getHash());

        $static = $nextState->equals($this->currentState);
        $oscillating = $nextState->in($this->lastStates);

        $this->currentState = $nextState;

        $this->renderer->render($this->count, $this->currentState, $static, $oscillating);
    }
}