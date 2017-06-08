    <script src="assets/js/libraries/jquery.min.js"></script>
    <script src="assets/js/libraries/jquery-ui.min.js"></script>
    <script src="assets/js/libraries/bootstrap.min.js"></script>
    <?php foreach($params as $row): ?>
    <script src=<?php echo $row['js']; ?>></script>
    <?php endforeach; ?>
</body>
</html>