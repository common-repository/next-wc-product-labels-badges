<?php
function wcplb_DrawImg_TextBox($parImg,$x1,$y1,$x2,$y2,$r,$parColor)
{ list($red, $green, $blue) = sscanf($parColor, "#%02x%02x%02x");
  $tmpColor = imageColorAllocate($parImg, $red, $green, $blue);
  
  $r = min($r,floor(min(($x2 - $x1) / 2,($y2 - $y1) / 2)));
 
  imagefilledarc($parImg,$x1 + $r,$y1 + $r,$r * 2,$r * 2,180,270,$tmpColor,IMG_ARC_PIE);
  imagefilledarc($parImg,$x2 - $r,$y1 + $r,$r * 2,$r * 2,270,0,$tmpColor,IMG_ARC_PIE);
  imagefilledarc($parImg,$x2 - $r,$y2 - $r,$r * 2,$r * 2,0,90,$tmpColor,IMG_ARC_PIE);
  imagefilledarc($parImg,$x1 + $r,$y2 - $r,$r * 2,$r * 2,0,180,$tmpColor,IMG_ARC_PIE);
  imagefilledrectangle($parImg,$x1+$r,$y1,$x2-$r,$y2,$tmpColor);
  imagefilledrectangle($parImg,$x1,$y1+$r,$x1+$r,$y2-$r,$tmpColor);
  imagefilledrectangle($parImg,$x2-$r,$y1+$r,$x2,$y2-$r,$tmpColor);
}

function wcplb_DrawImg_Label($parImg,$parLabelColor)
{ $coeff=2;
  $transparent_color = imagecolorallocate($parImg,0xff,0xff,0xff);

  list($red,$green,$blue) = sscanf($parLabelColor,"#%02x%02x%02x");
  $tmpLabelColor = imageColorAllocate($parImg,$red,$green,$blue);
  
  $values = array(      
            0*$coeff,46*$coeff,
            39*$coeff,16*$coeff,
            140*$coeff,34*$coeff,
            129*$coeff,102*$coeff,
            27*$coeff,86*$coeff);

  imagefilledpolygon($parImg,$values,5,$tmpLabelColor);
  imagefilledellipse($parImg,26*$coeff,50*$coeff,21*$coeff,21*$coeff,$transparent_color);

  imagesetthickness($parImg,5);
  imagefilledarc($parImg,40*$coeff,30*$coeff,49*$coeff,49*$coeff,110,318,imagecolorallocate($parImg,64,64,64),IMG_ARC_PIE|IMG_ARC_NOFILL);
  imagefilledarc($parImg,40*$coeff,30*$coeff,51*$coeff,51*$coeff,110,320,imagecolorallocate($parImg,56,56,56),IMG_ARC_PIE|IMG_ARC_NOFILL);
  imagefilledarc($parImg,40*$coeff,30*$coeff,53*$coeff,53*$coeff,110,322,imagecolorallocate($parImg,56,56,56),IMG_ARC_PIE|IMG_ARC_NOFILL);
  imagefilledarc($parImg,40*$coeff,30*$coeff,55*$coeff,55*$coeff,110,324,imagecolorallocate($parImg,92,92,92),IMG_ARC_PIE|IMG_ARC_NOFILL);
}

function wcplb_DrawImg_Flag($parImg,$parLabelColor)
{ $coeff=2;
  $transparent_color = imagecolorallocate($parImg,0xff,0xff,0xff);
  
  $tmpColorDarker = wcplb_DarkenColor($parLabelColor);
  list($red,$green,$blue) = sscanf($tmpColorDarker,"#%02x%02x%02x");
  $tmpColorDarker = imageColorAllocate($parImg,$red,$green,$blue);

  list($red,$green,$blue) = sscanf($parLabelColor,"#%02x%02x%02x");
  $tmpLabelColor = imageColorAllocate($parImg,$red,$green,$blue);

  $values = array(      
            0*$coeff,0*$coeff,
            95*$coeff,0*$coeff,
            110*$coeff,30*$coeff,
            106*$coeff,40*$coeff,
            0*$coeff,40*$coeff);
  imagefilledpolygon($parImg,$values,5,$tmpLabelColor);
  
  $values = array(      
            106*$coeff,40*$coeff,
            95*$coeff,70*$coeff,
            0*$coeff,70*$coeff,
            0*$coeff,40*$coeff);
  imagefilledpolygon($parImg,$values,4,$tmpColorDarker);
 
  $values = array(      
            0*$coeff,70*$coeff,
            5*$coeff,70*$coeff,
            5*$coeff,75*$coeff);
  imagefilledpolygon($parImg,$values,3,$tmpColorDarker); 
}

function wcplb_DrawImg_Flash($parImg,$parLabelColor,$parPatternColor)
{ $coeff=2;
  $transparent_color = imagecolorallocate($parImg,0xff,0xff,0xff);
  
  list($red,$green,$blue) = sscanf($parLabelColor,"#%02x%02x%02x");
  $tmpLabelColor = imageColorAllocate($parImg,$red,$green,$blue);

  $tmpColorDarker = wcplb_DarkenColor($parLabelColor);
  list($red,$green,$blue) = sscanf($tmpColorDarker,"#%02x%02x%02x");
  $tmpColorDarker = imageColorAllocate($parImg,$red,$green,$blue);

  list($red, $green, $blue) = sscanf($parPatternColor, "#%02x%02x%02x");
  $tmpPatterncolor = imageColorAllocate($parImg, $red, $green, $blue);

  $opt_Shadow = true;
  if ($opt_Shadow)
     { $tmpOffsetShadow = 5;
       
       $values = array(      
            (0+$tmpShiftShadow)*$coeff,(0+$tmpShiftShadow)*$coeff,
            (50+$tmpShiftShadow)*$coeff,(15+$tmpShiftShadow)*$coeff,
            (100+$tmpShiftShadow)*$coeff,(0+$tmpShiftShadow)*$coeff,
            (100+$tmpShiftShadow)*$coeff,(50+$tmpShiftShadow)*$coeff,
            (50+$tmpShiftShadow)*$coeff,(65+$tmpShiftShadow)*$coeff,
            (0+$tmpShiftShadow)*$coeff,(50+$tmpShiftShadow)*$coeff);
       imagefilledpolygon($parImg,$values,6,$tmpColorDarker);
  
       $values = array(      
            (0+$tmpShiftShadow)*$coeff,(50+$tmpShiftShadow)*$coeff,
            (50+$tmpShiftShadow)*$coeff,(65+$tmpShiftShadow)*$coeff,
            (100+$tmpShiftShadow)*$coeff,(50+$tmpShiftShadow)*$coeff,
            (100+$tmpShiftShadow)*$coeff,(90+$tmpShiftShadow)*$coeff,
            (50+$tmpShiftShadow)*$coeff,(105+$tmpShiftShadow)*$coeff,
            (0+$tmpShiftShadow)*$coeff,(90+$tmpShiftShadow)*$coeff);
       imagefilledpolygon($parImg,$values,6,$tmpColorDarker);
     }
     
  $values = array(      
            0*$coeff,0*$coeff,
            50*$coeff,15*$coeff,
            100*$coeff,0*$coeff,
            100*$coeff,50*$coeff,
            50*$coeff,65*$coeff,
            0*$coeff,50*$coeff);
  imagefilledpolygon($parImg,$values,6,$tmpLabelColor);
  
  $values = array(      
            0*$coeff,50*$coeff,
            50*$coeff,65*$coeff,
            100*$coeff,50*$coeff,
            100*$coeff,90*$coeff,
            50*$coeff,105*$coeff,
            0*$coeff,90*$coeff);
  imagefilledpolygon($parImg,$values,6,$tmpPatterncolor);
}

function wcplb_DrawImg_Corner($parImg,$parLabelColor)
{ $coeff=2;
  
  $x1=0;
  $y1=0;
  $x2=100*$coeff;
  $y2=100*$coeff;
  $r=30*$coeff;

  $r = min($r,floor(min(($x2-$x1)/2,($y2-$y1)/2)));
  $transparent_color = imagecolorallocate($parImg,0xff,0xff,0xff);
  
  $tmpColorDarker = wcplb_DarkenColor($parLabelColor);
  list($red,$green,$blue) = sscanf($tmpColorDarker,"#%02x%02x%02x");
  $tmpColorDarker = imageColorAllocate($parImg,$red,$green,$blue);

  list($red,$green,$blue) = sscanf($parLabelColor,"#%02x%02x%02x");
  $tmpLabelColor = imageColorAllocate($parImg,$red,$green,$blue);
  
  imagefilledarc($parImg,$x1 + $r,$y1 + $r,$r * 2,$r * 2,180,270,$tmpLabelColor,IMG_ARC_PIE);
  imagefilledarc($parImg,$x2 - $r,$y2 - $r,$r * 2,$r * 2,0,90,$tmpLabelColor,IMG_ARC_PIE);
  imagefilledarc($parImg,$x1 + $r,$y2 - $r,$r * 2,$r * 2,90,180,$tmpLabelColor,IMG_ARC_PIE);
  imagefilledrectangle($parImg,$x1+$r,$y1,$x2-$r,$y2,$tmpLabelColor);
  imagefilledrectangle($parImg,$x1,$y1+$r,$x2,$y2-$r,$tmpLabelColor);
  imagefilledrectangle($parImg,$x2-$r,$y1,$x2,$y1+$r,$tmpLabelColor);
  
  imagefilledarc($parImg,$x2,$y1,$r * 2,$r * 2,90,180,$tmpColorDarker,IMG_ARC_PIE);
  $values = array(      
            $x2-$r,$y1,
            $x2,$y1,
            $x2,$y1+$r);
  imagefilledpolygon($parImg,$values,3,$transparent_color);
}

function wcplb_DrawImg_Drop($parImg,$parLabelColor)
{ $coeff=2;

  list($red,$green,$blue) = sscanf($parLabelColor,"#%02x%02x%02x");
  $tmpLabelColor = imageColorAllocate($parImg,$red,$green,$blue);
  
  imagefilledellipse($parImg,52*$coeff,52*$coeff,104*$coeff,104*$coeff,$tmpLabelColor);  
  imagefilledarc($parImg,0*$coeff,0*$coeff,104*$coeff,104*$coeff,0,90,$tmpLabelColor,IMG_ARC_CHORD);
}

function wcplb_DrawImg_Bubble($parImg,$parLabelColor,$parPatternColor)
{ $coeff=2;
  $transparent_color = imagecolorallocate($parImg,0xFF,0xFF,0xFF);
  
  list($red,$green,$blue) = sscanf($parLabelColor,"#%02x%02x%02x");
  $tmpLabelColor = imageColorAllocate($parImg,$red,$green,$blue);

  $tmpColorDarker = wcplb_DarkenColor($parLabelColor);
  list($red,$green,$blue) = sscanf($tmpColorDarker,"#%02x%02x%02x");
  $tmpColorDarker = imageColorAllocate($parImg,$red,$green,$blue);

  list($red, $green, $blue) = sscanf($parPatternColor, "#%02x%02x%02x");
  $tmpPatterncolor = imageColorAllocate($parImg, $red, $green, $blue);
  
  $rayon=50;
  $tmpShiftShadow = 5;
  $values = array(      
            (0+$tmpShiftShadow)*$coeff,(110+$tmpShiftShadow)*$coeff,
            (30+$tmpShiftShadow)*$coeff,(80+$tmpShiftShadow)*$coeff,
            (90+$tmpShiftShadow)*$coeff,(80+$tmpShiftShadow)*$coeff);
  imagefilledpolygon($parImg,$values,3,$tmpColorDarker);
  imagefilledellipse($parImg,($rayon+$tmpShiftShadow)*$coeff,($rayon+$tmpShiftShadow)*$coeff,2*$rayon*$coeff,2*$rayon*$coeff,$tmpColorDarker); 

  $values = array(      
            0*$coeff,110*$coeff,
            30*$coeff,80*$coeff,
            90*$coeff,80*$coeff);
  imagefilledpolygon($parImg,$values,3,$tmpLabelColor);
  imagefilledellipse($parImg,$rayon*$coeff,$rayon*$coeff,2*$rayon*$coeff,2*$rayon*$coeff,$tmpLabelColor); 

  for ($i=1;$i<=5;$i++)
      imageellipse($parImg,$rayon*$coeff,$rayon*$coeff,2*($rayon-5-$i)*$coeff,2*($rayon-5-$i)*$coeff,$tmpPatterncolor);
}

function wcplb_DrawImg_Circle($parImg,$parLabelColor)
{ $coeff=2;
  $transparent_color = imagecolorallocate($parImg,0xFF,0xFF,0xFF);
  
  list($red,$green,$blue) = sscanf($parLabelColor,"#%02x%02x%02x");
  $tmpLabelColor = imageColorAllocate($parImg,$red,$green,$blue);
  
  $very_light_white = imageColorAllocate($parImg,0xF0,0xF0,0xF0);
  $gray = imagecolorallocate($parImg,56,56,56);
  $rayon=52;
  imagefilledellipse($parImg,$rayon*$coeff,$rayon*$coeff,2*$rayon*$coeff,2*$rayon*$coeff,$tmpLabelColor);  
  imagefilledarc($parImg,0,0,2*$rayon*$coeff,2*$rayon*$coeff,-45,135,$very_light_white,IMG_ARC_PIE);
  
  imagearc($parImg,1,1,2*$rayon*$coeff+1,2*$rayon*$coeff+1,-45,135,$gray);
  imagearc($parImg,2,2,2*$rayon*$coeff+2,2*$rayon*$coeff+2,-45,135,$gray);
  
  imagefilledarc($parImg,0,0,2*$rayon*$coeff,2*$rayon*$coeff,0,90,$transparent_color,IMG_ARC_CHORD);
  imageline($parImg,0,103,103,0,imagecolorallocate($parImg,0xE0,0xE0,0xE0));
  imageline($parImg,0,104,104,0,imagecolorallocate($parImg,0xD0,0xD0,0xD0));
}


function wcplb_DarkenColor($parRGB,$ParDark=2)
{ $diese = (strpos($parRGB,'#') !== false)?'#':'';
  $parRGB = (strlen($parRGB) == 7)?str_replace('#','',$parRGB):((strlen($parRGB)==6)?$parRGB:false);
  if (strlen($parRGB) != 6) return $diese . '000000';
  $ParDark = ($ParDark > 1)?$ParDark:1;
 
  list($red,$green,$blue) = str_split($parRGB,2);
  $red = sprintf("%02X",floor(hexdec($red)/($ParDark/1)));
  $green= sprintf("%02X",floor(hexdec($green)/($ParDark/1)));
  $blue = sprintf("%02X",floor(hexdec($blue)/($ParDark/1)));

  return $diese . $red . $green . $blue;
}

function wcplb_DrawImg_Ribbon($parImg,$parBadgeColor,$parFont,$parFontSize,$parFontColor,$parText)
{ $coeff=2;
  $transparent_color = imagecolorallocate($parImg,0xff,0xff,0xff);
  
  $tmpColorDarker = wcplb_DarkenColor($parBadgeColor);
  list($red,$green,$blue) = sscanf($tmpColorDarker,"#%02x%02x%02x");
  $tmpColorDarker = imageColorAllocate($parImg,$red,$green,$blue);

  list($red,$green,$blue) = sscanf($parBadgeColor,"#%02x%02x%02x");
  $tmpBadgeColor = imageColorAllocate($parImg,$red,$green,$blue);

  list($red, $green, $blue) = sscanf($parFontColor, "#%02x%02x%02x");
  $tmpFontcolor = imageColorAllocate($parImg, $red, $green, $blue);

  imagefilledellipse($parImg,17*$coeff,21*$coeff,42*$coeff,42*$coeff,$tmpColorDarker);
  imagefilledellipse($parImg,98*$coeff,102*$coeff,42*$coeff,42*$coeff,$tmpColorDarker);
  
  imagefilledrectangle($parImg,0,9*$coeff,110*$coeff,150*$coeff,$transparent_color);  
  
  $values = array(      
            20*$coeff,0*$coeff,
            56*$coeff,0*$coeff,
            119*$coeff,62*$coeff,
            119*$coeff,99*$coeff);
  imagefilledpolygon($parImg,$values,4,$tmpBadgeColor);
  
  imagefilledellipse($parImg,58*$coeff,10*$coeff,20*$coeff,20*$coeff,$tmpBadgeColor);
  imagefilledellipse($parImg,109*$coeff,61*$coeff,20*$coeff,20*$coeff,$tmpBadgeColor);
  
  $values = array(      
            58*$coeff,10*$coeff,
            66*$coeff,4*$coeff,
            116*$coeff,54*$coeff,
            109*$coeff,60*$coeff);
  imagefilledpolygon($parImg,$values,4,$tmpBadgeColor);

  $OrigX = 88;$OrigY = 12; $LongXY = 150;
  $tmpOffsetFontHeight = ($parFontSize/5) - 2;
  $OrigX -= ($tmpOffsetFontHeight*$coeff);$OrigY += ($tmpOffsetFontHeight*$coeff);
  
  $tmpA_SizeBox = imagettfbbox($parFontSize,315,$parFont,$parText);
  $tmpDiagonalDist = sqrt(pow($tmpA_SizeBox[2]-$tmpA_SizeBox[6],2)+pow($tmpA_SizeBox[3]-$tmpA_SizeBox[7],2));
  $tmpDistXY =$tmpDiagonalDist * 0.707;
  $tmpStartX = intval($OrigX + ($LongXY-$tmpDistXY)/2);
  $tmpStartY = intval($OrigY + ($LongXY-$tmpDistXY)/2);

  $ret = imagettftext($parImg,$parFontSize,315,$tmpStartX,$tmpStartY,$tmpFontcolor,$parFont,$parText);
}

function wcplb_NewX($parX,$parY,$parAlpha)
{ $radAlpha = $parAlpha * M_PI / 180;
  return intval($parX * cos($radAlpha) - $parY * sin($radAlpha));
}
function wcplb_NewY($parX,$parY,$parAlpha)
{ $radAlpha = $parAlpha * M_PI / 180;
  return intval($parX * sin($radAlpha) + $parY * cos($radAlpha));
}
function wcplb_check_letters($parStr)
{ $tmpUp = 2;
  $pos = strpos($parStr, "g"); if ($pos !== false) return $tmpUp;
  $pos = strpos($parStr, "j"); if ($pos !== false) return $tmpUp;
  $pos = strpos($parStr, "p"); if ($pos !== false) return $tmpUp;
  $pos = strpos($parStr, "q"); if ($pos !== false) return $tmpUp;
  $pos = strpos($parStr, "y"); if ($pos !== false) return $tmpUp;
  return 0;
}
function wcplb_DrawImg_Stamp($parImg,$parBadgeColor,$parFont,$parFontSize,$parFontColor,$parText)
{ $coeff=2;
  $transparent_color = imagecolorallocate($parImg,0xff,0xff,0xff);
  
  $tmpColorDarker = wcplb_DarkenColor($parBadgeColor);
  list($red,$green,$blue) = sscanf($tmpColorDarker,"#%02x%02x%02x");
  $tmpColorDarker = imageColorAllocate($parImg,$red,$green,$blue);

  list($red,$green,$blue) = sscanf($parBadgeColor,"#%02x%02x%02x");
  $tmpBadgeColor = imageColorAllocate($parImg,$red,$green,$blue);

  list($red, $green, $blue) = sscanf($parFontColor, "#%02x%02x%02x");
  $tmpFontcolor = imageColorAllocate($parImg, $red, $green, $blue);

  $alpha = 22;
  $values = array(      
            wcplb_NewX(30,-10,$alpha)*$coeff,wcplb_NewY(30,-10,$alpha)*$coeff,
            wcplb_NewX(150,-10,$alpha)*$coeff,wcplb_NewY(150,-10,$alpha)*$coeff,
            wcplb_NewX(150,0,$alpha)*$coeff,wcplb_NewY(150,0,$alpha)*$coeff,
            wcplb_NewX(30,0,$alpha)*$coeff,wcplb_NewY(30,0,$alpha)*$coeff);
  imagefilledpolygon($parImg,$values,4,$tmpBadgeColor);

  $values = array(      
            wcplb_NewX(30,2,$alpha)*$coeff,wcplb_NewY(30,2,$alpha)*$coeff,
            wcplb_NewX(150,2,$alpha)*$coeff,wcplb_NewY(150,2,$alpha)*$coeff,
            wcplb_NewX(150,5,$alpha)*$coeff,wcplb_NewY(150,5,$alpha)*$coeff,
            wcplb_NewX(30,5,$alpha)*$coeff,wcplb_NewY(30,5,$alpha)*$coeff);
  imagefilledpolygon($parImg,$values,4,$tmpColorDarker);
    
  $values = array(      
            wcplb_NewX(30,40,$alpha)*$coeff,wcplb_NewY(30,40,$alpha)*$coeff,
            wcplb_NewX(150,40,$alpha)*$coeff,wcplb_NewY(150,40,$alpha)*$coeff,
            wcplb_NewX(150,50,$alpha)*$coeff,wcplb_NewY(150,50,$alpha)*$coeff,
            wcplb_NewX(30,50,$alpha)*$coeff,wcplb_NewY(30,50,$alpha)*$coeff);
  imagefilledpolygon($parImg,$values,4,$tmpBadgeColor);
  
  $values = array(      
            wcplb_NewX(30,52,$alpha)*$coeff,wcplb_NewY(30,52,$alpha)*$coeff,
            wcplb_NewX(150,52,$alpha)*$coeff,wcplb_NewY(150,52,$alpha)*$coeff,
            wcplb_NewX(150,55,$alpha)*$coeff,wcplb_NewY(150,55,$alpha)*$coeff,
            wcplb_NewX(30,55,$alpha)*$coeff,wcplb_NewY(30,55,$alpha)*$coeff);
  imagefilledpolygon($parImg,$values,4,$tmpColorDarker);
  
  $OrigX = 27*$coeff; $OrigY = -10*$coeff;
  $origW = 120*$coeff; $origH = 65*$coeff;
  
  $tmpA_SizeBox = imagettfbbox($parFontSize,$alpha,$parFont,$parText);
  $tmpW = ($tmpA_SizeBox[2]-$tmpA_SizeBox[0]); $tmpH = ($tmpA_SizeBox[3]-$tmpA_SizeBox[5]);

  $tmpNeedUp = wcplb_check_letters($parText);
  $tmpStartX = wcplb_NewX($OrigX + ($origW-$tmpW)/2,$OrigY + abs($origH-$tmpH)/2+$tmpH-$tmpNeedUp,$alpha);
  $tmpStartY = wcplb_NewY($OrigX + ($origW-$tmpW)/2,$OrigY + abs($origH-$tmpH)/2+$tmpH-$tmpNeedUp,$alpha);

  $ret = imagettftext($parImg,$parFontSize,360-$alpha,$tmpStartX,$tmpStartY,$tmpFontcolor,$parFont,$parText);
}

function wcplb_DrawImg_LeftBanner($Type,$parImg,$parBadgeColor,$parFont,$parFontSize,$parFontColor,$parText)
{ $coeff=2;
  $transparent_color = imagecolorallocate($parImg,0xff,0xff,0xff);
  
  $tmpColorDarker = wcplb_DarkenColor($parBadgeColor);
  list($red,$green,$blue) = sscanf($tmpColorDarker,"#%02x%02x%02x");
  $tmpColorDarker = imageColorAllocate($parImg,$red,$green,$blue);

  list($red,$green,$blue) = sscanf($parBadgeColor,"#%02x%02x%02x");
  $tmpBadgeColor = imageColorAllocate($parImg,$red,$green,$blue);

  list($red, $green, $blue) = sscanf($parFontColor, "#%02x%02x%02x");
  $tmpFontcolor = imageColorAllocate($parImg, $red, $green, $blue);

  $opt_Shadow = false;
  if ($opt_Shadow)
     { $tmpOffsetShadow = 10;
       if ($Type == "IN")
          { $values = array(      
            0*$coeff+$tmpOffsetShadow,0*$coeff+$tmpOffsetShadow,
            150*$coeff+$tmpOffsetShadow,0*$coeff+$tmpOffsetShadow,
            120*$coeff+$tmpOffsetShadow,20*$coeff+$tmpOffsetShadow,
            150*$coeff+$tmpOffsetShadow,40*$coeff+$tmpOffsetShadow,
            0*$coeff+$tmpOffsetShadow,40*$coeff+$tmpOffsetShadow);
          }
       else //"OUT"
          { $values = array(      
            0*$coeff+$tmpOffsetShadow,0*$coeff+$tmpOffsetShadow,
            120*$coeff+$tmpOffsetShadow,0*$coeff+$tmpOffsetShadow,
            150*$coeff+$tmpOffsetShadow,20*$coeff+$tmpOffsetShadow,
            120*$coeff+$tmpOffsetShadow,40*$coeff+$tmpOffsetShadow,
            0*$coeff+$tmpOffsetShadow,40*$coeff+$tmpOffsetShadow);
          }
       imagefilledpolygon($parImg,$values,5,$tmpColorDarker);
     }

  if ($Type == "IN")
     { $values = array(      
            0*$coeff,0*$coeff,
            150*$coeff,0*$coeff,
            120*$coeff,20*$coeff,
            150*$coeff,40*$coeff,
            0*$coeff,40*$coeff);
     }
  else
     { $values = array(      
            0*$coeff,0*$coeff,
            120*$coeff,0*$coeff,
            150*$coeff,20*$coeff,
            120*$coeff,40*$coeff,
            0*$coeff,40*$coeff);
     }
  imagefilledpolygon($parImg,$values,5,$tmpBadgeColor);
  
  $values = array(      
            0*$coeff,40*$coeff,
            10*$coeff,40*$coeff,
            10*$coeff,50*$coeff);
  imagefilledpolygon($parImg,$values,3,$tmpColorDarker);
  
  $OrigX = 2*$coeff; $OrigY = 0*$coeff;
  $origW = 120*$coeff; $origH = 40*$coeff;
  
  $tmpA_SizeBox = imagettfbbox($parFontSize,0,$parFont,$parText);
  $tmpW = ($tmpA_SizeBox[2]-$tmpA_SizeBox[0]); $tmpH = ($tmpA_SizeBox[3]-$tmpA_SizeBox[5]);

  $tmpNeedUp = wcplb_check_letters($parText);
  $tmpStartX = $OrigX + ($origW-$tmpW)/2;
  $tmpStartY = $OrigY + abs($origH-$tmpH)/2+$tmpH-$tmpNeedUp;
  
  $ret = imagettftext($parImg,$parFontSize,0,$tmpStartX,$tmpStartY,$tmpFontcolor,$parFont,$parText);
}

function wcplb_DrawImg_RightBanner($Type,$parImg,$parBadgeColor,$parFont,$parFontSize,$parFontColor,$parText)
{ $coeff=2;
  $transparent_color = imagecolorallocate($parImg,0xff,0xff,0xff);
  
  $tmpColorDarker = wcplb_DarkenColor($parBadgeColor);
  list($red,$green,$blue) = sscanf($tmpColorDarker,"#%02x%02x%02x");
  $tmpColorDarker = imageColorAllocate($parImg,$red,$green,$blue);

  list($red,$green,$blue) = sscanf($parBadgeColor,"#%02x%02x%02x");
  $tmpBadgeColor = imageColorAllocate($parImg,$red,$green,$blue);

  list($red, $green, $blue) = sscanf($parFontColor, "#%02x%02x%02x");
  $tmpFontcolor = imageColorAllocate($parImg, $red, $green, $blue);

  $opt_Shadow = false;
  if ($opt_Shadow)
     { $tmpOffsetShadow = 10;
       if ($Type == "IN")
          { $values = array(      
            0*$coeff+$tmpOffsetShadow,0*$coeff+$tmpOffsetShadow,
            30*$coeff+$tmpOffsetShadow,20*$coeff+$tmpOffsetShadow,
            0*$coeff+$tmpOffsetShadow,40*$coeff+$tmpOffsetShadow,
            150*$coeff+$tmpOffsetShadow,40*$coeff+$tmpOffsetShadow,
            150*$coeff+$tmpOffsetShadow,0*$coeff+$tmpOffsetShadow);
          }
       else
          { $values = array(      
            30*$coeff+$tmpOffsetShadow,0*$coeff+$tmpOffsetShadow,
            0*$coeff+$tmpOffsetShadow,20*$coeff+$tmpOffsetShadow,
            30*$coeff+$tmpOffsetShadow,40*$coeff+$tmpOffsetShadow,
            150*$coeff+$tmpOffsetShadow,40*$coeff+$tmpOffsetShadow,
            150*$coeff+$tmpOffsetShadow,0*$coeff+$tmpOffsetShadow);
          }
       imagefilledpolygon($parImg,$values,5,$tmpColorDarker);
     }
     
  if ($Type == "IN")
     { $values = array(      
            0*$coeff,0*$coeff,
            30*$coeff,20*$coeff,
            0*$coeff,40*$coeff,
            150*$coeff,40*$coeff,
            150*$coeff,0*$coeff);
     }
  else //"OUT"
     { $values = array(      
            30*$coeff,0*$coeff,
            0*$coeff,20*$coeff,
            30*$coeff,40*$coeff,
            150*$coeff,40*$coeff,
            150*$coeff,0*$coeff);
     }
  imagefilledpolygon($parImg,$values,5,$tmpBadgeColor);
  
  $values = array(      
            150*$coeff,40*$coeff,
            140*$coeff,40*$coeff,
            140*$coeff,50*$coeff);
  imagefilledpolygon($parImg,$values,3,$tmpColorDarker);
  
  $OrigX = 22*$coeff; $OrigY = 0*$coeff;
  $origW = 120*$coeff; $origH = 40*$coeff;
  
  $tmpA_SizeBox = imagettfbbox($parFontSize,0,$parFont,$parText);
  $tmpW = ($tmpA_SizeBox[2]-$tmpA_SizeBox[0]); $tmpH = ($tmpA_SizeBox[3]-$tmpA_SizeBox[5]);

  $tmpNeedUp = wcplb_check_letters($parText);
  $tmpStartX = $OrigX + ($origW-$tmpW)/2;
  $tmpStartY = $OrigY + abs($origH-$tmpH)/2+$tmpH-$tmpNeedUp;
  
  $ret = imagettftext($parImg,$parFontSize,0,$tmpStartX,$tmpStartY,$tmpFontcolor,$parFont,$parText);
}

function wcplb_DrawImg_Arrow($Type,$parImg,$parBadgeColor,$parFont,$parFontSize,$parFontColor,$parText,$parTextDir)
{ $coeff=2;
  $transparent_color = imagecolorallocate($parImg,0xff,0xff,0xff);
  
  $tmpColorDarker = wcplb_DarkenColor($parBadgeColor);
  list($red,$green,$blue) = sscanf($tmpColorDarker,"#%02x%02x%02x");
  $tmpColorDarker = imageColorAllocate($parImg,$red,$green,$blue);

  list($red,$green,$blue) = sscanf($parBadgeColor,"#%02x%02x%02x");
  $tmpBadgeColor = imageColorAllocate($parImg,$red,$green,$blue);

  list($red, $green, $blue) = sscanf($parFontColor, "#%02x%02x%02x");
  $tmpFontcolor = imageColorAllocate($parImg, $red, $green, $blue);

  $tmpOffsetShadow = 10;
  if ($Type == "IN")
     { $values = array(      
            0*$coeff+$tmpOffsetShadow,0*$coeff+$tmpOffsetShadow,
            40*$coeff+$tmpOffsetShadow,0*$coeff+$tmpOffsetShadow,
            40*$coeff+$tmpOffsetShadow,140*$coeff+$tmpOffsetShadow,
            20*$coeff+$tmpOffsetShadow,110*$coeff+$tmpOffsetShadow,
            0*$coeff+$tmpOffsetShadow,140*$coeff+$tmpOffsetShadow);
       $LongW = 90;
     }
  else
     { $values = array(      
            0*$coeff+$tmpOffsetShadow,0*$coeff+$tmpOffsetShadow,
            40*$coeff+$tmpOffsetShadow,0*$coeff+$tmpOffsetShadow,
            40*$coeff+$tmpOffsetShadow,110*$coeff+$tmpOffsetShadow,
            20*$coeff+$tmpOffsetShadow,140*$coeff+$tmpOffsetShadow,
            0*$coeff+$tmpOffsetShadow,110*$coeff+$tmpOffsetShadow);
       $LongW = 120;
     }
  imagefilledpolygon($parImg,$values,5,$tmpColorDarker);
  
  if ($Type == "IN")
     { $values = array(      
            0*$coeff,0*$coeff,
            40*$coeff,0*$coeff,
            40*$coeff,140*$coeff,
            20*$coeff,110*$coeff,
            0*$coeff,140*$coeff);
       $LongW = 120;
     }
  else //"OUT"
     { $values = array(      
            0*$coeff,0*$coeff,
            40*$coeff,0*$coeff,
            40*$coeff,110*$coeff,
            20*$coeff,140*$coeff,
            0*$coeff,110*$coeff);
       $LongW = 120;
     }
  imagefilledpolygon($parImg,$values,5,$tmpBadgeColor);
  
  $tmpA_SizeBox = imagettfbbox($parFontSize,0,$parFont,$parText);
  $tmpDistW = abs($tmpA_SizeBox[2] - $tmpA_SizeBox[0]);
  
  $tmpOffsetFontHeight = ($parFontSize/2);
  
  if ($parTextDir == "BtoT")
     { $OrigX = 43; $OrigY = 50;
       $OrigY += $LongW;
       $OrigX += $tmpOffsetFontHeight;
       $tmpStartX = abs($OrigX);
       $tmpStartY = intval($OrigY - ($LongW-$tmpDistW)/2);
       $ret = imagettftext($parImg,$parFontSize,90,$tmpStartX,$tmpStartY,$tmpFontcolor,$parFont,$parText);
     }
  else
    { $OrigX = 41; $OrigY = 50;
      $OrigX -= $tmpOffsetFontHeight;
      $tmpStartX = abs($OrigX);
      $tmpStartY = intval($OrigY + ($LongW-$tmpDistW)/2);
      $ret = imagettftext($parImg,$parFontSize,270,$tmpStartX,$tmpStartY,$tmpFontcolor,$parFont,$parText);
    }
}

function wcplb_DrawImg_DoubleRibbon($parImg,$parBadgeColor,$parFont,$parFontSize,$parFontColor,$parText)
{ $coeff=2;
  $transparent_color = imagecolorallocate($parImg,0xff,0xff,0xff);
  
  $tmpColorDarker = wcplb_DarkenColor($parBadgeColor,1.4);
  list($red,$green,$blue) = sscanf($tmpColorDarker,"#%02x%02x%02x");
  $tmpColorDarker = imageColorAllocate($parImg,$red,$green,$blue);

  $tmpColorDarkerPlus = wcplb_DarkenColor($parBadgeColor,2);
  list($red,$green,$blue) = sscanf($tmpColorDarkerPlus,"#%02x%02x%02x");
  $tmpColorDarkerPlus = imageColorAllocate($parImg,$red,$green,$blue);
  
  list($red,$green,$blue) = sscanf($parBadgeColor,"#%02x%02x%02x");
  $tmpBadgeColor = imageColorAllocate($parImg,$red,$green,$blue);

  $values = array(      
            0*$coeff,10*$coeff,
            40*$coeff,10*$coeff,
            40*$coeff,50*$coeff,
            0*$coeff,50*$coeff,
            10*$coeff,30*$coeff);
  imagefilledpolygon($parImg,$values,5,$tmpColorDarker);
  $values = array(      
            110*$coeff,10*$coeff,
            150*$coeff,10*$coeff,
            140*$coeff,30*$coeff,
            150*$coeff,50*$coeff,
            110*$coeff,50*$coeff);
  imagefilledpolygon($parImg,$values,5,$tmpColorDarker);

  $values = array(      
            20*$coeff,0*$coeff,
            130*$coeff,0*$coeff,
            130*$coeff,40*$coeff,
            20*$coeff,40*$coeff);
  imagefilledpolygon($parImg,$values,4,$tmpBadgeColor);
  
  $values = array(      
            20*$coeff,40*$coeff,
            40*$coeff,40*$coeff,
            40*$coeff,50*$coeff);
  imagefilledpolygon($parImg,$values,3,$tmpColorDarkerPlus); 
  $values = array(      
            110*$coeff,40*$coeff,
            130*$coeff,40*$coeff,
            110*$coeff,50*$coeff);
  imagefilledpolygon($parImg,$values,3,$tmpColorDarkerPlus);
  
  $OrigX = 15*$coeff; $OrigY = 0*$coeff;
  $origW = 120*$coeff; $origH = 40*$coeff;
  
  $tmpA_SizeBox = imagettfbbox($parFontSize,0,$parFont,$parText);
  $tmpW = ($tmpA_SizeBox[2]-$tmpA_SizeBox[0]); $tmpH = ($tmpA_SizeBox[3]-$tmpA_SizeBox[5]);

  $tmpNeedUp = wcplb_check_letters($parText);
  $tmpStartX = $OrigX + ($origW-$tmpW)/2;
  $tmpStartY = $OrigY + abs($origH-$tmpH)/2+$tmpH-$tmpNeedUp;
  
  $ret = imagettftext($parImg,$parFontSize,0,$tmpStartX,$tmpStartY,$tmpFontcolor,$parFont,$parText);
}

function wcplb_DrawImg_Star8($parImg,$parBadgeColor)
{ $coeff=2;

  list($red,$green,$blue) = sscanf($parBadgeColor,"#%02x%02x%02x");
  $tmpBadgeColor = imageColorAllocate($parImg,$red,$green,$blue);

  $tmpColorDarker = wcplb_DarkenColor($parBadgeColor,1.4);
  list($red,$green,$blue) = sscanf($tmpColorDarker,"#%02x%02x%02x");
  $tmpColorDarker = imageColorAllocate($parImg,$red,$green,$blue);
  
  $parRadius=100;
  $x = $parRadius;
  $y = $parRadius;
  $sides = 8;
  $spike = 0.8;
 
  $point =array();
  $t = 0;
  for($a = 0;$a <= 360;$a += 360/($sides*2))
     { $t++;
       if ($t % 2 == 0)
          { $values[] = intval($x + ($parRadius * $spike) * cos(deg2rad($a)));
            $values[] = intval($y + ($parRadius * $spike) * sin(deg2rad($a)));
          }
       else
          { $values[] = intval($x + $parRadius * cos(deg2rad($a)));
            $values[] = intval($y + $parRadius * sin(deg2rad($a)));
          }
     }
  imagefilledpolygon($parImg,$values,($sides*2)+1,$tmpColorDarker);
   
  $point =array();
  $t = 0;
  for($a = 22;$a <= 382;$a += 360/($sides*2))
     { $t++;
       if ($t % 2 == 0)
          { $valuesR[] = intval($x + ($parRadius * $spike) * cos(deg2rad($a)));
            $valuesR[] = intval($y + ($parRadius * $spike) * sin(deg2rad($a)));
          }
       else
          { $valuesR[] = intval($x + $parRadius * cos(deg2rad($a)));
            $valuesR[] = intval($y + $parRadius * sin(deg2rad($a)));
          }
     }
  imagefilledpolygon($parImg,$valuesR,($sides*2)+1,$tmpBadgeColor); 
}

function wcplb_DrawImg_Star($parImg,$parBadgeColor,$parRadius,$parSide,$parSpike)
{ $coeff=2;

  list($red,$green,$blue) = sscanf($parBadgeColor,"#%02x%02x%02x");
  $tmpBadgeColor = imageColorAllocate($parImg,$red,$green,$blue);

  $x = $parRadius;
  $y = $parRadius;

  $point =array();
  $t = 0;
  for($a = 0;$a <= 360;$a += 360/($parSide*2))
     { $t++;
       if ($t % 2 == 0)
          { $values[] = intval($x + ($parRadius * $parSpike) * cos(deg2rad($a)));
            $values[] = intval($y + ($parRadius * $parSpike) * sin(deg2rad($a)));
          }
       else
          { $values[] = intval($x + $parRadius * cos(deg2rad($a)));
            $values[] = intval($y + $parRadius * sin(deg2rad($a)));
          }
     }
  imagefilledpolygon($parImg,$values,($parSide*2)+1,$tmpBadgeColor); 
}

function wcplb_DrawImg_Medal36($parImg,$parBadgeColor,$parPatternColor,$parFont,$parFontSize,$parFontColor,$parText)
{ $coeff=2;

  list($red,$green,$blue) = sscanf($parBadgeColor,"#%02x%02x%02x");
  $tmpBadgeColor = imageColorAllocate($parImg,$red,$green,$blue);

  $tmpColorDarker = wcplb_DarkenColor($parBadgeColor,1.4);
  list($red,$green,$blue) = sscanf($tmpColorDarker,"#%02x%02x%02x");
  $tmpColorDarker = imageColorAllocate($parImg,$red,$green,$blue);
    
  list($red, $green, $blue) = sscanf($parPatternColor, "#%02x%02x%02x");
  $tmpPatterncolor = imageColorAllocate($parImg, $red, $green, $blue);
  
  list($red, $green, $blue) = sscanf($parFontColor, "#%02x%02x%02x");
  $tmpFontcolor = imageColorAllocate($parImg, $red, $green, $blue);
    
  $valuesR = array(      
            30*$coeff,80*$coeff,
            70*$coeff,80*$coeff,
            70*$coeff,150*$coeff,
            50*$coeff,130*$coeff,
            30*$coeff,150*$coeff);
  imagefilledpolygon($parImg,$valuesR,5,$tmpColorDarker);
  
  imageline($parImg,34*$coeff,80*$coeff,34*$coeff,145*$coeff,$tmpBadgeColor);
  imageline($parImg,35*$coeff,80*$coeff,35*$coeff,144*$coeff,$tmpBadgeColor);
  imageline($parImg,36*$coeff,80*$coeff,36*$coeff,143*$coeff,$tmpBadgeColor);
  
  imageline($parImg,64*$coeff,80*$coeff,64*$coeff,143*$coeff,$tmpBadgeColor);
  imageline($parImg,65*$coeff,80*$coeff,65*$coeff,144*$coeff,$tmpBadgeColor);
  imageline($parImg,66*$coeff,80*$coeff,66*$coeff,145*$coeff,$tmpBadgeColor);
  
  $x = 100;
  $y = 100;
  $radius = 100;
  $sides = 36;
  $spike = 0.9;
  
  $point =array();
  $t = 0;
  for($a = 0;$a <= 360;$a += 360/($sides*2))
     { $t++;
       if ($t % 2 == 0)
          { $values[] = intval($x + ($radius * $spike) * cos(deg2rad($a)));
            $values[] = intval($y + ($radius * $spike) * sin(deg2rad($a)));
          }
       else
          { $values[] = intval($x + $radius * cos(deg2rad($a)));
            $values[] = intval($y + $radius * sin(deg2rad($a)));
          }
     }
  imagefilledpolygon($parImg,$values,($sides*2)+1,$tmpBadgeColor);
   
  for ($i=110;$i<120;$i++)
      imageellipse($parImg,$x,$y,$i,$i,$tmpPatterncolor);
  for ($i=130;$i<150;$i++)
      imageellipse($parImg,$x,$y,$i,$i,$tmpPatterncolor);
      
  $OrigX = 0*$coeff; $OrigY = 0*$coeff;
  $origW = 100*$coeff; $origH = 100*$coeff;
  
  $tmpA_SizeBox = imagettfbbox($parFontSize,0,$parFont,$parText);
  $tmpW = ($tmpA_SizeBox[2]-$tmpA_SizeBox[0]); $tmpH = ($tmpA_SizeBox[3]-$tmpA_SizeBox[5]);

  $tmpNeedUp = wcplb_check_letters($parText);
  $tmpStartX = $OrigX + ($origW-$tmpW)/2;
  $tmpStartY = $OrigY + abs($origH-$tmpH)/2+$tmpH-$tmpNeedUp;
  
  $ret = imagettftext($parImg,$parFontSize,0,$tmpStartX,$tmpStartY,$tmpFontcolor,$parFont,$parText);
}

function wcplb_DrawImg_Flower($parImg,$parBadgeColor,$parPatternColor,$parFont,$parFontSize,$parFontColor,$parText)
{ $coeff=2;
  
  list($red,$green,$blue) = sscanf($parBadgeColor,"#%02x%02x%02x");
  $tmpBadgeColor = imageColorAllocate($parImg,$red,$green,$blue);
  
  $tmpColorDarker = wcplb_DarkenColor($parBadgeColor,1.4);
  list($red,$green,$blue) = sscanf($tmpColorDarker,"#%02x%02x%02x");
  $tmpColorDarker = imageColorAllocate($parImg,$red,$green,$blue);

  $tmpColorDarkerPlus = wcplb_DarkenColor($parBadgeColor,2);
  list($red,$green,$blue) = sscanf($tmpColorDarkerPlus,"#%02x%02x%02x");
  $tmpColorDarkerPlus = imageColorAllocate($parImg,$red,$green,$blue);
  
  list($red, $green, $blue) = sscanf($parPatternColor, "#%02x%02x%02x");
  $tmpPatterncolor = imageColorAllocate($parImg, $red, $green, $blue);

  list($red, $green, $blue) = sscanf($parFontColor, "#%02x%02x%02x");
  $tmpFontcolor = imageColorAllocate($parImg, $red, $green, $blue);
  
  $tmpShift = 10;
  $valuesR = array(      
            40*$coeff,75*$coeff,
            65*$coeff,80*$coeff,
            80*$coeff,140*$coeff,
            64*$coeff,127*$coeff,
            55*$coeff,146*$coeff);
  imagefilledpolygon($parImg,$valuesR,5,$tmpColorDarkerPlus);
  
  $valuesR = array(      
            25*$coeff,80*$coeff,
            50*$coeff,85*$coeff,
            39*$coeff,122*$coeff,
            31*$coeff,104*$coeff,
            15*$coeff,115*$coeff);
  imagefilledpolygon($parImg,$valuesR,5,$tmpColorDarker);
      
  $rayon=40;
  $x =2*$rayon + $tmpShift;
  $y =2*$rayon + $tmpShift;
  $radius = 100;
  $sides = 16;
  $spike = 0.80;
        
  $point = array();
  $t = 0;
  for($a = 0;$a <= 360;$a += 360/($sides*2))
     { $t++;
       if ($t % 2 == 0)
          { $values[] = intval($x + ($radius * $spike) * cos(deg2rad($a)));
            $values[] = intval($y + ($radius * $spike) * sin(deg2rad($a)));
            imagefilledellipse($parImg,intval($x + ($radius * $spike) * cos(deg2rad($a))),intval($y + ($radius * $spike) * sin(deg2rad($a))),25,25,$tmpBadgeColor);
          }
       else
          { $values[] = intval($x + $radius * cos(deg2rad($a)));
            $values[] = intval($y + $radius * sin(deg2rad($a)));
          }
     }
  imagefilledellipse($parImg,$rayon*$coeff + $tmpShift,$rayon*$coeff + $tmpShift,2*$rayon*$coeff,2*$rayon*$coeff,$tmpBadgeColor);  

  $radius = 80;
  $sides = 32;
  $t = 0;
  for($a = 0;$a <= 360;$a += 360/($sides*2))
     { $t++;
       if ($t % 2 == 0)
          { $values[] = intval($x + ($radius * $spike) * cos(deg2rad($a)));
            $values[] = intval($y + ($radius * $spike) * sin(deg2rad($a)));
            imagefilledellipse($parImg,intval($x + ($radius * $spike) * cos(deg2rad($a))),intval($y + ($radius * $spike) * sin(deg2rad($a))),10,10,$tmpPatterncolor);
          }
       else
          { $values[] = intval($x + $radius * cos(deg2rad($a)));
            $values[] = intval($y + $radius * sin(deg2rad($a)));
          }
     }
  
  $OrigX = -5*$coeff; $OrigY = -5*$coeff;
  $origW = 100*$coeff; $origH = 100*$coeff;
  
  $tmpA_SizeBox = imagettfbbox($parFontSize,0,$parFont,$parText);
  $tmpW = ($tmpA_SizeBox[2]-$tmpA_SizeBox[0]); $tmpH = ($tmpA_SizeBox[3]-$tmpA_SizeBox[5]);

  $tmpNeedUp = wcplb_check_letters($parText);
  $tmpStartX = $OrigX + ($origW-$tmpW)/2;
  $tmpStartY = $OrigY + abs($origH-$tmpH)/2+$tmpH-$tmpNeedUp;
  
  $ret = imagettftext($parImg,$parFontSize,0,$tmpStartX,$tmpStartY,$tmpFontcolor,$parFont,$parText);
}

function wcplb_DrawImg_Victory($parImg,$parBadgeColor,$parPatternColor,$parFont,$parFontSize,$parFontColor,$parText)
{ $coeff=2;

  list($red,$green,$blue) = sscanf($parBadgeColor,"#%02x%02x%02x");
  $tmpBadgeColor = imageColorAllocate($parImg,$red,$green,$blue);

  $tmpColorDarker = wcplb_DarkenColor($parBadgeColor,1.4);
  list($red,$green,$blue) = sscanf($tmpColorDarker,"#%02x%02x%02x");
  $tmpColorDarker = imageColorAllocate($parImg,$red,$green,$blue);

  $tmpColorDarkerPlus = wcplb_DarkenColor($parBadgeColor,2);
  list($red,$green,$blue) = sscanf($tmpColorDarkerPlus,"#%02x%02x%02x");
  $tmpColorDarkerPlus = imageColorAllocate($parImg,$red,$green,$blue);
      
  list($red, $green, $blue) = sscanf($parPatternColor, "#%02x%02x%02x");
  $tmpPatterncolor = imageColorAllocate($parImg, $red, $green, $blue);
  
  list($red, $green, $blue) = sscanf($parFontColor, "#%02x%02x%02x");
  $tmpFontcolor = imageColorAllocate($parImg, $red, $green, $blue);
  
  //--- Draw the 2 ribbons polygon:
  $values = array(      
            10*$coeff,0*$coeff,
            40*$coeff,0*$coeff,
            70*$coeff,60*$coeff,
            40*$coeff,60*$coeff);
  imagefilledpolygon($parImg,$values,4,$tmpColorDarkerPlus);
 
  $values = array(      
            80*$coeff,0*$coeff,
            110*$coeff,0*$coeff,
            80*$coeff,60*$coeff,
            50*$coeff,60*$coeff);
  imagefilledpolygon($parImg,$values,4,$tmpColorDarker);
  
  $x = (50+10)*$coeff;
  $y = 100*$coeff;
  $radius = 100*$coeff;
  imagefilledellipse($parImg,$x,$y,$radius,$radius,$tmpBadgeColor);
  
  for ($i=130;$i<150;$i++)
      imageellipse($parImg,$x,$y,$i,$i,$tmpPatterncolor);
      
  $OrigX = 10*$coeff; $OrigY = 50*$coeff;
  $origW = 100*$coeff; $origH = 100*$coeff;
  
  $tmpA_SizeBox = imagettfbbox($parFontSize,0,$parFont,$parText);
  $tmpW = ($tmpA_SizeBox[2]-$tmpA_SizeBox[0]); $tmpH = ($tmpA_SizeBox[3]-$tmpA_SizeBox[5]);

  $tmpNeedUp = wcplb_check_letters($parText);
  $tmpStartX = $OrigX + ($origW-$tmpW)/2;
  $tmpStartY = $OrigY + abs($origH-$tmpH)/2+$tmpH-$tmpNeedUp;
  
  $ret = imagettftext($parImg,$parFontSize,0,$tmpStartX,$tmpStartY,$tmpFontcolor,$parFont,$parText);
}

function wcplb_DrawImg_Square($parImg,$parBadgeColor,$parPatternColor,$parFont,$parFontSize,$parFontColor,$parText)
{ $coeff=2;

  list($red,$green,$blue) = sscanf($parBadgeColor,"#%02x%02x%02x");
  $tmpBadgeColor = imageColorAllocate($parImg,$red,$green,$blue);

  $tmpColorDarker = wcplb_DarkenColor($parBadgeColor,1.4);
  list($red,$green,$blue) = sscanf($tmpColorDarker,"#%02x%02x%02x");
  $tmpColorDarker = imageColorAllocate($parImg,$red,$green,$blue);
    
  list($red, $green, $blue) = sscanf($parPatternColor, "#%02x%02x%02x");
  $tmpPatterncolor = imageColorAllocate($parImg, $red, $green, $blue);
  
  list($red, $green, $blue) = sscanf($parFontColor, "#%02x%02x%02x");
  $tmpFontcolor = imageColorAllocate($parImg, $red, $green, $blue);
  
  $valuesR = array(      
            30*$coeff,80*$coeff,
            70*$coeff,80*$coeff,
            70*$coeff,130*$coeff,
            50*$coeff,150*$coeff,
            30*$coeff,130*$coeff);
  imagefilledpolygon($parImg,$valuesR,5,$tmpColorDarker);
  
  imageline($parImg,34*$coeff,80*$coeff,34*$coeff,133*$coeff,$tmpBadgeColor);
  imageline($parImg,35*$coeff,80*$coeff,35*$coeff,134*$coeff,$tmpBadgeColor);
  imageline($parImg,36*$coeff,80*$coeff,36*$coeff,135*$coeff,$tmpBadgeColor);
  
  imageline($parImg,64*$coeff,80*$coeff,64*$coeff,135*$coeff,$tmpBadgeColor);
  imageline($parImg,65*$coeff,80*$coeff,65*$coeff,134*$coeff,$tmpBadgeColor);
  imageline($parImg,66*$coeff,80*$coeff,66*$coeff,133*$coeff,$tmpBadgeColor);
  
  $x = 100;
  $y = 100;
  $radius = 100;
  $sides = 4;
  $spike = 0.6;
  
  $point =array();
  $t = 0;
  for($a = 0;$a <= 360;$a += 360/($sides*2))
     { $t++;
       if ($t % 2 == 0)
          { $values[] = intval($x + ($radius * $spike) * cos(deg2rad($a)));
            $values[] = intval($y + ($radius * $spike) * sin(deg2rad($a)));
          }
       else
          { $values[] = intval($x + $radius * cos(deg2rad($a)));
            $values[] = intval($y + $radius * sin(deg2rad($a)));
          }
     }
  imagefilledpolygon($parImg,$values,($sides*2)+1,$tmpBadgeColor);
   
  for ($i=120;$i<130;$i++)
      imageellipse($parImg,$x,$y,$i,$i,$tmpPatterncolor);
  for ($i=140;$i<160;$i++)
      imageellipse($parImg,$x,$y,$i,$i,$tmpPatterncolor);
      
  $OrigX = 0*$coeff; $OrigY = 0*$coeff;
  $origW = 100*$coeff; $origH = 100*$coeff;
  
  $tmpA_SizeBox = imagettfbbox($parFontSize,0,$parFont,$parText);
  $tmpW = ($tmpA_SizeBox[2]-$tmpA_SizeBox[0]); $tmpH = ($tmpA_SizeBox[3]-$tmpA_SizeBox[5]);

  $tmpNeedUp = wcplb_check_letters($parText);
  $tmpStartX = $OrigX + ($origW-$tmpW)/2;
  $tmpStartY = $OrigY + abs($origH-$tmpH)/2+$tmpH-$tmpNeedUp;
  
  $ret = imagettftext($parImg,$parFontSize,0,$tmpStartX,$tmpStartY,$tmpFontcolor,$parFont,$parText);
}

?>