# Tic-Tac-Toe API

Multiplayer Tic-Tac-Toe game made with Laravel framework.

Docker installation:
```sh
git clone https://github.com/nazarPavl/tic-tac-toe-api.git

docker run --rm -v $(pwd):/app composer:latest install

cp .env.example .env

vendor/bin/sail up -d
```