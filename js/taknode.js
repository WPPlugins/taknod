var app = angular.module('taknodeApp', ['ngRoute']);
app.config(function($routeProvider, $locationProvider) {
  $routeProvider.when('/', {
    templateUrl: 'main.tpl',
    controller: 'main'
  }).otherwise({redirectTo:'/'});
});

app.controller('main', function($scope,$http,$window,$timeout){
    var s    = $scope;
    s.setPrice = function(pr,proId){
        s.finalPrice = null ;
        s.price=pr;
        s.year = null;
        s.perUser = null;
        s.pr.product = proId ;
    };
    s.setYear = function(type){
        console.log(type);
        s.finalPrice = null ;
        s.year = s.price[type];
        s.perUser = null ;
        s.pr.type = type ;
        s.pr.year = null ;
    };
    s.setPerUser = function(per,year) {
        console.log(per);
        console.log(year);
        s.finalPrice = null ;
        s.perUser = per.perUser ;
        s.pr.year = year;
    };
    s.calcPrice = function(amount,quan){
        s.finalPrice =Math.round( (s.plan.dollarPrice * amount) * (1+(s.plan.profit / 100)) ) / 10;
        s.pr.quantity = quan;
        s.pr.amount = amount ;
        console.log(s.pr);
    };

    s.esLicReq = function() {
        $http.post(s.plan.apiUrl+'/esLicRequest', s.pr).then(function(resp) {
            resp.data.error === 0 ? 
                ($window.location.href=s.plan.apiUrl+"/esGetLic/"+resp.data.licReqCode) :
                alert('error code : '+resp.data.error);
        },function() {
            alert('خطا در اتصال به سرور. لطفا بعد از چند دقیقه مجددا تلاش فرمایید.');
        });

    };
    s.init = function() {
        $timeout(function() {
            angular.forEach(s.plan.price,function(pro,key) {
                console.log(pro);
                angular.forEach(pro,function(p,pKey) {
                    if (pKey == 'ENAHE') {
                       s.setPrice(p.price,pKey);
                       s.setYear('new');
                       angular.forEach(s.year,function(yPer,yKey) {
                            //console.log(per);console.log(yKey);
                            if (yKey==1) {
                                s.setPerUser(yPer,yKey);
                                angular.forEach(yPer.perUser,function(dollar,count) {
                                    count==1 ? s.calcPrice(dollar,count) : null ;
                                });
                            }
                       });
                       
                       //s.calcPrice(s.perUser[0],1);
                    }
                });
            });
        },100);
    };

    s.init();
});

app.factory('object', function() {
    return null;
});