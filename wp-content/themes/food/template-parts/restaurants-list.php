<?php
$restaurants = get_posts([
    'category' => [35, -22],
    'numberposts' => -1,
    'order' => 'ASC',
    'orderby' => 'date'
]);

?>

<div class="restaurants container">
    <p class="caption">Restaurants</p>
    <div class="loader">
      <div class="loadingio-spinner-spinner-rl7w6qbl47d"><div class="ldio-4khtpk1mo8v">
          <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
        </div></div>
      <style type="text/css">
        @keyframes ldio-4khtpk1mo8v {
          0% { opacity: 1 }
          100% { opacity: 0 }
        }
        .ldio-4khtpk1mo8v div {
          left: 98.735px;
          top: 42.315px;
          position: absolute;
          animation: ldio-4khtpk1mo8v linear 2.127659574468085s infinite;
          background: #90c344;
          width: 19.53px;
          height: 19.53px;
          border-radius: 9.765px / 9.765px;
          transform-origin: 9.765px 66.185px;
        }.ldio-4khtpk1mo8v div:nth-child(1) {
           transform: rotate(0deg);
           animation-delay: -1.9342359767891684s;
           background: #90c344;
         }.ldio-4khtpk1mo8v div:nth-child(2) {
            transform: rotate(32.72727272727273deg);
            animation-delay: -1.7408123791102514s;
            background: #90c344;
          }.ldio-4khtpk1mo8v div:nth-child(3) {
             transform: rotate(65.45454545454545deg);
             animation-delay: -1.5473887814313347s;
             background: #90c344;
           }.ldio-4khtpk1mo8v div:nth-child(4) {
              transform: rotate(98.18181818181819deg);
              animation-delay: -1.3539651837524178s;
              background: #90c344;
            }.ldio-4khtpk1mo8v div:nth-child(5) {
               transform: rotate(130.9090909090909deg);
               animation-delay: -1.1605415860735009s;
               background: #90c344;
             }.ldio-4khtpk1mo8v div:nth-child(6) {
                transform: rotate(163.63636363636363deg);
                animation-delay: -0.9671179883945842s;
                background: #90c344;
              }.ldio-4khtpk1mo8v div:nth-child(7) {
                 transform: rotate(196.36363636363637deg);
                 animation-delay: -0.7736943907156674s;
                 background: #90c344;
               }.ldio-4khtpk1mo8v div:nth-child(8) {
                  transform: rotate(229.0909090909091deg);
                  animation-delay: -0.5802707930367504s;
                  background: #90c344;
                }.ldio-4khtpk1mo8v div:nth-child(9) {
                   transform: rotate(261.8181818181818deg);
                   animation-delay: -0.3868471953578337s;
                   background: #90c344;
                 }.ldio-4khtpk1mo8v div:nth-child(10) {
                    transform: rotate(294.54545454545456deg);
                    animation-delay: -0.19342359767891684s;
                    background: #90c344;
                  }.ldio-4khtpk1mo8v div:nth-child(11) {
                     transform: rotate(327.27272727272725deg);
                     animation-delay: 0s;
                     background: #90c344;
                   }
        .loadingio-spinner-spinner-rl7w6qbl47d {
          width: 217px;
          height: 217px;
          display: inline-block;
          overflow: hidden;
          background: #ffffff;
        }
        .ldio-4khtpk1mo8v {
          width: 100%;
          height: 100%;
          position: relative;
          transform: translateZ(0) scale(1);
          backface-visibility: hidden;
          transform-origin: 0 0; /* see note above */
        }
        .ldio-4khtpk1mo8v div { box-sizing: content-box; }
      </style>
    </div>
    <div class="restaurants__list hide">
        <?php foreach ($restaurants as $restaurant) : ?>
            <a href="<?= get_permalink($restaurant->ID) . '?rest=' . $restaurant->post_name; ?>" class="restaurants__item">
                <div class="restaurants__item_img">
                    <div class="restaurants__item_image"
                         style="background-image: url('<?= get_field('img', $restaurant->ID); ?>');"></div>
                </div>
                <div class="restaurants__item_info">
                    <p class="restaurants__item_title"><?= get_the_title($restaurant->ID); ?></p>
                    <p class="restaurants__item_location">Location: <?= get_field('location', $restaurant->ID); ?></p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
