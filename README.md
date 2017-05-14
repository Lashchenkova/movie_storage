# movie_storage

1.	Загрузить дамп базы данных (*moviesdb*) с одной таблицей movie. Данные: хост, юзер, пароль, название бд находятся в *lib/Database.php* (при необходимости поменять).
2.	Точка входа *index.php*. Вьюха всего одна, здесь можно добавлять/удалять фильмы, делать поиск, сортировать и загружать файлы с фильмами. 

Папка Lib с классами:

**Database** – подключение к бд (синглтон).
 
**Parser** – парсинг для загружаемых файлов.
 
**Movie** – CRUD для таблицы с фильмами, с методами:
 
* getById – для вывода полной инфы об одном фильме, 
* findAll – вывод всех данных из таблицы, 
* addMovie – добавление фильмов из обеих форм (данные введенные вручную и загруженный файл), 
* deleteMovie – удаление одного фильма, 
* findByQuery – найти фильмы с конкретным актером или по названию (выбор с LIKE %query%)

**View** – рендеринг контента для index.html. Меняются alerts, хедеры в таблице и данные таблицы. 

**App** – конект к бд, обработка запросов get, post и массива files и вывод вьюхи.
