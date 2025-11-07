<?php

namespace Models;

class Personnage
{


    private ?string $id = null;
    private string $name;
    private string $element;
    private string $unitclass;
    private int $rarity;
    private ?string $origin = null;
    private string $urlImg;

    /**
     * @param string|null $id
     * @param string $name
     * @param string $element
     * @param string $unitclass
     * @param int $rarity
     * @param string|null $origin
     * @param string $urlImg
     */
    public function __construct(
        ?string $id = null,
        string $name = '',
        string $element = '',
        string $unitclass = '',
        int $rarity = 1,
        ?string $origin = null,
        string $urlImg = ''
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->element = $element;
        $this->unitclass = $unitclass;
        $this->rarity = $rarity;
        $this->origin = $origin;
        $this->urlImg = $urlImg;
    }




    public function getId(): ?string { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getElement(): string { return $this->element; }
    public function getUnitclass(): string { return $this->unitclass; }
    public function getRarity(): int { return $this->rarity; }
    public function getOrigin(): ?string { return $this->origin; }
    public function getUrlImg(): string { return $this->urlImg; }

    public function setId(?string $id): void { $this->id = $id; }
    public function setName(string $name): void { $this->name = $name; }
    public function setElement(string $element): void { $this->element = $element; }
    public function setUnitclass(string $unitclass): void { $this->unitclass = $unitclass; }
    public function setRarity(int $rarity): void { $this->rarity = $rarity; }
    public function setOrigin(?string $origin): void { $this->origin = $origin; }
    public function setUrlImg(string $urlImg): void { $this->urlImg = $urlImg; }

    public function __toString(): string
    {
        return sprintf(
            "%s (%s) - %s [%s]",
            $this->name,
            $this->element,
            $this->rarity,
            $this->unitclass
        );
    }
}
