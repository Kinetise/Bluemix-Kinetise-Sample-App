<?php

namespace KinetiseSkeleton\Controller\Api;

use KinetiseSkeleton\Controller\AbstractController;
use KinetiseSkeleton\Doctrine\Entity\Comment;
use KinetiseSkeleton\Doctrine\Entity\SampleData;
use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class SampleController extends AbstractController
{
    public function getAction(Request $request)
    {
        $json = $request->request->get('_json', array());

        $sampleDataRepository = $this->getEntityManager()->getRepository('KinetiseSkeleton\Doctrine\Entity\SampleData');
        $rows = $sampleDataRepository->findAll();

        $response['columns'] = $json['data']['columns'];
        $response['rows'] = $json['data']['rows'];

        foreach ($response['rows'] as $key => &$row) {
            if ( isset($rows[$key]) ) {
                /** @var SampleData $dbSampleDataObject */
                $dbSampleDataObject = $rows[$key];
                $row['custom_hook'] = $dbSampleDataObject->getDescription();
            } else {
                $row['custom_hook'] = "This was added to row {$key} by custom hook";
            }
        }

        return new JsonResponse($response);
    }
}