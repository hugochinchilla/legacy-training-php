<?php

class TennisGame
{
    private $player1Score = 0;
    private $player2Score = 0;
    private $player1Name = '';
    private $player2Name = '';

    const ADVANTAGE_TRESHOLD = 4;

    public function __construct($player1Name, $player2Name)
    {
        $this->player1Name = $player1Name;
        $this->player2Name = $player2Name;
    }

    public function wonPoint($playerName)
    {
        if ($this->player1Name == $playerName) {
            $this->player1Score++;
        } else {
            $this->player2Score++;
        }
    }

    public function getScore()
    {
        if ($this->player1Score == $this->player2Score) {
            return $this->drawScore();
        } elseif ($this->hasAdvantage($this->player1Score) || $this->hasAdvantage($this->player2Score)) {
            return $this->advantageScore();
        } else {
            return $this->gameScore();
        }
    }

    private function drawScore()
    {
        if ($this->player1Score <= 2) {
            $player1Score = $this->getTennisScoreName($this->player1Score);
            return $player1Score . '-All';
        }

        return "Deuce";
    }

    private function advantageScore()
    {        
        $minusResult = $this->player1Score - $this->player2Score;
        if ($minusResult == 1) {
            return "Advantage ".$this->player1Name;
        } elseif ($minusResult == -1) {
            return "Advantage ".$this->player2Name;
        } elseif ($minusResult >= 2) {
            return "Win for ".$this->player1Name;
        } else {
            return "Win for ".$this->player2Name;
        }
    }

    private function gameScore()
    {
        $score = $this->getTennisScoreName($this->player1Score);
        $score .= '-';
        $score .= $this->getTennisScoreName($this->player2Score);

        return $score;
    }

    private function getTennisScoreName($score)
    {
        $points = [
            0 => 'Love',
            1 => 'Fifteen',
            2 => 'Thirty',
            3 => 'Forty'
        ];

        return $points[$score];
    }

    private function hasAdvantage($score)
    {
        return $score >= self::ADVANTAGE_TRESHOLD;
    }
}
