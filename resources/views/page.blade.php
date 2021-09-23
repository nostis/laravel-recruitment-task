<head>
    <title>Page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>

<h2>First section</h2>

<label>
    <input type="number" id="number-1">
</label>

<label>
    <input type="number" id="number-2">
</label>

<button id="count">Count</button>

<p>Result: <span id="result"></span></p>

<hr>

<h2>Second section</h2>
<p>Second section</p>

<script>
    $(function() {
        $('#count').on('click', function() {
            let firstInputVal = parseInt($('#number-1').val());
            let secondInputVal = parseInt($('#number-2').val());

            if(!Number.isInteger(firstInputVal)) {
                firstInputVal = 0;
            }

            if(!Number.isInteger(secondInputVal)) {
                secondInputVal = 0;
            }

           $('#result').text(firstInputVal + secondInputVal);
        });


    });
</script>
