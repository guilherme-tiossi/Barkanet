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