<!DOCTYPE html>
<html lang="en" ng-app="sortApp" ng-controller="mainController">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/icon" href="https://www.nccu.edu/favicon.ico">    
    <title>NCCU LSIS 5475 Final Project</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.23/angular.min.js"></script>
	<script src="lostItems.js"></script>
	<script src="angularTable.js"></script>
	<script>
		function formResetter() {
			document.forms["add_item_form"].reset();
		}
	</script>
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">NCCU Lost and Found Application</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Add and Edit items below</a></li>            
          </ul>         
        </div>
      </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-4 col-md-3 sidebar">        
 			<ul class="nav nav-sidebar">
				<li class="active"><a href="#">Add a Lost Item <span class="sr-only">(current)</span></a></li>
      			<div class="container-fluid">
  					<form role="form" id="add_item_form" name="add_item_form" ng-submit="addRow()">
						<div class="form-group">
						  <label for="title">Item:</label>
						  <input type="text" class="form-control" id="title" placeholder="Enter what the item is" name="title" size="40" ng-model="title">
						</div>    
						<div class="form-group">
						  <label for="location">Location:</label>
						  <input type="text" class="form-control" id="location" placeholder="Enter campus location" name="location" ng-model="location">
						</div>
						<div class="form-group">
						<label for="sel1">How valuable is the item:</label>
						<select class="form-control" name="valuable" id="valuable" ng-model="valuable">
							<option value="" disabled selected>Scale of 1-5</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5" selected>5</option>
						</select>
						</div>
    					<button type="submit" class="btn btn-default" onclick="formResetter()">Add</button>
					</form>
			</div>
		</ul>         	
		<ul class="nav nav-sidebar">
		<li class="active"><a href="#">&nbsp; <span class="sr-only">(current)</span></a></li>
		</ul>
    </div>
    <div class="col-sm-8 col-sm-offset-4 col-md-9 col-md-offset-3 main">
    	<h1 class="page-header">Current Lost Items</h1>		
			<div class="container-fluid">
				<strong>Click Table Heading to Sort</strong> <br/>
				Currently Sorting On: {{ sortType }} <br/>
				Sort Reverse: {{ sortReverse?"Yes":"No" }} <br/>
				Search Query: {{ searchItem }} <br/>
				Showing {{ showFound || 'All' }} Items <br/>				
				<br/>
				<br/>
				<form>
				<div class="form-group">
				  <div class="input-group">
					<div class="input-group-addon"><span class="glyphicon">&#xe003;</span></div>
					<input type="text" class="form-control" placeholder="Search Items" ng-model="searchItem">
				  </div>
				</div>				
				<div class="form-group">
					<label class="radio-inline"><input type="radio" name="found" value="" ng-model="showFound" checked>All Items</label>
					<label class="radio-inline"><input type="radio" name="found" value="Lost" ng-model="showFound">Lost Items</label>
					<label class="radio-inline"><input type="radio" name="found" value="Found" ng-model="showFound">Found Items</label>
				</div>
				</form>
				<table class="table table-bordered table-hover table-condensed">
					<thead>
						<tr>
							<th>
								<a ng-click="sortType = 'title'; sortReverse = !sortReverse">Item Title
									<span ng-show="sortType == 'title' && !sortReverse" class="glyphicon glyphicon-arrow-down"></span>
									<span ng-show="sortType == 'title' && sortReverse" class="glyphicon glyphicon-arrow-up"></span>
								</a>
							</th>
							<th>
			  					<a ng-click="sortType = 'location'; sortReverse = !sortReverse">Location Found
									<span ng-show="sortType == 'location' && !sortReverse" class="glyphicon glyphicon-arrow-down"></span>	
									<span ng-show="sortType == 'location' && sortReverse" class="glyphicon glyphicon-arrow-up"></span>	
								</a>
			  				</th>
			  				<th class="tdcenter">
			  					<a ng-click="sortType = 'valuable'; sortReverse = !sortReverse">Value Scale
									<span ng-show="sortType == 'valuable' && !sortReverse" class="glyphicon glyphicon-arrow-down"></span>	
									<span ng-show="sortType == 'valuable' && sortReverse" class="glyphicon glyphicon-arrow-up"></span>
								</a>			
							</th>
							<th class="col-md-1">
			  					<a ng-click="sortType = 'found'; sortReverse = !sortReverse">Found?
									<span ng-show="sortType == 'found' && !sortReverse" class="glyphicon glyphicon-arrow-down"></span>	
									<span ng-show="sortType == 'found' && sortReverse" class="glyphicon glyphicon-arrow-up"></span>
								</a>
							</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<!--<tr ng-repeat="item in lostItemsArray | orderBy:sortType:sortReverse | filter: {found: 'Found'}"> -->
						<tr ng-repeat="item in lostItemsArray | orderBy:sortType:sortReverse | filter:searchItem | filter:{found:showFound}">
							<td>                
								<span ng-hide="item.editing">{{item.title}}</span>
								<input style="width:350px;" ng-show="item.editing" ng-model="item.title" autofocus />
							</td>
							<td>
								<span ng-hide="item.editing">{{item.location}}</span>
								<input ng-show="item.editing" ng-model="item.location" autofocus />
							</td>
							<td class="tdcenter">			    
								<span ng-hide="item.editing">{{item.valuable}}</span>
								<input style="width:35px;" ng-show="item.editing" ng-model="item.valuable" autofocus /></td>
							<td class="tdcenter col-md-1">
								<span ng-hide="item.editing">{{ item.found }}</span>
								<input style="width:35px;" ng-show="item.editing" ng-model="item.found" autofocus />
							</td>			                 
							<td class="tdcenter">                 
								<button ng-hide="item.editing" type="button" ng-click="editItem(item)" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</button>
								<button ng-show="item.editing" type="button" ng-click="doneEditing(item)" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok"></span>&nbsp;Done</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>		  
        </div>
      </div>
    </div>
  </body>
</html>
