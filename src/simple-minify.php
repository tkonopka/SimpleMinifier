<?php

/*
 * Command line tool
 * 
 * Performs code minification using SimpleMinifier
 *  
 * The minification:
 *  - removes inline comments , i.e. end of line double forward-slash
 *  - removes comment blocks, i.e. block enclosed by slash-asterisk and asterisk-slash
 *  - removes some repeated whitespace
 * 
 * @author: Tomasz Konopka
 * @license: MIT
 */

use tkonopka\SimpleMinifier;
include_once "SimpleMinifier.php";


$usage = "USAGE: php simple-minify.php INFILE OUTFILE\n";



// print a usage message if called without the proper arguments
if (count($argv)!=3) {
    echo $usage;
    exit();
}

// extract target network name from first argument (after purge-network.php)
$infile = $argv[1];
$outfile = $argv[2];

// make sure the input exists
if (!file_exists($infile)) {
    echo $usage;
    exit();
}


/* --------------------------------------------------------------------------
 * Run the minifier on the input data
 * -------------------------------------------------------------------------- */

$minifier = new SimpleMinifier\SimpleMinifier();
$indata = file_get_contents($infile);
$outdata = $minifier->minify($indata);
file_put_contents($outfile, $outdata);

