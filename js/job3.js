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

$('#result').html(result);
