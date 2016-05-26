<div class="spotify-search">
	<div class="box">
		<h1>Spotify Search</h1>

		<input type="text" ng-model="q">

		<button ng-click="search()" class="btn btn-primary btn-lg" ng-class="{disabled : load}">Search</button>

		<div class="checkboxes">
			<div class="input checkbox">
				<label for="checkArtist">Artists</label>
				<input type="checkbox" ng-model="checkArtists" id="checkArtist">
			</div>

			<div class="input checkbox">
				<label for="checkAlbum">Albums</label>
				<input type="checkbox" ng-model="checkAlbums" id="checkAlbum">
			</div>

			<div class="input checkbox">
				<label for="checkTrack">Tracks</label>
				<input type="checkbox" ng-model="checkTracks" id="checkTrack">
			</div>
		</div>
	</div>
</div>

<div class="content">
	<div class="progress">
	  <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%" ng-class="{active : load}">
	  </div>
	</div>

	<div class="artists" ng-show="opArtists">
		<h2>Artists</h2>

		<div class="items">
			<div class="item" ng-repeat="artist in allArtists">
				<a href="{{artist.url}}" target="_blank">
					<img ng-src="{{ artist.image }}" alt="">
				</a>
			</div>
		</div>
	</div>

	<div class="albums" ng-show="opAlbums">
		<h2>Albums</h2>

		<div class="items">
			<div class="item" ng-repeat="album in allAlbums">
				<a href="{{album.url}}" target="_blank">
					<img ng-src="{{ album.image }}" alt="">
				</a>
			</div>
		</div>
	</div>

	<div class="tracks" ng-show="opTracks">
		<h2>Tracks</h2>

		<div class="items">
			<div class="item" ng-repeat="track in allTracks">
				<a href="{{track.url}}" target="_blank">
					<img ng-src="{{ track.image }}" alt="">
				</a>
			</div>
		</div>
	</div>
</div>

<ng-view></ng-view>