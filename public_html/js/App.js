var MediaLibrary = MediaLibrary || {};

MediaLibrary.getHtmlFilename = function() {
    var pathname = window.location.pathname;
    var htmlFilename = pathname.substring(pathname.lastIndexOf('/') + 1);
    return htmlFilename;
}

MediaLibrary.getHtmlDirname = function() {
    return location.href.match(/^(http.+\/)[^\/]+$/)[1]
}

MediaLibrary.handleMovieListRequest = function() {
    var listContainer = document.getElementById("movie-list");    
    var request = new MediaLibrary.XhrRequest("service=Movie&method=getAllMovies", function(data) {
        var movies = MediaLibrary.Movie.importJsonArray(JSON.parse(data));
        movies.sort(function(a, b) {
            return a.title.localeCompare(b.title);
        });
        for (var i = 0, j = movies.length; i < j; i++) {
            var movie = movies[i];
            var div = document.createElement("div");
            div.className = "list";
            var li = document.createElement("li");
            var h4 = document.createElement("h4");
            var text = document.createTextNode(movie.title);
            var a = document.createElement("a");
            a.href = "movie.html?id=" + movie.id;
            var img = new Image();
            img.src = "image.php?path=" + MediaLibrary.getHtmlDirname() + movie.poster + "&width=150&height=225";
            
            h4.appendChild(text);
            a.appendChild(img);
            li.appendChild(h4);
            li.appendChild(a);
            div.appendChild(li);
        }
        listContainer.appendChild(div);
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
        // Left column
        var moviePoster = document.getElementById("movie-poster");
        moviePoster.src = "image.php?path=" + MediaLibrary.getHtmlDirname() + movie.poster + "&width=214";
        var movieDirector = document.getElementById("movie-director");
        movieDirector.appendChild(document.createTextNode(movie.director));
        var movieWriter = document.getElementById("movie-writer");
        movieWriter.appendChild(document.createTextNode(movie.writer));
        var movieActorList = document.getElementById("movie-actor-list");
        for (var actor in movie.actors) {
            var li = document.createElement("li");
            var a = document.createElement("a");
            a.href = movie.actors[actor].imdb_link;
            var text = document.createTextNode(movie.actors[actor].name);
            a.appendChild(text);
            li.appendChild(a);
            movieActorList.appendChild(li);
        }
        
        var movieReleased = document.getElementById("movie-released");
        movieReleased.appendChild(document.createTextNode(movie.released));
        
        var movieLanguage = document.getElementById("movie-language");
        movieLanguage.appendChild(document.createTextNode(movie.language));
        
        var movieGenreList = document.getElementById("movie-genre-list");
        for (var genre in movie.genres) {
            var li = document.createElement("li");
            var p = document.createElement("p");
            var text = document.createTextNode(movie.genres[genre].genre);
            p.appendChild(text);
            li.appendChild(p);
            movieGenreList.appendChild(li);
        }
        
        var movieRuntime = document.getElementById("movie-runtime");
        movieRuntime.appendChild(document.createTextNode(movie.runtime));
        
        var movieProductionCompnay = document.getElementById("movie-production-company");
        movieProductionCompnay.appendChild(document.createTextNode(movie.production_company));
        
        // Right column
        var movieLogo = document.getElementById("movie-logo");
        movieLogo.src = "image.php?path=" + MediaLibrary.getHtmlDirname() + movie.logo + "&width=400&height=155";
        
        var moviePlot = document.getElementById("movie-plot");
        moviePlot.appendChild(document.createTextNode(movie.plot));
        
        var movieTrailer = document.getElementById("movie-trailer");
        movieTrailer.src = movie.trailer;

        var movieMainBackdrop = document.getElementById("movie-main-backdrop");
        var movieBackdrops = document.getElementById("movie-backdrops");
        
        var previewImg = new Image();
        
        var changePreviewImage = function(src) {
            return function() {
                previewImg.src = src;    
            }
            
        }
        
        for (var backdrop in movie.backdrops) {
            if (backdrop == 0) {
                
                previewImg.src = "image.php?path=" + MediaLibrary.getHtmlDirname() + movie.backdrops[backdrop] + "&width=450";
                previewImg.id = "preview";
                previewImg.alt = "No image loaded";
                movieMainBackdrop.appendChild(previewImg);
            }
            var img = new Image();
            img.src = "image.php?path=" + MediaLibrary.getHtmlDirname() + movie.backdrops[backdrop] + "&width=450";
            img.id = "preview";
            img.alt = "No image loaded";
            img.onclick = changePreviewImage(movie.backdrops[backdrop]);
            movieBackdrops.appendChild(img);
        }
        
        
    }
}

MediaLibrary.run = function() {
    $htmlFilename = MediaLibrary.getHtmlFilename();
	switch ($htmlFilename) {
	    case 'movies.html':
	       MediaLibrary.handleMovieListRequest();
	       break;
	    case 'movie.html':
	       MediaLibrary.handleMovieInfoRequest();
	       break;
	}
}

MediaLibrary.registerStartupFunction(MediaLibrary.run())
