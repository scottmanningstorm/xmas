var screenWidth = 1200, 
	screenHeight = 500, 
	activeItems = 0,
	maxItems = 15,
	score = 0; 

window.onload = function() {
 
	// Init	
	Crafty.init(screenWidth, screenHeight);
	Crafty.canvas();
	
	// Load in our sprites. 
	Crafty.sprite(150, "images/santa.png", {
		player: [0,3],
	});

	Crafty.sprite(1500, "images/platform.png", {
		platform : [0,0]
	});

	Crafty.sprite(1000	, "images/tree.gif", {
		tree : [0,0]
	});
	 
	Crafty.sprite(150, "images/present1.png", {
		present1 : [0,0]
	});
	Crafty.sprite(150, "images/present2.png", {
		present2 : [0,0]
	});
	Crafty.sprite(150, "images/present3.png", {
		present3 : [0,0]
	});

	Crafty.sprite(150, "images/bomb1.png", {
		bomb1 : [0,0]
	});

	Crafty.sprite(100, "images/leftWall.png", {
		leftWall : [0,0]
	});

	Crafty.sprite(100, "rightWall.png", {
		rightWall : [0,0]
	});

 
	Crafty.scene("loading", function() {
	 
		Crafty.load(["images/sprite.png", "images/platform.png"], function() {
			Crafty.scene("main");  
		});
	
		Crafty.background("#000");
		Crafty.e("2D, DOM, Text").attr({w: 100, h: 20, x: 150, y: 120})
			.text("Loading")
			.css({"text-align": "center"});
	});
	
	
	
	Crafty.scene("main", function() {


		var scoreText = Crafty.e("2D, DOM, Text").attr({w: 100, h: 20, x: 0, y: 0})
				.text("Score 0" )
				.css({"text-align": "left", "color":"black"});

		Crafty.background('url(images/background.png) no-repeat left top');
		

		//Build our trees
		for (var i = 30; i < 1000; i = i + 200) { 
			tree = Crafty.e("2D, Canvas, tree, Collision")
						.attr({x: i, y: 250, z: 0})
		}

		rightWall = Crafty.e("2D, Canvas, rightWall, Collision")
				.attr({w: 20, h: 1000, x: screenWidth - 20, y: 0})

 		leftWall = Crafty.e("2D, Canvas, leftWall, Collision")
				.attr({w: 20, h: 1000, x: 10, y: 0})

		floor = Crafty.e("2D, Canvas, platform, Collision")
				.attr({x: 0, y: screenHeight, z: 0})
	 	
	 

		Crafty.c('CustomControls', {
			__move: {left: false, right: false, up: false, down: false},	
			_speed: 30,
		
			CustomControls: function(speed) {
				if(speed) this._speed = speed;
				var move = this.__move;
		
				this.bind('enterframe', function() {
					if(this.isDown("RIGHT_ARROW")) this.x += this._speed; 
					if(this.isDown("LEFT_ARROW")) this.x -= this._speed; 
					if(this.isDown("SPACE")) this.y -= 15;
				});
				 
				return this;
			}
		});

		spawn_new_item = setInterval(function () { 
			spawn_item();
		 }, 2000);

		player = Crafty.e("2D, Canvas, player, Controls, CustomControls, Animate, Collision, Gravity")
			.attr({x: 300, y: 0, z: 0})
			.CustomControls(15)
			.animate("walk_left", 0, 2, 3)
			.animate("walk_right", 0, 1, 3)
			.animate("Jump", 0, 3, 3)
			.gravity("platform")
			.bind("enterframe", function(e) {
 				this.rotation = this.rotation + 1;
				if(this.isDown("LEFT_ARROW")) {	
					if(!this.isPlaying("walk_left"))
						this.stop().animate("walk_left", 10);
				} else if(this.isDown("RIGHT_ARROW")) {
					if(!this.isPlaying("walk_right"))
						this.stop().animate("walk_right", 10);
				} 

			}).bind("keyup", function(e) {
				this.stop();
			})
			.collision()
			.onHit("leftWall", function() {
				this.x += this._speed;
				this.stop();
			}).onHit("present1", function() {
				score++;
				activeItems--; 
				scoreText.text('score ' + score);
			 	Crafty('present1').destroy();
			}).onHit("present2", function() {
				score++;
				activeItems--; 
				scoreText.text('score ' + score);
				Crafty('present2').destroy();
			}).onHit("present3", function() {
				score++;
				activeItems--; 
				scoreText.text('score ' + score);
				Crafty('present3').destroy();
			}).onHit("bomb1", function() {
				this.stop();
				this._speed = 0;
			 	Crafty.scene("gameOver");
			}).onHit("rightWall", function() {
				this.x -= this._speed;
				this.stop();
			});



	
	function spawn_item() 
 	{
 		var spawnRange = Crafty.randRange(1, screenWidth - 200); 
		var spawner = Crafty.randRange(1, 10); 
		var presentIndex = Crafty.randRange(1, 2); 
		var item = 'present'+presentIndex;
		if (spawner > 5) {
			item = 'bomb'+presentIndex;
		}
		if (activeItems < maxItems) {
	 
				item = Crafty.e("2D, Canvas, "+item+", Collision, gravity, Tween")
						.attr({w: 150, h: 150, x: spawnRange - 200, y: 0})
						.gravity("platform")
						.collision()
						.onHit("player", function() {
  						 
						});


				activeItems++;
		}
	}
		


	});

	Crafty.scene("gameOver", function() {
		 
		var gameOverText = Crafty.e("2D, DOM, Text, Mouse").attr({w: 250, h: 45, x: 350, y: 20})
				.text("<h1>Game over</h1>" )
				.css({"text-align": "center", "color":"black", "cursor": "pointer"});
			
		var playAgain = Crafty.e("2D, DOM, Text, Mouse, Color").attr({w: 270, h: 45, x: 350 , y: 100})
				.text("<h1>Player again?</h1>" )
				.css({"text-align": "center", "color":"black", "cursor": "pointer"})
				.bind('click', function(MouseEvent){
				 	Crafty.scene("main");
				}); 

		Crafty.background('url(images/background.png) no-repeat left top');
		
	}); 

	Crafty.scene("loading");
};	 
 