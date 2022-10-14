<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>
  <style>
    .movie-item {
      width: 100%
    }
    .movie-plot {
      overflow-wrap: anywhere;
    }
    .movie-title {
      text-align: center;
    }
    @media (min-width: 576px) {
      .movie-item {
        width: 25%;
        min-height: 150px;
        height: 100%;
      }
    }
  </style>
  <script>
    var results = '';
    var resultsClick = '';
    function movieApi() {
        var search = document.getElementById("search").value;
        // Returns successful data submission message when the entered information is stored in database.
        var dataString = '&method=search&search=' + search;
        if (search === '') {
            alert("Please Fill All Fields");
        } else {
            // AJAX code to submit form.
            $.ajax({
                type: "POST",
                url: "movieApi.php",
                data: dataString,
                cache: false,
                success: function(data) {
                    data = JSON.parse(data);
                    results = data.results.slice(0,10);
                    htmlBuilder(results);
                }
            });
        }
        return false;
    }
    function htmlBuilder(results) {
        var html = '';
          for (var i=0; i < 10; i++) {
            html += '<div class="movie-item p-2 align-items-center d-flex flex-column border"><div class="movie-title">' + results[i]["original_title"] + '</div><div class="movie-year">' + results[i]["release_date"] + '</div><div class="movie-click w-100 p-2 align-items-center d-flex flex-column"></div></div>';
          }
        $("#movie-container").html(html);
    }

    function htmlBuilderClick(resultsClick, element) {
      var movie = resultsClick.find(item => {
        return item.release_date === $(element).find('.movie-year').text();
      });
      var html = '';
      html += '<div class="movie-genre">Genre: ' + movie["genre_ids"][0] + '</div><div class="movie-plot">Plot: ' + movie["overview"] + '</div>';
      $(element).find('.movie-click').html(html);
    }

    $(function () {
      $("#movie-container").on("click", '.movie-item', function () {
        var elementThis = this;
        var movieTitle = $(this).find('div:first').text();
        var dataString = '&method=details&search=' + movieTitle.split(' ').join('+');
        var results = '';
        // AJAX code to submit form.
        $.ajax({
            type: "POST",
            url: "movieApi.php",
            data: dataString,
            cache: false,
            success: function(data) {
              data = JSON.parse(data);
              resultsClick = data.results;
              htmlBuilderClick(resultsClick,elementThis);
            }
        });
      });
  });
  </script>
</head>
<body>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid justify-content-center">
    <form class="d-flex" method="POST" onsubmit="return movieApi()">
      <input id="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  </div>
</nav>
<div id="movie-container" class="d-flex flex-column flex-wrap flex-sm-row align-items-center align-items-md-start">
</div>
</body>
</html>