<?php 
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta name="robots" content="noindex,nofollow"/>
<title>FAAP 0.9</title>
<link rel="shortcut icon" href="images/icon.ico" />
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.js"></script>
    </head>
    <script src="./fuzzyset.js"></script>
    <!--<script src="./gtranslator.js"></script>-->
    <script type="text/javascript">var x = [];
var y = [];
var z = [];
fuzzyLang = FuzzySet();  
//Rus lang detect test text: Сука Блять


function getLangs(inLang, inHtml){
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
    console.log(z);
        var langarray = fuzzyLang.get(inLang);
          for (var key in transtypes) {
            if (transtypes.hasOwnProperty(key) && langarray[0][1] == key.toUpperCase() ){
                console.log(key);
                var match = key;    
            }
        }        
        var certainty = (langarray[0][0]*100)+"%";
        var translationType = transtypes[match];
        console.log(langarray[0][1]);
        console.log("translation type code: "+translationType);
        jQuery("#outputTarget").append("User entered: &quot;"+inLang+"&quot;<br/>System matched: "+match+"<br/> with certainty: "+certainty+"<br/>");
        jQuery("#outputTarget").append("<hr/>Using translation code: "+translationType+"<br/>"+match+' to English translation: <hr/>');
        var url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl="+translationType+"&tl=en&dt=t&q=" + encodeURIComponent(inHtml);
        console.log("thread: "+ url);
        trans = (httpGet(url));
        trans = trans.split(",,").join("");
        trans = trans.substr(2,(trans.length-8))
        console.log("translation: "+trans);
        trans = JSON.parse(trans);
        //trans = JSON.parse(UrlFetchApp.fetch(url).getContentText());
        //jQuery("#outputTarget").append(trans[0]);
        return trans[0];
//*/
}
function httpGet(theUrl)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
    xmlHttp.send( null );
    return xmlHttp.responseText;
}</script>
    <p>Language:</p>
    <input id="inputLang" type="text" value="German"/>
    <p>Input:</p>
    <textarea id="inputText"></textarea><br/>
    <button onclick="javascript:getLangs(document.getElementById('inputLang').value,document.getElementById('inputText').value);">-- Go --</button>
    <hr/>
    <div id="outputTarget"></div>

    
</html>