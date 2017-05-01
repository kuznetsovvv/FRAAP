var x = [];
var y = [];
var z = [];
fuzzyLang = FuzzySet();  
//Rus lang detect test text: Сука Блять


function getLangs(inLang, inHtml){
    inLang = inLang.trim();
    jQuery("#outputTarget").html("");
    var transtypes;
    jQuery.get("https://translate.yandex.net/api/v1.5/tr.json/getLangs?key=trnsl.1.1.20170302T195115Z.a00729c0c0d5c64a.9719b8bb823e2f730f5379352357ba168175e1c7&ui=en",function(json){
        transtypes = json;
        x = [];
        for (i in transtypes.dirs) {
            if(transtypes.dirs[i].includes("-en")){
                x.push(transtypes.dirs[i]);
            }
        }
        for (i in x) {
                lang1 = x[i].substring(0,2);
                y[i] = transtypes.langs[lang1];
                z[i] = transtypes.langs[lang1].toUpperCase();
                fuzzyLang.add(z[i]);
        }
        var langarray = fuzzyLang.get(inLang);
        console.log(langarray[0]);
        var certainty = (langarray[0][0]*100)+"%";
        console.log("certainty: "+certainty);
        var translationType = x[z.indexOf(langarray[0][1])];
        console.log(langarray[0][1]);
        var detected = y[z.indexOf(langarray[0][1])];
        console.log("translation type code: "+translationType);
        jQuery("#outputTarget").append("User entered: &quot;"+inLang+"&quot;<br/>System matched: "+detected+"<br/> with certainty: "+certainty+"<br/>");
        jQuery("#outputTarget").append("<hr/>Using translation code: "+translationType+"<br/>"+detected+' to English translation <a href="http://translate.yandex.com/">Powered by Yandex.Translate</a> <hr/>');
            
        jQuery.get("https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20170302T195115Z.a00729c0c0d5c64a.9719b8bb823e2f730f5379352357ba168175e1c7&options=1&format=html&text=" + encodeURIComponent(inHtml) + "&lang="+translationType,function(out){
            trans = out;
            console.log(trans);
            jQuery("#outputTarget").append(trans.text[0]);
            return trans.text[0];
        });
    });
}

