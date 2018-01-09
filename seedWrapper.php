<?php
/**
* @author Oliver Blum <blumanski@protonmail.com>
* @desc very simple iota seed generator with encryption and decryption
* using a password of choice.
*
* You can run this on your local webserver.
* Why, for what ever reason, someone may like to backup or send a seed via email.
*
* THIS SOFTWARE IS PROVIDED "AS IS" AND ANY EXPRESSED OR IMPLIED WARRANTIES,
* INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
* AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL
* THE REGENTS OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
* SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
* PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS;
* OR BUSINESS INTERRUPTION)
* HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT,
* STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
* ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY
* OF SUCH DAMAGE.
*/

// ini_set('display_erros', true);
// error_reporting(E_ALL);

require_once ('./vendor/autoload.php');

class seedWrapper
{
  private $cipher = 'aes-256-ctr';

  public function encryptSeed(string $seed, string $pwd) :string
  {
    if (in_array($this->cipher, openssl_get_cipher_methods())){
        $iv = substr(hash('sha256', $pwd), 0, 16);
        return openssl_encrypt($seed, $this->cipher, $pwd, $options=0, $iv);

    } else {

      die('Don\'t have '.$this->cipher);
    }
  }

  public function decryptSeed(string $encrypted, string $pwd) :string
  {
    if (in_array($this->cipher, openssl_get_cipher_methods())){
        $iv = substr(hash('sha256', $pwd), 0, 16);
        return openssl_decrypt($encrypted, $this->cipher, $pwd, $options=0, $iv);
    } else {
      die('Don\'t have '.$this->cipher);
    }
  }

}


if(is_array($_POST) && isset($_POST['pwd']) && !empty($_POST['pwd']) && isset($_POST['encrypted']) && !empty($_POST['encrypted'])) {

  $seed = new seedWrapper();
  $decrypted = $seed->decryptSeed($_POST['encrypted'], $_POST['pwd']);
  $decrypted = htmlspecialchars($decrypted, ENT_QUOTES);

  if(!empty($decrypted)) {
      print '<div class="messenger true"><h3>Seed:</h3><p>'.$decrypted.'</p></div>';
  } else {
      print '<div class="messenger"><p>Looks like your password did not work...</p></div>';
  }

}

if(is_array($_POST) && isset($_POST['pwd']) && !empty($_POST['pwd']) && isset($_POST['action']) && !empty($_POST['action'])) {

  $factory    = new RandomLib\Factory;
  $generator  = $factory->getMediumStrengthGenerator();

  $seed       = new seedWrapper();
  $seedString = $generator->generateString(81, 'ABCDEFGHJK9MNPQ9RSTUVWXYZ');
  $encrypted  = $seed->encryptSeed($seedString, $_POST['pwd']);

  print '<div class="messenger true"><h3>Generated Seed:</h3><p>'.htmlspecialchars($seedString, ENT_QUOTES).'</p>
   <h3>Encrypted</h3><p>'.htmlspecialchars($encrypted, ENT_QUOTES).'</p></div>';
}
