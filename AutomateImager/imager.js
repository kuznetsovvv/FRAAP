var tagged = false;
var tags;
var maxlength = 3;

function strip(html){
    html = html.toUpperCase();
    var tmp = document.createElement("DIV");
    tmp.innerHTML = html;
    return tmp.textContent || tmp.innerText || "";
}
function queryImg(input, postid){
    input = strip(input);
    //if(!tagged){
    //    tagged = requestTags(input);
    //}else{
        recommend(input, postid);
   // }
}
function processtags(){
    var cleantags = [];
    /*for(var element in tags) {
        cleantags.push(element.toUpperCase());
			console.log(tags[element]+" ");
        for(var subelement in tags[element]) {
            cleantags.push(tags[element][subelement].toUpperCase());
        }
    }//*/
    cleantags = tags;
    console.log(cleantags);
    return cleantags;
}
function recommend(input, postid){
    var searchterms = tokeineyes(input);
    var stags = JSON.parse(window["alltags"].substr( 40, window["alltags"].length-46));//processtags(); from the php substr($alltags, 40, -6)
    var hits = [];
    var thits = [];
    for(var searchj = 0; searchj < stags.length; searchj++){                            //try out each existing image tag
        //thits[stags[searchj]] = [];																		//Placeholder array for distances
        for(var searchn = 0; searchn < searchterms.length; searchn++){              // iterate afticle n-grams lengths from 0 to maxlength
            for(var searchi = 0; searchi < searchterms[searchn].length; searchi++){                  //select search terms of that length
                var dist = 999;
                slength = Math.max(searchterms[searchn][searchi].length, stags[searchj].length);	//figures out which term is longer
                dist = levDist(stags[searchj].toUpperCase(), searchterms[searchn][searchi]) / slength;			//converts to a fraction error
                dist = Math.pow(dist * 10, 2);														//squares inaccuracies and converts to a percentage score
                //thits.push(dist);//
				if(dist < 5){                                                                       //accuracy cutoff
                    if(typeof(thits[stags[searchj]])!== 'undefined'){
                        if(thits[stags[searchj]] > dist){
					       thits[stags[searchj]] = dist;// = dist;	
                        }
                    }else{
                        thits[stags[searchj]] = dist;
                    }													//Array of closest tag hits
                    //console.log("'"+stags[searchj]+"' vs '"+searchterms[searchn][searchi]+"' dist score: "+dist);	
                    //console.log(thits[stags[searchj]]);	
				}
				/*if(Math.floor(Math.random() * 25000) == 1){
					console.log("first term: '"+stags[searchj].toUpperCase()+"' vs '"+searchterms[searchn][searchi]+"'");													//random sample debug
				}//*/
            }
        }
        //thits[stags[searchj]] = thits[stags[searchj]].sort();
        /*var sum = 0;
        for( var i = 0; i < 10; i++ ){  //thits.length
            sum += thits[i]; //don't forget to add the base
        }

        var avg = sum/thits.length;
        hits[stags[searchj]]=avg;//*/
    }
	hits = sortObj(thits);
	console.log(thits);
	/*var maintagsall = [];
	for(var maintag in tags){
		maintagsall.push(maintag);
	}
	var currentDir = hits[0];
	if(maintagsall.includes(hits[0])){
		for(var hit in hits){
			if(tags[hits[0]].includes(hits[hit])){
				currentDir = hits[0]+"/"+hits[hit];
			}
		}
	}else{
		for(var mTag in tags){
			if(tags[mTag].includes(hits[0])){
				currentDir = mTag+"/"+hits[0];
			}
		}
	}
	console.log(maintagsall);//*/
    console.log(hits);
	//console.log(currentDir);
	//requestImgs(currentDir);
    findImage(hits, postid);
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
        words[jj - 1] = tmp;
    }
    console.log(words);
    return(words);
}

function levDist(s, t) { //This algorithm is now a Damerau-Levenshtein-Kuznetsov distance... Not that my name belongs with those greats, but I modified it, right?
    if((s === t)||(s+'s' === t)||(t+'s' === s)||(s+'es' === t)||(t+'es' === s)||(s+"'s" === t)||(t+"'s" === s)){
        return 0;
    }
    
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
function sortObj(objToSort, iteration, leng){
    if (iteration === undefined) {
        iteration = 0;
        leng = Object.keys(objToSort).length;
		outputArr = [];
        //console.log(objToSort);
        //console.log("Has a length of "+leng);
    }
	
	tempObj = objToSort;
	var minVal = 999;
	var hitWord = "";
	for(var hit in tempObj){
		if(objToSort[hit] < minVal){
			minVal = tempObj[hit];
			hitWord = hit;
		}
	}
	delete tempObj[hitWord];																		//Use Exponentially decreasing accuracy thresholds
	//console.log(hitWord + " - "+ minVal + " - "+ "0");
	if((minVal < 3)||(iteration<3)){                                                                  //IMPROVE THE THERSHOLD FOR THE FIRST COMPARISON FUNCTION? 
		outputArr.push(hitWord);
		if(iteration < leng-1){//<objToSort.length
			outputArr.concat(sortObj(tempObj, iteration + 1, leng));
		}
	}
	return outputArr;
}

function findImage(goodtags, postid){
    console.log(goodtags);
    window['goodtagslength'+postid]=goodtags.length;
    window['foundarticles'+postid] = [];
    setTimeout(function(){                                                                                                //COMMENT HERE AS WE DEVELOP IMAGER FURTHER RESTART HERE TOMORROW THURSDAY LEFT OFF
        /*for(searchterm in goodtags){
            //console.log(goodtags[searchterm]);
            jQuery("#hiddenoutarea"+postid).append('<div id="'+goodtags[searchterm].replace(" ", "")+'"></div>');
        }//*/
        jQuery("#hiddenoutarea"+postid).append('<div id="testdivv'+postid+'"></div>');
    }, 3000);    
    //console.log("postid: "+ postid+" length: "+goodtags.length)
    setTimeout(function(){
        jQuery.post("get4aibulk.php?posid="+postid, { 'tags': goodtags }, function(result){
            jQuery("#testdivv"+postid).html(result);
        });
        /*for(searchterm in goodtags){ 
            //console.log("Searchme");
            jQuery("#"+goodtags[searchterm].replace(" ", "")).load("get4ai.php/?url="+ encodeURIComponent("https://agoraeconomics.com/tag/"+goodtags[searchterm].replace(" ", "-")+"/?automateimager=1&posid="+postid));
        }//*/
    }, 9000);
}

function searchdonenew(foundpics, postid){                                       //The new search done function
    console.log("postid: "+postid);
    console.log("foundpics: ");
    console.log(foundpics);
    for(foundpic in foundpics){
        var pic = '<img class="i'+foundpics[foundpic][1]+'" src="'+foundpics[foundpic][0]+'" onclick="javascript:setImg('+postid+','+foundpics[foundpic][1]+');">';
        jQuery("#imgrow"+postid).append(pic);
        jQuery("#imgrow"+postid).append('&nbsp;');
        console.log(pic);
    }
}
function setImg(targetimg, number){
    jQuery("#imgrow"+targetimg+">img").removeClass("selected");
    jQuery("#img"+targetimg).attr("value", number);
    jQuery("#imgrow"+targetimg+">img.i"+number).addClass("selected");
}
function searchdone(foundids, postid){
    window['goodtagslength'+postid]--;
    if(foundids[0] == -1){
        return;
    }
    //console.log("searchdone"+postid+" running "+window['goodtagslength'+postid]);
    //console.log(foundids);
    for(foundid in foundids){                                                                                                       //after this loop, foundarticles$# contains all found PIDs
        window['foundarticles'+postid].push(foundids[foundid]);
    }
    if(window['goodtagslength'+postid] == 0){                                                                                       //Once all tags have been searched...
        //console.log("for postid: "+postid);
        //console.log(window['foundarticles'+postid].length); 
        tempGoodTags = window['foundarticles'+postid];                                        
        var alreadyhit = [];
        var workids = [];
        var idscores = [];
        for(ttag in tempGoodTags){
            if(alreadyhit.includes(tempGoodTags[ttag])){                                                                 // skip iteration where we've already counted teh word
                continue;
            }
            alreadyhit.push(tempGoodTags[ttag]);
            var ttagcount = tempGoodTags.reduce(function(n, val) {                                  //This function counts occurances in an array
                return n + (val === tempGoodTags[ttag]);
            }, 0);
            if(typeof idscores[ttagcount-1] === 'undefined'){
               idscores[ttagcount-1] = 0;
            }
            idscores[ttagcount-1] = idscores[ttagcount-1] + 1;
        } 
        //console.log(idscores);
            
        var cutoff = cutoffs(0,idscores);                                                           //Frequency cutoff
        
        alreadyhit = [];
        for(ttag in tempGoodTags){
            if(alreadyhit.includes(tempGoodTags[ttag])){                                                                 // skip iteration where we've already counted teh word
                continue;
            }
            alreadyhit.push(tempGoodTags[ttag]);
            var ttagcount = tempGoodTags.reduce(function(n, val) {                                  //This function counts occurances in an array
                return n + (val === tempGoodTags[ttag]);
            }, 0);
            //console.log(tempGoodTags[ttag]+" occured "+ttagcount+" times");               //debug statement
            iterationcount = Math.pow(ttagcount, 2);
            for(i=0; i<iterationcount; i++){                                                                                    //CHANGE CUTOFF BASED ON idscores!
                if(ttagcount >= cutoff){
                    workids.push(tempGoodTags[ttag]);
                }else{
                    break;
                }
            }
        }
        //console.log(tempGoodTags);
        //console.log(workids);
        randomitem = workids[Math.floor(Math.random()*workids.length)];
        console.log("will pull image from "+randomitem);
        jQuery("#img"+postid).attr("value", randomitem);
    }
}

function cutoffs(startpoint, scores){                                                                   //This function selects a reasonable frequency cutoff based on our statistical distribution.
    var worksum = 0;
    var sum = 0;
    var max = -1;
    for(point in scores){
        sum += scores[point];
        if(point >= startpoint){
            worksum += scores[point];
            max = point;
        }
    }
    //console.log("worksum: "+worksum+"  / sum: "+sum);
    if((worksum > (sum / 10))&& (worksum > 3)){
        max = cutoffs(startpoint+1, scores);                                                                            //DELICIOUS RECURSION
    }
    return max;
}