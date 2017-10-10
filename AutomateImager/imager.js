var tagged = false;
var tags;
var maxlength = 3;
function requestTags(input){
    jQuery.get("./indexer.php", function(data){
        returnTags(input, JSON.parse(data));
        return(true);
    })
    .fail(function() {
        return(false);
    });
}
function returnTags(input, data){
    tags = data;
    console.log(tags);
    alert("done");
    recommend(input);
}
function strip(html){
    html = html.toUpperCase();
    var tmp = document.createElement("DIV");
    tmp.innerHTML = html;
    return tmp.textContent || tmp.innerText || "";
}
function queryImg(input){
    input = strip(input);
    if(!tagged){
        tagged = requestTags(input);
    }else{
        recommend(input);
    }
}
function processtags(){
    var cleantags = [];
    for(var element in tags) {
        cleantags.push(element.toUpperCase());
        for(var subelement in tags[element]) {
            cleantags.push(tags[element][subelement].toUpperCase());
        }
    }
    console.log(cleantags);
    return cleantags;
}
function recommend(input){
    var searchterms = tokeineyes(input);
    var stags = processtags();
    var hits = [];
    var thits = [];
    for(var searchj = 0; searchj < stags.length; searchj++){                            //try out each tag set
        thits = [];
        for(var searchn = 1; searchn < searchterms.length; searchn++){              // iterate lengths from 0 to maxlength
            for(var searchi = 0; searchi < searchterms[searchn].length; searchi++){                  //select search terms of that length
                var dist = 999;
                slength = Math.max(searchterms[searchn][searchi].length, stags[searchj].length);
                dist = levDist(stags[searchj], searchterms[searchn][searchi]) / slength;
                dist = Math.pow(dist, 2);
                if (dist < 0.25){
                    console.log(stags[searchj]+", "+searchterms[searchn][searchi]+"  - "+(dist * 100)+"%");
                }
                thits.push(dist);
            }
        }
        thits = thits.sort();
        console.log(thits);
        var sum = 0;
        for( var i = 0; i < 10; i++ ){
            sum += thits[i]; //don't forget to add the base
        }

        var avg = sum/thits.length;
        hits[stags[searchj]]=avg;
    }
    hits= hits.sort();
    console.log(hits);
}
function tokeineyes(input){
    mxlength = maxlength + 1;
    var words = [];
    input = input.replace(/[.,\/#!$%\^&\*;:{}=\-_`~()\?\"\r]/g,"");
    input = input.replace(/[\n]/g," ");
    input.trim();
    inputwords = input.split(" ");
    if( mxlength > inputwords.length){
        mxlength = inputwords.length;
    }
    var tmp=[];
    for (var iii = 0; iii < inputwords.length; iii++) {
        if(inputwords[iii].length > 3){
            tmp.push(inputwords[iii]);
        }
    }
    inputwords = tmp;
    console.log(inputwords);
    for(var jj = 1; jj < mxlength; jj++ ){
        tmp=[];
        for (var ii = 0; ii <= (inputwords.length - jj); ii++) {
            var compoundword = "";
            for(var kk = 0; kk < jj; kk++){    
                compoundword = compoundword+" "+inputwords[ii+kk];  
            }
            compoundword = compoundword.trim()
            if(compoundword.length > 3){
                tmp.push(compoundword);
                //jQuery("#outarea").append("<br>"+compoundword);
            }
        }
        words[jj] = tmp;
    }
    console.log(words);
    return(words);
}
function levDist(s, t) {
    var d = []; //2d matrix

    // Step 1
    var n = s.length;
    var m = t.length;

    if (n == 0) return m;
    if (m == 0) return n;

    //Create an array of arrays in javascript (a descending loop is quicker)
    for (var i = n; i >= 0; i--) d[i] = [];

    // Step 2
    for (var i = n; i >= 0; i--) d[i][0] = i;
    for (var j = m; j >= 0; j--) d[0][j] = j;

    // Step 3
    for (var i = 1; i <= n; i++) {
        var s_i = s.charAt(i - 1);

        // Step 4
        for (var j = 1; j <= m; j++) {

            //Check the jagged ld total so far
            if (i == j && d[i][j] > 4) return n;

            var t_j = t.charAt(j - 1);
            var cost = (s_i == t_j) ? 0 : 1; // Step 5

            //Calculate the minimum
            var mi = d[i - 1][j] + 1;
            var b = d[i][j - 1] + 1;
            var c = d[i - 1][j - 1] + cost;

            if (b < mi) mi = b;
            if (c < mi) mi = c;

            d[i][j] = mi; // Step 6

            //Damerau transposition
            if (i > 1 && j > 1 && s_i == t.charAt(j - 2) && s.charAt(i - 2) == t_j) {
                d[i][j] = Math.min(d[i][j], d[i - 2][j - 2] + cost);
            }
        }
    }

    // Step 7
    return d[n][m];
}