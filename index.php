<html> 
<head>
	<style>
   		 body, html { margin:0; padding: 0; overflow:hidden; font-family:Arial; font-size:20px }
   		 #cr-stage { border:2px solid black; margin:5px auto; color:white }
    </style>
	<script type="text/javascript" src="http://craftyjs.com/release/0.4.2/crafty-min.js"></script>
</head>
	<body>
	<h1> Crafty</h1>
	<script>
	var screenWidth = 1200; 
	var screenHeight = 500; 
	var active_items = 0;
	var score = 0; 

			
	function spawn_item() 
 	{
 		var spawnRange = Crafty.randRange(1, screenWidth - 200); 
		item = Crafty.e("2D, Canvas, item, Collision, gravity")
				.attr({x: spawnRange , y: 0, z: 0})
				.gravity("platform")
				.collision()
				.onHit("item", function() {
					this.destroy();
				})
				.onHit("player", function() {
					score++;
					active_items--;
				
						
					this.destroy();
			});


		active_items++;

	}

window.onload = function() {
	//start crafty

	
	Crafty.init(screenWidth, screenHeight);
	Crafty.canvas();
	
	
	//turn the sprite map into usable components
	Crafty.sprite(150, "santa.png", {
		//4 X 4// 
		player: [0,3],
		player1: [1,0],
		player2: [2,0],
		player3: [3,0],
		player4: [0,1],
		player5:  [1,1],
		player6:  [2,1],
	});

	Crafty.sprite(1500, "platform.png", {
		platform : [0,0]
	});

	Crafty.sprite(1500, "tree.gif", {
		tree : [0,0]
	});
	 
	//Load items 
	Crafty.sprite(150, "present.png", {
		item : [0,0]
	});

	//the loading screen that will display while our assets load
	Crafty.scene("loading", function() {
		//load takes an array of assets and a callback when complete
		Crafty.load(["sprite.png", "platform.png"], function() {
			Crafty.scene("main"); //when everything is loaded, run the main scene
		});
		
		//black background with some loading text
		Crafty.background("#000");
		Crafty.e("2D, DOM, Text").attr({w: 100, h: 20, x: 150, y: 120})
			.text("Loading")
			.css({"text-align": "center"});
	});
	
	//automatically play the loading scene
	Crafty.scene("loading");
	

	Crafty.scene("main", function() {
		
	Crafty.e("2D, DOM, Text").attr({w: 100, h: 20, x: 0, y: 0})
			.text("Score " + score)
			.css({"text-align": "left", "color":"black"});
	
		Crafty.background('url(background.png) no-repeat left top');
		 
		floor = Crafty.e("2D, Canvas, platform, Collision")
						.attr({x: 0, y: screenHeight, z: 0})
		

		Crafty.c('Timer', {
		
			Timer: function(time) {
		
				this.bind('enterframe', function() {
					console.log(23); 
				});
			 
				return this;
			}
		});

 

		Crafty.c('CustomControls', {
			__move: {left: false, right: false, up: false, down: false},	
			_speed: 30,
		
			CustomControls: function(speed) {
				if(speed) this._speed = speed;
				var move = this.__move;
		
				this.bind('enterframe', function() {
					//move the player in a direction depending on the booleans
					//only move the player in one direction at a time (up/down/left/right)
					if(this.isDown("RIGHT_ARROW")) this.x += this._speed; 
					if(this.isDown("LEFT_ARROW")) this.x -= this._speed; 
					if(this.isDown("SPACE")) this.y -= this._speed;
					//else if(this.isDown("DOWN_ARROW")) this.y += this._speed;
				});
			 
				return this;
			}
		});

		//Build our trees
		for (var i = 30; i < 1000; i = i + 200) { 
			tree = Crafty.e("2D, Canvas, tree, Collision")
						.attr({x: i, y: 250, z: 0})
		}
spawn_new_item = setInterval(function () { spawn_item(); }, 2000);
		//create our player entity with some premade components
		player = Crafty.e("2D, Canvas, player, Controls, Timer,  CustomControls, Animate, Collision, Gravity")
			.attr({x: 0, y: 0, z: 0})
			.CustomControls(15)
			.animate("walk_left", 0, 2, 3)
			.animate("walk_right", 0, 1, 3)
			.animate("walk_up", 0, 3, 0)
			.animate("walk_down", 1, 3, 0)
			.gravity("platform")
			.bind("enterframe", function(e) {

				if(this.isDown("LEFT_ARROW")) {	

				if(!this.isPlaying("walk_left"))
						this.stop().animate("walk_left", 10);
				} else if(this.isDown("RIGHT_ARROW")) {
					if(!this.isPlaying("walk_right"))
						this.stop().animate("walk_right", 10);
				} else if(this.isDown("UP_ARROW")) {
					if(!this.isPlaying("walk_up"))
						this.stop().animate("walk_up", 10);
				} else if(this.isDown("DOWN_ARROW")) {
					if(!this.isPlaying("walk_down"))
						this.stop().animate("walk_down", 10);
				}
			}).bind("keyup", function(e) {
				this.stop();
			})
			.collision()
			.onHit("wall_left", function() {
				this.x += this._speed;
				this.stop();
			}).onHit("wall_right", function() {
				this.x -= this._speed;
				this.stop();
			}).onHit("wall_bottom", function() {
				this.y -= this._speed;
				this.stop();
			}).onHit("wall_top", function() {
				this.y += this._speed;
				this.stop();
			});
		
	});
};	 
 
	var loop = 0;
	window.setTimeout(function(){
			loop++;
			console.log(loop);
		 
		}, 100);
	</script>
	</body>
</html>