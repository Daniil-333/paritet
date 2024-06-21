# Laravel Сайт промо-акции
<h1>Инструкция для запуска</h1>
<ul>
  <li><strong>npm i</strong> - установка пакетов JS</li>

  <li><strong>composer install</strong> - установка пакетов PHP</li>

  <li>
    <p>Импорт БД (либо 1, либо 2):</p>
        <p>1) <strong>php artisan migrate</strong> - установка миграций</p>
        <p>2) <strong>Файл paritet.sql</strong> - создать БД paritet и импортировать данные с файла-дампа. НЕ забыть прописать параметры подключения к БД в файле .env<p>
  </li>

  <li><strong>npm run build</strong> - сборка фронтенд</li>

  <li><strong>npm run build:admin</strong> - сборка админки</li>

  <li><strong>/login</strong> - путь в Админку. Данные для входа в дампе paritet.sql</li>
</ul>
