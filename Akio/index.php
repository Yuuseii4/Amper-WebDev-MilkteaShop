        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            echo "<div class='summary'>";
            echo "<h2>📝 Order Summary</h2>";

            $milktea_prices = [
                "taro" => 85,
                "almond" => 80,
                "wintermelon" => 95,
                "blueberry" => 105,
                "okinawa" => 95,
            ];

            $size_prices = [
                "small" => 0,
                "medium" => 20,
                "large" => 50,
            ];

            $extras_prices = [
                "sugar" => 10.00,
                "pearls" => 15.00,
            ];

            $milktea_type = $_POST["milktea"];
            $size = $_POST["size"];

            $extras = isset($_POST["extras"]) ? $_POST["extras"] : [];

  
            $total_price = $milktea_prices[$milktea_type] + $size_prices[$size];

            foreach ($extras as $extra) {
                $total_price += $extras_prices[$extra];
            }

            echo "<table>";

            echo "<tr><td>Name</td><td>" . htmlspecialchars($_POST["name"]) . "</td></tr>";

            echo "<tr><td>Milktea Type</td><td>" . htmlspecialchars($_POST["milktea"]) . " (₱" . number_format($milktea_prices[$milktea_type], 2) . ")</td></tr>";

            echo "<tr><td>Size</td><td>" . htmlspecialchars($_POST["size"]) . " (₱" . number_format($size_prices[$size], 2) . ")</td></tr>";

            if (!empty($extras)) {
                echo "<tr><td>Extras:</td><td>" . implode(", ", $extras) . " (₱" . number_format(array_sum(array_intersect_key($extras_prices, array_flip($extras))), 2) . ")</td></tr>";
            }

            echo "<tr><td>Total Price</td><td>₱" . number_format($total_price, 2) . "</td></tr>";
            echo "<tr><td>Special Instructions</td><td>" . htmlspecialchars($_POST["instructions"]) . "</td></tr>";

            echo "</table>";

            if ($milktea_type !== "espresso") {
                echo "Hey, " . htmlspecialchars($_POST["name"]) . "!";
                echo "<p>Here's a pick up line for you: Are you a charger? Because I'm dying without you</p>";
            }

            if ($total_price > 250 && $total_price < 350) {
                echo "<p>Password for the CR: milktea   123</p>";
            } elseif ($total_price >= 350) {
                echo "<p>Password for Wi-Fi: mocha456</p>";
            }

            echo "</div>";
        }

        ?>
    </div>
</body>

</html>