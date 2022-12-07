<?

// Difference between encoding and hashing.

$data = "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.";

$datalen = strlen($data);

$b64 = base64_encode($data);
$b64len = strlen($b64);

$md5 = md5($data);
$md5len = strlen($md5);

echo "Data: $data (Length: $datalen)\n";

echo "Hash: $md5 (Length: $md5len)\n";

echo "Base64: $b64 (Length: $b64len)\n";
