<?php


namespace Hackathon\PlayerIA;
use Hackathon\Game\Result;

class MinestroPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        return parent::scissorsChoice();
    }
}