<?php

$db = new mysqli('localhost', 'root', 'root', 'food');

$query ="SELECT `object_id` FROM `wp_term_relationships` WHERE `term_taxonomy_id` = 3";
$result = $db->query($query);

$hit_dishes = mysqli_fetch_all($result, MYSQLI_ASSOC);

$db->close();

foreach ($hit_dishes as $dish) : ?>
<p><?= get_the_title((int)$dish['object_id']); ?></p>
<?php endforeach; ?>



