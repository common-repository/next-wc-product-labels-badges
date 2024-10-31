<?php
  if ($opt_BadgeType == "TextBoxBadge")
     { $Width = 150; $Height = 150;
     }
  else
     { switch (${'opt_BadgeName_'.$section})
              { case "Ribbon":
                     $Width = 120; $Height = 120;
                     break;

                case "LeftBannerOut":
                     $Width = 150; $Height = 50;
                     break;
                case "LeftBannerIn":
                     $Width = 150; $Height = 50;
                     break;
                case "RightBannerOut":
                     $Width = 150; $Height = 50;
                     break;
                case "RightBannerIn":
                     $Width = 150; $Height = 50;
                     break;
                     
                case "DoubleRibbon":
                     $Width = 150; $Height = 50;
                     break;
                                          
                case "Stamp":
                     $Width = 150; $Height = 110;
                     break;
        
                case "Medal36":
                     $Width = 100; $Height = 150;
                     break;
        
                case "Flower":
                     $Width = 100; $Height = 150;
                     break;
        
                case "Square":
                     $Width = 100; $Height = 150;
                     break;
        
                case "Victory":
                     $Width = 110; $Height = 150;
                     break;

                case "ArrowOut":
                     $Width = 50; $Height = 150;
                     break;
                     
                case "ArrowIn":
                     $Width = 50; $Height = 150;
                     break;
                     
                default:
                     $Width = 120; $Height = 120;
                     break;
              }
     }

  $coeff = 2;
$very_light_white = imageColorAllocate($image, 0xF0, 0xF0, 0xF0);
$gray = imagecolorallocate($image, 56, 56, 56);
$plume_gray = imagecolorallocate($image, 192, 192, 192);
$light_gray = imagecolorallocate($image, 128, 128, 128);
$darkgray = imagecolorallocate($image, 0x90, 0x90, 0x90);
$black = imagecolorallocate($image, 0x00, 0x00, 0x00);
$pink = imageColorAllocate($image, 255, 105, 180);
$cyan = imagecolorallocate($image, 0, 255, 255);
$yellow = imagecolorallocate($image, 255, 255, 0);
$navy     = imagecolorallocate($image, 0x00, 0x00, 0x80);
$darknavy = imagecolorallocate($image, 0x00, 0x00, 0x50);
$red      = imagecolorallocate($image, 0xFF, 0x00, 0x00);
$darkred  = imagecolorallocate($image, 0x90, 0x00, 0x00);


if ($section === "cat")
   { $orderby = 'name';
     $order = 'asc';
     $hide_empty = false ;
     $cat_args = array(
            'orderby'    => $orderby,
            'order'      => $order,
            'hide_empty' => $hide_empty);
     $product_categories = get_terms( 'product_cat', $cat_args );
     
     $cat=0;
     foreach ($product_categories as $key => $category)
             { $cat++;
               $tmpCatSlug = $category->slug;
               $tmpCatSlug = str_replace('-','_',$tmpCatSlug);
               $A_catSlug[$cat] = $tmpCatSlug;
             }
   }
else 
   $NbCat = 1;
                 
for ($i=1;$i<=$NbCat;$i++)
    { $image = imagecreatetruecolor($Width*$coeff, $Height*$coeff);
      $imageProduct = imagecreatetruecolor($Width, $Height);
      $imageShop = imagecreatetruecolor($Width/2, $Height/2);
  
      $white = imagecolorallocate($image, 0xff, 0xff, 0xff); 
      $transparent_color = $white; //$black;
      imagefill($image,0,0,$transparent_color);
imagefill($imageProduct,0,0,$transparent_color);
imagefill($imageShop,0,0,$transparent_color);
      imagecolortransparent($image,$transparent_color);
      imagecolortransparent($imageProduct,$transparent_color);
      imagecolortransparent($imageShop,$transparent_color);

      $tmpCatSlug = "";
      if ($section === "cat") $tmpCatSlug = "_" . str_replace('-','_',$A_catSlug[$i]);
      
      if ($opt_BadgeType == "TextBoxBadge")
         { wcplb_DrawImg_TextBox($image,0,0,$Width,$Height,10,${'opt_BadgeColor_'.$section . $tmpCatSlug});
         }
      else
         { switch (${'opt_BadgeName_'.$section})
            { case "Ribbon":
                   wcplb_DrawImg_Ribbon($image,${'opt_BadgeColor_'.$section . $tmpCatSlug},$PathFont . ${'opt_BadgeFontImage_'.$section},${'opt_BadgeFontSize_'.$section},${'opt_BadgeFontColor_'.$section},${'opt_BadgeText_'.$section . $tmpCatSlug});
                   break;
              
              case "DoubleRibbon":
                   wcplb_DrawImg_DoubleRibbon($image,${'opt_BadgeColor_'.$section . $tmpCatSlug},$PathFont . ${'opt_BadgeFontImage_'.$section},${'opt_BadgeFontSize_'.$section},${'opt_BadgeFontColor_'.$section},${'opt_BadgeText_'.$section . $tmpCatSlug});
                   break;
                   
              case "LeftBannerOut":
                   wcplb_DrawImg_LeftBanner("OUT",$image,${'opt_BadgeColor_'.$section . $tmpCatSlug},$PathFont . ${'opt_BadgeFontImage_'.$section},${'opt_BadgeFontSize_'.$section},${'opt_BadgeFontColor_'.$section},${'opt_BadgeText_'.$section . $tmpCatSlug});
                   break;
              case "LeftBannerIn":
                   wcplb_DrawImg_LeftBanner("IN",$image,${'opt_BadgeColor_'.$section . $tmpCatSlug},$PathFont . ${'opt_BadgeFontImage_'.$section},${'opt_BadgeFontSize_'.$section},${'opt_BadgeFontColor_'.$section},${'opt_BadgeText_'.$section . $tmpCatSlug});
                   break;
              case "RightBannerOut":
                   wcplb_DrawImg_RightBanner("OUT",$image,${'opt_BadgeColor_'.$section . $tmpCatSlug},$PathFont . ${'opt_BadgeFontImage_'.$section},${'opt_BadgeFontSize_'.$section},${'opt_BadgeFontColor_'.$section},${'opt_BadgeText_'.$section . $tmpCatSlug});
                   break;
              case "RightBannerIn":
                   wcplb_DrawImg_RightBanner("IN",$image,${'opt_BadgeColor_'.$section . $tmpCatSlug},$PathFont . ${'opt_BadgeFontImage_'.$section},${'opt_BadgeFontSize_'.$section},${'opt_BadgeFontColor_'.$section},${'opt_BadgeText_'.$section . $tmpCatSlug});
                   break;
                                     
              case "Stamp":
                   wcplb_DrawImg_Stamp($image,${'opt_BadgeColor_'.$section . $tmpCatSlug},$PathFont . ${'opt_BadgeFontImage_'.$section},${'opt_BadgeFontSize_'.$section},${'opt_BadgeFontColor_'.$section},${'opt_BadgeText_'.$section . $tmpCatSlug});
                   break;
                     
              case "Medal36":
                   wcplb_DrawImg_Medal36($image,${'opt_BadgeColor_'.$section . $tmpCatSlug},${'opt_BadgePatternColor_'.$section},$PathFont . ${'opt_BadgeFontImage_'.$section},${'opt_BadgeFontSize_'.$section},${'opt_BadgeFontColor_'.$section},${'opt_BadgeText_'.$section . $tmpCatSlug});
                   break;
                     
              case "Flower":
                   wcplb_DrawImg_Flower($image,${'opt_BadgeColor_'.$section . $tmpCatSlug},${'opt_BadgePatternColor_'.$section},$PathFont . ${'opt_BadgeFontImage_'.$section},${'opt_BadgeFontSize_'.$section},${'opt_BadgeFontColor_'.$section},${'opt_BadgeText_'.$section . $tmpCatSlug});
                   break;
                     
              case "Square":
                   wcplb_DrawImg_Square($image,${'opt_BadgeColor_'.$section . $tmpCatSlug},${'opt_BadgePatternColor_'.$section},$PathFont . ${'opt_BadgeFontImage_'.$section},${'opt_BadgeFontSize_'.$section},${'opt_BadgeFontColor_'.$section},${'opt_BadgeText_'.$section . $tmpCatSlug});
                   break;
                     
              case "Victory":
                   wcplb_DrawImg_Victory($image,${'opt_BadgeColor_'.$section . $tmpCatSlug},${'opt_BadgePatternColor_'.$section},$PathFont . ${'opt_BadgeFontImage_'.$section},${'opt_BadgeFontSize_'.$section},${'opt_BadgeFontColor_'.$section},${'opt_BadgeText_'.$section . $tmpCatSlug});
                   break;

              case "ArrowOut":
                   wcplb_DrawImg_Arrow("OUT",$image,${'opt_BadgeColor_'.$section . $tmpCatSlug},$PathFont . ${'opt_BadgeFontImage_'.$section},${'opt_BadgeFontSize_'.$section},${'opt_BadgeFontColor_'.$section},${'opt_BadgeText_'.$section . $tmpCatSlug},${'opt_BadgeTextDir_'.$section});
                   break;

              case "ArrowIn":
                   wcplb_DrawImg_Arrow("IN",$image,${'opt_BadgeColor_'.$section . $tmpCatSlug},$PathFont . ${'opt_BadgeFontImage_'.$section},${'opt_BadgeFontSize_'.$section},${'opt_BadgeFontColor_'.$section},${'opt_BadgeText_'.$section . $tmpCatSlug},${'opt_BadgeTextDir_'.$section});
                   break;
                     
              default:
              break;
            }
         }
    
      imagecopyresampled($imageProduct,$image,0,0,0,0,$Width,$Height,$Width*$coeff,$Height*$coeff);
      imagecopyresampled($imageShop,$image,0,0,0,0,$Width/2,$Height/2,$Width*$coeff,$Height*$coeff);

      ob_start();
      imagepng($imageProduct);
      $imgP = ob_get_clean();
      echo "<img src='data:image/gif;base64," . base64_encode($imgP) . "'>";     
      if ($opt_BadgeType == "ImageBadge")
         { $pngProductName = "BadgeProduct_" . $section .  $tmpCatSlug . ".png";
           file_put_contents($tmpStrPathDynamic . "/" . $pngProductName,$imgP);
         }
         
      ob_start();
      imagepng($imageShop);
      $imgS = ob_get_clean();
      if ($opt_BadgeType == "ImageBadge")
         { $pngShopName = "BadgeShop_" . $section . $tmpCatSlug . ".png";
           file_put_contents($tmpStrPathDynamic . "/" . $pngShopName,$imgS); 
         }
         
      imagedestroy($image);
      imagedestroy($imageProduct);
      imagedestroy($imageShop); 
    }
?>
