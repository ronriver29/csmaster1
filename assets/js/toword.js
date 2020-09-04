// var a = ['','One ','Two ','Three ','Four ', 'Five ','Six ','Seven ','Eight ','Nine ','Ten ','Eleven ','Twelve ','Thirteen ','Fourteen ','Fifteen ','Sixteen ','Seventeen ','Eighteen ','Nineteen '];
// var b = ['', '', 'Twenty','Thirty','Forty','Fifty', 'Sixty','Seventy','Eighty','Ninety'];

// function toWords (num) {
//     if ((num = num.toString()).length > 9) return 'overflow';
//     n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
//     if (!n) return; var str = '';
//     str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'Billion ' : '';
//     str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'Million ' : '';
//     str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'Thousand ' : '';
//     str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'Hundred ' : '';
//     str += (n[5] != 0) ? ((str != '') ? '' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + ' ' : '';
//     return str;
// }
//  


// var th = ['', 'thousand', 'million', 'billion', 'trillion'];

// var dg = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
// var tn = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
// var tw = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
// function toWords(s) {
//     s = s.toString();
//     s = s.replace(/[\, ]/g, '');
//     if (s != parseFloat(s)) return 'not a number';
//     var x = s.indexOf('.');
//     if (x == -1) x = s.length;
//     if (x > 15) return 'too big';
//     var n = s.split('');
//     var str = '';
//     var sk = 0;
//     for (var i = 0; i < x; i++) {
//         if ((x - i) % 3 == 2) {
//             if (n[i] == '1') {
//                 str += tn[Number(n[i + 1])] + ' ';
//                 i++;
//                 sk = 1;
//             } else if (n[i] != 0) {
//                 str += tw[n[i] - 2] + ' ';
//                 sk = 1;
//             }
//         } else if (n[i] != 0) {
//             str += dg[n[i]] + ' ';
//             if ((x - i) % 3 == 0) str += 'hundred ';
//             sk = 1;
//         }
//         if ((x - i) % 3 == 1) {
//             if (sk) str += th[(x - i - 1) / 3] + ' ';
//             sk = 0;
//         }
//     }
//     if (x != s.length) {
//         var y = s.length;
//         str += 'point ';
//         for (var i = x + 1; i < y; i++) str += dg[n[i]] + ' ';
//     }
//     return str.replace(/\s+/g, ' ');
// }

function convert_to_word(num, ignore_ten_plus_check) {

    var ones = [];
    var tens = [];
    var ten_plus = [];
    ones["1"] = "one";
    ones["2"] = "two";
    ones["3"] = "three";
    ones["4"] = "four";
    ones["5"] = "five";
    ones["6"] = "six";
    ones["7"] = "seven";
    ones["8"] = "eight";
    ones["9"] = "nine";

    ten_plus["10"] = "ten";
    ten_plus["11"] = "eleven";
    ten_plus["12"] = "twelve";
    ten_plus["13"] = "thirteen";
    ten_plus["14"] = "fourteen";
    ten_plus["15"] = "fifteen";
    ten_plus["16"] = "sixteen";
    ten_plus["17"] = "seventeen";
    ten_plus["18"] = "eighteen";
    ten_plus["19"] = "nineteen";

    tens["1"] = "ten";
    tens["2"] = "twenty";
    tens["3"] = "thirty";
    tens["4"] = "fourty";
    tens["5"] = "fifty";
    tens["6"] = "sixty";
    tens["7"] = "seventy";
    tens["8"] = "eighty";
    tens["9"] = "ninety";   

    var len = num.length;
    
    if(ignore_ten_plus_check != true && len >= 2) {
        var ten_pos = num.slice(len - 2, len - 1);
        if(ten_pos == "1") {
            return ten_plus[num.slice(len - 2, len)];
        } else if(ten_pos != 0) {
            var one_ = ones[num.slice(len - 1, len)];
                var ten_ = tens[num.slice(len - 2, len - 1)]
                return  (ten_ != undefined ? ten_ : "") + " " + (one_ != undefined ? one_ : "");
        }
    }
    
    return ones[num.toString().slice(len - 1, len)];
    
}

function get_rupees_in_words(str, recursive_call_count) {
  if(recursive_call_count > 1) {
        return "conversion is not feasible";
    }
    var len = str.length;
    var ten_plus = convert_to_word(str, false);
        var words = ten_plus != undefined ?  ten_plus : "";
        if ((len == 2 || len == 1)  && ten_plus != undefined) {
            if (recursive_call_count == 0) {
                words = words + " rupees";
            }
            return words;
        }
        if (recursive_call_count == 0) {
            if(ten_plus != undefined) {
                words = " and " + words + " rupees";
            } else {
                words = words + " rupees";
            }
        }
    
    var hundred = convert_to_word((str+'').slice(0, len-2), true);
  words = hundred != undefined ? hundred + " hundred " + words : words;
    if(len == 3) {
        return words;
    }
    
    var thousand = convert_to_word((str+'').slice(0, len-3), false);
    words = thousand != undefined ? thousand  + " thousand " + words : words;
    if(len <= 5) {
        return words;
    }
    
    var lakh = convert_to_word((str+'').slice(0, len-5), false);
    words =  lakh != undefined ? lakh + " lakh " + words : words;
    if(len <= 7) {
        return words;
    }
    
    recursive_call_count = recursive_call_count + 1;
    return get_rupees_in_words((str+'').slice(0, len-7), recursive_call_count) + " crore " + words;
}