#encoding: UTF-8
#language: pt

Funcionalidade: Comentar
Como um usuário do Barkanet
"Fulano" quer comentar em um post em sua timeline geral
Para comentar algo sobre o post na rede social

Contexto:
Dado que o post apareça na timeline do "Fulano"

Cenário: Digitou o comentario corretamente
E ele clica em comentar
E ele preenche o campo com algum comentário
Quando ele aciona a opção para Enviar
Então o comentario deve ser publicado e aparecer em baixo do post

Cenário: Deixou o comentario vazio
E ele clica em comentar
E ele não preenche o campo do comentário
Quando ele aciona a opção para Enviar
Então o comentario não é publicado

Cenário: Excedeu o numero de caracteres do comentário
E ele clica em comentar
E ele ultrapassa o limite de caracteres do comentário
Quando ele aciona a opção para Enviar
Então um alerta aparece na tela dizendo que o campo foi preenchido incorretamente e o comentario não é publicado

--------------------------------------------------------------------------------------------------------------

Funcionalidade: Mudar de página da timeline
Como um usuário do Barkanet
"Fulano" quer ver a proxima pagina de posts
Para ver os proximos posts de sua timeline

Contexto:
Dado que a timeline do "Fulano" tenha mais de uma pagina

Cenário: A timeline possui mais de 1 pagina
Quando ele clica no botão da seta ou do numero da pagina
Então o "Fulano" é redirecionado para a proxima página ou a pagina escolhida

Cenário: A timeline não possui mais de 1 pagina
Quando ele clica no botão da seta ou do numero da pagina
Então o "Fulano" permanece na mesma pagina e nada acontece

--------------------------------------------------------------------------------------------------------------

Funcionalidade: Convidar amigos para grupos
Como um usuário do Barkanet
"Fulano" quer convidar seus amigos para o seu grupo
Para que seus amigos sejam participantes e possão interagir no grupo

Contexto:
Dado que o "Fulano" tenha criado um grupo e tenha amigos para convidar no Barkanet

Cenário: Convidou um amigo
E ele clica em algum nome da sua lista de amigos que aparece no grupo
Quando ele clica em algum nome
Então aparece a opção de convidar o amigo

Cenário: Já convidou o amigo
E ele clica em algum nome da sua lista de amigos que já foi convidado
Quando ele clica no nome
Então aparece a opção de cancelar o convite

Cenário: O amigo já é participante do grupo
E ele clica em algum nome da sua lista de amigos que já é um participante
Quando ele clica no nome
Então aparece a opção de remover do grupo

--------------------------------------------------------------------------------------------------------------

Funcionalidade: Sair de grupos
Como um usuário do Barkanet
"Fulano" quer sair de um grupo
Para não fazer mais parte daquele grupo

Contexto:
Dado que o "Fulano" participe de um grupo que não tenha sido criado por ele

Cenário: Saiu do grupo
Quando ele clica na opção Sair do grupo
Então ele sai do grupo e deixa de ser um participante, sendo redirecionado para a pagina Procurar

--------------------------------------------------------------------------------------------------------------

Funcionalidade: Editar informações de Grupos
Como um usuário do Barkanet
"Fulano" quer editar as informações de um grupo
Para alterar as informações daquele grupo

Contexto:
Dado que o "Fulano" tenha criado um grupo

Cenário: Editou os dados corretamente
E ele clica no icone de edição
E ele muda as informações corretamente
Quando ele aciona a opção Salvar
Então os dados do grupo são alterados

Cenário: Editou os dados de forma incorreta
E ele clica no icone de edição
E ele muda as informações preenchendo incorretamente os campos
Quando ele aciona a opção Salvar
Então um aviso aparece dizendo que os campos que estão preenchidos incorretamente

--------------------------------------------------------------------------------------------------------------

Funcionalidade: Excluir grupos
Como um usuário do Barkanet
"Fulano" quer excluir um grupo
Para que o grupo deixe de existir e seja apagado

Contexto:
Dado que o "Fulano" tenha criado um grupo

Cenário: Excluiu o grupo
E ele clica no icone de edição
Quando ele aciona a opção Excluir grupo
Então uma mensagem de confirmação aparece para a exclusão do grupo

--------------------------------------------------------------------------------------------------------------