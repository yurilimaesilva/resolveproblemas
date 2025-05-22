<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Connectors\FbitsConnector;

$config = require __DIR__ . '/../config/config.php';
$connector = new FbitsConnector(
    $config['fbits']['base_uri'],
    $config['fbits']['token']
);

/**
 * Busca produto na Wake e retorna array com dimensões
 *
 * @param string $sku
 * @return array|null
 */
function buscarProduto($sku)
{
    global $connector; // acessa o connector já criado acima

    $produto = $connector->buscarProduto($sku);

    if (!$produto) {
        return null;
    }

    return [
        'peso'        => $produto['peso'] ?? null,
        'altura'      => $produto['altura'] ?? null,
        'comprimento' => $produto['comprimento'] ?? null,
        'largura'     => $produto['largura'] ?? null,
    ];
}
