<?php

namespace GameOfLife;

class State
{
    private $data = array();

    /**
     * @param array $data
     */
    public function __construct(array $data = array())
    {
        $this->data = $data;
    }

    /**
     * @param int $x
     * @param int $y
     * @return bool
     */
    public function isAlive(Playground $playground, $x, $y)
    {
        $y = ($y+$playground->getHeight()) % $playground->getHeight();
        $x = ($x+$playground->getWidth()) % $playground->getWidth();
        if (!isset($this->data[$y][$x])) {
            return false;
        }
        return (bool)$this->data[$y][$x];
    }

    public function countNeighbours(Playground $playground, $x, $y)
    {
        $positions = array();
        $positions[] = array($x - 1, $y - 1);
        $positions[] = array($x - 1, $y);
        $positions[] = array($x - 1, $y + 1);
        $positions[] = array($x, $y - 1);
        $positions[] = array($x, $y + 1);
        $positions[] = array($x + 1, $y - 1);
        $positions[] = array($x + 1, $y);
        $positions[] = array($x + 1, $y + 1);
        $result = 0;
        foreach ($positions as $position) {
            list($xx, $yy) = $position;
            if ($this->isAlive($playground, $xx, $yy)) {
                $result++;
            }
        }
        return $result;
    }

    public function equals(State $other)
    {
        if ($other->data == $this->data) {
            return true;
        }
        return false;
    }

    public function in(array $states)
    {
        foreach ($states as $state) {
            /* @var $state State */
            if ($this->equals($state)) {
                return true;
            }
        }
        return false;
    }

    public function getHash()
    {
        return md5(serialize($this->data));
    }
}