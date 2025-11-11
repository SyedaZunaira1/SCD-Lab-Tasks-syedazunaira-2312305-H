<?php

function check_password(string $pwd): array {
    $result = [
        'length_ok' => false,
        'has_upper' => false,
        'has_digit' => false,
        'has_special' => false,
        'score' => 0
    ];
    
   
    $result['length_ok'] = strlen($pwd) >= 8;
    
   
    for ($i = 0; $i < strlen($pwd); $i++) {
        if (ctype_upper($pwd[$i])) {
            $result['has_upper'] = true;
            break;
        }
    }
    
    
    for ($i = 0; $i < strlen($pwd); $i++) {
        if (ctype_digit($pwd[$i])) {
            $result['has_digit'] = true;
            break;
        }
    }
    
 
    if (preg_match('/[^A-Za-z0-9]/', $pwd)) {
        $result['has_special'] = true;
    }
    
    $result['score'] = ($result['length_ok'] ? 1 : 0) +
                      ($result['has_upper'] ? 1 : 0) +
                      ($result['has_digit'] ? 1 : 0) +
                      ($result['has_special'] ? 1 : 0);
    
    return $result;
}


$passwords = [
    "hello",        // Weak
    "Hello123",     // Strong
    "Abc!2024",     // Strong
    "test",         // Weak
    "Password123",  // Strong (missing special char)
    "weak",         // Weak
    "Med1um!",      // Strong
    "12345678"      // Medium
];


foreach ($passwords as $password) {
    $result = check_password($password);
    
    
    $strength = match(true) {
        $result['score'] <= 1 => "Weak",
        $result['score'] == 2 => "Medium",
        $result['score'] >= 3 => "Strong"
    };
    
    echo "Password: \"{$password}\" — Score: {$result['score']}/4 — Strength: {$strength}\n " ,"<br>" ;
}

?>