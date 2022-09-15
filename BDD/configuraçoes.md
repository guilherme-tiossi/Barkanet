#encoding: UTF-8
#language: pt

Funcionalidade: Mudar de senha
Como um usuário do Barkanet
"Fulano" quer alterar sua senha
Para que ele altere a senha de seu cadastro

Contexto:
Dado que o "Fulano" tenha uma conta no Barkanet

Cenário: Senha alterada
E ele acessa a pagina de configurações
E clica na opção de Alterar Senha
E preenche a senha de confirmação corretamente
Quando ele aciona a opção de Alterar Senha
Então ele é direcionado para o formulario para que seja escolhida a nova senha

Cenário: Senha não alterada
E ele acessa a pagina de configurações
E clica na opção de Alterar Senha
E preenche a senha de confirmação incorretamente
Quando ele aciona a opção de Alterar Senha
Então um alerta aparece na tela avisando que a confirmação de senha esta incorreta e não é redirecionado para o formulario para que seja escolhida a nova senha  

--------------------------------------------------------------------------------------------------------------

Funcionalidade: Deletar conta
Como um usuário do Barkanet
"Fulano" quer deletar sua conta
Para que ele exclua seu cadastro do Barkanet e apague todos os seus dados

Contexto:
Dado que o "Fulano" tenha uma conta no Barkanet

Cenário: Excluiu a conta
E ele acessa a pagina de configurações
E clica na opção de Deletar Conta
E preenche os dados corretamentes no formulario de confirmação
Quando ele aciona o botão de Deletar
Então ele é redirecionado para a pagina Deletado e a conta do "Fulano" é excluida do Barkanet 

--------------------------------------------------------------------------------------------------------------

Funcionalidade: Mudar o tema
Como um usuário do Barkanet
"Fulano" quer mudar o tema da sua tela
Para mudar as cores da tela da sua conta

Contexto:
Dado que o "Fulano" tenha uma conta no Barkanet

Cenário: Excluiu a conta
E ele acessa a pagina de configurações
E ele escolhe uma das opções de cores
Quando e quando ele aciona o botão Confirmar
Então as cores da conta mudam para a opção escolhida por ele

--------------------------------------------------------------------------------------------------------------

Funcionalidade: Ver os Termos e Políticas de Privacidade
Como um usuário do Barkanet
"Fulano" quer ver os Termos e Políticas de Privacidade
Para poder ler os termos e políticas do Barkanet

Contexto:
Dado que o "Fulano" tenha uma conta no Barkanet

Cenário: Acessou os termos
E ele acessa a pagina de configurações
Quando e quando ele aciona o botão Termos e Privacidade
Então os Termos e Políticas de Privacidade do Barkanet aparecem na tela para ele

--------------------------------------------------------------------------------------------------------------