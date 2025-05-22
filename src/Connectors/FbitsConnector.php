<?php
namespace App\Connectors;

use GuzzleHttp\Client;

class FbitsConnector
{
    private Client $http;

    public function __construct(string $baseUri, string $token)
    {
        $this->http = new Client([
            'base_uri' => $baseUri,
            'headers'  => [
                'Authorization' => 'Basic ' . $token,
                'Accept'        => 'application/json',
            ],
        ]);
    }

    /**
     * Busca produto por SKU
     *
     * @param string $sku
     * @return array|null
     */
    public function buscarProduto(string $sku): ?array
    {
        $response = $this->http->get("/produtos/{$sku}", [
            'query' => ['tipoIdentificador' => 'Sku'],
        ]);
        return json_decode((string) $response->getBody(), true);
    }
}
