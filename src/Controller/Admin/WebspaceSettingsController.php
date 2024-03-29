<?php

declare(strict_types=1);

namespace Manuxi\SuluWebspaceSettingsBundle\Controller\Admin;

use Exception;
use Manuxi\SuluWebspaceSettingsBundle\Entity\WebspaceSettings;
use Doctrine\ORM\EntityManagerInterface;
use Sulu\Component\Security\SecuredControllerInterface;
use Sulu\Component\Webspace\Manager\WebspaceManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebspaceSettingsController extends AbstractController implements SecuredControllerInterface
{

    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    public static function getSubscribedServices(): array
    {
        return array_merge(parent::getSubscribedServices(), [
            WebspaceManagerInterface::class,
            RequestStack::class
        ]);
    }

    /**
     * @Route("/webspace-settings/{id}", methods={"GET"}, name="get_webspace_settings")
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function getAction(Request $request): Response
    {
        //$webspace = $request->query->get('webspace');
        //$webspace = $this->requestAnalyzer->getWebspace();
        //$webspace = $this->requestStack->getCurrentRequest()->query->all();

        $webspace = "sulu-test";

        #throw new Exception(serialize ($webspace));

        $webspaceSetting = $this->entityManager->getRepository(WebspaceSettings::class)->findOneBy([
            'webspace' => $webspace,
        ]);

        return $this->json($this->getDataForEntity($webspaceSetting ?: new WebspaceSettings($webspace)));
    }

    protected function getDataForEntity(WebspaceSettings $entity): array
    {
        return [
            'languageSwitch' => $entity->getLanguageSwitch(),
            'showSearch' => $entity->getShowSearch(),
            'toggleSearchHeader' => $entity->getToggleSearchHeader(),
            'toggleSearchHero' => $entity->getToggleSearchHero(),
            'toggleSearchBreadcrumbs' => $entity->getToggleSearchBreadcrumbs(),
            'toggleSearchFormUnderResults' => $entity->getToggleSearchFormUnderResults(),
            'toggleSearchFormShowQuery' => $entity->getToggleSearchFormShowQuery(),
            'maxSearchResults' => $entity->getMaxSearchResults(),
            'highlightSearchResults' => $entity->getHighlightSearchResults(),
        ];
    }

    /**
     * @Route("/webspace-settings/{id}", methods={"PUT"}, name="put_webspace_settings")
     */
    public function putAction(Request $request): Response
    {
        $webspace = $request->query->get('webspace');

        $webspaceSetting = $this->entityManager->getRepository(WebspaceSettings::class)->findOneBy([
            'webspace' => $webspace,
        ]);

        if (!$webspaceSetting) {
            $webspaceSetting = new WebspaceSettings($webspace);
            $this->entityManager->persist($webspaceSetting);
        }

        /** var WebspaceSettingsData $data */
        $data = $request->toArray();
        $this->mapDataToEntity($data, $webspaceSetting);
        $this->entityManager->flush();

        return $this->json($this->getDataForEntity($webspaceSetting));
    }

    protected function mapDataToEntity(array $data, WebspaceSettings $entity): void
    {
        $entity->setLanguageSwitch($data['languageSwitch']);
        $entity->setShowSearch($data['showSearch']);
        $entity->setToggleSearchHeader($data['toggleSearchHeader']);
        $entity->setToggleSearchHero($data['toggleSearchHero']);
        $entity->setToggleSearchBreadcrumbs($data['toggleSearchBreadcrumbs']);
        $entity->setToggleSearchFormUnderResults($data['toggleSearchFormUnderResults']);
        $entity->setToggleSearchFormShowQuery($data['toggleSearchFormShowQuery']);
        $entity->setHighlightSearchResults($data['highlightSearchResults']);
    }

    public function getSecurityContext()
    {
        //$request = $this->requestStack->getCurrentRequest();
        return true;
        #return WebspaceSettingsAdmin::getWebspaceSettingSecurityContext($request->query->get('webspace'));
    }

    public function getLocale(Request $request): ?string
    {
        return $request->query->get('locale');
    }
}