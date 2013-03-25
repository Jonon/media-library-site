var MediaLibrary = MediaLibrary || {};

MediaLibrary.getHtmlFilename = function() {
    var pathname = window.location.pathname;
    var htmlFilename = pathname.substring(pathname.lastIndexOf('/') + 1);
    return htmlFilename;
}

MediaLibrary.handleMovieListRequest = function() {
    var listContainer = document.getElementById("content");
    var ul = document.createElement("ul");
    
    var request = new MediaLibrary.XhrRequest("service=Movie&method=getAllMovies", function(data) {
        var movies = MediaLibrary.Movie.importJsonArray(JSON.parse(data));
        for (var i = 0, j = movies.length; i < j; i++) {
            var movie = movies[i];
            var li = document.createElement("li");
            var a = document.createElement("a");
            a.href = "moviesample.html?id=" + movie.id;
            var text = document.createTextNode(movie.title);
            a.appendChild(text);
            li.appendChild(a);
            ul.appendChild(li);
        }
        listContainer.appendChild(ul);
    });
}

MediaLibrary.handleMovieInfoRequest = function() {
    var movieId = MediaLibrary.getParameterByName("id");
    if (movieId != null) {
        if (!isNaN(movieId)) {
            var request = new MediaLibrary.XhrRequest("service=Movie&method=getMovieById&params[]=" + movieId, function(data) {
                var movie = new MediaLibrary.Movie();
                movie.importJson(JSON.parse(data));
                MediaLibrary.fillMovieInfo(movie)
            });
        }
    }
}

MediaLibrary.fillMovieInfo = function(movie) {
    if (movie instanceof MediaLibrary.Movie) {
        alert("This movie has the Imdb ID " + movie.imdb_id + " and the title " + movie.title + ".");
    }
}

MediaLibrary.run = function() {
    $htmlFilename = MediaLibrary.getHtmlFilename();
	switch ($htmlFilename) {
	    case 'movies.html':
	       MediaLibrary.handleMovieListRequest();
	       break;
	    case 'moviesample.html':
	       MediaLibrary.handleMovieInfoRequest();
	       break;
	}
}

MediaLibrary.registerStartupFunction(MediaLibrary.run())
