# [WIP] Chess CLI

Play chess in your terminal!

## Caveats

This is a work in progress, a lot of things are (still) missing:

- capturing
- castling
- en passant
- pawn promotion
- checks (forcing moves for the other player)
- checkmate (ending game)
- preventing move if they convert into a check

## Requirements

PHP 8.1 - you can install it on macOS via Homebrew with:

```bash
brew install php@8.1
```

Composer: you can find instructions on how to install it at https://getcomposer.org

## Install

Clone the repo and install the dependencies

```bash
composer install
```

## Play

From your terminal, execute:

```bash
php index.php
```
