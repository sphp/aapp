<?php
$fruits1=['Apple', 'Banana', 'Cherry', 'Date', 'Grape', 'Lemon', 'Orange'];
$fruits2=['Peach', 'Pear', 'Pineapple', 'Strawberry', 'Watermelon'];

function tag($tag, $atr="", $htm=""){
    $selfclose = ["img", "br", "hr", "input", "area", "link", "meta", "param"];
    if(is_string($atr)) $atr = json_decode($atr, true);
    $elm = "<".$tag;
    if(is_array($atr) && !empty($atr)) foreach($atr as $k=>$v) $elm .= " $k=\"$v\"";
    if(in_array($tag, $selfclose) ) $elm .= "/>" . PHP_EOL;
    else $elm .= is_array($htm) ? ">" . implode(PHP_EOL, $htm) . "</$tag>" : ">".$htm."</$tag>";
    return $elm;
}

function mkSelect($name, $items, $selected=""){
    $opts = '';
    foreach ($items as $item) {
        $opts .= tag('div', '{"class":"item"}', $item);
    }
    $selected = $selected ? 'value="'.$selected.'"' : 'placeholder="Select '.$name.'"';
    $html  = tag('div', '{"class":"ui search selection dropdown"}', [
        tag('input', '{"type":"hidden", "name":"'.$name.'", "class":"ddinput '.$name.'",'.$selected.'}'),
        tag('i', '{"class":"dropdown icon"}'),
        tag('div', '{"class":"default text"}', 'Select '.$name),
        tag('div', '{"class":"menu"}', $opts)
    ]) . PHP_EOL;
    return $html;
}
function mkImage($width, $height, $color='CCCCCC') {
    $img = imagecreatetruecolor($width, $height);
    $bgc = sscanf($color, "%02x%02x%02x");
    $bgc = imagecolorallocate($img, $bgc[0], $bgc[1], $bgc[2]);
    imagefill($img, 0, 0, $bgc);
    $label = $width . 'x' . $height;
    $font = 4;
    $textWidth = imagefontwidth($font) * strlen($label);
    $textHeight = imagefontheight($font);
    $x = ($width - $textWidth) / 2;
    $y = ($height - $textHeight) / 2;
    imagestring($img, $font, $x, $y, $label, imagecolorallocate($img, 0, 0, 0));
    ob_start();
    imagepng($img);
    $data = ob_get_contents();
    ob_end_clean();
    imagedestroy($img);
    return 'data:image/png;base64,' . base64_encode($data);
}
//https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.5.0/semantic.min.css
//https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.5.0/semantic.min.js
//assets/semantic-ui/semantic.min.css
//assets/semantic-ui/semantic.min.js
?>

<!DOCTYPE html>
<html>
<head>
<title>Custom Dropdown with Autocomplete</title>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.5.0/semantic.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.5.0/semantic.min.js">
</script>
<script>
$(document).ready(function() {
  $('.ui.dropdown').dropdown();
});
</script>
</head>
<body class="">

<!-- Page Contents -->

    <div class="ui pushable inverted vertical center aligned segment">
        <div class="ui fixed menu">
          <div class="ui container">
            <a href="#" class="header item">
              Your Logo
            </a>
            <a class="item" href="#">Home</a>
            <a class="item" href="#">About</a>
            <a class="item" href="#">Services</a>
            <a class="item" href="#">Contact</a>
            <div class="right menu">
              <a class="item" href="#">Sign In</a>
              <a class="item" href="#">Sign Up</a>
            </div>
          </div>
        </div>
        <div class="ui text container" style="padding-top:140px">
            <h1 class="ui inverted header">Imagine-a-Company</h1>
            <h2>Do whatever you want when you want to.</h2>
            <div class="ui huge primary button">Get Started <i class="right arrow icon"></i></div>
        </div>
    </div>

    <h4 class="ui horizontal section divider">Internally Celled Grid</h4>
    <div class="ui container internally celled grid">
        <div class="row center aligned">
            <div class="three wide column"><img src="<?=mkImage(220,100)?>"></div>
            <div class="ten wide column"><img src="<?=mkImage(600,100)?>"></div>
            <div class="three wide column"><img src="<?=mkImage(220,100)?>"></div>
        </div>
        <div class="row center aligned">
            <div class="three wide column"><img src="<?=mkImage(220,100)?>"></div>
            <div class="ten wide column"><img src="<?=mkImage(600,100)?>"></div>
            <div class="three wide column"><img src="<?=mkImage(220,100)?>"></div>
        </div>
    </div>
    <div class="ui container">
        <h4 class="ui horizontal section divider">Internally Celled Grid</h4>
        <div class="ui internally celled grid">
            <div class="center aligned row">
                <div class="four wide column"><img src="<?=mkImage(220,100)?>"></div>
                <div class="four wide column"><img src="<?=mkImage(220,100)?>"></div>
                <div class="four wide column"><img src="<?=mkImage(220,100)?>"></div>
                <div class="four wide column"><img src="<?=mkImage(220,100)?>"></div>
            </div>
            <div class="center aligned row">
                <div class="four wide column"><img src="<?=mkImage(220,100)?>"></div>
                <div class="four wide column"><img src="<?=mkImage(220,100)?>"></div>
                <div class="four wide column"><img src="<?=mkImage(220,100)?>"></div>
                <div class="four wide column"><img src="<?=mkImage(220,100)?>"></div>
            </div>
        </div>
    </div>
    <div class="ui equal width center aligned padded grid">
        <div class="row">
            <div class="olive column">Olive</div>
            <div class="black column">Black</div>
            <div class="red column">Red</div>
        </div>
        <div class="row">
            <div class="green column">Black</div>
            <div class="olive column">Olive</div>
        </div>
        <div class="row" style="background-color: #869D05;color: #FFFFFF;">
            <div class="column">Custom Row</div>
        </div>
    </div>
    <div class="ui vertical stripe quote segment">
        <div class="ui container equal width stackable internally celled grid">
          <div class="center aligned row">
            <div class="column">
              <h3>"What a Company"</h3>
              <img src="<?=mkImage(100,100)?>">
              <p>That is what they all say about us</p>
              <button class="ui icon button"><i class="star icon"></i> Favorite</button>
            </div>
            <div class="column">
              <h3>"What a Company"</h3>
              <img src="<?=mkImage(100,100)?>">
              <p>That is what they all say about us</p>
              <button class="ui button" id="openModalButton">Open Modal</button>
            </div>
            <div class="column">
              <h3>"I shouldn't have gone with their competitor."</h3>
                <form class="ui form">
                    <div class="field"><?=mkSelect('fruitA', $fruits1, 'Grape')?></div>
                    <div class="field"><?=mkSelect('fruitB', $fruits2)?></div>
                    <input type="button" name="Submit" value="Submit" class="ui button primary"/>
                </form>
            </div>
          </div>
        </div>
    </div>

    <div class="ui inverted vertical footer segment" style="padding-bottom:40px">
        <div class="ui container row inverted equal width stackable internally celled grid">
            <div class="column">
                <h4 class="ui inverted header">About</h4>
                <div class="ui inverted link list">
                    <a href="#" class="item">Sitemap</a>
                    <a href="#" class="item">Contact Us</a>
                </div>
            </div>
            <div class="column">
                <h4 class="ui inverted header">About</h4>
                <div class="ui inverted link list">
                    <a href="#" class="item">Sitemap</a>
                    <a href="#" class="item">Contact Us</a>
                </div>
            </div>
            <div class="column">
                <h4 class="ui inverted header">About</h4>
                <div class="ui inverted link list">
                    <a href="#" class="item">Sitemap</a>
                    <a href="#" class="item">Contact Us</a>
                </div>
            </div>
            <div class="seven wide column">
                <h4 class="ui inverted header">About</h4>
                <div class="ui inverted link list">
                    <img src="<?=mkImage(200,50)?>">
                    <a href="#" class="item">Sitemap</a>
                    <a href="#" class="item">Contact Us</a>
                </div>
            </div>
        </div>
        <div class="ui inverted section divider"></div>
        <div class="ui container center aligned row">
            <div class="ui horizontal inverted small divided link list">
                <a class="item" href="#">Site Map</a>
                <a class="item" href="#">Contact Us</a>
                <a class="item" href="#">Terms and Conditions</a>
                <a class="item" href="#">Privacy Policy</a>
            </div>
        </div>
    </div>


<div class="ui modal" id="myModal">
  <i class="close icon"></i>
  <div class="header">
    Modal Header
  </div>
  <div class="content">
    <p>This is the content of the modal.</p>
  </div>
  <div class="actions">
    <div class="ui black deny button">Cancel</div>
    <div class="ui positive right labeled icon button">OK
      <i class="checkmark icon"></i>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('#openModalButton').click(function() {
      $('#myModal').modal('show');
    });

    // You can also close the modal with JavaScript if needed
    $('#closeModalButton').click(function() {
      $('#myModal').modal('hide');
    });
  });
</script>

</body>
</html>
