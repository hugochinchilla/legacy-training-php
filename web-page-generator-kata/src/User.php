<?php

class User
{
    const BIO_KEYWORDS = ['edición', 'sociedad', 'mundo', 'libro', 'texto',
                          'revista', 'valores', 'educación', 'teatro', 'social'];
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $biography;


    public function __construct(string $name, string $biography)
    {
        $this->name = $name;
        $this->biography = $biography;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getBiography(): string
    {
        return $this->biography;
    }

    public function getScore(): string
    {
        $calculator = new TextScoreCalculator(self::BIO_KEYWORDS);

        return $calculator->score($this->biography);
    }

    public function getCity(): ?string
    {
        $extractor = new KeyWordExtractor(["Barcelona", "Madrid", "Granada", "Vigo", "Palma de Mallorca"]);

        return $extractor->extract($this->biography);
    }

    public function getPosition(): ?string
    {
        $extractor = new KeyWordExtractor(["Community Manager"]);

        return $extractor->extract($this->biography);
    }

}
