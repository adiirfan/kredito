function save(aksi)
    {
		//alert(aksi);
       jQuery('#showModal').modal('hide'); 

    }

var app = angular.module('myApp', ["dynamicNumber","ui.bootstrap","duScroll"]);
app.controller('customersCtrl', function($scope, $http, $location, $anchorScroll, $locale, $document,$timeout) {
   $http.get("<?php echo base_url() ?>product_data/?tenor=3&kategory=1")
   .then(function (response) {$scope.names = response.data.records;});
    $scope.total_pinjaman = <?php echo $pinjaman ?>;
	 $scope.radioModel = 'Middle';
	  $scope.codeloan = '<?php echo $random; ?>';
	   $scope.base_url = '<?php echo base_url(); ?>';

		//Scroll to result
	   var section3 = angular.element(document.getElementById('cek2'));
		$scope.scrollTo = function(div) {
		  $scope.IsHidden = $scope.IsHidden ? false : true;
				 $scope.loading = $scope.loading ? false : true;
				 $timeout(function () { $scope.IsHidden = false; $scope.loading = true; }, 1000);  
		 $document.scrollToElementAnimated(section3);
		 //$location.hash('cek');
		//$anchorScroll();
		}
		
		$scope.filter = {};

		$scope.getCategories = function () {
        return ($scope.names || []).map(function (w) {
            return w.company_name;
        }).filter(function (w, idx, arr) {
            return arr.indexOf(w) === idx;
			});
		};
		
		$scope.filterByCategory = function (wine) {
        return $scope.filter[wine.company_name] || noFilter($scope.filter);
		};
		
		function noFilter(filterObj) {
			for (var key in filterObj) {
				if (filterObj[key]) {
					return false;
				}
			}
			return true;
		}
	  
  $scope.isCollapsed = true;
   $scope.isCollapsed_2 = true;
 
	  //ng hide for loading
	   $scope.IsHidden = false;
	    $scope.loading = true;
            $scope.ShowHide = function () {
                //If DIV is hidden it will be visible and vice versa.
                $scope.IsHidden = $scope.IsHidden ? false : true;
				 $scope.loading = $scope.loading ? false : true;
				 $timeout(function () { $scope.IsHidden = false; $scope.loading = true; }, 1000);  
            }
	  
	  //P2P Calculate
	   $scope.bunga=20/100;
	 $scope.bulan=12;
	
	  
	  $scope.showModal = false;
    $scope.toggleModal = function(id){
        $scope.showModal = !$scope.showModal;
		$scope.order.loan = $scope.total_pinjaman;
		$scope.order.codeloan=$scope.codeloan;
		
		$scope.order.company_product_id = id;
		url="<?php echo base_url() ?>product_data/?company_product_id="+id;
		 $http.get(url)
   .then(function (response) {$scope.name = response.data.records;});
  // $scope.order.order_payment_month = $scope.total_pinjaman * '1000';
   $scope.names1 = name.interest_rate;
    };
	
	 $scope.order = {};
	 $scope.submitForm = function() {
		 //alert('gagal');
		  $scope.showModal = false;
        // Posting data to php file
        $http({
          method  : 'POST',
          url     : '<?php echo base_url(); ?>add_order',
         data    : $scope.order, //forms user object
          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
         })
		 
		window.location = "<?php echo base_url(); ?>konfirmasi-refinance/"+$scope.order.codeloan+"/Konfirmasi";
		 /*HAndling cek berhasil old
          .then(function(response) {
            // successa
		//	$scope.company_product_id = data.errors.company_product_id;
			alert('berhasil');
		}, 
			function(response) { // optional
            alert('gagal');
			});
			*/
        };
   
	
	$scope.currencyVal;
	 $scope.months = ['1','2','3','4','5'];
	 
	 //	$(".InsuredPrice").length > 0 && $(".InsuredPrice").autoNumeric("init");
	 $scope.cssPre="testing";
	   $scope.$watch('cssPre', function(cssPre) {
       console.log(cssPre);
    });
	
	//  $scope.value= 'foo';
     $scope.active = 'breakfast';
    $scope.setActive = function(type) {
        $scope.active = type;
    };
    $scope.isActive = function(type) {
        return type === $scope.active;
    };
    
	 
	
	$scope.sortType     = ['interest_rate','down_payment']; // set the default sort type
	
  $scope.sortReverse  = false;  // set the default sort order
  $scope.searchFish   = '';     // set the default search/filter term
   

  $scope.condition = function(kondisi) {
      $http.get("<?php echo base_url() ?>product_data/?condition="+kondisi+"&tenor="+$scope.selected)
   .then(function (response) {$scope.names = response.data.records;});
    $scope.total_pinjaman;
	$scope.kondisi=kondisi;
	//alert( $scope.selected);
    };
	
		$scope.change = function(tahun) {
			var kondisix;
			if($scope.kondisi != null){
				kondisix="&condition="+$scope.kondisi;
			}else{
				kondisix=null;
			}
      $http.get("<?php echo base_url() ?>product_data/?tenor="+tahun+kondisix)
   .then(function (response) {$scope.names = response.data.records;});
   // $scope.total_pinjaman = '100000000000';
   
	//alert(kondisix);
    };
	
	
		
});

//app.$inject = ['$scope'];
 

app.directive('format', ['$filter', function ($filter) {
    return {
        require: '?ngModel',
        link: function (scope, elem, attrs, ctrl) {
            if (!ctrl) return;


            ctrl.$formatters.unshift(function (a) {
                return $filter(attrs.format)(ctrl.$modelValue)
            });


            ctrl.$parsers.unshift(function (viewValue) {
                var plainNumber = viewValue.replace(/[^\d|\-+|\.+]/g, '');
                elem.val($filter(attrs.format)(plainNumber));
                return plainNumber;
            });
        }
    };
}]);

app.directive('modal', function () {
    return {
      template: '<div class="modal fade" id="modal-2">' + 
          '<div class="modal-dialog">' + 
            '<div class="modal-content">' + 
              '<div class="modal-header">' + 
                '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' + 
                '<h4 class="modal-title"><h3 align="center">{{ title }}</h3></h4>' + 
              '</div>' + 
              '<div class="modal-body" ng-transclude></div>' + 
            '</div>' + 
          '</div>' + 
        '</div>',
      restrict: 'E',
      transclude: true,
      replace:true,
      scope:true,
      link: function postLink(scope, element, attrs) {
        scope.title = attrs.title;

        scope.$watch(attrs.visible, function(value){
          if(value == true)
            $(element).modal('show');
          else
            $(element).modal('hide');
        });

        $(element).on('shown.bs.modal', function(){
          scope.$apply(function(){
            scope.$parent[attrs.visible] = true;
          });
        });

        $(element).on('hidden.bs.modal', function(){
          scope.$apply(function(){
            scope.$parent[attrs.visible] = false;
          });
        });
      }
    };
  });
