<?php

namespace App\Command;

use Core\Domain\Usuario\Enum\TipoUsuario;
use Core\UseCase\Usuario\RegistrarUsuario;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

#[AsCommand(
    name: 'usuario:criar-vitu',
    description: 'Cria um usuário do tipo ADMIN via terminal.'
)]
class CriarAdminCommand extends Command
{
    public function __construct(
        private RegistrarUsuario $registrarUsuario
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');

        $output->writeln('<info>Criação de usuário ADMIN</info>');

        $cpf = $helper->ask($input, $output, new Question('CPF: '));
        $nome = $helper->ask($input, $output, new Question('Nome: '));
        $email = $helper->ask($input, $output, new Question('Email: '));

        $senhaQuestion = new Question('Senha: ');
        $senhaQuestion->setHidden(true)->setHiddenFallback(false);
        $senha = $helper->ask($input, $output, $senhaQuestion);

        $dados = [
            'cpf' => $cpf,
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha,
            'tipo' => TipoUsuario::ADMIN->value,
        ];

        try {
            $usuario = $this->registrarUsuario->executar($dados);
            $output->writeln("<info>Usuário ADMIN criado com sucesso. ID: {$usuario->getId()}</info>");
            return Command::SUCCESS;
        } catch (\Throwable $e) {
            $output->writeln("<error>Erro: {$e->getMessage()}</error>");
            return Command::FAILURE;
        }
    }
}
