<?php

namespace CodeCommerce\AlexaApi\Core;

use CodeCommerce\AlexaApi\Model\Response;
use CodeCommerce\AlexaApi\Model\ResponseBody;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ResponseFormatter
{
    protected $formattedResponse;

    public function __construct(Response $response)
    {
        $this->formattedResponse = $this->formatResponse($response);
    }

    public function getFormattedResponse()
    {
        return $this->formattedResponse;
    }

    protected function formatResponse(Response $response)
    {
        $responseBody = new ResponseBody();
        $responseBody->setVersion($response->getVersion());
        $responseBody->setResponse($response);

        return $this->serializeResponse($responseBody);
    }

    protected function serializeResponse($responseBody)
    {
        $encoder = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoder);
        $jsonContent = $serializer->serialize($responseBody, 'json');

        return $jsonContent;
    }
}
