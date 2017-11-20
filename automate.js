        var newDivs = []; 
        var d = new Date();
        var t1 = d.getTime();
        var t=setInterval(countdown,1000);
        var template = false;
        var aNums = [];
        var underCons = "Feature Under Construction";

        window.onload = function() {
            //Grabs author/category lists in our wp to generate dropdowns for later
            //var sneakydiv = document.getElementById('sneakydatadiv');
            jQuery("#sneakydatadiv").load('infograb3.php');
            console.log(Date());
            // Get the modaluniquea
            var modaluniquea = document.getElementById('mymodaluniquea');

            // Get the button that opens the modaluniquea
            var btn = document.getElementById("myBtn");

            // Get the <span> element that closes the modaluniquea
            var span = document.getElementsByClassName("closemodalunqa")[0];

            // When the user clicks on <span> (x), close the modaluniquea
            document.getElementsByClassName("closemodalunqa")[0].onclick = function() {
                modaluniquea.style.display = "none";
            }

            // When the user clicks anywhere outside of the modaluniquea, close it
            window.onclick = function(event) {
                if (event.target == modaluniquea) {
                    
                                                                                        //COMMENTED HERE TO REDUCE RISK OF ACCIDENTAL MODAL CLOSE
                    //modaluniquea.style.display = "none";
                }
            }
        
            //modaluniquea.style.display = "block";
        }
function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e9; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}

function subConfirm1(){
        if(window['remartcnt'] > 0){
            var r = confirm("Not all articles have been reviewed, Are you sure?");
            if (r == true) {
                formSubmit1();
            } 
        }else{
            formSubmit1();
        }
}

function formSubmit1(){                                                         //THIS SUBMITS A BUNCH OF NEW POST FORMS BASED ON YER EDITED ARTICLES
 len = aNums.length;
 i = 0;
        
        //creating forms in new windows to submit all the post data
        window['f'] = document.createElement("form");
        window['f'].setAttribute('method',"post");
 for (i = 0; i < len; i++)  {                                                                        //Iterate through all of them, replace (i = 0; i < len; i++)                                    
     //var i = 0;
    if (aNums[i]) {
        console.log(i+"!");
        var doc = document.getElementById("heditarea"+i);
        var notes = [];
        var descendants = [];
        descendants = doc.getElementsByTagName("*");
        //console.log(" - "+i+" - ");
        
        for (var j = 0; j < descendants.length; j++) {
            if (descendants[j].className){if (descendants[j].className.includes("nicEdit-main")) {
                notes.push(descendants[j]);
            }}
        }
        //console.log(notes);
        if(notes.length == 1){
            document.getElementById("tacontent"+i).innerHTML = notes[0].innerHTML;
            document.getElementById("tashart"+i).innerHTML = notes[0].innerHTML;
        }else{
            document.getElementById("tacontent"+i).innerHTML = notes[0].innerHTML;
            document.getElementById("tashart"+i).innerHTML = notes[1].innerHTML;
        }
        //console.log("assignment success:");
        //console.log (        
        console.log("string comparison:");
        jQuery("tacontent"+i).html(notes[0].innerHTML);
        //document.getElementById("tacontent"+i).innerHTML = notes[0].innerHTML;//);
        console.log (document.getElementById("tacontent"+i).value.substring(0,70)+" = "+notes[0].innerHTML.substring(0,70));
        console.log (document.getElementById("tacontent"+i).value == notes[0].innerHTML);
        console.log (document.getElementById("tacontent"+i).value === notes[0].innerHTML);
                                                                                                //pub count, probably doesn't need to be looped through but this is easier
        var bulkpubnumber = document.createElement("input"); //input element, text
        bulkpubnumber.setAttribute('type',"text");
        bulkpubnumber.setAttribute('name',"bulkpubnumber");
        bulkpubnumber.setAttribute('id',"bulkpubnumber");
        bulkpubnumber.setAttribute('value',len);
                                                                                                //CATEGORY
        var pco = document.createElement("input"); //input element, text
        pco.setAttribute('type',"text");
        pco.setAttribute('name',"user-submitted-pubcode"+i);
        pco.setAttribute('id',"user-submitted-pubcode"+i);
        //console.log("document.getElementById(pubCode"+i+")");
        //console.log(document.getElementById("pubCode"+i));
        pco.setAttribute('value',document.getElementById("pubCode"+i).value);
                                                                                                //Pub Code
        var cat = document.createElement("input"); //input element, text
        cat.setAttribute('type',"text");
        cat.setAttribute('name',"user-submitted-category"+i);
        cat.setAttribute('id',"user-submitted-category"+i);
        cat.setAttribute('value',document.getElementById("inCat"+i).value);
                                                                                                //AUTHOR
        var auth = document.createElement("input"); //input element, text
        auth.setAttribute('type',"text");
        auth.setAttribute('name',"user-submitted-name"+i);
        auth.setAttribute('id',"user-submitted-name"+i);
        auth.setAttribute('value',document.getElementById("inAuth"+i).value);
                                                                                                //PROMO/LINK
        var uri = document.createElement("input"); //input element, text
        uri.setAttribute('type',"text");
        uri.setAttribute('name',"user-submitted-link"+i);
        uri.setAttribute('id',"user-submitted-link"+i);
        uri.setAttribute('value',document.getElementById("inUrl"+i).value);
                                                                                                //TITLE  
        var pay = document.createElement("input"); //input element, text
        pay.setAttribute('type',"text");
        pay.setAttribute('name',"user-submitted-title"+i);
        pay.setAttribute('id',"user-submitted-title"+i);
        pay.setAttribute('value',document.getElementById("inTitle"+i).value);
                                                                                                //PAYWALLED BOOL
        var ttl = document.createElement("input"); //input element, bool
        ttl.setAttribute('type',"text");
        ttl.setAttribute('name',"user-submitted-paid"+i);
        ttl.setAttribute('id',"user-submitted-paid"+i);
        ttl.setAttribute('value',document.getElementById("inTier"+i).value);
        //alert(i+": "+pay.value+" - paid= "+ttl.value);
                                                                                                //LANGUAGE
        var lng = document.createElement("input"); //input element, text
        lng.setAttribute('type',"text");
        lng.setAttribute('name',"user-submitted-lang"+i);
        lng.setAttribute('id',"user-submitted-lang"+i);
        lng.setAttribute('value',document.getElementById("inLang"+i).value);
                                                                                                //EXCERPT
        var exc = document.createElement("input"); //input element, text
        exc.setAttribute('type',"text");
        exc.setAttribute('name',"user-submitted-excerpt"+i);
        exc.setAttribute('id',"user-submitted-excerpt"+i);
        exc.setAttribute('value',document.getElementById("taexcerpt"+i).value);
                                                                                                //PARTICLE
        var prt = document.createElement("input"); //input element, text
        prt.setAttribute('type',"text");
        prt.setAttribute('name',"user-submitted-shArt"+i);
        prt.setAttribute('id',"user-submitted-shArt"+i);
        prt.setAttribute('value',document.getElementById("tashart"+i).value);
                                                                                                //FULL CONTENT
        var cnt = document.createElement("input"); //input element, text
        cnt.setAttribute('type',"text");
        cnt.setAttribute('name',"user-submitted-content"+i);
        cnt.setAttribute('id',"user-submitted-content"+i);
        cnt.setAttribute('value',document.getElementById("tacontent"+i).value);
                                                                                                //PUBLISHER
        var pub = document.createElement("input"); //input element, text
        pub.setAttribute('type',"text");
        pub.setAttribute('name',"user-submitted-partner"+i);
        pub.setAttribute('id',"user-submitted-partner"+i);
        pub.setAttribute('value',document.getElementById("inPub"+i).value);
                                                                                                //TAGS
        var tgs = document.createElement("input"); //input element, text
        tgs.setAttribute('type',"text");
        tgs.setAttribute('name',"user-submitted-tags"+i);
        tgs.setAttribute('id',"user-submitted-tags"+i);
        tgs.setAttribute('value',document.getElementById("inTags"+i).value);
        
                                                                                                //NONCE
        var unc = document.createElement("input"); //input element, text
        unc.setAttribute('type',"text");
        unc.setAttribute('name',"usp-nonce");
        unc.setAttribute('id',"usp-nonce");
        unc.setAttribute('value',window['uspnonce']);
        
        var img = document.createElement("input"); //input element, text
        img.setAttribute('type',"text");
        img.setAttribute('name',"user-submitted-img"+i);
        img.setAttribute('id',"user-submitted-img"+i);
        img.setAttribute('value',document.getElementById("img"+i).value);
                                                                                                //THE IMAGE
        
                                                                                                //wait time, spaces out requests by 1 second
        var wtm = document.createElement("input"); //input element, text
        wtm.setAttribute('type',"hidden");
        wtm.setAttribute('name',"waittime");
        wtm.setAttribute('id',"waittime");
        wtm.setAttribute('value',(i));
//*/
        
        
        window['f'].appendChild(cat);
        window['f'].appendChild(auth);
        window['f'].appendChild(uri);
        window['f'].appendChild(ttl);
        window['f'].appendChild(pay);
        window['f'].appendChild(lng);
        window['f'].appendChild(exc);
        window['f'].appendChild(prt);
        window['f'].appendChild(cnt);
        window['f'].appendChild(pub);
        window['f'].appendChild(tgs);
        window['f'].appendChild(wtm);
        window['f'].appendChild(unc);
        window['f'].appendChild(pco);
        window['f'].appendChild(img);


    } 
 } 
        
        window['f'].appendChild(bulkpubnumber);
        address = "sendp.php";
        window['f'].setAttribute("target", "windowSubmitArt-" + i)   //"_blank");                      //Unique window IDs for each submission
        window['f'].setAttribute('action',address);
        window['f'].setAttribute('id',"automateBulkSubmitForm");
        //window.open(address, "windowSubmitArt-" + i);                       // pop open a window with that same id and the form will submit into it
        //console.log(window['f']);
    
        document.getElementById("sneakydatadiv").innerHTML = window['f'].outerHTML;
            sleep(300);
        var x=document.getElementsByTagName("input");                                   //get all the inputs
        for(var its = 0; its < x.length; its++) {                                             //iterate through them
            var str=x[its].value; 
            x[its].value=str.split("&").join("%26");                                      //clean up ampersands
            //console.log("removed "+(str.split("&").length - 1)+" ampersands.")
            str=x[its].value; 
            x[its].value=str.split("; font-family: Roboto, sans-serif;").join(";");       //clean up styling
            str=x[its].value; 
            x[its].value=str.split(";font-size: 12px").join(";");                         //clean up styling
        }
        sleep(300);
    //alert("end of submit function");
        document.getElementById("automateBulkSubmitForm").submit();
        //sleep(300);
}
        
function nextStep(){
    getNewDivs();
    var allDatum = [];
    var jsonarrayid;
    newDivs.forEach(function(element) {
        jsonarrayid = element.replace("dataDiv", "");
        allDatum.push(window['dataArr'+jsonarrayid]);
        if(aNums.length<newDivs.length){
            aNums.push(jsonarrayid);
        }
    });
    //console.log(aNums);
    var modaluniquea = document.getElementById('mymodaluniquea');
    modaluniquea.style.display = "block";
    //console.log(modaluniquea.style.display);
    setTimeout(function(){ populate2(allDatum);}, 300);
}

function removeArticle(article){
    window['artcount'] = window['artcount'] -1;
    document.getElementById('inTier'+article).value="automatecancelled";
    document.getElementById('editarea'+article).style.display = "none";
    edita(article);
    console.log("article count: "+window['artcount']+" - remaining count: "+window['remartcnt']);
}

function populate2(datum){
    window['artcount'] = datum.length;
    window['remartcnt'] = artcount;
    var artcountdisp = window['remartcnt']+" of "+window['artcount']+" articles still need review"; 
    document.getElementById('status').innerHTML = artcountdisp;
    var target = document.getElementById('step2');
    var generated = "";
    var aList = JSON.parse(window['authList']);     //get data from php function
    var cList = JSON.parse(window['catList']);
        fuzzysearch = FuzzySet();  
        fuzzysearchcat = FuzzySet();                                       //FUZZY search get author names
    /*var catOpt = Object.keys(cList).map(function(k) { 
        return '<option value="'+k+'">'+cList[k]+'</option>';
        });//*/

     jQuery.each(datum, function(index, value) {         //foreach datum
             var authOpt = Object.keys(aList).map(function(k) { 
        fuzzysearch.add(aList[k]+";"+k);
        return '<option value="'+k+'">'+aList[k]+'</option>';
        });
         var ptarray = fuzzysearch.get(value[2]);
         jQuery.each(ptarray, function(indAuth, valAuth) {                  //find most relevant author
            max = 0;
            if(valAuth[0]>max){
                max = valAuth[0];
                authorout = valAuth[1].split(";")[0];
                authID = valAuth[1].split(";")[1];
            }  
        });
                      var catOpt = Object.keys(cList).map(function(k) { 
        fuzzysearchcat.add(cList[k]+";"+k);
        return '<option value="'+k+'">'+cList[k]+'</option>';
        });
         authOpt = authOpt.toString().replace('<option value="'+authID+'">','<option value="'+authID+'" selected="true">');                   //SET AUTHOR SELECTED
         //console.log( value[2] +" ~= "+ authorout + " - " + (max*100) + "% match.  Author ID = " + authID);
         
        var ptarray = fuzzysearchcat.get(value[3].match(/\((.*?)\)/)[1]);
         jQuery.each(ptarray, function(indCat, valCat) {                  //find most relevant author
            max = 0;
            if(valCat[0]>max){
                max = valCat[0];
                catout = valCat[1].split(";")[0];
                catID = valCat[1].split(";")[1];
            }  
        });
         catOpt = catOpt.toString().replace('<option value="'+catID+'">','<option value="'+catID+'" selected="true">');                   //SET categORy SELECTED
         //console.log( value[3].match(/\((.*?)\)/)[1] +" ~= "+ catout + " - " + (max*100) + "% match.  cat ID = " + catID);
         
         if(value[8] != "English"){
             //console.log(index+" needs translation from "+value[8]);
             //getLangs(value[8],material to translate);
             value[1] = translateSaveHtml(value[8],value[1],value[9]+" - title","#bb0000");
             value[4] = translateSaveHtml(value[8],value[4],value[9]+" - full content","#00aa00");
             value[7] = translateSaveHtml(value[8],value[7],value[9]+" - short content","#0000cc");
         }
         
         var shartcontent = value[7];
        if (shartcontent.length > 225){
            shartcontent = shartcontent.replace(/<(?:.|\n)*?>/gm, '');
            shartcontent = shartcontent.substring(0,500);
            endSenternce = shartcontent.lastIndexOf(". ");
            //console.log (endSenternce);
            if(endSenternce > 10){
                shartcontent = shartcontent.substring(0,endSenternce);
                shartcontent = shartcontent+". ";
            }else{
                shartcontent = shartcontent.substring(0,225);
                shartcontent = shartcontent+"...";
            }
        }
         var fullLabel = "<strong>Full article</strong> for Dropbox:";
         var paid = 1;
         if(value[6] == "Free"){
            paid = 0;
            fullLabel = "<strong>Full article</strong> for Dropbox and Wordpress:"
         }
         //console.log("Tags for "+value[1].trim()+":");                                                      //dump to console to help debug tagger.js
         
         //THE WORST FORMATTED, LEAST READABLE PART OF MY CODE. 
         generated = generated + '<li style="width:100%; list-style-type:none;" id="editarea'+index+'"><p><div class="editbutton" id="editbutton'+index+'" onclick="javascript:edita('+index+')">&bull;&bull;&bull;<small>edit </small></div><a href="'+value[0]+'" target="_blank'+index+'">' + value[3] + '</a>: <input style="width:300px;" type="text" id="inTitle'+index+'" value="'+value[1].trim()+'"/>  </p>' ; // buttons, title
         generated = generated + '<li style="display:none;"><input type="text" form="modify" style="display:none;" id="img'+index+'" value=""/><div style="display:none" id="hiddenoutarea'+index+'"></div></li>';   //FOR IMAGER 
         generated = generated + '<ul id="heditarea'+index+'" style="width:100%; list-style-position:inside; list-style-type:none;">'; //list definitions
         generated = generated + '<li>Category: <select id="inCat'+index+'">'+catOpt+'</select> &nbsp; Author: <select id="inAuth'+index+'">'+authOpt+'</select> &nbsp; Tier: <strong>'+value[6]+'</strong><input type="hidden" id="inTier'+index+'" value="'+paid+'"/><input type="hidden" id="inPub'+index+'" value="'+value[3]+'"/></li>'; //category, author, price tier, paid boolean
         generated = generated + '<li>Tags: <input type="text" id="inTags'+index+'" value="'+getTags(value[4])+'"/> &nbsp; Promo/article URL: <input type="text" id="inUrl'+index+'" value="'+value[5]+'"/> &nbsp; Language: <input type="text" id="inLang'+index+'" value="'+value[8]+'"/>'; //tags, url, language
         generated = generated + ' &nbsp; Pub Code:<input type="text" id="pubCode'+index+'" value="'+value[9]+'"/></li>'; // publication code
         generated = generated + '<li><strong>Excerpt</strong> for Alerts: <textarea form="modify" id="taexcerpt'+index+'" rows="5" required>'+shartcontent.trim()+'</textarea></li>';  // excerpt
         generated = generated + '<li><strong>Featured Image</strong> for Alerts: <div class="imgrow" id="imgrow'+index+'" ></div></li>';                                               //image select area
         generated = generated + '<li>'+fullLabel+' <textarea form="modify" id="tacontent'+index+'" required>'+value[4]+'</textarea></li>'; //content
         if(paid == true){
                generated = generated + '<li><strong>Partial</strong> article for Wordpress: <textarea form="modify" id="tashart'+index+'" required>'+value[4]+'</textarea></li>';  // particle
         }else{
                generated = generated + '<li style="display:none;"><textarea form="modify" style="display:none;" id="tashart'+index+'" required>'+value[4]+'</textarea></li>';  //particle hidden
         }
         generated = generated + '<li><div id="remove'+index+'" class="button green" onclick="javascript:edita('+index+')"> &mdash; Done! &mdash; </div><div id="done2'+index+'" class="button red" onclick="javascript:removeArticle('+index+')">Remove Article</div></li>'; // buttons
         generated = generated + '</ul>';
         generated = generated + "</li>";
         
         queryImg(value[4]+ " " +value[1].trim(),index);                                                                  //COMMENTED TO SPEED UP, THIS IS FOR IMAGER
    });
    target.innerHTML = generated;
           
    //jQuery('option [value='+authID+']').prop('selected',true);                                              //select appropriate author
    
	//nicEditors.allTextAreas(new nicEditor({iconsPath:'/nicEdit/nicEditorIcons.gif',fullPanel : true}));
    //nEditor = new nicEditor({iconsPath : '/nicEdit/nicEditorIcons.gif', fullPanel : true}).panelInstance('tacontent'+targnum);
         jQuery.each(datum, function(index, value) {
            window['editor'+index] = new nicEditor({iconsPath : './nicEdit/nicEditorIcons.gif', fullPanel : true, maxHeight: 200}).panelInstance('tacontent'+index);
            if(value[6] !== "Free"){
                window['editor'+index] = new nicEditor({iconsPath : './nicEdit/nicEditorIcons.gif', fullPanel : true, maxHeight: 240}).panelInstance('tashart'+index);
            }
            document.getElementById('heditarea'+index).style.display = "none";
            document.getElementById('inTitle'+index).readOnly = true;
         });
}

function edita(targnum){
    var targ = document.getElementById('heditarea'+targnum);
    //console.log(targ.id);
    //console.log(targ.style.display);
    //alert(window['remartcnt']+" - "+document.getElementById('editbutton'+targnum).innerHTML);
    if(document.getElementById('editbutton'+targnum).innerHTML.includes("•••")){
        window['remartcnt'] = window['remartcnt'] - 1;
        if(window['remartcnt'] > 0){
            artcountdisp = window['remartcnt']+" of "+window['artcount']+" articles still need review.";
        }else{
            artcountdisp = "All "+window['artcount']+" articles have been viewed!"
        }
        document.getElementById('status').innerHTML = artcountdisp;
    }
    if(targ.style.display=="none"){
        targ.style.display = "inline";
        document.getElementById('editbutton'+targnum).innerHTML = " &#10004;<small>done </small> ";
        document.getElementById('inTitle'+targnum).readOnly = false;
    }else{
        targ.style.display = "none";
        document.getElementById('editbutton'+targnum).innerHTML = "&#10004<small>edit </small>";
        document.getElementById('editbutton'+targnum).style.backgroundColor = "#aaffaa";
        document.getElementById('inTitle'+targnum).readOnly = true;
    }
}

function fool(){
    var total = "";
    //for(var i = 0; i<99999;i++){
    //    total = total +i.toString();
    //    history.pushState(0, 0, total);
   // }
  //  alert("done breaking your browser");
}
//<input type="button" onclick="javascript:fool()" value="DO NOT PRESS" />

    function countdown(){
        //cdwn = Math.round(cdwn);
        cdwn--;
        if(cdwn > 0){
            var outcdwn = '<p style="text-align: left;"><strong>ETA:</strong> '+cdwn+' seconds</p><br/>';
        }else{
            var outcdwn = '<p style="text-align: left;">Running slow by '+(cdwn*(-1))+' seconds</p><br/>';
        }
        if(cdwn < -20){ //-20
                if(!window.location.hash)window.location = window.location + '#0';
                console.log(window.location.hash.substring(1));
                if(parseFloat(window.location.hash.substring(1)) < 3) {
                    window.location = window.location.href.substring(0,window.location.length-1) + '#'+ parseFloat(parseFloat(window.location.hash.substring(1))+ 1);
                    window.location.reload();
                }        
            outcdwn = '<input type="button" value="STOP SCANNING NOW" onclick="javascript:overridewait()"/> <strong>Only</strong> use when issues with affiliate site prevent loading.'+outcdwn;
        }
        $('#countdown').html(outcdwn);
    }

function overridewait(){
    articleCount = 1;
    loaded(0);
}    

    function TempMode(){
        sfa = document.getElementById("plscopy");
        var hideables = document.getElementsByClassName("templateHide");
        var antihidables = document.getElementsByClassName("templateShow");
        if(sfa.className == "template"){
            sfa.className = "";
            template = false;
            $('#plscopy a').show();
            jQuery.each(hideables, function(index, value) {
                if(value){
                    value.style.display = initial;
                }
            });
            jQuery.each(unhideables, function(index, value) {
                if(value){
                    value.style.display = none;
                }
            });
        }
        else{
            sfa.className = "template";
            template = true;
            $('#plscopy a').hide();
            jQuery.each(hideables, function(index, value) {
                if(value){
                    value.style.display = none;
                }
            });
            jQuery.each(unhideables, function(index, value) {
                if(value){
                    value.style.display = inherit;
                }
            });
        } 
    }
        
    function loaded(artind){
        telm = document.getElementById("dataDiv"+artind);
        //gelm = document.getElementById("json"+artind);
        //var dataArr = JSON.parse(gelm.innerHTML);
        var dataArr = window['dataArr'+artind];
        if(dataArr){
            var shortArt = dataArr[7];
            if (shortArt.length >225){
                shortArt = shortArt.substring(0,224);
                shortArt = shortArt+"…";
            }
            var outdata = '<p id="norme'+artind+'"><strong>'+dataArr[1]+'</strong> <a class="hideable" href="'+dataArr[0]+'"><small>link</small></a></p><p id="ule'+artind+'" class="hiddenclass"><strong>'+dataArr[1]+'</strong></p><p id="norm'+artind+'">'+dataArr[2]+" - " +dataArr[3]+ " - "+ shortArt + "</p>" ;//+'<img id="more'+artind+'" src="automate/more.png" class="more" onclick="showhide('+artind+')" />'
            //var houtdata = '<div id="ul'+artind+'" class="hiddenclass" > <input </div>';
            telm.innerHTML = outdata;//+houtdata;
        }
 
        articleCount--; 
        
        //WILL NEED TO REPLACE NEXT BUTTON: <input type="button" onclick="javascript:nextStep()" value="Next ==>">
        var linky = '<input type="button" value="Open All Articles" onclick="javascript:DoOpenAll()"/><input type="button" value="Alert Mode" onclick="javascript:TempMode()"/><input type="button" onclick="javascript:nextStep()" value="Next ==>">';
        //this'll get overwritten if it's done all the updates successfully.
        $('#remaining').html('<h2 style="text-align: center;">Sources left to scan:</h2> <h1>'+articleCount+'/'+articleCnt+'</h1><br/>');
        document.getElementById(telm.className).appendChild(telm);
        if(articleCount == 0){
                    clearInterval(t);
                    var d2 = new Date();
                    var t2 = d2.getTime();
                    var seconds = ((t2-t1)/1000);
                    jQuery('#hiddendiv').load('perflog.php','loadtime='+seconds+';');
                    $('#remaining').html(linky);
                    var outcdwn;
                    if(cdwn > 0){
                        outcdwn = '<p style="text-align: left;">Checked <strong>'+articleCnt+'</strong> websites in <strong>'+Math.round(seconds)+'</strong> seconds; <strong>'+cdwn+'</strong> seconds faster than average (over last 12 iterations).</p><br/>';}
                    else{
                        outcdwn = '<p style="text-align: left;">Checked <strong>'+articleCnt+'</strong> websites in <strong>'+Math.round(seconds)+'</strong> seconds; <strong>'+(cdwn*(-1))+'</strong> seconds slower than average (over last 12 iterations).</p><br/>';
                    }
                    $('#countdown').html(outcdwn);
                    //sleep(300);
                    if(window['authList']){
                        getTagArray();
                        nextStep();
                    }else{
                       var intervalv = setInterval(function(){ 
                            if(window['authList']){
                                getTagArray();
                                window.clearInterval(intervalv);
                                nextStep();
                            }
                             }, 1000);
                    }
                    //nextStep();
        }
        
        
    }
  
    function DoOpenAll(){
        getNewDivs();
        newDivs.forEach(function(element) {
            var container = document.getElementById(element);
            if(!(container.lastElementChild.nodeName == "SMALL")){
                var links = container.getElementsByTagName("a");
                window.open(links[0].href, "_blank");
            }
        });        
    }

    function getNewDivs(){
        newDivs = [];
        //sleep(300);
        var newbks = document.getElementById('Backend').childNodes;
        var newfrs = document.getElementById('Frontend').childNodes;
        var newfre = document.getElementById('Free').childNodes;
        //console.log(newfre);
        for (var i = 0; i < newbks.length; i++) {
            if(newbks[i].className == "Backend"){
                //console.log(newbks[i].id); 
                newDivs.push(newbks[i].id);
            }
        }
        for (var i = 0; i < newfrs.length; i++) {
            if(newfrs[i].className == "Frontend"){
                //console.log(newfrs[i].id); 
                newDivs.push(newfrs[i].id);
            }
        }
        for (var i = 0; i < newfre.length; i++) {
            if(newfre[i].className == "Free"){
                //console.log(newfre[i].id); 
                newDivs.push(newfre[i].id);
            }
        }
    }
    
    function showhide(num){
        if(but = document.getElementById("more"+num)){
            if(but.className == "less"){
                but.src = "automate/more.png"
                but.className = "more";
                document.getElementById("ul"+num).className="hiddenclass";
                document.getElementById("norm"+num).className="nothidden";
                document.getElementById("ule"+num).className="hiddenclass";
                document.getElementById("norme"+num).className="nothidden";
                document.getElementById("norm"+num).innerHTML=document.getElementById("ul"+num).firstChild.innerHTML;
            }
            else{
                but.className = "less";
                but.src = "automate/less.png";
                document.getElementById("ul"+num).className="nothidden";
                document.getElementById("norm"+num).className="hiddenclass";
                document.getElementById("ule"+num).className="nothidden";
                document.getElementById("norme"+num).className="hiddenclass";
                document.getElementById("ul"+num).firstChild.innerHTML=document.getElementById("norm"+num).innerHTML;
            }
        }
    }

function addArticle(){
    index = aNums.length;
    aNums.push(index);
    window['artcount']++;
    window['remartcnt']++;
        var aList = JSON.parse(window['authList']);     //get data from php function
    var cList = JSON.parse(window['catList']);
    var catOpt = Object.keys(cList).map(function(k) { 
        return '<option value="'+k+'">'+cList[k]+'</option>';
        });
             var authOpt = Object.keys(aList).map(function(k) { 
        return '<option value="'+k+'">'+aList[k]+'</option>';
        });
    var artcountdisp = window['remartcnt']+" of "+window['artcount']+" articles still need review"; 
    document.getElementById('status').innerHTML = artcountdisp;
    var target = document.getElementById('step2');
    var generated = target.innerHTML;

         //console.log( value[2] +" ~= "+ authorout + " - " + (max*100) + "% match.  Author ID = " + authID);
         var shartcontent = "";
         var fullLabel = "<strong>Full article</strong> for Dropbox:";
         var paid = true;
         var tier = "Paid";
         if(confirm("Is this a Free article? ... OK for Free  or  Cancel for Paid")){
            paid = false;
            tier = "Free";
            fullLabel = "<strong>Full article</strong> for Dropbox and Wordpress:"
         }
         generated = generated + '<li style="width:100%; list-style-type:none;" id="editarea'+index+'"><p><div class="editbutton" id="editbutton'+index+'" onclick="javascript:edita('+index+')">&bull;&bull;&bull;<small>edit </small></div>' + '<input type="text" id="inPub'+index+'" value="Publisher (country)"/>' + ': <input style="width:300px;" type="text" id="inTitle'+index+'" value="'+""+'"/> </p>' ;
         generated = generated + '<ul id="heditarea'+index+'" style="width:100%; list-style-position:inside; list-style-type:none;">';
         generated = generated + '<li>Category: <select id="inCat'+index+'">'+catOpt+'</select> &nbsp; Author: <select id="inAuth'+index+'">'+authOpt+'</select> &nbsp; Tier: <strong>'+tier+'</strong><input type="hidden" id="inTier'+index+'" value="'+paid+'"/></li>';
         generated = generated + '<li>Tags: <input type="text" id="inTags'+index+'"/> &nbsp; Promo/article URL: <input type="text" id="inUrl'+index+'" value="'+""+'"/> &nbsp; Language: <input type="text" id="inLang'+index+'" value="English"/>';
         generated = generated + ' &nbsp; Pub Code:<input type="text" id="pubCode'+index+'" value=""/></li>';
         generated = generated + '<li><strong>Excerpt</strong> for Alerts: <textarea form="modify" id="taexcerpt'+index+'" rows="5" required>'+shartcontent.trim()+'</textarea></li>';
         generated = generated + '<li>'+fullLabel+' <textarea form="modify" id="tacontent'+index+'" required>'+""+'</textarea></li>';
         if(paid == true){
                generated = generated + '<li><strong>Partial</strong> article for Wordpress: <textarea form="modify" id="tashart'+index+'" required>'+""+'</textarea></li>';
         }else{
                generated = generated + '<li style="display:none;"><textarea form="modify" style="display:none;" id="tashart'+index+'" required>'+""+'</textarea></li>';
         }
         generated = generated + '<li><div id="remove'+index+'" class="button green" onclick="javascript:edita('+index+')"> &mdash; Done! &mdash; </div><div id="done2'+index+'" class="button red" onclick="javascript:removeArticle('+index+')">Remove Article</div></li>';
         generated = generated + '</ul>'
         generated = generated + "</li>";
    target.innerHTML = generated;
             
            window['editor'+index] = new nicEditor({iconsPath : './nicEdit/nicEditorIcons.gif', fullPanel : true, maxHeight: 200}).panelInstance('tacontent'+index);
            if(paid == true){
                window['editor'+index] = new nicEditor({iconsPath : './nicEdit/nicEditorIcons.gif', fullPanel : true, maxHeight: 240}).panelInstance('tashart'+index);
            }
            document.getElementById('heditarea'+index).style.display = "none";
            document.getElementById('inTitle'+index).readOnly = true;
         
        //edita(index);
    console.log("article count: "+window['artcount']+" - remaining count: "+window['remartcnt']);
}