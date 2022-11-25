<?php

namespace App\Controller\Back;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\File;
use Psr\Log\LoggerInterface;
use App\Repository\TaskRepository;
use App\Repository\QuoteRepository;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppointmentRepository;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    // -------------------------------------------
    // ----------- Download All Missions ---------
    // -------------------------------------------

    /**
     *@Route("/generation-de-l-archive/", name="download")
     */
    public function archivedBtn(TaskRepository $task, AppointmentRepository $appointment, QuoteRepository $quote, LoggerInterface $logger, $length = 2, $characters = 'abcdefghijklmnopqrstuvwxyz0123456789'): RedirectResponse
    {

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Gotham');
        $pdfOptions->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($pdfOptions);
        $dompdf->setPaper('A3', 'landscape');
        $html = $this->renderView('back/current_week/file/download.html.twig', [
            'task' => $task->findAll(),
            'appointment' => $appointment->findBy([], ['hoursappointment' => 'DESC']),
            'quote' => $quote->findAll(),
        ]);
        $dompdf->loadHtml($html);
        $dompdf->render();
        $output = $dompdf->output();

        $image = new File;
        $charactersLength = strlen($characters);
        $randomString = '';
        for (
            $i = 0;
            $i < $length;
            $i++
        ) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $path = $this->getParameter('download_task_directory');

        $dateFile = date("d-m-y");
        $fileName = 'liste-des-taches-du-' . $dateFile . '-' . $randomString . '.pdf';

        $fsObject = new Filesystem();

        try {
            if (!$fsObject->exists($path)) {
                $fsObject->mkdir($path);
            }
            $file = $path . $fileName;
            if (!$fsObject->exists($file)) {
                $fsObject->touch($file);
                $fsObject->chmod($file, 0777);
                $fsObject->dumpFile($file, $output);
            }
        } catch (IOExceptionInterface $exception) {
            $logger->error("Impossible de créer le fichier");
        }

        $image->setName($fileName);
        $this->entityManager->persist($image);
        $this->entityManager->flush();

        return $this->redirectToRoute("download_list");
    }

}
