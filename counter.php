<?php

function SimpleCounter($file = "counter.txt") {
        if (!is_file($file)) {
                file_put_contents($file, 0);
                return 0;
        }
        $value = file_get_contents($file);
        $value ++;
        file_put_contents($file, $value, LOCK_EX); // LOCK the file
        return $value;
}

echo "Page Views: " . SimpleCounter();

?>