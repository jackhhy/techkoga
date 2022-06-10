# Install  
``
 composer require techkoga/tool
``
 
# GoogleTool::CreateGoogleSecretQrcode 
Generate Google key and Google QR code

Usage example： 
   ```php
use techkoga\Tools\GoogleTool;  

$username = 'xxxxxx';   

list($Secret,$qrCodeUrl) = GoogleTool::CreateGoogleSecretQrcode($username);
```

# GoogleTool::CheckGoogleSecret 
Verify google captcha with secret key

Usage example： 
 
```php
use techkoga\Tools\GoogleTool;  


$VerifyCode = '369785';   
$GoogleSecret='xxxxxxxx';
$result= GoogleTool::CheckGoogleSecret($VerifyCode,$GoogleSecret);
if($result){
  echo 'success';
}

```
