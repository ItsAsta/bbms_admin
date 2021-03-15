<form action="" method="POST">
    <div>
        <input type="text" name="name" />
    </div>
    <button type="submit" name="submit1">
        Submit
    </button>
</form>

<form action="" method="POST">
    <div>
        <b>Name:</b> <?php echo filter_input(INPUT_POST, 'name'); ?>
    </div>
    <div>
        <button type="submit" name="submit2">
            Launch
        </button>
    </div>
</form>