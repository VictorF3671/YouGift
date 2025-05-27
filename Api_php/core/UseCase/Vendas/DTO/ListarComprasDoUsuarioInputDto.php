<?php
namespace Core\Domain\UseCase\Vendas\DTO;

class ListarComprasDoUsuarioInputDto
{
    public function __construct(
        public string $usuarioId
    ) {}
}
