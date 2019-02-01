<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Lab No. 6 - Temp. Converter</title>
</head>
<body>

<?php
// function to calculate converted temperature
function convertTemp($temp, $unit1, $unit2)
{
    // conversion formulas
    // Celsius to Fahrenheit = T(°C) × 9/5 + 32
    // Celsius to Kelvin = T(°C) + 273.15
    // Fahrenheit to Celsius = (T(°F) - 32) × 5/9
    // Fahrenheit to Kelvin = (T(°F) + 459.67)× 5/9
    // Kelvin to Fahrenheit = T(K) × 9/5 - 459.67
    // Kelvin to Celsius = T(K) - 273.15

    // You need to develop the logic to convert the temperature based on the selections and input made
    if ($unit1 == $unit2) {
      return $temp;
    }
    // If the user wants to convert from celsius
    if ($unit1 == 'celsius') {
      // Check to see if farenheit or kelvin are selected
      if ($unit2 == 'farenheit') {
        return ($temp * 9/5) + 32;
      } elseif ($unit2 == 'kelvin') {
        return $temp + 273.15;
      }
    }
    // If the user wants to convert from farenheit
    if ($unit1 == 'farenheit') {
      // Check to see if celsius or kelvin are selected
      if ($unit2 == 'celsius') {
        return ($temp - 32) * 5/9;
      } elseif ($unit2 == 'kelvin') {
        return ($temp + 459.67) * 5/9;
      }
    }
    // If the user wants to convert from kelvin
    if ($unit1 == 'kelvin') {
      // Check to see if celsius or farenheit are selected
      if ($unit2 == 'celsius') {
        return $temp - 273.15;
      } elseif ($unit2 == 'farenheit') {
        return ($temp * 9/5) - 459.67;
      }
    }
} // end function

// Logic to check for POST and grab data from $_POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Store the original temp and units in variables
    // You can then use these variables to help you make the form sticky
    // then call the convertTemp() function
    // Once you have the converted temperature you can place PHP within the converttemp field using PHP
    // I coded the sticky code for the originaltemp field for you

    $originalTemperature = $_POST['originaltemp'];
    $originalUnit = $_POST['originalunit'];
    $conversionUnit = $_POST['conversionunit'];
    if ($originalUnit != '--Select--' && $conversionUnit !='--Select--') {
      $convertedTemp = convertTemp($originalTemperature, $originalUnit, $conversionUnit);
    } else {
      $warning = '<div class="warning">Please select a temperture unit.</div>';
    }
} // end if

?>
<!-- Form starts here -->
<h1>Temperature Converter</h1>
<h4>CTEC 127 - PHP with SQL 1</h4>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    <div class="group">
        <label for="temp">Temperature</label>
        <input type="text" value="<?php if (isset($_POST['originaltemp'])) { echo $_POST['originaltemp']; }?>" name="originaltemp" size="14" maxlength="7" id="temp" required>
        <select name="originalunit">
            <option value="--Select--" <?php if ($originalUnit == '--Select--') echo 'selected="selected"'; ?>>--Select--</option>
            <option value="celsius" <?php if ($originalUnit == 'celsius') echo 'selected="celsius"'; ?>>Celsius</option>
            <option value="farenheit" <?php if ($originalUnit == 'farenheit') echo 'selected="farenheit"'; ?>>Farenheit</option>
            <option value="kelvin" <?php if ($originalUnit == 'kelvin') echo 'selected="kelvin"'; ?>>Kelvin</option>
        </select>
    </div>

    <div class="group">
        <label for="convertedtemp">Converted Temperature</label>
        <input type="text" value="<?php if (isset($convertedTemp)) { echo $convertedTemp;} else {echo " "; }?>" name="convertedtemp" size="14" maxlength="7" id="convertedtemp" readonly>
        <select name="conversionunit">
            <option value="--Select--" <?php if ($conversionUnit == '--Select--') echo 'selected="selected"'; ?>>--Select--</option>
            <option value="celsius" <?php if ($conversionUnit == 'celsius') echo 'selected="celsius"'; ?>>Celsius</option>
            <option value="farenheit" <?php if ($conversionUnit == 'farenheit') echo 'selected="farenheit"'; ?>>Farenheit</option>
            <option value="kelvin" <?php if ($conversionUnit == 'kelvin') echo 'selected="kelvin"'; ?>>Kelvin</option>
        </select>
    </div>
    <input type="submit" value="Convert"/>
    <?php echo $warning; ?>
</form>
</body>
</html>
