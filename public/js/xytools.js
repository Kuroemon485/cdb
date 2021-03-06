// to do: process csv file for detailed information
// 

(function($, window, document) {
	
	$(function() {
		$('#ccm').on('click', function() {
			$('#approve-modal').modal('show');	
		});
		$('#cld').on('click', function () {
			cleardata();
			$('#approve-modal').modal('hide');
		});
		$('[data-toggle="tooltip"]').tooltip({
			trigger: "hover",
			placement: "top",
		});
		$('#faqs-modal .modal-body').slimscroll({
            height: "400px",
            size: "5px",
            alwaysVisible: true,
            wheelStep:1,
            size: "3px",
        });
        $('#result').slimscroll({
            height: "325px",
            size: "5px",
            alwaysVisible: true,
            wheelStep:1,
            size: "3px"
        });
        render_boxes_list();
        if (check_localStorage()) {
        	// console.log(check_last_box())
        	if (check_last_box()) {
        		switchbox(check_last_box());
        	} else {
        		switchbox(1);
        	}
        };
        $('.box-num').on('click', function () {
        	$('#boxes-list-modal').modal('show');
        });
		$('#cim').on('click', function () {
			$('#import-modal').modal('show');
		});
		$('#cfm').on('click', function () {
			$('#faqs-modal').modal('show');
		});
		$('.show-info').hover(function() {
        	box = $('.poke-box').attr('data-box-num');
        	pos = $(this).parent().attr('id');
        	render_info(box, pos);
        });
		$('.show-info').on('click', function(event) {
			event.preventDefault();
			if ($(this).hasClass('has-pkm')) {
				box = $('.poke-box').attr('data-box-num');
	        	pos = $(this).parent().attr('id');
	        	render_pkm_detail_modal(box, pos);
				$('#pkm-detail-modal').modal('show');
			};
		});
		var poptions = {
	    	placement: function (context, source) {
		        var position = $(source).position();
		        if (position.left > 350) {
		            return "left";
		        }
		        if (position.left < 350) {
		            return "right";
		        }
		        if (position.top < 120){
		            return "bottom";
		        }
		        return "top";
		    },
		    animation: true,
		    selector: false,
            trigger: 'hover',
            delay: 0,
            html: true,
		};
		$('.show-info').popover(poptions);
		$('#impd').on('click', function() {
			rawdata = $('#import-modal textarea').val();
			format = $('[name="format"]:checked').attr('id');
			if (rawdata != '') {
				process_boxes_data(rawdata, format);
				render_box($('.poke-box').attr('data-box-num'));
				if ($('#search-input').val().length >= 1) {
					attrts = $('[name="search-type"]:checked').val();
					render_result(search(attrts, $('#search-input').val()));
				}
				render_boxes_list();
				$('#import-modal').modal('hide');
			} else {
				return;
			}
			
		});
		$('.box-list li a').on('click', function (event) {
			event.preventDefault();
			id = $(this).attr('href').replace("#B", "");
			switchbox(id);
		});
		$(document).on('click','.switch-box', function () {
			id = $(this).attr('data-to-box');
			switchbox(id);
			$('#boxes-list-modal').modal('hide');
		});
		$('#search-input').on('keyup', function() {
			if ($(this).val().length >= 1) {
				attrts = $('[name="search-type"]:checked').val();
				render_result(search(attrts, $(this).val()));
			} else {
				clear_result();
			}
		});
		$('[name="format"]').on('ifToggled', function() {
			switch ($(this).prop('id')) {
				case 'csv':
					console.log('aaa');
					$('#get-csv-file').show();
					break;
				default:
					$('#get-csv-file').hide();
					break;
			}
		});
	});
	var base_url = '/cdb/';
	var stats = ['hp', 'atk', 'def', 'satk', 'sdef', 'spd'];
	var search_result = {};
	var rawdata = '';
	all_boxes = $.parseJSON(localStorage.getItem('boxesData'));
	var pkmdm = '#pkm-detail-modal';

	var reset_boxes = function() {
		$('.show-info img').attr('src', base_url+'public/images/empty-slot.png');
		$('.show-info').removeClass('btn-danger btn-success btn-warning btn-primary');
		$('.show-info').attr('data-original-title', 'Empty slot').attr('data-content', '-').removeClass('has-pkm');
		$('#boxes-list-modal .switch-box img').attr('src', base_url+'public/images/empty-box.png');
	}
	var reset_detail_modal = function() {
		$('.detail', pkmdm).html('-');
	}
	var cleardata = function() {
		localStorage.removeItem('boxesData');
		delete all_boxes;
		reset_boxes();
		clear_result();
	}

	function process_boxes_data(str, format) {
		console.log("Processing "+format);
		var boxes = {};
		reset_boxes();
		switch (format) {
			case 'csv':
				temp = str.trim().split("\n").slice(1);
				// console.log(temp);
				for (var i = 0; i < temp.length; i++) {
					pkm = temp[i];
					var properties = pkm.split(",");
					// console.log(properties);
					box_no = properties[0].replace('B', '')*1;
					// console.log(box_no);
					b_r = properties[1];
					b_c = properties[2];
					pos = b_r+'-'+b_c;
					if (boxes[box_no] == undefined) {
						boxes[box_no] = {};
					};
					if (boxes[box_no][pos] == undefined) {
						boxes[box_no][pos] = {};
					};
					boxes[box_no][pos]['species'] = properties[3];
					boxes[box_no][pos]['gender'] = properties[4];
					boxes[box_no][pos]['nature'] = properties[5];
					boxes[box_no][pos]['ability'] = properties[6];
					boxes[box_no][pos]['hp_iv'] = properties[7];
					boxes[box_no][pos]['atk_iv'] = properties[8];
					boxes[box_no][pos]['def_iv'] = properties[9];
					boxes[box_no][pos]['satk_iv'] = properties[10];
					boxes[box_no][pos]['sdef_iv'] = properties[11];
					boxes[box_no][pos]['spd_iv'] = properties[12];
					boxes[box_no][pos]['hp_type'] = properties[13];
					boxes[box_no][pos]['esv'] = properties[14];
					boxes[box_no][pos]['tsv'] = properties[15];
					boxes[box_no][pos]['nname'] = properties[16];
					boxes[box_no][pos]['ot'] = properties[17];
					boxes[box_no][pos]['ball'] = properties[18];
					boxes[box_no][pos]['tid'] = properties[19];
					boxes[box_no][pos]['sid'] = properties[20];
					boxes[box_no][pos]['hp_ev'] = properties[21];
					boxes[box_no][pos]['atk_ev'] = properties[22];
					boxes[box_no][pos]['def_ev'] = properties[23];
					boxes[box_no][pos]['satk_ev'] = properties[24];
					boxes[box_no][pos]['sdef_ev'] = properties[25];
					boxes[box_no][pos]['spd_ev'] = properties[26];
					boxes[box_no][pos]['move1'] = properties[27];
					boxes[box_no][pos]['move2'] = properties[28];
					boxes[box_no][pos]['move3'] = properties[29];
					boxes[box_no][pos]['move4'] = properties[30];
					boxes[box_no][pos]['i_m1'] = properties[31]; // i_m = inherited move
					boxes[box_no][pos]['i_m2'] = properties[32];
					boxes[box_no][pos]['i_m3'] = properties[33];
					boxes[box_no][pos]['i_m4'] = properties[34];
					switch (properties[35]) {
						case "★":
						boxes[box_no][pos]['is_shiny'] = true;
						break;
						case "":
						boxes[box_no][pos]['is_shiny'] = false;
						break;
						default:
						break;
					}
					switch (properties[36]) {
						case "✓":
						boxes[box_no][pos]['is_egg'] = true;
						break;
						case "":
						boxes[box_no][pos]['is_egg'] = false;
						break;
						default:
						break;
					}
					
				};
			break;

			case 'reddit':
				temp = str.trim().split("\n").slice(4);
				// console.log(temp);
				$.each(temp, function(index, val) {
					pkm = val;
					var properties = $.map(pkm.split("|"), $.trim).slice(0, 8);
					// console.log(properties);
					box_no = properties[0].replace('B', '')*1;
					pos = properties[1].split(",").join('-');
					if (boxes[box_no] == undefined) {
						boxes[box_no] = {};
					};
					if (boxes[box_no][pos] == undefined) {
						boxes[box_no][pos] = {};
					};
					s_g = properties[2].split(" ");
					boxes[box_no][pos]['species'] = s_g[0];
					boxes[box_no][pos]['gender'] = s_g[1].charAt(1); 
					boxes[box_no][pos]['nature'] = properties[3];
					boxes[box_no][pos]['ability'] = properties[4];
					spread = properties[5].replace(/\*\*/g, "").split(".");
					boxes[box_no][pos]['hp_iv'] = spread[0];
					boxes[box_no][pos]['atk_iv'] = spread[1];
					boxes[box_no][pos]['def_iv'] = spread[2];
					boxes[box_no][pos]['satk_iv'] = spread[3];
					boxes[box_no][pos]['sdef_iv'] = spread[4];
					boxes[box_no][pos]['spd_iv'] = spread[5];
					boxes[box_no][pos]['hp_type'] = properties[6];
					boxes[box_no][pos]['esv'] = properties[7];
					switch (properties[7]) {
						case "":
							boxes[box_no][pos]['is_egg'] = false;
						break;
						default:
							boxes[box_no][pos]['is_egg'] = true;
						break;
					}
				});
			break;

			case "default":
				temp = str.trim().split("\n");
				// console.log(temp);
				$.each(temp, function(index, val) {
					pkm = val;
					var properties = $.map(pkm.split(" - "), $.trim);
					// console.log(properties);
					box_no = properties[0].replace('B', '')*1;
					pos = properties[1].split(",").join('-');
					if (boxes[box_no] == undefined) {
						boxes[box_no] = {};
					};
					if (boxes[box_no][pos] == undefined) {
						boxes[box_no][pos] = {};
					};
					s_g = properties[2].split(" ");
					boxes[box_no][pos]['species'] = s_g[0];
					boxes[box_no][pos]['gender'] = s_g[1].charAt(1); 
					boxes[box_no][pos]['nature'] = properties[3];
					boxes[box_no][pos]['ability'] = properties[4];
					spread = properties[5].replace(/\*\*/g, "").split(".");
					boxes[box_no][pos]['hp_iv'] = spread[0];
					boxes[box_no][pos]['atk_iv'] = spread[1];
					boxes[box_no][pos]['def_iv'] = spread[2];
					boxes[box_no][pos]['satk_iv'] = spread[3];
					boxes[box_no][pos]['sdef_iv'] = spread[4];
					boxes[box_no][pos]['spd_iv'] = spread[5];
					boxes[box_no][pos]['hp_type'] = properties[6];
					boxes[box_no][pos]['esv'] = properties[7];
					switch (properties[7]) {
						case "":
							boxes[box_no][pos]['is_egg'] = false;
						break;
						default:
							boxes[box_no][pos]['is_egg'] = true;
						break;
					}
				});
			break;
			default:

			break;
		}
		localStorage.setItem('boxesData', JSON.stringify(boxes));
		all_boxes = boxes;
		// console.log(boxes);
		return boxes;
	}
	function handleCSVFile(evt) {
	    evt.stopPropagation();
	    evt.preventDefault();

	    var file = evt.target.files[0]; // FileList object.

	    // files is a FileList of File objects. List some properties.
	    var r = new FileReader();
		r.onload = function(e) { 
			var contents = e.target.result;
			$('#import-modal textarea').val(contents);
		}
		r.readAsText(file);
	}
	// temp - for local use only
	// function readCSVFile() {
	//     var rawFile = new XMLHttpRequest();
	//     rawFile.open("GET", "file:///E:/Dropbox/asda.csv", false);
	//     console.log(rawFile)
	//     rawFile.onreadystatechange = function () {
	//         if(rawFile.readyState === 4) {
	//             if(rawFile.status === 200 || rawFile.status == 0) {
	//             	console.log(rawFile.responseText)
	//                 $('#import-modal textarea').val(rawFile.responseText);
	//             }
	//         }
	//     }
	// }
	document.getElementById('get-csv-file').addEventListener('change', handleCSVFile, false);
	function switchbox(b_n) {
		switch (b_n) {
			case "1":
				$('.to-prev-box').attr('data-to-box', '31');
				$('.to-next-box').attr('data-to-box', '2');
				break;
			case "31":
				$('.to-prev-box').attr('data-to-box', '30');
				$('.to-next-box').attr('data-to-box', '1');
				break;
			default:
				$('.to-prev-box').attr('data-to-box', (b_n*1-1));
				$('.to-next-box').attr('data-to-box', (b_n*1+1));
				break;
		}
		render_box(b_n);
		render_boxes_list();
		localStorage.setItem('last_box', b_n);
	}
	function render_boxes_list() {
		if ( all_boxes == undefined) {
			console.log('undefined');
			return;
		};
		// console.log('defined')
		$.each(all_boxes, function(index, val) {
			// console.log(index)
			$('#boxes-list-modal [data-to-box="'+index+'"]').empty().append('<img src="'+base_url+'public/images/filled-box.png"/>');
		});
		if (!$.isEmptyObject(search_result)) {
			$.each(search_result, function(index, val) {
				$('#boxes-list-modal [data-to-box="'+index+'"]').empty().append('<img src="'+base_url+'public/images/result-box.png"/>');
			});
		};
	}
	function render_box(b_n) {
		boxname = 'Box '+b_n;
		$('.poke-box').attr('data-box-num', b_n);
		$('.box-title').text(boxname);
		// $('.box-num').text(b_n);
		reset_boxes();
		if ( all_boxes == undefined || all_boxes[b_n] == undefined) {
			reset_boxes();
			return;
		};
		// console.log(boxes);
		box = all_boxes[b_n];
		
		// console.log(box);
		$.each(box, function(index, val) {
			// console.log(val)
			pos = index;
			species = val.species;
			image = '<img src="'+base_url+'public/images/minisprites/'+species+'.png" alt="">';
			$('#'+pos+' button').empty().append(image).addClass('has-pkm');
		});
		if (!$.isEmptyObject(search_result) ) {
			if (b_n in search_result) {
				$.each(search_result[b_n], function(index, val) {
					// console.log(val)
					$('#'+val+' button').addClass('btn-primary');
				});
			}
		}
		render_boxes_list();
	}
	function render_info(box, position) {
		if ( all_boxes == undefined || all_boxes[box] == undefined || all_boxes[box][position] == undefined) {
			return;
		};
		pkm = all_boxes[box][position];
		species = pkm.species;
		gender = "";
		if (pkm.gender != "-") {
			if (pkm.gender == "♀") {
				gender = '<b class="text-red">'+pkm.gender+'</b>';
			} else {
				gender = '<b class="text-blue">'+pkm.gender+'</b>';
			}
		};
		nature = pkm.nature;
		ability = pkm.ability;
		esv = pkm.esv;
		hp = pkm.hp_type;
		iv_spread = []
		$.each(stats, function(ind, el) {
			if (pkm[el+'_iv'] != 31) {
				iv_spread[ind] = pkm[el+'_iv'];
			} else {
				iv_spread[ind] = '<b class="text-red">31</b>';
			}
		});
		title = species+" "+gender;
		iv = iv_spread.join('-');
		data = "<table class='table-condensed'><tr><td>Nature</td><th>"+nature+"</th><td>HP</td><th>"+hp+"</th></tr><tr><td>Ability</td><th colspan='2'>"+ability+"</th></tr><tr><td>IVs Spread</td><th colspan='2'>"+iv+"</th></tr>";
		if (pkm.is_egg) {
			data+="<tr><td>ESV</td><th colspan='2'>"+esv+"</th></tr>";
			title = '<span class="label label-success">egg</span> '+species+' '+gender;
		};
		if (pkm.is_shiny) {
			title = '<i class="fa fa-star text-red"></i> '+species+' '+gender;
		};
		data += "</table>";
		$('#'+position+' button').attr('data-content', data).attr('data-original-title', title);
	}
	function render_pkm_detail_modal(box, position) {
		reset_detail_modal();
		pkm = all_boxes[box][position];
		// console.log(pkm);
		icon = '<img src="'+base_url+'public/images/minisprites/'+pkm.species+'.png" alt="">';
		pos = "Box "+box+"["+position+"]";
		modal_title = icon+[pkm.species, pos].join(" - ");
		$('.modal-title', pkmdm).html(modal_title);
		switch (pkm.is_shiny) {
			case true:
				image = '<img src="'+base_url+'public/images/f-sprite-shiny/'+pkm.species+'.gif" alt="">';
				break;
			default:
				image = '<img src="'+base_url+'public/images/f-sprite/'+pkm.species+'.gif" alt="">';
				break;
		}
		$('.pkball', pkmdm).html('<img src="'+base_url+'public/images/balls/'+pkm.ball+'.png" alt="">')
		$('.image', pkmdm).html(image)
		$.each(pkm, function(index, val) {
			switch (val) {
				case "31":
					$("."+index, pkmdm).html('<span class="text-red">'+val+'</span>');
					break;
				case '(None)':
					$("."+index, pkmdm).html('-');
					break;
				case "\u2640":
					$('.gender', pkmdm).html('<b class="text-red">'+pkm.gender+'</b>');
					break;
				case "\u2642":
					$('.gender', pkmdm).html('<b class="text-blue">'+pkm.gender+'</b>');
					break;
				default:
					$("."+index, pkmdm).html(val);
					break;
			}
		});
		if (pkm.is_egg) {
			$('.egg', pkmdm).html('<span class="label label-success">EGG</span>');
		};
		if (pkm.is_shiny) {
			$('.shiny', pkmdm).html('<span class="label label-danger"><i class="fa fa-star"></i> SHINY</span>');
		};
	}
	function check_localStorage() {
		if (localStorage.getItem('boxesData') != null) {
			return true;
		} else {
			return false;
		}
	}
	function check_last_box() {
		if (localStorage.getItem('last_box') != null) {
			return localStorage.getItem('last_box');
		} else {
			return false;
		}
	}
	function search(ats, keyword) {
		var result = {};
		if (all_boxes != undefined) {
			$.each(all_boxes, function(index, val) {
				// console.log("box:"+index)
				$.each(val, function(key, value) {
					// console.log(value);
					// console.log("slot:"+key);
					if (value[ats].toLowerCase().indexOf(keyword.toLowerCase()) != -1) {
						if (result[index] == undefined) {
							result[index] = [];
						};
						result[index].push(key);
					};
				});
			});
		}
		return result;
	}
	var render_result = function(res) {
		search_result = res;
		result_html = "";
		if (!$.isEmptyObject(res)) {
			$.each(res, function(index, val) {
				result_html+='<button class="btn btn-primary btn-sm btn-block switch-box" data-to-box="'+index+'" type="button">Box '+index+'</button>';
			});
		} else {
			result_html = '<b class="text-red">Pokemon not found.</b>';
		}
		// console.log(result);
		$('#result').empty().html(result_html);
		render_box(check_last_box());
		// render_box($('poke-box').attr('data-box-num'));
	}
	function clear_result() {
		$('.show-info').removeClass('btn-primary');
		$('#boxes-list-modal [src*="result-box.png"]').prop('src', base_url+"public/images/filled-box.png");
		$('#result').empty();
	}
}(window.jQuery, window, document));