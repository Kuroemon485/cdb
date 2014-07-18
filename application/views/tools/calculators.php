<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Tools
        <small>Calculators</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="<?php echo base_url(); ?>tools"><i class="fa fa-wrench"></i> Tools</a></li>
        <li class="active">Calculators</li>
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
                    <li class="active"><a href="#iv-calc" data-toggle="tab">IV calculator</a></li>
                    <li class=""><a href="#dmg-calc" data-toggle="tab">Damage Calculator</a></li>
                    <li class="pull-left header"><i class="fa fa-wrench"></i></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="iv-calc">
                        <div class="row">
                            <div class="col-md-3" id="sprite"></div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="" class="label-control">Pokémon Species</label>
                                        <div class="row">
                                            <div class="col-md-6 col-xs-6">
                                                <input type="text" class="form-control input-sm" id="name" name="name"/>
                                                <label class="label-control">Type: </label><span id="types" class="text-green"></span>
                                            </div>
                                            <div class="col-md-6 col-xs-6">
                                                <select id="species" class="form-control input-sm" name="species">
                                                    <option value="0">Select a species</option>
                                                </select>
                                                <label class="label-control">Egg Group: </label><span id="eggs" class="text-green"></span>
                                            </div>
                                        </div>
                                    </div> <!-- .col-md-5 -->
                                    <div class="col-md-3 col-xs-6">
                                        <label class="label-control">Nature</label>
                                        <select class="form-control input-sm" class="form-control" id="nat" name="nat">
                                            <option value="-1">Select a nature</option>
                                            <option value="14">Adamant</option>
                                            <option value="1">Bashful</option>
                                            <option value="6">Bold</option>
                                            <option value="22">Brave</option>
                                            <option value="8">Calm</option>
                                            <option value="16">Careful</option>
                                            <option value="2">Docile</option>
                                            <option value="12">Gentle</option>
                                            <option value="3">Hardy</option>
                                            <option value="13">Hasty</option>
                                            <option value="15">Impish</option>
                                            <option value="17">Jolly</option>
                                            <option value="19">Lax</option>
                                            <option value="10">Lonely</option>
                                            <option value="11">Mild</option>
                                            <option value="7">Modest</option>
                                            <option value="21">Naive</option>
                                            <option value="18">Naughty</option>
                                            <option value="24">Quiet</option>
                                            <option value="5">Quirky</option>
                                            <option value="20">Rash</option>
                                            <option value="23">Relaxed</option>
                                            <option value="25">Sassy</option>
                                            <option value="4">Serious</option>
                                            <option value="9">Timid</option>
                                        </select>
                                    </div> <!-- .col-md-2 -->
                                    <div class="col-md-3 col-xs-6">
                                        <label class="label-control text-blue" data-original-title="Optional. Ask the Hidden Power psychic in Anistar City, second house to the East, starting from the Pokémon Center. Mistralton City).">Hidden Power <i class="fa fa-star"></i></label>
                                        <select class="form-control input-sm" name="hpt" id="hpt">
                                            <option value="-1">Select a type</option>
                                            <option value="5">Bug</option>
                                            <option value="15">Dark</option>
                                            <option value="14">Dragon</option>
                                            <option value="11">Electric</option>
                                            <option value="16">Fairy (???)</option>
                                            <option value="0">Fighting</option>
                                            <option value="8">Fire</option>
                                            <option value="1">Flying</option>
                                            <option value="6">Ghost</option>
                                            <option value="10">Grass</option>
                                            <option value="3">Ground</option>
                                            <option value="13">Ice</option>
                                            <option value="2">Poison</option>
                                            <option value="12">Psychic</option>
                                            <option value="4">Rock</option>
                                            <option value="7">Steel</option>
                                            <option value="9">Water</option>
                                        </select>
                                    </div><!--  .col-md-2 -->
                                </div> <!-- .row -->
                                <div class="row">
                                    <div class="col-md-5">
                                        <label class="label-control" data-original-title="Optional: (Diamond/Pearl onwards).">Characteristic *</label>
                                        <div class="row">
                                            <div class="col-md-6 col-xs-6">
                                                <input type="text" id="charn" name="charn" class="form-control input-sm" />
                                            </div>
                                            <div class="col-md-6 col-xs-6">
                                                <select class="form-control input-sm" id="char" name="char">
                                                    <option value="-1">Select a characteristic</option>
                                                    <option value="1.2">A little quick-tempered</option>
                                                    <option value="5.1">Alert to sounds</option>
                                                    <option value="2.1">Capable of taking hits</option>
                                                    <option value="2.3">Good endurance</option>
                                                    <option value="2.4">Good perseverence</option>
                                                    <option value="4.3">Hates to lose</option>
                                                    <option value="3.0">Highly curious</option>
                                                    <option value="2.2">Highly persistent</option>
                                                    <option value="5.2">Impetuous and silly</option>
                                                    <option value="1.3">Likes to fight</option>
                                                    <option value="0.4">Likes to relax</option>
                                                    <option value="5.0">Likes to run</option>
                                                    <option value="1.1">Likes to thrash about</option>
                                                    <option value="0.0">Loves to eat</option>
                                                    <option value="3.1">Mischievous</option>
                                                    <option value="0.2">Nods off a lot</option>
                                                    <option value="3.3">Often lost in thought</option>
                                                    <option value="1.0">Proud of its power</option>
                                                    <option value="1.4">Quick tempered</option>
                                                    <option value="5.4">Quick to flee</option>
                                                    <option value="0.3">Scatters things often</option>
                                                    <option value="5.3">Somewhat of a clown</option>
                                                    <option value="4.4">Somewhat stubborn</option>
                                                    <option value="4.1">Somewhat vain</option>
                                                    <option value="4.0">Strong willed</option>
                                                    <option value="4.2">Strongly defiant</option>
                                                    <option value="2.0">Sturdy body</option>
                                                    <option value="0.1">Takes plenty of siestas</option>
                                                    <option value="3.2">Thoroughly cunning</option>
                                                    <option value="3.4">Very finicky</option>
                                                <!--
                                                Hiruneoyokusuru - Often dozes off - Takes plenty of siestas (HP%5=1)
                                                Inemurigaooi - Often scatters things - Nods off a lot - (HP%5=2)
                                                Monooyokuchirasu - Scatters things often - Scatters things often - (HP%5=3)
                                                -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="label-control" data-original-title="Optional. Ask the Stat Judge inside the Pokémon Center in Kiloude City.">Overall Potential *</label>
                                        <select class="form-control input-sm" name="pot0" id="pot0">
                                            <option value="-1">Select a potential</option>
                                            <option value="0">Decent all around [0-90]</option>
                                            <option value="1">Above average [91-120]</option>
                                            <option value="2">Relatively superior [121-150]</option>
                                            <option value="3">Outstanding [151-186]</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="label-control text-blue">Best Stat(s) <i class="fa fa-star"></i></label>
                                        <div class="row">
                                            <div class="col-md-6 col-xs-6">
                                                <select class="form-control input-sm" name="pot1" id="pot1" size="1" multiple="multiple">
                                                    <option value="-1">Best stat(s)</option>
                                                    <option value="0">HP</option>
                                                    <option value="1">Attack</option>
                                                    <option value="2">Defense</option>
                                                    <option value="3">Sp. Attack</option>
                                                    <option value="4">Sp. Defense</option>
                                                    <option value="5">Speed</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-xs-6">
                                                <select class="form-control input-sm" name="pot2" id="pot2">
                                                    <option value="-1">How good?</option>
                                                    <option value="0">Decent</option>
                                                    <option value="1">Good</option>
                                                    <option value="2">Fantastic</option>
                                                    <option value="3">Can't be beat!</option>
                                                </select>
                                            </div>
                                        </div> <!-- .row -->
                                    </div> <!-- .col-md-4 -->
                                </div> <!-- .row -->
                            </div> <!-- .col-md-9 -->
                        </div> <!-- .row -->


                        <div class="row">
                            <div class="col-sm-6">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <th colspan="7">Damage Taken</th>
                                        </tr>
                                    </thead>
                                    <tr><th>&times;0</th><td id="dmg0" class="left"></td></tr>
                                    <tr><th>&times;&frac14;</th><td id="dmg1" class="left"></td></tr>
                                    <tr><th>&times;&frac12;</th><td id="dmg2" class="left"></td></tr>
                                    <tr><th>&times;2</th><td id="dmg8" class="left"></td></tr>
                                    <tr><th>&times;4</th><td id="dmg16" class="left"></td></tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr class="ext">
                                            <th></th>
                                            <th>HP</th>
                                            <th>Atk</th>
                                            <th>Def</th>
                                            <th>Sp.A</th>
                                            <th>Sp.D</th>
                                            <th>Spd</th>
                                            <th>#Dex</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="ext">
                                            <th>Nature Effects</th>
                                            <td></td>
                                            <td class="right" id="nate-1">-</td>
                                            <td class="right" id="nate-2">-</td>
                                            <td class="right" id="nate-3">-</td>
                                            <td class="right" id="nate-4">-</td>
                                            <td class="right" id="nate-5">-</td>
                                        </tr>
                                        <tr class="ext">
                                            <th>Base Stats</th>
                                            <td class="right" id="base0"></td>
                                            <td class="right" id="base1"></td>
                                            <td class="right" id="base2"></td>
                                            <td class="right" id="base3"></td>
                                            <td class="right" id="base4"></td>
                                            <td class="right" id="base5"></td>
                                            <td><input class="form-control input-sm" type="text" id="number" name="number" maxlength="3" size="3" value="0" /></td>
                                        </tr>
                                        <tr class="eps ext">
                                            <th>Effort Points</th>
                                            <td class="right" id="eff0"></td>
                                            <td class="right" id="eff1"></td>
                                            <td class="right" id="eff2"></td>
                                            <td class="right" id="eff3"></td>
                                            <td class="right" id="eff4"></td>
                                            <td class="right" id="eff5"></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> <!-- col-md-6 -->
                        </div> <!-- .row -->

                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Level</th>
                                            <th></th>
                                            <th>HP</th>
                                            <th>Atk</th>
                                            <th>Def</th>
                                            <th>Sp.A</th>
                                            <th>Sp.D</th>
                                            <th>Spd</th>
                                            <td>#Dex</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="statrow-0">
                                            <td>
                                                <input type="radio" class="radio" name="act" id="act-0" value="0" checked="checked" data-original-title="(De)Activate this row." style="display: none"/>
                                                <span id="btn-addrow" class="btn btn-primary btn-sm" title="Add new row."><i class="fa fa-plus"></i></span>
                                            </td>
                                            <td><input class="form-control input-sm" type="text"  id="level-0" name="level-0" maxlength="3" size="3"/></td>
                                            <td>Stats:</td>
                                            <td><input class="form-control input-sm" type="text" name="stat0-0" id="stat0-0" maxlength="3" size="3" value="" /></td>
                                            <td><input class="form-control input-sm" type="text" name="stat1-0" id="stat1-0" maxlength="3" size="3" value="" /></td>
                                            <td><input class="form-control input-sm" type="text" name="stat2-0" id="stat2-0" maxlength="3" size="3" value="" /></td>
                                            <td><input class="form-control input-sm" type="text" name="stat3-0" id="stat3-0" maxlength="3" size="3" value="" /></td>
                                            <td><input class="form-control input-sm" type="text" name="stat4-0" id="stat4-0" maxlength="3" size="3" value="" /></td>
                                            <td><input class="form-control input-sm" type="text" name="stat5-0" id="stat5-0" maxlength="3" size="3" value="" /></td>
                                            <td>
                                                <input class="form-control input-sm" disabled="disabled" class="form-control input-sm" type="text" id="number-0" name="number-0" maxlength="3" size="3" value="0" />
                                                <input type="hidden" id="nat-0" name="nat-0" value="" />
                                                <input type="hidden" id="char-0" name="char-0" value="" />
                                                <input type="hidden" id="hpt-0" name="hpt-0" value="" />
                                                <input type="hidden" id="pot0-0" name="pot0-0" value="" />
                                                <input type="hidden" id="pot1-0" name="pot1-0" value="" />
                                                <input type="hidden" id="pot2-0" name="pot2-0" value="" />
                                            </td>
                                        </tr>
                                        <tr id="eprow-0" class="eps"><td></td><td id="eps-0"></td><td>EVs:</td>
                                            <td><input class="form-control input-sm" type="text" name="ep0-0" id="ep0-0" maxlength="3" size="3" value="0" /></td>
                                            <td><input class="form-control input-sm" type="text" name="ep1-0" id="ep1-0" maxlength="3" size="3" value="0" /></td>
                                            <td><input class="form-control input-sm" type="text" name="ep2-0" id="ep2-0" maxlength="3" size="3" value="0" /></td>
                                            <td><input class="form-control input-sm" type="text" name="ep3-0" id="ep3-0" maxlength="3" size="3" value="0" /></td>
                                            <td><input class="form-control input-sm" type="text" name="ep4-0" id="ep4-0" maxlength="3" size="3" value="0" /></td>
                                            <td><input class="form-control input-sm" type="text" name="ep5-0" id="ep5-0" maxlength="3" size="3" value="0" /></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                    <tfoot id="statrows"></tfoot>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-sm-6">
                                <table class="table table-condensed" id="mode0">
                                    <thead>
                                        <tr>
                                            <th colspan="7">Individual Values</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td></td><td>HP</td><td>Atk</td><td>Def</td><td>Sp.A</td><td>Sp.D</td><td>Spd</td></tr>
                                            <tr>
                                            <td><input name="medl" id="medl" class="ext tooltip" type="checkbox" title="Lock Median IVs."/> Median:</td>
                                            <td><input class="form-control input-sm" type="text" name="med0-0" id="med0-0" maxlength="2" size="2"/></td>
                                            <td><input class="form-control input-sm" type="text" name="med1-0" id="med1-0" maxlength="2" size="2"/></td>
                                            <td><input class="form-control input-sm" type="text" name="med2-0" id="med2-0" maxlength="2" size="2"/></td>
                                            <td><input class="form-control input-sm" type="text" name="med3-0" id="med3-0" maxlength="2" size="2"/></td>
                                            <td><input class="form-control input-sm" type="text" name="med4-0" id="med4-0" maxlength="2" size="2"/></td>
                                            <td><input class="form-control input-sm" type="text" name="med5-0" id="med5-0" maxlength="2" size="2"/></td>
                                        </tr>
                                        <tr title="Next helpful Level or exact EPs for exact IV (same Level).">
                                            <td>+ Lv.<br>+ EPs</td>
                                            <td id="plv0-0"></td>
                                            <td id="plv1-0"></td>
                                            <td id="plv2-0"></td>
                                            <td id="plv3-0"></td>
                                            <td id="plv4-0"></td>
                                            <td id="plv5-0"></td>
                                        </tr>
                                        <tr>
                                            <td>Spread:</td>
                                            <td id="spr0-0" class="right"></td>
                                            <td id="spr1-0" class="right"></td>
                                            <td id="spr2-0" class="right"></td>
                                            <td id="spr3-0" class="right"></td>
                                            <td id="spr4-0" class="right"></td>
                                            <td id="spr5-0" class="right"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- col-md-6 -->
                        </div> <!-- .row -->

                        <div class="row">
                            <div class="col-sm-4">
                                <label class="label-control text-green">Result</label>
                                <b><p class="text-red" id="status">Self Destruct Immediate!<br/>Enable JavaScript or report this error if it persists.</p></b>
                            </div>
                            <div class="col-sm-4">
                                <table class="table table-condense">
                                    <label for="" class="label-control">Hidden Power</label>
                                    <tr>
                                        <th for="">Type </th>
                                        <td class="text-blue" id="hiddent" class="left"></td>
                                    </tr>
                                    <tr>
                                        <th for="">Power </th>
                                        <td class="text-blue" id="hiddenp" class="left"></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-sm-4">
                                <label for="" class="label-control">
                                    Calculated Stats - <span class="btn btn-primary btn-sm" id="btn-statsmin" title="Zero IVs and EPs; hindering nature for all stats.">min</span> <span class="btn btn-primary btn-sm" id="btn-statsmax" title="Maximum IVs and EPs (unless disabled); beneficial nature for all stats.">max</span>
                                </label>
                                <table class="table table-condensed">
                                    <tr>
                                        <th>Lv.</th>
                                        <td><input class="form-control input-sm" type="text"  id="statlvl" name="statlvl" maxlength="3" size="3"/></td>
                                        <td id="stats0"></td>
                                        <td id="stats1"></td>
                                        <td id="stats2"></td>
                                        <td id="stats3"></td>
                                        <td id="stats4"></td>
                                        <td id="stats5"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-9 col-xs-9">
                                <button class="btn btn-success btn-sm" id="btn-ivs">Calculate Individual Values</button>
                                <button class="btn btn-danger btn-sm" id="btn-hp">Calculate Hidden Power</button>
                                <button class="btn btn-warning btn-sm" id="btn-stats" >Calculate Stats</button>
                            </div>
                            <div class="col-md-3 col-xs-3">
                                <small class="pull-right">Source: <a href="http://www.serebii.net/games/iv-calcxy.shtml">Serebii</a></small>
                            </div>
                        </div>



<table class="table table-condensed table-bordered" style="display: none">
<tr>
<td class="primary">
<h2 id="toggleinfo">Program information &#177;</h2>
<div id="info">
<h3>How to download this calculator</h3>
<p id="download">While in your browser window, go to <strong>File &gt; Save As...</strong> and save this page to your computer. Make sure to select <strong>HTML only</strong> when saving. You can then use it offline whenever you want.</p>
<h3>Compatible with:</h3>
<p>Several Pokémon have had their Base Stats changed in <strong>Pokémon X &amp; Y</strong>, therefore this calculator is incompatible with previous games, but you can use the <a href="http://www.legendarypokemon.net/javacalc.html">Advanced Individual Value &amp; Stat Calculator</a> instead.</p>
<h3>About</h3>
<p>This IV Calculator / Stat Calculator / Hidden Power Calculator has been written by <a href="http://archi.tect.gr">Heracles Papatheodorou a.k.a Arty2</a>, webmaster of <a href="http://www.legendarypokemon.net" id="lp">Legendary Pokémon</a>. It allows the calculation of any Pokémon's Individual Values when given the Pokémon's details.</p>
<p>It's written in <strong>JavaScript</strong> to ensure cross-system compatibility. It is a small single file download and requires nothing but a browser with JavaScript enabled. It <em>should</em> work flawlessly in Internet Explorer, Opera, Firefox, Chrome and Safari on any system, including the Nintendo DSi.</p>
<p>If you want to translate, modify this program or include it in your website, please read the License provided below.</p>

<h2 id="togglehistory">Program History &#177;</h2>
<p id="version"><span class="loading">Checking online status...</span></p>
<dl>
 <dt>Version 1 (19/November/2013)</dt>
    <dd>Forked from the <a href="http://www.legendarypokemon.net/javacalc.html">Advanced IV Calculator</a> and tailored to Pokémon X &amp; Y.</dd>
</dl>
<dl id="history">
 <dt>Version 1.0beta (14/September/2004)</dt>
    <dd>First public release.</dd>
</dl>

<h2>License</h2>
<p>This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/">Creative Commons License</a> and modification of this program's credits is <strong>prohibited</strong>.</p>
<dl>
<dt>You are free:</dt>
<dd><strong>to Share</strong> — to copy, distribute and transmit the work</dd>
<dd><strong>to Remix</strong> — to adapt the work</dd>

<dt>Under the following conditions:</dt>
<dd><strong>Attribution</strong> — You must attribute the work in the manner specified by the author or licensor (but not in any way that suggests that they endorse you or your use of the work).</dd>
<dd><strong>Noncommercial</strong> — You may not use this work for commercial purposes.</dd>
<dd><strong>Share Alike</strong> — If you alter, transform, or build upon this work, you may distribute the resulting work only under the same or similar license to this one.</dd>
</dl>
<p>Kudos to <a href="http://www.dustindiaz.com/">Dustin Diaz</a> for some of his amazing functions.</p>
<p>The program's author would be glad if notified about your modifications, including translations.</p>
<h2>Disclaimer</h2>
<p>Pokémon and related characters are &copy; Nintendo, Creatures, Gamefreak and Pokémon Inc. This unofficial, fan-made program is not endorsed by any of the above companies.</p>
</div>

</td>
<td class="secondary">
<h2 id="toggleinstructions">Instructions &#177;</h2>
    <div id="instructions">
    <h3>What are IVs and EPs?</h3>
        <p>If such terms <span class="tooltip" title="pun intented">sound Greek</span> to you, then you should read a <a href="http://www.legendarypokemon.net/training">Pokémon Training Guide</a> before using this tool.</p>
        <p>Here's some examples: <a href="javascript:code_load('?sc=0,0,1,0,Sepultura! 9,18,22,7,22,8,100! 6,45,129,79,85,106,91,107,0,0,0,0,0,0,9,4.2,4,0,2,1! 6.1,45,129,117,114,125,91,107,0,0,0,0,0,0,9,4.2,4,0,2,1')">Charizard</a>, <a href="javascript:code_load('?sc=0,0,1,0,! 31,6,10,28,6,1,100! 257,85,271,265,144,207,139,168,70,129,59,78,50,124,14,0.1,-1,0,0,3! 257.1,85,271,339,161,238,156,202,70,129,59,78,50,124,14,0.1,-1,0,0,3! 257,85,257,235,132,193,129,141,0,0,0,0,0,0,14,0.1,-1,0,0,3')">Blaziken</a></p>
    <h3>User Interface</h3>
    <dl>
        <dt>Save</dt><dd>Generates a SaveCode and a link (URL) that you can keep in your bookmarks or send to a friend.</dd>
        <dt>Load</dt><dd>Single click to load the data saved in the URL, or double-click to load any SaveCode.</dd>
    </dl>
    <h3>IV Calculation <span class="ext btn" onclick="toggle_simple();">(make it look simpler?)</span></h3>
        <p>* Fields marked with an asterisk are optional.</p>
        <p class="center ok">ALWAYS TRACK YOUR EFFORT POINTS!</p>
        <p>Every calculator will return errors if your Pokémon's Effort Points are innacurate! If necessary, feed them as many <em>anti-vitamin</em> berries as necessary, or simply use a <em>Reset Bag</em> in <em>Super Training</em> to erase all their EVs.</p>
        <p>The <em>Stat Judge</em> is located in Kiloude City, right inside the Pokémon Center. He can tell you the potential of your Pokémon and the stats with the highest IV. He will also notify you of any zero IVs. In regard to the Calculator, you can use the CTRL / CMD key to (de)select multiple stats.</p>
        <p>You can practically get 100% accurate results at level 20, using just a few Rare Candies; save beforehand if you'd like to keep them of course.</p>
        <p><strong>Single mode:</strong> The higher your Pokémon's level, the more accurate the results. If you want to calculate a low level one, then input the optional information and additional row data by leveling-up, evolving it or changing forme. The <em>+Lv.</em> and <em>+EPs</em> indicators, tell you how many apitional levels or Effort Points (same level) respectively are required to refine the resulting IV spread. Stats of alternate forms and Mega Evolutions can also improve your calculations.</p>
    <div class="ext">
        <p><strong>Team mode:</strong> Useful for IV Battles; use this to calculate multiple Pokémon at once. For an IV Battle, gather a team of low level Pokémon and battle with a friend online, forcing them to level 100, then writing down their projected stats.</p>
        <p><strong>Row mode:</strong> Use this to calculate and examine currently selected Pokémon in detail.</p>
    <h3>Stat Calculation</h3><p> Using the <em>median IVs</em>, and input Effort Points, accurately calculates a Pokémon's stats on the given level.</p>
    <h3>Hidden Power Calculation</h3>
        <p>Hidden Power's type depends on a Pokémon's IVs, but if you know its type already, it can help in calculating them.</p>
        <p>The <em>Hidden Power psychic</em> lives in Anistar City, second house to the East, starting from the Pokémon Center.</p>
        <p>Using the IV spread (or median IVs if locked) you can calculate all possible combinations.</p>
    <h3>EV training tools</h3><dl>
        <dt>EP tracking</dt><dd>Unselect an active row to enable tracking mode, then select the proper item, opponent species and number fought, to calculate the Effort Points gained.</dd>
        <dt>EPs Calculation</dt><dd>Particularly useful to competitive battlers.</dd><dd>First calculate your current Pokémon's stats, alter your current stats in the <em>first row</em>, then use this to view how many EPs are required to reach these specific stats.</dd>
    </dl>
    </div>
</div></td>
</tr>
<tr><td class="primary">
You feedback and criticism is very important! <p class="center">Please <a class="tooltip" id="contact" href="http://www.legendarypokemon.net/contact?topic=IV%20Calculator" title="Click [Save] before reporting a bug.">contact the author</a> for all errors or requests.</p>
</td>
<td class="secondary">courtesy of <a href="http://www.legendarypokemon.net">LegendaryPokemon .net</a>
</td></tr>
</table>



<div id="calculator" style="display: none">
<form id="form" action="" onsubmit="return false;">

<label for="" class="label-control">Pokemon nickname</label>
<input class="form-control input-sm" type="text" name="nickname" id="nickname" maxlength="10" size="10" title="&lt;strong&gt;Optional&lt;/strong&gt;  Pokémon's nickname" />

<table id="mode1" class="mode table table-condensed">
<tr>
<td colspan="7">Individual Values</td>
</tr>
<tbody>
    <tr>
        <td></td>
        <td>HP</td>
        <td>Atk</td>
        <td>Def</td>
        <td>Sp.A</td>
        <td>Sp.D</td>
        <td>Spd</td>
    </tr>
</tbody>
<tfoot id="ivrows"></tfoot>
</table>

<div id="gui" class="block">
<table>
<tr id="ept" class="eps ext">
<h4>Pokérus:</h4>
<input name="pkrs" id="pkrs" type="checkbox"/>
<h4>Item:</h4>
<select id="item" name="item">
    <option value="0"> </option>
    <optgroup label="Held items">
    <option value="1">Macho Brace</option>
    <option value="2">Power Weight</option>
    <option value="3">Power Bracer</option>
    <option value="4">Power Belt</option>
    <option value="5">Power Lens</option>
    <option value="6">Power Band</option>
    <option value="7">Power Anklet</option>
    </optgroup>
    <optgroup label="Vitamins">
    <option value="8">HP Up</option>
    <option value="9">Protein</option>
    <option value="10">Iron</option>
    <option value="11">Calcium</option>
    <option value="12">Zinc</option>
    <option value="13">Carbos</option>
    </optgroup>
    <optgroup label="Anti-Vitamins">
    <option value="14">Pomeg Berry</option>
    <option value="15">Kelpsy Berry</option>
    <option value="16">Qualot Berry</option>
    <option value="17">Hondew Berry</option>
    <option value="18">Grepa Berry</option>
    <option value="19">Tamato Berry</option>
    </optgroup>
</select>
<input type="text" id="times" name="times" maxlength="3" size="3" value="1" />
<input class="button tooltip" type="button" id="btn-addeps" value="+" title="Add Effort Points." />

<button class="btn btn-primary btn-sm" id="btn-evs" value="EVs: ON" style="display: none"></button>
<button class="btn btn-primary btn-sm" id="btn-theme" value="Theme" style="display: none"></button>
<button class="btn btn-primary btn-sm" id="btn-save" value="Save" style="display: none"></button>
<button class="btn btn-primary btn-sm" id="btn-load" value="Load" style="display: none"></button>

<td id="epsr"></td>
<td class="right" id="eps0"></td>
<td class="right" id="eps1"></td>
<td class="right" id="eps2"></td>
<td class="right" id="eps3"></td>
<td class="right" id="eps4"></td>
<td class="right" id="eps5"></td>

<input type="button" class="button" id="btn-mode" value="Single Pokémon" />
<input type="button" class="button" id="btn-eps" value="Calculate EPs" />
</table>
</div><!-- end gui -->
</form>
</div>


                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="dmg-calc">
                        
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div><!-- nav-tabs-custom -->
	    </div><!-- /.col -->
	</div>
    <?php #echo '<pre>';print_r($info); echo '</pre>' ?>
    <?php #echo '<pre>';print_r($pokemon); echo '</pre>' ?>
    <?php echo "<pre>{elapsed_time}/{memory_usage}</pre>";?>
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="notice-modal">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="notice-title">Warning</h4>
				</div>
				<div class="modal-body" id="notice-message">
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="success-modal">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="notice-title">Success</h4>
				</div>
				<div class="modal-body" id="notice-message">
					Hooray!
				</div>
			</div>
		</div>
	</div>
</section>
</aside>