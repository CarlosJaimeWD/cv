<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <main>
        <h1>Keywords<span>Type keywords</span></h1>
        <textarea placeholder="Enter Job Description"></textarea>
        <textarea placeholder="Enter keywords separated by comas" id="keywords"></textarea>
        <a href="#" class="button button-effect">Find ...</a>
        <div id="output"></div>
    </main>
    
</body>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script>
    $('.button-effect').click(function(e) {
  var self = $(this),
    wave = '.effect-wave',
    btnWidth = self.outerWidth(),
    x = e.offsetX,
    y = e.offsetY;

  self.prepend('<span class="effect-wave"></span>')

  $(wave)
    .css({
      'top': y,
      'left': x
    })
    .animate({
      opacity: '0',
      width: btnWidth * 2,
      height: btnWidth * 2
    }, 500, function() {
      self.find(wave).remove()
    })

    var keywords = $("#keywords").val();
    console.log(keywords);
    
    $.ajax ({
        url: "pdf2text.php",
        method: "POST",
        data: ({keywords: keywords}),
        success: function(result) {
            $("#output").html("");
            $("#output").html(result);
            sortTable();
        }
    });  

    function sortTable() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("table");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[1];
      y = rows[i + 1].getElementsByTagName("TD")[1];
      //check if the two rows should switch place:
        if (Number(parseInt(x.innerHTML)) < Number(parseInt(y.innerHTML))) {            
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}        
    
})


</script>
</html>