NOVO ADMIN
EMAIL: admin@gmail.com
SENHA: admin123

figma: https://www.figma.com/design/WNJZn9OegabITyrWaEXm4V/WebsiteE?node-id=124-30&p=f&t=EvVvXZrPGXlIgiUb-0

<tipo>[escopo opcional]: <mensagem breve>

[descrição mais longa opcional]

[referência opcional a issue ou tarefa]


Tipo	Para quê?

feat = Nova funcionalidade
fix = Correção de bug
docs = Mudança apenas em documentação
style = Formatação, identação, espaços, etc (sem alterar lógica)
refactor = Refatoração de código (sem mudar comportamento)
test = Adição ou alteração de testes
chore = Tarefas que não afetam o código de produção (ex: configs, builds)


🧾 Objetivo do sistema
Você está construindo um sistema de venda de gift cards, onde:

Um usuário (cliente) pode realizar pedidos (GiftCardOrder) com um ou mais gift cards (valores e empresas distintas).

Esses pedidos ficam inicialmente com is_paid = False, aguardando confirmação do pagamento.

Cada item do pedido é representado por GiftCardOrderItem, vinculado a um GiftCardValue.

📦 Modelos principais envolvidos
GiftCard – representa a empresa (Netflix, Amazon, etc).

GiftCardValue – valores disponíveis (ex: R$ 50, R$ 100).

GiftCardOrder – pedido feito pelo usuário.

GiftCardOrderItem – itens comprados no pedido (quantidade e valor).

GiftCardSerial – será gerado após o pagamento, com o código do cartão.

SaleHistory – será gerado após o pagamento, indicando o método e banco.

✅ Endpoints já funcionando
1. Criar uma ordem (GiftCardOrder)
Endpoint:

bash
Copiar
Editar
POST /api/giftcard-orders/
Requisição:

json
Copiar
Editar
{
  "user_id": 1,
  "items": [
    {
      "gift_card_id": 1,
      "value_id": 2,
      "quantity": 3
    },
    {
      "gift_card_id": 2,
      "value_id": 5,
      "quantity": 1
    }
  ]
}
Comportamento:

Cria a GiftCardOrder com is_paid = False.

Cria os GiftCardOrderItem relacionados a essa ordem.

Resposta esperada:

json
Copiar
Editar
{
  "id": 10,
  "user": 1,
  "is_paid": false,
  "items": [
    {
      "gift_card": 1,
      "gift_card_value": 2,
      "quantity": 3
    },
    {
      "gift_card": 2,
      "gift_card_value": 5,
      "quantity": 1
    }
  ],
  "created_at": "2025-05-21T02:18:00Z"
}
2. Listar todas as ordens
Endpoint:

bash
Copiar
Editar
GET /api/giftcard-orders/
Retorna todas as ordens, paginadas, incluindo is_paid, user, e os items.

3. Recuperar uma ordem específica
Endpoint:

bash
Copiar
Editar
GET /api/giftcard-orders/{id}/
Exemplo:

swift
Copiar
Editar
GET /api/giftcard-orders/10/
Retorna os detalhes da ordem específica.

4. Atualizar ou deletar (se permitido)
Você também tem suporte padrão (via ModelViewSet) para:

PUT/PATCH /api/giftcard-orders/{id}/

DELETE /api/giftcard-orders/{id}/

Mas no contexto de pedidos pagos, você provavelmente vai restringir essas operações mais tarde.

🛑 O que ainda não está implementado
/confirmar-pagamento/ → ainda vamos criar o endpoint que:

Atualiza is_paid = True

Cria os GiftCardSerials

Cria SaleHistory

👨‍💻 Como testar os endpoints hoje
Vá até o Swagger ou Insomnia/Postman.

Crie uma ordem com POST /api/giftcard-orders/.

Depois veja ela com GET /api/giftcard-orders/{id}/.

Confirme que is_paid = false.