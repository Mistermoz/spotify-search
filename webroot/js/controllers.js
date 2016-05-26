angular.module('myApp.controllers', []);

as.controller('AppCtrl', function($scope, $rootScope, $http, $location) {
    var types = '';
    $scope.q = '';
    $scope.load = false;
    $scope.checkAlbums = false, $scope.checkArtists = false, $scope.checkTracks = false;
    $scope.opAlbums = false, $scope.opArtists = false, $scope.opTracks = false;
    $scope.allAlbums = {},  $scope.allArtists = {},  $scope.allTracks = {};

    $scope.search = function() {
        types = '';
        $scope.load = true;
        $scope.allAlbums = {},  $scope.allArtists = {},  $scope.allTracks = {};
        $scope.opAlbums = false, $scope.opArtists = false, $scope.opTracks = false;

        options();

        if($scope.q !== '' && types !== '') {
            $http({
              method: 'GET',
              url: '/songs.json?q=' + $scope.q + '&types=' + types + ''
            }).then(function successCallback(response) {
                if(response.data.songs.Song.albums.length > 0) {
                    $scope.opAlbums = true;

                    angular.forEach(response.data.songs.Song.albums, function(value, key) {
                      $scope.allAlbums[key] = value;
                    });
                }
                if(response.data.songs.Song.artists.length > 0) {
                    $scope.opArtists = true;

                    angular.forEach(response.data.songs.Song.artists, function(value, key) {
                      $scope.allArtists[key] = value;
                    });
                }
                if(response.data.songs.Song.tracks.length > 0) {
                    $scope.opTracks = true;

                    angular.forEach(response.data.songs.Song.tracks, function(value, key) {
                      $scope.allTracks[key] = value;
                    });
                }

                if($scope.opAlbums == false && $scope.opArtists == false && $scope.opTracks == false) {
                    alert('No hay resultados para ' + $scope.q + '');
                }

                $scope.load = false;
                
            }, function errorCallback(response) {
                console.log(response);
            });
        }else {
            alert('Debe ingresar termino de búsqueda y marcar una opción');
        }
    }

    var options = function() {
        if($scope.checkAlbums) {
            types = types + '1';
        }

        if($scope.checkArtists) {
            types = types + '2';
        }

        if($scope.checkTracks) {
            types = types + '3';
        }
    }
});

