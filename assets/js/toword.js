const num2text = {
  ones: ['', 'ONE', 'TWO', 'THREE', 'FOUR', 'FIVE', 'SIX', 'SEVEN', 'EIGHT', 'NINE', 'TEN', 'ELEVEN', 'TWELVE', 'THIRTEEN', 'FOURTEEN', 'FIFTEEN', 'SIXTEEN', 'SEVENTEEN', 'EIGHTEEN', 'NINETEEN'],
  tens: ['', '', 'TWENTY', 'THIRTY', 'FOURTH', 'FIFTY', 'SIXTY', 'SEVENTY', 'EIGHTY', 'NINETY'],
  sep: ['', ' THOUSAND ', ' MILLION ', ' BILLION ', ' TRILLION ', ' QUADRILLION ', ' QUINTILLION ', ' SEXTILLION ']
};
const convert = function(val) {
  if (val.length === 0) {
    return '';
  }

  val = val.replace(/,/g, '');
  if (isNaN(val)) {
    return 'Invalid input.';
  }

   
  let digit = val.slice(val.length - 3); //json
  let [val1, val2] = val.split(".")
  let str2 = "";
  let php="";
  if (val2 != null && val2 != '') {
    //convert the decimals here
    var digits = (val2+"0").slice(0,2).split("");
    if(digit =='.00')
    {
     str2='';
     php = ' Pesos'; 
    }
    else
    {
    str2 = num2text.tens[+digits[0]] + " " + num2text.ones[+digits[1]] 
    }

  }
  let arr = [];
  while (val1) {
    arr.push(val1 % 1000);
    val1 = parseInt(val1 / 1000, 10);
  }
  let i = 0;
  let str = "";
  while (arr.length) {
    str = (function(a) {
      var x = Math.floor(a / 100),
        y = Math.floor(a / 10) % 10,
        z = a % 10;

      return (x > 0 ? num2text.ones[x] + ' HUNDRED ' : '') +
        (y >= 2 ? num2text.tens[y] + ' ' + num2text.ones[z] : num2text.ones[10 * y + z]);
    })(arr.shift()) + num2text.sep[i++] + str;
  }


   // return str +php+
   //  (str2 ? ' AND ' + str2 + ' Cents' : '');
   var final_str = str +php+
    (str2 ? ' AND ' + str2 + ' Cents' : '');
   
   var splitStr = final_str.toLowerCase().split(' ');
   for (var n = 0; n < splitStr.length; n++) {
       splitStr[n] = splitStr[n].charAt(0).toUpperCase() + splitStr[n].substring(1);     
   }
   return splitStr.join(' '); 


};


// window.addEventListener("load", function() {
//   document.getElementById("totalamountpaid").addEventListener("input", function() {
//     document.getElementById("words").innerHTML = convert(this.value)
//   });
// });