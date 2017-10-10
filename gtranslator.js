fuzzyLang = FuzzySet();  
function strip(html)
{
   var tmp = document.createElement("DIV");
   tmp.innerHTML = html;
   return tmp.textContent || tmp.innerText || "";
}
function translateSaveHtml(language, html, source, colour){
    //console.log(html);
    var logmessage ="";
    var translatedcontent = "";
    var startIndices = [];
    var endIndices = [];
    for(var i=0; i<html.length;i++) {
        if (html[i] === "<") startIndices.push(i);
        if (html[i] === ">") endIndices.push(i+1);
    }
    //console.log("< found "+startIndices.length+" times. > found "+ endIndices.length+ " times.");
    if(startIndices.length > 0){
        for(k in startIndices){
            //console.log("Element #"+k + " - " + startIndices[k] + " to " + endIndices[k] +" is "+html.substring(startIndices[k],endIndices[k]));
            translatedcontent = translatedcontent + html.substring(startIndices[k],endIndices[k]);
            if((startIndices[parseFloat(k)+1] - endIndices[k])>1){
                
                //console.log("Text #"+k + " - " + endIndices[k] + " to " + startIndices[parseFloat(k)+1] +" is " + html.substring(endIndices[k], startIndices[k+1]));
                translatedcontent = translatedcontent + getLangs(language, html.substring(endIndices[k],startIndices[parseFloat(k)+1]) );
                logmessage = (translatedcontent+' - '+source);
            }
            //console.log(html.substring(startIndices[k],endIndices[k]));
        }
    }else{
        translatedcontent = getLangs(language, html);
        logmessage = (translatedcontent+' - '+source);
        //FORMAT FOR STYLING CONSOLE LOGS
        //console.log('%c Oh my heavens! ', 'background: #222; color: #bada55');
        //console.log("%c%s%c = %c%s","background:orange", "Array[index0]", "background:inherit;", "background:yellow;font-style: italic;", "google.com")
        //https://developers.google.com/web/tools/chrome-devtools/console/console-write#string_substitution_and_formatting
    }
    var styles = [
        'color: '+colour
        , 'font-weight: bold'
    ].join(';');
    console.log ('%c'+logmessage, styles)
    return translatedcontent;
}
function getLangs(inLang, inHtml){
    try{
    inHtml = strip(inHtml);
    var translationHolder="";
    inLang = inLang.trim();
    jQuery("#outputTarget").html("");
    var transtypes;
        transtypes = {"Afrikaans": "af",
"Albanian": "sq",
"Arabic": "ar",
"Azerbaijani": "az",
"Basque": "eu",
"Bengali": "bn",
"Belarusian": "be",
"Bulgarian": "bg",
"Catalan": "ca",
"Chinese Simplified": "zh-CN",
"Chinese Traditional": "zh-TW",
"Croatian": "hr",
"Czech": "cs",
"Danish": "da",
"Dutch": "nl",
"English": "en",
"Esperanto": "eo",
"Estonian": "et",
"Filipino": "tl",
"Finnish": "fi",
"French": "fr",
"Galician": "gl",
"Georgian": "ka",
"German": "de",
"Greek": "el",
"Gujarati": "gu",
"Haitian Creole": "ht",
"Hebrew": "iw",
"Hindi": "hi",
"Hungarian": "hu",
"Icelandic": "is",
"Indonesian": "id",
"Irish": "ga",
"Italian": "it",
"Japanese": "ja",
"Kannada": "kn",
"Korean": "ko",
"Latin": "la",
"Latvian": "lv",
"Lithuanian": "lt",
"Macedonian": "mk",
"Malay": "ms",
"Maltese": "mt",
"Norwegian": "no",
"Persian": "fa",
"Polish": "pl",
"Portuguese": "pt",
"Romanian": "ro",
"Russian": "ru",
"Serbian": "sr",
"Slovak": "sk",
"Slovenian": "sl",
"Spanish": "es",
"Swahili": "sw",
"Swedish": "sv",
"Tamil": "ta",
"Telugu": "te",
"Thai": "th",
"Turkish": "tr",
"Ukrainian": "uk",
"Urdu": "ur",
"Vietnamese": "vi",
"Welsh": "cy",
"Yiddish": "yi"};
        x = [];
        for (i in transtypes) {
                fuzzyLang.add(i.toUpperCase());
        }
        var langarray = fuzzyLang.get(inLang);
          for (var key in transtypes) {
            if (transtypes.hasOwnProperty(key) && langarray[0][1] == key.toUpperCase() ){
                var match = key;    
            }
        }        
        var certainty = (langarray[0][0]*100)+"%";
        var translationType = transtypes[match];        
        var contHolder = "";
         var maxtlength = 1000;
         if(inHtml.length > maxtlength){
             for(transI = 0; transI<(inHtml.length/maxtlength); transI++){
                 var url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl="+translationType+"&tl=en&dt=t&q=" + encodeURIComponent(inHtml.substring(transI*maxtlength,(transI+1)*maxtlength));
                trans = (httpGet(url));
                trans = trans.split(",,").join('');
                trans = trans.substr(2,(trans.length-8))
                var transH = trans.split("],[");
                trans = "";
                for (j in transH) {
                    if(j != (transH.length -1)){
                        transH[j] = transH[j] +"]";
                    }
                    if (j != 0){
                        transH[j] = "["+ transH[j] ;
                    }
                    trans = trans + JSON.parse(transH[j])[0];
                } 
                 translationHolder = translationHolder + trans;//[0];
             }
         }else{
            var url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl="+translationType+"&tl=en&dt=t&q=" + encodeURIComponent(inHtml);
                           trans = (httpGet(url));
                trans = trans.split("null").join('');
                trans = trans.split(",,").join('');
                trans = trans.substr(2,(trans.length-8))
                //console.log("translation: "+trans);
                trans = trans.split("]]").join(']');
                var transH = trans.split("],[");
                trans = "";
                for (j in transH) {
                    if(j != (transH.length -1)){
                        transH[j] = transH[j] +"]";
                    }
                    if (j != 0){
                        transH[j] = "["+ transH[j] ;
                    }
                    console.log(transH[j]);
                    trans = trans + JSON.parse(transH[j])[0];
                } 
                translationHolder = translationHolder + trans; 
             }
        translationHolder = translationHolder.split('"').join("&quot;");
        translationHolder = translationHolder.split("'").join("&#39;");
        return translationHolder;
    }catch(err) {
        return err.message;
    }
    }
function httpGet(theUrl)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
    xmlHttp.send( null );
    return xmlHttp.responseText;
}
