<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Iota Seed Generator/Encrypter/Decrypter</title>

  <link rel="stylesheet" href="css/main.css">
  <link rel="icon" href="images/favicon.png">
</head>

<body>
  <div class="main">

    <div class="why">
      <h3>Iota Seed Generator/Encrypter/Decrypter</h3>
      <p>
        This script allows you to generate a proper IOTA seed and allows you to encrypt the seed and set a password for decryption.<br />
        May a good idea to backup it this way or in case you want to send a seed via email.<br /><br />

        Download the files direct from the Github Repo <a href="https://github.com/blumanski/iota-secure-seed-generator" title="https://github.com/blumanski/iota-secure-seed-generator">
          The Github Repo
        </a>
        <br /><br />
        I recommend to use this script on your localhost only. You can test it here anyway.
      </a>
      </p>
    </div>

    <div class="output">
      <?php include_once('./seedWrapper.php'); ?>
    </div>

    <form action="./index.php" method="post">
      <h3>Generate Seed</h3>
      <p>Enter password for later decryption.</p>
      <div class="form-block">
        <input type="password" name="pwd" id="pwd" placeholder="Enter Decrypt Password" />
        <input type="hidden" value="generate" name="action" />
        <input type="submit" value="Generate Seed" />
      </div>
    </form>

    <form action="./index.php" method="post">
      <h3>Decrypt Seed</h3>
      <p>Enter encrypted seed and password to decrypt seed.</p>
      <div class="form-block">
        <input type="text" name="encrypted" id="encrypted" placeholder="Enter Encrypted Seed" class="long-field" /><br />
        <input type="password" name="pwd" id="pwd" placeholder="Enter Decrypt Password" />
        <input type="submit" value="Decrypt Seed" />
      </div>
    </form>

    <div class="desc">
      <h3>Privacy</h3>
      <p>
        This site does not secretly collect any personally identifiable information.
        I don't monitor submissions, I don't keep records of any sort.</p>

        Oliver Blum -> https://github.com/blumanski
      </div>
  </div>

</body>

</html>
