// source: 
/* 
Smaug (Charizard) (M) @ Charizardite Y
Ability: Solar Power
EVs: 4 HP / 252 SAtk / 252 Spd
Modest Nature
- Solar Beam
- Fire Blast
- Focus Blast
- Roost

Lustrous (Aegislash) (M) @ Leftovers
Ability: Stance Change
Shiny: Yes
EVs: 240 HP / 16 Atk / 252 SAtk
Quiet Nature
IVs: 30 Atk / 30 SAtk / 30 Spd
- King's Shield
- Pursuit
- Shadow Ball
- 

Excalibur (Excadrill) @ Leftovers
Ability: Mold Breaker
Shiny: Yes
EVs: 176 HP / 60 Atk / 252 SDef / 20 Spd
Adamant Nature
- Rapid Spin
- Earthquake
- Swords Dance
- Rock Slide

Goku (Infernape) @ Choice Band
Ability: Iron Fist
EVs: 4 HP / 252 Atk / 252 Spd
Jolly Nature
- Close Combat
- Flare Blitz
- U-turn
- Mach Punch

Ender (Tyranitar) (M) @ Choice Scarf
Ability: Sand Stream
Shiny: Yes
EVs: 4 HP / 252 Atk / 252 Spd
Jolly Nature
IVs: 30 Atk / 30 Def
- Pursuit
- Crunch
- Stone Edge
- Earthquake

Python (Garchomp) (F) @ Choice Scarf
Ability: Rough Skin
Shiny: Yes
EVs: 4 HP / 252 Atk / 252 Spd
Jolly Nature
IVs: 30 Atk / 30 SAtk / 30 Spd
- Stealth Rock
- Outrage
- Earthquake
- Fire Blast
*/

//var stats = ["HP", "Atk", "Def", "SAtk", "SDef", "Spd"]
//var myVariable = 'Smaug (Charizard) (M) @ Charizardite Y\nAbility: Solar Power\nShiny: No\nEVs: 4 HP \/ 252 SAtk \/ 252 Spd\nModest Nature\n- Solar Beam\n- Fire Blast\n- Focus Blast\n- Roost\n\nLustrous (Aegislash) (M) @ Leftovers\nAbility: Stance Change\nShiny: Yes\nEVs: 240 HP \/ 16 Atk \/ 252 SAtk\nQuiet Nature\nIVs: 30 Atk \/ 30 SAtk \/ 30 Spd\n- King\'s Shield\n- Pursuit\n- Shadow Ball\n- ';

var process_team_str = function(str) {
	var data = new Array();
	temp = str.split("\n\n");

	for (var i = 0; i < temp.length; i++) {

		var pointer = 0;
		elem = temp[i];
		indexs = elem.split("\n");
console.log(indexs);
		// indexs[0] = 'Smaug (Charizard) (M) @ Charizardite Y'
		temp2 = indexs[0].split(" ");

		// name
		name = temp2[0];

		// species
		species = temp2[1].substr(1, temp2[1].length - 2);

		// item
		item = indexs[0].split("@");
		item = item[1].substr(1, item[1].length);

		// ability
		ability = indexs[1].split(": ");
		ability = ability[1];

		// shiny
		shiny = indexs[2].split(": ");
		shiny = shiny[1];

		// evs
		evs = indexs[3].split(": ");
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

		// nature
		nature = indexs[4].split(" ");
		nature = nature[1];

		// ivs
		if(elem.indexOf("IVs")!= -1){
			pointer = 5;
			ivs = indexs[5].split(": ");
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
			
			ivs = _ivs;
		}else{
			pointer = 4;
			ivs = {};
		}
			
		// moves
		moves = new Array();

		for (var j = pointer +1; j < indexs.length; j++) {
			move = indexs[j].split("- ");
			moves.push(move[1]);
		};

		monster = {
			name : name,
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