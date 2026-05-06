<?php

namespace App\Controller\Back\Settings;

use App\Repository\EmailSettingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SettingsController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {}

    #[Route('/admin/parametres', name: 'admin_settings')]
    public function index(
        EmailSettingRepository $repository,
        Request $request,
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // Sauvegarde d'un setting
        if ($request->isMethod('POST')) {
            $id             = $request->request->get('id');
            $recipientEmail = $request->request->get('recipientEmail');
            $subject        = $request->request->get('subject');
            $messageBody    = $request->request->get('messageBody');
            $tab            = $request->request->get('tab', 'website');
            $mailTab        = $request->request->get('mailTab', 'compta');

            if (!in_array($tab, ['website', 'visual_identity'], true)) {
                $tab = 'website';
            }
            if (!in_array($mailTab, ['compta', 'admin'], true)) {
                $mailTab = 'compta';
            }

            $setting = $repository->find((int) $id);
            if ($setting) {
                $setting->setRecipientEmail($recipientEmail ?: null);
                $setting->setSubject($subject ?: null);
                $setting->setMessageBody($messageBody ?: null);
                $this->entityManager->flush();
                $this->addFlash('success', 'Configuration sauvegardée.');
            }

            return $this->redirectToRoute('admin_settings', ['tab' => $tab, 'mailTab' => $mailTab]);
        }

        $activeTab = $request->query->get('tab', 'website');
        $activeMailTab = $request->query->get('mailTab', 'compta');
        if (!in_array($activeTab, ['website', 'visual_identity'], true)) {
            $activeTab = 'website';
        }
        if (!in_array($activeMailTab, ['compta', 'admin'], true)) {
            $activeMailTab = 'compta';
        }

        return $this->render('back/settings/index.html.twig', [
            'websiteSettings'        => $repository->findBySection('website'),
            'visualIdentitySettings' => $repository->findBySection('visual_identity'),
            'activeTab'              => $activeTab,
            'activeMailTab'          => $activeMailTab,
        ]);
    }
}
