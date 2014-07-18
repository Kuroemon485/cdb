<!--//--><![CDATA[//><!--
/* Generic functions */

function $() { // http://www.dustindiaz.com/top-ten-javascript/
	var elements = [];
	for (var i=0, j=arguments.length; i < j; i++) {
		var element = arguments[i];
		if (typeof element == 'string')
			element = document.getElementById(element);
		if (j == 1)
			return element;
		elements.push(element);
	}
	return elements;
}
function $c(classname, node) { //Get elements by class
	if(!node) node = document.getElementsByTagName('body')[0];
	var a = [];
	var re = new RegExp('\\b' + classname + '\\b');
	var els = node.getElementsByTagName("*");
	for(var i=0, j=els.length; i<j; i++)
		if(re.test(els[i].className))a.push(els[i]);
	return a;
}
function event_add(obj,type,fn) { // http://www.dustindiaz.com
	if (obj.addEventListener)	obj.addEventListener(type,fn,false );
	else if (obj.attachEvent) {
		obj["e"+type+fn] = fn;
		obj.attachEvent( "on"+type, function() { obj["e"+type+fn](); } );
	}
}
function event_del(obj,type,fn) { // http://www.dustindiaz.com
	if (obj.removeEventListener) obj.removeEventListener(type,fn,false);
	else if (obj.detachEvent) {
		obj.detachEvent( "on"+type, obj["e"+type+fn] );
		obj["e"+type+fn] = null;
	}
}
function cookie_create(name,value,days) {
	if (location.protocol == 'data:') { return null; } //prevents security errors
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = '; expires='+date.toGMTString();
	}
	else var expires = '';
	document.cookie = name+'='+value+expires+'; path=/';
}
function cookie_read(name) {
	if (location.protocol == 'data:') { return null; }
	var name = name+'=', ca = document.cookie.split(';');
	for(var i=0, j=ca.length;i < j;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
	}
	return null;
}
function toggle(el) {
	if ( el.style.display != 'none' ) { el.style.display = 'none'; }
	else { el.style.display = ''; }
}
function autocomplete(field,select,property,forcematch) { // <input/> -> <select>
	var f = false;
	for (var i=0, j=select.options.length; i < j; i++) {
		if (select.options[i][property].toUpperCase().indexOf(field.value.toUpperCase()) == 0) {
			f=true; break;
		}
	}
	if (forcematch && !f) {
		field.value = field.value.slice(0,field.value.length-1);
		autocomplete(field,select,property,forcematch);
		return false;
	}
	if (f) { select.selectedIndex = i; }
	else { select.selectedIndex = 0; }
}
function vv(e,min,max,evt,r)  {  //Field Value Validation (numeric only)
	if (r != undefined && $('act-'+r).checked == 0) { row_act(r); }
	if ($(e).title == '') {
		$(e).autocomplete = 'off';
		$(e).title = '('+min+' - '+max+') Use up/down arrow keys to increase/decrease.';
	}
	var r = $(e).id.split('-')[1], v = $(e).value;
	var k = window.event?event.keyCode:evt.keyCode; // alert(k); //DEBUG
	switch(k) {
		case 9: return false; break; //tab
		case 8: return false; break; //backspace
		case 46: return false; break; //delete
		case 13: calc_ivs((mode==2 && act>-1?act:0)); break; //enter
		case 38: //Up key, increase
			$(e).value = v<max?(1*v)+1:v;
		break;
		case 40: //Down key, decrease
			$(e).value = v>min?(1*v)-1:v;
		break;
		default:
			$(e).value = isNaN(v)?min:Math.min(v,max);
	}
}
function tooltips() { // inspired by http://qrayg.com/learn/code/qtip
	if (!$('tooltip')) { var e = el_add($('calculator'),'div',{className:'a',id:'tooltip'});
		event_add(document, "mousemove", function(evt) {
			var de = document.documentElement;
			$('tooltip').style.left = (document.all?((de && de.scrollLeft)?de.scrollLeft:document.body.scrollLeft)+window.event.clientX:evt.pageX)+'px';
			$('tooltip').style.top = (document.all?((de && de.scrollTop)?de.scrollTop:document.body.scrollTop)+window.event.clientY:evt.pageY)+'px';
		});
	}
	var elements = $c('tooltip');
	var  i=elements.length-1; do {
		var e = elements[i];
				if(e.title && !e.tooltip) {
					e.tooltip = e.title;
					e.title = ''; e.alt = ''; //prevent default behaviour
					event_add(e, "mouseover", function() { $('tooltip').innerHTML = this.tooltip; $('tooltip').style.display = 'block'; });
					event_add(e, "mouseout", function() { $('tooltip').innerHTML = ''; $('tooltip').style.display = 'none'; });
				}
	} while(i--);
}
function el_add(el,tag,attr,txt) { //Appends element - el_add(el,'div',{className:'a',id:'b'},'text');
	var i='',e=document.createElement(tag);
	if (attr) {
		for (i in attr) {
			e[i] = attr[i];
		}
	}
	e.innerHTML = txt || '';
	el.appendChild(e);
	return e;
}
function el_del(el) { //Removes all element children of el
	while (el.firstChild) {
		el.removeChild(el.firstChild);
	}
	return this;
}
function array_intersect(a, b) { //arrays must be sorted, a and b are destructed afterwards
	var r=[];
	while( a.length > 0 && b.length > 0 ) {
		if (a[0] < b[0] ){ a.shift(); }
		else if (a[0] > b[0] ){ b.shift(); }
		else {
			r.push(a.shift());
			b.shift();
		}
	}
	return r;
}
if (!Array.prototype.map) {
	Array.prototype.map = function(fn, thisObj) { // http://www.dustindiaz.com/basement/sugar-arrays.html
		var scope = thisObj || window;
		var a = [];
		for (var i=0, j=this.length; i < j; ++i) {
			a.push(fn.call(scope, this[i], i, this));
		}
		return a;
	};
}
if (!Array.prototype.indexOf) {
	Array.prototype.indexOf = function(el, start) { // http://www.dustindiaz.com/basement/sugar-arrays.html
		var start = start || 0;
		for (var i=0, j=this.length; i < j; ++i) { //rewrite using while do?
			if (this[i] === el ) {
				return i;
			}
		}
		return -1;
	};
}
Array.prototype.sum = function() {
	var sum=0,i=this.length-1; do {
		sum += this[i];
	} while(i--);
	return sum;
};
Array.prototype.sortnum = function() {
   return this.sort( function (a,b) { return a-b; } );
};
Array.prototype.style = function(p,v) {
	var i=this.length-1; do {
		this[i].style[p] = v;
	} while(i--);
};

/* Pokemon Data and retrieval functions */
//Pokemon Name:Number - email the author for a precompiled list of the names in other languages
pkmns='Bulbasaur:1|Ivysaur:2|Venusaur:3|Charmander:4|Charmeleon:5|Charizard:6|Squirtle:7|Wartortle:8|Blastoise:9|Caterpie:10|Metapod:11|Butterfree:12|Weedle:13|Kakuna:14|Beedrill:15|Pidgey:16|Pidgeotto:17|Pidgeot:18|Rattata:19|Raticate:20|Spearow:21|Fearow:22|Ekans:23|Arbok:24|Pikachu:25|Raichu:26|Sandshrew:27|Sandslash:28|Nidoran♀:29|Nidorina:30|Nidoqueen:31|Nidoran♂:32|Nidorino:33|Nidoking:34|Clefairy:35|Clefable:36|Vulpix:37|Ninetales:38|Jigglypuff:39|Wigglytuff:40|Zubat:41|Golbat:42|Oddish:43|Gloom:44|Vileplume:45|Paras:46|Parasect:47|Venonat:48|Venomoth:49|Diglett:50|Dugtrio:51|Meowth:52|Persian:53|Psyduck:54|Golduck:55|Mankey:56|Primeape:57|Growlithe:58|Arcanine:59|Poliwag:60|Poliwhirl:61|Poliwrath:62|Abra:63|Kadabra:64|Alakazam:65|Machop:66|Machoke:67|Machamp:68|Bellsprout:69|Weepinbell:70|Victreebel:71|Tentacool:72|Tentacruel:73|Geodude:74|Graveler:75|Golem:76|Ponyta:77|Rapidash:78|Slowpoke:79|Slowbro:80|Magnemite:81|Magneton:82|Farfetch’d:83|Doduo:84|Dodrio:85|Seel:86|Dewgong:87|Grimer:88|Muk:89|Shellder:90|Cloyster:91|Gastly:92|Haunter:93|Gengar:94|Onix:95|Drowzee:96|Hypno:97|Krabby:98|Kingler:99|Voltorb:100|Electrode:101|Exeggcute:102|Exeggutor:103|Cubone:104|Marowak:105|Hitmonlee:106|Hitmonchan:107|Lickitung:108|Koffing:109|Weezing:110|Rhyhorn:111|Rhydon:112|Chansey:113|Tangela:114|Kangaskhan:115|Horsea:116|Seadra:117|Goldeen:118|Seaking:119|Staryu:120|Starmie:121|Mr. Mime:122|Scyther:123|Jynx:124|Electabuzz:125|Magmar:126|Pinsir:127|Tauros:128|Magikarp:129|Gyarados:130|Lapras:131|Ditto:132|Eevee:133|Vaporeon:134|Jolteon:135|Flareon:136|Porygon:137|Omanyte:138|Omastar:139|Kabuto:140|Kabutops:141|Aerodactyl:142|Snorlax:143|Articuno:144|Zapdos:145|Moltres:146|Dratini:147|Dragonair:148|Dragonite:149|Mewtwo:150|Mew:151|Chikorita:152|Bayleef:153|Meganium:154|Cyndaquil:155|Quilava:156|Typhlosion:157|Totodile:158|Croconaw:159|Feraligatr:160|Sentret:161|Furret:162|Hoothoot:163|Noctowl:164|Ledyba:165|Ledian:166|Spinarak:167|Ariados:168|Crobat:169|Chinchou:170|Lanturn:171|Pichu:172|Cleffa:173|Igglybuff:174|Togepi:175|Togetic:176|Natu:177|Xatu:178|Mareep:179|Flaaffy:180|Ampharos:181|Bellossom:182|Marill:183|Azumarill:184|Sudowoodo:185|Politoed:186|Hoppip:187|Skiploom:188|Jumpluff:189|Aipom:190|Sunkern:191|Sunflora:192|Yanma:193|Wooper:194|Quagsire:195|Espeon:196|Umbreon:197|Murkrow:198|Slowking:199|Misdreavus:200|Unown:201|Wobbuffet:202|Girafarig:203|Pineco:204|Forretress:205|Dunsparce:206|Gligar:207|Steelix:208|Snubbull:209|Granbull:210|Qwilfish:211|Scizor:212|Shuckle:213|Heracross:214|Sneasel:215|Teddiursa:216|Ursaring:217|Slugma:218|Magcargo:219|Swinub:220|Piloswine:221|Corsola:222|Remoraid:223|Octillery:224|Delibird:225|Mantine:226|Skarmory:227|Houndour:228|Houndoom:229|Kingdra:230|Phanpy:231|Donphan:232|Porygon2:233|Stantler:234|Smeargle:235|Tyrogue:236|Hitmontop:237|Smoochum:238|Elekid:239|Magby:240|Miltank:241|Blissey:242|Raikou:243|Entei:244|Suicune:245|Larvitar:246|Pupitar:247|Tyranitar:248|Lugia:249|Ho-oh:250|Celebi:251|Treecko:252|Grovyle:253|Sceptile:254|Torchic:255|Combusken:256|Blaziken:257|Mudkip:258|Marshtomp:259|Swampert:260|Poochyena:261|Mightyena:262|Zigzagoon:263|Linoone:264|Wurmple:265|Silcoon:266|Beautifly:267|Cascoon:268|Dustox:269|Lotad:270|Lombre:271|Ludicolo:272|Seedot:273|Nuzleaf:274|Shiftry:275|Taillow:276|Swellow:277|Wingull:278|Pelipper:279|Ralts:280|Kirlia:281|Gardevoir:282|Surskit:283|Masquerain:284|Shroomish:285|Breloom:286|Slakoth:287|Vigoroth:288|Slaking:289|Nincada:290|Ninjask:291|Shedinja:292|Whismur:293|Loudred:294|Exploud:295|Makuhita:296|Hariyama:297|Azurill:298|Nosepass:299|Skitty:300|Delcatty:301|Sableye:302|Mawile:303|Aron:304|Lairon:305|Aggron:306|Meditite:307|Medicham:308|Electrike:309|Manectric:310|Plusle:311|Minun:312|Volbeat:313|Illumise:314|Roselia:315|Gulpin:316|Swalot:317|Carvanha:318|Sharpedo:319|Wailmer:320|Wailord:321|Numel:322|Camerupt:323|Torkoal:324|Spoink:325|Grumpig:326|Spinda:327|Trapinch:328|Vibrava:329|Flygon:330|Cacnea:331|Cacturne:332|Swablu:333|Altaria:334|Zangoose:335|Seviper:336|Lunatone:337|Solrock:338|Barboach:339|Whiscash:340|Corphish:341|Crawdaunt:342|Baltoy:343|Claydol:344|Lileep:345|Cradily:346|Anorith:347|Armaldo:348|Feebas:349|Milotic:350|Castform:351|Kecleon:352|Shuppet:353|Banette:354|Duskull:355|Dusclops:356|Tropius:357|Chimecho:358|Absol:359|Wynaut:360|Snorunt:361|Glalie:362|Spheal:363|Sealeo:364|Walrein:365|Clamperl:366|Huntail:367|Gorebyss:368|Relicanth:369|Luvdisc:370|Bagon:371|Shelgon:372|Salamence:373|Beldum:374|Metang:375|Metagross:376|Regirock:377|Regice:378|Registeel:379|Latias:380|Latios:381|Kyogre:382|Groudon:383|Rayquaza:384|Jirachi:385|Deoxys:386|Turtwig:387|Grotle:388|Torterra:389|Chimchar:390|Monferno:391|Infernape:392|Piplup:393|Prinplup:394|Empoleon:395|Starly:396|Staravia:397|Staraptor:398|Bidoof:399|Bibarel:400|Kricketot:401|Kricketune:402|Shinx:403|Luxio:404|Luxray:405|Budew:406|Roserade:407|Cranidos:408|Rampardos:409|Shieldon:410|Bastiodon:411|Burmy:412|Wormadam_Plant:413|Mothim:414|Combee:415|Vespiquen:416|Pachirisu:417|Buizel:418|Floatzel:419|Cherubi:420|Cherrim:421|Shellos:422|Gastrodon:423|Ambipom:424|Drifloon:425|Drifblim:426|Buneary:427|Lopunny:428|Mismagius:429|Honchkrow:430|Glameow:431|Purugly:432|Chingling:433|Stunky:434|Skuntank:435|Bronzor:436|Bronzong:437|Bonsly:438|Mime Jr.:439|Happiny:440|Chatot:441|Spiritomb:442|Gible:443|Gabite:444|Garchomp:445|Munchlax:446|Riolu:447|Lucario:448|Hippopotas:449|Hippowdon:450|Skorupi:451|Drapion:452|Croagunk:453|Toxicroak:454|Carnivine:455|Finneon:456|Lumineon:457|Mantyke:458|Snover:459|Abomasnow:460|Weavile:461|Magnezone:462|Lickilicky:463|Rhyperior:464|Tangrowth:465|Electivire:466|Magmortar:467|Togekiss:468|Yanmega:469|Leafeon:470|Glaceon:471|Gliscor:472|Mamoswine:473|Porygon-Z:474|Gallade:475|Probopass:476|Dusknoir:477|Froslass:478|Rotom:479|Uxie:480|Mesprit:481|Azelf:482|Dialga:483|Palkia:484|Heatran:485|Regigigas:486|Giratina_Altered:487|Cresselia:488|Phione:489|Manaphy:490|Darkrai:491|Shaymin_Land:492|Arceus:493|Victini:494|Snivy:495|Servine:496|Serperior:497|Tepig:498|Pignite:499|Emboar:500|Oshawott:501|Dewott:502|Samurott:503|Patrat:504|Watchog:505|Lillipup:506|Herdier:507|Stoutland:508|Purrloin:509|Liepard:510|Pansage:511|Simisage:512|Pansear:513|Simisear:514|Panpour:515|Simipour:516|Munna:517|Musharna:518|Pidove:519|Tranquill:520|Unfezant:521|Blitzle:522|Zebstrika:523|Roggenrola:524|Boldore:525|Gigalith:526|Woobat:527|Swoobat:528|Drilbur:529|Excadrill:530|Audino:531|Timburr:532|Gurdurr:533|Conkeldurr:534|Tympole:535|Palpitoad:536|Seismitoad:537|Throh:538|Sawk:539|Sewaddle:540|Swadloon:541|Leavanny:542|Venipede:543|Whirlipede:544|Scolipede:545|Cottonee:546|Whimsicott:547|Petilil:548|Lilligant:549|Basculin_Red:550|Sandile:551|Krokorok:552|Krookodile:553|Darumaka:554|Darmanitan:555|Maractus:556|Dwebble:557|Crustle:558|Scraggy:559|Scrafty:560|Sigilyph:561|Yamask:562|Cofagrigus:563|Tirtouga:564|Carracosta:565|Archen:566|Archeops:567|Trubbish:568|Garbodor:569|Zorua:570|Zoroark:571|Minccino:572|Cinccino:573|Gothita:574|Gothorita:575|Gothitelle:576|Solosis:577|Duosion:578|Reuniclus:579|Ducklett:580|Swanna:581|Vanillite:582|Vanillish:583|Vanilluxe:584|Deerling:585|Sawsbuck:586|Emolga:587|Karrablast:588|Escavalier:589|Foongus:590|Amoonguss:591|Frillish:592|Jellicent:593|Alomomola:594|Joltik:595|Galvantula:596|Ferroseed:597|Ferrothorn:598|Klink:599|Klang:600|Klinklang:601|Tynamo:602|Eelektrik:603|Eelektross:604|Elgyem:605|Beheeyem:606|Litwick:607|Lampent:608|Chandelure:609|Axew:610|Fraxure:611|Haxorus:612|Cubchoo:613|Beartic:614|Cryogonal:615|Shelmet:616|Accelgor:617|Stunfisk:618|Mienfoo:619|Mienshao:620|Druddigon:621|Golett:622|Golurk:623|Pawniard:624|Bisharp:625|Bouffalant:626|Rufflet:627|Braviary:628|Vullaby:629|Mandibuzz:630|Heatmor:631|Durant:632|Deino:633|Zweilous:634|Hydreigon:635|Larvesta:636|Volcarona:637|Cobalion:638|Terrakion:639|Virizion:640|Tornadus:641|Thundurus:642|Reshiram:643|Zekrom:644|Landorus:645|Kyurem:646|Keldeo_Ordinary:647|Meloetta_Aria:648|Genesect:649|Chespin:650|Quilladin:651|Chesnaught:652|Fennekin:653|Braixen:654|Delphox:655|Froakie:656|Frogadier:657|Greninja:658|Bunnelby:659|Diggersby:660|Fletchling:661|Fletchinder:662|Talonflame:663|Scatterbug:664|Spewpa:665|Vivillon:666|Litleo:667|Pyroar:668|Flabébé:669|Floette:670|Florges:671|Skiddo:672|Gogoat:673|Pancham:674|Pangoro:675|Furfrou:676|Espurr:677|Meowstic:678|Honedge:679|Doublade:680|Aegislash:681|Spritzee:682|Aromatisse:683|Swirlix:684|Slurpuff:685|Inkay:686|Malamar:687|Binacle:688|Barbaracle:689|Skrelp:690|Dragalge:691|Clauncher:692|Clawitzer:693|Helioptile:694|Heliolisk:695|Tyrunt:696|Tyrantrum:697|Amaura:698|Aurorus:699|Sylveon:700|Hawlucha:701|Dedenne:702|Carbink:703|Goomy:704|Sliggoo:705|Goodra:706|Klefki:707|Phantump:708|Trevenant:709|Pumpkaboo_Average:710|Gourgeist_Average:711|Bergmite:712|Avalugg:713|Noibat:714|Noivern:715|Xerneas:716|Yveltal:717|Zygarde:718|Deoxys-Attack:386.1|Deoxys-Defense:386.2|Deoxys-Speed:386.3|Wormadam-Sandy:413.1|Wormadam-Trash:413.2|Shaymin-Sky:492.1|Giratina-Origin:487.1|Rotom-Heat:479.1|Rotom-Wash:479.2|Rotom-Frost:479.3|Rotom-Fan:479.4|Rotom-Mow:479.5|Castform-Sun:351.1|Castform-Rain:351.2|Castform-Snow:351.3|Basculin-Blue-Stripe:550.1|Darmanitan-Zen:555.1|Meloetta-Pirouette:648.1|Kyurem-White:646.1|Kyurem-Black:646.2|Keldeo-Resolute:647.1|Tornadus-Therian:641.1|Thundurus-Therian:642.1|Landorus-Therian:645.1|Meowstic-F:678.1|Aegislash-Blade:681.1|Pumpkaboo-Small:710.1|Pumpkaboo-Large:710.2|Pumpkaboo-Super:710.3|Gourgeist-Small:711.1|Gourgeist-Large:711.2|Gourgeist-Super:711.3|Venusaur-Mega:3.1|Charizard-Mega-X:6.1|Charizard-Mega-Y:6.2|Blastoise-Mega:9.1|Alakazam-Mega:65.1|Gengar-Mega:94.1|Kangaskhan-Mega:115.1|Pinsir-Mega:127.1|Gyarados-Mega:130.1|Aerodactyl-Mega:142.1|Mewtwo-Mega X:150.1|Mewtwo-Mega Y:150.2|Ampharos-Mega:181.1|Scizor-Mega:212.1|Heracross-Mega:214.1|Houndoom-Mega:229.1|Tyranitar-Mega:248.1|Blaziken-Mega:257.1|Gardevoir-Mega:282.1|Mawile-Mega:303.1|Aggron-Mega:306.1|Medicham-Mega:308.1|Manectric-Mega:310.1|Banette-Mega:354.1|Absol-Mega:359.1|Garchomp-Mega:445.1|Lucario-Mega:448.1|Abomasnow-Mega:460.1';

//Compressed Pokemon data: HP/ATK/DEF/SP.ATK/SP.DEF/SPD/Type1/Type2/Egg1/Egg2/EPs2/EPs1 - national order + forms
pkmn='            Dηη//D-+"4 "&[M55&-+"4 #5Ηe995-+"4 6ΜΚc&(/??";= U=U5/5??";="bνb}19?*"; +RL/(=c!!"*J rM5/5U!!"*J$ne91>b!!"* ID7:FFD66++" (F3BB766++K &D(05)6*++ 68:7FF(6+++= DB(BB:6+++K /08D5<6+++,$8D8::h *$$= M&3((o *$$A e5<))ψ *$$ε 7h:B:G  ##= 3u&()ο  ##A 8&7ΟΟ) *$$= /0/jj9 *$$A :&R8y3++#;$ &1l/n5++#;, :38((0II#6A &0305TII#6ε (<1F78$$##J <9TD3/$$##K 3ιΚ88z++"#" )[V33h++..* 0SΞ<1_+$..+ ρx888(++"#$ jGx33/++"#, uά|1<1+$"#I )DL&/:OO66* 2)~20&OO66+ τz8(//??##= ~_<u99??##=$PDFDBF O66* C)D1(D O66+ 8D:783+*$$= <5)/<0+*$$A D(3</7-+44 "&/)1<8-+44 *<51T0(-+44 +:)3D3B6-+4$ &25&576-+4Ε &3(83D6+++ $)/&0<06+++="!3B:D2$$##= :5(()@$$##A 8D:880  ##= /)&//P  ##A (ΚL/(3!!*# "5Ηb251!!*# *85::D)""##$ />&&)2""##, 3)D)(&??##$ 0T5952??##, 8(8880!!**= ///((0!!**A 022)0)!"**L BF.>30EE,, "8:7@)>EE,, *3(DZ2@EE,, +)5(:::"",,$ 59)(&D"",,, 0X5/13"",,I (<:)78-+44$ /0(1D3-+44, 5>/9))-+44I 88:(9)!+?? $5)/5@9!+?? ,85977F#$!!J 32PDD:#$!!K 5@X3/D#$!!L (13//0??##= /9)55>??##A 0//88.!E"*" 2<T957!E"*K B:)23DI,!! "(&2@))I,!! *Κ/3U[& *$#$ :1D::< *$$$ &T)&&9 *$$, /D3D)D!!*# $0)5)2)!;*# ,55(8(B++--" >></9(++--# 7/9DB8!!??J (2Ν1D)!;??K 7:79:54+-- "D(DP324+-- *&/&X<T4+-- +:Dd7D)#$!!J &LDc0tEE,, $1~)~PVEE,, ,7>0BB(!!??$ 3XP((<!!??, 87(339II!!= &()55CII!!A &85&D8-E44J 221Q/3-E44 *((28(:$$""J &5T(5D$$""K (@p:TΞ"",,, (>n:T_"",, ,03<&<7  ""* 8/2&D:++--J /0@1)&++--K 51277B$#"#J >X@DD8$#"#, à##:>(  66* /3P98&--44J >25850  ""* 78))B&!!*; "3/22D1!!*;J"DV&:(M!!II$ 5S//5^!!II, 7D3)31!!??= &<191P!E??A 8D/9@0EO,, ,)T535>6*++$ /(:P22;E,, */ex21>II,,A /2x91k??,, */Q93)166++, <928)T  ##^ F!3.F5!!I;= 2Qn&9u!*I;, X1512&!;"** LLLLLL  EE" 33(D/3  ## $X/&T2/!!##* //&T2XII##A /X&2T/??##, /&)1<8  !! ":8903:#!*?J )&QP)3#!*?K 7503D3#!*?J &P>/)5#!*?, 5>/&<X#*$$A dT//T7  ""* 0192Q1;*.. I001Q09I*.. +090Q10?*.. +z=D(((..*;$ jν/)))..*;, vώ2995.**;I qT0{0XEE.. +999999EE..+ Dη/η/D--"4 $&[5M5&--"4J$5Η9e95--"4J,ΜΚc&(/??##= U=U5/5??##="bνb}19??## +(/=RLc!!"*$ /55rMU!!"*F 1>9neb!!"*Ε :ρς:DF  ##$ 1_=D30  ##A &77χh( *$$" 9((_ύ) *$$* 8F78536*++ $3:(3T16*++ ,8&88876+++$ )0)&&86+++, 105)5X+*$$ε <ττhhV!III" QUU__V!III* F8.::&II..= (BΛD3.OO.. $07.8F. O.." :F/8/FOO.. $3815>8O*$6 ,8(D)D)E*$$ "/<)2)2E*$$="388/D:II"# ")335&DII"# *0<1P03II"# +<5209(--44 I)F(F(8!O*6* 9(5&5(!O*6+ )9P7/7##!!K 0<<09)!!** I::8:3(-*64 $3D(D/5-*64A <3)32T-*64ε 3)3831  ##= 777777--44 "<<3>17--44 *//D<D26*++= 3DDBB.!$*#" 211//:!$*#* //&X2TEE## *2/T&X/JJ## ,&1t1tvJ*$$= 2<59T7!E"* I&&&11144-- $LGLGLLEE..$"βΩUΩUΩEE--* )5/0/1 E## *(/0::.66++J <0C&&86,++K 9))//D  ##" /<>:/1$*++J <1ό3/7,$!!K &5(887OO#6$ 0@<&&DOO#6, /2<331!+II$ )X935/6,++, F!m!m#6#++J$5Q<8216"++, 323:<PJ;##= &5(((8  ##$ 0X<<<3  ##, 888)8F??-- "((@557?#--K ((877(;$##$ 995&&(;$### 331/1:!#*?J$:/:/:/!!*I "<><><D!!*I$"D3D/D<;**#= /8)5C)!*** ,/5C8)),*$$K D&75(/J?## "<0(T52J?## *<22221!.*;$#0&&888$$##" 0@@&&($$##F 150>2&  !! *~2[1/1  ##$ 3F:FD<  ##= ::::::""..$ (22:T)"",, ,D7.1//;E.. "DMΓ/32II..= D<Γ)3e??..= 25>8)9  ##K ä!!<Z3  66+ 01<P9PII..A"PP10<9??..? 9<P0P1!!..J,(=(D(z#$""$ )ν)/)ω#$"", 9ώT29j#J""I q0X0{TE*.. IqX0T{0?*.. I999999E-..+ 8D:/3)--";= (/D1/2--";A )1/>1@--";ε D&8)(D??## "&1&1&3?"##$"5@)T)5?"##I ()(((8!!"*$ )1)&)(!$"*, 9T010&!$"*I :3:77:JJ##$ )0)&&)JJ##, τ7z7z&  ##= b)j(j9  ##A DD:F7F66++" (:3BB.66++K &)(9(/6*++ +(:3BB.66++K &()(0/6+++ I8778(7!-*4 $&((&)(!-*4 ,5))09)!-*4 I88(777--#4J ))8&8&-J#4, 09&0&5-J#4I 837771 *$$= &1&((Q *$$A 877371!**$= &(91)/!**$K ΛBBD:8EO-- "τ::/3(EO-- *^//QP5EO-- +87K(Κ/6!*+= )&[5Η&6**+ #&8&8&:--64" &X5&&)-"64, &&&::7  ##" 555330  ##A ad92/9  ##+ ΟD07786$++J j0D((d6*++A "0D77864!!* =ωΥωΥΛ  "#" νococL  "#* θvMv~^  "#+ G&7F7B"",," ã@&8&("",,* (F8F8F O.." 7DZD07##!!J (DD::(  #6= )//33)  #6/ (<<//(J4,,F (1133(,O#6F ()9887,#""J &0C((8,#""K )TΝ&&(,#""L 78383&"E,,= &&<&<5"E,,A 8D8/8/II##= )<&>&>II##A &(81<2II66= &8(<12II66= /~3ι<166+,= /ι3~<166+,= (&D95/-+64 *)cpcp8++--" 9~e~e3++--* D0F/F/!JII$ )@8282!JII, X):):&!!#I" g0D0D&!!#I* &&8/D:?$## ")9)><8?$##$")1C1)F??##K &B:)5&EE## $5D/0T5EE## ,&&&&&&  #, "D9DDD!$$++$ ()((()$.++^ 595559$.++H (1818:--4, ")P&P&3-J4,$"D8&8<( *$; $<)0)>5.*$; ,~P&&&0  ##, ~9&9&/++#;$")3/21)#E!! *)213/)#E!!, (Lcρz&!$II" Tb~_o&!$II* c5/(::!!*?$ M@1033!J*?, 8838)3$E!! $&)>)@<$E!! ,fz|jΞΥ#-?? $Yuοuγc#-?? ,D2(8(<#6??$ <Q9)5D#6??, F.F!35!!*;= 2&n9Qu!!*; ,))))))  6-" &0)&@8  ## $R<:MΩD44--$ =P/eM/44--, F8070B44-- $8)X&XB44--J$λ^eGΞω-*"4* /()25/EE-- #/X&<&<JJ##, 2ΥLΥLΥEE.." ((((((;;6!" 555555;;6!* )8(3(B;!*#" 0&)<)D;!*#* T5020/;!*#+ :=1α3K!!**J 3θ>Α<Κ!!**F 3ν>Φ<Κ!!** *90XD/3!#*IO c738/ο!!II= D<&87(..;;$ /29&((..;;K 2Z5T59.*;;I 835:&7,E!!J &<935(,E!!K 5ZX20),E!!L 59ό(9(##..L 5(99ό(;;.. I5<a<a(,,..K$550TXT.E.. I505XTT.E.. +990aC0!!.. +9aC900$$..I >a0a02.*..,"999999,E..+ (a(a(aEE..^"3^=D3Ο--"4$ <υ13/χ--"4F 2}><1h-$"4Ε RURURj??#,= =bΚbΚu?"#,="_θoθo`?"#,^"pωpjh8!!*# "=f^u_(!!*# *νYWσψ&!,*# +83777& *$$= 3<(885 *$$A 1@)(&9 *$$I rD8:8Ο  *#" n1&3&o !*#, ΓBzBzB66++J |1ω3ω/66++, D/ς8ςDII##$ &1η&η&II##, 5@n2n)II##I 87:()3-+.. "&)/Q>0-+64 +VQ877U##""$ οi&/(U##"", 7tΘtW7#,""J &Κϋιâ7#,""K 8έDέDχ66++ $&r1n>χ6-++ ,)Α(Α(f6*++$"77t7t)6*++= )5ά5ά86*++J$&D)D02II#6= 3/:&71!!*#= 1>31(P!!*#A D:D[p:--64 ")&)Ξb1--64 *_LLx[ς!!*-" σe^SΗΜ!$*-* <9f&fP  ##A 0(ς&R)4*--" a5R0y54*--* 3fRRh1  #,= /_νyύ>  #,A &&&>>>44-- #9QΚ>ΚoJ*$$, η3ttΓ1  ##= oΗ==rN  ##A D7(/(DEE.. "MMιzzα+J##= %kVojν+J##* xΕYΕYΥ,E!!J VυΨnΨΩ,E!!J$(52!D!##..J FBD)0&EO.. $9##./7  .." _/DStv *$$$ (S`S`:4J--J$U)D8Dt.$";$ ^0/(3Η.$";, `X251ά.$";I Z1881#  .." 8)8:8&""..$ )T)P)0",#,$"^GbτtK$$##J `NΘ^Gι$$##K 8(073/+6+?J )0T&<2+J+?K Lj8j8(+",,$ eq/Y/1+",,, α9G0Gρ--44, ηηhηjf!!II= ll_lYv!!IIA DF(&@(!*.. $&[([&8-;"4$ 0S<S1&-;"4$")@/D1QJ;##^ ))PX0&I,!! +T1252(  ""+ PCX338$#"#I 99QT((--44K <δV212II,,I <2VQ2e??,, +1(2@P5O*$6 6Y_YΨh26*++, /TX&/2--##K /&TX2/;;## *<2QD<2$*++K TX5)&5;$##I 15)Z<0  !! +^Q//P5E"--I &3]<a8#,!!J,D9Z/ZD44--J,)5)5)T;46!A ((|2|vI4--="<<X<X2EE..K$5>>>>5EE..$#<Q)Q)PEE..,"9@@a90,... +0@9a@9!... +v0qXq|?,.. +TdT5T9  ..I a9@9@04...+ @)@<X1EE.. I555555!!*6" 999999!!*6+ )00Z0QJJ..=*999999--..+ @@@@@@  ..+ 999999E?..+ DD3D3M--#4= &&<&<e--#4A <<2<2Σ--#4ε /MDDDD??##" 0k3)33?"##, Tδ/9//?"##I 33DMDD!!## "<<&e&&!!## *291`))!!## +D3Μ:Μt  ##$ &1l&l|  ##, D&DBD3  ##$ /5/:/&  ##, 1T0D05  ##I z(Γ(ΓfJJ##= =W(W(qJJ##A (pLpL=--##= <φMφMψ--##A (pLpL=??##= <φMφMψ??##A (pLpL=!!##= <φMφMψ!!##A _BDV3ΕEE##" Ψ31γ2έEE##* (3(χ7c *$$$ [|[(t/ *$$, 5P5/3k *$$I D&K(K_II##= <9M5MΨII##A 3<1BB.##!!J )>>(8F##!!F 1ZX&5B##!!I 3Dc3cGE*#$= Vx3|3ΦE*#$A &187D^$$##$ TZ&(/W$,##, %&Y&Y(  66* <53B::"",,$ 1>18(8"",,, >C23/D"",,I ((8(8=!!**= </3/3l!$*** >2<1<α!$**+ @9171D"",,* <Q<7<1"",,, Dp)8&t6-++J 3M0(5t6-++K <%5)5S6-++I 7Dr7Μx6+++J 83λ8nι6+++K &9υ3lN6+++ε 8ή&Γ(f-O46= &V1|<Ψ-O46A D:()(7--44 ")&<T<0--44 *)S/53φ!!IIA (G:::/$J##$ &ΗDDDα$J##, 2Ρ5/)S$J##I )0D.D(??##$ >C3732??##, <YVqV&--44 *(/1::36#+!J )2Q/<D6#+!K (<):)LJ"#;$ /0PDPUJ"#;J$GU5%5οE*$$ *τ713/744!-J U(]2>744!-K yb%pDϊ!#*?J α`áe/K!#*?K 3NDαD)#*$?$ <C/N/T#*$?, (([8[/++!!= 52Η&Η<++!!, 8/858/JJ## "&>&@&>JJ## *3(888<  ##= <2&/&P  ##A D7(3/DEE,, $&D)<13EE,, ,)322T/EE,, ID78>(FEE-- "/8(Q&7EE-- *T/<Q17EE-- +[R(R(3!**$" <ΞMΞMφ!**$A χ((/&R;;!! "ω//5<r;;!! *o21T2n;;!! +&&(8(< -##= 59)&)2 -##, 3<&<&%I*##A (<D8D&66++$ )Z>&>F6,++, l3D33.-+44" Φ1)157-+44* 38(/18!4-- $9&)1>&!4-- ,i<58D/!!*I* (ι(x(/6I++= )|&ο&`6I++A R(vΕY!-,4!J αΑΔyΨF-,4!K 83)D&7,,!!J &52)1(,,!!K &9P)10,,!!L :38D8&II--= /1)<)8II--, 1P5>5(II--I 333137EE,, "<<<Q28EE,, *(73/3F4?-- "&8&2&34?-- *&30]054?-- +ρΞ&78x..";$ fΡ)8(V..";, _ΐ0&)ο..";I 3)8&88;;##$ 2T5)5(;;##, )(72Z>;;!! ,(818/B66++J 5)89&]66++A }fνuλK$I*-* D1(3(/""#,$ /Q&2&>""#,, |@0&0L..;", rα(:(:$4!!$ υί5353$4!!, D1)88&J,,,$ /Q9&))J,,,, 2T2823  ##, )e(Γ(& *$$$ 9δ<x<5 *$$, )3<D/&J*$$J T/>325J*$$ *1οf>f/??## *U}NLL}6,++K Κ/(D(τJ.;;$ G1)/)UJ.;;, S>0Q0φJ.;; +313(3&6?++$ 1&/Z>96?++ +v0Β0G`,"..L vΒ0G0`#"..I v0G0Β`-".. InP)Q5σ**..I nP)Q5σI*..I 9@9a@0.?.. +9a@@90.I..I υQ0P5ψ$*.. +QX0X02.;..#"vG0Β0`!".. +9||AA0 E..=#o@2@2λ6,..^"hj/LDτ--##J jb2hUx--##K Wγμα<=-"##L 8D8[&&??## "rrU0)~??## *<lGΦ9θ?E## +zh8[Ro!!**= yMΚehο!!**A G2V%oμ!J**ε τχτKχx  ##= 1h|(|b $##* D(c8τ[ *$$= [~3hΚν?*$$= buoαlΠ?*$$A τ:8ήB:66++J Dϊ&ή7έ66++J 5Κ(0(υ6*++J [(U~yG? ## "Y^G}fq? ## *RτΜjntOO66 $yDι<φΚOO66 ,b/^N{<OO66 If/L[xΚ--##" δ9[οu^--##* VΗ[ρLc""#,$ 2ίbloU"J#,, <5&/0ά  ## $[LyM&^EE##= αL_euθEE##A D59:ΓΛ,4!!K rTaDη:,4!!K &(a(a&,4!!L bΚ&M/ΥOO66" ψGGλυέOO66* [LfrxηOO66J Η5Y1<GOO66K pypΓρDJE*I$ YSW^<~JE*I$ tΚVΜh(#!??$ G>PyY^#!??, (&&&&7+!*; "/<0οδR+.*; *(p[UMR!!*? "o~W@υr!!*? "RτΩjc)I ";= [3Κ}Α}I ";A Uυ|DDL#.";$ ΗΖΧlro#.";I |r(VMρ#;""" δ|GλSU#;""* 2//TX&OO## ,bS<αMΘ"*,,, VUxuVψIO#6A ((a(a(#O6!J$D(:3<8..;; $^<peΣ&..;; ,09)Ta5..;; Ix5v5Ξ<,O!!J c)L(&τ4-4-$ 1T_/Ηh4-4-, ηf)R3ω4---J /0μU<ν4---K 3l1K:Λ;;""J 2ΡΤRρΛ;;""K 87:D83*.$$= 1)5ο5δ*.$$A ΠΔ2ΔφλOO..+ ΠΔ2ΔφλJ*..+ `9Ζu22.$..+                                     (ΝFΝFaEE..,"()d)d0EE..K$(2020ΝEE..ε &n>r1χ6$++K &l2l2χ6,++J$9%<@<Ι-*..ε a@9@904...+ (/γ>γYI?--="(/γ>γYI!--="(/γ>γYI;--="(/γ>γYI*--="(/γ>γYI---="))))))??6-" ))))))!!6-" ))))));;6-" )S/53φ!!IIA >7>C>3?E## *9A0||A "..ν Q@0g92.;.. +Qg9@02.;..I vG0Β0`!".. +n95T0Ζ**..ε n>)]5ψI*.. +υ]0>5v$*..I αL_euθEE##A &a(a(&,4!!L Rf)R3h4---J yf)R3ρ4---J rf)R3z4---J 31μU<λ4---J <2μU<l4---J 19μU<y4---J 59δμ@5-+"4 6bXσX19?."; +bθbπP9?*"; +n%@ZPb!!"* I3(/ξ2aEE,, +&/5g2X4+-- +>Q9&99  ""* /ζ@/0>6*++, 2ζ})Xu!JI;, 5Z1)2a#*$$A qβ9{9XE".. +qa)κ@CEE.. +02>iTDI."# +)aC/9<6,++, 5wP8><6"++, <00C0PJ?## *9sa2@o#J""I 5d5X59?"##I ^1/iZ9EO-- +(>Q32(,O#6F )Cm&5(,,""L &91519"E,,A )<5Z5ZII##A =i<ke<44--, /a&P&PJJ##, 59@CaT.E.. I5X9d@T.E.. +`gP@2S.$";I )]WC)N",#,$"0H>H>7-;"4$"';
//Decompression Arrays
pk='00,0a,01,05,04,3c,32,46,02,03,08,0b,0f,41,5a,55,5f,37,07,50,06,1e,28,64,23,0e,4b,40,69,09,78,80,19,8c,2d,0d,14,48,84,0c,10,20,30,3f,70,11,73,7d,2c,5c,6e,3a,43,58,82,56,87,3e,91,44,4c,6c,96,4e,2b,a0,53,42,aa,38,a5,3d,5d,45,e6,4f,47,35,6a,3b,a4,2a,51,5b,b9,39,36,29,9a,4d,6d,49,67,4a,be,6b,7b,c0,9b,31,68,2f,c2,63,7a,54,af,61,9f,2e,6f,26,59,62,24,65,33,5e,81,25,83,18,79,52,76,7f,34,1c,27,b4,57,1f,7e,75,71,b8,17,72,77,74,21,22,66,1d,1b,7c,c8,60,86,16,a8,93,fa,85,8a,90,ff'; pk=pk.split(',');
mn=' !"#$&()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[]^_`abcdefghijklmnopqrstuvwxyz{|}~%αβγδεζηθικλμνξοπρστυφχψωΑΒΓΔΕΖΗΘΙΚΛΜΝΞΟΠΡΣΤΥΦΧΨΩςάέήίόύώϊϋΐàáâãä'; mn=mn.split(''); base=[];

forms = {386.1:722,386.2:723,386.3:724,413.1:725,413.2:726,492.1:727,487.1:728,479.1:729,479.2:730,479.3:731,479.4:732,479.5:733,351.1:734,351.2:735,351.3:736,550.1:737,555.1:738,648.1:739,646.1:740,646.2:741,647.1:742,641.1:743,642.1:744,645.1:745,678.1:746,681.1:747,710.1:748,710.2:749,710.3:750,711.1:751,711.2:752,711.3:753,3.1:754,6.1:755,6.2:756,9.1:757,65.1:758,94.1:759,115.1:760,127.1:761,130.1:762,142.1:763,150.1:764,150.2:765,181.1:766,212.1:767,214.1:768,229.1:769,248.1:770,257.1:771,282.1:772,303.1:773,306.1:774,308.1:775,310.1:776,354.1:777,359.1:778,445.1:779,448.1:782,460.1:783};

function get_base(p,s) { //Returns values from pkmn
	if (p.indexOf('.') > -1) {
		p = forms[p];
	}
	if (!base[p]) {
		base[p]=pkmn.slice(12*p,12*p+12).split('').map(function(v,i){v=pk[mn.indexOf(v)];if(i<10)v=parseInt(v,16);return v});
		base[p].push(('000000000000000'+parseInt(base[p].pop()+''+base[p].pop(),16).toString(2)).split('').reverse().join('').substr(0,12).split('').reverse().join('').match(new RegExp(".{1,"+2+"}", "g")).reverse().map(function (v) { return parseInt(v,2); }));
		base[p][10].push(base[p][10].splice(3,1)[0]);
	}
	return base[p][s];
}

//Add a custom Pokemon by modifying and un-commenting the following lines.
//Format is HP,ATK,DEF,SP.ATK,SP.DEF,SPD,Type1,Type2,Egg1,Egg2,[HP EPs,ATK EPs,DEF EPs,SP.ATK EPs,SP.DEF EPs,SPD EPs]
/*
pkmns = pkmns+'|Bulbasaur:1';
base[1] = [45, 49, 49, 65, 65, 45, 12, 3, 1, 7,[0, 0, 0, 1, 0, 0]];
*/
base[779] = [108, 170, 115, 120, 95, 92, 15, 4, 1, 14,[0, 3, 0, 0, 0, 0]];

//ATK/DEF/SP.ATK/SP.DEF/SPD / Bashful 1, Docile 2, Hardy 3, Serious 4, Quirky 5, Bold 6, Modest 7, Calm 8, Timid 9, Lonely 10, Mild 11, Gentle 12, Hasty 13, Adamant 14, Impish 15, Careful 16, Jolly 17, Naughty 18, Lax 19, Rash 20, Naive 21, Brave 22, Relaxed 23, Quiet 24, Sassy 25
natures = [[],[1,1,1,1,1],[1,1,1,1,1],[1,1,1,1,1],[1,1,1,1,1],[1,1,1,1,1],[0.9,1.1,1,1,1],[0.9,1,1.1,1,1],[0.9,1,1,1.1,1],[0.9,1,1,1,1.1],[1.1,0.9,1,1,1],[1,0.9,1.1,1,1],[1,0.9,1,1.1,1],[1,0.9,1,1,1.1],[1.1,1,0.9,1,1],[1,1.1,0.9,1,1],[1,1,0.9,1.1,1],[1,1,0.9,1,1.1],[1.1,1,1,0.9,1],[1,1.1,1,0.9,1],[1,1,1.1,0.9,1],[1,1,1,0.9,1.1],[1.1,1,1,1,0.9],[1,1.1,1,1,0.9],[1,1,1.1,1,0.9],[1,1,1,1.1,0.9]];
natures[-1] = [1,1,1,1,1]; //neutral
natures['max'] = [1.1,1.1,1.1,1.1,1.1]; //all max
natures['min'] = [0.9,0.9,0.9,0.9,0.9]; //all max

//Type affinity no fg fl po gu ro bu gh st fi wa gs el ps ic dr da fa
damage = [[1,1,1,1,1,0.5,1,0,0.5,1,1,1,1,1,1,1,1,1],[2,1,0.5,0.5,1,2,0.5,0,2,1,1,1,1,0.5,2,1,2,0.5],[1,2,1,1,1,0.5,2,1,0.5,1,1,2,0.5,1,1,1,1,1],[1,1,1,0.5,0.5,0.5,1,0.5,0,1,1,2,1,1,1,1,1,2],[1,1,0,2,1,2,0.5,1,2,2,1,0.5,2,1,1,1,1,1],[1,0.5,2,1,0.5,1,2,1,0.5,2,1,1,1,1,2,1,1,1],[1,0.5,0.5,0.5,1,1,1,0.5,0.5,0.5,1,2,1,2,1,1,2,0.5],[0,1,1,1,1,1,1,2,1,1,1,1,1,2,1,1,0.5,1],[1,1,1,1,1,2,1,1,0.5,0.5,0.5,1,0.5,1,2,1,1,2],[1,1,1,1,1,0.5,2,1,2,0.5,0.5,2,1,1,2,0.5,1,1],[1,1,1,1,2,2,1,1,1,2,0.5,0.5,1,1,1,0.5,1,1],[1,1,0.5,0.5,2,2,0.5,1,0.5,0.5,2,0.5,1,1,1,0.5,1,1],[1,1,2,1,0,1,1,1,1,1,2,0.5,0.5,1,1,0.5,1,1],[1,2,1,2,1,1,1,1,0.5,1,1,1,1,0.5,1,1,0,1],[1,1,2,1,2,1,1,1,0.5,0.5,0.5,2,1,1,0.5,2,1,1],[1,1,1,1,1,1,1,1,0.5,1,1,1,1,1,1,2,1,0],[1,0.5,1,1,1,1,1,2,1,1,1,1,1,2,1,1,0.5,0.5],[1,2,1,0.5,1,1,1,1,0.5,0.5,1,1,1,1,1,2,2,1]];

ivr = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];

stats = ['HP','Attack','Defense','Sp.Attack','Sp.Defense','Speed','&mdash;'];
types = ['Normal','Fighting','Flying','Poison','Ground','Rock','Bug','Ghost','Steel','Fire','Water','Grass','Electric','Psychic','Ice','Dragon','Dark','Fairy'];
eggs = ['???','Monster','Water1','Bug','Flying','Ground','Fairy','Plant','Humanshape','Water3','Mineral','Indeterminate','Water2','Ditto','Dragon','No Eggs'];
typeshp = ['Fighting','Flying','Poison','Ground','Rock','Bug','Ghost','Steel','Fire','Water','Grass','Electric','Psychic','Ice','Dragon','Dark'];
hps = ['0,1,2,3,4','5,6,7,8','9,10,11,12','13,14,15,16','17,18,19,20','21,22,23,24,25','26,27,28,29','30,31,32,33','34,35,36,37','38,39,40,41','42,43,44,45,46','47,48,49,50','51,52,53,54','55,56,57,58','59,60,61,62','63']; //possible Hidden Power "types"


/* UI specific functions */
function get_text(id,n) { //Returns text associated with n value from id (<select/>)
	var a = $(id).value;
	$(id).value = n;
	var b = $(id).options[$(id).selectedIndex].text;
	$(id).value = a;
	return b;
}

pkmns=pkmns.split('|');
pkmns.sort(); //Sort names alphabetically
function pop_species() { //Populates the species list
	var a = document.createDocumentFragment();
	var i=0,j=pkmns.length; do {
		var b = pkmns[i].split(':');
		var c = el_add(a,"option",{value:b[1]},b[0]);
		if ((forms[b[1]] > 649 && forms[b[1]] < 718) || forms[b[1]] > 746) { c.className = 'new'; } //show new species
		i++;
	} while (i<j);
	$('species').appendChild(a);
}

online = 0; //global- online status
function online_check() { //Checks if there's an internet connection alive
	if (navigator.onLine) {
		if (online == 1) { return true; }
		online = 1;
		add_sprite();
		//Version Check - DO NOT change the following
		$('version').innerHTML = '<a href="http://www.legendarypokemon.net/ivcalcxy.html"><img id="verchk" alt=""/></a><span class="error">Ø</span> <strong>There is a <a href="http://www.legendarypokemon.net/ivcalcxy.html">newer version</a> available!</strong>';
		var verchk = $('verchk');
		verchk.src = 'http://www.legendarypokemon.net/ivcalcxy_1.png?p='+ Math.floor(Math.random( )*100);
		verchk.onload = function() { if (verchk.width==1) { $('version').innerHTML = '<span class="ok">OK!</span> You are using the latest version!'; } }
	}
	else { $('version').innerHTML =  '<span class="error">Ø</span> Browser is <strong>offline</strong>! Unable to check for updates.'; }
}

themes = ['isotope','spp','simplex']; //define your own themes here, feel free to edit this
themed = themes.indexOf('spp'); //global- set default theme here
theme = (!cookie_read('theme')?themed:cookie_read('theme'));
function toggle_theme() {
	$('calculator').className = themes[theme];
	display_status('The active theme has been changed to "'+themes[theme]+'".<br/><span class="btn btn-primary btn-sm" onclick="toggle_simple();">Simplify?</span>');	
	if (theme == -1 && (navigator.userAgent.indexOf('MSIE ') == -1)) {
		display_status('The active theme has been changed to "Colorize".<br/>Select Hue, Saturation and Brightness:');	
		var c = cookie_read('color') || 'd';
		if (c.charAt(0) == ',') {
			c = c.split(',');
			thema(c[1],c[2],c[3]);
		}
		$('status').innerHTML += '<br/><br/><input id="hue" type="range" min="0" max="360" value="150" />';
		$('status').innerHTML += '<br/><input id="sat" type="range" min="0" max="100" value="4" />';
		$('status').innerHTML += '<br/><input id="lit" type="range" min="0" max="100" value="74" />';
		event_add($('hue'),"change", function () {  thema($('hue').value,$('sat').value,$('lit').value); });
		event_add($('sat'),"change", function () {  thema($('hue').value,$('sat').value,$('lit').value); });
		event_add($('lit'),"change", function () {  thema($('hue').value,$('sat').value,$('lit').value); });
		event_add($('hue'),"keyup", function (evt) {  vv(this.id,0,360,evt); thema($('hue').value,$('sat').value,$('lit').value); });
		event_add($('sat'),"keyup", function (evt) {  vv(this.id,0,100,evt); thema($('hue').value,$('sat').value,$('lit').value); });
		event_add($('lit'),"keyup", function (evt) {  vv(this.id,0,100,evt); thema($('hue').value,$('sat').value,$('lit').value); });
	}
	cookie_create('theme',theme,60);
	theme = (theme == themes.length?-1:theme*1+1);
}
function toggle_simple() {
	$('calculator').className += ' simplex';
	toggle($('info')); toggle($('instructions'));
	display_status('All is plain and neat now!<br/>(refresh page to restore defaults)');
	}
function thema(h,s,l) { //Color theming, does not work in IE8
	var bg = 'hsl('+h+', '+s+'%, '+l+'%)';
	var bd = 'hsl('+h+', '+s+'%, '+(l-20)+'%)';
	var bd2 = 'hsl('+h+', '+s+'%, '+(l-26)+'%)';
	var bp = 'hsl('+h+', '+s+'%, '+(l-9)+'%)';
	var bs = 'hsl('+h+', '+s+'%, '+(l-16)+'%)';
	$('thema').innerHTML = '#calculator{background:'+bg+';border-color:'+bd+';}#calculator .primary{background:'+bp+';}#calculator .secondary{background:'+bs+';}#calculator input,#calculator select,#calculator .button{border-color:'+bd2+';color:'+bd2+';}#calculator .button {background-color:'+bg+';}'; //dibs on this method
	cookie_create('color',','+h+','+s+','+l,60);
}
eps = 1; //global- EPs enabled
function toggle_evs() { //Enable/Disable EV functions
	switch(eps) {
		case 1:
			eps = 0; $('btn-evs').value = 'EVs: OFF';
		break;
		case 0:
			eps = 1; $('btn-evs').value = 'EVs: ON';
		break;			
	}
	var j = $c('eps').slice();
	var i = j.length-1; do {
		toggle(j[i]);
	} while(i--);
	display_base();
}
mode = 0; //global- Single enabled
function toggle_mode(m) { //Single/Team/Row mode
	var m = m || mode;
	switch(m) {
		case 0:
			mode = 1;
			$('btn-mode').value = 'Team Calculation';
			$('mode0').style.display='none';
			$('mode1').style.display='';
			$('btn-hp').disabled = 'disabled';
			$('btn-stats').disabled = 'disabled';
			$('btn-eps').disabled = 'disabled';
			display_status('Mode has been changed to <strong>Team Calculation</strong>.');
			break;
		case 1:
			mode = 2;
			$('btn-mode').value = 'Row Calculation';
			$('mode0').style.display='';
			$('mode1').style.display='none';
			$('btn-hp').disabled = '';
			$('btn-stats').disabled = '';
			display_status('Mode has been changed to <strong>Row Calculation</strong>.');
			break;
		default:
			mode = 0;
			$('btn-mode').value = 'Single Pokémon';
			$('mode0').style.display='';
			$('mode1').style.display='none';
			$('btn-hp').disabled = '';
			$('btn-stats').disabled = '';
			$('btn-eps').disabled = ''; 
			display_status('Mode has been changed to <strong>Single Pokémon</strong>.');
	}	
	display_sprite();
	display_effectiveness($('number-'+(act>-1?act:0)).value);
}
/* Save & Load functionality */

function code_load(c) { //Loads a SaveCode
	//var c = prompt('Input SaveCode or [Cancel] to load from URL:') || location.search;
	//var c = location.search;
	display_status('<span class="loading">Loading SaveCode...</span>');
	if (c == undefined || c.indexOf('?sc=') == -1) { display_status('Cannot load improper SaveCode.'); return NULL; }
	c = c.replace(/%20/gi,'').substring(1).split('!');
	if (c.length < 2) { display_status('Cannot load improper SaveCode.'); return; }
	var  i = c.length-1; do { c[i] = c[i].split(','); } while(i--);
	//Check if SaveCodeVersion is compatible (may change with Black/White)
	if (c[0][0] > 1) { display_status('Cannot load incompatible SaveCode.'); return; }
	//Check if SaveCodeUI is compatible, and restore UI
	if (c[0][1] == 0) {
		if (c[0][2] == 0 && eps == 1) { toggle_evs(); }
		var i = c[0][3]*1;
		if(mode!=i) { if(mode==2) { mode = 0; } toggle_mode(i-1); }
		display_status('<span class="loading">Loading SaveCode...</span>');
		mode = i;
		$('nickname').value = unescape(c[0][4]);
	}
	//Load user entered IVs
	$('statlvl').value = c[1][6]; $('hiddent').innerHTML=''; $('hiddenp').innerHTML='';
	var  i=5; do {
		ivs[i] = ivr.slice();
		$('med'+i+'-0').value = c[1][i]*1;
		$('spr'+i+'-0').innerHTML = '';
		$('plv'+i+'-0').innerHTML = '';
		$('stats'+i).innerHTML = '';
	} while(i--);
	//Load row data
	$('statrows').style.display = 'none';
	el_del($('statrows'));act=-1;actp=0;rn=1;rs=[0];ivs=[];
	
	var i=2, r=i-2; l=c.length;
	if (l > 2) {
		do {
			if (r!=0) { row_add(0,c[i][1]); };
			$('level-'+r).value = c[i][1]*1; $('number-'+r).value = c[i][0]*1; $('nat-'+r).value = c[i][14]*1; $('char-'+r).value = c[i][15]; $('hpt-'+r).value = c[i][16]*1;
			$('pot0-'+r).value = c[i][17]*1; $('pot1-'+r).value = c[i][18]; $('pot2-'+r).value = c[i][19]*1;
			var  j=5; do {
				$('stat'+j+'-'+r).value = c[i][j+2]*1;
				$('ep'+j+'-'+r).value = c[i][j+8]*1;
			} while(j--);
			display_eps();
			i++; r++;
		} while (i<l);
	}
	//Restore focus and set active row
	$('act-0').checked = 1; act=0; actp=0; row_sync();
	$('statrows').style.display = '';
	
	display_effectiveness($('number-'+act).value);
	tooltips();
	display_status('Loaded SaveCode successfully!');
	$('btn-ivs').focus();
}
function code_save() { //Displays a SaveCode
	var c = '?sc=0,0,'; //Data/SaveCode version
	c += eps+',';
	c += mode+',';
	c += escape($('nickname').value)+'!';
	c += $('med0-0').value+',';
	c += $('med1-0').value+',';
	c += $('med2-0').value+',';
	c += $('med3-0').value+',';
	c += $('med4-0').value+',';
	c += $('med5-0').value+',';
	c += $('statlvl').value+''; 
	var s = $c('statrow'), i = (mode==2?0:s.length), r = (mode==2 && act>-1?act:0); s.reverse();
	do {
		c += '!'+$('number-'+r).value+','+$('level-'+r).value+','+$('stat0-'+r).value+','+$('stat1-'+r).value+','+$('stat2-'+r).value+','+$('stat3-'+r).value+','+$('stat4-'+r).value+','+$('stat5-'+r).value+','+$('ep0-'+r).value+','+$('ep1-'+r).value+','+$('ep2-'+r).value+','+$('ep3-'+r).value+','+$('ep4-'+r).value+','+$('ep5-'+r).value+','+$('nat-'+r).value+','+$('char-'+r).value+','+$('hpt-'+r).value+','+$('pot0-'+r).value+','+$('pot1-'+r).value+','+$('pot2-'+r).value;
		if (i > 0) { r = s[i-1].id.split('-')[1]; }
	} while (i--);
	display_status('<a href="'+c+'">SaveCode</a> (<a href="http://j.mp/http://www.legendarypokemon.net/ivcalcxy.html'+c+'">shorten</a>):<br/>'+c.split('!').join('! '));
	$('contact').href = 'http://www.legendarypokemon.net/contact?topic=IV%20Calculator&text='+escape('My browser is: '+navigator.userAgent+'\nMy savecode is: '+c+'\n\n');
	//window.location += c; //Uncomment for old behaviour
}

/* Row functions */

act = 0; actp = 0; //global- active row; previous active row
rn = 1; rs = [0]; //global- new row counter; array of current rows
error = 1; //global- error flag, default: true
function row_act(n) { //Makes n row active
	if ($('act-'+n).value == act) {
		actp = act;
		act = -1;
		$('act-'+n).checked = 0;
		$('name').focus();
		$('ept').style.visibility = '';
		if (online == 1) { display_sprite(); }
		display_effectiveness($('number').value);
		return false;
	}
	act = n;
	actp = 0;
	$('act-'+n).checked = 1;
	/*$('number-'+n).readonly = 'readonly'; $('number-'+n).disabled = ''; //look into this
	$('number-'+actp).readonly = ''; $('number-'+actp).disabled = 'disabled';*/
	$('ept').style.visibility = 'hidden';
	row_sync();
}
function row_sync() { //Syncs the display with active row
	var n=act, t=$('pot1-'+n).value.split('.');
	$('number').value = Math.floor($('number-'+n).value);
	$('species').value = $('number-'+n).value;
	$('nat').value = $('nat-'+n).value;
	$('char').value = $('char-'+n).value;
	$('hpt').value = $('hpt-'+n).value;
	$('pot0').value = $('pot0-'+n).value;
	$('pot2').value = $('pot2-'+n).value;
	var i=5; do {
		$('pot1').options[(i+1)].selected = (t.indexOf(i.toString()) > -1?true:false);
	} while(i--);
	display_effectiveness($('number-'+n).value);
	display_base();
	display_nature();
	display_char();
	if (mode == 2) { calc_ivs(n); }
	if (online == 1) { display_sprite(); }
}
function row_edit() { //Makes active row editable
	var n=act, t=[];
	if (n == -1) { return false; }
	$('number-'+n).value = $('species').value;
	$('nat-'+n).value = $('nat').value;
	$('char-'+n).value = $('char').value;
	$('hpt-'+n).value = $('hpt').value;
	$('pot0-'+n).value = $('pot0').value;
	var i=6; do {
		if ($('pot1').options[i].selected && t.indexOf(i-1) == -1 ) { t.push(i-1); }
	} while(i--);
	$('pot1-'+n).value = t.join('.');
	$('pot2-'+n).value = $('pot2').value;
}
function row_up(r) { //Moves row upwards
	var t=[], n=[], p=rs[rs.indexOf(r)-1];
	if ($('act-'+p).checked == 0) { row_act(p); }
	else if (online == 1) { display_sprite(); }
	p = $('level-'+p,'stat0-'+p,'stat1-'+p,'stat2-'+p,'stat3-'+p,'stat4-'+p,'stat5-'+p,'number-'+p,'nat-'+p,'char-'+p,'hpt-'+p,'pot0-'+p,'pot1-'+p,'pot2-'+p,'ep0-'+p,'ep1-'+p,'ep2-'+p,'ep3-'+p,'ep4-'+p,'ep5-'+p);
	n = $('level-'+r,'stat0-'+r,'stat1-'+r,'stat2-'+r,'stat3-'+r,'stat4-'+r,'stat5-'+r,'number-'+r,'nat-'+r,'char-'+r,'hpt-'+r,'pot0-'+r,'pot1-'+r,'pot2-'+r,'ep0-'+r,'ep1-'+r,'ep2-'+r,'ep3-'+r,'ep4-'+r,'ep5-'+r);
	p.map(function(v){t.push(v.value); });
	n.map(function(v,i){p[i].value=v.value;v.value=t[i];});
	display_eps(r);
	row_sync();
}
function row_del(n) { //Removes n row
	rs.splice(rs.indexOf(n),1);
	if (act==n) { row_act(0); }
	$('statrows').removeChild($('statrow-'+n));
	$('statrows').removeChild($('eprow-'+n));
	row_sync();
}
function row_add(n,lvl) { //Appends a new row
	if (n > 0) { rn = (rs.length == 1?1:n); }
	if (!lvl && mode==0) {
		var lvl = $('level-'+rs[(rs.length-1)]).value;
		lvl = (lvl<100?lvl*1+1:100);
	}
	lvl = lvl || 100;
	var ep = [0,0,0,0,0,0];
	if (mode==0) {
		var p = rs[(rs.length-1)];
		var ep = [$('ep0-'+p).value,$('ep1-'+p).value,$('ep2-'+p).value,$('ep3-'+p).value,$('ep4-'+p).value,$('ep5-'+p).value,];
	}	
	rs.push(rn);
	var a = document.createDocumentFragment();
	var b = el_add(a,"tr",{id:'statrow-'+rn,className:'statrow'});
		el_add(b,"td",'','<input type="radio" class="radio " name="act" id="act-'+rn+'" value="'+rn+'" onclick="row_act('+rn+');" title="(De)Activate this row." style="display:none"/> <span class="btn btn-danger btn-sm" onclick="row_del('+rn+');" title="Delete this row."><i class="fa fa-minus"></i></span>');
		el_add(b,"td",'','<input class="input-sm form-control" type="text"  id="level-'+rn+'" name="level-'+rn+'" maxlength="3" size="3" value="'+lvl+'" onkeyup="vv(this.id,0,100,event,'+rn+');" />');
		el_add(b,"td",{},'<span class="btn btn-primary btn-sm" onclick="row_up('+rn+');" title="Move row upwards."><i class="fa fa-angle-up"></i></span>');
		var i = 0; do {
			el_add(b,"td",'','<input class="input-sm form-control" type="text" name="stat'+i+'-'+rn+'" id="stat'+i+'-'+rn+'" maxlength="3" size="3" value="" onkeyup="vv(this.id,0,999,event,'+rn+');" />');
			i++;
		} while (i<6);
		el_add(b,"td",'','<input class="input-sm form-control" type="text" disabled="disabled" id="number-'+rn+'" name="number-'+rn+'" maxlength="3" size="3" value="'+$('number').value+'" /><input type="hidden" id="nat-'+rn+'" name="nat-'+rn+'" value="'+$('nat').value+'" /><input type="hidden" id="char-'+rn+'" name="char-'+rn+'" value="'+$('char').value+'" /><input type="hidden" id="hpt-'+rn+'" name="hpt-'+rn+'" value="'+$('hpt').value+'" /><input type="hidden" id="pot0-'+rn+'" name="pot0-'+rn+'" value="'+$('pot0').value+'" /><input type="hidden" id="pot1-'+rn+'" name="pot1-'+rn+'" value="'+$('pot1').value+'" /><input type="hidden" id="pot2-'+rn+'" name="pot2-'+rn+'" value="'+$('pot2').value+'" />');
	var c = el_add(a,"tr",{id:'eprow-'+rn,className:'eps'});
		if (eps == 0) { c.style.display = 'none'; }
		el_add(c,"td");
		el_add(c,"td",{id:'eps-'+rn,value:ep.sum()});
		el_add(c,"td");
		var i = 0; do {
			el_add(c,"td",'','<input class="input-sm form-control" type="text" name="ep'+i+'-'+rn+'" id="ep'+i+'-'+rn+'" maxlength="3" size="3" value="'+ep[i]+'" onkeyup="vv(this.id,0,255,event,'+rn+');display_eps();" />');
			i++;
		} while (i<6);
		el_add(c,"td");
	$('statrows').appendChild(a);
	row_act(rn);
	rn++;
}
function add_eps() { //adds provided effort points to Pokemon's Effort Values
	function validate_eps(ep1,ep2) { //EPs limits | ep1 = current EPs | ep2 = EPs to be added
		var n = actp;
		var eps = 1*$('eps-'+n).innerHTML;
		epsum = 1*ep1 + 1*ep2;
		epsum2 = 1*ep1 + (510-1*eps);
		if (ep2 < 0 && epsum > 0) { return epsum; }
		if (eps < 510 && ep1 < 255) {
			ep3 = (eps + 1*ep2 < 510)?((epsum < 255)?epsum:255):((epsum2 < 255)?epsum2:255);
			return ((ep3 < 0)?0:ep3);
		}
		else { return ep1; }
	}
	display_base();
	var n = actp; //active row
	var  i=5; do {
		$('ep'+i+'-'+n).value = validate_eps($('ep'+i+'-'+n).value,$('eff'+i+'').innerHTML);
	} while(i--);
	display_eps();
	$('name').focus(); //return focus to input
}

/* Calculation functions */
function calc_effectiveness(typ,type1,type2) { //Calculates effectiveness
	var mul = damage[typ][type1];
	if (type2 != type1) { mul = mul * damage[typ][type2]; }
	return mul;
}
function calc_hiddenp() { //Calculates Hidden Power's power
	return 60;  //Obsolete since XY
	var a = arguments;
	return Math.floor((0.5*(a[0]&2)+1*(a[1]&2)+2*(a[2]&2)+4*(a[5]&2)+8*(a[3]&2)+16*(a[4]&2))*40/63 + 30);
	//return (((((a[4]&2)<<1) + (a[3]&2) + ((a[5]&2)>>>1))*10 + (a[2]&2)*3 + (a[0]&2) + (a[1]&2)) >>> 1)+30; //alternate, by Chase
}
function calc_hiddent() { //Calculates Hidden Power's type
	var a = arguments;
	return Math.floor(((a[0]&1)+2*(a[1]&1)+4*(a[2]&1)+8*(a[5]&1)+16*(a[3]&1)+32*(a[4]&1))*15/63);
	//return (a[2] & 1) + ((a[5] & 1) << 1) + ((a[3] & 1) << 2) + ((a[4] & 1) << 3); //alternate, by Chase, uses the main types[]
}
function calc_hidden(n) { //Displays all possible Hidden Powers
	//d = new Date(); time = d.getTime(); //DEBUG
	function display_hp() {
		t.reverse().sort(); p.sortnum();
		$('hiddent').innerHTML = t.join(', ');
		$('hiddenp').innerHTML = 60; //p.join(', ');
		//array_intersect(ivs[i],eo[ivhss[i][0]].slice());
		//d = new Date(); display_status((d.getTime()-time)/1000); return true; //DEBUG
		display_text(n);
	}
	display_status('<span class="loading">Calculating <em>Hidden Power</em>...</span>');
	
	if ($('medl').checked) {
		var t = [typeshp[calc_hiddent($('med0-0').value,$('med1-0').value,$('med2-0').value,$('med3-0').value,$('med4-0').value,$('med5-0').value)]];
		//var p = [calc_hiddenp($('med0-0').value,$('med1-0').value,$('med2-0').value,$('med3-0').value,$('med4-0').value,$('med5-0').value)];
		display_hp(); return true;
	}
	
	if (error != 0) { display_status('Does not compute!<br/>Properly input or Calculate IVs first.'); return false; }
	var a = [], b = $('hpt-'+n).value, t = [], p = [], i0=ivs[0].length-1;
	do { //must optimize this further
		a[0] = ivs[0][i0];
		var i1=ivs[1].length-1;
		do {
			a[1] = ivs[1][i1];
			var i2=ivs[2].length-1;
				do {
					a[2] = ivs[2][i2];
					var i3=ivs[3].length-1;
						do {
							a[3] = ivs[3][i3];
							var i4=ivs[4].length-1;
								do {
									a[4] = ivs[4][i4];
									var i5=ivs[5].length-1;
										do {
											a[5] = ivs[5][i5];
											var c = typeshp[calc_hiddent(a[0],a[1],a[2],a[3],a[4],a[5])];
											if (b == -1 || c == typeshp[b]) {
												if (t.indexOf(c) == -1) { t.push(c); }
												//var d = calc_hiddenp(a[0],a[1],a[2],a[3],a[4],a[5]);
												//if (p.indexOf(d) == -1) { p.push(d); }
											}
											if (p.length == 41 && t.length == 16) { display_hp(); return true; } //exit loops if all possible
										} while (i5--);
								} while (i4--);
						} while (i3--);
				} while (i2--);
		} while (i1--);
	} while (i0--);
	display_hp();
}
function calc_stat(species,pstat,stativ,statev,pokelvl,nature) { //Calculates Pokemon stats
	var basestat = get_base(species,pstat);
	var bonus = natures[nature][(pstat-1)];
	if (eps == 0) { var statev = 0; }
	if (pstat == 0) { //HP uses a different formula
		var result =  (Math.floor(((basestat*2 + (stativ/1) + Math.floor(statev/4))*pokelvl)/100)) + (pokelvl/1) + 10;
		if (species == 292) { return 1; } //Shedinja Case
	}
	else { var result = Math.floor((Math.floor(((basestat*2 + (stativ/1) + Math.floor(statev/4))*pokelvl)/100) + 5)*bonus); }
	return result;
}

ivs = [ivr.slice(),ivr.slice(),ivr.slice(),ivr.slice(),ivr.slice(),ivr.slice()]; //global- IVs array
function calc_stativ(species,pstat,stat,statev,pokelvl,nature,chara,pot1,pot2) { //Calculates Pokemon IVs - brute force
	var chara = chara.split('.');
	var pot1 = pot1.split('.');
	var charas = [[0,5,10,15,20,25,30],[1,6,11,16,21,26,31],[2,7,12,17,22,27],[3,8,13,18,23,28],[4,9,14,19,24,29]];
	var pots = [[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15],[16,17,18,19,20,21,22,23,24,25],[26,27,28,29,30],[31]];
	ivs[pstat] = [-1];
	var  i=31; do {
		if (calc_stat(species,pstat,i,statev,pokelvl,nature) == stat) { ivs[pstat].unshift(i); }
	} while(i--);
	
	if (pstat == 0 && species == 292) { ivs[pstat] = ivr.slice(); } //Shedinja Case
	
	if (chara[0] == pstat && chara != -1) {
		ivs[pstat] = array_intersect(ivs[pstat],charas[chara[1]]);
		maxiv = ivs[pstat][ivs[pstat].length-1]; //global maximum IV
	}
	if (pot1.indexOf(pstat.toString()) != -1 && pot2 != -1) {
		ivs[pstat] = array_intersect(ivs[pstat],pots[pot2]);
	}
	if (ivs[pstat][0] > miniv[1]) { miniv[1] = ivs[pstat][0]; }
	return ivs[pstat];
}
function calc_ivs(rn) { //Calculates a complete IV set
	error = 0; //global- reset errors
	if ($('number-0').value == 0) {
		error = 'Halt and Disable Operator!<br/>Perhaps you should select a <em class="error">Pokémon Species</em>...';
		display_status(error);
		$('name').value=''; $('name').focus();
		return false;
	}
	if ($('level-0').value == 0) {
		error = 'Does not compute!<br/><em class="error">Level</em> cannot be zero.';
		display_status(error);
		$('level-0').focus();
		return false;
	}
	display_status('<span class="loading">Calculating <em>Individual Values</em>...</span>');
	
	function validate_iv(result,species,pstat,stat,statev,pokelvl,nature) { // IV error handling
		var spname = get_text('species',species);
		var max = calc_stat(species,pstat,31,statev,pokelvl,nature);
		var min = calc_stat(species,pstat,0,statev,pokelvl,nature);
		if (stat > max || stat < min) {
			error = '<em>'+spname+'</em> Lv.'+pokelvl+' does not compute!<br/><em class="error">'+stats[pstat]+'</em> ('+stat*1+') should be '+min+' to '+max+'.<br/> The <em class="error">Effort Points</em> or <em class="error">Nature</em> may be inaccurate.';
			ivs[pstat] = [-1];
			return ['error'];
		}
		
		var i=0,l=result.length; do {
			if (result[i] > maxiv) { //beyond characteristic upper bound
				result = result.slice(0,i);
			}
			if (miniv[0] == pstat && result[i] >= miniv[1]) { //best iv must remain be at least equal to the lower bound
				result = result.slice(i);
			}
			i++;
		} while(i<l);
		
		if (result.length == 0 || result[0] > maxiv || result[0] == -1 || result[result.length] > 31) { //out of any bounds
			error = '<em>'+spname+'</em> Lv.'+pokelvl+' does not compute!<br/>The <em class="error">'+stats[pstat]+'</em> stat, <em class="error">Effort Points</em>, <em class="error">Characteristic</em> or <em class="error">Best Stat</em> are inaccurate.'; //global error - prevent complex calculations
			ivs[pstat] = [-1];
			return ['error'];
		}
		return result;
	}
	function validate_ties() { //Refines in case max IVs tie
		var ties = $('pot1-'+rn).value.split('.');
		var l = ties.length;
		if (l > 1) {
			var t = ivs[ties[0]].slice(); 
			var i=1; do {
				t = array_intersect(t,ivs[ties[i]]);
				if (t[0] == undefined) {
					error = '<em>'+get_text('species',$('number-'+rn).value)+'</em> Lv.'+$('level-'+rn).value+' does not compute!<br/><em class="error">Best Stat/s</em> entered is/are inaccurate.';
					return false;
				}
				i++;
			} while(i<l);
			ties.map(function(v){ivs[v]=t.slice();});
		}
	}
	
	maxiv = 31; miniv = [-1,0];//global- maximum IV
	ivs = [ivr.slice(),ivr.slice(),ivr.slice(),ivr.slice(),ivr.slice(),ivr.slice()];
	//Calculate row(s)
	var rn = rn || 0;
	var i=rn, l=(mode!=0?(rn+1):rs.length); do {
		//alert(rn); //DEBUG
		var r=rs[i];
		var j=5; do {
			ivs[j] = array_intersect(ivs[j],calc_stativ($('number-'+r).value,j,$('stat'+j+'-'+r).value,$('ep'+j+'-'+r).value,$('level-'+r).value,$('nat-'+r).value,$('char-'+r).value,$('pot1-'+r).value,$('pot2-'+r).value));
			if (error != 0) { display_status(error); $('stat'+j+'-'+r).focus(); return false; }
		} while(j--);
		miniv[0] = $('char-'+r).value.split('.')[0];
		i++;
	} while(i<l);
	//Validate IVs
	var c = 0; var i=5; do {
		ivs[i] = validate_iv(ivs[i],$('number-'+r).value,i,$('stat'+i+'-'+r).value,$('ep'+i+'-'+r).value,$('level-'+r).value,$('nat-'+r).value);
		if (error != 0) { display_status(error); $('stat'+i+'-'+r).focus(); return false; }
		if (ivs[i].length == 1) { c++; }
	} while(i--);
	
	validate_ties();
	if (error != 0) { display_status(error); $('pot1').focus(); return false; }
	
	//Refine using Hidden Power //XY TODO
	if ((error == 0) && $('hpt-'+rn).value > -1) {
		if (c == 6 && ($('hpt-'+rn).value != calc_hiddent(ivs[0][0],ivs[1][0],ivs[2][0],ivs[3][0],ivs[4][0],ivs[5][0]))) {
			error = '<em>'+get_text('species',$('number-'+rn).value)+'</em> Lv.'+$('level-'+rn).value+' does not compute!<br/><em class="error">Hidden Power</em> ('+typeshp[$('hpt-'+rn).value]+') entered is inaccurate.';
			display_status(error);
			$('hpt').focus();
			return false;
		}

		ivh = [];
		var k = 0;
		var  i=5; do {
			ivh[i] = [];
			for(var j=0;j<ivs[i].length;j++) { //global- make odd&even possibility array for every stat
				ivh[i].push(((ivs[i][j]%2==1)?1:0));
				if (ivh[i].length == 2) { k++; break; }
			}
		} while(i--);
		var hp = hps[$('hpt-'+rn).value].split(',');
		for (var i=0; i < hp.length;i++) {
			hp[i] = (hp[i]*1).toString(2); //decimal -> binary SpDef/SpAtk/Spd/Def/Atk/HP
			hp[i] = hp[i].split('');
			hp[i] = hp[i].reverse(); //-> HP/Atk/Def/Spd/SpAtk/SpDef
			hp[i].push(0,0,0,0,0); //ensure all bits are there
			hp[i] = hp[i].slice(0,6); //but we only need 6
			var s = hp[i][3]; //-> HP/Atk/Def/SpAtk/SpDef/Spd
			hp[i][3] = hp[i][4];
			hp[i][4] = hp[i][5];
			hp[i][5] = s;
		}
		var ivhs = [];
		var l = 0;
		for (var i=0;i < hp.length;i++) {
			if ((ivh[0].indexOf(1*hp[i][0]) != -1) && (ivh[1].indexOf(1*hp[i][1]) != -1) && (ivh[2].indexOf(1*hp[i][2]) != -1) && (ivh[3].indexOf(1*hp[i][3]) != -1) && (ivh[4].indexOf(1*hp[i][4]) != -1) && (ivh[5].indexOf(1*hp[i][5]) != -1)) { //if all match then add to possible hps[] value for given type
				ivhs[l] = [];
				ivhs[l] = hp[i].slice();
				l++;
			}
		}
		var ivhss = [];
		var l = 0;
		for (var i=0;i < ivhs.length;i++) {
			var j=5; do { //make possibility array for every stat, [0], [1] or [0,1]/[1,0] for given type
				if (!ivhss[j]) { ivhss[j] = []; }
				var t = ivhs[i][j];
				if (ivhss[j].length < 2 && ivhss[j].indexOf(t) == -1) { ivhss[j].push(t); }
				if (ivhss[j].length == 2) { l++; }
			} while(j--);
		}
		if (l != 6) { //ensure not all combinations are possible for given type
			var i=5; do {
				if (!ivhss[i]) {
					error = '<em>'+get_text('species',$('number-'+rn).value)+'</em> Lv.'+$('level-'+rn).value+' does not compute!<br/><em class="error">Hidden Power</em> ('+typeshp[$('hpt-'+rn).value]+') entered is inaccurate.';
					display_status(error);
					$('hpt').focus();
					return false;
				}
				if (ivhss[i].length == 1) {
					var eo = [];
					eo[0] = [0,2,4,6,8,10,12,14,16,18,20,22,24,26,28,30];
					eo[1] = [1,3,5,7,9,11,13,15,17,19,21,23,25,27,29,31];
					ivs[i] = array_intersect(ivs[i],eo[ivhss[i][0]].slice());
				}
			} while(i--);
		}
	}
	//end Hidden Power refine
	
	validate_ties();
	if (error != 0) { display_status(error); $('pot1').focus(); return false; }
	
	//Pinpoint next helpfull level and EPs if IVs are multiple
	//plv: 1-level 2-eps 3-stat1 4-stat2 - branched stats
	var lr = (mode==2?rn:rs[rs.length-1]);
	var plv = [];
	var  i=5; do {
		plv[i] = ['','','']; //level, branch, eps
		var z=1;
		if (ivs[i].length > 1 && mode!=1) {
			var j = $('level-'+lr).value;
			while (plv[i][0] == '' && j <= 100) {
				for (var z=1,zl=ivs[i].length;z <= zl;z++) {
					var statev = $('ep'+i+'-'+lr).value;
					var a = calc_stat($('number-'+lr).value,i,ivs[i][z-1],statev,j,$('nat-'+lr).value);
					var b = calc_stat($('number-'+lr).value,i,ivs[i][z],statev,j,$('nat-'+lr).value);
					if (ivs[i].length <= 2 && eps == 1) { //Calculate EPs for exact stat
						var y = statev;
						while (plv[i][2] == '' && y < 255) {
							for (var x=1,xl=ivs[i].length;x <= xl;x++) {
								var c = calc_stat($('number-'+lr).value,i,ivs[i][x-1],y,$('level-'+lr).value,$('nat-'+lr).value);
								var d = calc_stat($('number-'+lr).value,i,ivs[i][x],y,$('level-'+lr).value,$('nat-'+lr).value);
								if (c < d) { plv[i][2] = y; break; }
							}
							y++;
						}
					}
					if (a < b) { plv[i][0] = j; plv[i][3] = a; plv[i][4] = b; break; }
				}
				j++;
			}
			if ($('level-'+lr).value == 100) { plv[i][0] = ''; }
		}
		plv[i][1] = z-1;
	} while(i--);
	//Display Results
	var i=rs.indexOf(rn);
	if (i>-1) {
		display_ivs(rn,plv);
		if (mode==1 && rs[i+1]) { calc_ivs(rs[i+1],1); } //recursion if Team mode
	}
	//return true;
}
function calc_eps() { //Calculates and displays required EPs
	display_eps();
	$('statlvl').value = $('level-0').value;
	if (display_stats(0)) {
		$('stat0-0').focus();
		function count_eps(pstat,stat,iv,eps) { //calculates required EPs - brute force way
			for (var i=$(eps).value;i<=255;i++) {
				if (calc_stat($('number-0').value,pstat,$(iv).value,i,$('level-0').value,$('nat-0').value) == $(stat).value) { return i - $(eps).value; }
			}
			return 'Lv.';
		}
		var  i=5; do {
			$('eps'+i).innerHTML = count_eps(i,'stat'+i+'-0','med'+i+'-0','ep'+i+'-0');
		} while(i--);
		$('epsr').innerHTML = 1*$('eps0').innerHTML + 1*$('eps1').innerHTML + 1*$('eps2').innerHTML + 1*$('eps3').innerHTML + 1*$('eps4').innerHTML + 1*$('eps5').innerHTML + 1*$('eps-0').innerHTML;
		if(isNaN($('epsr').innerHTML)) { $('epsr').innerHTML = 'Lv.'; }
	}
	if ($('epsr').innerHTML > 510) { $('epsr').className = 'error';}
	if ($('epsr').innerHTML < 510) { $('epsr').className = '';}
}

/* Display functions */

function display_status(str,s) {
	var t = $('status').innerHTML;
	$('status').innerHTML = str;
	if (s>0) { setTimeout(function () { display_status(t); }, s*1000);	}
}
function display_base() { //Displays Base Stats
	var p = $('species').value;
	$('types').innerHTML =  (get_base(p,6) == get_base(p,7)?types[get_base(p,6)]:types[get_base(p,6)]+' / '+types[get_base(p,7)]);
	$('eggs').innerHTML =  (get_base(p,8) == get_base(p,9)?eggs[get_base(p,8)]:eggs[get_base(p,8)]+' / '+eggs[get_base(p,9)]);
	var  i=5; do {
		$('base'+i).innerHTML =  get_base(p,i);
	} while(i--);
	display_eps();
	display_effectiveness(p);
}
function display_eps(n) { //Displays provided EPs
	if (eps == 0) { return false; }
	var p = $('species').value;
	var n = (n>-1?n:(act>-1?act:actp)); //active row
	var sum = 1*$('ep0-'+n).value + 1*$('ep1-'+n).value + 1*$('ep2-'+n).value + 1*$('ep3-'+n).value + 1*$('ep4-'+n).value + 1*$('ep5-'+n).value;
	$('eps-'+n).innerHTML = (sum==510?'<span class="ok">'+sum+'</span>':sum);
	var item = $('item').value;
	var vit = ((item > 7)?0:1); //vitamins on or off	
	var berry = 1; if (item > 13) { berry = -1; item = item-6; } //berries off or on	
	var mult = $('times').value*(($('pkrs').checked == 1)?2:1)*((item == 1)?2:1)*vit; //multipliers
	
	//hp up, protein, iron, calcium, zinc, 13carbos - Pomeg, Kelpsy, Qualot, Hondew, Grepa and Tamato 		
	var  i=5; do {
		$('eff'+i).innerHTML =  mult*(1*(get_base(p,10)[i])+((item == 2+i)?4:0)) + $('times').value*(1*((item == i+8)?10:0))*berry;
		$('item').options[i+8].disabled = ''; //reset vitamins
		if ($('ep'+i+'-'+n).value*1+$('times').value*10 > 100 || 510 < sum+$('times').value*10 || $('level-'+n).value == 100) {
			$('item').options[i+8].disabled = 'disabled';
			if (item > 7) {
				$('eff'+i).innerHTML = ((item == i+8) && (berry == -1)?-10*$('times').value:0);
			}
		}
	} while(i--);
	
	if (sum > 510) { $('eps-'+n).className = 'error'; }
	else { $('eps-'+n).className = ''; }
}
function display_nature() {
	var n = $('nat').value;
	var i=5; do {
		$('nate-'+i).innerHTML = '-';
		if (natures[n][i-1] > 1) { $('nate-'+i).innerHTML = '<strong>&times;1.1</strong>'; }
		if (natures[n][i-1] < 1) { $('nate-'+i).innerHTML = '&times;0.9'; }
		i--;
	} while(i>0);
}
function display_char() {
	var i=5; do { 
		$('med'+i+'-0').style.borderWidth = '';
	} while(i--);
	var n=$('char').value.split('.')[0];
	if (n > -1) { $('med'+n+'-0').style.borderWidth = '3'; }
}
function display_effectiveness(p) {
	var type1 = get_base(p,6); 
	var type2 = get_base(p,7);
	var d = []; d[4] = []; d[0] = []; d[1] = []; d[2] = []; d[8] = []; d[16] = [];
	var t = []; t[4] = []; t[0] = []; t[1] = []; t[2] = []; t[8] = []; t[16] = [];
	
	if (mode==1 && act >-1) {
		for (var i=0,l=rs.length; i < l; i++)  {
			p = $('number-'+rs[i]).value;
			type1 = get_base(p,6);
			type2 = get_base(p,7);
			for (var j=0; j < 18; j++)  {
				var a = calc_effectiveness(j,type1,type2);
				if(!t[4*a][j]) {
					t[4*a][j] = 1;
					d[4*a].push(j);
				}
				else { t[4*a][j]++; }
			}
		}
	}
	else {
		for (var i=0; i < 18; i++)  {
			var a = calc_effectiveness(i,type1,type2);
			t[4*a][i] = 1;
			d[4*a].push(i);
		}
	}
	var i=4, j=[0,1,2,8,16]; do {
		d[j[i]] = d[j[i]].map(function(v){if(t[j[i]][v]>1){return types[v]+'<strong>&times;'+t[j[i]][v]+'</strong>';}return types[v];});
		d[j[i]].sort();
		$('dmg'+j[i]).innerHTML = d[j[i]].join(', ');
	} while(i--);
}
function add_sprite() { //Adds sprite events
	event_add($('species'), 'change', display_sprite);
	event_add($('name'), 'keyup', display_sprite);
	event_add($('number'), 'keyup', display_sprite);
	display_sprite();
}
spr = '';
function display_sprite() { //feel free to modify if you want to server sprites from your server
	clearTimeout(spr);
	if (!navigator.onLine) {
		online = 0;
		$('sprite').innerHTML = '';
		return false;
	}
	alt = {0:'egg',386.1:'386-a',386.2:'386-d',386.3:'386-s',413.1:'413-c',413.2:'413-t',492.1:'492-s',487.1:'487-o',479.1:'479-h',479.2:'479-w',479.3:'479-f',479.4:'479-s',479.5:'479-m',351.1:'351-s',351.2:'351-r',351.3:'351-i',550.1:'550-b',555.1:'555-d',648.1:'648-s',646.1:'646-w',646.2:'646-b',647.1:'647-r',641.1:'641-t',642.1:'642-t',645.1:'645-t',678.1:'678-f',681.1:'681-b',710.1:'710-s',710.2:'710-l',710.3:'710-h',711.1:'711-s',711.2:'711-l',711.3:'711-h',3.1:'003-m',6.1:'006-mx',6.2:'006-my',9.1:'009-m',65.1:'065-m',94.1:'094-m',115.1:'115-m',127.1:'127-m',130.1:'130-m',142.1:'142-m',150.1:'150-mx',150.2:'150-my',181.1:'181-m',212.1:'212-m',214.1:'214-m',229.1:'229-m',248.1:'248-m',257.1:'257-m',282.1:'282-m',303.1:'303-m',306.1:'306-m',308.1:'308-m',310.1:'310-m',354.1:'354-m',359.1:'359-m',445.1:'445-m',448.1:'448-m',460.1:'460-m'};
	spr = setTimeout (function() {
		$('sprite').innerHTML = '';
		var i=0, l=(mode==1 && act >-1?rs.length:1), result='';
		do { //logic here needs reworking
			var n = (mode==1 && act >-1?$('number-'+rs[i]):$('species')).value*1;
			var m = n;
			if (alt[n]) {
				m = alt[n];
			}
			if (m < 10) {
				n = '0'+n;
				m = n;
			}
			if (m < 100) {
				n = '0'+n;
				m = n;
			}
			$('sprite').innerHTML += '<img src="http://www.serebii.net/'+
			(mode==1 && act >-1?'pokedex-xy/icon/'+m+'.png':'xy/pokemon/'+m+'.png')+'" alt="'+n+'" class="center-block" />';
			i++;
		} while(i<l);
	}, 500);
}
function display_text(r) { //Displays copy & paste results
	var b=[],a = '#'+$('number-'+r).value+' '+get_text('species',$('number-'+r).value)+' ['+get_text('nat',$('nat-'+r).value)+']<br/>IVs: ';
	//get_text('gnd',$('gnd').value)
	var i=0; do {
		if (ivs[i].length > 3) {
			b.push(ivs[i][0]+' - '+ivs[i][(ivs[i].length-1)]);
		}
		else { b.push(ivs[i].join(', ')); }
		i++;
	} while (i<6);
	a += b.join(' / ');
	a += '<br/>Stats at Lv.'+$('level-'+r).value+': ';
	var i=0,b=[]; do {
		stat = $('stat'+i+'-'+r).value;
		ep = $('ep'+i+'-'+r).value;
		b.push(stat + (ep > 0?' ('+ep+')':''));
		i++;
	} while (i<6);
	a += b.join(' / ');
	display_status(a);
}
function display_stats(r,m) { //Displays calculated stats
	if ($('statlvl').value == 0) { $('statlvl').value = 100; }
	if (mode == 1) { display_status('Cannot compute Stats in Team mode.'); }
	
	var  i=5; do {
		if (m === '' && (!$('med'+i+'-0').value || error != 0)) {
			display_status('Does not compute!<br/>Properly input or Calculate IVs first.');
			return false;
		}
		switch(m) {
			case 0: var iv=0, ep=0, nat='min'; break;
			case 1: var iv=31, ep=255, nat='max'; break;
			default:
			var iv = $('med'+i+'-0').value, ep = $('ep'+i+'-'+r).value, nat = $('nat-'+r).value;
		}
		$('stats'+i).innerHTML = calc_stat($('number-'+r).value,i,iv,ep,$('statlvl').value,nat);
	} while(i--);
	return true;
}
function display_ivs(rn,plv) { //Displays IVs appropriately
	if (error != 0) { return false; }
	if (mode==1) {
		if (rn==0) {
			$('ivrows').style.display = 'none';
			el_del($('ivrows'));
			$('ivrows').style.display = '';
		}
		var a=[], i=0; do {
			if (ivs[i].length > 2) {
				a.push(ivs[i][0]+'-'+ivs[i][(ivs[i].length-1)])+'';
			}
			else { a.push(ivs[i].join('-')); }
			i++;
		} while (i<6);
		var r = el_add($('ivrows'),'tr');
		el_add(r,'td',{},'<h4 class="btn btn-primary btn-sm" onclick="toggle_mode(); if ($(\'act-'+rn+'\').checked == 0) { row_act('+rn+'); } calc_ivs('+rn+'); $(\'btn-mode\').focus();">#'+$('number-'+rn).value+':</h4>');
		var i=0; do {
			el_add(r,'td',{className:'right'},a[i]+'');
			i++;
		} while (i<6);
		display_status('Calculation complete.');
		return true;
	}
	var  i=5; do {
		if (!$('medl').checked) { $('med'+i+'-0').value = ivs[i][Math.ceil(ivs[i].length/2)-1]; }
		$('plv'+i+'-0').innerHTML = (plv[i][0] == ''?(ivs[i].length == 1?'<span class="ok">OK!</span>':'<span class="" title="Refine using Hidden Power.">[?]</span>'):'<span class="btn btn-primary btn-sm" onclick="row_add(0,'+plv[i][0]+'); $(\'stat0-\'+(rn-1)).focus();">'+plv[i][0]+'</span>')+(plv[i][2] == ''?'':'<br/><span class="eps">'+plv[i][2]+'</span>');
			
		var ivst = ivs[i].slice();
		if (plv[i][1]<ivst.length) { ivst[plv[i][1]] = ivst[plv[i][1]]+'</span><span class="" style="font-size: 0.9em;" title="Lv.'+plv[i][0]+' '+stats[i]+': &lt;strong&gt;'+plv[i][4]+'&lt;/strong&gt;">'; }
		$('spr'+i+'-0').innerHTML = '<span class="" style="font-weight: bold;" '+(plv[i][0] == ''?'':'title="Lv.'+plv[i][0]+' '+stats[i]+': &lt;strong&gt;'+plv[i][3]+'&lt;/strong&gt;"')+'>'+ivst.join(', ')+'&nbsp;</span>';
	} while(i--);
	rn = (mode==2?rn:rs[rs.length-1]);
	display_stats(rn); display_text(rn);
}

eval(function(a,r,c,e,u,s){u=function(c){return(c<r?'':u(parseInt(c/r)))+((c=c%r)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)s[u(c)]=e[c]||u(c);e=[function(u){return s[u]}];u=function(){return'\\w+'};c=1};while(c--)if(e[c])a=a.replace(new RegExp('\\b'+u(c)+'\\b','g'),e[c]);return a}('l s(){w($(\'z\')==q){y("\\u\\3\\A\\1\\2\\7\\0\\1\\4\\5\\1\\o\\4\\3\\9\\2\\6\\4\\3\\5\\1\\3\\m\\1\\6\\d\\4\\8\\1\\c\\7\\3\\f\\7\\2\\j\\r\\8\\1\\9\\4\\a\\0\\5\\a\\0\\h\\n\\p\\9\\0\\2\\8\\0\\1\\2\\9\\b\\2\\e\\8\\1\\i\\0\\0\\c\\1\\6\\d\\0\\1\\a\\7\\0\\g\\4\\6\\8\\1\\4\\5\\6\\2\\a\\6\\h\\n\\n\\b\\b\\b\\k\\9\\0\\f\\0\\5\\g\\2\\7\\e\\c\\3\\i\\0\\j\\3\\5\\k\\5\\0\\6");t}v();x()};',37,37,'u0065|u0020|u0061|u006f|u0069|u006e|u0074|u0072|u0073|u006c|u0063|u0077|u0070|u0068|u0079|u0067|u0064|u0021|u006b|u006d|u002e|function|u0066||u0076|u0050|null|u0027|init0|return|u0059|online_check|if|initO|alert|lp|u0075'.split('|'),0,{}));

function initO() { //Actions to perform once the page has loaded
	$('form').reset(); //reset all fields
	toggle_theme();
	tooltips();
	display_status('<span class="loading">Initializing...</span>');
	$('calculator').style.minHeight = (1*(window.innerHeight?window.innerHeight:(document.body?document.body.clientHeight:''))-16)+'px'; /* remove this when including */
	$('ept').style.visibility = 'hidden';
	$('mode1').style.display = 'none';
	toggle($('history'));	
	
	event_add($('name'),"keyup", function () { autocomplete(this,$('species'),'text',true); $('number').value=Math.floor($('species').value); display_base(); row_edit(); });
	event_add($('name'),"focus", function () { this.value = '' });
	event_add($('species'),"change", function () { $('name').value=$('species').options[$('species').selectedIndex].text; $('number').value=Math.floor($('species').value); display_base(); row_edit(); });
	event_add($('number'),"keyup", function (evt) { vv('number',0,718,evt); $('species').value=$('number').value; $('name').value=$('species').options[$('species').selectedIndex].text; display_base(); row_edit(); });
	event_add($('nat'),"change", function () { display_nature(); row_edit(); });
	event_add($('charn'),"keyup", function () { autocomplete(this,$('char'),'text',true); display_char(); row_edit(); });
	event_add($('char'),"change", function () { $('charn').value=$('char').options[$('char').selectedIndex].text; display_char(); row_edit(); });
	event_add($('hpt'),"change", function () { row_edit(); if(act>-1){ $('level-'+act).focus(); }});
	event_add($('hpt'),"blur", function () { if(act>-1){ $('level-'+act).focus();}}); //fails in chrome, issue 6759
	event_add($('pkrs'),"click", function () { display_eps(); });
	event_add($('item'),"change", function () { display_eps(); });
	event_add($('times'),"keyup", function (evt) { vv('times',0,255,evt); display_eps(); });
	
	event_add($('level-0'),"keyup", function (evt) { vv('level-0',0,100,evt,0); });
	event_add($('statlvl'),"keyup", function (evt) { vv('statlvl',0,100,evt); });
	event_add($('act-0'),"click", function () { row_act(0); });
	var  i=5; do {
		event_add($('stat'+i+'-0'),"keyup", function (evt) { vv(this.id,0,999,evt,0); });
		event_add($('ep'+i+'-0'),"keyup", function (evt) { vv(this.id,0,255,evt,0); display_eps(); });
		event_add($('med'+i+'-0'),"keyup", function (evt) { vv(this.id,0,31,evt); });
	} while(i--);
		
	event_add($('pot0'),"change", function () { row_edit(); });	
	if (navigator.userAgent.indexOf('AppleWebKit') > -1) { $('pot1').style.height = '18px'; } //workaround for Webkit, Chrome issue 41759
	event_add($('pot1'),"focus", function () { this.size=7; });
	event_add($('pot1'),"blur", function () { this.size=7; });
	event_add($('pot1'),"blur", function () { row_edit(); this.size=1; this.style.position=''; });
	event_add($('pot2'),"change", function () { row_edit(); });
	
	event_add($('btn-addrow'),"click", function () { row_add(); $((mode?'name':'stat0-'+(rn-1))).focus(); tooltips(); });
	event_add($('btn-addeps'),"click", add_eps);
	event_add($('btn-theme'),"click", toggle_theme);
	event_add($('btn-eps'),"click", function () { calc_eps(); });
	event_add($('btn-evs'),"click", toggle_evs);
	event_add($('btn-mode'),"click", function () { toggle_mode(mode); });	
	event_add($('btn-save'),"click", code_save);
	event_add($('btn-ivs'),"click", function () { calc_ivs((mode==2 && act>-1?act:0)); tooltips(); });
	event_add($('btn-stats'),"click", function () { display_stats((act>-1?act:0)); });
	event_add($('btn-statsmin'),"click", function () { display_stats((act>-1?act:0),0); });
	event_add($('btn-statsmax'),"click", function () { display_stats((act>-1?act:0),1); });
	event_add($('btn-hp'),"click", function () { calc_hidden((mode==2 && act>-1?act:0)); });
	event_add($('toggleinfo'),"click", function () { toggle($('info')); toggle($('instructions')); });
	event_add($('toggleinstructions'),"click", function () { toggle($('info')); toggle($('instructions')); });
	event_add($('togglehistory'),"click", function () { toggle($('history')); });
			
	var tload;
	event_add($('btn-load'),"click", function(){
		if(tload){
			clearTimeout(tload);
			tload = '';
			code_load(prompt('Input SaveCode:'));
		}
		else tload= setTimeout(function(){
			tload = '';
			code_load(location.search);
		},300);
	});
	
	pop_species();
	display_base();
	
	if (location.protocol != 'data:') {
		var br = navigator.userAgent;
		if (br.indexOf('iPhone') > -1 || br.indexOf('iPod') > -1 || br.indexOf('iPad') > -1) {
		$('download').innerHTML = "Hello dear &#63743; fan! You can <strong>save</strong> (really) this page, for offline use, by <a href=\"javascript:x=new XMLHttpRequest();x.onreadystatechange=function(){if(x.readyState==4)location='data:text/html;charset=utf-8;base64,'+btoa(unescape(encodeURIComponent(x.responseText)))};x.open('GET',location);x.send('');\">clicking here</a> and bookmarking after the redirect!";  }
	}
	
	$('name').focus();
	if (location.search.indexOf('sc=') > -1) { $('btn-load').value+='*'; $('btn-load').focus(); } //Make SavedCose visible
	
	if ((document.charset && document.charset.toLowerCase() != 'utf-8') || (document.characterSet && document.characterSet.toLowerCase() != 'utf-8')) {
		display_status("Please set your browser's encoding to UTF-8 or this tool may not work as expected.");
	}
	else { display_status('Run Without Error.<br/><span class="btn btn-primary btn-sm" onclick="toggle_simple();">Simplify?</span>'); }
}
event_add(window,"load", init0);