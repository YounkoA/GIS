<?php
include "conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>siGAS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="custom.css">

    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="../assets/css/mdb.css">
    <link rel="stylesheet" href="../assets/css/mdb-min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKH2F9gZMQyATwBodQsEr-uM0fokVCvZw&callback=initMap"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">

var map;
var directionsDisplay;
var directionsService;
var polylinePath;

var nodes = [];
var prevNodes = [];
var markers = [];
var durations = [];
// Initialize google maps
function initializeMap() {
    // Map options 
    var opts = {
        
        center: new google.maps.LatLng(5.3816168,95.9615897),
        zoom: 11,
        streetViewControl: false,
        mapTypeControl: false,
    };
    map = new google.maps.Map(document.getElementById('map'), opts);
    // Create map click event
    google.maps.event.addListener(map, 'click', function(event) {
        // Add destination (max 9)
        if (nodes.length >= 10) {
            alert('Max destinations added');
            return;
        }
        // If there are directions being shown, clear them
        clearDirections();
        
        // Add a node to map
        marker = new google.maps.Marker({position: event.latLng, map: map});
        markers.push(marker);
        
        // Store node's lat and lng
        nodes.push(event.latLng);
        
        // Update destination count
        $('#destinations-count').html(nodes.length);
    });

    // Add "my location" button
    var myLocationDiv = document.createElement('div');
    new getMyLocation(myLocationDiv, map);

    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(myLocationDiv);
    
    function getMyLocation(myLocationDiv, map) {
        var myLocationBtn = document.createElement('button');
        myLocationBtn.innerHTML = 'My Location';
        myLocationBtn.className = 'large-btn';
        myLocationBtn.style.margin = '5px';
        myLocationBtn.style.opacity = '0.95';
        myLocationBtn.style.borderRadius = '3px';
        myLocationDiv.appendChild(myLocationBtn);
    
        google.maps.event.addDomListener(myLocationBtn, 'click', function() {
            navigator.geolocation.getCurrentPosition(function(success) {
                map.setCenter(new google.maps.LatLng(success.coords.latitude, success.coords.longitude));
                map.setZoom(12);
            });
        });
    }
}

// Get all durations depending on travel type
function getDurations(callback) {
    var service = new google.maps.DistanceMatrixService();
    service.getDistanceMatrix({
        origins: nodes,
        destinations: nodes,
        travelMode: google.maps.TravelMode[$('#travel-type').val()],
        avoidHighways: parseInt($('#avoid-highways').val()) > 0 ? true : false,
        avoidTolls: false,
    }, function(distanceData) {
        // Create duration data array
        var nodeDistanceData;
        for (originNodeIndex in distanceData.rows) {
            nodeDistanceData = distanceData.rows[originNodeIndex].elements;
            durations[originNodeIndex] = [];
            for (destinationNodeIndex in nodeDistanceData) {
                if (durations[originNodeIndex][destinationNodeIndex] = nodeDistanceData[destinationNodeIndex].duration == undefined) {
                    alert('Error: couldn\'t get a trip duration from API');
                    return;
                }
                durations[originNodeIndex][destinationNodeIndex] = nodeDistanceData[destinationNodeIndex].duration.value;
            }
        }

        if (callback != undefined) {
            callback();
        }
    });
}

// Removes markers and temporary paths
function clearMapMarkers() {
    for (index in markers) {
        markers[index].setMap(null);
    }

    prevNodes = nodes;
    nodes = [];

    if (polylinePath != undefined) {
        polylinePath.setMap(null);
    }
    
    markers = [];
    
    $('#ga-buttons').show();
}
// Removes map directions
function clearDirections() {
    // If there are directions being shown, clear them
    if (directionsDisplay != null) {
        directionsDisplay.setMap(null);
        directionsDisplay = null;
    }
}
// Completely clears map
function clearMap() {
    clearMapMarkers();
    clearDirections();
    
    $('#destinations-count').html('0');
}

// Initial Google Maps
google.maps.event.addDomListener(window, 'load', initializeMap);

// Create listeners
$(document).ready(function() {
    $('#clear-map').click(clearMap);

    // Start GA
    $('#find-route').click(function() {    
        if (nodes.length < 2) {
            if (prevNodes.length >= 2) {
                nodes = prevNodes;
            } else {
                alert('Click on the map to select destination points');
                return;
            }
        }

        if (directionsDisplay != null) {
            directionsDisplay.setMap(null);
            directionsDisplay = null;
        }
        
        $('#ga-buttons').hide();

        // Get route durations
        getDurations(function(){
            $('.ga-info').show();

            // Get config and create initial GA population
            ga.getConfig();
            var pop = new ga.population();
            pop.initialize(nodes.length);
            var route = pop.getFittest().chromosome;

            ga.evolvePopulation(pop, function(update) {
                $('#generations-passed').html(update.generation);
                $('#best-time').html((update.population.getFittest().getDistance() / 120).toFixed(2) + ' Mins');
                // Get route coordinates
                var route = update.population.getFittest().chromosome;
                var routeCoordinates = [];
                for (index in route) {
                    routeCoordinates[index] = nodes[route[index]];
                }
                routeCoordinates[route.length] = nodes[route[0]];

                // Display temp. route
                if (polylinePath != undefined) {
                    polylinePath.setMap(null);
                }
                polylinePath = new google.maps.Polyline({
                    path: routeCoordinates,
                    strokeColor: "#0066ff",
                    strokeOpacity: 0.75,
                    strokeWeight: 2,
                });
                polylinePath.setMap(map);
            }, function(result) {
                // Get route
                route = result.population.getFittest().chromosome;

                // Add route to map
                directionsService = new google.maps.DirectionsService();
                directionsDisplay = new google.maps.DirectionsRenderer();
                directionsDisplay.setMap(map);
                var waypts = [];
                for (var i = 1; i < route.length; i++) {
                    waypts.push({
                        location: nodes[route[i]],
                        stopover: true
                    });
                }
                
                // Add final route to map
                var request = {
                    origin: nodes[route[0]],
                    destination: nodes[route[0]],
                    waypoints: waypts,
                    travelMode: google.maps.TravelMode[$('#travel-type').val()],
                    avoidHighways: parseInt($('#avoid-highways').val()) > 0 ? true : false,
                    avoidTolls: false
                };
                directionsService.route(request, function(response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(response);
                    }
                    clearMapMarkers();
                });
            });
        });
    });
});

// GA code
var ga = {
    // Default config
    "crossoverRate": 0.5,
    "mutationRate": 0.1,
    "populationSize": 50,
    "tournamentSize": 5,
    "elitism": true,
    "maxGenerations": 50,
    
    "tickerSpeed": 60,

    // Loads config from HTML inputs
    "getConfig": function() {
        ga.crossoverRate = parseFloat($('#crossover-rate').val());
        ga.mutationRate = parseFloat($('#mutation-rate').val());
        ga.populationSize = parseInt($('#population-size').val()) || 50;
        ga.elitism = parseInt($('#elitism').val()) || false;
        ga.maxGenerations = parseInt($('#maxGenerations').val()) || 50;
    },
    
    // Evolves given population
    "evolvePopulation": function(population, generationCallBack, completeCallBack) {        
        // Start evolution
        var generation = 1;
        var evolveInterval = setInterval(function() {
            if (generationCallBack != undefined) {
                generationCallBack({
                    population: population,
                    generation: generation,
                });
            }

            // Evolve population
            population = population.crossover();
            population.mutate();
            generation++;
            
            // If max generations passed
            if (generation > ga.maxGenerations) {
                // Stop looping
                clearInterval(evolveInterval);
                
                if (completeCallBack != undefined) {
                    completeCallBack({
                        population: population,
                        generation: generation,
                    });
                }
            }
        }, ga.tickerSpeed);
    },

    // Population class
    "population": function() {
        // Holds individuals of population
        this.individuals = [];
    
        // Initial population of random individuals with given chromosome length
        this.initialize = function(chromosomeLength) {
            this.individuals = [];
    
            for (var i = 0; i < ga.populationSize; i++) {
                var newIndividual = new ga.individual(chromosomeLength);
                newIndividual.initialize();
                this.individuals.push(newIndividual);
            }
        };
        
        // Mutates current population
        this.mutate = function() {
            var fittestIndex = this.getFittestIndex();

            for (index in this.individuals) {
                // Don't mutate if this is the elite individual and elitism is enabled 
                if (ga.elitism != true || index != fittestIndex) {
                    this.individuals[index].mutate();
                }
            }
        };

        // Applies crossover to current population and returns population of offspring
        this.crossover = function() {
            // Create offspring population
            var newPopulation = new ga.population();
            
            // Find fittest individual
            var fittestIndex = this.getFittestIndex();

            for (index in this.individuals) {
                // Add unchanged into next generation if this is the elite individual and elitism is enabled
                if (ga.elitism == true && index == fittestIndex) {
                    // Replicate individual
                    var eliteIndividual = new ga.individual(this.individuals[index].chromosomeLength);
                    eliteIndividual.setChromosome(this.individuals[index].chromosome.slice());
                    newPopulation.addIndividual(eliteIndividual);
                } else {
                    // Select mate
                    var parent = this.tournamentSelection();
                    // Apply crossover
                    this.individuals[index].crossover(parent, newPopulation);
                }
            }
            
            return newPopulation;
        };

        // Adds an individual to current population
        this.addIndividual = function(individual) {
            this.individuals.push(individual);
        };

        // Selects an individual with tournament selection
        this.tournamentSelection = function() {
            // Randomly order population
            for (var i = 0; i < this.individuals.length; i++) {
                var randomIndex = Math.floor(Math.random() * this.individuals.length);
                var tempIndividual = this.individuals[randomIndex];
                this.individuals[randomIndex] = this.individuals[i];
                this.individuals[i] = tempIndividual;
            }

            // Create tournament population and add individuals
            var tournamentPopulation = new ga.population();
            for (var i = 0; i < ga.tournamentSize; i++) {
                tournamentPopulation.addIndividual(this.individuals[i]);
            }

            return tournamentPopulation.getFittest();
        };
        
        // Return the fittest individual's population index
        this.getFittestIndex = function() {
            var fittestIndex = 0;

            // Loop over population looking for fittest
            for (var i = 1; i < this.individuals.length; i++) {
                if (this.individuals[i].calcFitness() > this.individuals[fittestIndex].calcFitness()) {
                    fittestIndex = i;
                }
            }

            return fittestIndex;
        };

        // Return fittest individual
        this.getFittest = function() {
            return this.individuals[this.getFittestIndex()];
        };
    },

    // Individual class
    "individual": function(chromosomeLength) {
        this.chromosomeLength = chromosomeLength;
        this.fitness = null;
        this.chromosome = [];

        // Initialize random individual
        this.initialize = function() {
            this.chromosome = [];

            // Generate random chromosome
            for (var i = 0; i < this.chromosomeLength; i++) {
                this.chromosome.push(i);
            }
            for (var i = 0; i < this.chromosomeLength; i++) {
                var randomIndex = Math.floor(Math.random() * this.chromosomeLength);
                var tempNode = this.chromosome[randomIndex];
                this.chromosome[randomIndex] = this.chromosome[i];
                this.chromosome[i] = tempNode;
            }
        };
        
        // Set individual's chromosome
        this.setChromosome = function(chromosome) {
            this.chromosome = chromosome;
        };
        
        // Mutate individual
        this.mutate = function() {
            this.fitness = null;
            
            // Loop over chromosome making random changes
            for (index in this.chromosome) {
                if (ga.mutationRate > Math.random()) {
                    var randomIndex = Math.floor(Math.random() * this.chromosomeLength);
                    var tempNode = this.chromosome[randomIndex];
                    this.chromosome[randomIndex] = this.chromosome[index];
                    this.chromosome[index] = tempNode;
                }
            }
        };
        
        // Returns individuals route distance
        this.getDistance = function() {
            var totalDistance = 0;

            for (index in this.chromosome) {
                var startNode = this.chromosome[index];
                var endNode = this.chromosome[0];
                if ((parseInt(index) + 1) < this.chromosome.length) {
                    endNode = this.chromosome[(parseInt(index) + 1)];
                }

                totalDistance += durations[startNode][endNode];
            }
            
            totalDistance += durations[startNode][endNode];
            
            return totalDistance;
        };

        // Calculates individuals fitness value
        this.calcFitness = function() {
            if (this.fitness != null) {
                return this.fitness;
            }
        
            var totalDistance = this.getDistance();

            this.fitness = 1 / totalDistance;
            return this.fitness;
        };

        // Applies crossover to current individual and mate, then adds it's offspring to given population
        this.crossover = function(individual, offspringPopulation) {
            var offspringChromosome = [];

            // Add a random amount of this individual's genetic information to offspring
            var startPos = Math.floor(this.chromosome.length * Math.random());
            var endPos = Math.floor(this.chromosome.length * Math.random());

            var i = startPos;
            while (i != endPos) {
                offspringChromosome[i] = individual.chromosome[i];
                i++

                if (i >= this.chromosome.length) {
                    i = 0;
                }
            }

            // Add any remaining genetic information from individual's mate
            for (parentIndex in individual.chromosome) {
                var node = individual.chromosome[parentIndex];

                var nodeFound = false;
                for (offspringIndex in offspringChromosome) {
                    if (offspringChromosome[offspringIndex] == node) {
                        nodeFound = true;
                        break;
                    }
                }

                if (nodeFound == false) {
                    for (var offspringIndex = 0; offspringIndex < individual.chromosome.length; offspringIndex++) {
                        if (offspringChromosome[offspringIndex] == undefined) {
                            offspringChromosome[offspringIndex] = node;
                            break;
                        }
                    }
                }
            }

            // Add chromosome to offspring and add offspring to population
            var offspring = new ga.individual(this.chromosomeLength);
            offspring.setChromosome(offspringChromosome);
            offspringPopulation.addIndividual(offspring);
        };
    },
};

</script>
      <style>
        
      </style>
</head>
<!-- ----------------------------------------------------------------------------------------------------------- -->
<body>

<nav class="navbar navbar-default">
   <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">si<b>GAS</b></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="hitungjarak.php">Hitung Jarak</a></li>
        <li class="active"><a href="wilayah.php">Wilayah</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="login/index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li></ul>
        
     </div>
  </div>
</nav>

<!-- -------------------------------------------------------------------------------------------------------- -->

<div class="container-fluid">
<div class="row">
<div class="form-group">
<div class="col-md-3">
    <div class="panel panel-info">
        <div class="panel-heading">
                <h2 class="text-center">Ant Colony</h2>
        </div>

<br>
  <label for="travel-type" class="control-label col-sm-6">Travel Mode:</label>
  <div class="col-sm-6">
  <select class="form-control" id="travel-type">
    <option value="DRIVING">Car</option>
    <option value="BICYCLING">Bicycle</option>
    <option value="WALKING">Walking</option>
  </select>
</div>

<!--   <label for="avoid-highways" class="control-label col-sm-6">Avoid Highways:</label>
  <div class="col-sm-6">
  <select class="form-control" id="avoid-highways">
    <option value="1">Enabled</option>
    <option value="0" selected="selected">Disabled</option>
  </select>
</div>
 -->
  <label for="population-size" class="control-label col-sm-6">Population Size:</label>
  <div class="col-sm-6">
  <select class="form-control" id="population-size">
    <option value="5">5</option>
    <option value="10">10</option>
    <option value="20">20</option>
    <option value="50" selected="selected">50</option>
    <option value="100">100</option>
    <option value="200">200</option>
  </select>
</div>

  <label for="mutation-rate" class="control-label col-sm-6">Mutation Rate:</label>
  <div class="col-sm-6">
  <select class="form-control" id="mutation-rate">
    <!-- <option value="0.00">0.00</option>
    <option value="0.05">0.01</option>
    <option value="0.05">0.05</option> -->
    <option value="0.1" selected="selected">0.1</option>
    <option value="0.2">0.2</option>
    <option value="0.4">0.4</option>
    <option value="0.7">0.7</option>
    <option value="1">1.0</option>
  </select>
</div>

  <label for="crossover-rate" class="control-label col-sm-6">Crossover Rate:</label>
  <div class="col-sm-6">
  <select class="form-control" id="crossover-rate">
  <option value="0.0">0.0</option>
  <option value="0.1">0.1</option>
  <option value="0.2">0.2</option>
  <option value="0.3">0.3</option>
  <option value="0.4">0.4</option>
  <option value="0.5" selected="selected">0.5</option>
  <option value="0.6">0.6</option>
  <option value="0.7">0.7</option>
  <option value="0.8">0.8</option>
  <option value="0.9">0.9</option>
  <option value="1">1.0</option>
  </select>
</div>

  <label for="elitism" class="control-label col-sm-6">Elitism:</label>
  <div class="col-sm-6">
  <select class="form-control" id="elitism">
    <option value="1" selected="selected">Enabled</option>
    <option value="0">Disabled</option>
  </select>
</div>

  <label for="generations" class="control-label col-sm-6">Max Generation:</label>
  <div class="col-sm-6">
  <select class="form-control" id="generations">
    <option value="20">20</option>
    <option value="50" selected="selected">50</option>
   <!--  <option value="100">100</option> -->
  </select>
</div>

<table>
    <tr>
            <td colspan="2"><b>Debug Info</b></td>
        </tr>
        <tr>
            <td>Destinations Count: </td>
            <td id="destinations-count">0</td>
        </tr>
        <tr class="ga-info" style="display:none;">
            <td>Generations: </td><td id="generations-passed">0</td>
        </tr>
        <tr class="ga-info" style="display:none;">
            <td>Best Time: </td><td id="best-time">?</td>
        </tr>
        <tr id="ga-buttons">
            <td colspan="2"><button class="btn btn-success" id="find-route">Start</button> <button class="btn btn-danger" id="clear-map">Clear</button></td>
        </tr>
</table>
</div>
</div>
  <div class="col-md-9">
  <div id="map" style="height:500px;"></div>
  <div class="hr vpad"></div>

<footer class="text-center" class="w3-content w3-padding-64 w3-text-black w3-xxlarge">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
    <p class="w3-medium">Powered by <a href="https://twitter.com/ilyas_ihsan" target="_blank" class="w3-hover-text-black">Ihsan Ilyas</a></p>
  </footer>
</body>
</html>