<?php

class TextScoreCalculator {

  private $keywords;

  public function __construct($keywords)
  {
    $this->keywords = $keywords;
  }

  public function score($text)
  {
    $words = explode(" ", $text);
    $intersect = array_intersect($this->keywords, $words);

    return count($intersect);
  }
}
