<?php

namespace CodeCommerce\AlexaApi\Core;

use CodeCommerce\AlexaApi\Model\ResponseBody;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ResponseFormatter
{
    protected $formattedResponse;

    public function __construct(ResponseBody $responseBody)
    {
        $this->formattedResponse = $this->formatResponse($responseBody);
    }

    public function getFormattedResponse()
    {
        return $this->formattedResponse;
    }

    protected function formatResponse(ResponseBody $responseBody)
    {
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
