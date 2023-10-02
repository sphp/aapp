<?php
$navdata = '{
    "menuItems": [
        {
            "label": "Home",
            "url": "index.php",
            "icon": "fa-home"
        },
        {
            "label": "About",
            "url": "about.php",
            "icon": "fa-info-circle",
            "subMenu": [
                {
                    "label": "Company",
                    "url": "company.php",
                    "icon": "fa-building"
                },
                {
                    "label": "Team",
                    "url": "team.php",
                    "icon": "fa-users"
                }
            ]
        },
        {
            "label": "Services",
            "url": "services.php",
            "icon": "fa-cogs"
        },
        {
            "label": "Contact",
            "url": "contact.php",
            "icon": "fa-envelope"
        }
    ]
}';

$menuData = json_decode($navdata, true);
function BuildMenu($menuItems, $r=0)
{
    echo !$r ? '<ul class="navbar">' : '<ul class="ddbox">';
    foreach ($menuItems as $item) {
        echo '<li class="item">';
        echo '<a href="' . $item['url'] . '">';
        echo '<i class="fas ' . $item['icon'] . ' mr-2"></i> ' . $item['label'];
        echo '</a>';
        if (isset($item['subMenu']))BuildMenu($item['subMenu'],1);
        echo '</li>';
    }
    echo '</ul>';
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}
.navbar {
    background-color: #eee;
    display: block;
    overflow: hidden;
}
.navbar ul, .navbar li{margin: 0; padding: 0;}
.navbar > .item {float: left}
.navbar li {list-style: none}
.navbar a {
    display: block;
    font-size: 16px;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    min-width: 100px;
}
.navbar a:hover {background-color: red; color: white;}
.ddbox{
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    z-index: 1;
}
.ddbox a {text-align: left;}
.item:hover .ddbox{display: block;}
</style>
</head>
<body>
<center><?=BuildMenu($menuData['menuItems'])?></center>
</body>
</html>
