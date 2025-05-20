<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigment 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

            session_start();
            if (isset($_POST["a"]) && isset($_POST["b"]) && isset($_POST["c"]))
            {
                $inputA = escapeshellarg($_POST["a"]);
                $inputB = escapeshellarg($_POST["b"]);
                $inputC = escapeshellarg($_POST["c"]);
                
                $json_response = shell_exec("python3 calculation.py $inputA $inputB $inputC");
                $response = json_decode($json_response, true);
                
                // save the data in the session
                if($response)
                {
                    
                    $_SESSION["submited"] = true;
                    $_SESSION["result"] = $response["result"];
                    $_SESSION["steps"] = $response["steps"];
                }

            }

            // Redirect to the same page to avoid data resending
            header("Location: " . $_SERVER["PHP_SELF"]);
            exit();
        }

        

        // Display data only if saved in session
        session_start();
        if (isset($_SESSION["submited"])) {

            $result = $_SESSION["result"];
            $steps = $_SESSION["steps"];
        }
    ?>
    <main>
    <div class="container card mt-5">
        <div class="">
            <h1 class="text-center">Assignment 2 - Sebastian Taraguay</h1>
            <hr>
            <br>
            <form action="">
                <div class="mb-3">
                    <label for="a" class="form-label">Insert A value</label>
                    <input type="number" class="form-control" id="a" name="a" required>
                </div>
                <div class="mb-3">
                    <label for="b" class="form-label">Insert B value</label>
                    <input type="number" class="form-control" id="b" name="b" required>
                </div>
                <div class="mb-3">
                    <label for="c" class="form-label">Insert C value</label>
                    <input type="number" class="form-control" id="c" name="c" required>
                </div>
                <button type="submit" class="btn btn-primary">Calculate</button>
            </form>
            <hr>
            <br>
                <?php

                    if(isset($_SESSION["submited"]))
                    {   
                        print = "<div>
                                    <h3>Final result: $result</h3>
                                    <p>Steps:</p>
                                    <p>$steps</p>
                                </div>"
                    }
                    unset($_SESSION["submited"]); // Clear session so it doesn't show on reload
                ?>
        </div>
    </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>


?>