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
