# 🇺🇸 The list of users
My solution for a test task for a web studio for the position of Junior PHP Developer.

Program structure:
- `index.php` - main page, access through this script
- `get_user_messages.php` - script for getting user messages to display in modal window
- `search.php` - script for user search by login
- `db.php` - script for checking the existence of a database, if there is no such database, then it is created
- `scripts.js` - auxiliary js scripts for working with a modal window, sorting, etc.
- `style.css` - styles, a small adaptive is provided
- ZIP-archive `"juno_test"` with all the contents - this is the database itself for the scripts to work.

The `db.php` file should create the database itself if it does not find this database, but if it does not work, you can upload this folder to the server.
The solution was tested on Open Server with MySQL-8 settings.
____
# 🇷🇺 Список пользователей
Мое решение тестового задания для веб-студии на позицию Junior PHP Developer.

Структура программы:
- `index.php` - главная страница, заходить через этот скрипт
- `get_user_messages.php` - скрипт для получения сообщений пользователя для вывода в модальное окно
- `search.php` - скрипт для поиска пользователя по логину
- `db.php` - скрипт для проверки существования базы данных, если такой БД нет, то она создается
- `scripts.js` - вспомогательные js-скрипты для работы с модальным окном, сортировкой и т.д.
- `style.css` - стили, предусмотрен небольшой адаптив
- ZIP-архив `"juno_test"` со всем содержимым - это сама база данных для работы скриптов.

Файл `db.php` должен сам создать БД, если не найдет эта базу, но если не сработает можно скинуть эту папку на сервер.
Решение проверялось на Open Server с настройками под MySQL-8.
_____
## Описание задания
Все неописанные требования на свое усмотрение, выбор библиотек и путей реализации свободный, к дизайну требований не предъявляется. После выполнения задачи прислать БД и скрипты.

<ol>
  <li>Создать и заполнить БД (MySQL) тестовыми дынными о пользователях и их сообщениях.
    <ul>
      <li>Таблица с пользователями:
        <ul>
          <li>логин;</li>
          <li>пароль;</li>
          <li>email;</li>
          <li>ФИО.</li>
        </ul>
      </li>
      <li>Таблица с сообщениями:
        <ul>
          <li>текст сообщения;</li>
          <li>дата и время сообщения.</li>
        </ul>
      </li>
    </ul>
  </li>
  <li>Необходимо создать страницу (PHP, HTML, CSS), на которой будет показан список пользователей.</li>
  <li>Реализовать возможность поиска пользователя по логину без перезагрузки страницы.</li>
  <li>Возле логина пользователя показать количество сообщений пользователя. При клики по строке пользователя показать во всплывающем окне все сообщения пользователя.</li>
</ol>
