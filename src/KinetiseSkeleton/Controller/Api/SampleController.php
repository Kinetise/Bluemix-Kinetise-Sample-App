<?php

namespace KinetiseSkeleton\Controller\Api;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\SerializationContext;
use KinetiseSkeleton\Controller\AbstractController;
use KinetiseSkeleton\Doctrine\Entity\Comment;
use KinetiseSkeleton\Response\MessageResponse;
use KinetiseSkeleton\Response\Model\Rss;
use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SampleController extends AbstractController
{
    public function getAction(Request $request)
    {
        $json = $request->request->get('_json', array());


        $response['columns'] = $json['data']['columns'];
        $response['rows'] = $json['data']['rows'];

        foreach ($response['rows'] as $key => &$row) {
            $row['custom_hook'] = "This was added to row {$key} by custom hook";
        }

        return new JsonResponse($response);
    }
}