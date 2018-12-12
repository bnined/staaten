<!DOCTYPE html>

<html lang="de">

  <head>
    <title>Sichere Herkunftsstaaten</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans|Source+Sans+Pro" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Serif:700i&subset=latin-ext" rel="stylesheet">
    <link href="/02_staaten_neu/styles.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css"> -->
  </head>

  <body>

    <header>
      <?php

      ?>

      <!-- Navigation -->
      <div id="wrap">
        <div id="hauptmenue">
          <nav id="navigation" class="hiddenmenue flexbox">

            <!-- h1 für den Screenreader, ist ansonsten ausgeblendet -->
            <h1>Metanavigation</h1>
            <div>
              <ul class="flexbox">
                <?php
                if($this->session->lang == "de") {
                  echo "<li><a href='".site_url('start/index')."'>Start</a></li>
                  <li><a href='".site_url('konzept/index')."'>Konzept</a></li>
                  <li><a href='".site_url('staaten/index')."'>Staaten</a></li>
                  <li><a href='".site_url('kritik/index')."'>Kritik</a></li>
                  <li><a href='".site_url('faq/index')."'>FAQ</a></li>";
                  if($this->session->logged_in) {
                    echo "<li><a href='".site_url('news/index')."'>News</a></li>";
                  }
                } elseif($this->session->lang == "en") {
                  echo "<li><a href='".site_url('start/index')."'>Start</a></li>
                  <li><a href='".site_url('konzept/index')."'>Concept</a></li>
                  <li><a href='".site_url('staaten/index')."'>States</a></li>
                  <li><a href='".site_url('kritik/index')."'>Critique</a></li>
                  <li><a href='".site_url('faq/index')."'>FAQ</a></li>";
                  if($this->session->logged_in) {
                    echo "<li><a href='".site_url('news/index')."'>News</a></li>";
                  }
                }
                ?>
              </ul>
            </div>

            <!-- Sprachauswahl -->

            <!--
            <div>
              <form id="sprachauswahl" action="#">
              <input type="submit" name="de" method="post" value="de">
              <input type="submit" name="en" method="post" value="en">
            </form>
            </div>
          -->

            <!-- Admin-Funktionen -->

            <div>
              <?php
                if (isset($this->session->userdata['logged_in'])) {
                  echo "<p><b id='logout'><a href='../admin/logout'>Logout</a></b></p>";
                  echo "<p><b id='bearbeiten'><a href='../admin/bearbeiten'>Bearbeiten</a></b></p>";
                }


               ?>
            </div>


          </nav>
        </div>   <!-- Ende wrap -->
      </div>

        <!-- Titel  -->
        <!-- ============ Link zur Startseite setzen ============= -->
        <div id="headerschriftzug">
          <a href="<?= site_url('start/index')?>">
            <h1>sichere herkunftsstaaten</h1>
            <h2>
            <?php
            if($this->session->lang == "de") {
              echo ">> unabhängiges Informationsportal zu sicheren Herkunftsländern <<";
            } elseif($this->session->lang == "en") {
              echo ">> independent information portal on safe countries of origin <<";
            }

            ?></h2>
          </a>
        </div>

        <!-- Staatennavigation -->

        <nav id="staatennavigation">
          <form action="<?= site_url('staaten/index')?>" method="post">

          <?php $first = true; ?>
          <?php foreach ($laenderliste as $id => $land):?>

            <?php if($first) {$first = false;} else { echo " | "; } ?>

              <?php
              //echo "<a href='".site_url('staaten/index')."'>";
              echo '<button type="submit" name="land" value="'.$id.'">'.$land.'</button>';
              ?>
            </a>
          <?php endforeach;?>
        </form>


        </nav>

    </header>
