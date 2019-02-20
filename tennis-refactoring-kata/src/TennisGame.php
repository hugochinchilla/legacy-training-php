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
        switch ($this->player1Score) {
            case 0:
                return "Love-All";
            case 1:
                return "Fifteen-All";
            case 2:
                return "Thirty-All";
            default:
                return "Deuce";
        }
    }

    private function advantageScore()
    {
        $minusResult = $this->player1Score - $this->player2Score;
        if ($minusResult == 1) {
            return "Advantage player1";
        } elseif ($minusResult == -1) {
            return "Advantage player2";
        } elseif ($minusResult >= 2) {
            return "Win for player1";
        } else {
            return "Win for player2";
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
        switch ($score) {
            case 0:
                return "Love";
            case 1:
                return "Fifteen";
            case 2:
                return "Thirty";
            case 3:
                return "Forty";
        }
    }

    private function hasAdvantage($score)
    {
        return $score >= self::ADVANTAGE_TRESHOLD;
    }
}
