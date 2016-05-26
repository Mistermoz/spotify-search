<div class="spotify-search">
	<input type="text" ng-model="q">

	<button ng-click="search()">Buscar</button>

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

<div class="content">
	<div class="artists" ng-show="opArtists">
		<h2>Artists</h2>

		<div class="items">
			<div class="item" ng-repeat="artist in allArtists">
				<a href="{{artist.url}}">
					<img ng-src="{{ artist.image }}" alt="">
				</a>
			</div>
		</div>
	</div>

	<div class="albums" ng-show="opAlbums">
		<h2>Albums</h2>

		<div class="items">
			<div class="item" ng-repeat="album in allAlbums">
				<a href="{{album.url}}">
					<img ng-src="{{ album.image }}" alt="">
				</a>
			</div>
		</div>
	</div>

	<div class="tracks" ng-show="opTracks">
		<h2>Tracks</h2>

		<div class="items">
			<div class="item" ng-repeat="track in allTracks">
				<a href="{{track.url}}">
					<img ng-src="{{ track.image }}" alt="">
				</a>
			</div>
		</div>
	</div>
</div>

<ng-view></ng-view>