# Как развернуть проект локально:

Проект в стадии разработки

```
git clone git@github.com:aleksander9208/bron.git
cd bron
make env
make up
```

Опционально, если автоматически не отработал скрипт,
выполнить применение настроек базы:
```
make prepare-db
```
Либо любым удобным SQL клиентом, скрипт находится тут: `database/bron.sql`<br>

## Запуск и остановка докеровских контейнеров

По умолчанию вебсервер запускается на 80 порту, а база данных - на порту 3306.
Если нужно переопределить эти порты, то установите их в файле `.env`

Для запуска проекта выполните команду:
```
make up
```

Чтобы остановить контейнеры:
```
make down
```

## На проекту установлен phpMyAdmin

Для входа в phpMyAdmin нужно перейти по ссылке 
```
localhost:8081
```

## Дополнительная информация

Справка по командам:
```
make help
```
Подсмотреть порядок команд из терминала:
```
make inf
```