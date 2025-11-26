<?php

namespace Models\Personnage;

/**
 * Represents a character (Personnage) in the system.
 */
class Personnage
{
    private ?string $id;
    private string $name;
    private int $element;       // ID of ELEMENT
    private int $unitclass;     // ID of UNITCLASS
    private ?int $origin;       // ID of ORIGIN
    private int $rarity;
    private string $urlImg;

    /**
     * Constructor.
     *
     * @param string|null $id Optional character ID.
     * @param string $name Character name.
     * @param int $element ID of the associated element.
     * @param int $unitclass ID of the associated unit class.
     * @param int|null $origin Optional ID of the associated origin.
     * @param int $rarity Character rarity (default 1).
     * @param string $urlImg Optional URL for the character image.
     */
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

    /**
     * Return a string representation of the character.
     */
    public function __toString(): string
    {
        return sprintf(
            "%s (Element ID: %d) - Rarity: %d [UnitClass ID: %d]",
            $this->name,
            $this->element,
            $this->rarity,
            $this->unitclass
        );
    }
}
