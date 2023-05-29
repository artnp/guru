<html>
<head>
    <title>Guru tweet</title>
    <style>
        #L1 {
  position: fixed;
  left: 20%;
  top: 10%;
}
#L2 {
  position: fixed;
  left: 26%;
  top: 16.5%;
}
        </style>
</head>
<body>
<?php 
$symbol = fopen('twitter.txt','r');
echo '<center><div id="L0"><input id="fromfile" style="font-size:20pt;height:36px;width:600px;" value="' . fgets($symbol). '"> <button type="submit" style="font-size:17pt;height:30px;" onClick="generate()">▰ Generate</button></div></center>' 
 ?>  
  <a href="convert.html"><h3>แปลงข้อมูลจากตำรา</h3></a>
  
<center><br><br><br><br><br><br>
<div id="L1">
    ชื่อคลิป:<input id="clipName" style="font-size:20pt;height:36px;width:400px;" autocomplete="off"/>
    <br><br>
Timecode1:<input id="youtube1" style="font-size:20pt;height:36px;width:400px;" autocomplete="off" onClick="this.select();"/>
Timecode2:<input id="youtube2" style="font-size:20pt;height:36px;width:400px;" autocomplete="off" onClick="this.select();"/>
<br><br>
<button type="submit" id="save" style="font-size:17pt;height:35px;" onClick="edit()">▰ Submit</button>
<br><br></div>

<div id="L2">
<form action="" method="POST">
<input name="NameC" id="NameC" style="font-size:20pt;height:36px;width:300px;" autocomplete="off" >
IDs: <input name="ytIds" id="ytIds" style="font-size:20pt;height:36px;width:200px;" autocomplete="off" >
Start: <input name="Start" id="Start" style="font-size:20pt;height:36px;width:60px;" autocomplete="off" >
End: <input name="End" id="End" style="font-size:20pt;height:36px;width:60px;" autocomplete="off" >
<br><br><button type="submit" id="save" style="font-size:17pt;height:35px;" onClick="copyToClipboard()">▰ Submit</button>
</form></div>
<br><br><br><br><br>
<input id="result" style="height:9px;width:9px;" autocomplete="off">
<?php
              if(isset($_POST['ytIds']))
              {
              $data1=$_POST['ytIds'];
              $data2=$_POST['Start'];
              $data3=$_POST['End'];
              $data4=$_POST['NameC'];
              $fp = fopen('data.txt', 'a');
              fwrite($fp, "{x:\"".$data1."\",y:\"".$data2."\",z:\"".$data3."\", name:\"".$data4."\"},"."\n");
              fclose($fp);

              //ลบบรรทัดแรกไฟล์  twitter.txt
              $content = file_get_contents("twitter.txt");
              $newcontent = preg_split('#\r?\n#', ltrim($content), 2)[1];
              file_put_contents("twitter.txt", "$newcontent");

              // Random line twitter.txt
              $lines = file("twitter.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
              shuffle($lines);
                  $fp1 = fopen('twitter.txt', 'w');
                  foreach($lines as $line)
                  fwrite($fp1, "". trim($line) ."\n");
                  fclose($fp1);

              header("Refresh:0");
              }
              ?>
<br>
<?php       


?>
<script>

    //Function generate()
    genN = document.getElementById('fromfile').value
    genS = document.getElementById('fromfile').value
    genE = document.getElementById('fromfile').value
    document.getElementById('clipName').value = genN.split(',')[3]
    document.getElementById('youtube1').value = genS.split('?t=')[0]+'?t=' + genS.split(',')[1]
    document.getElementById('youtube2').value = genE.split('?t=')[0]+'?t=' + genE.split(',')[2]
    document.getElementById('L0').style.visibility = "hidden"
    ////////// end gen


    document.getElementById('L2').style.visibility = "hidden"
edit()

    function edit(){
    document.getElementById('L1').style.visibility = "hidden"
    document.getElementById('L2').style.visibility = "visible"

    edit1 = document.getElementById('youtube1').value
    edit2 = document.getElementById('youtube2').value
    clip = document.getElementById('clipName').value

    editP1 = edit1.replace("https://youtu.be/", "https://artnp.github.io/guru/index.html#"+encodeURIComponent(clip)+'@$');
    editP2 = editP1.replace("?t=", "?start=");
    getID = edit1.replace("https://youtu.be/", '');

    function getSecondPart(str) {
    return str.split('?t=')[1];
    }
    editP3 = document.getElementById('youtube2').value
    editP4 = getSecondPart(editP3)
    document.getElementById('result').value =  clip + ' ... ' + editP2 + '&end=' + editP4

    document.getElementById('ytIds').value = getID.split('?t=')[0]
    document.getElementById('Start').value = getSecondPart(edit1)
    document.getElementById('End').value = editP4
    document.getElementById('NameC').value = clip

  
document.getElementById('youtube1').value=''
document.getElementById('youtube2').value=''
document.getElementById('clipName').value=''
}

function copyToClipboard() {
    var textBox = document.getElementById("result");
    textBox.select();
    document.execCommand("copy");
    }

    

//////////////////////

</script>
</center>
</body>
</html>