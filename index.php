<!DOCTYPE html>
<html>
<head>
    <title>Scrabble</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>
    <h1>Scrabble</h1>
    <form id="scrabbleForm" method="post">
        <label for="rack">Enter your Scrabble tiles:</label>
        <input type="text" name="rack" id="rack" required>
        <br>
        <input type="submit" value="Submit">
    </form>
    <h1>Matched Words:</h1>
    <div id="displayResult">
    
    </div>
    <script>
        $(document).ready(function() {
            $('#scrabbleForm').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: 'ScrabbleController.php',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        $("#displayResult").html("");
                        $("#displayResult").append(`<h3>Tiles: ${response.tiles}<h3>`);
                        if (response.data.length==0) {
                            $("#displayResult").append(`<p>No valid words found for the given tiles.<p>`);
                        } else {
                            let count=0;
                            //Displaying result
                            for (const prop in response.data) {
                                count++;
                                $("#displayResult").append(`<p>Word: ${prop} - Score: ${response.data[prop]}<p>`);
                            }
                            $("#displayResult").append(`<p>Total matched words: ${count}</p>`)
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('Error:', errorThrown);
                        alert('Error: ' + textStatus);
                    }
                    
                })
            })
            
        })
    </script>
</body>
</html>
