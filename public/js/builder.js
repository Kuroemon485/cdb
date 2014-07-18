(function($, window, document) {
	// variables
	var pkm_list = $('#pkm-pkdx_id');
    var isShiny = $('input#is-shiny');
    var data_modal = $('.data-modal');
    var bi = $('[data-toggle="modal"]');
    var c_pkm = '';
    var c_tab = 'pkm-1';
    var dmc = $('#data-container');
    var f2f = '';
    var dl = $('#data-container [data-toggle="fill-data"]');
    var mt = $('.modal-title');
	team = new Object();

    // functions 
    var get_builder_pkm_info = function(species_id) {
		return $.ajax({
			url: base_url+'teambuilder/get_species_info',
			type: 'post',
			dataType: 'json',
			data: {
				species_id: species_id,
			},
		});
	}
	var change_team_member = function(t) {
		$('#team-tab a[href="#'+t+'"]').tab('show');
		c_pkm = $('pkm-list' ,'#'+t).val();
	}
	var init_builder_info = function(tn, data) {
		var tbs = 0;
		var ct = $('#pkm-'+tn);
		$.each(stats, function(index, val) {
			$('#p'+tn+'-base-'+val, ct).removeClass();
			$('#p'+tn+'-base-'+val+'-bar', ct).removeClass();
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
			$('#p'+tn+'-base-'+val, ct).text(stat).addClass(bbg);
			$('#p'+tn+'-base-'+val+'-bar', ct).css('width', stat/250*100+'%').addClass(pbg);
			// console.log('base_'+val+": "+stat+"--->"+bbg);
			// console.log('---------------------------------');
		});
		$('#p'+tn+'-tbs', ct).text(tbs);
	}
	var set_modal_title = function(t) {
		mt.empty().append(t);
	}
	var get_modal_data = function(s_id, ppt) {
		return $.ajax({
			url: base_url+'teambuilder/get_modal_data',
			type: 'post',
			dataType: 'json',
			async: false,
			data: {
				species_id: s_id,
				property: ppt,
			},
		});
	}
	var check_cookie = function(pn) {
		team[c_tab] = new Object();
		if ($.cookie(c_tab)) {
			team[c_tab] = $.parseJSON($.cookie(c_tab));
		} else {
			if($('#p'+pn+'-species', '#'+c_tab).val() != "") {
				$('.form-control', '#'+c_tab).each(function(index, el) {
					team[c_tab][$(el).attr('id')] = $(el).val();
				});
				$.cookie(c_tab, JSON.stringify(team[c_tab]), {expire: 7, path: '/'});
			}
		}
	}
	var change_cookie = function(field) {
		var ct = $('.tab-pane.active').attr('id');
		if ($('.pkm-list', '#'+ct).val() != '') {
 			var op = field.attr('id');
			team[c_tab] = field.val();
			console.log(team);
			$.cookie(c_tab, JSON.stringify(team[c_tab]));
			console.log($.cookie(c_tab));
		}
	}

	// Document's ready!
	$(function() {
		if(localStorage.getItem('teamdata')) {
			console.log(process_team_str(localStorage.getItem('teamdata')));
		}
		$('.selectpicker').selectpicker({
			style: 'btn-sm btn-primary',
			size: 8
		});
		// init common actions
		dmc.slimscroll({
			height: "450px",
			alwaysVisible: false,
			wheelStep:1,
			size: "3px"
	    });
	    
		// set cookie for team data
		for (var i = 1; i <= 6; i++) {
			check_cookie(i);
		};
		// change cookie when pkm data's changed
 		$('.form-control', '#'+c_tab).on('change', function() {
 			var this_field = $(this);
 			change_cookie(this_field);
		});
		// set cookie - END

		// events

		bi.on('focus', function() {
			s_id = c_pkm;
			property = $(this).attr('data-input');
			f2f = $(this);
			if (s_id != "") {
				get_modal_data(s_id, property).success(function(response) {
					dmc.empty().append(response.html);
					set_modal_title(response.title);
				});
				data_modal.modal('show');
			}
		});
		$(document).on('click', '[data-toggle="fill-data"]', function(){
			var d2f = $(this).attr('data-name');
			f2f.val(d2f).trigger('change');
			data_modal.modal('hide');
		});
		$('.see-pkm').on('click', function() {
			// store current tab
			c_tab = $(this).attr('data-tab');
			change_team_member(c_tab);
		});
		$('.pkm-list').on('change', function() { // change Pokemon
			var tn = $('.tab-pane.active').attr('data-tab-number');
			var pl = $(this);
			var spn = $('option:selected', pl).text();
			var spid = pl.val();
			get_builder_pkm_info(spid).success(function(data) {
				init_builder_info(tn, data);
			});
			if(pl.val() != '') {
				$('#p'+tn+'-img').attr('src', base_url+'public/images/f-sprite/'+spn+'.gif');
				$('#p'+tn+'-ico').attr('src', base_url+'public/images/minisprites/'+spn+'.png');
			} else {
				$('#p'+tn+'-img').attr('src', base_url+'public/images/f-sprite/egg.png');
				$('#p'+tn+'-ico').attr('src', base_url+'public/images/minisprites/ani-egg.png');
			}
			c_pkm = pl.val();
		});
		$('#ie-button').on('click', function() {
			$('.ie-modal textarea').val('');
			$('.ie-modal').modal('show');
		});
		$('#import-btn').on('click', function () {
			rawdata = $('.ie-modal textarea').val();
			if (rawdata != "") {
				localStorage.setItem('teamdata', rawdata);
				console.log(process_team_str(rawdata));
			} else {
				return;
			}
			$('.ie-modal').modal('hide');
		});
		isShiny.on('ifChecked', function() { // change Pokemon's color scheme
            var current_pkm = $(this).attr('data-species');
            if (current_pkm != '') {
                $('.pkm-sprite').attr('src', base_url+'public/images/f-sprite-shiny/'+current_pkm+'.gif');
            };
        });
        isShiny.on('ifUnchecked', function() {
            var current_pkm = $(this).attr('data-species');
            if (current_pkm != '') {
                $('.pkm-sprite').attr('src', base_url+'public/images/f-sprite/'+current_pkm+'.gif');
            };
        });
        $(".ev-range").ionRangeSlider({ // EV slider events
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
        $('.input-ev').on('change', function() { // EV input events
            var current_ev = $(this).val();
            var slider_id = $(this).attr('id').replace('input-', '');        
            $('#'+slider_id).ionRangeSlider("update", {
                from: current_ev,
            });
        });
		// Events - END
	});
}(window.jQuery, window, document));