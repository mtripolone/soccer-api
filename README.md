# Soccer Api

Api destinada a teste técnico da empresa Code Group, tendo em vista um problema ao tentar formar times para uma partida  entre amigos.

## Installation

A configuração está centralizada no arquivo Makefile (necessário docker).
No arquivo ja está sendo feita a instalação das dependencias, rodando as migrations e os seeders.

```bash
make up
```
```bash
make install
```

## Utilização

Acessar 34.16.220.224/api/documentation para acessar a documentação.
Caso veja necessidade de utilziar via postman/insominia a collection se encontra no e-mail enviado.

## Balanceamento de Times

Na Classe GameService está toda a lógica utilizada para balancear os times.

Nela filtramos os jogadores e goleiros separadamente, fazemos todas as validações para verificar se é possivel criar um time, montamos os times a partir do goleiro e temos uma classe chamada "getBalancedPlayers" onde fazemos um count do nivel dos times para melhor balanceamento, caso esteja muito desbalanceado ele monta novamente os times.
