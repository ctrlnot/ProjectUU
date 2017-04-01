    <script src="assets/js/libraries/jquery.min.js"></script>
    <!-- <script src="assets/js/nav.js"></script> -->
    <?php foreach($params as $row): ?>
    <script src=<?php echo $row['js']; ?>></script>
    <?php endforeach; ?>
</body>
</html>