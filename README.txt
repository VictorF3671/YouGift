figma: https://www.figma.com/design/WNJZn9OegabITyrWaEXm4V/WebsiteE?node-id=124-30&p=f&t=EvVvXZrPGXlIgiUb-0


Trocar o username para email no token

criar a model GiftCard e GiftCardSerial

GiftCard{
    nome:string
    descricao: string
    valor: double
    imagem: string
}

GiftCardSerial{
    GiftCard: GiftCard(foreing Key)
    codigo: string
    isBuy: boolean
}

criar a tabela de historico de compra



