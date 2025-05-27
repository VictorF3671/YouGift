<?php
namespace Core\UseCase\Pagamento\DTO;

class ConfirmarPagamentoInputDto
{
    public function __construct(
        public string $pagamentoId
    ) {}
}
