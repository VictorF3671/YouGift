<?php
namespace Core\Domain\UseCase\Vendas\DTO;

class ListarComprasDoUsuarioOutputDto
{
    public function __construct(
        public string $vendaId,
        public string $nomeProduto,
        public float $valor,
        public string $codigoSerial,
        public string $statusSerial,
        public string $metodoPagamento,
        public string $statusPagamento,
        public string $dataCompra,
    ) {}
}
