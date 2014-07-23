(function($, window, document) {
	base_url = '/cdb/';
	var data_table_full = $('.data-table-full');
	var data_table = $('.data-table');
	stats = ['hp', 'atk', 'def', 'sp_atk', 'sp_def', 'spd'];
	var i_s = $('.item-strategy'); //item strategy
    var dmc = $('#data-container');
    var data_modal = $('.data-modal');
    var mt = $('.modal-title');

	var nmod_calc = function(nature, stat) {
		var natures = {
			Adamant:{atk:1.1,sp_atk:0.9},
			Bashful:{all:1}, 
			Bold:{def:1.1,atk:0.9}, 
			Brave:{atk:1.1,spd:0.9}, 
			Calm:{sp_def:1.1,atk:0.9}, 
			Careful:{sp_def:1.1,sp_atk:0.9}, 
			Docile:{all:1}, 
			Gentle:{sp_def:1.1,def:0.9}, 
			Hardy:{all:1}, 
			Hasty:{spd:1.1,def:0.9}, 
			Impish:{def:1.1,sp_atk:0.9}, 
			Jolly:{spd:1.1,sp_atk:0.9}, 
			Lax:{def:1.1,sp_def:0.9}, 
			Lonely:{atk:1.1,def:0.9}, 
			Mild:{sp_atk:1.1,def:0.9}, 
			Modest:{sp_atk:1.1,atk:0.9}, 
			Naive:{spd:1.1,sp_def:0.9}, 
			Naughty:{atk:1.1,sp_def:0.9}, 
			Quiet:{sp_atk:1.1,spd:0.9}, 
			Quirky:{all:1}, 
			Rash:{sp_atk:1.1,sp_def:0.9}, 
			Relaxed:{def:1.1,spd:0.9}, 
			Sassy:{sp_def:1.1,spd:0.9}, 
			Serious:{all:1}, 
			Timid:{spd:1.1,atk:0.9}}
			if (natures[nature].hasOwnProperty(stat)) {
				return natures[nature][stat];
			} else {
				return 1;
			};
		}
		var stat_calc = function() {
			$.each(stats, function(index, val) {
				var base = $('#'+val).text()*1;
			// console.log(base);
			if (val == 'hp') {
				var min = Math.floor(base * 2  + 110);
				var max = Math.floor(base * 2 + 31 + 252/4 + 110);
				$('#min_'+val).text(min);
				$('#max_'+val).text(max);
			} else {
				var min_m = Math.floor((base * 2 + 5) * 0.9);
				var min = Math.floor(base * 2 + 5);
				var max = Math.floor(base * 2 + 31 + 252/4 + 5);
				var	max_p = Math.floor((base * 2 + 31 + 252/4 + 5) * 1.1);
				$('#min_m_'+val).text(min_m);
				$('#min_'+val).text(min);
				$('#max_'+val).text(max);
				$('#max_p_'+val).text(max_p);
			}
		});
		}
		var stat_calc_by_lv = function(lv) {
			$.each($('.str-stat'), function() {
				var stat_table = $(this);
				var stat = 0;
				var nature = $(this).attr('data-nature');
				$.each(stats, function(index, val) {
					var base_stat = stat_table.find('#base_'+val).text()*1;
					var ev = stat_table.find('#ev_'+val).text()*1;
					var iv = stat_table.find('#iv_'+val).text()*1;
					var nmod = nmod_calc(nature, val);
					if (val == 'hp') {
						stat = Math.floor((base_stat * 2 + iv + (ev/4)) * lv / 100 + 10 + lv*1)
						stat_table.find('#total-'+val).text(stat)
					} else {
						stat = Math.floor(((base_stat * 2 + iv + (ev/4)) * lv / 100 + 5) * nmod)
						stat_table.find('#total-'+val).text(stat);
					}
				});
			});
		}
		var load_strategy_dex = function(species_id) {
			return $.ajax({
				url: base_url+'pokemon/get_strategy',
				type: 'post',
				dataType: 'html',
				data: {
					species_id: species_id
				}
			})		
		}
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
		var get_ab_desc = function(ab_id) {
			return $.ajax({
				url: base_url+'common/get_ab_desc',
				type: 'post',
				dataType: 'html',
				async: false,
				data: {ab_id: ab_id},
			});
		}

		$(function() {
		// $('.select2').select2();
		$('.selectpicker').selectpicker({
			style: 'btn-sm btn-default',
			size: 8,
			width: '100%',
		});
		$(document).on('click', 'a[href="#"]', function(event) {
			event.preventDefault();
		});
		$('.ability').hover(function() {
			if ($(this).attr('data-content') == "") {
				var desc = "";
				desc = get_ab_desc($(this).attr('data-ab-id')).done(function(response) {
					desc = response;
				})
				$(this).attr('data-content', desc.responseText);
			};
		});
		var poptions = {
			placement: 'top',
			animation: true,
			selector: false,
			trigger: 'hover',
			delay: 0,
			html: true,
		};
		$('.ability').popover(poptions);
		stat_calc();
		stat_calc_by_lv(100);
		$.each($('.str-stat'), function() {
			var stat_table = $(this);
			var nature = $(this).attr('data-nature');
			$.each(stats, function(index, val) {
				var nmod = nmod_calc(nature, val);
				if (nmod == 1.1) {
					stat_table.find('#total-'+val).addClass('text-red');
				};
				if (nmod == 0.9) {
					stat_table.find('#total-'+val).addClass('text-blue');
				};
			});
		});
		
		var set_modal_title = function(t) {
			mt.empty().append(t);
		}
		i_s.on('click', function(event) {
			event.preventDefault();
			var item_id = $(this).attr('data-item-id');
			get_modal_data(item_id, 'item_strategy').success(function(response) {
				dmc.empty().append(response.html);
				set_modal_title(response.title);
			});
			data_modal.modal('show');
		});
		$('.calc-stats').on('click', function() {
			var lv = $(this).attr('data-lv');
			stat_calc_by_lv(lv)
		});
		
		//SLIMSCROLL FOR CHAT WIDGET
	    // $(".pkm-list").slimscroll({
	    // 	width: "200px",
	    //     height: "350px",
	    //     alwaysVisible: false,
	    //     wheelStep:1,
	    // });
data_table_full.dataTable({
	"orderMulti": true,
	"pageLength": 50,
});
data_table.dataTable({
	"bPaginate": false,
	"bLengthChange": false,
	"bFilter": false,
	"bSort": true,
	"bInfo": true,
});
});
}(window.jQuery, window, document));

