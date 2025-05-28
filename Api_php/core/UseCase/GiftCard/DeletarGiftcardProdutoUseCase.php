<?php
namespace Core\UseCase\GiftcardProduto;

use Core\Domain\GiftCard\Repository\GiftcardProdutoRepositoryInterface;

class DeletarGiftcardProdutoUseCase
{
    public function __construct(
        private GiftcardProdutoRepositoryInterface $repository
    ) {}

    public function execute(string $id): void
    {
        $giftcard = $this->repository->findById($id);

        if (!$giftcard) {
            throw new \DomainException("Giftcard não encontrado.");
        }

        $this->repository->delete($giftcard);
    }
}
