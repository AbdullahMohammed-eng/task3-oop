<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Session {
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function check($key) {
        return isset($_SESSION[$key]);
    }

    public static function remove($key) {
        if (self::check($key)) {
            unset($_SESSION[$key]);
        }
    }

    public static function removeAll() {
        session_unset();
        session_destroy();
    }

    public static function getAll() {
        return $_SESSION;
    }

    public static function flash($key, $value = null) {
        if ($value !== null) {
            self::set($key, $value);
        } else {
            $val = self::get($key);
            self::remove($key);
            return $val;
        }
    }
}

Session::set("username", "Ahmed Mohammed");
Session::set("role", "Backend Developer");
Session::set("email", "ahmed@example.com");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Session Management Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Session Class Results</h4>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>Username (get):</strong> <?php echo Session::get("username"); ?>
                </li>
                <li class="list-group-item">
                    <strong>Is Logged In (check):</strong> <?php echo Session::check("username") ? "Yes" : "No"; ?>
                </li>
                <li class="list-group-item">
                    <strong>All Session Data (getAll):</strong> 
                    <pre class="bg-light p-2 mt-2 mb-0 border rounded"><?php print_r(Session::getAll()); ?></pre>
                </li>
            </ul>
        </div>
    </div>
</div>

</body>
</html>