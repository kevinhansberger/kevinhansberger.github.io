<?php

// List of medications and insurance carriers
$medications = array(
    'Medication A' => array('Carrier 1', 'Carrier 2', 'Carrier 3'),
    'Medication B' => array('Carrier 2', 'Carrier 4', 'Carrier 5'),
    'Medication C' => array('Carrier 1', 'Carrier 4', 'Carrier 6'),
    // add more medications and carriers as needed
);

// Check if form is submitted
if(isset($_POST['submit'])) {
    // Get selected medications
    $selected_medications = $_POST['medications'];

    // Filter insurance carriers based on selected medications
    $filtered_carriers = array();
    foreach($selected_medications as $medication) {
        if(isset($medications[$medication])) {
            $filtered_carriers = array_merge($filtered_carriers, $medications[$medication]);
        }
    }
    // Remove duplicates from the filtered carriers array
    $filtered_carriers = array_unique($filtered_carriers);
}

?>

<!-- HTML form -->
<form method="post">
    <label for="medications">Select medications:</label>
    <select name="medications[]" id="medications" multiple>
        <?php foreach($medications as $medication => $carriers) : ?>
            <option value="<?php echo $medication; ?>"><?php echo $medication; ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" name="submit" value="Filter">
</form>

<!-- Display filtered insurance carriers -->
<?php if(isset($_POST['submit'])) : ?>
    <h2>Filtered Insurance Carriers:</h2>
    <?php if(!empty($filtered_carriers)) : ?>
        <?php foreach($filtered_carriers as $carrier) : ?>
            <p><?php echo $carrier; ?></p>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No insurance carriers cover the selected medications.</p>
    <?php endif; ?>
<?php endif; ?>
