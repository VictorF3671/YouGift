<?php
namespace Core\Domain\UseCase\Vendas;

use Api_php\core\Domain\Pagamento\Enum\StatusPagamento;
use Api_php\core\Domain\Pagamento\Repository\PagamentoRepositoryInterface;
use Core\Domain\GiftCard\Repository\GiftcardSerialRepositoryInterface;
use Core\Domain\UseCase\Vendas\DTO\ListarComprasDoUsuarioInputDto;
use Core\Domain\UseCase\Vendas\DTO\ListarComprasDoUsuarioOutputDto;
use Core\Domain\Venda\Repository\VendaRepositoryInterface;
use Doctrine\Migrations\Tools\Console\Command\StatusCommand;

class ListarComprasDoUsuario
{
    public function __construct(
        private VendaRepositoryInterface $vendaRepository,
        private GiftcardSerialRepositoryInterface $giftcardSerialRepository,
        private PagamentoRepositoryInterface $pagamentoRepository,
    ) {}

    public function execute(ListarComprasDoUsuarioInputDto $input): array
    {
        $vendas = $this->vendaRepository->findByUsuarioId($input->usuarioId);
        $compras = [];
     

        foreach ($vendas as $venda) {
            $serial = $this->giftcardSerialRepository->findByVendaId($venda->getId());
            $pagamento = $this->pagamentoRepository->findByVendaId($venda->getId());
            $compras = new ListarComprasDoUsuarioOutputDto(
                vendaId: $venda->getId(),
                nomeProduto: $serial->getNomeProduto(),
                valor: $venda->getValor(),
                codigoSerial: $serial->getCodigoSerial(),
                statusSerial: $serial->getStatus()->value,
                metodoPagamento: $pagamento->getMetodoPagamento()->value,
                statusPagamento: $pagamento->getStatus()->value,
                dataCompra: $venda->getCriadoEm()->format('Y-m-d H:i:s')
            );
        }

        return $compras;
    }
}