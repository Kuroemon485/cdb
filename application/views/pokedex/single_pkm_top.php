<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Pokemon
        <small><?php echo $species ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="<?php echo base_url(); ?>pokedex"></i> Pokedex</a></li>
        <li class="active"><?php echo $species ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
	 	<div class="col-md-12" id="">
	        <!-- Primary box -->
	        <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <!-- <li class="dropdown">
                        <a href="#" class="text-muted" data-toggle="dropdown"><i class="fa fa-gear"></i></a>
                        <ul class="dropdown-menu drop-right pkm-list" role="menu" aria-labelledby="dLabel">
                            <?php //foreach ($pokemon_list as $pkm): ?>
                                <?php //$pkm_uri = base_url()."pokemon/".$pkm->species_id ?>
                                <li><a href="<?php //echo $pkm_uri ?>"><?php// echo $pkm->dex_id.'. '.$pkm->species; ?></a></li>
                            <?php //endforeach ?>
                        </ul>
                    </li> -->
                    <li><a href="#strategy" data-toggle="tab">Strategy</a></li>
                    <li><a href="#move-list" data-toggle="tab">Learn Set</a></li>
                    <li class="active"><a href="#pkm-detail" data-toggle="tab">Basic Details</a></li>
                    <li class="pull-left header">
                        <img src="<?php echo base_url()."public/images/minisprites/{$species}.png" ?>" alt="">
                        <select name="" id="" class="selectpicker" data-toggle="change-pokemon">
                            <!-- <option value=""><i class="fa fa-caret-square-o-down"></i></option> -->
                            <?php foreach ($pokemon_list as $pkm): ?>
                                <?php $pkm_uri = base_url()."pokemon/".$pkm->species_id ?>
                                <option value="<?php echo $pkm_uri ?>" <?php if ($pkm->species == $species) echo "selected" ?>><?php echo $pkm->dex_id.'. '.$pkm->species; ?></option>
                            <?php endforeach ?>
                        </select>
                    </li>
                </ul>
                <div class="tab-content">