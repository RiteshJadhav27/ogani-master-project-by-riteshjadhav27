<?php
session_start();

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

// Handle Add, Remove, Increase, Decrease
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $action = $_POST["action"];
    $name = $_POST["name"] ?? '';
    $price = $_POST["price"] ?? 0;

    if ($action == "add") {
        $found = false;
        foreach ($_SESSION["cart"] as &$item) {
            if ($item["id"] == $id) {
                $item["quantity"]++;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $_SESSION["cart"][] = ["id" => $id, "name" => $name, "price" => $price, "quantity" => 1];
        }
    } elseif ($action == "increase") {
        foreach ($_SESSION["cart"] as &$item) {
            if ($item["id"] == $id) {
                $item["quantity"]++;
                break;
            }
        }
    } elseif ($action == "decrease") {
        foreach ($_SESSION["cart"] as &$item) {
            if ($item["id"] == $id && $item["quantity"] > 1) {
                $item["quantity"]--;
                break;
            }
        }
    } elseif ($action == "remove") {
        $_SESSION["cart"] = array_filter($_SESSION["cart"], function ($item) use ($id) {
            return $item["id"] != $id;
        });
    }
    
    header("Location: shopping_cart.html"); // Redirect back to the cart page
    exit();
}

// Display Cart Items
echo "<table>";
echo "<tr><th>Product</th><th>Price</th><th>Quantity</th><th>Total</th><th>Action</th></tr>";
if (!empty($_SESSION["cart"])) {
    foreach ($_SESSION["cart"] as $item) {
        echo "<tr>
                <td>{$item['name']}</td>
                <td>₹{$item['price']}</td>
                <td>
                    <form method='post'>
                        <input type='hidden' name='id' value='{$item['id']}'>
                        <input type='hidden' name='action' value='decrease'>
                        <button type='submit'>-</button>
                    </form>
                    {$item['quantity']}
                    <form method='post'>
                        <input type='hidden' name='id' value='{$item['id']}'>
                        <input type='hidden' name='action' value='increase'>
                        <button type='submit'>+</button>
                    </form>
                </td>
                <td>₹" . ($item['price'] * $item['quantity']) . "</td>
                <td>
                    <form method='post'>
                        <input type='hidden' name='id' value='{$item['id']}'>
                        <input type='hidden' name='action' value='remove'>
                        <button type='submit'>❌</button>
                    </form>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>Your cart is empty!</td></tr>";
}
echo "</table>";
?>
