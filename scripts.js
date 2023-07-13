// Получаем логин в перменную
var element = document.querySelector(".user-login");
var login = element.textContent;

//Для поиска по логину
function searchUser(event) {
  event.preventDefault(); // отменяем стандартное поведение формы

  // получаем значение из поля ввода
  var searchValue = document.getElementById("search-input").value;

  // отправляем AJAX-запрос на сервер
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "search.php");
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (xhr.status === 200) {
      // обновляем список пользователей
      document.getElementById("user-list").innerHTML = xhr.responseText;
    } else {
      console.log("Ошибка запроса: " + xhr.status);
    }
  };
  xhr.send("searchValue=" + searchValue);
}

// Кнопка чтобы сбросить форму и вернуться в начало
var resetButton = document.getElementById("reset-button");
resetButton.addEventListener("click", function () {
  location.reload();
});

var msgCountHeader = document.getElementById("msg-count-header");
msgCountHeader.addEventListener("click", function () {
  var arrow = this.querySelector(".sort-icon");
  var isAscending = arrow.classList.contains("asc");
  arrow.classList.toggle("asc");
  sortUserList(isAscending ? "desc" : "asc");
});

// Функция сортировки списка пользователей
function sortUserList(order) {
  var userList = document.getElementById("user-list");
  var rows = Array.from(userList.querySelectorAll("tr"));
  rows.sort(function (row1, row2) {
    var count1 = parseInt(row1.querySelector("td:nth-child(2)").textContent);
    var count2 = parseInt(row2.querySelector("td:nth-child(2)").textContent);
    if (order === "asc") {
      return count1 - count2;
    } else {
      return count2 - count1;
    }
  });
  rows.forEach(function (row) {
    userList.appendChild(row);
  });

  // Изменяем направление стрелки второго столбца
  var msgCountHeader = document.getElementById("msg-count-header");
  var sortIcons = msgCountHeader.querySelectorAll(".sort-icon");
  sortIcons[1].innerHTML = order === "asc" ? "&#9650;" : "&#9660;";
}

// Получаем список строк таблицы пользователей
const userRows = document.querySelectorAll(".user-row");

// Получаем элементы <div> для отображения сообщений пользователя user-popup
const popup = document.querySelector("#user-popup");

// Находим элемент заголовка и задаем ему текст с логином пользователя
const header = popup.querySelector(".modal-header h2");

// Получаем элемент <div>, в котором будут отображаться сообщения пользователя
const messagesContainer = document.querySelector("#user-messages");

// Получаем кнопку "Закрыть" внутри элемента <div>
const closeButton = document.querySelector("#close-button");

// Добавляем обработчик клика на каждую строку таблицы пользователей
userRows.forEach((row) => {
  const loginCell = row.querySelector(".user-login");
  const userId = row.getAttribute("data-id");

  loginCell.addEventListener("click", async () => {
    // Выполняем запрос к базе данных для получения сообщений пользователя
    const response = await fetch(`get_user_messages.php?id=${userId}`);
    const messages = await response.text();

    // Получаем имя пользователя из ячейки таблицы
    const username = loginCell.textContent.trim();

    // Задаем имя пользователя в заголовке модального окна
    header.textContent = "Сообщения пользователя " + username;

    // Отображаем сообщения пользователя в элементе <div>
    messagesContainer.innerHTML = messages;

    // Отображаем всплывающее окно
    popup.style.display = "block";
  });
});

// Добавляем обработчик клика на кнопку "Закрыть"
closeButton.addEventListener("click", () => {
  // Скрываем всплывающее окно
  popup.style.display = "none";
});
