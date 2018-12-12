<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <title>Partie9_TP</title>
</head>
    <body>
      <p>Veuillez saisir un mois et une année pour afficher le calendrier correspondant.</p>
  <form class="" action="index.php" method="get">
    <select name="month">
      <option value="null">Mois</option>
      <option value="1">Janvier</option>
      <option value="2">Février</option>
      <option value="3">Mars</option>
      <option value="4">Avril</option>
      <option value="5">Mai</option>
      <option value="6">Juin</option>
      <option value="7">Juillet</option>
      <option value="8">Août</option>
      <option value="9">Septembre</option>
      <option value="10">Octobre</option>
      <option value="11">Novembre</option>
      <option value="12">Décembre</option>
    </select>
    <select name="year">
      <option value="null">Année</option>
      <?php
      for ($year = 1970, $value = 1970; $year <= 2032, $value <= 2032 ; $year ++ , $value ++) {
        ?>
        <option value="<?= $value?>"><?= $year;?></option>
        <?php
      }
       ?>
    </select>
    <button type="submit" name="button" class="btn btn-primary">Afficher le calendrier</button>
  </form>
      <!-- <h1>Exo9:</h1>
      <p>Faire un formulaire avec deux listes déroulantes. La première sert à choisir le mois, et le deuxième permet d'avoir l'année.</p>
      <p>En fonction des choix, afficher un calendrier comme celui ci :</p>
      <div class="container" id="date"> -->
      <nav class="navbar navbar-dark bg-primary mb-3">
        <a href="index.php" class="navbar-brand">Mon calendier</a>
      </nav>
      <?php
      require 'date/month.php';
      $month = new App\date\month($_GET['month'] ?? null, $_GET['year'] ?? null);
      $start = $month->getStartingDay()->modify('last monday'); ?>
      <!-- //  $month = new App\date\Month(); -->
      <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
        <h1><?= $month->toString(); ?></h1>
        <div>
          <a href="index.php?month=<?=$month->previousMonth()->month; ?>$year=<?= $month->previousMonth()->year; ?>" class="btn btn-primary">&lt;</a>
          <a href="index.php?month=<?=$month->nextMonth()->month; ?>$year=<?= $month->nextMonth()->year;; ?>" class="btn btn-primary">&gt;</a>
        </div>
      </div>
      <?php $month->getWeeks(); ?>
      <table class="calendar__table calendar__table--<?= $month->getWeeks(); ?>weeks">
          <?php for ($i=0; $i < $month->getWeeks(); $i++){
            ?>
            <tr>
            <?php  foreach ($month->days as $k => $day){
              $date = (clone $start)->modify( "+" . ($k + $i * 7) . " days"); ?>
                  <td class="<?= $month->withinMonth($date) ? ' ' : 'calendar__othermonth'; ?>" >
              <?php if ($i === 0){
              ?>
              <div class="calendar__weekday"><?= $day; ?></div>
              <?php
            }
               ?>
              <div class="calendar__day"><?= $date->format('d'); ?></div>
            </td>
            <?php
          }
             ?>
          </tr>
          <?php
        }
           ?>

                        <!--2 ème calendrier correction ensemble au tableau  -->
                        <?php
          /*              <!DOCTYPE html>
                        <html>
                        <head>
                          <title>Thomas Dethorey</title>
                          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                          <!-- jQuery library -->
                          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                          <!-- Latest compiled JavaScript -->
                          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                        </head>
                        <body>
                          <center><form method="post" action="">

                            <select name="month" >
                              <?php
                              // creation tableau associatif clé = chiffre; valeur = le mois
                              $yearArray = array(
                                1 => 'janvier',
                                2 => 'février',
                                3 => 'mars',
                                4 => 'avril',
                                5 => 'mai',
                                6 => 'juin',
                                7 => 'juillet',
                                8 => 'aout',
                                9 => 'septembre',
                                10 => 'octobre',
                                11 => 'novembre',
                                12 => 'décembre'
                              );
                              // boucle foreach car tableau
                              foreach ($yearArray as $key => $value){
                                ?>
                              <!-- verification si variable existente avec isset, après le if vérifier si valeur est conforme à la clé-->
                                <option value='<?= $key; ?>' <?php if(isset($_POST['month']) && $_POST['month'] == $key){
                                  // on affiche le mois selectionné
                                  echo 'selected';
                                } ?>><?= $value ;?></option>


                                <?php
                              }

                              ?>
                            </select>
                            <select name="year" >
                              <?php
                              // utilisation boucle for lorsque lorsque l'on sait à l'avance le nombre de fois que l'on va répéter l'instruction
                              for($countYear = 1970; $countYear <= 2032; $countYear++){
                                ?>
                                <!-- verification si variable existente avec isset, après le if vérifier si valeur est conforme à la clé-->
                                <option <?php if(isset($_POST['year']) && $_POST['year'] == $countYear){
                                  echo 'selected';
                                } ?>><?= $countYear ;?></option>
                                <?php
                              }
                              ?>
                            </select>
                            <input type="submit" name="submit" class="btn btn-danger">
                          </form>
                        </table>
                        <table>
                          <th><table class="table table-bordered bordered table-striped table-condensed datatable table-responsive" style="font-size:0.8vw; ">
                            <thead>
                              <div class="col-sm-1"><th>S</th></div>
                              <div class="col-sm-1"><th>M</th></div>
                              <div class="col-sm-1"><th>T</th></div>
                              <div class="col-sm-1"><th>W</th></div>
                              <div class="col-sm-1"><th>T</th></div>
                              <div class="col-sm-1"><th>F</th></div>
                              <div class="col-sm-1"><th>S</th></div>
                            </thead>
                            <tbody style="text-align:center;">
                              <tr>
                                <?php
                                if(isset($_POST['submit']))
                                {
                                  $month = $_POST['month'];
                                  $year = $_POST['year'];
                                  $day = '01';
                                  // creation variables contenant le timestamp formaté
                                  $endDate = date("t",mktime(0,0,0,$month,$day,$year));
                                  $weekDays = date ("w", mktime (0,0,0,$month,1,$year));
                                  for ($countDay = 1;$countDay<=$weekDays;$countDay++) {
                                    echo "<td style=\"font-family:arial;color:#B3D9FF\" align=center valign=middle bgcolor=\"#FFFFFF\">
                                    </td>";}
                                    for ($days = 1;$days<=$endDate;$days++) {
                                      if (date("w",mktime (0,0,0,$month,$days,$year)) == 0) { echo "<tr>"; }
                                      $fontColor="#000000";
                                      if (date("D",mktime (0,0,0,$month,$days,$year)) == "Sun")
                                      { $fontColor="red";
                                        echo "<td style=\"font-family:arial;color:#333333\" align=center valign=middle> <span style=\"color:$fontColor\">$days</span></td>";
                                      }
                                      else
                                      { $fontColor="green";
                                        echo "<td style=\"font-family:arial;color:#333333\" align=center valign=middle> <span style=\"color:$fontColor\">$days</span></td>";
                                      }
                                      if (date("w",mktime (0,0,0,$month,$days,$year)) == 6) { echo "</tr>"; }}
                                    }
                                    ?>
                                  </tr>
                                </tbody>
                              </table>
                            </center>
                          </body>
                          </html>*/ ?>

        </table>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
      </body>
      </html>
