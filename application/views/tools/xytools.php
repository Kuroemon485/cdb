<aside class="right-side">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pokemon X/Y Tools
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>xytools">X/Y Tools</a></li>
      <li class="active">Boxes Simulator</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
   <div class="row">
     <div class="col-md-12" id="">
       <!-- Primary box -->
       <div class="nav-tabs-custom">
        <ul class="nav nav-tabs pull-right">
          <li><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
          <li class=""><a href="#blind" data-toggle="tab">Coming soon...</a></li>
          <li class="active"><a href="#box-data" data-toggle="tab">Box Simulator</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="box-data">
            <div class="row">
              <div class="col-md-7 col-md-offset-1">
                <div class="box box-primary">
                  <div class="box-header">
                    <h4 class="box-title">Box 1</h4>
                    <div class="box-tools pull-right">
                      <div class="btn-group">
                        <button class="btn btn-success switch-box to-prev-box" data-to-box="31"><i class="fa fa-angle-left"></i></button>
                        <div class="btn-group">
                          <button type="button" class="btn btn-success box-num"><i class="fa fa-refresh"></i></button>
                        </div>
                        <button class="btn btn-success switch-box to-next-box" data-to-box="2"><i class="fa fa-angle-right"></i></button>
                      </div>
                      <div class="btn-group">
                        <button class="btn btn-success" id="cim"><i class="fa fa-upload"></i></button>
                        <button class="btn btn-success" id="ccm"><i class="fa fa-times"></i></button>
                        <button class="btn btn-success" id="cfm"><i class="fa fa-question"></i></button>
                      </div>
                    </div>
                  </div>
                  <div class="panel-body">
                    <?php #for ($b=1; $b <= 31; $b++): ?>
                    <table class="table poke-box table-condensed table-borderless" data-box-num="1">
                      <tbody>
                        <?php for ($r=1; $r < 6; $r++): ?>
                          <tr>
                            <?php for ($c=1; $c < 7; $c++): ?>
                              <td id="<?php echo $r."-".$c ?>" style="text-align: center;">
                                <button id="" class="btn show-info" data-container="body" data-toggle="popover" data-content="---------" data-original-title="Empty slot"><img src="<?php echo base_url() ?>public/images/empty-slot.png" alt=""></button>
                              </td>
                            <?php endfor ?>
                          </tr>
                        <?php endfor ?>
                      </tbody>
                    </table>
                    <?php #endfor ?>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <input type="search" id="search-input" class="form-control input-" placeholder="Search...">
                <div class="inline-group">
                  <label class="radio-inline"><input type="radio" name="search-type" value="species" checked><b>by species</b></label>
                  <label class="radio-inline"><input type="radio" name="search-type" value="esv" ><b>by ESV</b></label>
                </div>
                <div class="box box-primary">
                  <div class="box-body" id="result"></div>
                </div>
              </div>
            </div>
          </div><!-- /.tab-pane -->
          <div class="tab-pane" id="soon">

          </div><!-- /.tab-pane -->
        </div><!-- /.tab-content -->
      </div><!-- nav-tabs-custom -->
    </div><!-- /.col -->    
  </div>
  <!--Modals--> 

  <div class="modal fade" id="import-modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="notice-title">Raw Data</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="inline-group">
                <label class="radio-inline"><input type="radio" name="format" id="csv" checked><b>   CSV</b></label>
                <label class="radio-inline"><input type="radio" name="format" id="reddit" ><b>   Reddit</b></label>
                <label class="radio-inline"><input type="radio" name="format" id="default" ><b>   Default</b></label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <input type="file" class="input-file" name="" id="get-csv-file">
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-success" id="impd">Submit</button>
          <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" aria-hidden="true">&times; Close</button>
        </div>
      </div>
      <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog -->
  </div>
  <div class="modal fade" id="approve-modal">
    <div class="modal-dialog modal-sm" id="">
      <div class="modal-content">
        <div class="modal-header">
          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
          <h4 class="modal-title">Clear all boxes's data</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure?</p>
        </div>
        <div class="modal-footer">
          <button id="" data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
          <button id="cld" class="btn btn-danger" type="button">OK</button>
        </div>
      </div>
      <!-- /.modal-content --> 
    </div>
  </div>
  <div class="modal fade" id="boxes-list-modal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
          <h4 class="modal-title">All boxes</h4>
        </div>
        <div class="modal-body">
          <table class="table table-borderless table-condensed">
            <?php for ($i=0; $i < 4; $i++) : ?>
              <tr>
                <?php for ($j=1; $j < 9; $j++) : ?>
                  <td><button class="btn button-sm switch-box" data-toggle="tooltip" title="Box <?php echo $i*8+$j ?>" data-to-box="<?php echo $i*8+$j ?>"><img src="public/images/empty-box.ico" alt=""></button></td>
                <?php endfor ?>
              </tr>
            <?php endfor ?>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- /.modal --> 
  <div class="modal fade" id="pkm-detail-modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><b>&times;</b></button>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
          <h4 class="modal-title" id=""></h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-7">
              <table class="table condensed-table">
                <tr><td colspan="" class="detail shiny">-</td><td colspan="3" class="detail egg">-</td></tr>
                <tr><td>Nickname</td><th class="detail nname">-</th><td>ESV</td><th><span class="text-red detail esv"></span></th></tr>
                <tr><td>Species</td><th colspan="" class="detail species">-</th><th colspan="" class="detail gender"></th><th class="detail pkball"></th></tr>
                <tr><td>Ability</td><th colspan="" class="detail ability">-</th><td>HP type</td><th class="hp_type"></th></tr>
                <tr><td>Nature</td><th colspan="3" class="detail nature">-</th></tr>
                <tr><td>OT</td><th colspan="3" class="detail ot">-</th></tr>
                <tr><td>TID</td><th class="detail tid">-</th><td>SID</td><th class="detail sid">-</th></tr>
              </table>
            </div>
            <div class="col-sm-5">
              <table class="table condensed-table">
                <tr><td></td><td><span class="label label-primary">IV</span></td><td><span class="label label-success">EV</span></td></tr>
                <tr><td class="text-green">HP</td><th class="detail hp_iv">-</th><th class="detail hp_ev">-</th></tr>
                <tr><td class="text-yellow">Attack</td><th class="detail atk_iv">-</th><th class="detail atk_ev">-</th></tr>
                <tr><td class="text-orange">Defense</td><th class="detail def_iv">-</th><th class="detail def_ev">-</th></tr>
                <tr><td class="text-marine">Sp. Attack</td><th class="detail satk_iv">-</th><th class="detail satk_ev">-</th></tr>
                <tr><td class="text-blue">Sp. Defense</td><th class="detail sdef_iv">-</th><th class="detail sdef_ev">-</th></tr>
                <tr><td class="text-purple">Speed</td><th class="detail spd_iv">-</th><th class="detail spd_ev">-</th></tr>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-5 image" style="text-align: center; padding: 15px 0px;">
              <!-- <div data-widget-editbutton="false" id="" class="powerwidget powerwidget-as-portlet image"role="widget" style=""></div> -->
            </div>
            <div class="col-sm-7">
              <table class="table table-condensed">
                <tr><th>Moves</th><th>Inherited Moves</th></tr>
                <tr><td class="col-sm-6 detail move1">-</td><td class="col-sm-6 detail i_m1">-</td></tr>
                <tr><td class="col-sm-6 detail move2">-</td><td class="col-sm-6 detail i_m2">-</td></tr>
                <tr><td class="col-sm-6 detail move3">-</td><td class="col-sm-6 detail i_m3">-</td></tr>
                <tr><td class="col-sm-6 detail move4">-</td><td class="col-sm-6 detail i_m4">-</td></tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog -->
  </div>
  <div class="modal fade" id="faqs-modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="notice-title">How to use?</h4>
        </div>
        <div class="modal-body">
          <p>
            - Get you boxes data from <b class="text-red">KeySAV2</b>, using <b class="text-red">Reddit's format</b> or <b class="text-red">CSV format</b>.<br>
            - Click <button class="btn btn-success btn-sm"><i class="fa fa-upload"></i></button> and a modal will appear, paste data into textarea. <br>
            - Your <b class="text-red">Reddit</b> data should be something like this:
            <pre>
B01+

Box | Slot | Species (Gender) | Nature | Ability | HP.ATK.DEF.SPA.SPD.SPE | HiddenPower | ESV |
|:---:|:---:|:---:|:---:|:---:|:---:|:---:|:---:|:---:|:---:|:---:|:---:|:---:|:---:|:---:|
B01 | 1,1 | Heracross (♀) | Adamant | Moxie | 31.31.31.31.31.4 | Ice |  |
B01 | 1,2 | Heracross (♂) | Adamant | Moxie | 31.31.31.31.23.31 | Dark |  |
B01 | 1,3 | Heracross (♂) | Adamant | Moxie | 31.31.8.31.31.31 | Dragon |  |
B01 | 1,4 | Heracross (♀) | Adamant | Moxie | 31.31.21.31.31.31 | Dark |  |
.
.
.
B31 | 1,1 | Heracross (♂) | Adamant | Swarm | 31.31.31.31.31.31 | Dark | 2864 |
B31 | 1,2 | Charmander (♂) | Jolly | Solar Power | 31.31.31.22.31.31 | Electric | 0123 |
B31 | 1,3 | Heracross (♀) | Adamant | Moxie | 31.31.31.26.31.31 | Electric | 1003 |
B31 | 1,4 | Heracross (♂) | Adamant | Moxie | 31.31.31.0.31.31 | Electric | 0823 |
B31 | 1,5 | Heracross (♂) | Adamant | Moxie | 31.31.31.31.31.31 | Dark | 2191 |
B31 | 1,6 | Heracross (♀) | Adamant | Moxie | 31.31.31.31.30.31 | Steel | 2608 |
            </pre>
            <b class="text-red">CSV format</b> should be like this:
            <pre>
Box,Row,Column,Species,Gender,Nature,Ability,HP IV,ATK IV,DEF IV,SPA IV,SPD IV,SPE IV,HP Type,ESV,TSV,Nickname,OT,Ball,TID,SID,HP EV,ATK EV,DEF EV,SPA EV,SPD EV,SPE EV,Move 1,Move 2,Move 3,Move 4,Relearn 1, Relearn 2, Relearn 3, Relearn 4, Shiny, Egg
B02,1,1,Croagunk,♀,Adamant,Dry Skin,31,31,29,31,21,31,Dark,,1231,Croagunk,Braviary,Poké Ball,54341,39100,0,0,0,0,0,0,Astonish,(None),(None),(None),Astonish,(None),(None),(None),,
B02,1,2,Croagunk,♂,Adamant,Dry Skin,31,31,31,31,25,31,Dark,,1231,Croagunk,Braviary,Poké Ball,54341,39100,0,0,0,0,0,0,Astonish,(None),(None),(None),Astonish,(None),(None),(None),,
B02,1,3,Croagunk,♀,Adamant,Anticipation,31,1,31,31,31,31,Dark,,1231,Croagunk,Braviary,Poké Ball,54341,39100,0,0,0,0,0,0,Astonish,(None),(None),(None),Astonish,(None),(None),(None),,
.
.
.
B31,1,4,Ditto,-,Quiet,Limber,31,31,31,31,31,0,Ice,,2268,Snowflake,ズキ,Dive Ball,34497,02830,252,51,51,51,51,51,Transform,(None),(None),(None),(None),(None),(None),(None),★,
B31,1,5,Ditto,-,Adamant,Limber,31,31,31,31,31,31,Dark,,2268,メタモン,ズキ,Heavy Ball,34497,02830,252,51,51,51,51,51,Transform,(None),(None),(None),(None),(None),(None),(None),★,
B31,1,6,Ditto,-,Timid,Limber,31,31,31,31,31,31,Dark,,2268,Destiny,ズキ,Heavy Ball,34497,02830,252,51,51,51,51,51,Transform,(None),(None),(None),(None),(None),(None),(None),★,
B31,2,1,Ditto,-,Brave,Limber,31,31,31,31,31,0,Ice,,2268,Trick,ズキ,Quick Ball,34497,02830,252,51,51,51,51,51,Transform,(None),(None),(None),(None),(None),(None),(None),★,
B31,3,1,Ditto,-,Modest,Limber,31,31,31,31,31,31,Dark,,2268,Babymaker,ズキ,Heavy Ball,34497,02830,252,51,51,51,51,51,Transform,(None),(None),(None),(None),(None),(None),(None),★,
            </pre>
            - Click <button class="btn btn-sm btn-success">Submit</button>, your boxes are ready to view. <br>
            - If you think you get stuck or some thing. Click  <button class="btn btn-success btn-sm" id=""><i class="fa fa-times"></i></button> then confirm to start over. <br>
            - I will try to add more format supporting as soon as I have time.
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" aria-hidden="true">&times; Close</button>
        </div>
      </div>
      <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
  </div>
</section>
</aside>