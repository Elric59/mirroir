<html>
<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<header>
    <link href="./css/global.css" rel="stylesheet">
    <link href="./css/bootstrap.css" rel="stylesheet">
    <script src="script/jquery.min.js"></script>

    <?php
    $localtime = localtime();

    $seconde = $localtime[0];
    $minute = $localtime[1];
    $heure = $localtime[2] + 1;

    ?>


    <script lang="javascript" type='text/javascript'> //Horloge

        bcle = 0;

        function clock() {
            if (bcle === 0) {
                sec = <?php echo $seconde ?>;
                min = <?php echo $minute ?>;
                h = <?php echo $heure ?>; //On donne les valeurs
            } else {
                //Test pour evité une valeur horaire impossible
                sec++;
                if (sec === 60) {
                    min++;
                    sec = 0;
                }

                if (min === 60) {
                    min = 0;
                    h++;
                }

                if (h === 24) {
                    h = 0;
                }
            }
            //On commence a ecrire sur la page
            heureActuelle = "";
            minuteActuelle = "";
            secondeActuelle = "";
            if (h < 10) {
                heureActuelle += "0";
            }
            heureActuelle += h;
            if (min < 10) {
                minuteActuelle += "0";
            }
            minuteActuelle += min;
            if (sec < 10) {
                secondeActuelle += "0";
            }
            secondeActuelle += sec;

            timer = setTimeout("clock()", 1000);
            bcle++;
            document.clock.dateH.value = heureActuelle;
            document.clock.dateM.value = minuteActuelle;
            document.clock.dateS.value = secondeActuelle;
        }



    </script>
    <?php
    $jsonfile = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=Cambrai,fr&appid=f5a52964a3d5ea22aa5b8a03738d65dc&units=metric");
    $jsondata = json_decode($jsonfile);
    $desc = $jsondata->weather[0]->description;
    ?>
    <script> //Meteo

        function meteo() {
            var url="http://api.openweathermap.org/data/2.5/weather?q=Cambrai,fr&appid=f5a52964a3d5ea22aa5b8a03738d65dc&units=metric";

            $.get(url,sucess).done(function () {

            })
                .fail(function () {
                    alert("error");
                })

                .always(function () {

                });
        }
        var sucess = function (data) {

            var emplacement = document.getElementById("Emplacement");
            emplacement.innerHTML = "Lieu : " + data.name;


            var Temp = document.getElementById("Temp");
            Temp.innerHTML = "Temperature  : " + data.main.temp +"°C";

            var TempMin = document.getElementById("TempMin");
            TempMin.innerHTML = "Temperature Min (/H): " + data.main.temp_min +"°C";

            var TempMax = document.getElementById("TempMax");
            TempMax.innerHTML = "Temperature Max (/H): " + data.main.temp_max +"°C";

            var Humidite = document.getElementById("Humidité");
            Humidite.innerHTML = "Taux humidité: " + data.main.humidity +"%";



        if(data.main.temp <= 7){ //Hiver
            document.body.style.backgroundImage = "url('https://i.pinimg.com/originals/01/c8/65/01c86579374ec006a643f70936a47d77.jpg')";
            document.body.style.backgroundRepeat = "no-repeat";
            document.body.style.backgroundSize="cover";
        }
        else if(data.main.temp >7 && data.main.temp <=15 ){ //Automne
            document.body.style.backgroundImage = "url('http://images.4ever.eu/data/download/nature/paysages/paysage-dautomne,-feuilles-colorees,-surface-de-leau-calme,-pont-162719.jpg?no-logo')";
            document.body.style.backgroundRepeat = "no-repeat";
            document.body.style.backgroundSize="cover";
        }
        else if(data.main.temp > 15 && data.main.temp <=18){//Printemps
            document.body.style.backgroundImage = "url('http://paquerettes-paris.com/wp-content/uploads/2017/04/cerisiers-japonais2.jpg')";
            document.body.style.backgroundRepeat = "no-repeat";
            document.body.style.backgroundSize="cover";
        }
        else{//Ete
            document.body.style.backgroundImage = "url('https://www.abbayevalnotredame.ca/magasin/wp-content/uploads/2018/02/paysage-ete-abbaye-val-notre-dame-02.jpg')";
            document.body.style.backgroundRepeat = "no-repeat";
            document.body.style.backgroundSize="cover";
        }
        };
    </script>


</header>
<!--  Charge la fonction dans le corps de la page  -->
<body onLoad="clock()">

<!--  Affiche l'heure  -->
<form name="clock" onSubmit="0" >

    <div class="row">
        <div class="col-sm-2 posH">
            <div  style="background-color: #0c73cd; border-radius: 15px;">
                <div >
                    <input type="text" name="dateH" size="5" readonly="true" class="tryH">
                </div>
            </div>
        </div>
        <span style="font-size: 150px ; left: 40.9%; position: absolute ;top: 150px; color: #000;"> : </span>
        <div class="row">
            <div class="col-sm-6 posM">
                <div style="background-color: #0c73cd; border-radius: 15px;">
                    <div >
                        <input type="text" name="dateM" size="5" readonly="true" class="tryM">
                    </div>
                </div>
            </div>
            <span style="font-size: 150px ; left: 55.9%; position: absolute;top: 150px;color: #000;"> : </span>
            <div class="row">
                <div class="col-sm-12 posS">
                    <div class="card" style="background-color: #0c73cd; border-radius: 15px;">
                        <div >
                            <input type="text" name="dateS" size="5" readonly="true" class="tryS">
                        </div>
                    </div>
                </div>
            </div>
</form>
<input id="Acliquer" type="hidden"  onclick="meteo()">
<script>
    Acliquer.click();
</script>

<div style="position: absolute; top: 60%; left: 19%; font-size: 35px;color: #000; background-color: lightgrey;width: 350px;border-radius: 15px;text-align: center;">
    <div id="Emplacement"></div>
    <div id="ciel">Ciel : <?php echo $desc ?></div>
</div>
<div style="position: absolute; top: 60%; left: 38%; font-size: 35px;color: #000;background-color: lightgrey;width: 490px;border-radius: 15px;text-align: center;">
    <div id="Temp"></div>
    <div id="Humidité"></div>

</div>
<div style="position: absolute; top: 60%; left: 63%; font-size: 35px;color: #000;background-color: lightgrey;width: 525px;border-radius: 15px;text-align: center;">
    <div id="TempMin"></div>
    <div id="TempMax"></div>
</div>





</body>
</html>