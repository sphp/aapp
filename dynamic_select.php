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
    foreach ($items as $item)$opts .= tag('div', '{"class":"ddoption"}', $item);
    $selected = $selected ? '"value":"'.$selected.'"' : '"placeholder":"Select '.$name.'"';
    $html  = tag('input', '{"type":"text", "name":"'.$name.'", "class":"ddinput '.$name.'",'.$selected.'}');
    $html .= tag('div', '{"class":"ddoptions '.$name.'"}', $opts) . PHP_EOL;
    return tag('div', '{"style":"position:relative;display:inline-block"}', $html);
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Custom Dropdown with Autocomplete</title>
    <style>
        input[type="text"] {
            width: 200px;
            padding: 8px;
            border: none;
            border-bottom: 1px solid #999;
        }
        input[type="text"]:focus{outline:none}
        .ddoptions {
            display: none;
            position: absolute;
            width: 100%;
            max-height: 140px;
            overflow: auto;
            z-index: 1;
        }
        .ddoption {
            padding: 8px;
            border-bottom: 1px solid #fff;
            background-color: #efefef;
            cursor: pointer;
            text-align: left;
        }
        .ddoption:hover {background-color: #ababab}
        .ddoptions.show {display: block}
    </style>
</head>
<body>
<form>
    <?=mkSelect('fruitA', $fruits1, 'Grape')?>
    <?=mkSelect('fruitB', $fruits2)?>
    <input type="button" name="Submit" value="Submit" />
</form>

<script>
    const d=document,
    dinputs=d.querySelectorAll('.ddinput'),
    ddopts=d.querySelectorAll('.ddoptions'),
    optelms=d.querySelectorAll('.ddoption');
    dinputs.forEach(function(dinput, index) {
        dinput.addEventListener('click', function () {
            ddopts[index].classList.toggle('show');
        });
        ddopts[index].addEventListener('click', function (event) {
            if (event.target.classList.contains('ddoption')) {
                dinput.value=event.target.textContent;
                ddopts[index].classList.remove('show');
            }
        });
        dinput.addEventListener('input', function () {
            optelms.forEach(function (opt) {
                const txt=opt.textContent.toLowerCase();
                opt.style.display=txt.includes(dinput.value.toLowerCase()) ? 'block' : 'none';
            });
            ddopts[index].classList.add('show');
        });
        d.addEventListener('click', function (event) {
            if (!dinput.contains(event.target) && !ddopts[index].contains(event.target)) ddopts[index].classList.remove('show');
        });
    });
</script>
</body>
</html>
