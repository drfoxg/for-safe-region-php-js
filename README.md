# Шифровочка
Тестовое задание
## Установка
Корневой каталог приложения указан в index.php и .htaccess.
По умолчанию он задан в константе APP_DIR как crossword.
То есть index.php и все остальные каталоги должны быть скопированы на web-сервер в <имя домена>/crossword.
Чтобы развернуть приложение в каталоге под другим именем нужно заменить crossword на нужный в файлах index.php и .htaccess.
Большая глубина каталогов не поддерживается.
## Работа приложения
Переходим по адресу <имя домена>/crossword/.
Прокручиваем страницу до конца и нажимаем ссылку **Решение** под описанием **Задание 4 (Шифровочка)**.
Поле ввода "Маска" подсвечено красным и ожидает обязательного ввода правильной маски для помощи в поиске слова.
Если маска корректна, то цвет меняется на зеленый.
Пример правильной маски указан внутри поля ввода - "пример: то--р, л2в62"

Подбираемые значения в блок "Кроссворд" можно вносить двумя способами:
1. Кликнуть левой кнопкой мыши в нужную цифру в блоке и ввести с клавиатуры букву, далее кликнуть в свободное место рядом с блоками;
2. Кликнуть в нужную цифру в блоке и далее кликнуть на нужную букву в блоке "Шифр".

В ходе решения кроссворда буквы для блока "Ключевое слово" вводятся описанным выше способом.

По условию задания в клетках с цифрой 6 может не быть буквы вообще, поэтому ввод числа 0 меняет ее цвет на серый.
Назначить серый цвет можно также только кликая левой кнопкой мыши последовательно в клетку блока "Кроссворд" и далее в серую клетку блока "Шифр".
Если серый цвет назначен по ошибке, квадрат можно вернуть к начальному цветовому состоянию введя в него 6.
Можно сразу указать нужную букву, кликнув на нем и далее на букву в блоке "Шифр".

## Пример алгоритма решения
В левом столбце имеем шифр 11534.
Значит в начале слова у нас могут быть комбинации АВ, ВА, ГА, и АГ, так как подряд две согласные маловероятны.
Все равно попробуем подобрать слово на ГВ, вводим ГВ534, нажимаем "Найти".
Видим результат:
```
Нет совпадений по шифру.
Пожалуйста, измените маску.
Все возможные слова для маски: ГВ---

ГВИДО ГВЕРУ ГВАЛТ ГВИНТ

Показано 4 из 4
```
То есть существует всего 4 слова из пяти букв на ГВ и ни одно из них не подходит под наш шифр на конце 5 - Т, У или Щ, 3 - Л, Н или О, 4 - П, Р или С.
Пробуем АВ534.
Видим результат:
```
АВТОР

Показано 1 из 66
```
То есть существует 66 слова из пяти букв на АВ и нам подходит единственный вариант АВТОР.
Вносим его в блок "Кроссворд".
У нас появилась буква для блока "Ключевое слово" - О, вносим ее в любую клетку сиреневого цвета.
Предположим, что у крайнего правого столбца в квадратах 6 есть буквы.
Слово не может начинаться на Ь, поэтому это будет Я.
Пробуем найти слово, начинающееся на Я и заканчивающееся на Я, вводим маску я123я.
Видим результат:
```
Нет совпадений по шифру.
Пожалуйста, измените маску.
Все возможные слова для маски: Я---Я

ЯХНИЯ

Показано 1 из 1
```
Меняем маску на я123ь. Получаем единственный вариант ЯГЕЛЬ.
Таким образом можно решить весь кроссворд и открыть буквы для ключевого слова.
Переставляя для Маски буквы ключевого слова подобрать само слово.

