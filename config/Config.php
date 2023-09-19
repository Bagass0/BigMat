<?php

$memory = $v1 * $v2 * $v4 * $v5 / $v3;
$timeCost = $v1;
$threads = $v2 / ($v1 * $v1 * $v1);

$hashV = 19;
$hashType = "argon2id";

$hashAdd = "\$$hashType\$v=$hashV\$m=$memory,t=$timeCost,p=$threads";

?>