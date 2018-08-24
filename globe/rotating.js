//6-changed ping interval from 150 ms to 1000, made angle 10
//7-scaled up rotation and translation from 175 to 200

//RYAN- stroke function is at the bottom
//uncomment line 60 to make the city dots appear
//

(function() {
  var globe = planetaryjs.planet();
  // Load our custom `autorotate` plugin; see below.
  globe.loadPlugin(autorotate(10));

  //The `zooms` plugin handles the various types of zooms.
  globe.loadPlugin(planetaryjs.plugins.zooms());

  // The `earth` plugin draws the oceans and the land; it's actually
  // a combination of several separate built-in plugins.
  //
  // Note that we're loading a special TopoJSON file
  // (world-110m-withlakes.json) so we can render lakes.
  globe.loadPlugin(planetaryjs.plugins.earth({
    topojson: { file:   'globe/world-110m-withlakes.json' },
    oceans:   { fill:   '#1B2935' },
    land:     { fill:   '#ffffff' },
    borders:  { stroke: '#696969' }
  }));
  // Load our custom `lakes` plugin to draw lakes; see below.
  globe.loadPlugin(lakes({
    fill: '#696969'
  }));

  // The `pings` plugin draws animated pings on the globe.
  globe.loadPlugin(planetaryjs.plugins.pings());

  // The `zoom` and `drag` plugins enable
  // manipulating the globe with the mouse.
  globe.loadPlugin(planetaryjs.plugins.zoom({
    scaleExtent: [100, 800]
  }));
  globe.loadPlugin(planetaryjs.plugins.drag({
    // Dragging the globe should pause the
    // automatic rotation until we release the mouse.
    onDragStart: function() {
      this.plugins.autorotate.pause();
    },
    onDragEnd: function() {
      this.plugins.autorotate.resume();
    }
  }));
  // Set up the globe's initial scale, offset, and rotation.
  var height = window.innerHeight-80;
  var width = window.innerWidth*.65;
  if (height>width) {
    var scale = width*.85;
  } else {
    var scale = height*.85;
  }
  globe.projection.scale(275).translate([height/2, width/2]).rotate([0, -10, 0]);

  //load up lngs and lats from csv file to give to pings
  cityInfo = [];
  d3.csv("globe/cities.csv", function(data) {
    var color = '#696969';
    for(var i = 0; i < data.length; i++){
      var lng = data[i].lng;
      var lat = data[i].lat;
      var name = data[i].name;
      globe.plugins.pings.add(lng, lat, { color: color, angle: 2, name: name});
      //globe.plugins.strokes.add(lng, lat, {color: color, angle: 1.5, hover: true});
    }
  });

  d3.select('#workingGlobe').on('mousemove', function(){
    globe.plugins.pings.point(d3.mouse(this));
  });

  d3.select('#workingGlobe').on('click', function(){
    //globe.plugins.autorotate.pause();
    globe.plugins.pings.click(d3.mouse(this));
    //globe.plugins.zooms.zoomIn(d3.mouse(this));
  });

  var canvas = document.getElementById('workingGlobe');
  // Special code to handle high-density displays (e.g. retina, some phones)
  // In the future, Planetary.js will handle this by itself (or via a plugin).
  if (window.devicePixelRatio == 2) {
    canvas.width = 800;
    canvas.height = 800;
    context = canvas.getContext('2d');
    context.scale(2, 2);
  } else {
    canvas.width = window.innerWidth*.65;
    canvas.height = window.innerHeight-80;
  }

  // Draw that globe!
  globe.draw(canvas);

  /*
  --FUNCTIONS--
  */

  // This plugin will automatically rotate the globe around its vertical
  // axis a configured number of degrees every second.
  function autorotate(degPerSec) {
    // Planetary.js plugins are functions that take a `planet` instance
    // as an argument...
    return function(planet) {
      var lastTick = null;
      var paused = false;
      planet.plugins.autorotate = {
        pause:  function() { paused = true;  },
        resume: function() { paused = false; }
      };
      // ...and configure hooks into certain pieces of its lifecycle.
      planet.onDraw(function() {
        if (paused || !lastTick) {
          lastTick = new Date();
        } else {
          var now = new Date();
          var delta = now - lastTick;
          // This plugin uses the built-in projection (provided by D3)
          // to rotate the globe each time we draw it.
          var rotation = planet.projection.rotate();
          rotation[0] += degPerSec * delta / 1000;
          if (rotation[0] >= 180) rotation[0] -= 360;
          planet.projection.rotate(rotation);
          lastTick = now;
        }
      });
    };
  };

  // This plugin takes lake data from the special
  // TopoJSON we're loading and draws them on the map.
  function lakes(options) {
    options = options || {};
    var lakes = null;

    return function(planet) {
      planet.onInit(function() {
        // We can access the data loaded from the TopoJSON plugin
        // on its namespace on `planet.plugins`. We're loading a custom
        // TopoJSON file with an object called "ne_110m_lakes".
        var world = planet.plugins.topojson.world;
        lakes = topojson.feature(world, world.objects.ne_110m_lakes);
      });

      planet.onDraw(function() {
        planet.withSavedContext(function(context) {
          context.beginPath();
          planet.path.context(context)(lakes);
          context.fillStyle = options.fill || 'black';
          context.fill();
        });
      });
    };
  };

  //Straight up draws the outlines and registers on the console when mouse hovers
  //over them but won't draw the strokes or pings
  //strokes plugin draws strokes on the globe's cities when the mouse hovers over a ping
  function strokes(strokes, config) {
    var outlines = [];
    var newPoint = [];
    config = config || {};

    var points = function(point) {
      newPoint = point;
    };

    var addStroke = function(lng, lat, options) {
      options = options || {};
      options.color = 'black';
      options.angle = 1.5;
      var outline = { options: options };
      if (config.latitudeFirst) {
        outline.lat = lng;
        outline.lng = lat;
      } else {
        outline.lng = lng;
        outline.lat = lat;
      }
      outlines.push(outline);
    };

    var drawStrokes = function(planet, context) {
      for (var i = 0; i < outlines.length; i++) {
        var outline = outlines[i];
        drawStroke(planet, context, outline, newPoint);
      }
    };

    var drawStroke = function(planet, context, outline, point) {

      var circle = d3.geo.circle()
        .origin([outline.lng, outline.lat])
        .angle(outline.options.angle)();

      context.beginPath();
      planet.path.context(context)(circle);
      context.strokeStyle = d3.rgb(outline.options.color);
      //something is going wrong here, not sure what
      //same as lines 322-324 of planetaryjs.js
      context.stroke();


      var bounds = planet.path.bounds(circle);
      if(bounds[0][0] < point[0] && bounds[1][0] > point[0] && bounds[0][1] < point[1] && bounds[1][1] > point[1]){
          //console.log('true');
          //this is theoreticlly where context.stroke() will go once it works
      };

    };

    return function (planet) {
      planet.plugins.strokes = {
        add: addStroke,
        point: points
      };

      planet.onDraw(function() {
        planet.withSavedContext(function(context) {
          drawStrokes(planet, context);
        });
      });
    };
  };

})();
