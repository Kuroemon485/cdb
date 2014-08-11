(function($, window, document) {


	// variables
	var base_url = '/cdb/';
	var notice = $('#notice-modal');
	var success_modal = $('#success-modal');
	var fail_modal = $('#fail-modal');
	var	notice_message = $('#notice-message');
	var move_section = '#move-section .box-body';
	var extracted_data = new Object;
	var progress_bar = $('#import-progress');
	var log_window = $('#log');
	var progress_number = $('#progress-number');
	var enableBtn = $('.btn#enable');
	var disableBtn = $('.btn#disable');
	var importBtn = $('.btn.import');
	var result_window = $('#result');
    var pkm_list = $('.pkm-list');
    var moves_box = $('.moves-box');
    var isShiny = $('input#is-shiny');
    var stats = ['hp', 'atk', 'def', 'sp_atk', 'sp_def', 'spd'];
    var wysihtml5 = $(".wysihtml5");
    var c_pkm = pkm_list.val(); //current pokemon
    var data_modal = $('.data-modal');
    var bi = $('[data-toggle="modal"]'); //
    var f2f = ""; //field to fill
    var dmc = $('#data-container'); //data modal container
    var mt = $('.modal-title'); //modal title
    var dvb = $('[data-toggle="delete-value"]'); //delete value button

	//common events
	var tick = function(checkbox) {
		$(checkbox).prop('checked', true);
		$(checkbox).parent().addClass('checked');
	}
	var untick = function(checkbox) {
		$(checkbox).prop('checked', false);
		$(checkbox).parent().removeClass('checked');
	}
	
	//database related actions
	var get_object = function(m, t, c) { //model, table, condition
		return $.ajax({
			url: base_url+'admin/edit/get/'+m+'/'+t+'/'+c,
			type: 'post',
			dataType: 'json',
		});	
	}
    // get data for data modal
    var get_modal_data = function(id, data_type) {
        return $.ajax({
            url: base_url+'common/get_modal_data/',
            type: 'post',
            dataType: 'json',
            data: {
                id: id,
                data_type: data_type,
            }
        });
    }
    function init_response_modal(r) { //response
        $('#response-title').html(r.title);
        $('#response-message').html(r.message);
        $('#response-modal').modal('show');
        window.setTimeout(function() {$('#response-modal').modal('hide')}, 1000);
    }
	function update_data(m, t, c, d) { //model, table, condition, id
		return $.ajax({
			url: base_url+'admin/edit/update_data',
			type: 'post',
			dataType: 'json',
			data: {
				model: m,
                table: t,
                condition: c,
				data: d,
			}
		}).success(function(response) {
            init_response_modal(response);
        });
	}
	var insert_data = function(m, t, d) { //model, table, data
		return $.ajax({
			url: base_url+'admin/insert/insert_data',
			type: 'post',
			dataType: 'json',
			data: {
                model: m,
                table: t,
                data: d,
            }
		}).success(function(response) {
            init_response_modal(response);
        });
	}
    var init_progress_bar = function(max) {
        progress_bar.attr('aria-valuemax', max);
        progress_bar.attr('aria-valuenow', 0);
        progress_bar.css('width', '0%');
    }
    var iterate_progress_bar = function(max, current) {
        progress_bar.attr('aria-valuenow', (current*1)+1);
        progress_bar.css('width', ((current*1+1)/max)*100+'%');
        progress_number.empty().append(current+"/"+max);
    }
    var call_success_modal = function() {
        success_modal.modal('show');
        window.setTimeout(function() { success_modal.modal('hide') }, 1000);
    }
    var call_fail_modal = function() {
        fail_modal.modal('show');
    }
    var import_log = function(message) {
        log_window.empty().append(message);
    }
    var result_log = function(message) {
        result_window.append(message+'<br>');
    }
    var empty_result_log = function () {
        result_window.empty();
    }
	var import_js_data = function(table, object, data) {
		return $.ajax({
			url: base_url+'admin/import/process_js_data',
			type: 'post',
			dataType: 'json',
			async: false,
			data: {
				table: table,
				object: object,
				data: data
			},
		})		
	}
	// preview data from PokeAPI
	var extract_pokeAPI = function(api) {
		return $.ajax({
			url: base_url+'admin/import/get_pokeAPI',
			type: 'post',
			dataType: 'json',
			async: false,
			data: {api: api},
		})
	}
	// import data from PokeAPI
	var import_pokeAPI = function(api, table) {
		return $.ajax({
			url: base_url+'admin/import/get_pokeAPI',
			type: 'post',
			dataType: 'json',
			async: false,
			data: {
				api: api,
				table: table
			},
		})
	}
    var set_modal_title = function(t) { //title
        mt.empty().append(t);
    }
    var get_strategy_pkm_info = function(species_id) {
            return $.ajax({
                url: base_url+'teambuilder/get_species_info',
                type: 'post',
                dataType: 'json',
                async: false,
                data: {
                    species_id: species_id,
                },
            }).success(function(data) {
                init_strategy_info(data);
            });
        }
    var init_strategy_info = function(data) {
            var tbs = 0;
            $.each(stats, function(index, val) {
                $('#base-'+val).removeClass();
                $('#base-'+val+'-bar').removeClass();
                var stat = data['base_'+val]*1;
                var color = '';
                var bbg = 'badge bg-';
                var pbg = 'progress-bar progress-bar-';
                tbs+=stat;
                if ( stat < 90 ) {
                    color = "yellow";
                }
                else if ( stat >= 90 && stat <= 110 ) {
                    color = "green";
                }
                else if ( stat > 110 && stat < 150 ) {
                    color = "blue";
                }
                else if ( stat >= 150 ) {
                    color = "red";
                }
                bbg += color;
                pbg += color;
                $('#base-'+val).text(stat).addClass(bbg);
                $('#base-'+val+'-bar').css('width', stat/250*100+'%').addClass(pbg);
            });
            $('#tbs').text(tbs);

        }

	$(function(){
        pkm_list.on('change', function() {
            location = base_url+"admin/edit/pokemon/"+pkm_list.val();            
        });
        wysihtml5.wysihtml5();
		//Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-red',
            radioClass: 'iradio_flat-red',
            increaseArea: '20%',
        });
		moves_box.slimscroll({
            height: "350px",
            size: "5px",
            alwaysVisible: false,
            wheelStep:1,
            size: "3px"
        });
        dmc.slimscroll({
            height: "450px",
            alwaysVisible: false,
            wheelStep:1,
            size: "3px"
        });
        $('.selectpicker').selectpicker({
            style: 'btn-sm btn-default',
            size: 8,
            liveSearch: true,
        });
        enableBtn.click(function() {
        	importBtn.prop('disabled', false);
        });
        disableBtn.click(function() {
        	importBtn.prop('disabled', true);
        });
		
        $('#move-id').on('change', function() {
        	var id = $('#move-id').val();
        	get_object('move_model', 'move', id).done(function(data) {
        		console.log(data);
        		$.each(data, function(index, val) {
        			$('#move-'+index).val(val);
        		});
        	})
        });

        $('#ab-list').on('change', function() {
        	var id = $('#ab-id').val();
        	get_object('ability_model', 'ability', id).done(function(data) {
        		$.each(data, function(index, val) {
        			$('#ab-'+index).val(val);
        		});
        	})
        });
        $('#item-list').on('change', function() {
            var id = $('#item-list').val();
            get_object('item_model', 'item', id).done(function(data) {
                $.each(data, function(index, val) {
                    $('#item-'+index).val(val);
                });
            })
        });
        $('#news-list').on('change', function(event) {
            event.preventDefault();
            id = $(this).val();
            if (id != "") {
                get_object("news_model", "news", id).done(function(response) {
                    console.log(response);
                    $('#news-title').val(response.title);
                    $('#news-content').data("wysihtml5").editor.setValue(response.content);
                })
            };
        });
        $('#pkm-pkdx_id').on('change', function () {
        	var id = $('#pkm-pkdx_id').val();
        	get_object('_pokemon', id).done(function(data) {
        		console.log(data);
        		untick($('input:checkbox'));
        		$.each(data, function(index, val) {
        			$('#pkm-'+index).val(val);
        		});
        		if (typeof data.form == "undefined") {
    				$('#pkm-form').val('');
    			};
    			$.each(data.stats, function(index, val) {
        			$('#pkm-'+index).val(val);
    			});
    			$.each(data.types, function(index, val) {
    				$('#type-'+(index*1+1)).val(val);
    				tick($('#enable-t'+(index*1+1)));
    			});
    			$.each(data.abilities, function(index, val) {
    				$('#ability-'+(index*1+1)).val(val.id);
    				tick($('#enable-a'+(index*1+1)));
    			});
    			$.each(data.moves, function(index, val) {
    				
    			});
        	})
        });
        $('#submit-news-btn').on('click', function(event) {
            event.preventDefault();
            var data = new Object();
            data.title = $('#news-title').val();
            data.content = $('#news-content').val();
            data.post_type = $('#news-post_type').val();
            if (data.title != "" && data.content != "") insert_data('news_model', 'news', data);
        });
        $('#submit-pokemon-btn').on('click', function(event) {
            event.preventDefault();
            var data = {};
            collums = ['dex_id', 'species_id', 'species', 'base_species', 'hp', 'def', 'sp_atk', 'sp_def', 'spd', 'weight_kg', 'height_m'];
            $.each(collums, function(index, val) {
                data[val] = $('#pkm-'+val).val();
            });
            insert_data('pokemon_model', 'pokedex', data);
        });
        $('#update-ability-btn').on('click', function() {
        	var data = {};
            var condition = {};
        	collums = ['rating', 'desc', 'short_desc'];
            $.each(collums, function(index, val) {
                data[val] = $('#ab-'+val).val();
            });
            condition.id = $('#ab-id').val();
        	update_data('ability_model', 'ability', condition, data);
        });
        $('#update-move-btn').on('click', function(event) {
            event.preventDefault();
            var data = {};
            var condition = {};
            collums = ['type', 'category', 'base_power', 'pp', 'accuracy', 'desc', 'short_desc'];
            $.each(collums, function(index, val) {
                data[val] = $('#move-'+val).val();
            });
            condition.id = $('#move-id').val();
            update_data('move_model', 'move', condition, data);
        });
        $('#update-news-btn').on('click', function(event) {
            event.preventDefault();
            var data = {};
            var condition = {};
            data.title = $('#news-title').val();
            data.content = $('#news-content').val();
            condition.id = $('#news-list').val();
            if (data.title != "" && data.content != "") {
                update_data('news_model', 'news', condition, data);
            }
        });
        $('#update-item-btn').on('click', function(event) {
            event.preventDefault();
            var data = {};
            var condition = {};
            data.desc = $('#item-desc').val();
            condition.id = $('#item-list').val();
            if (data.desc != "") {
                update_data('item_model', 'item', condition, data);
            }
        });
        $('#extract').on('click', function() {
			console.log(pokedex());
        });
        $('#import-pokedex').on('click', function () {
        	$('#source').val('pokedex.js')
        	var poke_dex = pokedex();
        	// console.log(poke_dex)
			var max = Object.keys(poke_dex).length;
			var current = 0;
			init_progress_bar(max);
			empty_result_log();
        	var btn = $(this);
			btn.button('loading');
        	$.each(poke_dex, function(index, val) {
        		current++;
        		import_log('Importing '+index);
        		import_js_data('pokedex', index, val).done(function(response) {
        			result_log(response.message);
        		});
        		iterate_progress_bar(max, current);
        	});
        	call_success_modal();
			btn.button('reset');
        });
        $('#import-attackdex').on('click', function() {
        	$('#source').val('moves.js')
        	var attack_dex = moves()
        	console.log(attack_dex)
        	var max = Object.keys(attack_dex).length;
			var current = 0;
			init_progress_bar(max);
			empty_result_log();
        	var btn = $(this);
			btn.button('loading');
			var no_of_success = 0;
        	$.each(attack_dex, function(index, val) {
        		current++;
        		import_log('Importing '+index);
        		import_js_data('attack_dex', index, val).done(function(response) {
        			result_log(response.message);
        			if (response.success) {
        				no_of_success++;
        			};
        		});
        		iterate_progress_bar(max, current);
        	});
        	result_log(no_of_success+'/'+max+' moves has been added');
        	call_success_modal();
			btn.button('reset');
        });
        $('#import-abilities').on('click', function() {
        	$('#source').val('abilities.js')
        	var abilities_dex = abilities();
        	console.log(abilities_dex)
        	var max = Object.keys(abilities_dex).length;
        	var current = 0;
        	init_progress_bar(max)
        	empty_result_log();
        	var btn = $(this);
        	btn.button('loading');
        	var no_of_success = 0;
        	$.each(abilities_dex, function(index, val) {
        		current++;
        		import_log('Importing '+index);
        		import_js_data('abilities_dex', index, val).done(function(response) {
        			result_log(response.message);
        			if (response.success) {
        				no_of_success++;
        			};
        		})
        		iterate_progress_bar(max, current);
        	});
        	result_log(no_of_success+'/'+max+' abilities has been added.');
        	call_success_modal();
        	btn.button('reset');
        });
        $('#import-items').on('click', function() {
        	$('#source').val('items.js')
        	var items_dex = items();
        	console.log(items_dex)
        	var max = Object.keys(items_dex).length;
			var current = 0;
			init_progress_bar(max);
			empty_result_log();
        	var btn = $(this);
			btn.button('loading');
        	$.each(items_dex, function(index, val) {
        		current++;
        		import_log('Importing '+index);
        		import_js_data('items_dex', index, val).done(function(response) {
        			result_log(response.message);
        		});
        		iterate_progress_bar(max, current);
        	});
        	call_success_modal();
			btn.button('reset');
        });
        $('#import-learnset').click(function() {
        	$('#source').val('learnset-g6.js');
        	var learnsets = pkm_move();
        	console.log(learnsets)
        	var max = Object.keys(learnsets).length;
			var current = 0;
			init_progress_bar(max);
			empty_result_log();
        	var btn = $(this);
			btn.button('loading');
        	$.each(learnsets, function(index, val) {
        		current++;
        		import_log('Importing '+index+'\'s moves');
        		import_js_data('learn_set', index, val).done(function(response) {
        			result_log(response.message);
        		});
        		iterate_progress_bar(max, current);
        	});
        	call_success_modal();
			btn.button('reset');
        });
        $('#import-typeset').on('click', function () {
        	$('#source').val('pokedex.js')
        	var poke_dex = pokedex();
        	// console.log(poke_dex)
			var max = Object.keys(poke_dex).length;
			var current = 0;
			init_progress_bar(max);
			empty_result_log();
        	var btn = $(this);
			btn.button('loading');
        	$.each(poke_dex, function(index, val) {
        		current++;
        		import_log('Importing '+index+ '\'s types');
        		import_js_data('types_set', index, val).done(function(response) {
        			result_log(response.message);
        		});
        		iterate_progress_bar(max, current);
        	});
        	call_success_modal();
			btn.button('reset');
        });
        $('#import-abilityset').on('click', function () {
        	$('#source').val('pokedex.js')
        	var poke_dex = pokedex();
        	// console.log(poke_dex)
			var max = Object.keys(poke_dex).length;
			var current = 0;
			init_progress_bar(max);
			empty_result_log();
        	var btn = $(this);
			btn.button('loading');
        	$.each(poke_dex, function(index, val) {
        		current++;
        		import_log('Importing '+index);
        		import_js_data('abilities_set', index, val).done(function(response) {
        			result_log(response.message);
        		});
        		iterate_progress_bar(max, current);
        	});
        	call_success_modal();
			btn.button('reset');
        });


        // Events on strategy build
        $('#strategy-species-id').on('change', function() { // change Pokemon
            var pl = $(this);
            var spn = $('option:selected', pl).text();
            var spid = pl.val();
            $('[data-toggle="modal"]').attr('data-species-id', spid)
            get_strategy_pkm_info(spid);
            if(pl.val() != '') {
                $('#pkm-img').attr('src', base_url+'public/images/f-sprite/'+spn+'.gif');
                $('#ico').attr('src', base_url+'public/images/minisprites/'+spn+'.png');
            } else {
                $('#pkm-img').attr('src', base_url+'public/images/f-sprite/egg.png');
                $('#ico').attr('src', base_url+'public/images/minisprites/ani-egg.png');
            }
        });
        // isShiny.on('ifChecked', function() {
        //     var current_pkm = $(this).attr('data-species');
        //     if (current_pkm != '') {
        //         $('.pkm-sprite').attr('src', base_url+'public/images/f-sprite-shiny/'+current_pkm+'.gif');
        //     };
        // });
        // isShiny.on('ifUnchecked', function() {
        //     var current_pkm = $(this).attr('data-species');
        //     if (current_pkm != '') {
        //         $('.pkm-sprite').attr('src', base_url+'public/images/f-sprite/'+current_pkm+'.gif');
        //     };
        // });
        $(".ev-range").ionRangeSlider({
            min: 0,
            max: 252,
            type: 'single',
            step: 1,
            postfix: "",
            prettify: false,
            onChange: function(obj) {
                var input_id = 'input-'+obj.input.attr('id');
                var input_val = obj.input.val();
                $('#'+input_id).val(input_val);
            }
        });
        $('.input-ev').on('change', function() {
            var current_ev = $(this).val();
            var slider_id = $(this).attr('id').replace('input-', '');        
            $('#'+slider_id).ionRangeSlider("update", {
                from: current_ev,
            });
        });
        $('#submit-strategy').on('click', function() {
            var work_mode = $(this).data('work-mode');
            var data = new Object();
            data['species_id'] = $('#strategy-species-id').val();
            data['name'] = $('#strategy-name').val();
            data['ability_id'] = $('#strategy-ability').val().toLowerCase().replace(' ', '');
            data['nature'] = $('#nature-list').val();
            data['item_id'] = $('#strategy-item').val().toLowerCase().replace(' ', '');
            data['happiness'] = $('#strategy-happiness').val();
            data['move_1_id'] = $('#strategy-move-1').val().toLowerCase().replace(' ', '');
            data['move_2_id'] = $('#strategy-move-2').val().toLowerCase().replace(' ', '');
            data['move_3_id'] = $('#strategy-move-3').val().toLowerCase().replace(' ', '');
            data['move_4_id'] = $('#strategy-move-4').val().toLowerCase().replace(' ', '');
            data['ev_hp'] = $('#ev-hp').val();
            data['ev_atk'] = $('#ev-atk').val();
            data['ev_def'] = $('#ev-def').val();
            data['ev_sp_atk'] = $('#ev-sp_atk').val();
            data['ev_sp_def'] = $('#ev-sp_def').val();
            data['ev_spd'] = $('#ev-spd').val();
            data['iv_hp'] = $('#iv-hp').val();
            data['iv_atk'] = $('#iv-atk').val();
            data['iv_def'] = $('#iv-def').val();
            data['iv_sp_atk'] = $('#iv-sp_atk').val();
            data['iv_sp_def'] = $('#iv-sp_def').val();
            data['iv_spd'] = $('#iv-spd').val();
            data['description'] = $('#strategy-desc').val();
            console.log(data);
            if (data['species_id'] != '' && work_mode == 'add') {
                insert_data('pokemon_model', 'strategy_dex', data);
                console.log('a')
            } else if (data['species_id'] != '' && work_mode == 'edit') {
                var strategy_id = $('#strategy_list').val()
                update_data('pokemon_model', 'strategy_dex', strategy_id, data);
            }
        });

        $('#strategy_list').on('change', function() {
            var strategy_id = $(this).val();
            // console.log(strategy_id);
            if (strategy_id != '') {
                get_object('pokemon_model', 'strategy', strategy_id).done(function(data) {
                    console.log(data)
                    $('#strategy-name').val(data.name);
                    $('#strategy-ability').val(data.ability_id);
                    $('#strategy-item').val(data.item_id);
                    $('#nature-list').val(data.nature);
                    $('#strategy-happiness').val(data.happiness);
                    $('#strategy-move-1').val(data.move_1_id);
                    $('#strategy-move-2').val(data.move_2_id);
                    $('#strategy-move-3').val(data.move_3_id);
                    $('#strategy-move-4').val(data.move_4_id);
                    $('#strategy-species-id').val(data.species_id).trigger('change')
                    $.each(stats, function(index, val) {
                        var ev_value = data['ev_'+val]
                        var iv_value = data['iv_'+val]
                        $('#ev-'+val).val(ev_value);
                        $('#iv-'+val).val(iv_value);
                        // $('#ev-'+val).ionRangeSlider("update", {
                        //     from: ev_value,
                        // });
                    });
                    $("#strategy-desc").data("wysihtml5").editor.setValue(data.description);
                    // var current_pkm = isShiny.attr('data-species');
                    // if (data.is_shiny == 1) {
                    //     isShiny.iCheck('check', function() {
                    //             $('.pkm-sprite').attr('src', base_url+'public/images/f-sprite-shiny/'+current_pkm+'.gif');
                    //     })
                    // } else {
                    //     isShiny.iCheck('uncheck', function() {
                    //             $('.pkm-sprite').attr('src', base_url+'public/images/f-sprite/'+current_pkm+'.gif');
                    //     })
                    // };
                });
            }
        });
        
        bi.on('focus', function() {
            property = $(this).attr('data-input');
            f2f = $(this);
            s_id = false;
            if ($(this).attr('data-species-id')) {
                s_id = $(this).attr('data-species-id');
            };
            get_modal_data(s_id, property).success(function(response) {
                console.log(response);
                dmc.empty().append(response.html);
                set_modal_title(response.title);
            });
            data_modal.modal('show');
        });
        $(document).on('click', '[data-toggle="fill-data"]', function(){
            var d2f = $(this).attr('data-name');
            f2f.val(d2f).trigger('change');
            data_modal.modal('hide');
        });
        dvb.on('click', function() {
            var bound_input = $(this).attr('data-bound-input');
            console.log(bound_input)
            $('#'+bound_input).val('');
        });
	});
}(window.jQuery, window, document));