var process_team_str = function(str) {
	var data = new Array();
	temp = str.split("\n\n");

	for (var i = 0; i < temp.length; i++) {

		var pointer = 0;
		elem = temp[i];
		indexs = elem.split("\n");

		// indexs[0] = 'Smaug (Charizard) (M) @ Charizardite Y'
		temp2 = indexs[pointer].split(" ");
		pointer++;

		// name
		// name = temp2[0];

		// species
		species = temp2[0];

		// item
		item = indexs[0].split("@");
		item = item[1].substr(1, item[1].length);

		// ability
		ability = indexs[pointer].split(": ");
		ability = ability[1];
		pointer++;

		// shiny
		if(elem.indexOf("Shiny:")!= -1){
			shiny = indexs[pointer].split(": ");
			shiny = shiny[1];
			pointer++;
		}
		else
			shiny = "No";
			
		// evs
		evs = indexs[pointer].split(": ");
		evs = evs[1].split(" / ");

		_evs = {};
		for (var z = 0; z < evs.length; z++) {
			stat = evs[z].split(" ");
			statName = stat[1];
			statNumber = stat[0];
			switch(statName){
				case "HP": _evs.hp = statNumber;
				break;

				case "Atk": _evs.atk = statNumber;
				break;

				case "Spd": _evs.spd = statNumber;
				break;

				case "Def": _evs.def = statNumber;
				break;

				case "SAtk": _evs.satk = statNumber;
				break;

				break;

				case "SDef": _evs.sdef = statNumber;
				break;
			}
		};
		
		evs = _evs;
		pointer++;

		// nature		
		nature = indexs[pointer].split(" ");
		nature = nature[0];
		console.log(nature)
		pointer++;

		// ivs
		if(elem.indexOf("IVs")!= -1){
			ivs = indexs[pointer].split(": ");
			ivs = ivs[1].split(" / ");
			_ivs = {};
			for (var z = 0; z < ivs.length; z++) {
				stat = ivs[z].split(" ");
				statName = stat[1];
				statNumber = stat[0];
				switch(statName){
					case "HP": _ivs.hp = statNumber;
					break;

					case "Atk": _ivs.atk = statNumber;
					break;

					case "Spd": _ivs.spd = statNumber;
					break;

					case "Def": _ivs.def = statNumber;
					break;

					case "SAtk": _ivs.satk = statNumber;
					break;

					case "SDef": _ivs.sdef = statNumber;
					break;
				}
			};
			
			pointer++;
			ivs = _ivs;
		}else
			ivs = {};
			
		// moves
		moves = new Array();

		for (var j = pointer +1; j < indexs.length; j++) {
			move = indexs[j].split("- ");
			moves.push(move[1]);
		};

		monster = {
			// name : name,
			species : species,
			item : item,
			ability : ability,
			shiny : shiny,
			evs : evs,
			ivs : ivs,
			nature : nature,
			moves : moves
		};

		data.push(monster);
	};

	return data;
}

fill_data = function(data){
	for (var i = 1; i <= data.length; i++) {
		pkm = data[i-1];
		$("#p"+i+"-ability").val(pkm.ability);
		$("#p"+i+"-item").val(pkm.item);
		$("#p"+i+"-species").val(pkm.species.toLowerCase().replace("-","")).trigger('change');
		$("#p"+i+"-nature").val(pkm.nature);

		for (var j = 0; j < pkm.moves.length; j++) {
			move = pkm.moves[j];
			$("#p"+i+"-m"+(j+1)).val(move);
		};

		if(pkm.evs){
			if(pkm.evs.hp)
				$("#p"+i+"-ev-hp").val(pkm.evs.hp);

			if(pkm.evs.atk)
				$("#p"+i+"-ev-atk").val(pkm.evs.atk);

			if(pkm.evs.spd)
				$("#p"+i+"-ev-spd").val(pkm.evs.spd);

			if(pkm.evs.def)
				$("#p"+i+"-ev-def").val(pkm.evs.def);

			if(pkm.evs.satk)
				$("#p"+i+"-ev-satk").val(pkm.evs.satk);

			if(pkm.evs.sdef)
				$("#p"+i+"-ev-sdef").val(pkm.evs.sdef);
		}

		if(pkm.ivs){
			if(pkm.ivs.hp)
				$("#p"+i+"-iv-hp").val(pkm.evs.hp);

			if(pkm.ivs.atk)
				$("#p"+i+"-iv-atk").val(pkm.evs.atk);

			if(pkm.ivs.spd)
				$("#p"+i+"-iv-spd").val(pkm.evs.spd);

			if(pkm.ivs.def)
				$("#p"+i+"-iv-def").val(pkm.evs.def);

			if(pkm.ivs.satk)
				$("#p"+i+"-iv-satk").val(pkm.evs.satk);

			if(pkm.ivs.sdef)
				$("#p"+i+"-iv-sdef").val(pkm.evs.sdef);
		}
	};
}