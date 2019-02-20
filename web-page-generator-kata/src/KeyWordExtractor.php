<?php

class KeyWordExtractor {

  private $keywords;

  public function __construct($keywords)
  {
    $this->keywords = $keywords;
  }

  public function extract($text)
  {
    foreach ($this->keywords as $city) {
      if (strpos(strtolower($text), strtolower($city))) {
        return $city;
      }
    }

    return false;
  }
}
