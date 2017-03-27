    <script src="assets/js/libraries/jquery.min.js"></script>
    <?php foreach($params as $row): ?>
    <script src=<?php echo $row['js']; ?>></script>
    <?php endforeach; ?>
</body>
</html>