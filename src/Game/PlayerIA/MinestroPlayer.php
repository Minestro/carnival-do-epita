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
        $nbTypes = array(
            'nbPaper' => 0,
            'nbRock' => 0,
            'nbScissors' => 0
        );

        $stats = $this->result->getStats();
        $nbTypes['paper'] = $stats[$this->opponentSide]['paper'];
        $nbTypes['rock'] = $stats[$this->opponentSide]['rock'];
        $nbTypes['scissors'] = $stats[$this->opponentSide]['scissors'];

        $minType = array_keys($nbTypes, min($nbTypes));
        return $minType[0];
    }
}