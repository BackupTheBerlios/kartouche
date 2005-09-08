<?

				$im = imagecreate(200,10);
                $bg_col = imagecolorallocate ($im, 255, 204, 255);
                $border = imagecolorallocate ($im, 153, 0, 51);
                $bar = imagecolorallocate ($im,204,153,255);
                imagefilledrectangle ($im, 0, 0, 2*$trans, 10, $bar);
                imagerectangle ($im, 0, 0, 199, 9, $border);
                imagepng($im);
                imagedestroy($im);

?>