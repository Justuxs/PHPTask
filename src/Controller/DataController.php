<?php

namespace App\Controller;

use App\Service\ApiDataFetcher;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DataRecordRepository;
use App\Entity\DataRecord;

class DataController extends AbstractController
{
    #[Route('/', name: 'app_data_list')]
    public function index(DataRecordRepository $repo): Response
    {
        $records = $repo->findAll();

        return $this->render('index.html.twig', [
            'records' => $records,
        ]);
    }

    #[Route('/import', name: 'app_data_import')]
    public function import(
        EntityManagerInterface $em,
        DataRecordRepository $repo,
        ApiDataFetcher $apiDataFetcher
    ): Response {
        $lastRecord = $repo->findOneBy([], ['recordDate' => 'DESC']);
        $lastDate = $lastRecord ? $lastRecord->getRecordDate()->format('Y-m-d') : '2021-10-28';

        $responseData = $apiDataFetcher->fetchData($lastDate, 1);

        if (isset($responseData['data']) && is_array($responseData['data'])) {
            foreach ($responseData['data'] as $item) {
                $transactionId = $item['transaction_id'];

                $existing = $repo->findOneBy(['transactionId' => $transactionId]);
                if (!$existing) {
                    $record = new DataRecord();
                    $record->setTransactionId($transactionId);
                    $record->setToolNumber($item['tool_number'] ?? '');
                    $record->setLatitude(isset($item['latitude']) ? (float)$item['latitude'] : 0.0);
                    $record->setLongitude(isset($item['longitude']) ? (float)$item['longitude'] : 0.0);
                    $record->setBatPercentage(isset($item['bat_percentage']) ? (float)$item['bat_percentage'] : null);
                    $record->setRecordDate(new \DateTime($item['date']));
                    $record->setImportDate(new \DateTime($item['import_date']));
                    $em->persist($record);
                }
            }

            $em->flush();
        }

        return $this->redirectToRoute('app_data_list');
    }
}