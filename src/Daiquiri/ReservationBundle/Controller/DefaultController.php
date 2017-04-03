<?php

namespace Daiquiri\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Symfony\Component\Form\FormBuilder;
use \Symfony\Component\HttpFoundation\Response;
use \Doctrine\Common\Collections\Collection;
use \Doctrine\ORM\EntityRepository;

/**
 * Car controller.
 *
 */
class DefaultController extends Controller {

    public function searcherAction() {
        $this->render('DaiquiriReservationBundle:Default:searcher.html.twig');
    }
    public function getImageCaptchaAction() {
        // Set some important CAPTCHA constants 
        define('CAPTCHA_NUMCHARS', 6);  // number of characters in pass-phrase 
        define('CAPTCHA_WIDTH', 180);   // width of image 
        define('CAPTCHA_HEIGHT', 30);   // height of image 
        // Generate the random pass-phrase 
        $pass_phrase = "";
        for ($i = 0; $i < CAPTCHA_NUMCHARS; $i++) {
            $pass_phrase .= chr(rand(97, 122));
        }
        // Store the encrypted pass-phrase in a session variable 
        $this->getRequest()->getSession()->set('captcha', sha1($pass_phrase));
        // Create the image 
        $img = imagecreatetruecolor(CAPTCHA_WIDTH, CAPTCHA_HEIGHT);

        // Set a white background with black text and gray graphics 
        $bg_color = imagecolorallocate($img, 255, 255, 255);     // white 
        $text_color = imagecolorallocate($img, 227, 173, 17);         // yellow 
        $graphic_color = imagecolorallocate($img, 227, 173, 17);   // yellow 
        $point_color = imagecolorallocate($img, 54, 58, 245);   // blue 
        // Fill the background 
        imagefilledrectangle($img, 0, 0, CAPTCHA_WIDTH, CAPTCHA_HEIGHT, $bg_color);
        // Draw some random lines 
        for ($i = 0; $i < 5; $i++) {
            imageline($img, 0, rand() % CAPTCHA_HEIGHT, CAPTCHA_WIDTH, rand() % CAPTCHA_HEIGHT, $graphic_color);
        }

        // Sprinkle in some random dots 

        for ($i = 0; $i < 300; $i++) {
            imagesetpixel($img, rand() % CAPTCHA_WIDTH, rand() % CAPTCHA_HEIGHT, $point_color);
        }
        // Draw the pass-phrase string 
        imagettftext($img, 30, 0, 5, CAPTCHA_HEIGHT - 5, $text_color, 'bundles/daiquiriadmin/images/captcha/calibri.ttf', $pass_phrase);

        // Output the image as a PNG using a header 

        $response = new Response();
        $response->headers->set('Content-type', 'image/png');
        $response->headers->set('Content-Disposition', 'inline; filename="image.png"');

        ob_start();
        imagepng($img);
        $str = ob_get_clean();
        $response->setContent($str);
        imagedestroy($img);
        return $response;
    }

}
