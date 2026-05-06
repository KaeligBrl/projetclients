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
    // Définition des checkboxes par section avec sujets et messages par défaut
    private const CHECKBOXES = [
        'website' => [
            [
                'key'     => 'deposit',
                'label'   => 'Acompte (équipe → admin)',
                'subject' => 'Acompte reçu — {client}',
                'message' => "Bonjour,\n\nL'acompte pour le projet {client} ({section}) a bien été reçu.\n\nMerci de procéder à la facturation.\n\nCordialement",
            ],
            [
                'key'     => 'deposit_invoiced',
                'label'   => 'Acompte facturé (admin → équipe)',
                'subject' => 'Acompte facturé — {client}',
                'message' => "Bonjour,\n\nLa facture pour l'acompte du projet {client} ({section}) a été émise.\n\nCordialement",
            ],
            [
                'key'     => 'deposit_paid',
                'label'   => 'Acompte payé (admin → équipe)',
                'subject' => 'Acompte payé — {client}',
                'message' => "Bonjour,\n\nL'acompte du projet {client} ({section}) a été réglé. Vous pouvez passer à l'étape suivante.\n\nCordialement",
            ],
            [
                'key'     => 'mockup_sent',
                'label'   => 'Maquette envoyée (équipe → admin)',
                'subject' => 'Maquette envoyée — {client}',
                'message' => "Bonjour,\n\nLa maquette du projet {client} ({section}) a été envoyée au client.\n\nCordialement",
            ],
            [
                'key'     => 'mockup_sent_invoiced',
                'label'   => 'Maquette facturée (admin → équipe)',
                'subject' => 'Maquette facturée — {client}',
                'message' => "Bonjour,\n\nLa facture pour la maquette du projet {client} ({section}) a été émise.\n\nCordialement",
            ],
            [
                'key'     => 'mockup_sent_paid',
                'label'   => 'Maquette payée (admin → équipe)',
                'subject' => 'Maquette payée — {client}',
                'message' => "Bonjour,\n\nLa maquette du projet {client} ({section}) a été réglée. Vous pouvez passer à l'étape suivante.\n\nCordialement",
            ],
            [
                'key'     => 'onboarding_training',
                'label'   => 'Formation (équipe → admin)',
                'subject' => 'Formation effectuée — {client}',
                'message' => "Bonjour,\n\nLa formation prise en main pour {client} ({section}) a été effectuée.\n\nCordialement",
            ],
            [
                'key'     => 'onboarding_training_invoiced',
                'label'   => 'Formation facturée (admin → équipe)',
                'subject' => 'Formation facturée — {client}',
                'message' => "Bonjour,\n\nLa facture pour la formation {client} ({section}) a été émise.\n\nCordialement",
            ],
            [
                'key'     => 'onboarding_training_paid',
                'label'   => 'Formation payée (admin → équipe)',
                'subject' => 'Formation payée — {client}',
                'message' => "Bonjour,\n\nLa formation du projet {client} ({section}) a été réglée. Vous pouvez passer à l'étape suivante.\n\nCordialement",
            ],
            [
                'key'     => 'status',
                'label'   => 'Envoyé au service admin (équipe → admin)',
                'subject' => 'Dossier transmis au service admin — {client}',
                'message' => "Bonjour,\n\nLe dossier {client} ({section}) a été transmis au service administratif pour facturation.\n\nCordialement",
            ],
            [
                'key'     => 'status_invoiced',
                'label'   => 'Dossier admin facturé (admin → équipe)',
                'subject' => 'Facture émise — {client}',
                'message' => "Bonjour,\n\nLa facture finale pour {client} ({section}) a été émise.\n\nCordialement",
            ],
            [
                'key'     => 'status_paid',
                'label'   => 'Dossier admin payé (admin → équipe)',
                'subject' => 'Paiement reçu — {client}',
                'message' => "Bonjour,\n\nLe paiement final pour {client} ({section}) a bien été reçu.\n\nMerci.\n\nCordialement",
            ],
        ],
        'visual_identity' => [
            [
                'key'     => 'deposit',
                'label'   => 'Acompte (équipe → admin)',
                'subject' => 'Acompte reçu — {client}',
                'message' => "Bonjour,\n\nL'acompte pour l'identité visuelle de {client} ({section}) a bien été reçu.\n\nMerci de procéder à la facturation.\n\nCordialement",
            ],
            [
                'key'     => 'deposit_invoiced',
                'label'   => 'Acompte facturé (admin → équipe)',
                'subject' => 'Acompte facturé — {client}',
                'message' => "Bonjour,\n\nLa facture pour l'acompte de {client} ({section}) a été émise.\n\nCordialement",
            ],
            [
                'key'     => 'deposit_paid',
                'label'   => 'Acompte payé (admin → équipe)',
                'subject' => 'Acompte payé — {client}',
                'message' => "Bonjour,\n\nL'acompte de {client} ({section}) a été réglé. Vous pouvez passer à l'étape suivante.\n\nCordialement",
            ],
            [
                'key'     => 'status',
                'label'   => 'Envoyé au service admin (équipe → admin)',
                'subject' => 'Dossier transmis au service admin — {client}',
                'message' => "Bonjour,\n\nLe dossier identité visuelle de {client} ({section}) a été transmis au service administratif.\n\nCordialement",
            ],
            [
                'key'     => 'status_invoiced',
                'label'   => 'Dossier admin facturé (admin → équipe)',
                'subject' => 'Facture émise — {client}',
                'message' => "Bonjour,\n\nLa facture finale pour l'identité visuelle de {client} ({section}) a été émise.\n\nCordialement",
            ],
            [
                'key'     => 'status_paid',
                'label'   => 'Dossier admin payé (admin → équipe)',
                'subject' => 'Paiement reçu — {client}',
                'message' => "Bonjour,\n\nLe paiement final pour l'identité visuelle de {client} ({section}) a bien été reçu.\n\nMerci.\n\nCordialement",
            ],
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

        // Initialise les lignes manquantes en BDD et pré-remplit les valeurs par défaut si vides
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
                // Pré-remplit sujet et message s'ils sont vides
                if (!$setting->getSubject() && !empty($cb['subject'])) {
                    $setting->setSubject($cb['subject']);
                }
                if (!$setting->getMessageBody() && !empty($cb['message'])) {
                    $setting->setMessageBody($cb['message']);
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
