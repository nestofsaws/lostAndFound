angular.module('sortApp', [])
	.controller('mainController', function($scope) {
		$scope.sortType     = 'title';
		$scope.sortReverse  = false;
		$scope.searchItem   = '';
		$scope.showFound   = '';
		$scope.lostItemsArray = LostItem.all;
		$scope.editItem = function (item) {
			item.editing = true;
		}
		$scope.doneEditing = function (item) {
			item.editing = false;
		};
		$scope.addRow = function(){		
			$scope.lostItemsArray.unshift({ 'title':$scope.title, 'location':$scope.location, 'valuable':$scope.valuable, 'found':'Lost', 'editing':false});
			$scope.lostItemsArray.title='';
			$scope.lostItemsArray.location='';
			$scope.lostItemsArray.valuable='';
			$scope.lostItemsArray.found='';					
		};
	});