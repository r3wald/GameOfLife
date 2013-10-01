<?php

namespace GameOfLife\State;

use GameOfLife\State;

class StateLoader {
    /**
     * @return State
     */
    public function load() {
        $data = array();
        $data[] = array(0,0,0,0,0,0,0,0,0,0);
        $data[] = array(0,0,0,0,0,0,0,0,0,0);
        $data[] = array(0,0,0,0,0,0,0,0,0,0);
        $data[] = array(0,0,0,0,0,0,0,0,0,0);
        $data[] = array(0,0,0,1,1,1,0,0,0,0);
        $data[] = array(0,0,0,0,0,0,0,0,0,0);
        $data[] = array(0,0,0,0,0,0,0,0,0,0);
        $data[] = array(0,0,0,0,0,0,0,0,0,0);
        $data[] = array(0,0,0,0,0,0,0,0,0,0);
        $data[] = array(0,0,0,0,0,0,0,0,0,0);
        $result = new State($data);
        return $result;
    }
}