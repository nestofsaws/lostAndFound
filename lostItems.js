var LostItem = function(title, location, valuable, found, editing) {
    this.id = LostItem.generateId();
    this.title = title;
    this.location = location;
    this.valuable = valuable;
    this.found = found;
    LostItem.all.push(this);
};

LostItem.all = new Array();

LostItem.last_id = 0;

LostItem.generateId = function () {
    LostItem.last_id += 1 + Math.floor(Math.random()*10);
    return LostItem.last_id;
};

LostItem.generate = function() {
    var location_names = ["A.E. Student Union", "O'Kelly-Riddick Stadium", "Shepard Library", "McDougald-McLendon Arena", "Pearson Dining Hall"];
    var title_part1 = ["Silver", "Black", "Maroon", "Gray", "Blue"];
    var title_part2 = ["iPhone", "Android Phone", "iPad", "laptop", "wallet", "backpack"];
    var title_part3 = ["with scratches", "with eagle sticker", "with no id", "looks brand new"];
    var title_part4 = ["found on floor", "found in bathroom", "found on a seat/chair", "found outside the front door", "found in a puddle of water", "returned at front office"];
    var found_choice = ["Found", "Lost"];
    for(var i=0; i<50; i++) {
	var title = title_part1[Math.floor(5*Math.random())] + " " +
		title_part2[Math.floor(6*Math.random())] + " " +
		title_part3[Math.floor(4*Math.random())] + " " +
		title_part4[Math.floor(6*Math.random())];
	var location = location_names[Math.floor(5*Math.random())];
	var found = found_choice[Math.floor(2*Math.random())];
	var editing = false;
	var valuable = (Math.floor(Math.random()*5)+1);
	new LostItem(title, location, valuable, found, editing);
    }
};

LostItem.generate();

LostItem.getAll = function() {
    var result = new Array();
    for (var i=0; i<LostItem.all.length; i++) {
	result.push(LostItem.all[i].id);
    }
    return result;
};

LostItem.getByID = function(id) {
    for (var i=0; i<LostItem.all.length; i++) {
	if (LostItem.all[i].id == id) {
	    return LostItem.all[i];
	}
    }
    return null;
};