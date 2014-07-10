<?php
ob_start();
$mirrordir = '/var/www/html/gitlab/training';

$gitdir = $mirrordir . "/.git";

$json = file_get_contents('php://input');

if (!$json)
{
	die('No direct access');
}

$jsarr = json_decode($json, true);

$branch = $jsarr["ref"];

print_r($jsarr);

if ($branch == 'refs/heads/master')
{
	/*$gitPull = "git --git-dir=" . $gitdir . " --work-tree=" . $mirrordir . " pull --no-edit";
	echo $gitPull . "\n";

	$output = shell_exec($gitPull);

	echo $output . "\n ----";*/

	$cmd = "git diff " . $jsarr['before'] . ".." . $jsarr['after'] . " --pretty=oneline --name-only";

	echo $cmd . "\n";

	echo shell_exec($cmd);
}

addLog('');

ob_end_clean();

function addLog($json)
{
	$out2 = ob_get_contents();

	$file = fopen("response.txt", "w");
	fwrite($file, $json . "\n" . $out2);
	fclose($file);
}
