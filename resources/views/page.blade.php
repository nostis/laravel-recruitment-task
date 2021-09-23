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

<label for="content">
    <input id="content">
</label>

<button id="add-text">Add text</button>

<p>Actual: <span id="actual-text"></span></p>
<div id="appended-text">

</div>

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

        $('#add-text').on('click', function() {
            let contentVal = $('#content').val();

            if(contentVal) {
                let actualTextSpan = $('#actual-text');

                if(actualTextSpan.text()) {
                    let prependedText = $('#appended-text')
                    prependedText.prepend('<p>' + actualTextSpan.text() + '</p>')
                }

                actualTextSpan.text(contentVal);
            }
        });
    });
</script>
