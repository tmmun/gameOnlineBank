let bankList = []
let users = []

let myName = '';
let myBank = 0
let myKey = ''

//createTab('') // создать таблицу ('указать название')

//getHash('') // получить хэш ('указать пароль')

$("#log").click(function () { //логин
    log()
})

$("#update").click(function () {
    upd()
    getTransactions()
    $('.sum').val('')
})

$("#reload").click(function () {
    getTransactions()
});


//help function

function createTab(nam) {
    var tableName = nam; //заголовок таблицы
    var columnName1 = 'title';  // первый столбец
    var columnName2 = 'sum'; //вторйо столбец

    $.ajax({
        url: 'createTab.php',
        method: 'POST',
        data: {
            table_name: tableName,
            column_name_1: columnName1,
            column_name_2: columnName2
        },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                console.log('Таблица успешно создана');
            } else {
                console.log('Ошибка при создании таблицы');
            }
        },
        error: function () {
            console.log('Ошибка при выполнении AJAX-запроса');
        }
    });
}

function getHash(titl) {

    $.ajax({
        url: "getHash.php",
        method: "POST",
        data: {
            title: titl
        },
        success: function (response) {
            // Обработка успешного ответа от сервера
            console.log(response);
        },
        error: function (xhr, status, error) {
            // Обработка ошибок
            console.log(xhr.responseText);
        }
    });
}

//base function

function getTransactions() { // вывод транзакций

    let mNam = $('.name').val() // получаем мое имя, что бы далее найти таблицу с моими транзакциями

    $.ajax({
        url: 'get_tran.php',
        method: 'POST',
        data: { table_name: mNam },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                // Преобразование полученных данных в массив
                var dataArray = response.data.map(function (row) {
                    return Object.values(row);
                });

                // Отображение данных

                let his = ''

                for (let i = 0; i < dataArray.length; i++) {
                    // $('#hisCont').append('<div id="hisText" >' + dataArray[i] + '</div>')
                    let sli = dataArray[i].slice(1) //режим первое значение масива
                    let rep = sli.join() //собираем в строку
                    rep = rep.replace(/,/g, '       ') //меняем запятую на пробел
                    his += rep + '\n' //добавляем в масив с переносом строки
                }


                $('#hisCont').text(his)

            } else {
                console.log('Ошибка при получении данных');
            }
        },
        error: function () {
            console.log('Ошибка при выполнении AJAX-запроса');
        }
    });

}

function upd() { // пеервод денег

    let content = $('.sum').val() // получаем сумму
    let hisname = $('.namBank').val() // получаем его имя
    let myname = myName // мое имя
    let var5 = myKey // ключь

    // проверка - есть ли пользователь в таблице аккаунт в нашей бд

    if (users.indexOf(hisname) != -1 && content > 0) { // поиск имени в масиве users, в него мы записываем в getInfo
        $.ajax({
            url: "upd.php",
            method: "POST",
            data: { // отправляем переменные в php
                hisname: hisname,
                content: content,
                myname: myname,
                key: var5
            },
            success: function (response) { // ответ, после выполнения php

                let result = response.match(/Ошибка/) // ищем в ответе слова Ошибка

                if (result) {  // Обработка ошибки от сервера

                    $('.myNam').text('Ошибка')
                }
                else { // Обработка успешного ответа от сервера

                    $('.myNam').text(myName)
                    $('.hisNam').text(hisname)
                    $('.myBank').text(response)
                    getTransactions()
                }

            },
            error: function (xhr, status, error) {
                // Обработка ошибок
                console.log(xhr.responseText);
            }
        });
    }
    else { // условие, если мы не нашли имя
        $('.myNam').text('нет такого')
    }



}

function log() { // логин

    let mNam = $('.name').val() // получаем имя
    let mKey = $('.key').val() // получаем ключь

    $.ajax({ // отправляем в php
        url: "log.php",
        method: "POST",
        data: {
            title: mNam,
            mykey: mKey
        },
        success: function (response) { // ответ, после завершения работы Php

            // Обработка успешного ответа от сервера
            if (response == 'Ошибка') { // если ответ имеет слова Ошибка
                $('.myNam').text('Ошибка')
            }
            else { // если все нормально

                let info = response.split('|') // режим ответ
                $('.myNam').text(info[0]) // выводим мое имя
                $('.myBank').text(info[1]) // выводим мое банк
                myName = info[0] // записываем мое имя
                myBank = info[1] // записываем мое банк
                myKey = $('.key').val() // записываем ключь
                getInfo(info[2]) // отправляем имя таблицы
                getTransactions() // выводим транзакции
                $('.logCont').hide() // скрывам логин панель
            }

        },
        error: function (xhr, status, error) {
            // Обработка ошибок
            console.log(xhr.responseText);
        }
    });
}

function getInfo(nam) { // вывод пользователей

    let rep = '' // переменная в которой мы соберем столбик из имен пользователей

    $.ajax({
        url: 'get_tran.php',
        method: 'POST',
        data: { table_name: nam },
        dataType: 'json',
        success: function (response) {
            for (let i = 0; i < response.data.length; i++) {
                users.push(response.data[i].title) // добавляем в масив users, что бы upd делать проверку на соотвествие имени
                rep += response.data[i].title + '\n'//собираем в столбик
            }

            $('#usersCont').text(rep) // отображаем список пользователей

        },
        error: function () {
            console.log('Ошибка при выполнении AJAX-запроса');
        }
    });

}

