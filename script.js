// Проверяем, есть ли уже куки
if (document.cookie.indexOf("popup=accepted") === -1) {
// Показываем попап
    document.getElementById("popup").style.display = "block";
}

// Обработчик кнопки Принять
document.getElementById("accept-btn").addEventListener("click", function() {
// Записываем куки на 1 день
    var now = new Date();
    now.setTime(now.getTime() + 24 * 60 * 60 * 1000);
    document.cookie = "popup=accepted; expires=" + now.toUTCString();

// Скрываем попап
    document.getElementById("popup").style.display = "none";
});

// Обработчик кнопки Закрыть
document.getElementById("close-btn").addEventListener("click", function() {
// Показываем попап при обновлении страницы
    document.cookie = "popup=closed";

// Скрываем попап
    document.getElementById("popup").style.display = "none";
});