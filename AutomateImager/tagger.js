function getTags(content){
        content = strip(content);
        contentWords = content.split(" ");
        var articletags = [];
        var tagquality = [];
        var lasttag = [];
        var multiwords = [];
        var maxlength = 3;
        for(wordcount = 2; wordcount <= maxlength; wordcount++){
            $.each(contentWords, function( tagWordIndex, tagWord ) {
                var wordholder = contentWords[tagWordIndex];
                for(iword = 1; iword < wordcount; iword++){
                    wordholder = wordholder +" "+ contentWords[tagWordIndex + iword];
                }
                if(wordholder.trim() != ""){
                    multiwords.push(wordholder);
                }
            }); 
        }
        contentWords = contentWords.concat(multiwords);
        $.each(contentWords, function( tagWordIndex, tagWord ) {
            var output = doFuzzySearch(tagWord); 
            if(output && output[0]){
                lengthmult = tagWord.length;                                            //Favor longer tags
                if(lengthmult > 10){
                    lengthmult = 10;
                }
                if(output[0][0] > (1-(lengthmult/100))){
                    if(articletags.includes(output[0][1])){
                        tagindex = articletags.indexOf(output[0][1]);
                        spacing = Math.pow((tagWordIndex - lasttag[tagindex]), 2) / 100;
                        if(spacing > 100){                                                      //Favor tags that are spread apart by some distance
                            spacing = 100;
                        }
                        spacing = spacing + (lengthmult * 5);
                        spacing = (spacing/250);
                        tagquality[tagindex] = tagquality[tagindex] * (output[0][0] + (lengthmult/100)) * 1+(spacing);
                        lasttag[tagindex] = tagWordIndex;
                    }else{
                        articletags.push(output[0][1]);
                        tagquality.push(output[0][0]);
                        lasttag.push(tagWordIndex);
                    }
                }
            }
        }); 
    readyOutputtags = sortarrays(articletags, tagquality);
    console.log(readyOutputtags);
    return(readyOutputtags);
}
function getTagArray(){
    var tmp = document.createElement("DIV");
    tmp.innerHTML = window['alltags'];
    thtags =  tmp.textContent || tmp.innerText || "";
    thetags = JSON.parse(thtags);
    makeFuzzySearch();
}
function makeFuzzySearch(){
    fuzzytags = FuzzySet(); 
    $.each(thetags, function( tagIndex, tag ) {
        fuzzytags.add(tag.substr(0,1).toUpperCase()+tag.substr(1).toLowerCase()); 
    });        
}
function doFuzzySearch(tag){
    return fuzzytags.get(tag.substr(0,1).toUpperCase()+tag.substr(1).toLowerCase());
}
function sortarrays(tags, quality, outTags = "", tagCount = 0){
    if(tagCount == 0 ){
        var outTags = [];
    }
    tagCount++;
    //console.log(outTags);
    goodTag = quality.indexOf(Math.max.apply( Math, quality ));
    outTags.push(tags[goodTag]);
    quality.splice(goodTag, 1);
    tags.splice(goodTag, 1);
    if(tagCount < 5){
        return sortarrays(tags, quality, outTags, tagCount);
    }else{
         //$.each(outTags, function( tagcheckindex, tagcheckword ) {
         //    $.each(outTags, function( checktagindex, checktagword ) {
        //         tagcheck = tagcheckword.split(" ").indexOf(checktagword);
        //         if(tagcheck >= 0 && checktagindex != tagcheckindex){
        //            console.log(outTags.splice(checktagindex, 1));
        //            tagCount--;
        //            return sortarrays(tags, quality, outTags, tagCount);
         //        }
         //    });
       //  });
        return outTags.join(", ");
    }
}
function strip(html)
{
   var tmp = document.createElement("DIV");
   tmp.innerHTML = html;
   return tmp.textContent || tmp.innerText || "";
}