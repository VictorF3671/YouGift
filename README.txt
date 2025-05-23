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

Api_PHP

Implementar a logica existente do Django,
adicionar as novas funcionalidades,
adicionar o swagger,



| **usuarios**                           | `id`, `cpf`, `nome`, `nome_usuario`, `telefone`, `email`, `senha`, `grupo`, `criado_em`           

| **empresas**                           | `id`, `nome`, `logo_url`, `site`, `criado_em`                                                     

| **produtos\_giftcard**                 | `id`, `empresa_id`, `valor`, `descricao`, `criado_em`                                             

| **carrinhos**                          | `id`, `usuario_id`, `status` (`aberto`, `convertido`, `abandonado`), `criado_em`, `atualizado_em` 

| **itens\_carrinho**                    | `id`, `carrinho_id`, `produto_giftcard_id`, `quantidade`, `preco_unitario`                        

| **vendas**                             | `id`, `usuario_id`, `carrinho_id`, `valor_total`, `criado_em`                                     

| **itens\_venda**                       | `id`, `venda_id`, `produto_giftcard_id`, `quantidade`, `preco_unitario`                           

| **seriais\_giftcard**                  | `id`, `venda_id`, `produto_giftcard_id`, `codigo_serial`, `gerado_em`, `status`                   

| **cartoes** *(opcional)*               | `id`, `usuario_id`, `numero_cartao`, `nome_titular`, `validade`, `cvv`, `criado_em`               

| **transacoes\_pagamento** *(opcional)* | `id`, `venda_id`, `metodo`, `status`, `id_externo`, `criado_em`                                   
