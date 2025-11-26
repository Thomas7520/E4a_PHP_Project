<?php

namespace Models\Parameter\Element;

/**
 * Represents an Element parameter in the system.
 */
class Element
{
    private ?string $id;
    private string $name;
    private string $urlImg;

    /**
     * Constructor.
     *
     * @param string|null $id Optional element ID.
     * @param string $name Element name.
     * @param string $imgUrl Optional URL of the element image.
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
     * Return a string representation of the element.
     */
    public function __toString(): string
    {
        return sprintf("%s [%s]", $this->name, $this->id ?? 'new');
    }
}
