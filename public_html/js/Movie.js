var MediaLibrary = MediaLibrary || {};

MediaLibrary.Movie = function() {
	this.id;
	this.imdb_id;
	this.title;
	this.plot;
	this.released;
	this.language;
	this.runtime;
	this.trailer;
	this.production_company;
	this.director;
	this.writer;
	this.actors;
	this.genres;
	this.backdrops;
	this.logo;
	this.poster;
}

MediaLibrary.Movie.prototype.importJson = function(json) {
	this.id = json.id;
    this.imdb_id = json.imdb_id;
    this.title = json.title;
    this.plot = json.plot;
    this.released = json.released;
    this.language = json.language;
    this.runtime = json.runtime;
    this.trailer = json.trailer;
    this.production_company = json.production_company;
    this.director = json.director;
    this.writer = json.writer;
    this.actors = json.actors;
    this.genres = json.genres;
    this.backdrops = json.backdrops;
    this.logo = json.logo;
    this.poster = json.poster;
}

MediaLibrary.Movie.importJsonArray = function(json) {
	var movies = new Array();
	for (var i = 0, j = json.length; i < j; i++) {
		var movie = new MediaLibrary.Movie();
		movie.importJson(json[i]);
		movies.push(movie);
	}
	return movies;
}
