<?php
/**
 *                    _ooOoo_
 *                   o8888888o
 *                   88" . "88
 *                   (| -_- |)
 *                    O\ = /O
 *                ____/`---'\____
 *              .   ' \\| |// `.
 *               / \\||| : |||// \
 *             / _||||| -:- |||||- \
 *               | | \\\ - /// | |
 *             | \_| ''\---/'' | |
 *              \ .-\__ `-` ___/-. /
 *           ___`. .' /--.--\ `. . __
 *        ."" '< `.___\_<|>_/___.' >'"".
 *       | | : `- \`.;`\ _ /`;.`/ - ` : | |
 *         \ \ `-. \_ __\ /__ _/ .-` / /
 * ======`-.____`-.___\_____/___.-`____.-'======
 *                    `=---='
 *
 * .............................................
 *          佛祖保佑             永无BUG
 */

namespace techkoga\Tools;

use techkoga\Tools\Authenticator\GoogleAuthenticator;

class GoogleTool
{
    /**
     * @param $username  [username]
     * @param int $secretLength  [16 characters, randomly chosen from the allowed base32 characters]
     * @return array
     * @throws Exception\GoogleException
     * @describe Generate secret key and QR code
     */
    public static function CreateGoogleSecretQrcode($username,$secretLength=16){
        $Google=self::GetAuthenticator();
        $Secret=$Google->createSecret($secretLength);
        $qrCodeUrl = $Google->getQRCodeGoogleUrl($username, $Secret);
        return [$Secret,$qrCodeUrl];
    }


    /**
     * @param $VerifyCode   [Google verification code]
     * @param $GoogleSecret [This is the Google key]
     * @param int $discrepancy [This is the allowed time drift in 30 second units (8 means 4 minutes before or after)]
     * @return bool
     * @describe verify google captcha
     */
    public static function CheckGoogleSecret($VerifyCode,$GoogleSecret,$discrepancy=4){
        $Google=self::GetAuthenticator();
        $checkResult = $Google->verifyCode($GoogleSecret, $VerifyCode, $discrepancy);
        if (!$checkResult){
            return false;
        }
        return true;
    }

    /**
     * @return GoogleAuthenticator
     * @describe
     */
    protected static function GetAuthenticator(){
        return new GoogleAuthenticator();
    }

}