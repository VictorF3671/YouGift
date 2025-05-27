<?php
namespace Core\UseCase\Pagamento\DTO;

class ConfirmarPagamentoOutputDto
{
    public function __construct(
        public string $status,
        public string $mensagem
    ) {}
}
