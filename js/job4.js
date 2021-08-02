var lastFocused = null;

function showLoading() {
    $("#loading").show();
}

function hideLoading() {
    $("#loading").hide();
}

$(document).ready(function(){
    $('#search-crossword').on('submit', OnSearchCrossword);
});

function GetMatrixStrings(divs) {
    var a = [];

    for (var i = 0; i < divs.length; i++) {
        a.push(divs[ i ].innerHTML);
    }

    return a;
}

function OnSearchCrossword()
{
    console.log("OnSearchCrossword");

    var date = new Date();
    //var crossword = Array.from($('.input-matrix > .btn').text());
    //var keyword = Array.from($('.keyword-matrix > .btn').text());
    var crossword = GetMatrixStrings($('.input-matrix > .btn').toArray());
    var keyword = GetMatrixStrings($('.keyword-matrix > .btn').toArray());

    console.log(keyword);

    CreateCookie("crossword", JSON.stringify(crossword), "10");
    CreateCookie("keyword", JSON.stringify(keyword), "10");
}

function CreateCookie(name, value, days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
}

function OnCipherClick(e){

    var alpha = $(e).text();
    console.log("OnCipherClick: %s", alpha);

    if (alpha.IsAlpha() && lastFocused !== null ) {
        console.log("lastFocused: %s", lastFocused.text());

        if (lastFocused.text() == '0') {
            lastFocused.removeClass('hole');
        }

        lastFocused.text(alpha);
        lastFocused = null;
    }

    if (alpha == '0' && lastFocused !== null ) {
        if (lastFocused.text() == '6') {
            console.log("OnCipherClick(0) lastFocused.text(6): %s", alpha);
            lastFocused.text(alpha);
            lastFocused.addClass('hole');
        }

        lastFocused = null;
    }
}

function OnCrosswordClick(e) {
    lastFocused = $(e);
    lastFocused.on('blur', OnCrosswordBlur);
}

function OnCrosswordBlur(){
    console.log("Blur");

    //var focused = $(e);
    if ($(this).text() == '0') {
        $(this).addClass('hole');
    }

    if ($(this).text() == '6') {
        $(this).removeClass('hole');
    }
}

String.prototype.IsAlpha = function ( ) {
  return /^[А-Я]*$/gi.test(this);
}

//var list_of_word = ['wolf','flow','hello','world','folw','jack','open','close','nepo','peno','kill'];

var list_of_word = ['стол', 'барокко', 'слот', 'кот', 'кошка', 'ток', 'коробка'];

function find(word, dict)
{
    var words = dict[word.toLowerCase().split('').sort().join('')];
    return words;
}

function diff(a1, a2)
{
    return a1.filter(i => a2.indexOf(i) < 0).concat(a2.filter(i => a1.indexOf(i) < 0));
}

function do_anagramm(list) {

    var dict = [];

    list.forEach(function(v)
    {
        var sorted = v.toLowerCase().split('').sort().join('');

        if (!dict[sorted]) {
                dict[sorted] = [v];
            } else {
                dict[sorted].push(v);
            }
    });

    // Подготовка окончена. Сохраняем текущий хеш и используем везде его.

    var words_arr = [];
    var i = 0;

    while (list.length !== 0) {

        var words = find(list[0], dict);

        words_arr[i] = words;

        list = diff(words, list);

        i++;

    }

    var out_arr = [];
    var y = 0;
    words_arr.forEach(function(v) {

        if (v.length > 1) {

            out_arr[y] = [v];
            y++;

            result = result + v + '<br>';

        }

    });

    console.log(out_arr);

    return out_arr;
}

var words_arr = do_anagramm(list_of_word);

var result = '';
words_arr.forEach(function(v) {
    result = result + v + '<br>';
});

// $('#result').html(result);
