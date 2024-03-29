<?php

namespace Manuxi\SuluWebspaceSettingsBundle\Twig;

use Manuxi\SuluWebspaceSettingsBundle\Entity\WebspaceSettings;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class WebspaceSettingsTwigExtension extends AbstractExtension
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('load_webspace_setting', [$this, 'loadWebspaceSetting']),
        ];
    }

    public function loadWebspaceSetting(string $webspace): WebspaceSettings
    {
        $webspaceSettings = $this->entityManager->getRepository(WebspaceSettings::class)->findOneBy(['webspace' => $webspace]) ?? null;

        return $webspaceSettings ?: new WebspaceSettings($webspace);
    }
}