<?php

namespace App\Controller\Back\Settings;

use App\Entity\EmailSetting;
use App\Repository\EmailSettingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SettingsController extends AbstractController
{
    // Définition des checkboxes par section
    private const CHECKBOXES = [
        'website' => [
            ['key' => 'deposit',              'label' => 'Acompte'],
            ['key' => 'mockup_sent',          'label' => 'Maquette envoyée'],
            ['key' => 'onboarding_training',  'label' => 'Formation prise en main'],
            ['key' => 'status',               'label' => 'Envoyé au service admin'],
        ],
        'visual_identity' => [
            ['key' => 'deposit', 'label' => 'Acompte'],
            ['key' => 'status',  'label' => 'Envoyé au service admin'],
        ],
    ];

    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {}

    #[Route('/admin/parametres', name: 'admin_settings')]
    public function index(
        EmailSettingRepository $repository,
        Request $request,
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // Initialise les lignes manquantes en BDD
        foreach (self::CHECKBOXES as $section => $checkboxes) {
            foreach ($checkboxes as $cb) {
                $setting = $repository->findOneBy(['section' => $section, 'checkboxKey' => $cb['key']]);
                if (!$setting) {
                    $setting = new EmailSetting();
                    $setting->setSection($section);
                    $setting->setCheckboxKey($cb['key']);
                    $setting->setLabel($cb['label']);
                    $this->entityManager->persist($setting);
                }
            }
        }
        $this->entityManager->flush();

        // Sauvegarde d'un setting
        if ($request->isMethod('POST')) {
            $id             = $request->request->get('id');
            $recipientEmail = $request->request->get('recipientEmail');
            $subject        = $request->request->get('subject');
            $messageBody    = $request->request->get('messageBody');

            $setting = $repository->find((int) $id);
            if ($setting) {
                $setting->setRecipientEmail($recipientEmail ?: null);
                $setting->setSubject($subject ?: null);
                $setting->setMessageBody($messageBody ?: null);
                $this->entityManager->flush();
                $this->addFlash('success', 'Configuration sauvegardée.');
            }

            return $this->redirectToRoute('admin_settings', ['tab' => $request->request->get('tab', 'website')]);
        }

        return $this->render('back/settings/index.html.twig', [
            'websiteSettings'        => $repository->findBySection('website'),
            'visualIdentitySettings' => $repository->findBySection('visual_identity'),
            'activeTab'              => $request->query->get('tab', 'website'),
        ]);
    }
}
