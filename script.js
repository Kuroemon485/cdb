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

var process_str_above = function(str) {
	return {
		Smaug:{
			species: "Charizard",
			item: "Charizardite Y",
			ability: "Solar Power",
			shiny: false,
			evs:{
				hp: 4,
				satk: 252,
				spe: 252
			},
			ivs:{

			},
			nature: "Modest",
			moves: ["Solar Beam", "Fire Blast", "Focus Blast", "Roost"],
		},
		Lustrous: {
			species: "Aegislash",
			item: "Leftovers",
			ability: "Stance Change",
			shiny: true,
			evs: {
				hp: 240,
				atk: 16,
				satk: 252,
			},
			nature: "Quiet",
			ivs: {
				atk: 30,
				satk: 30,
				spd: 30,
			},
			moves: ["King's Shield", "Pursuit", "Shadow Ball", ""],
		},
		Excalibur :{
			species: "Excadrill",
			item: "Leftovers",
			ability: "Mold Breaker",
			shiny: true,
			evs: {
				hp: 176,
				atk: 60,
				sdef: 252,
				spd: 20
			},
			nature: "Adamant",
			moves: ["Rapid Spin", "Earthquake", "Swords Dance", "Rock Slide",]
		},

		// tương tự cho 3 con còn lại
	}
}
