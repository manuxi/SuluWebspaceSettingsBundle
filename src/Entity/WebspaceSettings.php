<?php

namespace Manuxi\SuluWebspaceSettingsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sulu\Component\Persistence\Model\AuditableInterface;
use Sulu\Component\Persistence\Model\AuditableTrait;

#[ORM\Entity]
#[ORM\Table(name: 'app_webspace_settings')]
class WebspaceSettings implements AuditableInterface
{
    use AuditableTrait;

    public const RESOURCE_KEY = 'webspace_settings';

    #[ORM\Id()]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 32, unique: true, nullable: false)]
    private string $webspace;

    #[ORM\Column(type: "boolean", nullable: true)]
    private ?bool $languageSwitch = null;

    #[ORM\Column(type: "boolean", nullable: true)]
    private ?bool $showSearch = null;

    #[ORM\Column(type: "boolean", nullable: true)]
    private ?bool $toggleSearchHeader = null;

    #[ORM\Column(type: "boolean", nullable: true)]
    private ?bool $toggleSearchHero = null;

    #[ORM\Column(type: "boolean", nullable: true)]
    private ?bool $toggleSearchBreadcrumbs = null;

    #[ORM\Column(type: "boolean", nullable: true)]
    private ?bool $toggleSearchFormUnderResults = null;

    #[ORM\Column(type: "boolean", nullable: true)]
    private ?bool $toggleSearchFormShowQuery = null;

    #[ORM\Column(type: "boolean", nullable: true)]
    private ?bool $highlightSearchResults = null;

    #[ORM\Column(type: "integer", length: 128, nullable: true)]
    private ?int $maxSearchResults = null;

    public function __construct(string $webspace)
    {
        $this->webspace = $webspace;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWebspace(): string
    {
        return $this->webspace;
    }

    public function getLanguageSwitch(): ?bool
    {
        return $this->languageSwitch;
    }

    public function setLanguageSwitch(?bool $languageSwitch): void
    {
        $this->languageSwitch = $languageSwitch;
    }

    public function getShowSearch(): ?bool
    {
        return $this->showSearch;
    }

    public function setShowSearch(?bool $showSearch): void
    {
        $this->showSearch = $showSearch;
    }

    public function getToggleSearchHeader(): ?bool
    {
        return $this->toggleSearchHeader;
    }

    public function setToggleSearchHeader(?bool $toggleSearchHeader): void
    {
        $this->toggleSearchHeader = $toggleSearchHeader;
    }

    public function getToggleSearchHero(): ?bool
    {
        return $this->toggleSearchHero;
    }

    public function setToggleSearchHero(?bool $toggleSearchHero): void
    {
        $this->toggleSearchHero = $toggleSearchHero;
    }

    public function getToggleSearchBreadcrumbs(): ?bool
    {
        return $this->toggleSearchBreadcrumbs;
    }

    public function setToggleSearchBreadcrumbs(?bool $toggleSearchBreadcrumbs): void
    {
        $this->toggleSearchBreadcrumbs = $toggleSearchBreadcrumbs;
    }

    public function getToggleSearchFormUnderResults(): ?bool
    {
        return $this->toggleSearchFormUnderResults;
    }

    public function setToggleSearchFormUnderResults(?bool $toggleSearchFormUnderResults): void
    {
        $this->toggleSearchFormUnderResults = $toggleSearchFormUnderResults;
    }

    public function getToggleSearchFormShowQuery(): ?bool
    {
        return $this->toggleSearchFormShowQuery;
    }

    public function setToggleSearchFormShowQuery(?bool $toggleSearchFormShowQuery): void
    {
        $this->toggleSearchFormShowQuery = $toggleSearchFormShowQuery;
    }

    public function getMaxSearchResults(): ?int
    {
        return $this->maxSearchResults;
    }

    public function setMaxSearchResults(?int $maxSearchResults): void
    {
        $this->maxSearchResults = $maxSearchResults;
    }

    public function getHighlightSearchResults(): ?bool
    {
        return $this->highlightSearchResults;
    }

    public function setHighlightSearchResults(?bool $highlightSearchResults): void
    {
        $this->highlightSearchResults = $highlightSearchResults;
    }

}