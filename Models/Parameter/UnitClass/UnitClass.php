<?php

namespace Models\Parameter\UnitClass;

/**
 * Represents a UnitClass parameter in the system.
 */
class UnitClass
{
    private ?string $id;
    private string $name;
    private string $urlImg;

    /**
     * Constructor.
     *
     * @param string|null $id Optional unit class ID.
     * @param string $name Unit class name.
     * @param string $imgUrl Optional URL of the unit class image.
     */
    public function __construct(?string $id = null, string $name = '', string $imgUrl = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->urlImg = $imgUrl;
    }

    public function getId(): ?string { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getUrlImg(): string { return $this->urlImg; }

    public function setId(?string $id): void { $this->id = $id; }
    public function setName(string $name): void { $this->name = $name; }
    public function setUrlImg(string $urlImg): void { $this->urlImg = $urlImg; }

    /**
     * Return a string representation of the unit class.
     */
    public function __toString(): string
    {
        return sprintf("%s [%s]", $this->name, $this->id ?? 'new');
    }
}
