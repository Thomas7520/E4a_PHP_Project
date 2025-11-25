<?php

namespace Models\Personnage;

class Personnage
{
    private ?string $id;
    private string $name;
    private int $element;       // ID de ELEMENT
    private int $unitclass;     // ID de UNITCLASS
    private ?int $origin;       // ID de ORIGIN
    private int $rarity;
    private string $urlImg;

    public function __construct(
        ?string $id = null,
        string $name = '',
        int $element = 0,
        int $unitclass = 0,
        ?int $origin = null,
        int $rarity = 1,
        string $urlImg = ''
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->element = $element;
        $this->unitclass = $unitclass;
        $this->origin = $origin;
        $this->rarity = $rarity;
        $this->urlImg = $urlImg;
    }

    public function getId(): ?string { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getElement(): int { return $this->element; }
    public function getUnitclass(): int { return $this->unitclass; }
    public function getOrigin(): ?int { return $this->origin; }
    public function getRarity(): int { return $this->rarity; }
    public function getUrlImg(): string { return $this->urlImg; }

    public function setId(?string $id): void { $this->id = $id; }
    public function setName(string $name): void { $this->name = $name; }
    public function setElement(int $element): void { $this->element = $element; }
    public function setUnitclass(int $unitclass): void { $this->unitclass = $unitclass; }
    public function setOrigin(?int $origin): void { $this->origin = $origin; }
    public function setRarity(int $rarity): void { $this->rarity = $rarity; }
    public function setUrlImg(string $urlImg): void { $this->urlImg = $urlImg; }

    public function __toString(): string
    {
        return sprintf(
            "%s (Element ID: %d) - Rarity: %d [%d]",
            $this->name,
            $this->element,
            $this->rarity,
            $this->unitclass
        );
    }
}
